<?php

namespace frontend\modules\kfi\controllers;

use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\UserRole;
use Yii;
use yii\db\Expression;
use yii\web\Controller;

/**
 * Default controller for the `kgi` module
 */
class AssignController extends Controller
{
	public function beforeAction($action)
	{
		if (!Yii::$app->user->id) {
			return $this->redirect(Yii::$app->homeUrl . 'site/login');
		}
		$isManager = UserRole::isManager();
		if ($isManager == 0) {
			return $this->redirect(Yii::$app->homeUrl . 'kfi/management/index');
		}
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		$role = UserRole::userRight();
		if ($role < 3) {
			return $this->redirect(Yii::$app->homeUrl . 'kfi/management/index');
		}
		return true;
	}
	public function actionAssign($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$role = UserRole::userRight();

		$kfiId = $param["kfiId"];
		$companyId = $param["companyId"];
		$role = UserRole::userRight();
		if ($role < 3) {
			return $this->redirect(Yii::$app->homeUrl . 'kfi/management/index');
		}

		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);



		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/team/company-team?id=' . $companyId);
		$teams = curl_exec($api);
		$teams = json_decode($teams, true);
		//throw new Exception(print_r($teams, true));

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kfi/management/kfi-detail?kfiId=' . $kfiId);
		$kfiDetail = curl_exec($api);
		$kfiDetail = json_decode($kfiDetail, true);
		$text = '';
		//throw new Exception(print_r($kfiDetail, true));

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kfi/management/kfi-team-employee?kfiId=' . $kfiId);
		$kfiTeamEmployee = curl_exec($api);
		$kfiTeamEmployee = json_decode($kfiTeamEmployee, true);



		curl_close($api);

		//throw new Exception(print_r($kfiTeamEmployee, true));
		return $this->render('assign', [
			"role" => $role,
			"kfiDetail" => $kfiDetail,
			"kfiId" => $kfiId,
			"teams" => $teams,
			"text" => $text,
			"kfiTeamEmployee" => $kfiTeamEmployee,
			"companyId" => $companyId
		]);
	}
}