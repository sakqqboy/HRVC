<?php

namespace frontend\modules\kpi\controllers;

use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\KgiEmployee;
use frontend\models\hrvc\KpiEmployee;
use frontend\models\hrvc\KpiTeam;
use frontend\models\hrvc\Team;
use frontend\models\hrvc\UserRole;
use Yii;
use yii\db\Expression;
use yii\web\Controller;

/**
 * Default controller for the `kpi` module
 */
class AssignController extends Controller
{
	public function beforeAction($action)
	{
		if (!Yii::$app->user->id) {
			return $this->redirect(Yii::$app->homeUrl . 'site/login');
		}
		$isManager = UserRole::isManager();
		// if ($isManager == 0) {
		// 	return $this->redirect(Yii::$app->homeUrl . 'kpi/management/index');
		// }
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		$role = UserRole::userRight();
		if ($role < 3) {
			return $this->redirect(Yii::$app->homeUrl . 'kpi/management/index');
		}
		return true;
	}
	public function actionAssign($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$role = UserRole::userRight();
		if ($role == 7) {
			$adminId = Yii::$app->user->id;
		}
		if ($role == 6) {
			$gmId = Yii::$app->user->id;
		}
		if ($role == 5) {
			$managerId = Yii::$app->user->id;
		}
		if ($role == 4) {
			$supervisorId = Yii::$app->user->id;
		}
		if ($role == 3) {
			$teamLeaderId = Yii::$app->user->id;
		}
		if ($role == 1 || $role == 2) {
			$staffId = Yii::$app->user->id;
		}
		$kpiId = $param["kpiId"];
		$companyId = $param["companyId"];
		$role = UserRole::userRight();
		$teamId = Team::userTeam(Yii::$app->user->id);
		if ($role < 3) {
			return $this->redirect(Yii::$app->homeUrl . 'kpi/management/index');
		}

		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-team/kpi-team?kpiId=' . $kpiId);
		$kpiTeams = curl_exec($api);
		$kpiTeams = json_decode($kpiTeams, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/team/company-team?id=' . $companyId);
		$teams = curl_exec($api);
		$teams = json_decode($teams, true);
		//throw new Exception(print_r($teams, true));

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/kpi-detail?id=' . $kpiId);
		$kpiDetail = curl_exec($api);
		$kpiDetail = json_decode($kpiDetail, true);
		$text = '';
		// throw new Exception('Unexpected API Response: ' . $kpiId);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-team/kpi-team-employee?kpiId=' . $kpiId);
		$kpiTeamEmployee = curl_exec($api);
		$kpiTeamEmployee = json_decode($kpiTeamEmployee, true);
		//throw new Exception($kpiId);

		//throw new Exception(print_r($kpiTeamEmployee, true));

		/*if (isset($teams) && count($teams) > 0) {
			foreach ($teams as $team):
				curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-team/each-team-employee-kpi?kpiId=' . $kpiId . '&&teamId=' . $team["teamId"]);
				$employeeTeamTarget = curl_exec($api);
				$employeeTeamTarget = json_decode($employeeTeamTarget, true);

				curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/team/team-detail?id=' . $team["teamId"]);
				$teamDetail = curl_exec($api);
				$teamDetail = json_decode($teamDetail, true);
				if (isset($employeeTeamTarget) && count($employeeTeamTarget) > 0) {
					$text .= $this->renderAjax('employee_team_target', [
						"employeeTeamTarget" => $employeeTeamTarget,
						"teamId" => $team["teamId"],
						"teamDetail" => $teamDetail
					]);
				}
			endforeach;
		}*/

		curl_close($api);
		return $this->render('assign', [
			"role" => $role,
			"kpiTeams" => $kpiTeams,
			"kpiDetail" => $kpiDetail,
			"kpiId" => $kpiId,
			"teams" => $teams,
			"text" => $text,
			"kpiTeamEmployee" => $kpiTeamEmployee,
			"companyId" => $companyId,
			"userTeamId" => $teamId
		]);
	}
	public function actionEmployeeInTeamTarget()
	{
		$teamId = $_POST["teamId"];
		$kpiId = $_POST["kpiId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-team/each-team-employee-kpi?kpiId=' . $kpiId . '&&teamId=' . $teamId);
		$employeeTeamTarget = curl_exec($api);
		$employeeTeamTarget = json_decode($employeeTeamTarget, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/team/team-detail?id=' . $teamId);
		$teamDetail = curl_exec($api);
		$teamDetail = json_decode($teamDetail, true);


		//throw new Exception(print_r($employeeTeamTarget, true));
		curl_close($api);

		if (isset($employeeTeamTarget) && count($employeeTeamTarget) > 0) {
			$text = $this->renderAjax('employee_team_target', [
				"employeeTeamTarget" => $employeeTeamTarget,
				"teamId" => $teamId,
				"teamDetail" => $teamDetail
			]);
		} else {
			$text = "";
		}

		$res["status"] = true;
		$res["textHtml"] = $text;
		return json_encode($res);
	}
	public function actionUpdateTeamKpi()
	{
		if (isset($_POST["team"]) && count($_POST["team"]) > 0) {
			foreach ($_POST["team"] as $teamId => $team):
				$kpiTeam = KpiTeam::find()
					->where(["kpiId" => $_POST["kpiId"], "teamId" => $teamId])
					->andWhere("status!=99")
					->one();
				$targetTeam = str_replace(",", "", $_POST["teamTarget"][$teamId]);
				if (isset($kpiTeam) && !empty($kpiTeam)) {
					if ($kpiTeam->target != $targetTeam) {
						$kpiTeam->target = $targetTeam;
						$kpiTeam->updateDateTime = new Expression('NOW()');
						$kpiTeam->save(false);
					}
				} else {
					$kpiTeam = new KpiTeam();
					$kpiTeam->kpiId = $_POST["kpiId"];
					$kpiTeam->teamId = $teamId;
					$kpiTeam->target = $targetTeam;
					$kpiTeam->result = 0;
					$kpiTeam->status = 1;
					$kpiTeam->createDateTime = new Expression('NOW()');
					$kpiTeam->updateDateTime = new Expression('NOW()');
					$kpiTeam->save(false);
				}

			endforeach;
		}
		$deleteTeamKpi = KpiTeam::find()
			->where(['not in', 'teamId', $_POST["team"]])
			->andWhere(["kpiId" => $_POST["kpiId"]])
			->all();
		if (isset($deleteTeamKpi) && count($deleteTeamKpi) > 0) {
			foreach ($deleteTeamKpi as $delKpi):
				$delKpi->delete();
			endforeach;
		}
		$employeeIds = [];
		$i = 0;
		if (isset($_POST["employeeTarget"]) && count($_POST["employeeTarget"]) > 0) {
			foreach ($_POST["employeeTarget"] as $employeeId => $target):
				$kpiEmployee = KpiEmployee::find()
					->where(["employeeId" => $employeeId, "kpiId" => $_POST["kpiId"]])
					->andWhere("status!=99")
					->one();
				$target = str_replace(",", "", $target);
				if (isset($kpiEmployee) && !empty($kpiEmployee)) {
					if ($kpiEmployee->target != $target && $target > 0) {
						$kpiEmployee->target = $target;
						$kpiEmployee->updateDateTime = new Expression('NOW()');
						$kpiEmployee->save(false);
					}
					if ($target == 0 || $target == 0.00 || trim($target) == "" || $target == null) {
						KpiEmployee::deleteAll([
							"employeeId" => $employeeId,
							"kpiId" => $_POST["kpiId"]
						]);
					}
				} else {
					if ($target > 0) {
						$kpiEmployee = new KpiEmployee();
						$kpiEmployee->kpiId = $_POST["kpiId"];
						$kpiEmployee->employeeId = $employeeId;
						$kpiEmployee->target = $target;
						$kpiEmployee->result = 0;
						$kpiEmployee->status = 1;
						$kpiEmployee->createDateTime = new Expression('NOW()');
						$kpiEmployee->updateDateTime = new Expression('NOW()');
						$kpiEmployee->save(false);
					} else {
						KpiEmployee::deleteAll([
							"employeeId" => $employeeId,
							"kpiId" => $_POST["kpiId"]
						]);
					}
				}

				$employeeIds[$i] = $employeeId;
				$i++;
			endforeach;
		}
		Yii::$app->getSession()->setFlash('alert-kpi', [
			'body' => 'S A V E D ! ! !',
			'options' => [
				'id' => 'alert-success-add',
				'class' => 'alert-box-info text-center',
			]
		]);
		if (count($employeeIds) > 0) {
			$deleteEmployeeKpi = KpiEmployee::find()
				->where(['not in', 'employeeId', $employeeIds])
				->andWhere(["kpiId" => $_POST["kpiId"]])
				->all();
			if (isset($deleteEmployeeKpi) && count($deleteEmployeeKpi) > 0) {
				foreach ($deleteEmployeeKpi as $delKpi):
					$delKpi->delete();
				endforeach;
			}
		}
		return $this->redirect(Yii::$app->homeUrl . 'kpi/assign/assign/' . ModelMaster::encodeParams(['kpiId' => $_POST["kpiId"], "companyId" => $_POST["companyId"]]));
	}
	public function actionDeleteZero()
	{
		KpiEmployee::deleteAll([
			"target" => 0
		]);
		KgiEmployee::deleteAll([
			"target" => 0
		]);
	}
}