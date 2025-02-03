<?php

namespace backend\modules\kpi\controllers;

use backend\models\hrvc\Company;
use backend\models\hrvc\Country;
use backend\models\hrvc\Employee;
use backend\models\hrvc\Kpi;
use backend\models\hrvc\KpiBranch;
use backend\models\hrvc\KpiEmployee;
use backend\models\hrvc\KpiEmployeeHistory;
use backend\models\hrvc\KpiIssue;
use backend\models\hrvc\KpiTeam;
use backend\models\hrvc\Team;
use backend\models\hrvc\Unit;
use backend\models\hrvc\User;
use common\models\ModelMaster;
use Exception;
use yii\web\Controller;

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
class KpiPersonalController extends Controller
{
	public function actionKpiTeamEmployee($kpiId)
	{

		$kpiTeams = KpiTeam::find()
			->select('kpi_team.teamId,t.teamName,kpi_team.target')
			->JOIN("LEFT JOIN", "team t", "t.teamId=kpi_team.teamId")
			->where(["kpi_team.status" => [1, 2, 4]])
			->andWhere(["kpi_team.kpiId" => $kpiId])
			->orderBy('t.teamName')
			->asArray()
			->all();
		$employeeTeam = [];
		if (isset($kpiTeams) && count($kpiTeams) > 0) {
			foreach ($kpiTeams as $team) :
				$kpiEmployee = KpiEmployee::find()
					->select('e.employeeId,e.employeeFirstname,e.employeeSurename,kpi_employee.remark')
					->JOIN("LEFT JOIN", "employee e", "e.employeeId=kpi_employee.employeeId")
					->JOIN("LEFT JOIN", "user u", "u.employeeId=e.employeeId")
					->JOIN("LEFT JOIN", "user_role ur", "ur.userId=u.userId")
					->where(['e.teamId' => $team["teamId"], "kpi_employee.kpiId" => $kpiId])
					->andWhere("e.status!=99")
					->asArray()
					->orderBy('ur.roleId,e.employeeFirstname')
					->all();
				if (isset($kpiEmployee) && count($kpiEmployee) > 0) {
					foreach ($kpiEmployee as $employee) :
						$employeeTeam[$team["teamId"]][$employee["employeeId"]] = [
							"employeeId" => $employee["employeeId"],
							"target" => KpiEmployee::kpiEmployeeTarget($kpiId, $employee["employeeId"]),
							"employeeName" => $employee["employeeFirstname"] . " " . $employee["employeeSurename"],
							"remark" => $employee["remark"],
						];
					endforeach;
				}
			endforeach;
		}
		return json_encode($employeeTeam);
	}
	public function actionEmployeeKpi($userId, $role)
	{
		$employeeId = Employee::employeeId($userId);
		if ($role <= 3) {
			$kpiEmployee = KpiEmployee::find()
				->select('k.kpiName,k.priority,k.quantRatio,k.amountType,k.code,kpi_employee.target,kpi_employee.result,
			kpi_employee.status,kpi_employee.employeeId,k.unitId,kpi_employee.month,kpi_employee.year,k.kpiId,k.companyId,e.teamId,e.picture,
			kpi_employee.kpiEmployeeId,e.employeeFirstname,e.employeeSurename')
				->JOIN("LEFT JOIN", "kpi k", "kpi_employee.kpiId=k.kpiId")
				->JOIN("LEFT JOIN", "employee e", "e.employeeId=kpi_employee.employeeId")
				->where(["kpi_employee.status" => [1, 2, 4], "k.status" => [1, 2, 4], "kpi_employee.employeeId" => $employeeId])
				->orderby('k.createDateTime')
				->asArray()
				->all();
		} else {
			$kpiEmployee = KpiEmployee::find()
				->select('k.kpiName,k.priority,k.quantRatio,k.amountType,k.code,kpi_employee.target,kpi_employee.result,
			kpi_employee.status,kpi_employee.employeeId,k.unitId,kpi_employee.month,kpi_employee.year,k.kpiId,k.companyId,e.teamId,e.picture,
			kpi_employee.kpiEmployeeId,e.employeeFirstname,e.employeeSurename')
				->JOIN("LEFT JOIN", "kpi k", "kpi_employee.kpiId=k.kpiId")
				->JOIN("LEFT JOIN", "employee e", "e.employeeId=kpi_employee.employeeId")
				->where(["kpi_employee.status" => [1, 2, 4], "k.status" => [1, 2, 4]])
				->orderby('k.createDateTime')
				->asArray()
				->all();
		}
		//throw new exception(print_r($kpiEmployee, true));
		$data = [];
		if (count($kpiEmployee) > 0) {
			foreach ($kpiEmployee as $kpi) :
				$kpiEmployeeHistory = KpiEmployeeHistory::find()
					->where(["kpiEmployeeId" => $kpi["kpiEmployeeId"], "status" => [1, 2, 4]])
					->asArray()
					->orderBy('createDateTime DESC')
					->one();
				if (!isset($kpiEmployeeHistory) || empty($kpiEmployeeHistory)) {
					$kpiEmployeeHistory = KpiEmployee::find()
						->where(["kpiEmployeeId" => $kpi["kpiEmployeeId"], "status" => [1, 2, 4]])
						->asArray()
						->orderBy('createDateTime DESC')
						->one();
				}
				$ratio = 0;
				if ($kpi["target"] != '' && $kpi["target"] != 0) {
					if ($kpi["code"] == '<' || $kpi["code"] == '=') {
						$ratio = ($kpi["result"] / $kpi["target"]) * 100;
					} else {
						if ($kpi["result"] != '' && $kpi["result"] != 0) {
							$ratio = ($kpi["target"] / $kpi["result"]) * 100;
						} else {
							$ratio = 0;
						}
					}
				} else {
					$ratio = 0;
				}
				$teamEmployee = KpiEmployee::countKpiFromTeam($kpi["kpiId"], $kpi["teamId"]);
				$countTeamEmployee = count($teamEmployee);
				$selectPic = [];
				if ($countTeamEmployee >= 3) {
					$randomEmpployee = array_rand($teamEmployee, 3);
					$selectPic[0] = $teamEmployee[$randomEmpployee[0]];
					$selectPic[1] = $teamEmployee[$randomEmpployee[1]];
					$selectPic[2] = $teamEmployee[$randomEmpployee[2]];
				} else {
					if ($countTeamEmployee > 0) {
						$selectPic = $teamEmployee;
						sort($selectPic);
					}
				}
				$picture = Employee::employeeImage($kpi["employeeId"]);
				if (strlen($kpi["kpiName"]) > 34) {
					$kpiName = substr($kpi["kpiName"], 0, 34) . '. . .';
				} else {
					$kpiName = $kpi["kpiName"];
				}
				$data[$kpi["kpiEmployeeId"]] = [
					"kpiId" => $kpi["kpiId"],
					"kpiName" => $kpiName,
					"companyId" => $kpi['companyId'],
					"kpiEmployeeId" => $kpi["kpiEmployeeId"],
					"employeeName" => $kpi["employeeFirstname"] . ' ' . $kpi["employeeSurename"],
					"picture" => $picture,
					"companyName" => Company::companyName($kpi["companyId"]),
					"branch" => KpiBranch::kpiBranch($kpi["kpiId"]),
					"employee" => KpiEmployee::kpiEmployee($kpi["kpiId"]),
					"quantRatio" => $kpi["quantRatio"],
					"targetAmount" => $kpi["target"],
					"code" => $kpi["code"],
					"result" => $kpi["result"],
					"unit" => Unit::unitName($kpi["unitId"]),
					"month" => ModelMaster::monthEng($kpi['month'], 1),
					"priority" => $kpi["priority"],
					"ratio" => $ratio,
					"periodCheck" => ModelMaster::engDate(KpiEmployee::lastestCheckDate($kpiEmployeeHistory["kpiEmployeeId"]), 2),
					"nextCheck" =>  ModelMaster::engDate($kpiEmployeeHistory["nextCheckDate"], 2),
					"countTeam" => KpiTeam::kpiTeam($kpi["kpiId"]),
					"flag" => Country::countryFlagBycompany($kpi["companyId"]),
					"status" => $kpiEmployeeHistory["status"],
					"kpiEmployeeHistoryId" => $kpiEmployeeHistory["kpiEmployeeHistoryId"] ?? 0,
					"countryName" => Country::countryNameBycompany($kpi['companyId']),
					"issue" => KpiIssue::lastestIssue($kpi["kpiId"])["issue"],
					"solution" => KpiIssue::lastestIssue($kpi["kpiId"])["solution"],
					"fromDate" => ModelMaster::engDate($kpiEmployeeHistory["fromDate"], 2),
					"toDate" => ModelMaster::engDate($kpiEmployeeHistory["toDate"], 2),
					"isOver" => ModelMaster::isOverDuedate(KpiEmployee::nextCheckDate($kpiEmployeeHistory['kpiEmployeeId'])),
					"amountType" => $kpi["amountType"],
					"teamName" => Team::teamName($kpi["teamId"]),
					"canEdit" => 1,
					"teamMate" =>  $selectPic,
					"countTeamEmployee" => $countTeamEmployee,
				];
			endforeach;
		}
		return json_encode($data);
	}


	public function actionKpiHistory($kpiId, $kpiEmployeeId, $kpiEmployeeHistoryId)
	{
		if ($kpiEmployeeHistoryId == 0) {
			$kpiEmployeeHistory = KpiEmployeeHistory::find()
				->where(["kpiEmployeeId" => $kpiEmployeeId, "status" => [1, 2, 4]])
				->orderBy('year ASC,month ASC,kpiHistoryId DESC')
				->asArray()
				->all();
		} else {
			$mainEmployeeHistory = KpiEmployeeHistory::find()
				->where(["kpiEmployeeHistoryId" => $kpiEmployeeHistoryId])
				->asArray()
				->one();
			// $month = $mainHistory["month"];
			$year = $mainEmployeeHistory["year"];
			$kpiEmployeeHistory = KpiEmployeeHistory::find()
				->where(["kpiEmployeeId" => $kpiEmployeeId, "status" => [1, 2, 4]])
				->andWhere("year<=$year")
				->orderBy('year ASC,month ASC,kpiEmployeeHistoryId DESC')
				->asArray()
				->all();
		}

		$data = [];
		if (isset($kpiEmployeeHistory) && count($kpiEmployeeHistory) > 0) {
			foreach ($kpiEmployeeHistory as $employeehistory) :
				$time = explode(' ', $employeehistory["createDateTime"]);
				$employeeId = Employee::employeeId($employeehistory["createrId"]);
				$data[$employeehistory["kpiEmployeeHistoryId"]] = [
					// "title" => $teamhistory["titleProcess"],
					// "remark" => $teamhistory["remark"],
					//"result" => $history["result"],
					"picture" => Employee::employeeImage($employeehistory),
					"createDate" => ModelMaster::engDateHr($employeehistory["createDateTime"]),
					"time" => ModelMaster::timeText($time[1]),
					"status" => $employeehistory["status"],
					"target" => $employeehistory["target"],
					"result" => $employeehistory["result"],
					"month" => $employeehistory["month"],
					"year" => $employeehistory["year"],
					"creater" => User::employeeNameByuserId($employeehistory["createrId"]),
				];
			endforeach;
		}
		return json_encode($data);
	}

	public function actionKpiHistoryForChart($kpiId, $kpiEmployeeId, $kpiEmployeeHistoryId)
	{

		if ($kpiEmployeeHistoryId == 0) {
			$kpiEmployeeHistory = KpiEmployeeHistory::find()
				->where(["kpiEmployeeId" => $kpiEmployeeId, "status" => [1, 2, 4]])
				->orderBy('year ASC,month ASC,kpiHistoryId DESC')
				->asArray()
				->all();
		} else {
			$mainEmployeeHistory = KpiEmployeeHistory::find()
				->where(["kpiEmployeeHistoryId" => $kpiEmployeeHistoryId])
				->asArray()
				->one();
			// $month = $mainHistory["month"];
			$year = $mainEmployeeHistory["year"];
			$kpiEmployeeHistory = KpiEmployeeHistory::find()
				->where(["kpiEmployeeId" => $kpiEmployeeId, "status" => [1, 2, 4]])
				->andWhere("year<=$year")
				->orderBy('year ASC,month ASC,kpiEmployeeHistoryId DESC')
				->asArray()
				->all();
		}

		$data = [];
		if (isset($kpiEmployeeHistory) && count($kpiEmployeeHistory) > 0) {
			foreach ($kpiEmployeeHistory as $employeehistory) :
				$time = explode(' ', $employeehistory["createDateTime"]);
				$employeeId = Employee::employeeId($employeehistory["createrId"]);
				$data[$employeehistory["kpiEmployeeHistoryId"]] = [
					"title" => $employeehistory["detail"],
					// "remark" => $teamhistory["remark"],
					//"result" => $history["result"],
					"picture" => Employee::employeeImage($employeehistory),
					"createDate" => ModelMaster::engDateHr($employeehistory["createDateTime"]),	
					"time" => ModelMaster::timeText($time[1]),
					"status" => $employeehistory["status"],
					"target" => $employeehistory["target"],
					"result" => $employeehistory["result"],
					"month" => $employeehistory["month"],
					"year" => $employeehistory["year"],
					"creater" => User::employeeNameByuserId($employeehistory["createrId"]),
				];
			endforeach;
		}
		return json_encode($data);
	}

	public function actionKpiEmployeeDetail($kpiEmployeeId, $kpiEmployeeHistoryId)
	// {
	// 	$kpiEmployee = KpiEmployeeHistory::find()
	// 		->select('ke.target,kpi_employee_history.result,kpi_employee_history.kpiEmployeeId,ke.employeeId,
	// 		kpi_employee_history.lastCheckDate,kpi_employee_history.nextCheckDate,kpi_employee_history.detail,kpi_employee_history.fromDate,kpi_employee_history.toDate,
	// 		kpi_employee_history.status,kpi_employee_history.month,kpi_employee_history.year,ke.remark')
	// 		->JOIN("LEFT JOIN", "kpi_employee ke", "ke.kpiEmployeeId=kpi_employee_history.kpiEmployeeId")
	// 		->where(["kpi_employee_history.kpiEmployeeId" => $kpiEmployeeId])
	// 		->orderBy('kpi_employee_history.kpiEmployeeHistoryId DESC')
	// 		->asArray()
	// 		->one();
	// 	if (!isset($kpiEmployee) || empty($kpiEmployee)) {
	// 		$kpiEmployee = KpiEmployee::find()
	// 			->where(["kpiEmployeeId" => $kpiEmployeeId])
	// 			->one();
	// 		$kpiId = $kpiEmployee["kpiId"];
	// 		$employeeId = $kpiEmployee["employeeId"];
	// 	} else {
	// 		$kpiE = KpiEmployee::find()
	// 			->select('kpiId,employeeId')
	// 			->where(["kpiEmployeeId" => $kpiEmployee["kpiEmployeeId"]])
	// 			->asArray()
	// 			->one();
	// 		$kpiId = $kpiE["kpiId"];
	// 		$employeeId = $kpiE["employeeId"];
	// 	}
	// 	$data = [];
	// 	if (count($kpiEmployee) > 0) {
	// 		foreach ($kpiEmployee as $kpi) :
	// 			// $kpiEmployeeHistory = KpiEmployeeHistory::find()
	// 			// ->where(["kpiEmployeeId" => $kpi["kpiEmployeeId"], "status" => [1, 2, 4]])
	// 			// ->asArray()
	// 			// ->orderBy('createDateTime DESC')
	// 			// ->one();
	// 		// if (!isset($kpiEmployeeHistory) || empty($kpiEmployeeHistory)) {
	// 		// 	$kpiEmployeeHistory = KpiEmployee::find()
	// 		// 		->where(["kpiEmployeeId" => $kpi["kpiEmployeeId"], "status" => [1, 2, 4]])
	// 		// 		->asArray()
	// 		// 		->orderBy('createDateTime DESC')
	// 		// 		->one();
	// 		// }
	// 	$ratio = 0;
	// 	$kpiDetail = Kpi::find()
	// 		//->select('kpiName')
	// 		->where(["kpiId" => $kpiId])
	// 		->one();
	// 	if (isset($kpiEmployee) && !empty($kpiEmployee)) {
	// 		if ($kpiEmployee["target"] != '' && $kpiEmployee["target"] != 0) {
	// 			if ($kpiDetail["code"] == '<' || $kpiDetail["code"] == '=') {
	// 				$ratio = ($kpiEmployee["result"] / $kpiEmployee["target"]) * 100;
	// 			} else {
	// 				if ($kpiEmployee["result"] != '' && $kpiEmployee["result"] != 0) {
	// 					$ratio = ($kpiEmployee["target"] / $kpiEmployee["result"]) * 100;
	// 				} else {
	// 					$ratio = 0;
	// 				}
	// 			}
	// 		} else {
	// 			$ratio = 0;
	// 		}
	// 		$employee = Employee::EmployeeDetail($employeeId);
	// 		$data = [
	// 			"kpiName" => $kpiDetail["kpiName"],
	// 			"monthName" => ModelMaster::monthEng($kpiDetail['month'], 1),
	// 			"priority" => $kpiDetail["priority"],
	// 			"quantRatio" => $kpiDetail["quantRatio"],
	// 			"amountType" => $kpiDetail["amountType"],
	// 			"code" => $kpiDetail["code"],
	// 			"ratio" => $ratio,
	// 			"unitText" => Unit::unitName($kpiDetail["unitId"]),
	// 			"target" => !empty($kpiEmployee["target"]) ? $kpiEmployee["target"] : 0,
	// 			"targetAmount" => !empty($kpiEmployee["target"]) ? $kpiEmployee["target"] : 0,
	// 			"result" => !empty($kpiEmployee["result"]) ? $kpiEmployee["result"] : 0,
	// 			"detail" => isset($kpiEmployee["detail"]) ? $kpiEmployee["detail"] : null,
	// 			"nextCheckText" => ModelMaster::engDate($kpiEmployee["nextCheckDate"], 2),
	// 			"nextCheckDate" => isset($kpiEmployee["nextCheckDate"]) ? $kpiEmployee["nextCheckDate"] : null,
	// 			"lastCheckDate" => isset($kpiEmployee["lastCheckDate"]) ? $kpiEmployee["lastCheckDate"] : null,
	// 			"isOver" => ModelMaster::isOverDuedate(KpiEmployee::nextCheckDate($kpiEmployee['kpiEmployeeId'])),
	// 			"status" => $kpiEmployee["status"],
	// 			"fromDate" => ModelMaster::engDate($kpiEmployee["fromDate"], 2),
	// 			"toDate" => ModelMaster::engDate($kpiEmployee["toDate"], 2),
	// 			"employeeName" => $employee["employeeFirstname"] . " " . $employee["employeeSurename"],
	// 			"month" => $kpiEmployee["month"],
	// 			"year" => $kpiEmployee["year"],
	// 			"remark" => $kpiEmployee["remark"]
	// 		];
	// 	}
	// endforeach;
	// }
	{
		if ($kpiEmployeeHistoryId != 0) {
			$kpiEmployee = KpiEmployeeHistory::find()
				->select('ke.target,kpi_employee_history.result,kpi_employee_history.kpiEmployeeId,ke.employeeId,
			kpi_employee_history.lastCheckDate,kpi_employee_history.nextCheckDate,kpi_employee_history.detail,kpi_employee_history.kpiEmployeeHistoryId,
			kpi_employee_history.status,kpi_employee_history.month,kpi_employee_history.year,ke.remark,kpi_employee_history.fromDate,kpi_employee_history.toDate')
				->JOIN("LEFT JOIN", "kpi_employee ke", "ke.kpiEmployeeId=kpi_employee_history.kpiEmployeeId")
				->where(["kpi_employee_history.kpiEmployeeHistoryId" => $kpiEmployeeHistoryId])
				->asArray()
				->one();
		} else {
			$kpiEmployee = kpiEmployeeHistory::find()
				->select('ke.target,kpi_employee_history.result,kpi_employee_history.kpiEmployeeId,ke.employeeId,
			kpi_employee_history.lastCheckDate,kpi_employee_history.nextCheckDate,kpi_employee_history.detail,kpi_employee_history.kpiEmployeeHistoryId,
			kpi_employee_history.status,kpi_employee_history.month,kpi_employee_history.year,ke.remark,kpi_employee_history.fromDate,kpi_employee_history.toDate')
				->JOIN("LEFT JOIN", "kpi_employee ke", "ke.kpiEmployeeId=kpi_employee_history.kpiEmployeeId")
				->where(["kpi_employee_history.kpiEmployeeId" => $kpiEmployeeId])
				->orderBy('kpi_employee_history.kpiEmployeeHistoryId DESC')
				->asArray()
				->one();
		}
		if (!isset($kpiEmployee) || empty($kpiEmployee)) {
			$kpiEmployee = kpiEmployee::find()
				->where(["kpiEmployeeId" => $kpiEmployeeId])
				->one();
			$kpiId = $kpiEmployee["kpiId"];
			$employeeId = $kpiEmployee["employeeId"];
		} else {
			$kpiE = kpiEmployee::find()
				->select('kpiId,employeeId')
				->where(["kpiEmployeeId" => $kpiEmployee["kpiEmployeeId"]])
				->asArray()
				->one();
			$kpiId = $kpiE["kpiId"];
			$employeeId = $kpiE["employeeId"];
		}
		$data = [];
		$ratio = 0;
		$kpiDetail = kpi::find()
			//->select('kpiName')
			->where(["kpiId" => $kpiId])
			->one();
		if (isset($kpiEmployee) && !empty($kpiEmployee)) {
			if ($kpiEmployee["target"] != '' && $kpiEmployee["target"] != 0 && $kpiEmployee["target"] != null) {
				if ($kpiDetail["code"] == '<' || $kpiDetail["code"] == '=') {
					$ratio = ($kpiEmployee["result"] / $kpiEmployee["target"]) * 100;
				} else {
					if ($kpiEmployee["result"] != '' && $kpiEmployee["result"] != 0) {
						$ratio = ($kpiEmployee["target"] / $kpiEmployee["result"]) * 100;
					} else {
						$ratio = 0;
					}
				}
			} else {
				$ratio = 0;
			}
			$employee = Employee::EmployeeDetail($employeeId);
			$data = [
				"kpiId" => $kpiId,
				"kpiName" => $kpiDetail["kpiName"],
				"monthName" => ModelMaster::monthEng($kpiEmployee['month'], 1),
				"priority" => $kpiDetail["priority"],
				"quantRatio" => $kpiDetail["quantRatio"],
				"amountType" => $kpiDetail["amountType"],
				"code" => $kpiDetail["code"],
				"ratio" => $ratio,
				"unitText" => Unit::unitName($kpiDetail["unitId"]),
				"target" => !empty($kpiEmployee["target"]) ? $kpiEmployee["target"] : 0,
				"targetAmount" => !empty($kpiEmployee["target"]) ? $kpiEmployee["target"] : 0,
				"result" => !empty($kpiEmployee["result"]) ? $kpiEmployee["result"] : 0,
				"nextCheckDate" => isset($kpiEmployee["nextCheckDate"]) ? $kpiEmployee["nextCheckDate"] : null,
				"nextCheckText" => ModelMaster::engDate($kpiEmployee["nextCheckDate"], 2),
				"lastCheckDate" => isset($kpiEmployee["lastCheckDate"]) ? $kpiEmployee["lastCheckDate"] : null,
				"fromDate" => $kpiEmployee["fromDate"],
				"toDate" => $kpiEmployee["toDate"],
				"status" => $kpiEmployee["status"],
				"detail" => isset($kpiEmployee["detail"]) ? $kpiEmployee["detail"] : null,
				"employeeName" => $employee["employeeFirstname"] . " " . $employee["employeeSurename"],
				"month" => $kpiEmployee["month"],
				"year" => $kpiEmployee["year"],
				"remark" => $kpiEmployee["remark"],
				"picture" => $employee["picture"],
				"teamName" => Team::teamName($employee["teamId"]),
				"kpiEmployee" => KpiEmployee::kpiEmployee($kpiId),
				// "teamName" => Team::teamName($kpiEmployee["teamId"]),
				"isOver" => ModelMaster::isOverDuedate(KpiEmployee::nextCheckDate($kpiEmployee['kpiEmployeeId']))
			];
		}
		return json_encode($data);
	}
	public function actionKpiEmployeeHistory($kpiEmployeeId)
	{
		$kpiHistory = KpiEmployeeHistory::find()
			->select('kpi_employee_history.*,k.code')
			->JOIN("LEFT JOIN", "kpi_employee ke", "ke.kpiEmployeeId=kpi_employee_history.kpiEmployeeId")
			->JOIN("LEFT JOIN", "kpi k", "k.kpiId=ke.kpiId")
			->where(["kpi_employee_history.kpiEmployeeId" => $kpiEmployeeId, "kpi_employee_history.status" => [1, 2, 4, 88, 89]])
			->asArray()
			->orderBy("kpi_employee_history.createDateTime DESC")
			->all();
		return json_encode($kpiHistory);
	}
	public function actionKpiEmployeeHistoryView($kpiId, $employeeId)
	{
		$kpiEmployeeHistory = KpiEmployeeHistory::find()
			->select('kpi_employee_history.*,e.employeeFirstname,e.employeeSurename')
			->JOIN("LEFT JOIN", "kpi_employee ke", "ke.kpiEmployeeId=kpi_employee_history.kpiEmployeeId")
			->JOIN("LEFT JOIN", "employee e", "e.employeeId=ke.employeeId")
			->where([
				"ke.kpiId" => $kpiId,
				"ke.employeeId" => $employeeId
			])
			->orderBy('kpi_employee_history.createDateTime DESC')
			->asArray()
			->all();
		if (!isset($kpiEmployeeHistory) || count($kpiEmployeeHistory) == 0) {
			$kpiEmployeeHistory = KpiEmployee::find()
				->select('kpi_employee.*,e.employeeFirstname,e.employeeSurename')
				->JOIN("LEFT JOIN", "employee e", "e.employeeId=kpi_employee.employeeId")
				->where([
					"kpi_employee.kpiId" => $kpiId,
					"kpi_employee.employeeId" => $employeeId
				])
				->asArray()
				->all();
		}
		return json_encode($kpiEmployeeHistory);
	}
	public function actionKpiPersonalFilter($companyId, $branchId, $teamId, $month, $status, $year, $userId)
	{
		$employeeId = Employee::employeeId2($userId);
		$kpiEmployees = KpiEmployee::find()
			->select('k.kpiName,k.kpiId,k.unitId,k.quantRatio,k.priority,k.amountType,k.code,kpi_employee.kpiEmployeeId,k.companyId,
			kpi_employee.employeeId,kpi_employee.target,kpi_employee.month,e.employeeFirstname,e.employeeSurename,e.teamId,e.picture')
			->JOIN("LEFT JOIN", "kpi k", "k.kpiId=kpi_employee.kpiId")
			->JOIN("LEFT JOIN", "kpi_branch kb", "kb.kpiId=k.kpiId")
			->JOIN("LEFT JOIN", "employee e", "e.employeeId=kpi_employee.employeeId")
			->where("kpi_employee.status!=99 and k.status!=99")
			->andFilterWhere([
				"kb.branchId" => $branchId,
				"e.teamId" => $teamId,
				"kpi_employee.employeeId" => $employeeId,
				//"kpi_employee.month" => $month,
				//"kpi_employee.year" => $year,
				//"kpi_employee.status" => $status,
			])
			->orderBy("k.createDateTime DESC")
			->asArray()
			->all();
		$data = [];
		if (isset($kpiEmployees) && count($kpiEmployees) > 0) {
			foreach ($kpiEmployees as $kpiEmployee) :
				$kpiEmployeeHistory = KpiEmployeeHistory::find()
					->select('kpi_employee_history.*')
					->JOIN("LEFT JOIN", "kpi_employee ke", "ke.kpiEmployeeId=kpi_employee_history.kpiEmployeeId")
					->JOIN("LEFT JOIN", "employee e", "e.employeeId=ke.employeeId")
					->where([
						"kpi_employee_history.kpiEmployeeId" => $kpiEmployee["kpiEmployeeId"],
						"kpi_employee_history.status" => [1, 2],
					])
					->andFilterWhere([
						"e.teamId" => $teamId,
						"ke.employeeId" => $employeeId,
						"kpi_employee_history.month" => $month,
						"kpi_employee_history.year" => $year,
						"kpi_employee_history.status" => $status,
					])
					->asArray()
					->orderBy('kpi_employee_history.createDateTime DESC')
					->one();
				if (!isset($kpiEmployeeHistory) || empty($kpiEmployeeHistory)) {
					$kpiEmployeeHistory = KpiEmployee::find()
						->JOIN("LEFT JOIN", "employee e", "e.employeeId=kpi_employee.employeeId")
						->where(["kpi_employee.kpiEmployeeId" => $kpiEmployee["kpiEmployeeId"], "kpi_employee.status" => [1, 2]])
						->andFilterWhere([
							"e.teamId" => $teamId,
							"e.employeeId" => $employeeId,
							"kpi_employee.month" => $month,
							"kpi_employee.year" => $year,
							"kpi_employee.status" => $status,
						])
						->asArray()
						->orderBy('createDateTime DESC')
						->one();
				}
				$ratio = 0;
				if ($kpiEmployee["target"] != '' && $kpiEmployee["target"] != 0 && $kpiEmployee["target"] != null) {
					if ($kpiEmployee["code"] == '<' || $kpiEmployee["code"] == '=') {
						$ratio = ($kpiEmployeeHistory["result"] / $kpiEmployee["target"]) * 100;
					} else {
						if ($kpiEmployeeHistory["result"] != '' && $kpiEmployeeHistory["result"] != 0) {
							$ratio = ($kpiEmployee["target"] / $kpiEmployeeHistory["result"]) * 100;
						} else {
							$ratio = 0;
						}
					}
				} else {
					$ratio = 0;
				}
				$teamEmployee = KpiEmployee::countKpiFromTeam($kpiEmployee["kpiId"], $kpiEmployee["teamId"]);
				$countTeamEmployee = count($teamEmployee);
				$selectPic = [];
				if ($countTeamEmployee >= 3) {
					$randomEmpployee = array_rand($teamEmployee, 3);
					$selectPic[0] = $teamEmployee[$randomEmpployee[0]];
					$selectPic[1] = $teamEmployee[$randomEmpployee[1]];
					$selectPic[2] = $teamEmployee[$randomEmpployee[2]];
				} else {
					if ($countTeamEmployee > 0) {
						$selectPic = $teamEmployee;
						sort($selectPic);
					}
				}
				$picture = Employee::employeeImage($kpiEmployee["employeeId"]);
				if (strlen($kpiEmployee["kpiName"]) > 34) {
					$kpiName = substr($kpiEmployee["kpiName"], 0, 34) . '. . .';
				} else {
					$kpiName = $kpiEmployee["kpiName"];
				}
				$data[$kpiEmployee["kpiEmployeeId"]] = [
					"kpiName" => $kpiName,
					"kpiId" => $kpiEmployee["kpiId"],
					"companyName" => Company::companyName($kpiEmployee["companyId"]),
					"employee" => KpiEmployee::kpiEmployee($kpiEmployee["kpiId"]),
					"employeeName" => $kpiEmployee["employeeFirstname"] . ' ' . $kpiEmployee["employeeSurename"],
					"picture" => $picture,
					"branch" => KpiBranch::kpiBranch($kpiEmployee["kpiId"]),
					"priority" => $kpiEmployee["priority"],
					"unit" => Unit::unitName($kpiEmployee["unitId"]),
					"quantRatio" => $kpiEmployee["quantRatio"],
					"targetAmount" => $kpiEmployee["target"],
					"result" => $kpiEmployeeHistory["result"],
					"code" => $kpiEmployee["code"],
					"month" =>  ModelMaster::monthEng($kpiEmployeeHistory['month'], 1),
					"year" => $kpiEmployeeHistory['year'],
					"fromDate" => ModelMaster::engDate($kpiEmployeeHistory["fromDate"], 2),
					"toDate" => ModelMaster::engDate($kpiEmployeeHistory["toDate"], 2),
					//"periodCheck" => ModelMaster::engDate(KpiTeam::lastestCheckDate($kpiEmployeeHistory["kpiTeamId"]), 2),
					"periodCheck" => ModelMaster::engDate(KpiEmployee::lastestCheckDate($kpiEmployee["kpiEmployeeId"]), 2),
					"nextCheck" =>  ModelMaster::engDate($kpiEmployeeHistory["nextCheckDate"], 2),
					"status" => $kpiEmployeeHistory["status"],
					"kpiEmployeeHistoryId" => $kpiEmployeeHistory["kpiEmployeeHistoryId"] ?? 0,
					"flag" => Country::countryFlagBycompany($kpiEmployee["companyId"]),
					"countryName" => Country::countryNameBycompany($kpiEmployee['companyId']),
					"kpiEmployee" => KpiEmployee::kpiEmployee($kpiEmployee["kpiId"]),
					"ratio" => number_format($ratio, 2),
					"isOver" => ModelMaster::isOverDuedate(KpiEmployee::nextCheckDate($kpiEmployeeHistory['kpiEmployeeId'])),
					"amountType" => $kpiEmployee["amountType"],
					"issue" => KpiIssue::lastestIssue($kpiEmployee["kpiId"])["issue"],
					"solution" => KpiIssue::lastestIssue($kpiEmployee["kpiId"])["solution"],
					"countTeam" => KpiTeam::kpiTeam($kpiEmployee["kpiId"]),
					"teamName" => Team::teamName($kpiEmployee["teamId"]),
					"teamMate" =>  $selectPic,
					"countTeamEmployee" => $countTeamEmployee,
					"canEdit" => 1,
				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionKpiIndividualSummarize($kpiEmployeeId)
	{
		$kpiEmployeeHistory = KpiEmployeeHistory::find()
			->select('kpi_employee_history.*,k.unitId,k.quantRatio,k.code,k.amountType')
			->JOIN("LEFT JOIN", "kpi_employee ke", "ke.kpiEmployeeId=kpi_employee_history.kpiEmployeeId")
			->JOIN("LEFT JOIN", "kpi k", "k.kpiId=ke.kpiId")
			->where([
				"kpi_employee_history.kpiEmployeeId" => $kpiEmployeeId,
			])
			->andWhere("kpi_employee_history.status!=99")
			->orderBy("kpi_employee_history.year DESC,kpi_employee_history.month DESC,kpi_employee_history.kpiEmployeeHistoryId")
			->asArray()
			->all();
		$data = [];
		if (isset($kpiEmployeeHistory) && count($kpiEmployeeHistory) > 0) {
			foreach ($kpiEmployeeHistory as $history):
				$ratio = 0;
				if ($history["code"] == '<' || $history["code"] == '=') {
					if ((int)$history["target"] != 0) {
						$ratio = ((int)$history['result'] / (int)$history["target"]) * 100;
					} else {
						$ratio = 0;
					}
				} else {
					if ($history["result"] != '' && $history["result"] != 0) {
						$ratio = ((int)$history["target"] / (int)$history["result"]) * 100;
					} else {
						$ratio = 0;
					}
				}
				$data[$history["year"]][$history["month"]] = [
					"kpiEmployeeHistoryId" => $history["kpiEmployeeHistoryId"],
					"target" => $history['target'],
					"unit" => Unit::unitName($history['unitId']),
					"month" => ModelMaster::monthEng($history['month'], 1),
					"year" => $history["year"],
					"status" => $history['status'],
					"quantRatio" => $history["quantRatio"],
					"code" =>  $history["code"],
					"result" => $history["result"],
					"ratio" => number_format($ratio, 2),
					"amountType" => $history["amountType"],
					"isOver" => ModelMaster::isOverDuedate($history["nextCheckDate"]),
					"fromDate" => ModelMaster::engDate($history["fromDate"], 2),
					"toDate" => ModelMaster::engDate($history["toDate"], 2),
				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionWaitForApprove()
	{
		$kpiEmployee = KpiEmployeeHistory::find()
			->where(["status" => 88])
			->asArray()
			->all();
		$res["totalRequest"] = count($kpiEmployee);
		return json_encode($res);
	}
}