<?php

namespace frontend\modules\kpi\controllers;

use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\KpiTeam;
use frontend\models\hrvc\KpiTeamHistory;
use frontend\models\hrvc\UserRole;
use Yii;
use yii\db\Expression;
use yii\web\Controller;

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
class KpiTeamController extends Controller
{
	public function beforeAction($action)
	{
		if (!Yii::$app->user->id) {
			return $this->redirect(Yii::$app->homeUrl . 'site/login');
		}
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		return true;
	}
	public function actionKpiTeamSetting($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$role = UserRole::userRight();
		if ($role < 3) {
			return $this->redirect(Yii::$app->homeUrl . 'kpi/management/index');
		}
		$kpiId = $param["kpiId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-team/kpi-team?kpiId=' . $kpiId);
		$kpiTeams = curl_exec($api);
		$kpiTeams = json_decode($kpiTeams, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/kpi-detail?id=' . $kpiId);
		$kpiDetail = curl_exec($api);
		$kpiDetail = json_decode($kpiDetail, true);
		curl_close($api);
		return $this->render('kpi_team_setting', [
			"kpiTeams" => $kpiTeams,
			"kpiDetail" => $kpiDetail,
			"kpiId" => $kpiId,
			"role" => $role
		]);
	}
	public function actionSetTeamTarget()
	{
		/*if (isset($_POST["kpiId"])) {
			if (isset($_POST["teamTerget"]) && count($_POST["teamTerget"])) {
				foreach ($_POST["teamTerget"] as $teamId => $target) :
					if ($target != '') {
						$kpiTeam = KpiTeam::find()
							->where(["kpiId" => $_POST["kpiId"], "teamId" => $teamId])
							->one();
						$target = str_replace(",", "", $target);
						$kpiTeam->target = $target;
						$kpiTeam->updateDateTime = new Expression('NOW()');
						$kpiTeam->createrId = Yii::$app->user->id;
						$kpiTeam->save(false);
					}
				endforeach;
			}
		}
		return $this->redirect(Yii::$app->homeUrl . 'kpi/management/assign-kpi');*/

		if (isset($_POST["kpiId"])) {
			if (isset($_POST["teamTerget"]) && count($_POST["teamTerget"])) {
				foreach ($_POST["teamTerget"] as $teamId => $target) :
					if ($_POST["role"] == 3) {
						$historyStatus = 88; //if team leder updated need to have the improvement from supervisor or mg
					} else {
						$historyStatus = 1;
					}
					if ($target != '') {
						$kpiTeam = KpiTeam::find()
							->where(["kpiId" => $_POST["kpiId"], "teamId" => $teamId])
							->one();
						if ($_POST["role"] != 3) { // higher than Team Leader, don't need to approve
							$target = str_replace(",", "", $target);
							$kpiTeam->target = $target;
							$kpiTeam->updateDateTime = new Expression('NOW()');
							$kpiTeam->createrId = Yii::$app->user->id;
							$kpiTeam->save(false);
						}
						if ($kpiTeam->target != $target) {
							$history = KpiTeamHistory::find()
								->where(["kpiTeamId" => $kpiTeam->kpiTeamId, "status" => 88])
								->one();
							if (!isset($history) || empty($history)) {
								$history = new KpiTeamHistory();
								$history->createDateTime = new Expression('NOW()');
							}
							$history->kpiTeamId = $kpiTeam->kpiTeamId;
							$history->detail = $_POST["remark"][$teamId] != '' ? $_POST["remark"][$teamId] : '';
							$history->target = $target;
							$history->createrId = Yii::$app->user->id;
							$history->status = $historyStatus;
							$history->updateDateTime = new Expression('NOW()');
							$history->save(false);
						}
					}
				endforeach;
			}
		}
		return $this->redirect(Yii::$app->homeUrl . 'kpi/management/assign-kpi');
	}
}
