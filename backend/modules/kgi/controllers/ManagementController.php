<?php

namespace backend\modules\kgi\controllers;

use backend\models\hrvc\Branch;
use backend\models\hrvc\Company;
use backend\models\hrvc\Country;
use backend\models\hrvc\Department;
use backend\models\hrvc\Employee;
use backend\models\hrvc\KfiHasKgi;
use backend\models\hrvc\KfiHistory;
use backend\models\hrvc\Kgi;
use backend\models\hrvc\KgiBranch;
use backend\models\hrvc\KgiDepartment;
use backend\models\hrvc\KgiEmployee;
use backend\models\hrvc\KgiHasKpi;
use backend\models\hrvc\KgiHistory;
use backend\models\hrvc\KgiIssue;
use backend\models\hrvc\KgiSolution;
use backend\models\hrvc\KgiTeam;
use backend\models\hrvc\KpiTeam;
use backend\models\hrvc\Title;
use backend\models\hrvc\Unit;
use backend\models\hrvc\User;
use common\models\ModelMaster;
use Exception;
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
	public function actionIndex($adminId, $gmId, $managerId, $supervisorId, $teamLeaderId, $staffId, $currentPage, $limit)
	{
		$startAt = (($currentPage - 1) * $limit);
		if (!empty($adminId) || !empty($gmId) || !empty($managerId)) {
			$kgis = Kgi::find()
				->where(["status" => [1, 2, 4]])
				->asArray()
				->orderBy('createDateTime DESC')
				->offset($startAt)
				->limit($limit)
				->asArray()
				->all();
		}
		if (!empty($supervisorId) || !empty($teamLeaderId) || !empty($staffId)) {
			if ($supervisorId != '') {
				$userId = $supervisorId;
			}
			if ($teamLeaderId != '') {
				$userId = $teamLeaderId;
			}
			if ($staffId != '') {
				$userId = $staffId;
			}
			$employeeId = Employee::employeeId($userId);
			$companyId = Employee::EmployeeDetail($employeeId)["companyId"];
			$kgis = Kgi::find()
				->where([
					"status" => [1, 2, 4],
					"companyId" => $companyId
				])
				->asArray()
				->orderBy('createDateTime DESC')
				->asArray()
				->offset($startAt)
				->limit($limit)
				->all();
		}
		$data1 = [];
		$data2 = [];
		$data3 = [];
		$data4 = [];
		$total = 0;
		if (count($kgis) > 0) {
			foreach ($kgis as $kgi) :
				$commonData = [];
				$ratio = 0;
				if ($kgi["targetAmount"] != '' && $kgi["targetAmount"] != 0) {
					if ($kgi["code"] == '<' || $kgi["code"] == '=') {
						$ratio = ($kgi["result"] / $kgi["targetAmount"]) * 100;
					} else {
						if ($kgi["result"] != '' && $kgi["result"] != 0) {
							$ratio = ($kgi["targetAmount"] / $kgi["result"]) * 100;
						} else {
							$ratio = 0;
						}
					}
				} else {
					$ratio = 0;
				}
				$allEmployee = KgiEmployee::kgiEmployee($kgi["kgiId"], $kgi["month"], $kgi["year"]);
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
				if (strlen($kgi["kgiName"]) > 34) {
					$kginame = substr($kgi["kgiName"], 0, 34) . '. . .';
				} else {
					$kginame = $kgi["kgiName"];
				}
				$isOver = ModelMaster::isOverDuedate(Kgi::nextCheckDate($kgi['kgiId']));
				$kgiId = $kgi["kgiId"];
				$commonData = [
					"kgiName" => $kginame,
					"kgiId" => $kgiId,
					"companyId" => $kgi['companyId'],
					"companyName" => Company::companyName($kgi["companyId"]),
					"branch" => KgiBranch::kgiBranch($kgi["kgiId"]),
					"kgiBranch" => KgiBranch::kgiBranches($kgi["kgiId"]),
					"kgiEmployee" => $selectPic,
					"countEmployee" => count($allEmployee),
					"quantRatio" => $kgi["quantRatio"],
					"creater" => User::employeeNameByuserId($kgi["createrId"]),
					"targetAmount" => number_format($kgi["targetAmount"], 2),
					"code" => $kgi["code"],
					"result" => number_format($kgi["result"], 2),
					"unit" => Unit::unitName($kgi["unitId"]),
					"year" => $kgi['year'],
					"month" => ModelMaster::monthEng($kgi['month'], 1),
					"monthShort" => ModelMaster::monthEng($kgi['month'], 2),
					"year" => $kgi["year"],
					"monthNumber" => $kgi["month"],
					"priority" => $kgi["priority"],
					"ratio" => number_format($ratio, 2),
					"periodCheck" => ModelMaster::engDate($kgi["periodDate"], 2), //lastest check
					"nextCheck" => Kgi::nextCheckDate($kgi['kgiId']),
					"countTeam" => KgiTeam::kgiTeam($kgi["kgiId"], $kgi["month"], $kgi["year"]),
					"flag" => Country::countryFlagBycompany($kgi["companyId"]),
					"status" => $kgi["status"],
					"countryName" => Country::countryNameBycompany($kgi['companyId']),
					"issue" => KgiIssue::lastestIssue($kgi["kgiId"])["issue"],
					"solution" => KgiIssue::lastestIssue($kgi["kgiId"])["solution"],
					"fromDate" => ModelMaster::engDate($kgi["fromDate"], 2),
					"toDate" => ModelMaster::engDate($kgi["toDate"], 2),
					"isOver" => $isOver,
					"countKgiHasKfi" => KfiHasKgi::countKfiWithKgi($kgi['kgiId']),
					"countKgiHasKpi" => KgiHasKpi::countKgiHasKpi($kgi['kgiId']),
					"amountType" => $kgi["amountType"],
					"lastestUpdate" => ModelMaster::engDate($kgi["updateDateTime"], 2)
				];
				if (!empty($commonData)) {
					if (($kgi["fromDate"] == "" || $kgi["toDate"] == "") && $isOver == 2) {
						$data1[$kgiId] = $commonData;
					} elseif ($isOver == 1 && $kgi["status"] == 1) {
						$data2[$kgiId] = $commonData;
					} elseif ($kgi["status"] == 2) {
						$data4[$kgiId] = $commonData;
					} else {
						$data3[$kgiId] = $commonData;
					}
					$total++;
				}
			endforeach;
		}

		$data = $data1 + $data2 + $data3 + $data4;
		$result["data"] = $data;
		$result["total"] = $total;
		return json_encode($result);
	}
	public function actionKgiDetail($id, $kgiHistoryId)
	{
		if ($kgiHistoryId == 0) {
			$kgiHistory = KgiHistory::find()->where(["status" => [1, 2, 4], "kgiId" => $id])
				->orderBy('year DESC,month DESC,status DESC,createDateTime DESC')
				->asArray()
				->one();
		} else {
			$kgiHistory = KgiHistory::find()->where(["kgiHistoryId" => $kgiHistoryId])
				->asArray()
				->one();
		}
		$data = [];
		$ratio = 0;
		if (isset($kgiHistory) && !empty($kgiHistory)) { //wait edit
			$kgi = Kgi::find()->where(["kgiId" => $id])->asArray()->one();
			if ($kgi["targetAmount"] != '' && $kgi["targetAmount"] != 0) {
				if ($kgiHistory["code"] == '<' || $kgiHistory["code"] == '=') {
					$ratio = ($kgi["result"] / $kgi["targetAmount"]) * 100;
				} else {
					if ($kgi["result"] != '' && $kgi["result"] != 0) {
						$ratio = ($kgi["targetAmount"] / $kgi["result"]) * 100;
					} else {
						$ratio = 0;
					}
				}
			} else {
				$ratio = 0;
			}
			$data = [
				"kgiName" => $kgi["kgiName"],
				"companyId" => $kgi["companyId"],
				"branch" => KgiBranch::kgiBranch($kgi["kgiId"]),
				"kgiEmployee" => KgiEmployee::kgiEmployee($kgi["kgiId"], $kgi["month"], $kgi["year"]),
				"kgiEmployeeDetail" => KgiEmployee::kgiEmployeeDetail($kgi["kgiId"], $kgi["month"], $kgi["year"]),
				"detail" => $kgiHistory['description'],
				"quantRatio" => $kgiHistory["quantRatio"],
				"targetAmount" => $kgiHistory["targetAmount"],
				"creater" => User::employeeNameByuserId($kgiHistory["createrId"]),
				"amountType" => $kgiHistory["amountType"],
				"countTeam" => KgiTeam::kgiTeam($kgi["kgiId"], $kgi["month"], $kgi["year"]),
				"code" => $kgiHistory["code"],
				"result" => $kgiHistory["result"],
				"unitId" => $kgiHistory["unitId"],
				"month" => $kgiHistory['month'],
				"year" => $kgiHistory['year'],
				"monthName" => strtoupper(ModelMaster::monthEng($kgiHistory['month'], 2)),
				"monthFullName" => ModelMaster::monthEng($kgiHistory['month'], 1),
				"priority" => $kgiHistory["priority"],
				"periodCheck" => $kgiHistory["periodDate"],
				"status" => $kgiHistory["status"],
				"nextCheck" => $kgiHistory["nextCheckDate"],
				"remark" => $kgiHistory["remark"],
				"statusText" => $kgiHistory["status"] == 1 ? 'On process' : 'Finished',
				"nextCheckText" => ModelMaster::engDate($kgiHistory["nextCheckDate"], 2),
				"periodCheckText" => ModelMaster::engDate($kgiHistory["periodDate"], 2),
				"companyName" => Company::companyName($kgi["companyId"]),
				"countryName" => Country::countryNameBycompany($kgi["companyId"]),
				"flag" => Country::countryFlagBycompany($kgi["companyId"]),
				"quantRatioText" => $kgiHistory["quantRatio"] == 1 ? "Quantity" : "Quality",
				"targetAmountText" => number_format($kgiHistory["targetAmount"], 2),
				"resultText" =>  number_format($kgiHistory["result"], 2),
				"ratio" => number_format($ratio, 2),
				"unitText" => Unit::unitName($kgiHistory["unitId"]),
				"fromDate" => $kgiHistory["fromDate"],
				"toDate" => $kgiHistory["toDate"],
				"fromDateFormat" => ModelMaster::dateMonthFullFormatNormal($kgiHistory["fromDate"]),
				"toDateFormat" => ModelMaster::dateMonthFullFormatNormal($kgiHistory["toDate"]),
				"lastUpdate" => ModelMaster::dateNumber($kgiHistory["updateDateTime"]),
				"fromDateDetail" => ModelMaster::engDate($kgiHistory["fromDate"], 2),
				"toDateDetail" => ModelMaster::engDate($kgiHistory["toDate"], 2),
				"isOver" => ModelMaster::isOverDuedate(Kgi::nextCheckDate($kgi['kgiId'])),

			];
		} else {
			$kgi = Kgi::find()->where(["kgiId" => $id])->asArray()->one();
			if ($kgi["targetAmount"] != '' && $kgi["targetAmount"] != 0) {
				if ($kgi["code"] == '<' || $kgi["code"] == '=') {
					$ratio = ($kgi["result"] / $kgi["targetAmount"]) * 100;
				} else {
					if ($kgi["result"] != '' && $kgi["result"] != 0) {
						$ratio = ($kgi["targetAmount"] / $kgi["result"]) * 100;
					} else {
						$ratio = 0;
					}
				}
			} else {
				$ratio = 0;
			}
			$data = [
				"kgiName" => $kgi["kgiName"],
				"companyId" => $kgi["companyId"],
				"branch" => KgiBranch::kgiBranch($kgi["kgiId"]),
				"kgiEmployee" => KgiEmployee::kgiEmployee($kgi["kgiId"], $kgi["month"], $kgi["year"]),
				"kgiEmployeeDetail" => KgiEmployee::kgiEmployeeDetail($kgi["kgiId"], $kgi["month"], $kgi["year"]),
				"creater" => User::employeeNameByuserId($kgi["createrId"]),
				"detail" => $kgi['kgiDetail'],
				"quantRatio" => $kgi["quantRatio"],
				"targetAmount" => $kgi["targetAmount"],
				"countTeam" => KgiTeam::kgiTeam($kgi["kgiId"], $kgi["month"], $kgi["year"]),
				"amountType" => $kgi["amountType"],
				"code" => $kgi["code"],
				"result" => $kgi["result"],
				"unitId" => $kgi["unitId"],
				"month" => $kgi['month'],
				"year" => $kgi['year'],
				"monthName" => strtoupper(ModelMaster::monthEng($kgi['month'], 2)),
				"priority" => $kgi["priority"],
				"periodCheck" => $kgi["periodDate"],
				"status" => $kgi["status"],
				"nextCheck" => "",
				"remark" => "",
				"statusText" => $kgi["status"] == 1 ? 'On process' : 'Finished',
				"nextCheckText" => "",
				"periodCheckText" => ModelMaster::engDate($kgi["periodDate"], 2),
				"companyName" => Company::companyName($kgi["companyId"]),
				"countryName" => Country::countryNameBycompany($kgi["companyId"]),
				"flag" => Country::countryFlagBycompany($kgi["companyId"]),
				"quantRatioText" => $kgi["quantRatio"] == 1 ? "Quantity" : "Quality",
				"targetAmountText" => number_format($kgi["targetAmount"], 2),
				"resultText" =>  number_format($kgi["result"], 2),
				"ratio" => number_format($ratio, 2),
				"unitText" => Unit::unitName($kgi["unitId"]),
				"fromDate" => $kgi["fromDate"],
				"toDate" => $kgi["toDate"],
				"fromDateDetail" => ModelMaster::engDate($kgi["fromDate"], 2),
				"toDateDetail" => ModelMaster::engDate($kgi["toDate"], 2),
				"fromDateFormat" => ModelMaster::dateMonthFullFormatNormal($kgi["fromDate"]),
				"toDateFormat" => ModelMaster::dateMonthFullFormatNormal($kgi["toDate"]),
				"lastUpdate" => '-',
				"isOver" => ModelMaster::isOverDuedate(Kgi::nextCheckDate($kgi['kgiId'])),
			];
		}
		return json_encode($data);
	}
	public function actionKgiBranch($id)
	{
		$kgiBranches = KgiBranch::find()
			->select('kgi_branch.branchId,b.branchName')
			->JOIN("LEFT JOIN", "branch b", "b.branchId=kgi_branch.branchId")
			->where(["kgi_branch.kgiId" => $id, "b.status" => 1, "kgi_branch.status" => 1])
			->asArray()
			->all();
		$data = [];
		if (isset($kgiBranches) && count($kgiBranches)) {
			foreach ($kgiBranches as $kgiBranch) :
				$data[$kgiBranch["branchId"]] = [
					"branchName" => $kgiBranch["branchName"],
					"branchId" => $kgiBranch["branchId"],
				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionKgiDepartment($id)
	{
		$kgiDepartments = KgiDepartment::find()
			->select('kgi_department.departmentId,d.departmentName,d.branchId')
			->JOIN("LEFT JOIN", "department d", "d.departmentId=kgi_department.departmentId")
			->where(["kgi_department.kgiId" => $id, "d.status" => 1, "kgi_department.status" => 1])
			->asArray()
			->all();
		$data = [];
		if (isset($kgiDepartments) && count($kgiDepartments)) {
			foreach ($kgiDepartments as $kgiDepartment) :
				$data[$kgiDepartment["branchId"]][$kgiDepartment["departmentId"]] = $kgiDepartment["departmentName"];
			endforeach;
		}
		return json_encode($data);
	}

	public function actionKgiTeam($id)
	{
		$kgiTeams = KgiTeam::find()
			->select('kgi_team.teamId,t.teamName,t.departmentId')
			->JOIN("LEFT JOIN", "team t", "t.teamId=kgi_team.teamId")
			->where(["kgi_team.kgiId" => $id, "kgi_team.status" => [1, 2, 4], "t.status" => [1, 2, 4]])
			->asArray()
			->all();
		$data = [];
		if (isset($kgiTeams) && count($kgiTeams)) {
			foreach ($kgiTeams as $kgiTeam) :
				$data[$kgiTeam["departmentId"]][$kgiTeam["teamId"]] = $kgiTeam["teamName"];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionKgiEmployee($id)
	{
		$kgiEmployee = KgiEmployee::find()
			->select('e.picture,e.employeeId,e.gender,e.employeeFirstname,e.employeeSurename,e.titleId')
			->JOIN("LEFT JOIN", "employee e", "e.employeeId=kgi_employee.employeeId")
			->where(["kgi_employee.status" => [1, 2], "kgi_employee.kgiId" => $id, "e.status" => 1])
			->andWhere("kgi_employee.employeeId is not null")
			->asArray()
			->all();
		$data = [];
		if (isset($kgiEmployee) && count($kgiEmployee) > 0) {
			foreach ($kgiEmployee as $ke) :
				if ($ke["picture"] != "") {
					$picture = $ke["picture"];
				} else {
					if ($ke["gender"] == 1) {
						$picture = 'image/user.png';
					} else {
						$picture = 'image/lady.jpg';
					}
				}
				$data[$ke["employeeId"]] = [
					"firstname" => $ke["employeeFirstname"],
					"surename" => $ke["employeeSurename"],
					"image" => $picture,
					"title" => Title::titleName($ke["titleId"])
				];
			endforeach;
		}

		return json_encode($data);
	}
	public function actionKgiHistory($kgiId, $kgiHistoryId)
	{
		// $kgiHistory = KgiHistory::find()
		// 	->where(["kgiId" => $kgiId, "status" => [1, 2]])
		// 	->orderBy('kgiHistoryId DESC')
		// 	->asArray()
		// 	->all();
		if ($kgiHistoryId == 0) {
			$kgiHistory = KgiHistory::find()
				->where(["kgiId" => $kgiId, "status" => [1, 2, 4]])
				->orderBy('year DESC,month DESC,kgiHistoryId DESC')
				->asArray()
				->all();
		} else {
			$mainHistory = KgiHistory::find()
				->where(["kgiHistoryId" => $kgiHistoryId])
				->asArray()
				->one();
			$year = $mainHistory["year"];
			$kgiHistory = KgiHistory::find()
				->where(["kgiId" => $kgiId, "status" => [1, 2, 4]])
				->andWhere("year<=$year")
				->orderBy('year DESC,month DESC,kgiHistoryId DESC')
				->asArray()
				->all();
		}
		$data = [];
		if (isset($kgiHistory) && count($kgiHistory) > 0) {
			foreach ($kgiHistory as $history) :
				$time = explode(' ', $history["createDateTime"]);
				$employeeId = Employee::employeeId($history["createrId"]);
				$data[$history["kgiHistoryId"]] = [
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
	public function actionKgiHistoryForChart($kgiId, $kgiHistoryId)
	{
		if ($kgiHistoryId == 0) {
			$kgiHistory = KgiHistory::find()
				->where(["kgiId" => $kgiId, "status" => [1, 2, 4]])
				->orderBy('year ASC,month ASC,kgiHistoryId DESC')
				->asArray()
				->all();
		} else {
			$mainHistory = KgiHistory::find()
				->where(["kgiHistoryId" => $kgiHistoryId])
				->asArray()
				->one();
			$month = $mainHistory["month"];
			$year = $mainHistory["year"];
			$kgiHistory = KgiHistory::find()
				->where(["kgiId" => $kgiId, "status" => [1, 2, 4]])
				->andWhere("year<=$year")
				->orderBy('year ASC,month ASC,kgiHistoryId DESC')
				->asArray()
				->all();
		}
		$data = [];
		if (isset($kgiHistory) && count($kgiHistory) > 0) {
			foreach ($kgiHistory as $history) :
				$time = explode(' ', $history["createDateTime"]);
				$employeeId = Employee::employeeId($history["createrId"]);
				$data[$history["kgiHistoryId"]] = [
					"title" => $history["titleProcess"],
					"remark" => $history["remark"],
					//"result" => $history["result"],
					"picture" => Employee::employeeImage($employeeId),
					"createDate" => ModelMaster::engDateHr($history["createDateTime"]),
					"time" => ModelMaster::timeText($time[1]),
					"status" => $history["status"],
					"target" => $history["targetAmount"],
					"result" => $history["result"],
					"month" => $history["month"],
					"year" => $history["year"],
					"creater" => User::employeeNameByuserId($history["createrId"]),
				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionKgiIssue($kgiId)
	{
		$kgiIssue = KgiIssue::find()
			->where(["status" => [1, 2], "kgiId" => $kgiId])
			->orderBy("kgiIssueId DESC")
			->asArray()
			->all();

		$data = [];
		if (isset($kgiIssue) && count($kgiIssue) > 0) {
			foreach ($kgiIssue as $issue) :
				$employee = Employee::EmployeeDetail($issue["employeeId"]);
				$data[$issue["kgiIssueId"]] = [
					"issue" => $issue["issue"],
					"description" => $issue["description"],
					"file" => $issue["file"],
					"employeeName" => $employee["employeeFirstname"] . ' ' . $employee["employeeSurename"],
					"image" => Employee::employeeImage($issue["employeeId"]),
					"createDateTime" => ModelMaster::timeMonthDateYear($issue["createDateTime"]),
					"solutionList" => KgiSolution::solutionList($issue["kgiIssueId"])
				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionKgiFilter($companyId, $branchId, $teamId, $month, $status, $year, $adminId, $gmId, $managerId, $supervisorId, $teamLeaderId, $staffId, $currentPage, $limit)
	{
		$startAt = (($currentPage - 1) * $limit);
		$data = [];
		$data1 = []; //not set
		$data2 = []; //due passed
		$data3 = []; //inprogess
		$data4 = []; //completed
		$total = 0;
		$searchStatus = '';
		if ($status == 1 || $status == 3 || $status == 4) {
			$searchStatus = 1;
		}
		if ($status == 2) {
			$searchStatus = 2;
		}

		if (!empty($adminId) || !empty($gmId) || !empty($managerId)) {
			$kgis = Kgi::find()
				->select('kgi.*')
				->JOIN("LEFT JOIN", "kgi_branch kb", "kb.kgiId=kgi.kgiId")
				->where(["kgi.status" => [1, 2, 4]])
				->andFilterWhere([
					"kgi.companyId" => $companyId,
					"kb.branchId" => $branchId,
				])
				->orderBy('kgi.createDateTime DESC')
				->asArray()
				->all();
		}
		if (!empty($supervisorId) || !empty($teamLeaderId) || !empty($staffId)) {
			if ($supervisorId != '') {
				$userId = $supervisorId;
			}
			if ($teamLeaderId != '') {
				$userId = $teamLeaderId;
			}
			if ($staffId != '') {
				$userId = $staffId;
			}
			$employeeId = Employee::employeeId($userId);
			$companyId = Employee::EmployeeDetail($employeeId)["companyId"];
			$kgis = Kgi::find()
				->select('kgi.*')
				->JOIN("LEFT JOIN", "kgi_branch kb", "kb.kgiId=kgi.kgiId")
				->where(["kgi.status" => [1, 2, 4], "kgi.companyId" => $companyId])
				->andFilterWhere([
					"kb.branchId" => $branchId,
				])
				->orderBy('kgi.createDateTime DESC')
				->asArray()
				->all();
		}

		if (count($kgis) > 0) {
			$i = 0;
			$count = 1;
			foreach ($kgis as $kgi) :
				$show = 0;
				$commonData = [];
				$kgiHistory = KgiHistory::find()
					->select('kgi_history.*')
					->JOIN("LEFT JOIN", "kgi k", "k.kgiId=kgi_history.kgiId")
					->where(["kgi_history.kgiId" => $kgi["kgiId"], "kgi_history.status" => [1, 2]])
					->andFilterWhere([
						"kgi_history.month" => $month,
						"kgi_history.year" => $year,
						"kgi_history.status" => $searchStatus,
					])
					->asArray()
					->orderBy('kgi_history.year DESC,kgi_history.month DESC,kgi_history.status DESC,kgi_history.createDateTime DESC')
					->one();
				$checkComplete = 0;
				if ($status == 1) {
					$checkComplete = Kgi::checkComplete($kgi["kgiId"], $month, $year, $kgi["year"]);
				}
				if (isset($kgiHistory) && !empty($kgiHistory)  && $checkComplete == 0) {
					$allEmployee = KgiEmployee::kgiEmployee($kgi["kgiId"], $kgiHistory["month"], $kgiHistory["year"]);
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
					if (strlen($kgi["kgiName"]) > 34) {
						$kginame = substr($kgi["kgiName"], 0, 34) . '. . .';
					} else {
						$kginame = $kgi["kgiName"];
					}

					$ratio = 0;
					if ($kgiHistory["targetAmount"] != '' && $kgiHistory["targetAmount"] != 0 && $kgiHistory["targetAmount"] != null) {
						if ($kgiHistory["code"] == '<' || $kgiHistory["code"] == '=') {
							$ratio = ($kgiHistory["result"] / $kgiHistory["targetAmount"]) * 100;
						} else {
							if ($kgiHistory["result"] != '' && $kgiHistory["result"] != 0) {
								$ratio = ($kgiHistory["targetAmount"] / $kgiHistory["result"]) * 100;
							} else {
								$ratio = 0;
							}
						}
					}
					if ($kgi["status"] == 2) {
						$isOver = 0;
					} else {
						if ($kgi["status"] == 1 && $kgi["year"] > $year && $year != '') {
							$isOver = 0;
						} else {
							//$isOver = ModelMaster::isOverDuedate($kgiHistory["nextCheckDate"]);
							$isOver = ModelMaster::isOverDuedate(Kgi::nextCheckDate($kgi['kgiId']));
						}
					}
					$kgiId = $kgi["kgiId"];
					if ($status == 1 && $isOver == 0 && $kgi["status"] == 1) {
						$show = 1;
					} else if ($status == 3 && $isOver == 1) {
						$show = 1;
					} else if ($status == 4 && $isOver == 2) {
						$show = 1;
					} else if ($status == 2 && $kgiHistory["status"] == 2) {
						$show = 1;
					} elseif ($status == '') {
						$show = 1;
					}
					if ($show == 1) {
						$commonData = [
							"kgiName" => $kginame,
							"companyName" => Company::companyName($kgi["companyId"]),
							"companyId" => $kgi["companyId"],
							"branch" => KgiBranch::kgiBranch($kgi["kgiId"]),
							"kgiBranch" => KgiBranch::kgiBranches($kgi["kgiId"]),
							"kgiEmployee" => $selectPic,
							"countEmployee" => count($allEmployee),
							"quantRatio" => $kgi["quantRatio"],
							"targetAmount" => $kgiHistory["targetAmount"],
							"code" => $kgiHistory["code"],
							"result" => $kgiHistory["result"],
							"unit" => Unit::unitName($kgiHistory["unitId"]),
							"month" => ModelMaster::monthEng($kgiHistory['month'], 1),
							"monthShort" => ModelMaster::monthEng($kgiHistory['month'], 2),
							"priority" => $kgiHistory["priority"],
							"ratio" => number_format($ratio, 2),
							"periodCheck" => ModelMaster::engDate($kgiHistory["periodDate"], 2),
							"nextCheck" => Kgi::nextCheckDate($kgi['kgiId']),
							"countTeam" => KgiTeam::kgiTeam($kgi["kgiId"], $kgiHistory["month"], $kgiHistory["year"]),
							"flag" => Country::countryFlagBycompany($kgi["companyId"]),
							"status" => $kgiHistory["status"],
							"countryName" => Country::countryNameBycompany($kgi['companyId']),
							"issue" => KgiIssue::lastestIssue($kgi["kgiId"])["issue"],
							"solution" => KgiIssue::lastestIssue($kgi["kgiId"])["solution"],
							//"employee" => KgiTeam::employeeTeam($kgi['kgiId']),
							"year" => $kgiHistory["year"],
							"fromDate" => ModelMaster::engDate($kgiHistory["fromDate"], 2),
							"toDate" => ModelMaster::engDate($kgiHistory["toDate"], 2),
							"isOver" => $isOver,
							"countKgiHasKfi" => KfiHasKgi::countKfiWithKgi($kgi['kgiId']),
							"countKgiHasKpi" => KgiHasKpi::countKgiHasKpi($kgi['kgiId']),
							"amountType" => $kgi["amountType"],
							"lastestUpdate" => ModelMaster::engDate($kgi["updateDateTime"], 2),
							"monthNumber" => $kgiHistory["month"],
						];
					}

					if (!empty($commonData)) {
						if ($i >= $startAt && $count <= $limit) {
							if (($kgi["fromDate"] == "" || $kgi["toDate"] == "") && $isOver == 2) {
								$data1[$kgiId] = $commonData;
							} elseif ($isOver == 1 && $kgi["status"] == 1) {
								$data2[$kgiId] = $commonData;
							} elseif ($kgi["status"] == 2) {
								$data4[$kgiId] = $commonData;
							} else {
								$data3[$kgiId] = $commonData;
							}
							$count++;
						}
						$total++;
					}
				}

				$i++;
			endforeach;
		}
		$data = $data1 + $data2 + $data3 + $data4;
		$result["data"] = $data;
		$result["total"] = $total;
		return json_encode($result);
	}

	public function actionBranchKgi($branchId)
	{
		$kgiBranch = KgiBranch::branchKgi($branchId);
		return json_encode($kgiBranch);
	}
	public function actionKfiKgi($kgiId)
	{
		$kfiHaskgi = KfiHasKgi::find()
			->select('kfi.kfiId,kfi.kfiName,kfi.unitId,kfi.targetAmount,kfi.month')
			->JOIN("LEFT JOIN", "kfi", "kfi.kfiId=kfi_has_kgi.kfiId")
			->JOIN("LEFT JOIN", "kgi", "kgi.kgiId=kfi_has_kgi.kgiId")
			->where(["kfi_has_kgi.kgiId" => $kgiId, "kfi_has_kgi.status" => 1, "kfi.status" => [1, 2], "kgi.status" => [1, 2]])
			->asArray()
			->all();
		$data = [];
		$ratio = 0;
		if (isset($kfiHaskgi) && count($kfiHaskgi) > 0) {
			foreach ($kfiHaskgi as $kfi) :
				$kfiHistory = KfiHistory::find()
					->where(["kfiId" => $kfi["kfiId"], "status" => [1, 2]])
					->orderBy('kfiHistoryId DESC')
					->asArray()
					->one();
				if (isset($kfiHistory) && !empty($kfiHistory)) {
					if ($kfi["targetAmount"] == null || $kfi["targetAmount"] == '' || $kfi["targetAmount"] == 0) {
						$ratio = 0;
					} else {
						if ($kfiHistory["code"] == '<' || $kfiHistory["code"] == '=') {
							$ratio = ((int)$kfiHistory['result'] / (int)$kfi["targetAmount"]) * 100;
						} else {
							if ($kfiHistory["result"] != '' && $kfiHistory["result"] != 0) {
								$ratio = ((int)$kfi["targetAmount"] / (int)$kfiHistory["result"]) * 100;
							} else {
								$ratio = 0;
							}
						}
					}
					$data[$kfi["kfiId"]] = [
						"kfiName" => $kfi["kfiName"],
						"month" => ModelMaster::monthEng($kfiHistory['month'], 1),
						"unit" => Unit::unitName($kfi['unitId']),
						"ratio" => $ratio
					];
				} else {
					$data[$kfi["kfiId"]] = [
						"kfiName" => $kfi["kfiName"],
						"month" => ModelMaster::monthEng($kfi['month'], 1),
						"unit" => Unit::unitName($kfi['unitId']),
						"ratio" => $ratio
					];
				}

			endforeach;
		}
		return json_encode($data);
	}
	public function actionKgiHasKpi($kgiId)
	{
		$kgiHasKpi = KgiHasKpi::find()
			->select('kpi.kpiName,kpi.kpiId,kpi.unitId,kpi.targetAmount,kpi.month,kpi.code,kpi.result')
			->JOIN("LEFT JOIN", "kpi", "kpi.kpiId=kgi_has_kpi.kpiId")
			->JOIN("LEFT JOIN", "kgi", "kgi.kgiId=kgi_has_kpi.kgiId")
			->where([
				"kgi_has_kpi.kgiId" => $kgiId,
				"kgi_has_kpi.status" => 1,
				"kgi.status" => [1, 2],
				"kpi.status" => [1, 2]
			])
			->asArray()
			->all();
		$data = [];
		if (isset($kgiHasKpi) && count($kgiHasKpi) > 0) {
			foreach ($kgiHasKpi as $kpi):
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
					"kpiId" => $kpi["kpiId"],
					"unitId" => $kpi["unitId"],
					"targetAmount" => number_format($kpi["targetAmount"], 2),
					"code" => $kpi["code"],
					"result" => $kpi["result"],
					"unit" => Unit::unitName($kpi["unitId"]),
					"month" => ModelMaster::monthEng($kpi['month'], 1),
					"ratio" => number_format($ratio, 2),
					"countTeam" => KpiTeam::kpiTeam($kpi["kpiId"], $kpi["month"], $kpi["year"]),
				];
			endforeach;
		}

		return json_encode($data);
	}
	public function actionKgiHistorySummarize($kgiId)
	{
		$kgiHistory = KgiHistory::find()
			->select('kgi_history.kgiHistoryId,kgi_history.month,kgi_history.year,kgi_history.status,kgi_history.nextCheckDate,k.kgiName,kgi_history.result,
			k.kgiId,kgi_history.targetAmount,kgi_history.fromDate,kgi_history.toDate,kgi_history.unitId,kgi_history.code,kgi_history.quantRatio,kgi_history.periodDate,
			kgi_history.nextCheckDate,kgi_history.amountType,kgi_history.fromDate,kgi_history.toDate,k.active,k.companyId')
			->JOIN("LEFT JOIN", "kgi k", "k.kgiId=kgi_history.kgiId")
			->where(["kgi_history.kgiId" => $kgiId])
			->andWhere("kgi_history.status!=99")
			->orderBy("kgi_history.year DESC,kgi_history.month DESC,kgi_history.status DESC,kgi_history.kgiHistoryId DESC")
			->asArray()
			->all();
		$data = [];
		if (isset($kgiHistory) && count($kgiHistory) > 0) {

			foreach ($kgiHistory as $history):
				$allEmployee = KgiEmployee::kgiEmployee2($kgiId, $history["month"], $history["year"]);
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

				if (!isset($data[$history["year"]][$history["month"]])) {
					$ratio = 0;
					if ($history["code"] == '<' || $history["code"] == '=') {
						if ($history["targetAmount"] != 0) {
							$ratio = ((int)$history['result'] / (int)$history["targetAmount"]) * 100;
						}
					} else {
						if ($history["result"] != '' && $history["result"] != 0) {
							$ratio = ((int)$history["targetAmount"] / (int)$history["result"]) * 100;
						} else {
							$ratio = 0;
						}
					}
					$data[$history["year"]][$history["month"]] = [
						"kgiHistoryId" => $history["kgiHistoryId"],
						"kgiName" => $history["kgiName"],
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
						"kgiEmployee" => $selectPic,
						//"countTeam" => KgiTeam::kgiTeam($history["kgiId"], $history["month"], $history["year"]),
						"countTeam" => KgiTeam::kgiTeam2($history["kgiId"], $history["month"], $history["year"]),
					];
				}

			endforeach;
		}
		return json_encode($data);
	}
}
