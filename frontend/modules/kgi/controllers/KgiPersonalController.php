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

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-personal/employee-kgi?userId=' . Yii::$app->user->id);
		$kgis = curl_exec($api);
		$kgis = json_decode($kgis, true);

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
			"teamId" => null
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

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-personal/employee-kgi?userId=' . Yii::$app->user->id);
		$kgis = curl_exec($api);
		$kgis = json_decode($kgis, true);

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

		]);
	}
	public function actionUpdatePersonalKgi($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$kgiEmployeeId = $param["kgiEmployeeId"];

		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-personal/kgi-employee-detail?kgiEmployeeId=' . $kgiEmployeeId);
		$kgiEmployeeDetail = curl_exec($api);
		$kgiEmployeeDetail = json_decode($kgiEmployeeDetail, true);

		curl_close($api);

		$months = ModelMaster::monthFull(1);
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
				$nextCheckDateArr = explode(' ', $history["nextCheckDate"]);
				$nextCheckDate = $nextCheckDateArr[0];
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
					$history->target = str_replace(",", "", $_POST["target"]);
					$history->result = str_replace(",", "", $_POST["result"]);
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
				$history->target = str_replace(",", "", $_POST["target"]);
				$history->result = str_replace(",", "", $_POST["result"]);
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
				$kgiEmployee->target = $_POST["target"];
				$kgiEmployee->result = $_POST["result"];
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
		$kgiEmployeeId = $param["kgiEmployeeId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-personal/kgi-employee-detail?kgiEmployeeId=' . $kgiEmployeeId);
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
		$kgiEmployeeId = $_POST["kgiEmployeed"];
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
		//throw new exception(print_r($teamKgis, true));
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
			"employees" => $employees
		]);
	}
}
