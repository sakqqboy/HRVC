<?php

namespace frontend\modules\kgi\controllers;

use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
use frontend\models\hrvc\Department;
use frontend\models\hrvc\Employee;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\KgiBranch;
use frontend\models\hrvc\KgiDepartment;
use frontend\models\hrvc\KgiEmployee;
use frontend\models\hrvc\KgiEmployeeHistory;
use frontend\models\hrvc\KgiHistory;
use frontend\models\hrvc\KgiTeam;
use frontend\models\hrvc\KgiTeamHistory;
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
		if (isset($param["kgiHistoryId"])) {
			$kgiHistoryId = $param["kgiHistoryId"];
		} else {
			$kgiHistoryId = 0;
		}
		if (isset($param["kgiTeamHistoryId"])) {
			$kgiHistoryId = KgiHistory::findKgiHistoryFromTeam($param["kgiTeamHistoryId"]);
		}

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

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiId . "&&kgiHistoryId=" . $kgiHistoryId);
		$kgiDetail = curl_exec($api);
		$kgiDetail = json_decode($kgiDetail, true);
		//throw new Exception(print_r($kgiDetail, true));

		//throw new Exception($kgiDetail["month"] . '=' . $kgiDetail["year"] . $kgiId);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-team/kgi-team-each-unit?kgiId=' . $kgiId . '&&month=' . $kgiDetail["month"] . '&&year=' . $kgiDetail["year"]);
		$kgiTeams = curl_exec($api);
		$kgiTeams = json_decode($kgiTeams, true);
		//throw new Exception(print_r($kgiTeams, true));


		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/team/company-team?id=' . $companyId);
		$teams = curl_exec($api);
		$teams = json_decode($teams, true);
		//throw new Exception(print_r($teams, true));


		//throw new Exception(print_r($param, true));
		$text = '';

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-team/kgi-team-employee?kgiId=' . $kgiId . '&&month=' . $kgiDetail["month"] . '&&year=' . $kgiDetail["year"]);
		$kgiTeamEmployee = curl_exec($api);
		$kgiTeamEmployee = json_decode($kgiTeamEmployee, true);
		//throw new Exception(print_r($kgiTeamEmployee, true));

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
			// "month" => $month,
			// "year" => $year
		]);
	}
	public function actionEmployeeInTeamTarget() //
	{
		$teamId = $_POST["teamId"];
		$kgiId = $_POST["kgiId"];
		$month = $_POST["month"];
		$year = $_POST["year"];
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
						$KgiTeamHistory = new KgiTeamHistory();
						$KgiTeamHistory->kgiTeamId = $kgiTeam->kgiTeamId;
						$KgiTeamHistory->target = $targetTeam;
						$KgiTeamHistory->month = $_POST["month"];
						$KgiTeamHistory->year = $_POST["year"];
						$KgiTeamHistory->result = 0;
						$KgiTeamHistory->status = 1;
						$KgiTeamHistory->detail = "Change Target";
						$KgiTeamHistory->createDateTime = new Expression('NOW()');
						$KgiTeamHistory->updateDateTime = new Expression('NOW()');
						$KgiTeamHistory->save(false);
					}
				} else {
					$kgiTeam = new KgiTeam();
					$kgiTeam->kgiId = $_POST["kgiId"];
					$kgiTeam->teamId = $teamId;
					$kgiTeam->target = $targetTeam;
					$kgiTeam->month = $_POST["month"];
					$kgiTeam->year = $_POST["year"];
					$kgiTeam->result = 0;
					$kgiTeam->status = 1;
					$kgiTeam->createDateTime = new Expression('NOW()');
					$kgiTeam->updateDateTime = new Expression('NOW()');
					if ($kgiTeam->save(false)) {
						$KgiTeamHistory = new KgiTeamHistory();
						$kgiTeamId = Yii::$app->db->lastInsertID;
						$KgiTeamHistory->kgiTeamId = $kgiTeamId;
						$KgiTeamHistory->target = $targetTeam;
						$KgiTeamHistory->month = $_POST["month"];
						$KgiTeamHistory->year = $_POST["year"];
						$KgiTeamHistory->result = 0;
						$KgiTeamHistory->status = 1;
						$KgiTeamHistory->createDateTime = new Expression('NOW()');
						$KgiTeamHistory->updateDateTime = new Expression('NOW()');
						$KgiTeamHistory->save(false);
					}
				}
				$team = Team::find()->select('departmentId')->where(["teamId" => $teamId])->asArray()->one();
				$departmentId = $team["departmentId"];
				$department = Department::find()->select('branchId')->where(["departmentId" => $departmentId])->asArray()->one();
				$branchId = $department["branchId"];
				$kgiDepartment = KgiDepartment::find()->where(["kgiId" => $_POST["kgiId"], "departmentId" => $departmentId, "status" => 1])->one();
				if (!isset($kgiDepartment) || empty($kgiDepartment)) {
					$newKgiDepartment = new KgiDepartment();
					$newKgiDepartment->kgiId = $_POST["kgiId"];
					$newKgiDepartment->departmentId = $departmentId;
					$newKgiDepartment->status = 1;
					$newKgiDepartment->createDateTime = new Expression('NOW()');
					$newKgiDepartment->updateDateTime = new Expression('NOW()');
					$newKgiDepartment->save(false);
				}
				$kgiBranch = KgiBranch::find()->where(["kgiId" => $_POST["kgiId"], "branchId" => $branchId, "status" => 1])->one();
				if (!isset($kgiBranch) || empty($kgiBranch)) {
					$newKgiBranch = new KgiBranch();
					$newKgiBranch->kgiId = $_POST["kgiId"];
					$newKgiBranch->branchId = $branchId;
					$newKgiBranch->status = 1;
					$newKgiBranch->createDateTime = new Expression('NOW()');
					$newKgiBranch->updateDateTime = new Expression('NOW()');
					$newKgiBranch->save(false);
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
					$delKgi->status = 99;
					$delKgi->createrId = Yii::$app->user->id;
					$delKgi->updateDateTime = new Expression('NOW()');
					$delKgi->save(false);
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
				$result = 0;
				if (isset($kgiEmployee) && !empty($kgiEmployee)) {
					$result = $kgiEmployee->result;
					if ($kgiEmployee->target != $target && trim($target) != "" && $target != null) {
						$kgiEmployee->target = $target;
						$kgiEmployee->updateDateTime = new Expression('NOW()');
						if ($kgiEmployee->save(false)) {
							$KgiEmployeeHistory = new KgiEmployeeHistory();
							$kgiEmployeeId = Yii::$app->db->lastInsertID;
							$KgiEmployeeHistory->kgiEmployeeId = $kgiEmployeeId;
							$KgiEmployeeHistory->target = $target;
							$KgiEmployeeHistory->month = $_POST["month"];
							$KgiEmployeeHistory->year = $_POST["year"];
							$KgiEmployeeHistory->result = $result;
							$KgiEmployeeHistory->status = 1;
							$KgiEmployeeHistory->createDateTime = new Expression('NOW()');
							$KgiEmployeeHistory->updateDateTime = new Expression('NOW()');
							$KgiEmployeeHistory->save(false);
						}
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
						$kgiEmployee->month = $_POST["month"];
						$kgiEmployee->year = $_POST["year"];
						$kgiEmployee->result = $result;
						$kgiEmployee->status = 1;
						$kgiEmployee->createDateTime = new Expression('NOW()');
						$kgiEmployee->updateDateTime = new Expression('NOW()');
						if ($kgiEmployee->save(false)) {
							$KgiEmployeeHistory = new KgiEmployeeHistory();
							$kgiEmployeeId = Yii::$app->db->lastInsertID;
							$KgiEmployeeHistory->kgiEmployeeId = $kgiEmployeeId;
							$KgiEmployeeHistory->target = $target;
							$KgiEmployeeHistory->month = $_POST["month"];
							$KgiEmployeeHistory->year = $_POST["year"];
							$KgiEmployeeHistory->result = $result;
							$KgiEmployeeHistory->status = 1;
							$KgiEmployeeHistory->createDateTime = new Expression('NOW()');
							$KgiEmployeeHistory->updateDateTime = new Expression('NOW()');
							$KgiEmployeeHistory->save(false);
						}
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
					// $delKgi->delete();
					$delKgi->status = 99;
					$delKgi->createrId = Yii::$app->user->id;
					$delKgi->updateDateTime = new Expression('NOW()');
					$delKgi->save(false);
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
