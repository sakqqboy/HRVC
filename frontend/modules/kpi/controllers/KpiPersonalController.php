<?php

namespace frontend\modules\kpi\controllers;

use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
use FFI\Exception as FFIException;
use frontend\models\hrvc\Company;
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

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/kpi-detail?id=' . $kpiId . '&&kpiHistoryId=0');
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

	public function actionDeleteKpiPersonal()
	{
		$kpiEmployeeId = $_POST["kpiEmployeeId"];
		KpiEmployee::updateAll(["status" => 99], ["kpiEmployeeId" => $kpiEmployeeId]);
		KpiEmployeeHistory::updateAll(["status" => 99], ["kpiEmployeeId" => $kpiEmployeeId]);
		$res["status"] = true;
		return json_encode($res);
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
		$userId = Yii::$app->user->id;

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

	public function actionKpiIndividualHistory($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$role = UserRole::userRight();
		$kpiId = $param["kpiId"];
		$kpiEmployeeId = $param["kpiEmployeeId"];
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		if (isset($param["kpiEmployeeHistoryId"])) {
			$kpiEmployeeHistoryId = $param["kpiEmployeeHistoryId"];
		} else {
			$kpiEmployeeHistoryId = 0;
		}
		$kpiEmployeeHistoryId = KpiEmployeeHistory::find()
		->select('kpiEmployeeHistoryId')
		->where(["kpiEmployeeId" => $kpiEmployeeId])
		->orderBy('kpiEmployeeHistoryId DESC')
		->asArray()->one();
		
		if(isset($kpiEmployeeHistoryId) && !empty($kpiEmployeeHistoryId)) {
			$kpiEmployeeHistoryId = $kpiEmployeeHistoryId['kpiEmployeeHistoryId'];
		}
		// throw new Exception($kpiEmployeeHistoryId);
		$openTab = array_key_exists("openTab", $param) ? $param["openTab"] : 0;
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		// $api = curl_init();
		// curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		// curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/kpi-detail?id=' . $kpiId . "&&kpiHistoryId=" . $kpiEmployeeHistoryId);
		// $kpiDetail = curl_exec($api);
		// $kpiDetail = json_decode($kpiDetail, true);
		// throw new Exception(print_r($kpiDetail, true));

		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-personal/kpi-employee-detail?kpiEmployeeId=' . $kpiEmployeeId . '&&kpiEmployeeHistoryId=' . $kpiEmployeeHistoryId);
		$kpiEmployeeDetail = curl_exec($api);
		$kpiEmployeeDetail = json_decode($kpiEmployeeDetail, true);


		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$companies = curl_exec($api);
		$companies = json_decode($companies, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/unit/all-unit');
		$units = curl_exec($api);
		$units = json_decode($units, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-team/kpi-team-summarize?kpiId=' . $kpiId);
		$kpiTeams = curl_exec($api);
		$kpiTeams = json_decode($kpiTeams, true);


		curl_close($api);
		$months = ModelMaster::monthFull(1);
		$isManager = UserRole::isManager();
		// throw new Exception(print_r($kpiEmployeeDetail, true));
		return $this->render('kpi_individual_history', [
			"role" => $role,
			"kpiEmployeeDetail" => $kpiEmployeeDetail,
			"kpiId" => $kpiId,
			"openTab" => $openTab,
			"months" => $months,
			"isManager" => $isManager,
			"units" => $units,
			"companies" => $companies,
			"kpiTeams" => $kpiTeams,
			"kpiEmployeeHistoryId" => $kpiEmployeeHistoryId,
			"kpiEmployeeId" => $kpiEmployeeId
		]);
	}

	public function actionAllKpiHistory()
	{

		$kpiId = $_POST["kpiId"];
		$kpiEmployeeId = $_POST["kpiEmployeeId"];
		$kpiEmployeeHistoryId = $_POST["kpiEmployeeHistoryId"];
		// return json_encode($kpiId);

		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-personal/kpi-history?kpiId=' . $kpiId . '&&kpiEmployeeId=' . $kpiEmployeeId . '&&kpiEmployeeHistoryId=' . $kpiEmployeeHistoryId);
		$history = curl_exec($api);
		$history = json_decode($history, true);

		// throw new Exception(print_r($history,true));
		curl_close($api);
		// return json_encode($history);
		$monthDetail = [];
		$summarizeMonth = [];
		$res["monthlyDetailHistoryText"] = "";
		if ($kpiEmployeeHistoryId != 0) {
			$kpiEmployeeHistory = KpiEmployeeHistory::find()
				->where(["kpiEmployeeHistoryId" => $kpiEmployeeHistoryId])
				->asArray()
				->one();
			$year = $kpiEmployeeHistory["year"];
			$month = $kpiEmployeeHistory["month"];
		} else {
			$year = '';
			$month = '';
		}
		if (isset($history) && count($history) > 0) {
			foreach ($history as $kpiHistoryId2 => $ht):
				if ($year != '' && $month != '' && $ht["year"] <= $year) {
					if ($ht["year"] == $year) {
						if ($ht["month"] <= $month) {
							if (isset($monthDetail[$ht["year"]][$ht["month"]])) {
								$totalCount = count($monthDetail[$ht["year"]][$ht["month"]]);
								$monthDetail[$ht["year"]][$ht["month"]][$totalCount] = [
									"creater" => $ht["creater"],
									// "title" => $ht["title"],
									"status" => $ht["status"],
									"picture" => $ht["picture"],
									"result" => $ht["result"] ?? 0, // ใช้ค่าเริ่มต้นเป็น 0
									"createDateTime" => $ht["createDate"]
								];
							} else {
								$monthDetail[$ht["year"]][$ht["month"]][0] = [
									"creater" => $ht["creater"],
									// "title" => $ht["title"],
									"status" => $ht["status"],
									"picture" => $ht["picture"],
									"result" => $ht["result"] ?? 0,
									"createDateTime" => $ht["createDate"]
								];
								$summarizeMonth[$ht["year"]][$ht["month"]] = [
									"year" => $ht["year"],
									"month" => ModelMaster::fullMonthText($ht["month"]),
									"result" => $ht["result"] ?? 0,
									"target" => $ht["target"] ?? 0, // ใช้ค่าเริ่มต้นเป็น 0
									"kpiHistoryId" => $kpiHistoryId2
								];
							}
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
							"result" => $ht["result"] ?? 0,
							"createDateTime" => $ht["createDateTime"]
						];
					} else {
						$monthDetail[$ht["year"]][$ht["month"]][0] = [
							"creater" => $ht["creater"],
							"title" => $ht["title"],
							"status" => $ht["status"],
							"picture" => $ht["picture"],
							"result" => $ht["result"] ?? 0,
							"createDateTime" => $ht["createDateTime"]
						];
						$summarizeMonth[$ht["year"]][$ht["month"]] = [
							"year" => $ht["year"],
							"month" => ModelMaster::fullMonthText($ht["month"]),
							"result" => $ht["result"] ?? 0,
							"target" => $ht["target"] ?? 0,
							"kpiHistoryId" => $kpiHistoryId2
						];
					}
				}
			endforeach;
			$res["monthlyDetailHistoryText"] = $this->renderAjax('kpi_update_history', [
				"monthDetail" => $monthDetail,
				"summarizeMonth" => $summarizeMonth
			]);
		}
		return json_encode($res);
	}


	public function actionKpiChart()
	{
		$kpiId = $_POST["kpiId"];
		$kpiEmployeeId = $_POST["kpiEmployeeId"];
		$kpiEmployeeHistoryId = $_POST["kpiEmployeeHistoryId"];

		// return json_encode($kpiId);

		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-personal/kpi-history-for-chart?kpiId=' . $kpiId . '&&kpiEmployeeId=' . $kpiEmployeeId . '&&kpiEmployeeHistoryId=' . $kpiEmployeeHistoryId);
		$history = curl_exec($api);
		$history = json_decode($history, true);
		curl_close($api);
		// throw new Exception(print_r($history,true));

		$monthDetail = [];
		$summarizeMonth = [];
		$year = 2024;
		$months = ModelMaster::month();
		$monthText = '';
		$target = [];
		$targetText = "";
		$resultText = "";
		$result = [];
		//ksort($month);
		$res["monthlyDetailHistoryText"] = "";
		if ($kpiEmployeeHistoryId != 0) {
			$kpiEmployeeHistory = KpiEmployeeHistory::find()
				->where(["kpiEmployeeHistoryId" => $kpiEmployeeHistoryId])
				->asArray()
				->one();
			$year = $kpiEmployeeHistory["year"];
			$month = $kpiEmployeeHistory["month"];
		} else {
			$year = '';
			$month = '';
		}
		if (isset($history) && count($history) > 0) {
			$i = 0;
			foreach ($history as $kpiHistoryId => $ht):
				if ($year != '' && $month != '' && $ht["year"] <= $year) {
					if ($ht["year"] == $year) {
						if ($ht["month"] <= $month) {
							if (!isset($summarizeMonth[$ht["year"]][$ht["month"]])) {
								$summarizeMonth[$ht["year"]][$ht["month"]] = [
									"year" => $ht["year"],
									"month" => ModelMaster::fullMonthText($ht["month"]),
									"result" => $ht["result"] ?? 0, // ใช้ค่าเริ่มต้นเป็น 0
									"target" => $ht["target"] ?? 0, // ใช้ค่าเริ่มต้นเป็น 0
									"kpiHistoryId" => $kpiHistoryId
								];
								$summarizeMonth2[$i] = [
									"year" => $ht["year"],
									"month" => ModelMaster::fullMonthText($ht["month"]),
									"result" => $ht["result"] ?? 0,
									"target" => $ht["target"] ?? 0,
									"kpiHistoryId" => $kpiHistoryId
								];
							}
						}
					} else {
						if (!isset($summarizeMonth[$ht["year"]][$ht["month"]])) {
							$summarizeMonth[$ht["year"]][$ht["month"]] = [
								"year" => $ht["year"],
								"month" => ModelMaster::fullMonthText($ht["month"]),
								"result" => $ht["result"] ?? 0,
								"target" => $ht["target"] ?? 0,
								"kpiHistoryId" => $kpiHistoryId
							];
							$summarizeMonth2[$i] = [
								"year" => $ht["year"],
								"month" => ModelMaster::fullMonthText($ht["month"]),
								"result" => $ht["result"] ?? 0,
								"target" => $ht["target"] ?? 0,
								"kpiHistoryId" => $kpiHistoryId
							];
						}
					}
				} else {
					if (!isset($summarizeMonth[$ht["year"]][$ht["month"]])) {
						$summarizeMonth[$ht["year"]][$ht["month"]] = [
							"year" => $ht["year"],
							"month" => ModelMaster::fullMonthText($ht["month"]),
							"result" => $ht["result"] ?? 0,
							"target" => $ht["target"] ?? 0,
							"kfpHistoryId" => $kpiHistoryId // หมายเหตุ: ตรวจสอบตัวแปรนี้ เนื่องจากชื่อไม่ตรงกันในบางจุด
						];
						$summarizeMonth2[$i] = [
							"year" => $ht["year"],
							"month" => ModelMaster::fullMonthText($ht["month"]),
							"result" => $ht["result"] ?? 0,
							"target" => $ht["target"] ?? 0,
							"kpiHistoryId" => $kpiHistoryId
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
			$monthText .= '"' . substr($data["month"], 0, 3) . substr($data["year"], -2) . '",';
		endforeach;
		$monthText = substr($monthText, 0, -1);
		$targetText = substr($targetText, 0, -1);
		$resultText = substr($resultText, 0, -1);
		$res["kpiChart"] = $this->renderAjax('kpi_chart', [
			"month" => $monthText,
			"target" => $targetText,
			"result" => $resultText
		]);
		return json_encode($res);
	}

	public function actionUpdatePersonalKpi($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$role = UserRole::userRight();

		$kpiEmployeeId = $param["kpiEmployeeId"];
		// throw new exception($kpiEmployeeId);	

		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-personal/kpi-employee-detail?kpiEmployeeId=' . $kpiEmployeeId . '&&kpiEmployeeHistoryId=0');
		$kpiEmployeeDetail = curl_exec($api);
		$kpiEmployeeDetail = json_decode($kpiEmployeeDetail, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/kpi-detail?id=' . $kpiEmployeeDetail['kpiId'] . '&&kpiHistoryId=0');
		$kpi = curl_exec($api);
		$kpi = json_decode($kpi, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/company-branch?id=' . $kpi["companyId"]);
		$kpiBranch = curl_exec($api);
		$kpiBranch = json_decode($kpiBranch, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/kpi-department?id=' . $kpiEmployeeDetail['kpiId']);
		$kpiDepartment = curl_exec($api);
		$kpiDepartment = json_decode($kpiDepartment, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/kpi-team?id=' . $kpiEmployeeDetail['kpiId']);
		$kpiTeam = curl_exec($api);
		$kpiTeam = json_decode($kpiTeam, true);


		curl_close($api);
		$companyId = $kpi["companyId"];
			$company= [
				"companyId" => $kpi["companyId"],
				"companyName" => Company::companyName($kpi["companyId"]),
				"companyImg" => Company::companyImage($kpi["companyId"]),
			];		

		$unit = Unit::find()->where(["unitId" => $kpi["unitId"]])->asArray()->one();
		$months = ModelMaster::monthFull(1);
		return $this->render('kpi_from', [
			"kpi" => $kpi,
			"kpiEmployeeId" => $kpiEmployeeId,
			"data" => $kpiEmployeeDetail,
			"months" => $months,
			"company" => $company ?? [],  
			"kpiBranch" => $kpiBranch ?? [],  
			"kpiDepartment" => $kpiDepartment ?? [],
			"kpiTeam" => $kpiTeam ?? [],
			"role" => $role,
			"unit"  => $unit ,
			"lastUrl" => Yii::$app->request->referrer,	
			"statusform" =>  "update"
		]);
	}
	public function actionSaveUpdatePersonalKpi()
	{

		$data = [
            'kpiEmployeeId' => $_POST["kpiEmployeeId"],
			'targetAmount' => $_POST["amount"], 
			'status' => $_POST["status"],   
			'result' => $_POST["result"],
			'month' => $_POST["month"],      
			'year' => $_POST["year"],      
			'toDate' => $_POST["toDate"],
			'fromDate' => $_POST["fromDate"],
			'nextCheckDate' => $_POST["nextCheckDate"],            
      
        ];

		// throw new exception(print_r($data	, true));	

		
		if (isset($_POST["kpiEmployeeId"])) {
			$history = KpiEmployeeHistory::find()
				->where(["kpiEmployeeId" => $_POST["kpiEmployeeId"]])
				->orderBy('kpiEmployeeHistoryId DESC')
				->one();
			$status = $_POST["status"];
			if (isset($history) && !empty($history)) {
				if (!empty($history["nextCheckDate"])) {
					$nextCheckDate = $history["nextCheckDate"];
				} else {
					$nextCheckDate = Null;
				}

				$lastCheck = $history->nextCheckDate;
				if ($history->target == str_replace(",", "", $_POST["amount"]) && $history->result == str_replace(",", "", $_POST["result"]) && $nextCheckDate == $_POST["nextCheckDate"] && $history->toDate == $_POST["toDate"] && $history->fromDate == $_POST["fromDate"]) {
					$history->status = $_POST["status"];
					$history->updateDateTime = new Expression('NOW()');
				} else {
					if ($history->target != str_replace(",", "", $_POST["amount"]) && $history->target != null) {
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
					$history->target = str_replace(",", "", $_POST["amount"]);
					$history->result = str_replace(",", "", $_POST["result"]);
					$history->month = $_POST["month"];
					$history->year = $_POST["year"];
					$history->toDate = $_POST["toDate"];
					$history->fromDate = $_POST["fromDate"];
					$history->nextCheckDate = $_POST["nextCheckDate"];
					$history->lastCheckDate = $lastCheck;
					$history->status = $status;
					$history->createDateTime = new Expression('NOW()');
					$history->updateDateTime = new Expression('NOW()');

				}
			} else {
				$history = new KpiEmployeeHistory();
				$history->kpiEmployeeId = $_POST["kpiEmployeeId"];
				$history->target = str_replace(",", "", $_POST["amount"]);
				$history->result = str_replace(",", "", $_POST["result"]);
				$history->month = $_POST["month"];
				$history->year = $_POST["year"];
				$history->toDate = $_POST["toDate"];
				$history->fromDate = $_POST["fromDate"];
				$history->nextCheckDate = $_POST["nextCheckDate"];
				$history->status = $_POST["status"];
				$history->createDateTime = new Expression('NOW()');
				$history->updateDateTime = new Expression('NOW()');
			}
			$kpiEmployee = KpiEmployee::find()
				->where(["kpiEmployeeId" => $_POST["kpiEmployeeId"]])
				->one();
			if ($status != 88) {
				$kpiEmployee->target = $_POST["amount"];
				$kpiEmployee->result = $_POST["result"];
			} else {
				$kpiEmployee->status = 1;
			}
			$kpiEmployee->updateDateTime = new Expression('NOW()');
			$kpiEmployee->month = $_POST["month"];
			$kpiEmployee->year = $_POST["year"];
			$kpiEmployee->toDate = $_POST["toDate"];
			$kpiEmployee->fromDate = $_POST["fromDate"];
			$kpiEmployee->nextCheckDate = $_POST["nextCheckDate"];
			$kpiEmployee->save(false);
			$history->createrId = Yii::$app->user->id;
			if ($history->save(false)) {
				return $this->redirect($_POST["lastUrl"]);
			}
		} else {
			return $this->redirect($_POST["lastUrl"]);
		}
	}

	public function actionModalHistory()
    {	
        $percentage = $_POST["percentage"];
        $result = $_POST["result"];
        $sumvalue = $_POST["sumvalue"];
        $targetAmount = $_POST["targetAmount"];
        $kpiId = $_POST["kpiId"];
        $month = $_POST["month"];
        $year = $_POST["year"];
        $formattedRange = $_POST["formattedRange"];
        $kpiEmployeeId = $_POST["kpiEmployeeId"];;
		$kpiEmployeeHistoryId = $_POST["kpiEmployeeHistoryId"];

		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/kpi-history-employee?kpiId=' . $kpiId);
		$history = curl_exec($api);
		$history = json_decode($history, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/kpi-history-team?kpiId=' . $kpiId );
		$historyTeam = curl_exec($api);
		$historyTeam = json_decode($historyTeam, true);

		curl_close($api);
        // throw new Exception(print_r($history,true));

        $data = [
            "percentage" => $percentage,
            "result" => $result,
            "sumvalue" => $sumvalue,
            "targetAmount" => $targetAmount,
            "kpiId" => $kpiId,
            "month" => $month,
            "year" => $year,
            "formattedRange" => $formattedRange,
            "history" => $history,
            "historyTeam" => $historyTeam
        ];

        // throw new Exception(print_r($data,true));

        header("Content-Type: application/json");
        echo json_encode($data);
        exit;
    }
	public function actionViewPersonalKpi($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$kpiEmployeeId = $param["kpiEmployeeId"];

		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-personal/kpi-employee-detail?kpiEmployeeId=' . $kpiEmployeeId . '&&kpiEmployeeHistoryId=0');
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
		// return $this->redirect(Yii::$app->homeUrl . 'kpi/kpi-personal/individual-kpi-grid');
		return $this->redirect(Yii::$app->request->referrer);

	}
}