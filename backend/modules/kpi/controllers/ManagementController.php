<?php

namespace backend\modules\kpi\controllers;

use backend\models\hrvc\Branch;
use backend\models\hrvc\Company;
use backend\models\hrvc\Country;
use backend\models\hrvc\KpiBranch;
use backend\models\hrvc\KpiIssue;
use backend\models\hrvc\KpiTeam;
use backend\models\hrvc\Unit;
use common\models\ModelMaster;
use Exception;
use backend\models\hrvc\Kpi;
use backend\models\hrvc\KpiDepartment;
use backend\models\hrvc\KpiHistory;
use backend\models\hrvc\KpiSolution;
use common\helpers\Path;
use backend\models\hrvc\Employee;
use backend\models\hrvc\KgiHasKpi;
use backend\models\hrvc\KpiEmployee;
use backend\models\hrvc\Position;
use backend\models\hrvc\Role;
use backend\models\hrvc\Title;
use backend\models\hrvc\User;
use backend\models\hrvc\UserRole;
use yii\web\Controller;

/**
 * Default controller for the `masterdata` module
 */
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
class ManagementController extends Controller
{
	public function actionIndex($adminId, $gmId, $managerId, $supervisorId, $teamLeaderId, $staffId)
	{
		$kpis = Kpi::find()
			->where(["status" => [1, 2, 4]])
			->asArray()->all();
		$data = [];
		if (count($kpis) > 0) {
			foreach ($kpis as $kpi) :
				$ratio = 0;
				if ($kpi["targetAmount"] != '' && $kpi["targetAmount"] != 0 && $kpi["targetAmount"] != null) {
					if ($kpi["code"] == '<' || $kpi["code"] == '=') {
						$ratio = ($kpi["result"] / $kpi["targetAmount"]) * 100;
					} else {
						if ($kpi["result"] != '' && $kpi["result"] != 0) {
							$ratio = ($kpi["targetAmount"] / $kpi["result"]) * 100;
						} else {
							$ratio = 0;
						}
					}
				}
				$allEmployee = KpiEmployee::kpiEmployee($kpi["kpiId"]);
				$selectPic = [];
				if (count($allEmployee) >= 3) {
					$randomEmpployee = array_rand($allEmployee, 3);
					$selectPic[0] = $allEmployee[$randomEmpployee[0]];
					$selectPic[1] = $allEmployee[$randomEmpployee[1]];
					$selectPic[2] = $allEmployee[$randomEmpployee[2]];
				} else {
					if (count($allEmployee) > 0) {
						$selectPic = $allEmployee;
						sort($selectPic);
					}
				}
				$data[$kpi["kpiId"]] = [
					"kpiName" => $kpi["kpiName"],
					"companyName" => Company::companyName($kpi["companyId"]),
					"companyId" => $kpi['companyId'],
					"creater" => User::employeeNameByuserId($kpi["createrId"]),
					"branch" => KpiBranch::kpiBranch($kpi["kpiId"]),
					"kpiBranch" => KpiBranch::kpiBranches($kpi["kpiId"]),
					//"kpiEmployee" => KpiEmployee::kpiEmployee($kpi["kpiId"]),
					"kpiEmployee" => $selectPic,
					"countEmployee" => count($allEmployee),
					"quantRatio" => $kpi["quantRatio"],
					"targetAmount" => number_format($kpi["targetAmount"], 2),
					"code" => $kpi["code"],
					"result" => $kpi["result"],
					"unit" => Unit::unitName($kpi["unitId"]),
					"month" => ModelMaster::monthEng($kpi['month'], 1),
					"priority" => $kpi["priority"],
					"ratio" => number_format($ratio, 2),
					"periodCheck" => ModelMaster::engDate($kpi["periodDate"], 2),
					"nextCheck" => Kpi::nextCheckDate($kpi['kpiId']),
					"isOver" => ModelMaster::isOverDuedate(Kpi::nextCheckDate($kpi['kpiId'])),
					"countTeam" => KpiTeam::kpiTeam($kpi["kpiId"]),
					"flag" => Country::countryFlagBycompany($kpi["companyId"]),
					"status" => $kpi["status"],
					"countryName" => Country::countryNameBycompany($kpi['companyId']),
					"issue" => KpiIssue::lastestIssue($kpi["kpiId"])["issue"],
					"solution" => KpiIssue::lastestIssue($kpi["kpiId"])["solution"],
					//"employee" => KpiTeam::employeeTeam($kpi['kpiId']),
					"fromDate" => ModelMaster::engDate($kpi["fromDate"], 2),
					"toDate" => ModelMaster::engDate($kpi["toDate"], 2),
					"countKgiInKpi" => KgiHasKpi::countKgiWithKpi($kpi['kpiId']),
					"amountType" => $kpi["amountType"],
				];
			endforeach;
		}
		return json_encode($data);
	}
	// public function actionPrepareUpdate()
	// {
	// 	$kpiId = $_POST["kpiId"];
	// 	$api = curl_init();
	// 	curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
	// 	curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/kpi-detail?id=' . $kpiId);
	// 	$kpi = curl_exec($api);
	// 	$kpi = json_decode($kpi, true);

