<?php

namespace frontend\modules\kgi\controllers;

use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
use FFI\Exception as FFIException;
use frontend\models\hrvc\Employee;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\Kgi;
use frontend\models\hrvc\KgiEmployee;
use frontend\models\hrvc\KgiEmployeeHistory;
use frontend\models\hrvc\Team;
use frontend\models\hrvc\Unit;
use frontend\models\hrvc\User;
use frontend\models\hrvc\UserRole;
use SebastianBergmann\Type\NullType;
use Yii;
use yii\db\Expression;
use yii\web\Controller;

// header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
// header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
// header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
// header("Cache-Control: post-check=0, pre-check=0", false);
// header("Pragma: no-cache");
class KgiPersonalController extends Controller
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
	public function actionIndivisualSetting($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$kgiId = $param["kgiId"];
		$role = UserRole::userRight();
		if ($role < 3) {
			return $this->redirect(Yii::$app->homeUrl . 'kgi/management/index');
		}
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-personal/kgi-team-employee?kgiId=' . $kgiId);
		$kgiEmployees = curl_exec($api);
		$kgiEmployees = json_decode($kgiEmployees, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiId);
		$kgiDetail = curl_exec($api);
		$kgiDetail = json_decode($kgiDetail, true);

		curl_close($api);

		//throw new Exception(print_r($kgiEmployees, true));
		return $this->render('indivisual_setting', [
			"kgiDetail" => $kgiDetail,
			"kgiId" => $kgiId,
			"kgiEmployees" => $kgiEmployees,
			"role" => $role
		]);
	}
	public function actionSetPersonalTarget()
	{
		if (isset($_POST["kgiId"])) {
			if (isset($_POST["target"]) && count($_POST["target"])) {
				foreach ($_POST["target"] as $employeeId => $target) :
					if ($target != '') {
						$target = str_replace(",", "", $target);
						$kgiEmployee = KgiEmployee::find()
							->where(["kgiId" => $_POST["kgiId"], "employeeId" => $employeeId])
							->one();
						if (isset($kgiEmployee) && !empty($kgiEmployee)) {
							$kgiEmployee->target = $target;
							$kgiEmployee->updateDateTime = new Expression('NOW()');
							$kgiEmployee->remark = $_POST["remark"][$employeeId];
							$kgiEmployee->createrId = Yii::$app->user->id;
							$kgiEmployee->save(false);

							$kgiEmployeeHistory = new KgiEmployeeHistory();
							$kgiEmployeeHistory->kgiEmployeeId = $kgiEmployee->kgiEmployeeId;
							$kgiEmployeeHistory->target =  $target;
							$kgiEmployeeHistory->result = $kgiEmployee->result;;
							$kgiEmployeeHistory->createrId = Yii::$app->user->id;
							$kgiEmployeeHistory->status = 1;
							$kgiEmployeeHistory->createDateTime = new Expression('NOW()');
							$kgiEmployeeHistory->updateDateTime = new Expression('NOW()');
							//}
							$kgiEmployeeHistory->save(false);
						} else {
							if ($target != '0.00') {
								$kgiEmployee = new KgiEmployee();
								$kgiEmployee->target = $target;
								$kgiEmployee->kgiId = $_POST["kgiId"];
								$kgiEmployee->remark = $_POST["remark"][$employeeId];
								$kgiEmployee->employeeId = $employeeId;
								$kgiEmployee->updateDateTime = new Expression('NOW()');
								$kgiEmployee->createrId = Yii::$app->user->id;
								$kgiEmployee->save(false);
								$kgiEmployeeId = Yii::$app->db->lastInsertID;
								$kgiEmployeeHistory = new KgiEmployeeHistory();
								$kgiEmployeeHistory->kgiEmployeeId = $kgiEmployeeId;
								$kgiEmployeeHistory->target =  $target;
								$kgiEmployeeHistory->result = null;
								$kgiEmployeeHistory->createrId = Yii::$app->user->id;
								$kgiEmployeeHistory->status = 1;
								$kgiEmployeeHistory->createDateTime = new Expression('NOW()');
								$kgiEmployeeHistory->updateDateTime = new Expression('NOW()');
								//}
								$kgiEmployeeHistory->save(false);
							}
						}
					}
				endforeach;
			}
		}
		return $this->redirect(Yii::$app->homeUrl . 'kgi/management/grid');
	}
	public function actionIndividualKgi()
	{
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		$teams = [];
		$role = UserRole::userRight();
		$isAdmin = UserRole::isAdmin();
		$userBranchId = User::userBranchId();
		$adminId = '';
		$gmId = '';
		$teamLeaderId = '';
		$managerId = '';
		$supervisorId = '';
		$staffId = Yii::$app->user->id;
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$companies = curl_exec($api);
		$companies = json_decode($companies, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/unit/all-unit');
		$units = curl_exec($api);
		$units = json_decode($units, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-personal/employee-kgi?userId=' . Yii::$app->user->id . '&&role=' . $role);
		$kgis = curl_exec($api);
		$kgis = json_decode($kgis, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-personal/wait-for-approve?branchId=' . $userBranchId . '&&isAdmin=' . $isAdmin);
		$waitForApprove = curl_exec($api);
		$waitForApprove = json_decode($waitForApprove, true);

		if ($role == 3) {
			$em = Employee::employeeDetailByUserId(Yii::$app->user->id);
			if (isset($em) && !empty($em)) {
				curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/branch-team?id=' . $em["branchId"]);
				$teams = curl_exec($api);
				$teams = json_decode($teams, true);
			}
			//throw new Exception(print_r($teams, true));
		}
		curl_close($api);

		$months = ModelMaster::monthFull(1);
		$isManager = UserRole::isManager();

		// throw new Exception(print_r($waitForApprove,true));

		return $this->render('index', [
			"units" => $units,
			"companies" => $companies,
			"teams" => $teams,
			"months" => $months,
			"isManager" => $isManager,
			"role" => $role,
			"kgis" => $kgis,
			"userId" => Yii::$app->user->id,
			"month" => null,
			"status" => null,
			"year" => null,
			"companyId" => null,
			"branchId" => null,
			"teamId" => null,
			"waitForApprove" => $waitForApprove

		]);
	}
	public function actionIndividualKgiGrid()
	{
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		$role = UserRole::userRight();
		$adminId = '';
		$gmId = '';
		$teamLeaderId = '';
		$managerId = '';
		$supervisorId = '';
		$staffId = Yii::$app->user->id;
		$isAdmin = UserRole::isAdmin();
		$userBranchId = User::userBranchId();
		$teams = [];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$companies = curl_exec($api);
		$companies = json_decode($companies, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/unit/all-unit');
		$units = curl_exec($api);
		$units = json_decode($units, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-personal/employee-kgi?userId=' . Yii::$app->user->id . '&&role=' . $role);
		//throw new exception('kgi/kgi-personal/employee-kgi?userId=' . Yii::$app->user->id . '&&role=' . $role);
		$kgis = curl_exec($api);
		$kgis = json_decode($kgis, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-personal/wait-for-approve?branchId=' . $userBranchId . '&&isAdmin=' . $isAdmin);
		$waitForApprove = curl_exec($api);
		$waitForApprove = json_decode($waitForApprove, true);

		if ($role == 3) {
			$em = Employee::employeeDetailByUserId(Yii::$app->user->id);
			if (isset($em) && !empty($em)) {
				curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/branch-team?id=' . $em["branchId"]);
				$teams = curl_exec($api);
				$teams = json_decode($teams, true);
			}
			//throw new Exception(print_r($teams, true));
		}

		curl_close($api);

		$months = ModelMaster::monthFull(1);
		$isManager = UserRole::isManager();
		return $this->render('individual_kgi_grid', [
			"units" => $units,
			"companies" => $companies,
			"teams" => $teams,
			"months" => $months,
			"isManager" => $isManager,
			"role" => $role,
			"kgis" => $kgis,
			"userId" => Yii::$app->user->id,
			"companyId" => null,
			"branchId" => null,
			"teamId" => null,
			"month" => null,
			"status" => null,
			"year" => null,
			"waitForApprove" => $waitForApprove

		]);
	}
	public function actionUpdatePersonalKgi($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$kgiEmployeeId = $param["kgiEmployeeId"];

		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-personal/kgi-employee-detail?kgiEmployeeId=' . $kgiEmployeeId . '&&kgiEmployeeHistoryId=0');
		$kgiEmployeeDetail = curl_exec($api);
		$kgiEmployeeDetail = json_decode($kgiEmployeeDetail, true);

		curl_close($api);

		$months = ModelMaster::monthFull(1);
		// throw new Exception(print_r($kgiEmployeeId, true));
		return $this->render('update_personal_kgi', [
			"kgiEmployeeId" => $kgiEmployeeId,
			"kgiEmployeeDetail" => $kgiEmployeeDetail,
			"months" => $months
		]);
	}
	public function actionSaveUpdatePersonalKgi()
	{
		if (isset($_POST["kgiEmployeeId"])) {
			$history = KgiEmployeeHistory::find()
				->where(["kgiEmployeeId" => $_POST["kgiEmployeeId"], "status" => [1, 2, 4]])
				->orderBy('kgiEmployeeHistoryId DESC')
				->one();
			$status = $_POST["status"];
			if (isset($history) && !empty($history)) {
				//   throw new Exception(print_r($history,true));
				if (!empty($history["nextCheckDate"])) {
					$nextCheckDateArr = explode(' ', $history["nextCheckDate"]);
					$nextCheckDate = $nextCheckDateArr[0];
				} else {
					$nextCheckDate = Null;
				}

				$lastCheck = $history->nextCheckDate;
				if ($history->target == str_replace(",", "", $_POST["target"]) && $history->result == str_replace(",", "", $_POST["result"]) && $nextCheckDate == $_POST["nextCheckDate"]) {
					$history->status = $_POST["status"];
					$history->updateDateTime = new Expression('NOW()');
				} else {
					if ($history->target != str_replace(",", "", $_POST["target"]) && $history->target != null) {
						$role = UserRole::userRight();
						if ($role <= 3) {
							$status = 88;
						}
					}
					$history = KgiEmployeeHistory::find()
						->where(["kgiEmployeeId" => $_POST["kgiEmployeeId"], "status" => 88])
						->one();
					if (!isset($history) || empty($history)) {
						$history = new KgiEmployeeHistory();
					}

					$history->kgiEmployeeId = $_POST["kgiEmployeeId"];
					$history->target = (float)str_replace(",", "", $_POST["target"]);
					$history->result = (float)str_replace(",", "", $_POST["result"]);
					$history->detail = $_POST["detail"];
					$history->nextCheckDate = $_POST["nextCheckDate"] . ' 00:00:00';
					$history->lastCheckDate = $lastCheck;
					$history->month = $_POST["month"];
					$history->year = $_POST["year"];
					$history->status = $status;
					$history->createDateTime = new Expression('NOW()');
					$history->updateDateTime = new Expression('NOW()');
				}
			} else {
				$history = new KgiEmployeeHistory();
				$history->kgiEmployeeId = $_POST["kgiEmployeeId"];
				$history->target = (float)str_replace(",", "", $_POST["target"]);
				$history->result = (float)str_replace(",", "", $_POST["result"]);
				$history->detail = $_POST["detail"];
				$history->nextCheckDate = $_POST["nextCheckDate"] . ' 00:00:00';
				$history->month = $_POST["month"];
				$history->year = $_POST["year"];
				$history->status = $_POST["status"];
				$history->createDateTime = new Expression('NOW()');
				$history->updateDateTime = new Expression('NOW()');
			}
			$kgiEmployee = KgiEmployee::find()
				->where(["kgiEmployeeId" => $_POST["kgiEmployeeId"]])
				->one();
			if ($status != 88) {
				$kgiEmployee->target = (float)str_replace(",", "", $_POST["target"]);
				$kgiEmployee->result = (float)str_replace(",", "", $_POST["result"]);
			} else {
				$kgiEmployee->status = 1;
			}
			$kgiEmployee->month = $_POST["month"];
			$kgiEmployee->year = $_POST["year"];
			$kgiEmployee->updateDateTime = new Expression('NOW()');
			$kgiEmployee->save(false);
			$history->createrId = Yii::$app->user->id;
			if ($history->save(false)) {
				if ($_POST["url"] != Yii::$app->request->referrer) {
					return $this->redirect($_POST["url"]);
				} else {
					return $this->redirect(Yii::$app->homeUrl . 'kgi/kgi-personal/individual-kgi-grid');
				}
			}
		} else {
			return $this->redirect(Yii::$app->homeUrl . 'kgi/kgi-personal/individual-kgi-grid');
		}
	}
	public function actionViewPersonalKgi($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		//   throw new Exception(print_r($param,true));
		$kgiEmployeeId = $param["kgiEmployeeId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-personal/kgi-employee-detail?kgiEmployeeId=' . $kgiEmployeeId . '&&kgiEmployeeHistoryId=0');
		$kgiEmployeeDetail = curl_exec($api);
		$kgiEmployeeDetail = json_decode($kgiEmployeeDetail, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-personal/kgi-employee-history?kgiEmployeeId=' . $kgiEmployeeId);
		$kgiEmployeeHistory = curl_exec($api);
		$kgiEmployeeHistory = json_decode($kgiEmployeeHistory, true);

		curl_close($api);
		return $this->render('personal_view', [
			"kgiEmployeeId" => $kgiEmployeeId,
			"kgiEmployeeDetail" => $kgiEmployeeDetail,
			"kgiEmployeeHistory" => $kgiEmployeeHistory
		]);
	}
	public function actionEmployeeProgress()
	{
		$kgiId = $_POST["kgiId"];
		$employeeId = $_POST["employeeId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/employee/employee-detail?id=' . $employeeId);
		$employeeDetail = curl_exec($api);
		$employeeDetail = json_decode($employeeDetail, true);


		$kgi = Kgi::find()->select('kgiName')->where(["kgiId" => $kgiId])->asArray()->one();

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-personal/kgi-employee-history-view?kgiId=' . $kgiId . '&&employeeId=' . $employeeId);
		$kgiEmployeeHistory = curl_exec($api);
		$kgiEmployeeHistory = json_decode($kgiEmployeeHistory, true);
		curl_close($api);
		//throw new Exception(print_r($kgiTeamHistory, true));
		$teamText = $this->renderAjax('employee_progress', ["kgiEmployeeHistory" => $kgiEmployeeHistory]);
		//throw new Exception($teamText);
		$res["employeeName"] = $employeeDetail["employeeFirstname"] . ' ' . $employeeDetail["employeeSurename"];
		$res["kgiName"] = $kgi["kgiName"];
		$res["history"] = $teamText;
		return json_encode($res);
	}
	public function actionDeleteKgiEmployee()
	{
		$kgiEmployeeId = $_POST["kgiEmployeeId"];
		// throw new Exception($kgiEmployeeId);
		KgiEmployee::updateAll(["status" => 99], ["kgiEmployeeId" => $kgiEmployeeId]);
		KgiEmployeeHistory::updateAll(["status" => 99], ["kgiEmployeeId" => $kgiEmployeeId]);
		$res["status"] = true;
		return json_encode($res);
	}
	public function actionSearchKgiPersonal()
	{

		$companyId = isset($_POST["companyId"]) && $_POST["companyId"] != null ? $_POST["companyId"] : null;
		$branchId = isset($_POST["branchId"]) && $_POST["branchId"] != null ? $_POST["branchId"] : null;
		$teamId = isset($_POST["teamId"]) && $_POST["teamId"] != null ? $_POST["teamId"] : null;
		$employeeId = isset($_POST["employeeId"]) && $_POST["employeeId"] != null ? $_POST["employeeId"] : null;
		$month = isset($_POST["month"]) && $_POST["month"] != null ? $_POST["month"] : null;
		$status = isset($_POST["status"]) && $_POST["status"] != null ? $_POST["status"] : null;
		$year = isset($_POST["year"]) && $_POST["year"] != null ? $_POST["year"] : null;
		$type = $_POST["type"];
		return $this->redirect(Yii::$app->homeUrl . 'kgi/kgi-personal/kgi-personal-search-result/' . ModelMaster::encodeParams([
			"companyId" => $companyId,
			"branchId" => $branchId,
			"employeeId" => $employeeId,
			"teamId" => $teamId,
			"month" => $month,
			"status" => $status,
			"year" => $year,
			"type" => $type
		]));
	}
	public function actionKgiPersonalSearchResult($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$isAdmin = UserRole::isAdmin();
		$userBranchId = User::userBranchId();
		$month = $param["month"];
		$status = $param["status"];
		$year = $param["year"];
		$type = $param["type"];
		$employeeId = $param["employeeId"];
		$companyId = $param["companyId"];
		$branchId = $param["branchId"];
		$teamId = $param["teamId"];
		$employees = [];
		$teams = [];
		$role = UserRole::userRight();
		if ($companyId == "" && $branchId == "" && $teamId == "" && $month == "" && $status == "" && $year == "") {
			if ($type == "list") {
				return $this->redirect(Yii::$app->homeUrl . 'kgi/kgi-personal/individual-kgi');
			} else {
				return $this->redirect(Yii::$app->homeUrl . 'kgi/kgi-personal/individual-kgi-grid');
			}
		}
		if ($employeeId != null) {
			$userId = User::userIdByEmployeeId($employeeId);
		} else {
			if ($role >= 3) {
				$userId = null;
			} else {
				$userId = Yii::$app->user->id;
			}
		}

		//$paramText = 'month=' . $month . '&&status=' . $status . '&&year=' . $year . '&&userId=' . $userId;
		$paramText = 'companyId=' . $companyId . '&&branchId=' . $branchId . '&&teamId=' . $teamId . '&&month=' . $month . '&&status=' . $status . '&&year=' . $year . '&&userId=' . $userId;
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}

		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-personal/kgi-personal-filter?' . $paramText);
		$kgis = curl_exec($api);
		$kgis = json_decode($kgis, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/unit/all-unit');
		$units = curl_exec($api);
		$units = json_decode($units, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$companies = curl_exec($api);
		$companies = json_decode($companies, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-personal/wait-for-approve?branchId=' . $userBranchId . '&&isAdmin=' . $isAdmin);
		$waitForApprove = curl_exec($api);
		$waitForApprove = json_decode($waitForApprove, true);

		if ($role >= 3) {
			$em = Employee::employeeDetailByUserId(Yii::$app->user->id);
			if (isset($em) && !empty($em)) {
				curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/branch-team?id=' . $em["branchId"]);
				$teams = curl_exec($api);
				$teams = json_decode($teams, true);
			}
			//throw new Exception(print_r($teams, true));
		}

		curl_close($api);
		// throw new Exception(print_r($kgis, true));	

		//throw new exception($paramText, true);
		if ($type == "list") {
			$file = "index";
		} else {
			$file = "individual_kgi_grid";
		}
		$months = ModelMaster::monthFull(1);
		$isManager = UserRole::isManager();
		if ($teamId != '') {
			$employees = Team::employeeInTeamDetail($teamId);
		}
		return $this->render($file, [
			"units" => $units,
			"months" => $months,
			"teams" => $teams,
			"kgis" => $kgis,
			"role" => $role,
			"userId" => $userId,
			"isManager" => $isManager,
			"companies" => $companies,
			"status" => $status,
			"year" => $year,
			"companyId" => $companyId,
			"branchId" => $branchId,
			"teamId" => $teamId,
			"month" => $month,
			"employeeId" => $employeeId,
			"employees" => $employees,
			"waitForApprove" => $waitForApprove
		]);
	}
	public function actionNextKgiEmployeeHistory()
	{
		$kgiEmployeeHistoryId = $_POST["kgiEmployeeHistoryId"];
		$currentHistory = KgiEmployeeHistory::find()->where(["kgiEmployeeHistoryId" => $kgiEmployeeHistoryId])->asArray()->one();
		$kgiTeam = KgiEmployee::find()->where(["kgiEmployeeId" => $currentHistory["kgiEmployeeId"]])->asArray()->one();
		$kgi = Kgi::find()->where(["kgiId" => $kgiTeam["kgiId"]])->asArray()->one();
		$unit = Unit::find()->where(["unitId" => $kgi["unitId"]])->asArray()->one();
		if ($currentHistory["month"] != "" && $currentHistory["year"] != "") {
			$nextTargetMonthYear = ModelMaster::nextTargetMonthYear($unit["unitName"], $currentHistory["month"], $currentHistory["year"]);
			$nextMonth = $nextTargetMonthYear["nextMonth"];
			$nextYear = $nextTargetMonthYear["nextYear"];
		} else {
			$nextMonth = null;
			$nextYear = null;
		}
		$kgiEmployeeHistory = new KgiEmployeeHistory();
		$kgiEmployeeHistory->kgiEmployeeId = $currentHistory["kgiEmployeeId"];
		$kgiEmployeeHistory->detail = 'New target';
		$kgiEmployeeHistory->nextCheckDate = null;
		$kgiEmployeeHistory->status = 1;
		$kgiEmployeeHistory->target = $currentHistory["target"];
		$kgiEmployeeHistory->result = 0;
		$kgiEmployeeHistory->month = $nextMonth;
		$kgiEmployeeHistory->year = $nextYear;
		$kgiEmployeeHistory->createDateTime = new Expression('NOW()');
		$kgiEmployeeHistory->updateDateTime = new Expression('NOW()');
		if ($kgiEmployeeHistory->save(false)) {
			$kgiEmployee = KgiEmployee::find()->where(["kgiEmployeeId" => $currentHistory["kgiEmployeeId"]])->one();
			$kgiEmployee->status = 1;
			$kgiEmployee->month = $nextMonth;
			$kgiEmployee->year = $nextYear;
			$kgiEmployee->updateDateTime = new Expression('NOW()');
			$kgiEmployee->save(false);
		}
		return $this->redirect(Yii::$app->homeUrl . 'kgi/kgi-personal/individual-kgi-grid');
	}
	public function actionKgiEmployeeHistory($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$kgiEmployeeId = $param["kgiEmployeeId"];
		$openTab = $param["openTab"];
		$kgiEmployeeHistoryId = $param["kgiEmployeeHistoryId"];
		$kgiId = $param["kgiId"];
		$role = UserRole::userRight();
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-personal/kgi-employee-detail?kgiEmployeeId=' . $kgiEmployeeId . '&&kgiEmployeeHistoryId=' . $kgiEmployeeHistoryId);
		$kgiEmployeeDetail = curl_exec($api);
		$kgiEmployeeDetail = json_decode($kgiEmployeeDetail, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/unit/all-unit');
		$units = curl_exec($api);
		$units = json_decode($units, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$companies = curl_exec($api);
		$companies = json_decode($companies, true);
		curl_close($api);
		$res["kgiEmployee"] = $kgiEmployeeDetail;
		$isManager = UserRole::isManager();
		$months = ModelMaster::monthFull(1);
		//throw new exception(print_r($kgiEmployeeDetail, true));
		return $this->render('kgi_employee_history', [
			"role" => $role,
			"kgiEmployeeDetail" => $kgiEmployeeDetail,
			"units" => $units,
			"months" => $months,
			"isManager" => $isManager,
			"companies" => $companies,
			"kgiId" => $kgiId,
			"kgiEmployeeHistoryId" => $kgiEmployeeHistoryId,
			"openTab" => $openTab,
			"kgiEmployeeId" => $kgiEmployeeId
		]);
	}
	public function actionKgiTeamEmployee()
	{
		$kgiId = $_POST["kgiId"];
		$res["kgiEmployeeTeam"] = "";
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-team/kgi-team-summarize?kgiId=' . $kgiId);
		$kgiTeams = curl_exec($api);
		$kgiTeams = json_decode($kgiTeams, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiId . "&&kgiHistoryId=0");
		$kgiDetail = curl_exec($api);
		$kgiDetail = json_decode($kgiDetail, true);
		curl_close($api);
		$res["kgiEmployeeTeam"] = $this->renderAjax("kgi_employee_team", [
			"kgiTeams" => $kgiTeams,
			"kgiDetail" => $kgiDetail

		]);
		return json_encode($res);
	}
	public function actionAllKgiHistory()
	{
		$kgiEmployeeId = $_POST["kgiEmployeeId"];
		$kgiEmployeeHistoryId = $_POST["kgiEmployeeHistoryId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiId);
		// $kgi = curl_exec($api);
		// $kgi = json_decode($kgi, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-personal/kgi-employee-history2?kgiEmployeeId=' . $kgiEmployeeId . '&&kgiEmployeeHistoryId=' . $kgiEmployeeHistoryId);
		$history = curl_exec($api);
		$history = json_decode($history, true);
		curl_close($api);
		$monthDetail = [];
		$summarizeMonth = [];
		//throw new Exception(print_r($history, true));
		$res["monthlyDetailHistoryText"] = "";
		if ($kgiEmployeeHistoryId != 0) {
			$kgiEmployeeHistory = KgiEmployeeHistory::find()
				->where(["kgiEmployeeHistoryId" => $kgiEmployeeHistoryId])
				->asArray()
				->one();
			$year = $kgiEmployeeHistory["year"];
			$month = $kgiEmployeeHistory["month"];
		} else {
			$year = 0;
			$month = 0;
		}
		if (isset($history) && count($history) > 0) {
			//krsort($history);
			foreach ($history as $kgiHistoryId => $ht):
				if ($year != 0 && $month != 0 && $ht["year"] <= $year) {
					if ($ht["year"] == $year) {
						if ($ht["month"] <= $month) {
							if (isset($monthDetail[$ht["year"]][$ht["month"]])) {
								$totalCount = count($monthDetail[$ht["year"]][$ht["month"]]);
								$monthDetail[$ht["year"]][$ht["month"]][$totalCount] = [
									"creater" => $ht["creater"],
									"title" => $ht["title"],
									"status" => $ht["status"],
									"picture" => $ht["picture"],
									"result" => $ht["result"],
									"createDateTime" => $ht["createDateTime"]
								];
							} else {
								$monthDetail[$ht["year"]][$ht["month"]][0] = [
									"creater" => $ht["creater"],
									"title" => $ht["title"],
									"status" => $ht["status"],
									"picture" => $ht["picture"],
									"result" => $ht["result"],
									"createDateTime" => $ht["createDateTime"]
								];
								$summarizeMonth[$ht["year"]][$ht["month"]] = [
									"year" => $ht["year"],
									"month" => ModelMaster::fullMonthText($ht["month"]),
									"result" => $ht["result"],
									"target" => $ht["target"],
									"kgiHistoryId" => $kgiHistoryId

								];
							}
						}
					} else {
						if (isset($monthDetail[$ht["year"]][$ht["month"]])) {
							$totalCount = count($monthDetail[$ht["year"]][$ht["month"]]);
							$monthDetail[$ht["year"]][$ht["month"]][$totalCount] = [
								"creater" => $ht["creater"],
								"title" => $ht["title"],
								"status" => $ht["status"],
								"picture" => $ht["picture"],
								"result" => $ht["result"],
								"createDateTime" => $ht["createDateTime"]
							];
						} else {
							$monthDetail[$ht["year"]][$ht["month"]][0] = [
								"creater" => $ht["creater"],
								"title" => $ht["title"],
								"status" => $ht["status"],
								"picture" => $ht["picture"],
								"result" => $ht["result"],
								"createDateTime" => $ht["createDateTime"]
							];
							$summarizeMonth[$ht["year"]][$ht["month"]] = [
								"year" => $ht["year"],
								"month" => ModelMaster::fullMonthText($ht["month"]),
								"result" => $ht["result"],
								"target" => $ht["target"],
								"kgiHistoryId" => $kgiHistoryId

							];
						}
					}
				} else {
					if (isset($monthDetail[$ht["year"]][$ht["month"]])) {
						$totalCount = count($monthDetail[$ht["year"]][$ht["month"]]);
						$monthDetail[$ht["year"]][$ht["month"]][$totalCount] = [
							"creater" => $ht["creater"],
							"title" => $ht["title"],
							"status" => $ht["status"],
							"picture" => $ht["picture"],
							"result" => $ht["result"],
							"createDateTime" => $ht["createDateTime"]
						];
					} else {
						$monthDetail[$ht["year"]][$ht["month"]][0] = [
							"creater" => $ht["creater"],
							"title" => $ht["title"],
							"status" => $ht["status"],
							"picture" => $ht["picture"],
							"result" => $ht["result"],
							"createDateTime" => $ht["createDateTime"]
						];
						$summarizeMonth[$ht["year"]][$ht["month"]] = [
							"year" => $ht["year"],
							"month" => ModelMaster::fullMonthText($ht["month"]),
							"result" => $ht["result"],
							"target" => $ht["target"],
							"kgiHistoryId" => $kgiHistoryId

						];
					}
				}
			endforeach;
			$res["monthlyDetailHistoryText"] = $this->renderAjax('kgi_update_history', [
				"monthDetail" => $monthDetail,
				"summarizeMonth" => $summarizeMonth
			]);
		}
		return json_encode($res);
	}
	public function actionKgiEmployeeChart()
	{
		$kgiId = $_POST["kgiId"];
		$kgiEmployeeHistoryId = $_POST["kgiEmployeeHistoryId"];
		$kgiEmployeeId = $_POST["kgiEmployeeId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		//curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-history?kgiId=' . $kgiId);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-personal/kgi-employee-history-for-chart?kgiEmployeeHistoryId=' . $kgiEmployeeHistoryId . '&&kgiEmployeeId=' . $kgiEmployeeId);
		$history = curl_exec($api);
		$history = json_decode($history, true);
		curl_close($api);
		$monthDetail = [];
		$summarizeMonth = [];
		$summarizeMonth2 = [];
		$months = ModelMaster::month();
		$monthText = '';
		$target = [];
		$targetText = "";
		$resultText = "";
		$result = [];
		//ksort($month);
		$res["monthlyDetailHistoryText"] = "";
		if ($kgiEmployeeHistoryId != 0) {
			$kgiHistory = KgiEmployeeHistory::find()
				->where(["kgiEmployeeHistoryId" => $kgiEmployeeHistoryId])
				->asArray()
				->one();
			$year = $kgiHistory["year"];
			$month = $kgiHistory["month"];
		} else {
			$year = '';
			$month = '';
		}
		//throw new exception(print_r($history, true));
		if (isset($history) && count($history) > 0) {
			$i = 0;
			foreach ($history as $kgiEmployeeHistoryId => $ht):
				if ($year != '' && $month != '' && $ht["year"] <= $year) {
					if ($ht["year"] == $year) {
						if ($ht["month"] <= $month) {
							if (!isset($summarizeMonth[$ht["year"]][$ht["month"]])) {
								$summarizeMonth[$ht["year"]][$ht["month"]] = [
									"year" => $ht["year"],
									"kgiEmployeeHistoryId" => $kgiEmployeeHistoryId
								];
								$summarizeMonth2[$i] = [
									"year" => $ht["year"],
									"month" => ModelMaster::fullMonthText($ht["month"]),
									"result" => $ht["result"],
									"target" => $ht["target"],
									"kgiEmployeeHistoryId" => $kgiEmployeeHistoryId
								];
							}
						}
					} else {
						if (!isset($summarizeMonth[$ht["year"]][$ht["month"]])) {
							$summarizeMonth[$ht["year"]][$ht["month"]] = [
								"year" => $ht["year"],
								"kgiEmployeeHistoryId" => $kgiEmployeeHistoryId
							];
							$summarizeMonth2[$i] = [
								"year" => $ht["year"],
								"month" => ModelMaster::fullMonthText($ht["month"]),
								"result" => $ht["result"],
								"target" => $ht["target"],
								"kgiEmployeeHistoryId" => $kgiEmployeeHistoryId
							];
						}
					}
				} else {
					if (!isset($summarizeMonth[$ht["year"]][$ht["month"]])) {
						$summarizeMonth[$ht["year"]][$ht["month"]] = [
							"year" => $ht["year"],
							"kgiEmployeeHistoryId" => $kgiEmployeeHistoryId
						];
						$summarizeMonth2[$i] = [
							"year" => $ht["year"],
							"month" => ModelMaster::fullMonthText($ht["month"]),
							"result" => $ht["result"],
							"target" => $ht["target"],
							"kgiEmployeeHistoryId" => $kgiEmployeeHistoryId
						];
					}
				}
				$i++;
			endforeach;
		}
		$summarizeMonth2 = array_slice($summarizeMonth2, -8);
		foreach ($summarizeMonth2 as $index => $data):
			$target[$index] = $data["target"];
			$result[$index] = $data["result"];
			$targetText .= $target[$index] . ',';
			$resultText .= $result[$index] . ',';
			if ($data["month"] != '' && $data["year"] != "") {
				$monthText .= '"' . substr($data["month"], 0, 3) . substr($data["year"], -2) . '",';
			} else {
				$monthText .= '';
			}
		endforeach;
		$monthText = substr($monthText, 0, -1);
		$targetText = substr($targetText, 0, -1);
		$resultText = substr($resultText, 0, -1);
		$res["kgiChart"] = $this->renderAjax('kgi_chart', [
			"month" => $monthText,
			"target" => $targetText,
			"result" => $resultText
		]);
		return json_encode($res);
	}
}
