<?php

namespace frontend\modules\kpi\controllers;

use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
use frontend\models\hrvc\Branch;
use frontend\models\hrvc\Company;
use frontend\models\hrvc\Department;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\KgiEmployee;
use frontend\models\hrvc\KpiBranch;
use frontend\models\hrvc\KpiDepartment;
use frontend\models\hrvc\KpiEmployee;
use frontend\models\hrvc\KpiEmployeeHistory;
use frontend\models\hrvc\KpiHistory;
use frontend\models\hrvc\KpiTeam;
use frontend\models\hrvc\KpiTeamHistory;
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
		if (Yii::$app->user->id == '') {
			Yii::$app->response->redirect(Yii::$app->homeUrl . 'site/login');
			return false;
		}
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			Yii::$app->response->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
			return false;
		}
		$role = UserRole::userRight();
		if ($role < 3) {
			Yii::$app->response->redirect(Yii::$app->homeUrl . 'kpi/management/index');
			return false;
		}
		return parent::beforeAction($action);
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
		if (isset($param["kpiHistoryId"])) {
			$kpiHistoryId = $param["kpiHistoryId"];
		} else {
			$kpiHistoryId = 0;
		}
		if (isset($param["kpiTeamHistoryId"])) {
			$kpiHistoryId = KpiHistory::findKpiHistoryFromTeam($param["kpiTeamHistoryId"]);
		}

		$role = UserRole::userRight();
		$teamId = Team::userTeam(Yii::$app->user->id);
		$url = $param["url"] ?? Yii::$app->request->referrer;
		if ($role < 3) {
			return $this->redirect(Yii::$app->homeUrl . 'kpi/management/index');
		}

		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/kpi-detail?id=' . $kpiId . '&&kpiHistoryId=' . $kpiHistoryId);
		$kpiDetail = curl_exec($api);
		$kpiDetail = json_decode($kpiDetail, true);
		$text = '';
		//throw new Exception(print_r($kpiDetail, true));

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-team/kpi-team-each-unit?kpiId=' . $kpiId . '&&month=' . $kpiDetail["month"] . '&&year=' . $kpiDetail["year"]);
		$kpiTeams = curl_exec($api);
		$kpiTeams = json_decode($kpiTeams, true);
		//throw new Exception(print_r($kpiTeams, true));

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/team/company-team?id=' . $companyId);
		$teams = curl_exec($api);
		$teams = json_decode($teams, true);
		//throw new Exception(print_r($teams, true));

		// throw new Exception('Unexpected API Response: ' . $kpiId);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-team/kpi-team-employee?kpiId=' . $kpiId . '&&month=' . $kpiDetail["month"] . '&&year=' . $kpiDetail["year"]);
		$kpiTeamEmployee = curl_exec($api);
		$kpiTeamEmployee = json_decode($kpiTeamEmployee, true);
		//throw new Exception($kpiId);

		// throw new Exception(print_r($kpiId, true));	
		// throw new Exception(print_r($kpiTeams, true));

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
		// throw new Exception(print_r($kpiTeamEmployee, true));	

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/all-company');
		$allCompany = curl_exec($api);
		$allCompany = json_decode($allCompany, true);

		curl_close($api);

		$countAllCompany = 0;
		if (count($allCompany) > 0) {
			$countAllCompany = count($allCompany);
			$companyPic = Company::randomPic($allCompany, 3);
		}
		$totalBranch = Branch::totalBranch();
		return $this->render('assign', [
			"role" => $role,
			"kpiTeams" => $kpiTeams,
			"kpiDetail" => $kpiDetail,
			"kpiId" => $kpiId,
			"teams" => $teams,
			"text" => $text,
			"kpiTeamEmployee" => $kpiTeamEmployee,
			"companyId" => $companyId,
			"userTeamId" => $teamId,
			"url" => $url,
			"allCompany" => $countAllCompany,
			"companyPic" => $companyPic,
			"totalBranch" => $totalBranch,
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


		curl_close($api);

		// throw new Exception(print_r($employeeTeamTarget, true));


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
						$kpiTeamHistory = new KpiTeamHistory();
						$kpiTeamHistory->kpiTeamId = $kpiTeam->kpiTeamId;
						$kpiTeamHistory->target = $targetTeam;
						$kpiTeamHistory->month = $_POST["month"];
						$kpiTeamHistory->year = $_POST["year"];
						$kpiTeamHistory->result = 0;
						$kpiTeamHistory->status = 1;
						$kpiTeamHistory->detail = "Change Target";
						$kpiTeamHistory->createDateTime = new Expression('NOW()');
						$kpiTeamHistory->updateDateTime = new Expression('NOW()');
						$kpiTeamHistory->save(false);
					}
				} else {
					//ยังไม่มีเพิ่มเดือนละปี
					$kpiTeam = new KpiTeam();
					$kpiTeam->kpiId = $_POST["kpiId"];
					$kpiTeam->teamId = $teamId;
					$kpiTeam->target = $targetTeam;
					$kpiTeam->month = $_POST["month"];
					$kpiTeam->year = $_POST["year"];
					$kpiTeam->result = 0;
					$kpiTeam->status = 1;
					$kpiTeam->createDateTime = new Expression('NOW()');
					$kpiTeam->updateDateTime = new Expression('NOW()');
					if ($kpiTeam->save(false)) {
						$kpiTeamHistory = new KpiTeamHistory();
						$kpiTeamId = Yii::$app->db->lastInsertID;
						$kpiTeamHistory->kpiTeamId = $kpiTeamId;
						$kpiTeamHistory->target = $targetTeam;
						$kpiTeamHistory->month = $_POST["month"];
						$kpiTeamHistory->year = $_POST["year"];
						$kpiTeamHistory->result = 0;
						$kpiTeamHistory->status = 1;
						$kpiTeamHistory->createDateTime = new Expression('NOW()');
						$kpiTeamHistory->updateDateTime = new Expression('NOW()');
						$kpiTeamHistory->save(false);
					}
					//ล่าสุด
				}

				$departmentId = Team::find()->select('departmentId')->where(['teamId' => $teamId])->andWhere("status!=99")->one();
				$department = KpiDepartment::find()->where(['kpiId' => $_POST["kpiId"], 'departmentId' => $departmentId->departmentId])->andWhere("status!=99")->one();
				if (empty($department)) {
					$KpiDepartment = new KpiDepartment();
					$KpiDepartment->kpiId = $_POST["kpiId"];
					$KpiDepartment->departmentId = $departmentId->departmentId;
					$KpiDepartment->status = 1;
					$KpiDepartment->createDateTime = new Expression('NOW()');
					$KpiDepartment->updateDateTime = new Expression('NOW()');
					$KpiDepartment->save(false);
				}

				$branchId = Department::find()->select('branchId')->where(['departmentId' => $departmentId->departmentId])->andWhere("status!=99")->one();
				$branch = KpiBranch::find()->where(['kpiId' => $_POST["kpiId"], 'branchId' => $branchId->branchId])->andWhere("status!=99")->one();
				if (empty($branch)) {
					$KpiBranch = new KpiBranch();
					$KpiBranch->kpiId = $_POST["kpiId"];
					$KpiBranch->branchId = $branchId->branchId;
					$KpiBranch->status = 1;
					$KpiBranch->createDateTime = new Expression('NOW()');
					$KpiBranch->updateDateTime = new Expression('NOW()');
					$KpiBranch->save(false);
				}

			endforeach;
		}
		$deleteTeamKpi = KpiTeam::find()
			->where(['not in', 'teamId', $_POST["team"]])
			->andWhere(["kpiId" => $_POST["kpiId"]])
			->all();
		if (isset($deleteTeamKpi) && count($deleteTeamKpi) > 0) {
			foreach ($deleteTeamKpi as $delKpi):
				$delKpi->status = 99;
				$delKpi->createrId = Yii::$app->user->id;
				$delKpi->updateDateTime = new Expression('NOW()');
				$delKpi->save(false);

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
					//เพิ่มเดือนละปี
					if ($kpiEmployee->target != $target && trim($target) != "" && $target != null) {
						$kpiEmployee->target = $target;
						// $kpiEmployee->month = $_POST["month"];
						// $kpiEmployee->year = $_POST["year"];
						$kpiEmployee->updateDateTime = new Expression('NOW()');
						$kpiEmployee->save(false);
					}
					if (trim($target) == "" || $target == null) {
						KpiEmployee::deleteAll([
							"employeeId" => $employeeId,
							"kpiId" => $_POST["kpiId"]
						]);
					}
				} else {
					if (trim($target) != "" && $target != null) {
						//เพิ่มเดือนละปี
						$kpiEmployee = new KpiEmployee();
						$kpiEmployee->kpiId = $_POST["kpiId"];
						$kpiEmployee->employeeId = $employeeId;
						$kpiEmployee->target = $target;
						$kpiEmployee->month = $_POST["month"];
						$kpiEmployee->year = $_POST["year"];
						$kpiEmployee->result = 0;
						$kpiEmployee->status = 1;
						$kpiEmployee->createDateTime = new Expression('NOW()');
						$kpiEmployee->updateDateTime = new Expression('NOW()');
						if ($kpiEmployee->save(false)) {
							$kpiEmployeeHistory = new KpiEmployeeHistory();
							$kpiEmployeeId = Yii::$app->db->lastInsertID;
							$kpiEmployeeHistory->kpiEmployeeId = $kpiEmployeeId;
							$kpiEmployeeHistory->target = $target;
							$kpiEmployeeHistory->month = $_POST["month"];
							$kpiEmployeeHistory->year = $_POST["year"];
							$kpiEmployeeHistory->result = 0;
							$kpiEmployeeHistory->status = 1;
							$kpiEmployeeHistory->createDateTime = new Expression('NOW()');
							$kpiEmployeeHistory->updateDateTime = new Expression('NOW()');
							$kpiEmployeeHistory->save(false);
						}
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
					// $delKpi->delete();
					$delKpi->status = 99;
					$delKpi->createrId = Yii::$app->user->id;
					$delKpi->updateDateTime = new Expression('NOW()');
					$delKpi->save(false);
				endforeach;
			}
		}
		return $this->redirect(Yii::$app->homeUrl . 'kpi/assign/assign/' . ModelMaster::encodeParams(['kpiId' => $_POST["kpiId"], "companyId" => $_POST["companyId"], "url" => $_POST["url"]]));
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