	// 	$companyId = $kpi["companyId"];
	// 	$kpiBranchText = '';
	// 	curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/company-branch?id=' . $companyId);
	// 	$kpiBranch = curl_exec($api);
	// 	$kpiBranch = json_decode($kpiBranch, true);
	// 	$kpiBranchText = $this->renderAjax('multi_branch_update', [
	// 		"branches" => $kpiBranch,
	// 		"kpiId" => $kpiId
	// 	]);
	// 	$branch["textBranch"] = $kpiBranchText;

	// 	$kpiDepartmentText = '';
	// 	curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/kpi-department?id=' . $kpiId);
	// 	$kpiDepartment = curl_exec($api);
	// 	$kpiDepartment = json_decode($kpiDepartment, true);
	// 	$kpiDepartmentText = $this->renderAjax('multi_department_update', [
	// 		"d" => $kpiDepartment,
	// 		"kpiId" => $kpiId
	// 	]);
	// 	$department["textDepartment"] = $kpiDepartmentText;


	// 	$kpiTeamText = '';
	// 	curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/kpi-team?id=' . $kpiId);
	// 	$kpiTeam = curl_exec($api);
	// 	$kpiTeam = json_decode($kpiTeam, true);
	// 	$kpiTeamText = $this->renderAjax('multi_team_update', [
	// 		"t" => $kpiTeam,
	// 		"kpiId" => $kpiId
	// 	]);
	// 	$team["textTeam"] = $kpiTeamText;


