<?php

namespace frontend\modules\kgi\controllers;

use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
use frontend\models\hrvc\Employee;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\KgiEmployee;
use frontend\models\hrvc\KgiTeam;
use frontend\models\hrvc\Team;
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
		// if ($isManager == 0) {
		// 	return $this->redirect(Yii::$app->homeUrl . 'kgi/management/index');
		// }
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		$role = UserRole::userRight();
		if ($role < 3) {
			return $this->redirect(Yii::$app->homeUrl . 'kgi/management/index');
		}
		return true;
	}
	public function actionAssign($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$role = UserRole::userRight();
		//throw new Exception(print_r($param, true));
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
		$kgiId = $param["kgiId"];
		$companyId = $param["companyId"];
		$month = $param["month"];
		$year = $param["year"];

		$teamId = Team::userTeam(Yii::$app->user->id);
		$url = $param["url"] ?? Yii::$app->request->referrer;
		//$save = $param["save"];
		$role = UserRole::userRight();
		if ($role < 3) {
			return $this->redirect(Yii::$app->homeUrl . 'kgi/management/index');
		}

		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-team/kgi-team?kgiId=' . $kgiId . '&&month=' . $month . '&&year=' . $year);
		$kgiTeams = curl_exec($api);
		$kgiTeams = json_decode($kgiTeams, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/team/company-team?id=' . $companyId);
		$teams = curl_exec($api);
		$teams = json_decode($teams, true);
		//throw new Exception(print_r($teams, true));

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiId . "&&kgiHistoryId=0");
		$kgiDetail = curl_exec($api);
		$kgiDetail = json_decode($kgiDetail, true);
		//throw new Exception(print_r($param, true));
		$text = '';

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-team/kgi-team-employee?kgiId=' . $kgiId);
		$kgiTeamEmployee = curl_exec($api);
		$kgiTeamEmployee = json_decode($kgiTeamEmployee, true);

		curl_close($api);
		return $this->render('assign', [
			"role" => $role,
			"kgiTeams" => $kgiTeams,
			"kgiDetail" => $kgiDetail,
			"kgiId" => $kgiId,
			"teams" => $teams,
			"text" => $text,
			"kgiTeamEmployee" => $kgiTeamEmployee,
			"companyId" => $companyId,
			"userTeamId" => $teamId,
			"url" => $url,
			"month" => $month,
			"year" => $year
		]);
	}
	public function actionEmployeeInTeamTarget() //
	{
		$teamId = $_POST["teamId"];
		$kgiId = $_POST["kgiId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-team/each-team-employee-kgi?kgiId=' . $kgiId . '&&teamId=' . $teamId);
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
	public function actionUpdateTeamKgi()
	{
		if (isset($_POST["team"]) && count($_POST["team"]) > 0) {
			foreach ($_POST["team"] as $teamId => $team):
				$kgiTeam = KgiTeam::find()
					->where(["kgiId" => $_POST["kgiId"], "teamId" => $teamId])
					->andWhere("status!=99")
					->one();
				$targetTeam = str_replace(",", "", $_POST["teamTarget"][$teamId]);
				if (isset($kgiTeam) && !empty($kgiTeam)) {
					if ($kgiTeam->target != $targetTeam) {
						$kgiTeam->target = $targetTeam;
						$kgiTeam->updateDateTime = new Expression('NOW()');
						$kgiTeam->save(false);
					}
				} else {
					$kgiTeam = new KgiTeam();
					$kgiTeam->kgiId = $_POST["kgiId"];
					$kgiTeam->teamId = $teamId;
					$kgiTeam->target = $targetTeam;
					$kgiTeam->result = 0;
					$kgiTeam->status = 1;
					$kgiTeam->createDateTime = new Expression('NOW()');
					$kgiTeam->updateDateTime = new Expression('NOW()');
					$kgiTeam->save(false);
				}

			endforeach;
		}
		if (!empty($_POST["team"])) {
			$deleteTeamKgi = KgiTeam::find()
				->where(['not in', 'teamId', $_POST["team"]])
				->andWhere(["kgiId" => $_POST["kgiId"]])
				->all();
			if (isset($deleteTeamKgi) && count($deleteTeamKgi) > 0) {
				foreach ($deleteTeamKgi as $delKgi):
					$delKgi->delete();
				endforeach;
			}
		}
		$employeeIds = [];
		$i = 0;
		if (isset($_POST["employeeTarget"]) && count($_POST["employeeTarget"]) > 0) {
			foreach ($_POST["employeeTarget"] as $employeeId => $target):
				$kgiEmployee = KgiEmployee::find()
					->where(["employeeId" => $employeeId, "kgiId" => $_POST["kgiId"]])
					->andWhere("status!=99")
					->one();
				// throw new Exception(print_r($_POST["employeeTarget"], true));

				$target = str_replace(",", "", $target);

				if (isset($kgiEmployee) && !empty($kgiEmployee)) {
					if ($kgiEmployee->target != $target && trim($target) != "" && $target != null) {
						$kgiEmployee->target = $target;
						$kgiEmployee->updateDateTime = new Expression('NOW()');
						$kgiEmployee->save(false);
					}
					if (trim($target) == "" || $target == null) {
						KgiEmployee::deleteAll([
							"employeeId" => $employeeId,
							"kgiId" => $_POST["kgiId"]
						]);
					}
				} else {
					if (trim($target) != "" && $target != null) {
						$kgiEmployee = new KgiEmployee();
						$kgiEmployee->kgiId = $_POST["kgiId"];
						$kgiEmployee->employeeId = $employeeId;
						$kgiEmployee->target = $target;
						$kgiEmployee->result = 0;
						$kgiEmployee->status = 1;
						$kgiEmployee->createDateTime = new Expression('NOW()');
						$kgiEmployee->updateDateTime = new Expression('NOW()');
						$kgiEmployee->save(false);
					} else {
						KgiEmployee::deleteAll([
							"employeeId" => $employeeId,
							"kgiId" => $_POST["kgiId"]
						]);
					}
				}

				$employeeIds[$i] = $employeeId;
				$i++;
			endforeach;
		}
		if (count($employeeIds) > 0) {
			$deleteEmployeeKgi = KgiEmployee::find()
				->where(['not in', 'employeeId', $employeeIds])
				->andWhere(["kgiId" => $_POST["kgiId"]])
				->all();
			if (isset($deleteEmployeeKgi) && count($deleteEmployeeKgi) > 0) {
				foreach ($deleteEmployeeKgi as $delKgi):
					$delKgi->delete();
				endforeach;
			}
		}
		Yii::$app->getSession()->setFlash('alert-kgi', [
			'body' => 'S A V E D ! ! !',
			'options' => [
				'id' => 'alert-success-add',
				'class' => 'alert-box-info text-center',
			]
		]);
		return $this->redirect(Yii::$app->homeUrl . 'kgi/assign/assign/' . ModelMaster::encodeParams([
			'kgiId' => $_POST["kgiId"],
			"companyId" => $_POST["companyId"],
			"url" => $_POST["url"],
			"month" => $_POST["month"],
			"year" => $_POST["year"]
		]));
	}
}
