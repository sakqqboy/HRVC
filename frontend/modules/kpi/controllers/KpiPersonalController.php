<?php

namespace frontend\modules\kpi\controllers;

use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
use FFI\Exception as FFIException;
use frontend\models\hrvc\Employee;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\Kpi;
use frontend\models\hrvc\KpiEmployee;
use frontend\models\hrvc\KpiEmployeeHistory;
use frontend\models\hrvc\Unit;
use frontend\models\hrvc\User;
use frontend\models\hrvc\UserRole;
use Yii;
use yii\db\Expression;
use yii\web\Controller;

// header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
// header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
// header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
// header("Cache-Control: post-check=0, pre-check=0", false);
// header("Pragma: no-cache");
class KpiPersonalController extends Controller
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
		$kpiId = $param["kpiId"];
		$role = UserRole::userRight();
		if ($role < 3) {
			return $this->redirect(Yii::$app->homeUrl . 'kpi/management/index');
		}
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-personal/kpi-team-employee?kpiId=' . $kpiId);
		$kpiEmployees = curl_exec($api);
		$kpiEmployees = json_decode($kpiEmployees, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/kpi-detail?id=' . $kpiId);
		$kpiDetail = curl_exec($api);
		$kpiDetail = json_decode($kpiDetail, true);

		curl_close($api);

		//throw new Exception(print_r($kpiEmployees, true));
		return $this->render('indivisual_setting', [
			"kpiDetail" => $kpiDetail,
			"kpiId" => $kpiId,
			"kpiEmployees" => $kpiEmployees,
			"role" => $role
		]);
	}
	public function actionSetPersonalTarget()
	{
		if (isset($_POST["kpiId"])) {
			if (isset($_POST["target"]) && count($_POST["target"])) {
				foreach ($_POST["target"] as $employeeId => $target) :
					if ($target != '') {
						$target = str_replace(",", "", $target);
						$kpiEmployee = KpiEmployee::find()
							->where(["kpiId" => $_POST["kpiId"], "employeeId" => $employeeId])
							->one();
						if (isset($kpiEmployee) && !empty($kpiEmployee)) {
							$kpiEmployee->target = $target;
							$kpiEmployee->remark = $_POST["remark"][$employeeId];
							$kpiEmployee->updateDateTime = new Expression('NOW()');
							$kpiEmployee->createrId = Yii::$app->user->id;
							$kpiEmployee->save(false);
						} else {
							if ($target != '0.00') {
								$kpiEmployee = new KpiEmployee();
								$kpiEmployee->target = $target;
								$kpiEmployee->remark = $_POST["remark"][$employeeId];
								$kpiEmployee->kpiId = $_POST["kpiId"];
								$kpiEmployee->employeeId = $employeeId;
								$kpiEmployee->updateDateTime = new Expression('NOW()');
								$kpiEmployee->createrId = Yii::$app->user->id;
								$kpiEmployee->save(false);
							}
						}
					}
				endforeach;
			}
		}
		return $this->redirect(Yii::$app->homeUrl . 'kpi/management/grid');
	}
	public function actionIndividualKpi()
	{
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		$role = UserRole::userRight();
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

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-personal/employee-kpi?userId=' . Yii::$app->user->id . '&&role=' . $role);
		$kpis = curl_exec($api);
		$kpis = json_decode($kpis, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-personal/wait-for-approve');
		$waitForApprove = curl_exec($api);
		$waitForApprove = json_decode($waitForApprove, true);

		if ($role == 3) {
			$em = Employee::employeeDetailByUserId(Yii::$app->user->id);
			if (isset($em) && !empty($em)) {
				curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/branch-team?id=' . $em["branchId"]);
				$teams = curl_exec($api);
				$teams = json_decode($teams, true);
			}
		}
		curl_close($api);
		// throw new Exception(print_r($kpis, true));

		$months = ModelMaster::monthFull(1);
		$isManager = UserRole::isManager();
		return $this->render('index', [
			"units" => $units,
			"companies" => $companies,
			"teams" => $teams,
			"months" => $months,
			"isManager" => $isManager,
			"role" => $role,
			"kpis" => $kpis,
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
	public function actionIndividualKpiGrid()
	{
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		$role = UserRole::userRight();
		$teams = [];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/unit/all-unit');
		$units = curl_exec($api);
		$units = json_decode($units, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$companies = curl_exec($api);
		$companies = json_decode($companies, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-personal/employee-kpi?userId=' . Yii::$app->user->id . '&&role=' . $role);
		$kpis = curl_exec($api);
		$kpis = json_decode($kpis, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-personal/wait-for-approve');
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
		return $this->render('individual_kpi_grid', [
			"units" => $units,
			"companies" => $companies,
			"teams" => $teams,
			"months" => $months,
			"isManager" => $isManager,
			"role" => $role,
			"kpis" => $kpis,
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
	public function actionUpdatePersonalKpi($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$kpiEmployeeId = $param["kpiEmployeeId"];

		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-personal/kpi-employee-detail?kpiEmployeeId=' . $kpiEmployeeId);
		$kpiEmployeeDetail = curl_exec($api);
		$kpiEmployeeDetail = json_decode($kpiEmployeeDetail, true);

		curl_close($api);
		//   throw new Exception(print_r($kpiEmployeeDetail,true));
		$months = ModelMaster::monthFull(1);
		return $this->render('update_personal_kpi', [
			"kpiEmployeeId" => $kpiEmployeeId,
			"kpiEmployeeDetail" => $kpiEmployeeDetail,
			"months" => $months
		]);
	}
	public function actionSaveUpdatePersonalKpi()
	{
		if (isset($_POST["kpiEmployeeId"])) {
			$history = KpiEmployeeHistory::find()
				->where(["kpiEmployeeId" => $_POST["kpiEmployeeId"]])
				->orderBy('kpiEmployeeHistoryId DESC')
				->one();
			$status = $_POST["status"];
			if (isset($history) && !empty($history)) {
				// $nextCheckDateArr = explode(' ', $history["nextCheckDate"]);
				// $nextCheckDate = $nextCheckDateArr[0];
				if (!empty($history["nextCheckDate"])){
					$nextCheckDateArr = explode(' ', $history["nextCheckDate"]);
					$nextCheckDate = $nextCheckDateArr[0];
				}else{
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
					$history = KpiEmployeeHistory::find()
						->where(["kpiEmployeeId" => $_POST["kpiEmployeeId"], "status" => 88])
						->one();
					if (!isset($history) || empty($history)) {
						$history = new KpiEmployeeHistory();
					}
					$history->kpiEmployeeId = $_POST["kpiEmployeeId"];
					$history->target = str_replace(",", "", $_POST["target"]);
					$history->result = str_replace(",", "", $_POST["result"]);
					$history->detail = $_POST["detail"];
					$history->month = $_POST["month"];
					$history->year = $_POST["year"];
					$history->nextCheckDate = $_POST["nextCheckDate"] . ' 00:00:00';
					$history->lastCheckDate = $lastCheck;
					$history->status = $status;
					$history->createDateTime = new Expression('NOW()');
					$history->updateDateTime = new Expression('NOW()');
				}
			} else {
				$history = new KpiEmployeeHistory();
				$history->kpiEmployeeId = $_POST["kpiEmployeeId"];
				$history->target = str_replace(",", "", $_POST["target"]);
				$history->result = str_replace(",", "", $_POST["result"]);
				$history->detail = $_POST["detail"];
				$history->month = $_POST["month"];
				$history->year = $_POST["year"];
				$history->nextCheckDate = $_POST["nextCheckDate"] . ' 00:00:00';
				$history->status = $_POST["status"];
				$history->createDateTime = new Expression('NOW()');
				$history->updateDateTime = new Expression('NOW()');
			}
			$kpiEmployee = KpiEmployee::find()
				->where(["kpiEmployeeId" => $_POST["kpiEmployeeId"]])
				->one();
			if ($status != 88) {
				$kpiEmployee->target = $_POST["target"];
				$kpiEmployee->result = $_POST["result"];
			} else {
				$kpiEmployee->status = 1;
			}
			$kpiEmployee->updateDateTime = new Expression('NOW()');
			$kpiEmployee->month = $_POST["month"];
			$kpiEmployee->year = $_POST["year"];
			$kpiEmployee->save(false);
			$history->createrId = Yii::$app->user->id;
			if ($history->save(false)) {

				if ($_POST["url"] != Yii::$app->request->referrer) {
					return $this->redirect($_POST["url"]);
				} else {
					return $this->redirect(Yii::$app->homeUrl . 'kpi/kpi-personal/individual-kpi-grid');
				}
			}
		} else {
			return $this->redirect(Yii::$app->homeUrl . 'kpi/kpi-personal/individual-kpi-grid');
		}
	}
	public function actionViewPersonalKpi($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$kpiEmployeeId = $param["kpiEmployeeId"];

		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-personal/kpi-employee-detail?kpiEmployeeId=' . $kpiEmployeeId);
		$kpiEmployeeDetail = curl_exec($api);
		$kpiEmployeeDetail = json_decode($kpiEmployeeDetail, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-personal/kpi-employee-history?kpiEmployeeId=' . $kpiEmployeeId);
		$kpiEmployeeHistory = curl_exec($api);
		$kpiEmployeeHistory = json_decode($kpiEmployeeHistory, true);

		curl_close($api);
		return $this->render('personal_view', [
			"kpiEmployeeId" => $kpiEmployeeId,
			"kpiEmployeeDetail" => $kpiEmployeeDetail,
			"kpiEmployeeHistory" => $kpiEmployeeHistory
		]);
	}
	public function actionEmployeeProgress()
	{
		$kpiId = $_POST["kpiId"];
		$employeeId = $_POST["employeeId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/employee/employee-detail?id=' . $employeeId);
		$employeeDetail = curl_exec($api);
		$employeeDetail = json_decode($employeeDetail, true);


		$kpi = Kpi::find()->select('kpiName')->where(["kpiId" => $kpiId])->asArray()->one();

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-personal/kpi-employee-history-view?kpiId=' . $kpiId . '&&employeeId=' . $employeeId);
		$kpiEmployeeHistory = curl_exec($api);
		$kpiEmployeeHistory = json_decode($kpiEmployeeHistory, true);
		curl_close($api);
		//throw new Exception(print_r($kpiTeamHistory, true));
		$teamText = $this->renderAjax('employee_progress', ["kpiEmployeeHistory" => $kpiEmployeeHistory]);
		//throw new Exception($teamText);
		$res["employeeName"] = $employeeDetail["employeeFirstname"] . ' ' . $employeeDetail["employeeSurename"];
		$res["kpiName"] = $kpi["kpiName"];
		$res["history"] = $teamText;
		return json_encode($res);
	}
	public function actionSearchKpiPersonal()
	{

		$companyId = isset($_POST["companyId"]) && $_POST["companyId"] != null ? $_POST["companyId"] : null;
		$branchId = isset($_POST["branchId"]) && $_POST["branchId"] != null ? $_POST["branchId"] : null;
		$teamId = isset($_POST["teamId"]) && $_POST["teamId"] != null ? $_POST["teamId"] : null;
		$employeeId = isset($_POST["employeeId"]) && $_POST["employeeId"] != null ? $_POST["employeeId"] : null;
		$month = isset($_POST["month"]) && $_POST["month"] != null ? $_POST["month"] : null;
		$status = isset($_POST["status"]) && $_POST["status"] != null ? $_POST["status"] : null;
		$year = isset($_POST["year"]) && $_POST["year"] != null ? $_POST["year"] : null;
		$type = $_POST["type"];
		return $this->redirect(Yii::$app->homeUrl . 'kpi/kpi-personal/kpi-personal-search-result/' . ModelMaster::encodeParams([
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
	public function actionKpiPersonalSearchResult($hash)
	{
		$param = ModelMaster::decodeParams($hash);
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
				return $this->redirect(Yii::$app->homeUrl . 'kpi/kpi-personal/individual-kpi');
			} else {
				return $this->redirect(Yii::$app->homeUrl . 'kpi/kpi-personal/individual-kpi-grid');
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
		$paramText = 'companyId=' . $companyId . '&&branchId=' . $branchId . '&&teamId=' . $teamId . '&&month=' . $month . '&&status=' . $status . '&&year=' . $year . '&&userId=' . $userId;
		//$paramText = 'month=' . $month . '&&status=' . $status . '&&year=' . $year . '&&userId=' . Yii::$app->user->id;
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		$userId = Yii::$app->user->id;
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$companies = curl_exec($api);
		$companies = json_decode($companies, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-personal/kpi-personal-filter?' . $paramText);
		$kpis = curl_exec($api);
		$kpis = json_decode($kpis, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-personal/wait-for-approve');
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
		//throw new exception(print_r($teamKpis, true));
		if ($type == "list") {
			$file = "index";
		} else {
			$file = "individual_kpi_grid";
		}
		$months = ModelMaster::monthFull(1);
		$role = UserRole::userRight();
		$isManager = UserRole::isManager();
		return $this->render($file, [
			"companies" => $companies,
			"teams" => $teams,
			"months" => $months,
			"kpis" => $kpis,
			"role" => $role,
			"userId" => $userId,
			"isManager" => $isManager,
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
	public function actionNextKpiEmployeeHistory()
	{
		$kpiEmployeeHistoryId = $_POST["kpiEmployeeHistoryId"];
		$currentHistory = KpiEmployeeHistory::find()->where(["kpiEmployeeHistoryId" => $kpiEmployeeHistoryId])->asArray()->one();
		$kpiTeam = KpiEmployee::find()->where(["kpiEmployeeId" => $currentHistory["kpiEmployeeId"]])->asArray()->one();
		$kpi = Kpi::find()->where(["kpiId" => $kpiTeam["kpiId"]])->asArray()->one();
		$unit = Unit::find()->where(["unitId" => $kpi["unitId"]])->asArray()->one();
		if ($currentHistory["month"] != "" && $currentHistory["year"] != "") {
			$nextTargetMonthYear = ModelMaster::nextTargetMonthYear($unit["unitName"], $currentHistory["month"], $currentHistory["year"]);
			$nextMonth = $nextTargetMonthYear["nextMonth"];
			$nextYear = $nextTargetMonthYear["nextYear"];
		} else {
			$nextMonth = null;
			$nextYear = null;
		}
		$kpiEmployeeHistory = new KpiEmployeeHistory();
		$kpiEmployeeHistory->kpiEmployeeId = $currentHistory["kpiEmployeeId"];
		$kpiEmployeeHistory->detail = 'New target';
		$kpiEmployeeHistory->nextCheckDate = null;
		$kpiEmployeeHistory->status = 1;
		$kpiEmployeeHistory->target = $currentHistory["target"];
		$kpiEmployeeHistory->result = 0;
		$kpiEmployeeHistory->month = $nextMonth;
		$kpiEmployeeHistory->year = $nextYear;
		$kpiEmployeeHistory->createDateTime = new Expression('NOW()');
		$kpiEmployeeHistory->updateDateTime = new Expression('NOW()');
		if ($kpiEmployeeHistory->save(false)) {
			$kpiEmployee = KpiEmployee::find()->where(["kpiEmployeeId" => $currentHistory["kpiEmployeeId"]])->one();
			$kpiEmployee->status = 1;
			$kpiEmployee->month = $nextMonth;
			$kpiEmployee->year = $nextYear;
			$kpiEmployee->updateDateTime = new Expression('NOW()');
			$kpiEmployee->save(false);
		}
		return $this->redirect(Yii::$app->homeUrl . 'kpi/kpi-personal/individual-kpi-grid');
	}
}