	// 	$data = array_merge($kpi, $branch, $department, $team);
	// 	curl_close($api);
	// 	return json_encode($data);
	// }
	public function actionKpiDetail($id)
	{
		$kpiHistory = KpiHistory::find()->where(["status" => [1, 2], "kpiId" => $id])->orderBy('kpiHistoryId DESC')->asArray()->one();
		$ratio = 0;
		if (isset($kpiHistory) && !empty($kpiHistory)) { //wait edit
			$kpi = Kpi::find()->where(["kpiId" => $id])->asArray()->one();
			if ($kpi["targetAmount"] != '' && $kpi["targetAmount"] != 0) {
				if ($kpi["code"] == '<' || $kpi["code"] == '=') {
					$ratio = ($kpi["result"] / $kpi["targetAmount"]) * 100;
				} else {
					if ($kpi["result"] != '' && $kpi["result"] != 0) {
						$ratio = ($kpi["targetAmount"] / $kpi["result"]) * 100;
					} else {
						$ratio = 0;
					}
				}
			} else {
				$ratio = 0;
			}
			$data = [
				"kpiName" => $kpi["kpiName"],
				"companyId" => $kpi["companyId"],
				"branch" => KpiBranch::kpiBranch($kpi["kpiId"]),
				"detail" => $kpiHistory['description'],
				"quantRatio" => $kpiHistory["quantRatio"],
				"targetAmount" => $kpiHistory["targetAmount"],
				"creater" => User::employeeNameByuserId($kpiHistory["createrId"]),
				"amountType" => $kpiHistory["amountType"],
				"code" => $kpiHistory["code"],
				"result" => $kpiHistory["result"],
				"unitId" => $kpiHistory["unitId"],
				"month" => $kpiHistory['month'],
				"year" => $kpiHistory['year'],
				"monthName" => strtoupper(ModelMaster::monthEng($kpi['month'], 2)),
				"monthNameFull" => ModelMaster::monthEng($kpi['month'], 1),
				"priority" => $kpiHistory["priority"],
				"periodCheck" => $kpiHistory["periodDate"],
				"status" => $kpiHistory["status"],
				"nextCheck" => $kpiHistory["nextCheckDate"],
				"remark" => $kpiHistory["remark"],
				"statusText" => $kpiHistory["status"] == 1 ? 'On process' : 'Finished',
				"nextCheckText" => ModelMaster::engDate($kpiHistory["nextCheckDate"], 2),
				"periodCheckText" => ModelMaster::engDate($kpiHistory["periodDate"], 2),
				"companyName" => Company::companyName($kpi["companyId"]),
				"countryName" => Country::countryNameBycompany($kpi["companyId"]),
				"flag" => Country::countryFlagBycompany($kpi["companyId"]),
				"quantRatioText" => $kpiHistory["quantRatio"] == 1 ? "Quantity" : "Quality",
				"targetAmountText" => number_format($kpiHistory["targetAmount"], 2),
				"resultText" =>  number_format($kpiHistory["result"], 2),
				"ratio" => number_format($ratio, 2),
				"unitText" => Unit::unitName($kpiHistory["unitId"]),
				"fromDate" => $kpiHistory["fromDate"],
				"toDate" => $kpiHistory["toDate"],
				"isOver" => ModelMaster::isOverDuedate(Kpi::nextCheckDate($kpi['kpiId'])),
				"kpiEmployee" => KpiEmployee::kpiEmployee($kpi['kpiId']),
				"kpiEmployeeDetail" => KpiEmployee::kpiEmployeeDetail($kpi["kpiId"]),
				"countTeam" => KpiTeam::kpiTeam($kpi['kpiId']),
				"unitText" => Unit::unitName($kpiHistory["unitId"]),
				"issue" => KpiIssue::lastestIssue($kpi["kpiId"])["issue"],
				"solution" => KpiIssue::lastestIssue($kpi["kpiId"])["solution"],
				"fromDateDetail" => ModelMaster::engDate($kpiHistory["fromDate"], 2),
				"toDateDetail" => ModelMaster::engDate($kpiHistory["toDate"], 2),
			];
		} else {
			$kpi = Kpi::find()->where(["kpiId" => $id])->asArray()->one();
			if (isset($kpi) && $kpi["targetAmount"] != '' && $kpi["targetAmount"] != 0 && $kpi["targetAmount"] != null) {
				if ($kpi["code"] == '<' || $kpi["code"] == '=') {
					$ratio = ($kpi["result"] / $kpi["targetAmount"]) * 100;
				} else {
					if ($kpi["result"] != '' && $kpi["result"] != 0) {
						$ratio = ($kpi["targetAmount"] / $kpi["result"]) * 100;
					} else {
						$ratio = 0;
					}
				}
			} else {
				$ratio = 0;
			}
			$data = [
				"kpiName" => $kpi["kpiName"],
				"companyId" => $kpi["companyId"],
				"branch" => KpiBranch::kpiBranch($kpi["kpiId"]),
				"creater" => User::employeeNameByuserId($kpi["createrId"]),
				"detail" => $kpi['kpiDetail'],
				"quantRatio" => $kpi["quantRatio"],
				"targetAmount" => $kpi["targetAmount"],
				"amountType" => $kpi["amountType"],
				"code" => $kpi["code"],
				"result" => $kpi["result"],
				"unitId" => $kpi["unitId"],
				"month" => $kpi['month'],
				"year" => $kpi['year'],
				"monthName" => strtoupper(ModelMaster::monthEng($kpi['month'], 2)),
				"priority" => $kpi["priority"],
				"periodCheck" => $kpi["periodDate"],
				"status" => $kpi["status"],
				"nextCheck" => "",
				"remark" => "",
				"statusText" => $kpi["status"] == 1 ? 'On process' : 'Finished',
				"nextCheckText" => "",
				"periodCheckText" => ModelMaster::engDate($kpi["periodDate"], 2),
				"companyName" => Company::companyName($kpi["companyId"]),
				"countryName" => Country::countryNameBycompany($kpi["companyId"]),
				"flag" => Country::countryFlagBycompany($kpi["companyId"]),
				"quantRatioText" => $kpi["quantRatio"] == 1 ? "Quantity" : "Quality",
				"targetAmountText" => number_format($kpi["targetAmount"], 2),
				"resultText" =>  number_format($kpi["result"], 2),
				"ratio" => number_format($ratio, 2),
				"unitText" => Unit::unitName($kpi["unitId"]),
				"fromDate" => $kpi["fromDate"],
				"toDate" => $kpi["toDate"],
				"isOver" => ModelMaster::isOverDuedate(Kpi::nextCheckDate($kpi['kpiId'])),
				"kpiEmployee" => KpiEmployee::kpiEmployee($kpi['kpiId']),
				"kpiEmployeeDetail" => KpiEmployee::kpiEmployeeDetail($kpi["kpiId"]),
				"countTeam" => KpiTeam::kpiTeam($kpi['kpiId']),
				"unitText" => Unit::unitName($kpiHistory["unitId"]),
				"issue" => KpiIssue::lastestIssue($kpi["kpiId"])["issue"],
				"solution" => KpiIssue::lastestIssue($kpi["kpiId"])["solution"],
				"fromDateDetail" => ModelMaster::engDate($kpi["fromDate"], 2),
				"toDateDetail" => ModelMaster::engDate($kpi["toDate"], 2),
			];
		}

		return json_encode($data);
	}
	public function actionKpiBranch($id)
	{
		$kpiBranches = KpiBranch::find()
			->select('kpi_branch.branchId,b.branchName')
			->JOIN("LEFT JOIN", "branch b", "b.branchId=kpi_branch.branchId")
			->where(["kpi_branch.kpiId" => $id])
			->asArray()
			->all();
		$data = [];
		if (isset($kpiBranches) && count($kpiBranches)) {
			foreach ($kpiBranches as $kpiBranch) :
				$data[$kpiBranch["branchId"]] = [
					"branchName" => $kpiBranch["branchName"],
					"branchId" => $kpiBranch["branchId"],
				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionKpiDepartment($id)
	{
		$kpiDepartments = KpiDepartment::find()
			->select('kpi_department.departmentId,d.departmentName,d.branchId')
			->JOIN("LEFT JOIN", "department d", "d.departmentId=kpi_department.departmentId")
			->where(["kpi_department.kpiId" => $id])
			->asArray()
			->all();
		$data = [];
		if (isset($kpiDepartments) && count($kpiDepartments)) {
			foreach ($kpiDepartments as $kpiDepartment) :
				$data[$kpiDepartment["branchId"]][$kpiDepartment["departmentId"]] = $kpiDepartment["departmentName"];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionKpiTeam($id)
	{
		$kpiTeams = KpiTeam::find()
			->select('kpi_team.teamId,t.teamName,t.departmentId')
			->JOIN("LEFT JOIN", "team t", "t.teamId=kpi_team.teamId")
			->where(["kpi_team.kpiId" => $id, "kpi_team.status" => 1, "t.status" => 1])
			->asArray()
			->all();
		$data = [];
		if (isset($kpiTeams) && count($kpiTeams)) {
			foreach ($kpiTeams as $kpiTeam) :
				$data[$kpiTeam["departmentId"]][$kpiTeam["teamId"]] = $kpiTeam["teamName"];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionKpiEmployee($id)
	{
		// $kpiTeams = KpiTeam::find()
		// 	->select('teamId')
		// 	->where(["kpiId" => $id])
		// 	->asArray()
		// 	->all();
		$data = [];
		// if (isset($kpiTeams) && count($kpiTeams) > 0) {
		// 	foreach ($kpiTeams as $team) :
		// 		$employee = Employee::find()
		// 			->select('employeeFirstname,employeeSurename,employeeNumber,employeeId,picture,gender,titleId')
		// 			->where(["teamId" => $team["teamId"], "status" => 1])
		// 			->asArray()
		// 			->orderBy('titleId,employeeFirstname')
		// 			->all();
		// 		if (isset($employee) && count($employee) > 0) {
		// 			foreach ($employee as $em) :
		// 				if ($em['picture'] == "") {
		// 					if ($em['gender'] == 1) {
		// 						$picture = 'image/user.png';
		// 					} else {
		// 						$picture = 'image/lady.jpg';
		// 					}
		// 				} else {
		// 					$picture = $em['picture'];
		// 				}
		// 				$data[$em["employeeId"]] = [
		// 					"firstname" => $em["employeeFirstname"],
		// 					"surename" => $em["employeeSurename"],
		// 					"image" => $picture,
		// 					"position" => Title::titleName($em["titleId"])
		// 				];
		// 			endforeach;
		// 		}

		// 	endforeach;
		// }
		$kpiEmployee = KpiEmployee::find()
			->select('e.employeeFirstname,e.employeeSurename,e.employeeNumber,e.employeeId,e.picture,e.gender,e.titleId')
			->JOIN("LEFT JOIN", "employee e", "e.employeeId=kpi_employee.employeeId")
			->where(["kpi_employee.kpiId" => $id, "kpi_employee.status" => [1, 2, 4]])
			->asArray()
			->all();
		if (isset($kpiEmployee) && count($kpiEmployee) > 0) {
			foreach ($kpiEmployee as $em) :
				if ($em['picture'] == "") {
					if ($em['gender'] == 1) {
						$picture = 'image/user.png';
					} else {
						$picture = 'image/lady.jpg';
					}
				} else {
					$picture = $em['picture'];
				}
				$data[$em["employeeId"]] = [
					"firstname" => $em["employeeFirstname"],
					"surename" => $em["employeeSurename"],
					"image" => $picture,
					"position" => Title::titleName($em["titleId"])
				];
			endforeach;
		}

		return json_encode($data);
	}
	public function actionKpiHistory($kpiId)
	{
		$kpiHistory = KpiHistory::find()
			->where(["kpiId" => $kpiId, "status" => [1, 2]])
			->orderBy('kpiHistoryId DESC')
			->asArray()
			->all();
		$data = [];
		if (isset($kpiHistory) && count($kpiHistory) > 0) {
			foreach ($kpiHistory as $history) :
				$time = explode(' ', $history["createDateTime"]);
				$employeeId = Employee::employeeId($history["createrId"]);
				$data[$history["kpiHistoryId"]] = [
					"title" => $history["titleProcess"],
					"remark" => $history["remark"],
					"result" => $history["result"],
					"creater" => User::employeeNameByuserId($history["createrId"]),
					"picture" => Employee::employeeImage($employeeId),
					"createDate" => ModelMaster::engDateHr($history["createDateTime"]),
					"time" => ModelMaster::timeText($time[1]),
					"status" => $history["status"],
					"target" => $history["targetAmount"],
					"month" => $history["month"],
					"year" => $history["year"],
					"createDateTime" => ModelMaster::monthDateYearTime($history["createDateTime"])
				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionKpiIssue($kpiId)
	{
		$kpiIssue = KpiIssue::find()
			->where(["status" => [1, 2], "kpiId" => $kpiId])
			->orderBy("kpiIssueId DESC")
			->asArray()
			->all();

		$data = [];
		if (isset($kpiIssue) && count($kpiIssue) > 0) {
			foreach ($kpiIssue as $issue) :
				$employee = Employee::EmployeeDetail($issue["employeeId"]);
				$data[$issue["kpiIssueId"]] = [
					"issue" => $issue["issue"],
					"file" => $issue["file"],
					"employeeName" => $employee["employeeFirstname"] . ' ' . $employee["employeeSurename"],
					"image" => Employee::EmployeeDetail($issue["employeeId"])["picture"],
					//"gender" => Employee::EmployeeDetail($issue["employeeId"])["gender"],
					"createDateTime" => ModelMaster::timeMonthDateYear($issue["createDateTime"]),
					"solutionList" => KpiSolution::solutionList($issue["kpiIssueId"])
				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionKpiFilter($companyId, $branchId, $teamId, $month, $status, $year, $adminId, $gmId, $managerId, $supervisorId, $teamLeaderId, $staffId)
	{
		$data = [];
		/*$kpis = Kpi::find()
			->select('kpi.*')
			->JOIN("LEFT JOIN", "kpi_branch kb", "kb.kpiId=kpi.kpiId")
			->JOIN("LEFT JOIN", "kpi_team kt", "kt.kpiId=kpi.kpiId")
			->where(["kpi.status" => [1, 2]])
			->andFilterWhere([
				"kpi.companyId" => $companyId,
				"kb.branchId" => $branchId,
				"kt.teamId" => $teamId,
				"kpi.month" => $month,
				"kpi.status" => $status,
				"kpi.year" => $year,

			])
			->orderBy('kpi.createDateTime ASC')
			->all();*/
		/*if ($adminId != '') {
			$kpis = Kpi::find()
				->select('kpi.*')
				->JOIN("LEFT JOIN", "kpi_branch kb", "kb.kpiId=kpi.kpiId")
				->JOIN("LEFT JOIN", "kpi_team kt", "kt.kpiId=kpi.kpiId")
				->where(["kpi.status" => [1, 2, 4]])
				->andFilterWhere([
					"kpi.companyId" => $companyId,
					"kb.branchId" => $branchId,
					"kt.teamId" => $teamId,
					"kpi.month" => $month,
					"kpi.status" => $status,
					"kpi.year" => $year,
				])
				->orderBy('kpi.createDateTime ASC')
				->all();
		}
		if ($gmId != '') { //edit just in their company, see in every companies
			$kpis = Kpi::find()
				->select('kpi.*')
				->JOIN("LEFT JOIN", "kpi_branch kb", "kb.kpiId=kpi.kpiId")
				->JOIN("LEFT JOIN", "kpi_team kt", "kt.kpiId=kpi.kpiId")
				->where(["kpi.status" => [1, 2, 4]])
				->andFilterWhere([
					"kpi.companyId" => $companyId,
					"kb.branchId" => $branchId,
					"kt.teamId" => $teamId,
					"kpi.month" => $month,
					"kpi.status" => $status,
					"kpi.year" => $year,
				])
				->orderBy('kpi.createDateTime ASC')
				->all();
		}
		if ($managerId != '') {
			//$mBranchId = Branch::userBranchId($managerId);

			$mCompanyId = Company::userCompany($managerId); //userId
			$mBranchId = Branch::companyBranch($mCompanyId);
			$kpis = Kpi::find()
				->select('kpi.*')
				->JOIN("LEFT JOIN", "kpi_branch kb", "kb.kpiId=kpi.kpiId")
				->JOIN("LEFT JOIN", "kpi_team kt", "kt.kpiId=kpi.kpiId")
				->where(["kpi.status" => [1, 2, 4], "kb.branchId" => $mBranchId])
				->andFilterWhere([
					"kpi.companyId" => $companyId,
					"kb.branchId" => $branchId,
					"kt.teamId" => $teamId,
					"kpi.month" => $month,
					"kpi.status" => $status,
					"kpi.year" => $year,
				])
				->orderBy('kpi.createDateTime ASC')
				->all();
		}
		if ($supervisorId != '') {
			//$mDepartmentId = Department::userDepartmentId($supervisorId);
			$mBranchId = Branch::userBranchId($supervisorId);
			$kpis = Kpi::find()
				->select('kpi.*')
				->JOIN("LEFT JOIN", "kpi_branch kb", "kb.kpiId=kpi.kpiId")
				->JOIN("LEFT JOIN", "kpi_team kt", "kt.kpiId=kpi.kpiId")
				->where(["kpi.status" => [1, 2, 4], "kb.branchId" => $mBranchId])
				->andFilterWhere([
					"kpi.companyId" => $companyId,
					"kb.branchId" => $branchId,
					"kt.teamId" => $teamId,
					"kpi.month" => $month,
					"kpi.status" => $status,
					"kpi.year" => $year,
				])
				->orderBy('kpi.createDateTime ASC')
				->all();
		}
		if ($teamLeaderId != '') {
			$mBranchId = Branch::userBranchId($teamLeaderId);
			$kpis = Kpi::find()
				->select('kpi.*')
				->JOIN("LEFT JOIN", "kpi_branch kb", "kb.kpiId=kpi.kpiId")
				->JOIN("LEFT JOIN", "kpi_team kt", "kt.kpiId=kpi.kpiId")
				->where(["kpi.status" => [1, 2, 4], "kb.branchId" => $mBranchId])
				->andFilterWhere([
					"kpi.companyId" => $companyId,
					"kb.branchId" => $branchId,
					"kt.teamId" => $teamId,
					"kpi.month" => $month,
					"kpi.status" => $status,
					"kpi.year" => $year,
				])
				->orderBy('kpi.createDateTime ASC')
				->all();
		}
		if ($staffId != '') {
			$employeeId = Employee::employeeId($staffId);
			$kpis = Kpi::find()
				->select('kpi.*')
				->JOIN("LEFT JOIN", "kpi_branch kb", "kb.kpiId=kpi.kpiId")
				->JOIN("LEFT JOIN", "kpi_employee ke", "ke.kpiId=kpi.kpiId")
				->JOIN("LEFT JOIN", "kpi_team kt", "kt.kpiId=kpi.kpiId")
				->where(["kpi.status" => [1, 2, 4], "ke.employeeId" => $employeeId])
				->andFilterWhere([
					"kpi.companyId" => $companyId,
					"kb.branchId" => $branchId,
					"kt.teamId" => $teamId,
					"kpi.month" => $month,
					"kpi.status" => $status,
					"kpi.year" => $year,
				])
				->orderBy('kpi.createDateTime ASC')
				->all();
		}*/
		$kpis = Kpi::find()
			->select('kpi.*')
			->JOIN("LEFT JOIN", "kpi_branch kb", "kb.kpiId=kpi.kpiId")
			->JOIN("LEFT JOIN", "kpi_team kt", "kt.kpiId=kpi.kpiId")
			->where(["kpi.status" => [1, 2, 4]])
			->andFilterWhere([
				"kpi.companyId" => $companyId,
				"kb.branchId" => $branchId,
				"kt.teamId" => $teamId,
				"kpi.month" => $month,
				"kpi.status" => $status,
				"kpi.year" => $year,
			])
			->orderBy('kpi.createDateTime ASC')
			->all();
		if (count($kpis) > 0) {
			foreach ($kpis as $kpi) :
				$kpiHistory = KpiHistory::find()
					->select('kpi_history.*')
					->JOIN("LEFT JOIN", "kpi k", "k.kpiId=kpi_history.kpiId")
					->JOIN("LEFT JOIN", "kpi_team kt", "kt.kpiId=k.kpiId")
					->where(["kpi_history.kpiId" => $kpi["kpiId"], "kpi_history.status" => [1, 2]])
					->andFilterWhere([
						"kt.teamId" => $teamId,
						"kpi_history.month" => $month,
						"kpi_history.status" => $status,
						"kpi_history.year" => $year,
					])
					->asArray()
					->orderBy('createDateTime DESC')
					->one();
				if (isset($kpiHistory) && count($kpiHistory) > 0) {
					$ratio = 0;
					if ($kpiHistory["targetAmount"] != '' && $kpiHistory["targetAmount"] != 0 && $kpiHistory["targetAmount"] != null) {
						if ($kpiHistory["code"] == '<' || $kpiHistory["code"] == '=') {
							$ratio = ($kpiHistory["result"] / $kpiHistory["targetAmount"]) * 100;
						} else {
							if ($kpi["result"] != '' && $kpi["result"] != 0) {
								$ratio = ($kpiHistory["targetAmount"] / $kpiHistory["result"]) * 100;
							} else {
								$ratio = 0;
							}
						}
					}
					$allEmployee = KpiEmployee::kpiEmployee($kpi["kpiId"]);
					$selectPic = [];
					if (count($allEmployee) >= 3) {
						$randomEmpployee = array_rand($allEmployee, 3);
						$selectPic[0] = $allEmployee[$randomEmpployee[0]];
						$selectPic[1] = $allEmployee[$randomEmpployee[1]];
						$selectPic[2] = $allEmployee[$randomEmpployee[2]];
					} else {
						if (count($allEmployee) > 0) {
							$selectPic = $allEmployee;
							sort($selectPic);
						}
					}
					$data[$kpi["kpiId"]] = [
						"kpiName" => $kpi["kpiName"],
						"companyName" => Company::companyName($kpi["companyId"]),
						"companyId" => $kpi["companyId"],
						"branch" => KpiBranch::kpiBranch($kpi["kpiId"]),
						"kpiBranch" => KpiBranch::kpiBranches($kpi["kpiId"]),
						//"kpiEmployee" => KpiEmployee::kpiEmployee($kpi["kpiId"]),
						"kpiEmployee" => $selectPic,
						"countEmployee" => count($allEmployee),
						"quantRatio" => $kpi["quantRatio"],
						"targetAmount" => $kpiHistory["targetAmount"],
						"code" => $kpiHistory["code"],
						"result" => $kpiHistory["result"],
						"unit" => Unit::unitName($kpiHistory["unitId"]),
						"month" => ModelMaster::monthEng($kpiHistory['month'], 1),
						"priority" => $kpiHistory["priority"],
						"ratio" => number_format($ratio, 2),
						"periodCheck" => ModelMaster::engDate($kpiHistory["periodDate"], 2),
						"nextCheck" => Kpi::nextCheckDate($kpi['kpiId']),
						"isOver" => ModelMaster::isOverDuedate(Kpi::nextCheckDate($kpi['kpiId'])),
						"countTeam" => KpiTeam::kpiTeam($kpi["kpiId"]),
						"flag" => Country::countryFlagBycompany($kpi["companyId"]),
						"status" => $kpiHistory["status"],
						"countryName" => Country::countryNameBycompany($kpi['companyId']),
						"issue" => KpiIssue::lastestIssue($kpi["kpiId"])["issue"],
						"solution" => KpiIssue::lastestIssue($kpi["kpiId"])["solution"],
						"employee" => KpiTeam::employeeTeam($kpi['kpiId']),
						"fromDate" => ModelMaster::engDate($kpiHistory["fromDate"], 2),
						"toDate" => ModelMaster::engDate($kpiHistory["toDate"], 2),
						"year" => $kpiHistory["year"],
						"countKgiInKpi" => KgiHasKpi::countKgiWithKpi($kpi['kpiId']),
						"amountType" => $kpi["amountType"]
					];
				} else {
					$ratio = 0;
					if ($kpi["targetAmount"] != '' && $kpi["targetAmount"] != 0 && $kpi["targetAmount"] != null) {
						if ($kpi["code"] == '<' || $kpi["code"] == '=') {
							$ratio = ($kpi["result"] / $kpi["targetAmount"]) * 100;
						} else {
							if ($kpi["result"] != '' && $kpi["result"] != 0) {
								$ratio = ($kpi["targetAmount"] / $kpi["result"]) * 100;
							} else {
								$ratio = 0;
							}
						}
					}
					$data[$kpi["kpiId"]] = [
						"kpiName" => $kpi["kpiName"],
						"companyName" => Company::companyName($kpi["companyId"]),
						"companyId" => $kpi["companyId"],
						"branch" => KpiBranch::kpiBranch($kpi["kpiId"]),
						"kpiBranch" => KpiBranch::kpiBranches($kpi["kpiId"]),
						"kpiEmployee" => KpiEmployee::kpiEmployee($kpi["kpiId"]),
						"quantRatio" => $kpi["quantRatio"],
						"targetAmount" => $kpi["targetAmount"],
						"code" => $kpi["code"],
						"result" => $kpi["result"],
						"unit" => Unit::unitName($kpi["unitId"]),
						"month" => ModelMaster::monthEng($kpi['month'], 1),
						"priority" => $kpi["priority"],
						"ratio" => number_format($ratio, 2),
						"periodCheck" => ModelMaster::engDate($kpi["periodDate"], 2),
						"nextCheck" => Kpi::nextCheckDate($kpi['kpiId']),
						"isOver" => ModelMaster::isOverDuedate(Kpi::nextCheckDate($kpi['kpiId'])),
						"countTeam" => KpiTeam::kpiTeam($kpi["kpiId"]),
						"flag" => Country::countryFlagBycompany($kpi["companyId"]),
						"status" => $kpi["status"],
						"countryName" => Country::countryNameBycompany($kpi['companyId']),
						"issue" => KpiIssue::lastestIssue($kpi["kpiId"])["issue"],
						"solution" => KpiIssue::lastestIssue($kpi["kpiId"])["solution"],
						"employee" => KpiTeam::employeeTeam($kpi['kpiId']),
						"fromDate" => ModelMaster::engDate($kpi["fromDate"], 2),
						"toDate" => ModelMaster::engDate($kpi["toDate"], 2),
						"year" => $kpi["year"],
						"countKgiInKpi" => KgiHasKpi::countKgiWithKpi($kpi['kpiId']),
						"amountType" => $kpi["amountType"]
					];
				}
			endforeach;
		}
		return json_encode($data);
	}
	public function actionBranchKpi($branchId)
	{
		$kpiBranch = KpiBranch::branchKpi($branchId);
		return json_encode($kpiBranch);
	}
	public function actionKgiKpi($kpiId)
	{
		$kfiHaskgi = KgiHasKpi::find()
			->select('kgi.kgiId,kgi.kgiName,kgi.unitId,kgi.targetAmount,kgi.month,kgi.code,kgi.result')
			->JOIN("LEFT JOIN", "kpi", "kpi.kpiId=kgi_has_kpi.kpiId")
			->JOIN("LEFT JOIN", "kgi", "kgi.kgiId=kgi_has_kpi.kgiId")
			->where([
				"kgi_has_kpi.kpiId" => $kpiId,
				"kgi_has_kpi.status" => 1,
				"kgi.status" => [1, 2],
				"kpi.status" => [1, 2]
			])
			//->groupBy('kgi_has_kpi.kgiId')
			->asArray()
			->all();
		return json_encode($kfiHaskgi);
	}
	public function actionKpiHistorySummarize($kpiId)
	{
		$kpiHistory = kpiHistory::find()
			->select('kpi_history.kpiHistoryId,kpi_history.month,kpi_history.year,kpi_history.status,kpi_history.nextCheckDate,k.kpiName,kpi_history.result,
			k.kpiId,k.targetAmount,kpi_history.fromDate,kpi_history.toDate,kpi_history.unitId,kpi_history.code,kpi_history.quantRatio,kpi_history.periodDate,
			kpi_history.nextCheckDate,kpi_history.amountType,kpi_history.fromDate,kpi_history.toDate,k.active,k.companyId')
			->JOIN("LEFT JOIN", "kpi k", "k.kpiId=kpi_history.kpiId")
			->where(["kpi_history.kpiId" => $kpiId])
			->andWhere("kpi_history.status!=99")
			->orderBy("kpi_history.year DESC,kpi_history.month DESC,kpi_history.kpiHistoryId DESC")
			->asArray()
			->all();
		$data = [];
		if (isset($kpiHistory) && count($kpiHistory) > 0) {
			$allEmployee = kpiEmployee::kpiEmployee($kpiId);
			$selectPic = [];
			if (count($allEmployee) >= 3) {
				$randomEmpployee = array_rand($allEmployee, 3);
				$selectPic[0] = $allEmployee[$randomEmpployee[0]];
				$selectPic[1] = $allEmployee[$randomEmpployee[1]];
				$selectPic[2] = $allEmployee[$randomEmpployee[2]];
			} else {
				if (count($allEmployee) > 0) {
					$selectPic = $allEmployee;
					sort($selectPic);
				}
			}
			foreach ($kpiHistory as $history):
				if (!isset($data[$history["year"]][$history["month"]])) {
					$ratio = 0;
					if ($history["code"] == '<' || $history["code"] == '=') {
						$ratio = ((int)$history['result'] / (int)$history["targetAmount"]) * 100;
					} else {
						if ($history["result"] != '' && $history["result"] != 0) {
							$ratio = ((int)$history["targetAmount"] / (int)$history["result"]) * 100;
						} else {
							$ratio = 0;
						}
					}
					$data[$history["year"]][$history["month"]] = [
						"kpiHistoryId" => $history["kpiHistoryId"],
						"kpiName" => $history["kpiName"],
						"companyId" => $history['companyId'],
						"target" => $history['targetAmount'],
						"unit" => Unit::unitName($history['unitId']),
						"month" => ModelMaster::monthEng($history['month'], 1),
						"year" => $history["year"],
						"status" => $history['status'],
						"quantRatio" => $history["quantRatio"],
						"code" =>  $history["code"],
						"result" => $history["result"],
						"ratio" => number_format($ratio, 2),
						"nextCheck" => ModelMaster::engDate($history["nextCheckDate"], 2),
						"checkDate" => ModelMaster::engDate($history["periodDate"], 2),
						"amountType" => $history["amountType"],
						"isOver" => ModelMaster::isOverDuedate($history["nextCheckDate"]),
						"fromDate" => ModelMaster::engDate($history["fromDate"], 2),
						"toDate" => ModelMaster::engDate($history["toDate"], 2),
						"active" => $history["active"],
						"employee" => count($allEmployee),
						"kpiEmployee" => $selectPic,
						"countTeam" => KpiTeam::kpiTeam($history["kpiId"]),
					];
				}

			endforeach;
		}
		//throw new exception(print_r($data, true));
		return json_encode($data);
	}
}
