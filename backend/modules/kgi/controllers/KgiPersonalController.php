<?php

namespace backend\modules\kgi\controllers;

use backend\models\hrvc\Company;
use backend\models\hrvc\Country;
use backend\models\hrvc\Employee;
use backend\models\hrvc\Kgi;
use backend\models\hrvc\KgiBranch;
use backend\models\hrvc\KgiEmployee;
use backend\models\hrvc\KgiEmployeeHistory;
use backend\models\hrvc\KgiHistory;
use backend\models\hrvc\KgiIssue;
use backend\models\hrvc\KgiTeam;
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
class KgiPersonalController extends Controller
{
	public function actionKgiTeamEmployee($kgiId)
	{
		$kgiTeams = KgiTeam::find()
			->select('kgi_team.teamId,t.teamName,kgi_team.target')
			->JOIN("LEFT JOIN", "team t", "t.teamId=kgi_team.teamId")
			->where(["kgi_team.status" => [1, 2, 4]])
			->andWhere(["kgi_team.kgiId" => $kgiId])
			->orderBy('t.teamName')
			->asArray()
			->all();
		$employeeTeam = [];
		if (isset($kgiTeams) && count($kgiTeams) > 0) {
			foreach ($kgiTeams as $team) :
				$kgiEmployee = KgiEmployee::find()
					->select('e.employeeId,e.employeeFirstname,e.employeeSurename,kgi_employee.remark')
					->JOIN("LEFT JOIN", "employee e", "e.employeeId=kgi_employee.employeeId")
					->JOIN("LEFT JOIN", "user u", "u.employeeId=e.employeeId")
					->JOIN("LEFT JOIN", "user_role ur", "ur.userId=u.userId")
					->where([
						'e.teamId' => $team["teamId"],
						"kgi_employee.status" => 1,
						"kgi_employee.kgiId" => $kgiId
					])
					->andWhere("e.status!=99")
					->asArray()
					->orderBy('ur.roleId,e.employeeFirstname')
					->all();
				if (isset($kgiEmployee) && count($kgiEmployee) > 0) {
					foreach ($kgiEmployee as $employee) :
						$employeeTeam[$team["teamId"]][$employee["employeeId"]] = [
							"employeeId" => $employee["employeeId"],
							"target" => KgiEmployee::kgiEmployeeTarget($kgiId, $employee["employeeId"]),
							"employeeName" => $employee["employeeFirstname"] . " " . $employee["employeeSurename"],
							"remark" => $employee["remark"],
						];
					endforeach;
				}
			endforeach;
		}
		return json_encode($employeeTeam);
	}
	public function actionEmployeeKgi($userId, $role, $currentPage, $limit)
	{
		$data = [];
		$data1 = [];
		$data2 = [];
		$data3 = [];
		$data4 = [];
		$total = 0;
		$employeeId = Employee::employeeId($userId);
		$startAt = (($currentPage - 1) * $limit);
		if ($role <= 3) {
			$kgiEmployees = KgiEmployee::find()
				->select('k.kgiName,k.priority,k.quantRatio,k.amountType,k.code,kgi_employee.target,kgi_employee.result,,kgi_employee.updateDateTime,
			kgi_employee.status,kgi_employee.employeeId,k.unitId,kgi_employee.month,kgi_employee.year,k.kgiId,k.companyId,e.teamId,e.picture,
			kgi_employee.kgiEmployeeId,e.employeeFirstname,e.employeeSurename,kgi_employee.fromDate,kgi_employee.toDate,kgi_employee.nextCheckDate')
				->JOIN("LEFT JOIN", "kgi k", "kgi_employee.kgiId=k.kgiId")
				->JOIN("LEFT JOIN", "employee e", "e.employeeId=kgi_employee.employeeId")
				->where(["kgi_employee.status" => [1, 2, 4], "k.status" => [1, 2, 4], "kgi_employee.employeeId" => $employeeId, "e.status" => [1]])
				->orderby('k.createDateTime')
				->asArray()
				->all();
		} else {
			$kgiEmployees = KgiEmployee::find()
				->select('k.kgiName,k.priority,k.quantRatio,k.amountType,k.code,kgi_employee.target,kgi_employee.result,kgi_employee.updateDateTime,
			kgi_employee.status,kgi_employee.employeeId,k.unitId,kgi_employee.month,kgi_employee.year,k.kgiId,k.companyId,e.teamId,e.picture,
			kgi_employee.kgiEmployeeId,e.employeeFirstname,e.employeeSurename,kgi_employee.fromDate,kgi_employee.toDate,kgi_employee.nextCheckDate')
				->JOIN("LEFT JOIN", "kgi k", "kgi_employee.kgiId=k.kgiId")
				->JOIN("LEFT JOIN", "employee e", "e.employeeId=kgi_employee.employeeId")
				->where(["kgi_employee.status" => [1, 2, 4], "k.status" => [1, 2, 4], "e.status" => [1]])
				->orderby('k.createDateTime')
				->asArray()
				->all();
		}
		if (count($kgiEmployees) > 0) {
			foreach ($kgiEmployees as $kgiEmployee) :
				$commonData = [];
				$ratio = 0;
				if ($kgiEmployee["target"] != '' && $kgiEmployee["target"] != 0) {
					if ($kgiEmployee["code"] == '<' || $kgiEmployee["code"] == '=') {
						$ratio = ($kgiEmployee["result"] / $kgiEmployee["target"]) * 100;
					} else {
						if ($kgiEmployee["result"] != '' && $kgiEmployee["result"] != 0) {
							$ratio = ($kgiEmployee["target"] / $kgiEmployee["result"]) * 100;
						} else {
							$ratio = 0;
						}
					}
				}
				$kgiEmployeeInteam = KgiEmployee::countKgiFromTeam($kgiEmployee["kgiId"], $kgiEmployee["teamId"], $kgiEmployee["month"], $kgiEmployee["year"]);
				$countTeamEmployee = count($kgiEmployeeInteam);
				$selectPic = [];
				if ($countTeamEmployee >= 3) {
					$randomEmpployee = array_rand($kgiEmployeeInteam, 3);
					$selectPic[0] = $kgiEmployeeInteam[$randomEmpployee[0]];
					$selectPic[1] = $kgiEmployeeInteam[$randomEmpployee[1]];
					$selectPic[2] = $kgiEmployeeInteam[$randomEmpployee[2]];
				} else {
					if ($countTeamEmployee > 0) {
						$selectPic = $kgiEmployeeInteam;
						sort($selectPic);
					}
				}
				if (strlen($kgiEmployee["kgiName"]) > 34) {
					$kginame = substr($kgiEmployee["kgiName"], 0, 34) . '. . .';
				} else {
					$kginame = $kgiEmployee["kgiName"];
				}
				$picture = Employee::employeeImage($kgiEmployee["employeeId"]);
				$isOver = ModelMaster::isOverDuedate($kgiEmployee['nextCheckDate']);
				$kgiEmployeeId = $kgiEmployee["kgiEmployeeId"];
				$commonData = [
					"kgiId" => $kgiEmployee["kgiId"],
					"kgiName" => $kginame,
					"companyId" => $kgiEmployee['companyId'],
					"kgiEmployeeId" => $kgiEmployee["kgiEmployeeId"],
					"employeeName" => $kgiEmployee["employeeFirstname"] . ' ' . $kgiEmployee["employeeSurename"],
					"picture" => $picture,
					"companyName" => Company::companyName($kgiEmployee["companyId"]),
					"branch" => KgiBranch::kgiBranch($kgiEmployee["kgiId"]),
					"employee" => KgiEmployee::kgiEmployee($kgiEmployee["kgiId"], $kgiEmployee["month"], $kgiEmployee["year"]),
					"quantRatio" => $kgiEmployee["quantRatio"],
					"targetAmount" => $kgiEmployee["target"],
					"code" => $kgiEmployee["code"],
					"result" => $kgiEmployee["result"],
					"unit" => Unit::unitName($kgiEmployee["unitId"]),
					"month" => ModelMaster::monthEng($kgiEmployee['month'], 1),
					"priority" => $kgiEmployee["priority"],
					"ratio" => number_format($ratio, 2),
					"periodCheck" => ModelMaster::engDate(KgiEmployee::lastestCheckDate($kgiEmployee["kgiEmployeeId"]), 2),
					"nextCheck" =>  ModelMaster::engDate($kgiEmployee["nextCheckDate"], 2),
					"countTeam" => KgiTeam::kgiTeam($kgiEmployee["kgiId"], $kgiEmployee["month"], $kgiEmployee["year"]),
					"flag" => Country::countryFlagBycompany($kgiEmployee["companyId"]),
					"status" => $kgiEmployee["status"],
					"countryName" => Country::countryNameBycompany($kgiEmployee['companyId']),
					"issue" => KgiIssue::lastestIssue($kgiEmployee["kgiId"])["issue"],
					"solution" => KgiIssue::lastestIssue($kgiEmployee["kgiId"])["solution"],
					"fromDate" => ModelMaster::engDate($kgiEmployee["fromDate"], 2),
					"toDate" => ModelMaster::engDate($kgiEmployee["toDate"], 2),
					//"isOver" => ModelMaster::isOverDuedate(Kgi::nextCheckDate($kgi['kgiId'])),
					"isOver" => $isOver,
					"amountType" => $kgiEmployee["amountType"],
					"teamName" => Team::teamName($kgiEmployee["teamId"]),
					"teamMate" =>  $selectPic,
					"countTeamEmployee" => $countTeamEmployee,
					"canEdit" => 1,
					"lastestUpdate" => ModelMaster::engDate($kgiEmployee["updateDateTime"], 2)
				];
				if (!empty($commonData)) {
					if (($kgiEmployee["fromDate"] == "" || $kgiEmployee["toDate"] == "") && $isOver == 2) {
						$data1[$kgiEmployeeId] = $commonData;
					} elseif ($isOver == 1 && $kgiEmployee["status"] == 1) {
						$data2[$kgiEmployeeId] = $commonData;
					} elseif ($kgiEmployee["status"] == 2) {
						$data4[$kgiEmployeeId] = $commonData;
					} else {
						$data3[$kgiEmployeeId] = $commonData;
					}
					$total++;
				}
			endforeach;
		}

		$data = $data1 + $data2 + $data3 + $data4;
		$data = array_slice($data, $startAt, $limit, true);
		$result["data"] = $data;
		$result["total"] = $total;
		return json_encode($result);
	}
	public function actionKgiEmployeeDetail($kgiEmployeeId, $kgiEmployeeHistoryId)
	{
		if ($kgiEmployeeHistoryId != 0) {
			$kgiEmployee = KgiEmployeeHistory::find()
				->select('ke.target,kgi_employee_history.result,kgi_employee_history.kgiEmployeeId,ke.employeeId,
			kgi_employee_history.lastCheckDate,kgi_employee_history.nextCheckDate,kgi_employee_history.detail,kgi_employee_history.kgiEmployeeHistoryId,
			kgi_employee_history.status,kgi_employee_history.month,kgi_employee_history.year,ke.remark,kgi_employee_history.fromDate,kgi_employee_history.toDate')
				->JOIN("LEFT JOIN", "kgi_employee ke", "ke.kgiEmployeeId=kgi_employee_history.kgiEmployeeId")
				->where(["kgi_employee_history.kgiEmployeeHistoryId" => $kgiEmployeeHistoryId, "kgi_employee_history.status" => [1, 2]])
				->asArray()
				->one();
		} else {
			$kgiEmployee = KgiEmployeeHistory::find()
				->select('ke.target,kgi_employee_history.result,kgi_employee_history.kgiEmployeeId,ke.employeeId,
			kgi_employee_history.lastCheckDate,kgi_employee_history.nextCheckDate,kgi_employee_history.detail,kgi_employee_history.kgiEmployeeHistoryId,
			kgi_employee_history.status,kgi_employee_history.month,kgi_employee_history.year,ke.remark,kgi_employee_history.fromDate,kgi_employee_history.toDate')
				->JOIN("LEFT JOIN", "kgi_employee ke", "ke.kgiEmployeeId=kgi_employee_history.kgiEmployeeId")
				->where(["kgi_employee_history.kgiEmployeeId" => $kgiEmployeeId, "kgi_employee_history.status" => [1, 2]])
				->orderBy('kgi_employee_history.year DESC, kgi_employee_history.month DESC,kgi_employee_history.createDateTime DESC')
				->asArray()
				->one();
		}
		if (!isset($kgiEmployee) || empty($kgiEmployee)) {
			$kgiEmployee = KgiEmployee::find()
				->where(["kgiEmployeeId" => $kgiEmployeeId])
				->one();
			$kgiId = $kgiEmployee["kgiId"];
			$employeeId = $kgiEmployee["employeeId"];
		} else {
			$kgiE = KgiEmployee::find()
				->select('kgiId,employeeId')
				->where(["kgiEmployeeId" => $kgiEmployee["kgiEmployeeId"]])
				->asArray()
				->one();
			$kgiId = $kgiE["kgiId"];
			$employeeId = $kgiE["employeeId"];
		}
		$data = [];
		$ratio = 0;
		$kgiDetail = Kgi::find()
			//->select('kgiName')
			->where(["kgiId" => $kgiId])
			->one();
		if (isset($kgiEmployee) && !empty($kgiEmployee)) {
			if ($kgiEmployee["target"] != '' && $kgiEmployee["target"] != 0 && $kgiEmployee["target"] != null) {
				if ($kgiDetail["code"] == '<' || $kgiDetail["code"] == '=') {
					$ratio = ($kgiEmployee["result"] / $kgiEmployee["target"]) * 100;
				} else {
					if ($kgiEmployee["result"] != '' && $kgiEmployee["result"] != 0) {
						$ratio = ($kgiEmployee["target"] / $kgiEmployee["result"]) * 100;
					} else {
						$ratio = 0;
					}
				}
			} else {
				$ratio = 0;
			}
			$employee = Employee::EmployeeDetail($employeeId);
			$data = [
				"kgiName" => $kgiDetail["kgiName"],
				"kgiId" => $kgiId,
				"monthName" => ModelMaster::monthEng($kgiEmployee['month'], 1),
				"priority" => $kgiDetail["priority"],
				"quantRatio" => $kgiDetail["quantRatio"],
				"amountType" => $kgiDetail["amountType"],
				"code" => $kgiDetail["code"],
				"ratio" => $ratio,
				"unitText" => Unit::unitName($kgiDetail["unitId"]),
				"target" => $kgiEmployee["target"],
				"result" => !empty($kgiEmployee["result"]) ? $kgiEmployee["result"] : 0,
				"detail" => isset($kgiEmployee["detail"]) ? $kgiEmployee["detail"] : null,
				"nextCheckDate" => isset($kgiEmployee["nextCheckDate"]) ? $kgiEmployee["nextCheckDate"] : null,
				"nextCheckText" => ModelMaster::engDate($kgiEmployee["nextCheckDate"], 2),
				"lastCheckDate" => isset($kgiEmployee["lastCheckDate"]) ? $kgiEmployee["lastCheckDate"] : null,
				"fromDate" => $kgiEmployee["fromDate"],
				"toDate" => $kgiEmployee["toDate"],
				"status" => $kgiEmployee["status"],
				"employeeName" => $employee["employeeFirstname"] . " " . $employee["employeeSurename"],
				"month" => $kgiEmployee["month"],
				"year" => $kgiEmployee["year"],
				"remark" => $kgiEmployee["remark"],
				"teamName" => Team::teamName($employee["teamId"]),
				"picture" => $employee["teamId"],
				"isOver" => ModelMaster::isOverDuedate($kgiEmployee["nextCheckDate"]),
				"kgiEmployee" => KgiEmployee::kgiEmployee($kgiId, $kgiEmployee["month"], $kgiEmployee["year"]),
				// "isOver" => ModelMaster::isOverDuedate(KgiEmployeeHistory::nextCheckDate($kgiEmployee["kgiEmployeeHistoryId"])),
			];
		}
		return json_encode($data);
	}
	public function actionKgiEmployeeHistory($kgiEmployeeId)
	{
		$kgiHistory = KgiEmployeeHistory::find()
			->select('kgi_employee_history.*,k.code')
			->JOIN("LEFT JOIN", "kgi_employee ke", "ke.kgiEmployeeId=kgi_employee_history.kgiEmployeeId")
			->JOIN("LEFT JOIN", "kgi k", "k.kgiId=ke.kgiId")
			->where(["kgi_employee_history.kgiEmployeeId" => $kgiEmployeeId, "kgi_employee_history.status" => [1, 2, 4, 88, 89]])
			->asArray()
			->orderBy("kgi_employee_history.createDateTime DESC")
			->all();
		return json_encode($kgiHistory);
	}
	public function actionKgiEmployeeHistoryView($kgiId, $employeeId)
	{
		$kgiEmployeeHistory = KgiEmployeeHistory::find()
			->select('kgi_employee_history.*,e.employeeFirstname,e.employeeSurename')
			->JOIN("LEFT JOIN", "kgi_employee ke", "ke.kgiEmployeeId=kgi_employee_history.kgiEmployeeId")
			->JOIN("LEFT JOIN", "employee e", "e.employeeId=ke.employeeId")
			->where([
				"ke.kgiId" => $kgiId,
				"ke.employeeId" => $employeeId
			])
			->orderBy('kgi_employee_history.createDateTime DESC')
			->asArray()
			->all();
		if (!isset($kgiEmployeeHistory) || count($kgiEmployeeHistory) == 0) {
			$kgiEmployeeHistory = KgiEmployee::find()
				->select('kgi_employee.*,e.employeeFirstname,e.employeeSurename')
				->JOIN("LEFT JOIN", "employee e", "e.employeeId=kgi_employee.employeeId")
				->where([
					"kgi_employee.kgiId" => $kgiId,
					"kgi_employee.employeeId" => $employeeId
				])
				->asArray()
				->all();
		}
		return json_encode($kgiEmployeeHistory);
	}
	public function actionKgiPersonalFilter($companyId, $branchId, $teamId, $month, $status, $year, $userId, $currentPage, $limit)
	{
		$data = [];
		$data1 = [];
		$data2 = [];
		$data3 = [];
		$data4 = [];
		$total = 0;
		$searchStatus = '';
		$startAt = (($currentPage - 1) * $limit);
		if ($status == 1 || $status == 3 || $status == 4) {
			$searchStatus = 1;
		}
		if ($status == 2) {
			$searchStatus = 2;
		}
		$employeeId = Employee::employeeId2($userId);
		$kgiEmployees = KgiEmployee::find()
			->select('k.kgiName,k.kgiId,k.unitId,k.quantRatio,k.priority,k.amountType,k.code,kgi_employee.kgiEmployeeId,k.companyId,kgi_employee.updateDateTime,
			kgi_employee.employeeId,kgi_employee.target,kgi_employee.month,kgi_employee.year,e.employeeFirstname,e.employeeSurename,e.teamId,e.picture')
			->JOIN("LEFT JOIN", "kgi k", "k.kgiId=kgi_employee.kgiId")
			->JOIN("LEFT JOIN", "kgi_branch kb", "kb.kgiId=k.kgiId")
			->JOIN("LEFT JOIN", "employee e", "e.employeeId=kgi_employee.employeeId")
			->where("kgi_employee.status!=99 and k.status!=99")
			->andWhere(["e.status" => [1]])
			->andFilterWhere([
				"kb.branchId" => $branchId,
				"e.branchId" => $branchId,
				"e.teamId" => $teamId,
				"kgi_employee.employeeId" => $employeeId,
				"k.companyId" => $companyId
			])
			->orderBy("k.createDateTime DESC")
			->asArray()
			->all();
		$data = [];
		if (isset($kgiEmployees) && count($kgiEmployees) > 0) {
			$i = 0;
			$count = 1;
			foreach ($kgiEmployees as $kgiEmployee) :
				$commonData = [];
				$show = 0;
				$kgiEmployeeHistory = KgiEmployeeHistory::find()
					->select('kgi_employee_history.*,ke.employeeId')
					->JOIN("LEFT JOIN", "kgi_employee ke", "ke.kgiEmployeeId=kgi_employee_history.kgiEmployeeId")
					->JOIN("LEFT JOIN", "employee e", "e.employeeId=ke.employeeId")
					->where([
						"kgi_employee_history.kgiEmployeeId" => $kgiEmployee["kgiEmployeeId"],
						"kgi_employee_history.status" => [1, 2]
					])
					->andFilterWhere([
						"kgi_employee_history.month" => $month,
						"kgi_employee_history.year" => $year,
						"kgi_employee_history.status" => $searchStatus,
					])
					->orderBy('kgi_employee_history.year DESC,kgi_employee_history.month DESC,kgi_employee_history.status DESC,kgi_employee_history.createDateTime DESC')
					->asArray()
					->one();
				$ratio = 0;
				$checkComplete = 0;
				if ($status == 1) {
					$checkComplete = KgiEmployee::checkComplete($kgiEmployee["kgiEmployeeId"], $month, $year, $kgiEmployee["year"]);
				}
				if (isset($kgiEmployeeHistory) && !empty($kgiEmployeeHistory)  && $checkComplete == 0) {
					if ($kgiEmployeeHistory["target"] != '' && $kgiEmployeeHistory["target"] != 0 && $kgiEmployeeHistory["target"] != null) {
						if ($kgiEmployee["code"] == '<' || $kgiEmployee["code"] == '=') {
							$ratio = ($kgiEmployeeHistory["result"] / $kgiEmployeeHistory["target"]) * 100;
						} else {
							if ($kgiEmployeeHistory["result"] != '' && $kgiEmployeeHistory["result"] != 0) {
								$ratio = ($kgiEmployeeHistory["target"] / $kgiEmployeeHistory["result"]) * 100;
							} else {
								$ratio = 0;
							}
						}
					}
					$kgiEmployeeInteam = KgiEmployee::countKgiFromTeam($kgiEmployee["kgiId"], $kgiEmployee["teamId"], $kgiEmployeeHistory["month"], $kgiEmployeeHistory['year']);
					$countTeamEmployee = count($kgiEmployeeInteam);
					$selectPic = [];
					if ($countTeamEmployee >= 3) {
						$randomEmpployee = array_rand($kgiEmployeeInteam, 3);
						$selectPic[0] = $kgiEmployeeInteam[$randomEmpployee[0]];
						$selectPic[1] = $kgiEmployeeInteam[$randomEmpployee[1]];
						$selectPic[2] = $kgiEmployeeInteam[$randomEmpployee[2]];
					} else {
						if ($countTeamEmployee > 0) {
							$selectPic = $kgiEmployeeInteam;
							sort($selectPic);
						}
					}
					if (strlen($kgiEmployee["kgiName"]) > 34) {
						$kginame = substr($kgiEmployee["kgiName"], 0, 34) . '. . .';
					} else {
						$kginame = $kgiEmployee["kgiName"];
					}

					if ($kgiEmployeeHistory["status"] == 2) {
						$isOver = 0;
					} else {
						if ($kgiEmployeeHistory["status"] == 1 && $kgiEmployeeHistory["year"] > $year && $year != '') {
							$isOver = 0;
						} else {
							$isOver = ModelMaster::isOverDuedate($kgiEmployeeHistory["nextCheckDate"]);
							//$isOver = ModelMaster::isOverDuedate(KgiEmployee::nextCheckDate($kgiEmployeeHistory['kgiEmployeeId']));
						}
					}
					$picture = Employee::employeeImage($kgiEmployeeHistory["employeeId"]);
					$kgiEmployeeId = $kgiEmployeeHistory["kgiEmployeeId"];
					if ($status == 1 && $isOver == 0 && $kgiEmployee["status"] == 1) {
						$show = 1;
					} else if ($status == 3 && $isOver == 1) {
						$show = 1;
					} else if ($status == 4 && $isOver == 2) {
						$show = 1;
					} else if ($status == 2 && $kgiEmployeeHistory["status"] == 2) {
						$show = 1;
					} elseif ($status == '') {
						$show = 1;
					}
					if ($show == 1) {
						$commonData = [
							"kgiName" => $kginame,
							"kgiId" => $kgiEmployee["kgiId"],
							"kgiEmployeeHistoryId" => $kgiEmployeeHistory["kgiEmployeeHistoryId"],
							"companyName" => Company::companyName($kgiEmployee["companyId"]),
							"employee" => KgiEmployee::kgiEmployee($kgiEmployee["kgiId"], $kgiEmployeeHistory["month"], $kgiEmployeeHistory["year"]),
							"employeeName" => $kgiEmployee["employeeFirstname"] . ' ' . $kgiEmployee["employeeSurename"],
							"picture" => $picture,
							"branch" => KgiBranch::kgiBranch($kgiEmployee["kgiId"]),
							"priority" => $kgiEmployee["priority"],
							"unit" => Unit::unitName($kgiEmployee["unitId"]),
							"quantRatio" => $kgiEmployee["quantRatio"],
							"targetAmount" => $kgiEmployeeHistory["target"],
							"result" => $kgiEmployeeHistory["result"],
							"code" => $kgiEmployee["code"],
							"month" =>  ModelMaster::monthEng($kgiEmployeeHistory['month'], 1),
							"year" => $kgiEmployeeHistory['year'],
							"fromDate" => ModelMaster::engDate($kgiEmployeeHistory["fromDate"], 2),
							"toDate" => ModelMaster::engDate($kgiEmployeeHistory["toDate"], 2),
							"periodCheck" => ModelMaster::engDate(KgiEmployee::lastestCheckDate($kgiEmployee["kgiEmployeeId"]), 2),
							"nextCheck" =>  ModelMaster::engDate($kgiEmployeeHistory["nextCheckDate"], 2),
							"status" => $kgiEmployeeHistory["status"],
							"flag" => Country::countryFlagBycompany($kgiEmployee["companyId"]),
							"countryName" => Country::countryNameBycompany($kgiEmployee['companyId']),
							"kgiEmployee" => KgiEmployee::kgiEmployee($kgiEmployee["kgiId"], $kgiEmployeeHistory["month"], $kgiEmployeeHistory["year"]),
							"ratio" => number_format($ratio, 2),
							"isOver" => $isOver,
							"amountType" => $kgiEmployee["amountType"],
							"issue" => KgiIssue::lastestIssue($kgiEmployee["kgiId"])["issue"],
							"solution" => KgiIssue::lastestIssue($kgiEmployee["kgiId"])["solution"],
							"countTeam" => KgiTeam::kgiTeam($kgiEmployee["kgiId"], $kgiEmployeeHistory["month"], $kgiEmployeeHistory["year"]),
							"teamMate" =>  $selectPic,
							"teamName" => Team::teamName($teamId),
							"countTeamEmployee" => $countTeamEmployee,
							"lastestUpdate" => ModelMaster::engDate($kgiEmployeeHistory["updateDateTime"], 2)
						];
					}
					if (!empty($commonData)) {

						if (($kgiEmployeeHistory["fromDate"] == "" || $kgiEmployeeHistory["toDate"] == "") && $isOver == 2) {
							$data1[$kgiEmployeeId] = $commonData;
						} elseif ($isOver == 1 && $kgiEmployeeHistory["status"] == 1) {
							$data2[$kgiEmployeeId] = $commonData;
						} elseif ($kgiEmployeeHistory["status"] == 2) {
							$data4[$kgiEmployeeId] = $commonData;
						} else {
							$data3[$kgiEmployeeId] = $commonData;
						}
						$count++;
						$total++;
						$i++;
					}
				}
			endforeach;
		}
		//throw new exception(print_r($data1, true));
		$data = $data1 + $data2 + $data3 + $data4;
		$data = array_slice($data, $startAt, $limit, true);
		$result["data"] = $data;
		$result["total"] = $total;
		return json_encode($result);
	}
	public function actionKgiIndividualSummarize($kgiEmployeeId)
	{
		$kgiEmployeeHistory = KgiEmployeeHistory::find()
			->select('kgi_employee_history.*,k.unitId,k.quantRatio,k.code,k.amountType')
			->JOIN("LEFT JOIN", "kgi_employee ke", "ke.kgiEmployeeId=kgi_employee_history.kgiEmployeeId")
			->JOIN("LEFT JOIN", "kgi k", "k.kgiId=ke.kgiId")
			->where([
				"kgi_employee_history.kgiEmployeeId" => $kgiEmployeeId,
				"kgi_employee_history.status" => [1, 2, 4]

			])
			->andWhere("kgi_employee_history.status!=99")
			->orderBy("kgi_employee_history.year DESC,kgi_employee_history.month DESC,kgi_employee_history.status DESC,kgi_employee_history.updateDateTime DESC")
			->asArray()
			->all();
		$data = [];
		if (isset($kgiEmployeeHistory) && count($kgiEmployeeHistory) > 0) {
			foreach ($kgiEmployeeHistory as $history):
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
				if (!isset($data[$history["year"]][$history["month"]])) {
					$data[$history["year"]][$history["month"]] = [
						"kgiEmployeeHistoryId" => $history["kgiEmployeeHistoryId"],
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
				}
			endforeach;
		}
		return json_encode($data);
	}
	public function actionWaitForApprove()
	{
		$kgiEmployee = KgiEmployeeHistory::find()
			->where(["status" => 88])
			->asArray()
			->all();
		$res["totalRequest"] = count($kgiEmployee);
		return json_encode($res);
	}
	public function actionKgiEmployeeHistory2($kgiEmployeeId, $kgiEmployeeHistoryId)
	{
		if ($kgiEmployeeHistoryId == 0) {
			$kgiHistory = KgiEmployeeHistory::find()
				->where(["kgiEmployeeId" => $kgiEmployeeId, "status" => [1, 2, 4]])
				->orderBy('year DESC,month DESC,kgiEmployeeHistoryId DESC')
				->asArray()
				->all();
		} else {
			$mainHistory = KgiEmployeeHistory::find()
				->where(["kgiEmployeeHistoryId" => $kgiEmployeeHistoryId])
				->asArray()
				->one();
			$year = $mainHistory["year"];
			$kgiHistory = KgiEmployeeHistory::find()
				->where(["kgiEmployeeId" => $mainHistory["kgiEmployeeId"], "status" => [1, 2, 4]])
				->andWhere("year<=$year")
				->orderBy('year DESC,month DESC,kgiEmployeeHistoryId DESC')
				->asArray()
				->all();
		}
		$data = [];
		if (isset($kgiHistory) && count($kgiHistory) > 0) {
			foreach ($kgiHistory as $history) :
				$time = explode(' ', $history["createDateTime"]);
				$employeeId = Employee::employeeId($history["createrId"]);
				$data[$history["kgiEmployeeHistoryId"]] = [
					"title" => $history["detail"],
					// "remark" => $history["remark"],
					"result" => $history["result"],
					"creater" => User::employeeNameByuserId($history["createrId"]),
					"picture" => Employee::employeeImage($employeeId),
					"createDate" => ModelMaster::engDateHr($history["createDateTime"]),
					"time" => ModelMaster::timeText($time[1]),
					"status" => $history["status"],
					"target" => $history["target"],
					"month" => $history["month"],
					"year" => $history["year"],
					"createDateTime" => ModelMaster::monthDateYearTime($history["createDateTime"])
				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionKgiEmployeeHistoryForChart($kgiEmployeeHistoryId, $kgiEmployeeId)
	{
		if ($kgiEmployeeHistoryId == 0) {
			$kgiHistory = KgiEmployeeHistory::find()
				->where(["kgiEmployeeId" => $kgiEmployeeId, "status" => [1, 2, 4]])
				->orderBy('year ASC,month ASC,kgiEmployeeHistoryId DESC')
				->asArray()
				->all();
		} else {
			$mainHistory = KgiEmployeeHistory::find()
				->where(["kgiEmployeeHistoryId" => $kgiEmployeeHistoryId])
				->asArray()
				->one();
			$month = $mainHistory["month"];
			$year = $mainHistory["year"];
			$kgiHistory = KgiEmployeeHistory::find()
				->where(["kgiEmployeeId" => $kgiEmployeeId, "status" => [1, 2, 4]])
				->andWhere("year<=$year")
				->orderBy('year ASC,month ASC,kgiEmployeeHistoryId DESC')
				->asArray()
				->all();
		}
		$data = [];
		if (isset($kgiHistory) && count($kgiHistory) > 0) {
			foreach ($kgiHistory as $history) :
				$time = explode(' ', $history["createDateTime"]);
				$employeeId = Employee::employeeId($history["createrId"]);
				$data[$history["kgiEmployeeHistoryId"]] = [
					"title" => $history["detail"],
					//"remark" => $history["remark"],
					//"result" => $history["result"],
					"picture" => Employee::employeeImage($employeeId),
					"createDate" => ModelMaster::engDateHr($history["createDateTime"]),
					"time" => ModelMaster::timeText($time[1]),
					"status" => $history["status"],
					"target" => $history["target"],
					"result" => $history["result"],
					"month" => $history["month"],
					"year" => $history["year"],
					"creater" => User::employeeNameByuserId($history["createrId"]),
				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionKgiHistoryEmployee($kgiId, $month, $year)
	{
		$kgiEmployee = KgiEmployee::find()
			->where([
				"kgiId" => $kgiId,
				"status" => [1, 2, 4],
				"month" => $month != '' ? $month : 0,
				"year" => $year != '' ? $year : 0,
			])
			->orderBy("updateDateTime DESC")
			->asArray()
			->all();
		$data = [];
		if (isset($kgiEmployee) && count($kgiEmployee) > 0) {
			foreach ($kgiEmployee as $kt):
				$kgiEmployeeHistory = KgiEmployeeHistory::find()
					->where([
						"kgiEmployeeId" => $kt["kgiEmployeeId"],
						"status" => [1, 2, 4],
						"month" => $month != '' ? $month : 0,
						"year" => $year != '' ? $year : 0,
					])
					->orderBy('createDateTime DESC')
					->asArray()
					->one();
				$employee = Employee::find()->where(["employeeId" => $kt["employeeId"]])->asArray()->one();
				$teamName = Team::teamName($employee["teamId"]);
				$employeeId = $kt["employeeId"];
				if (isset($kgiEmployeeHistory) && !empty($kgiEmployeeHistory)) {
					$time = explode(' ', $kgiEmployeeHistory["createDateTime"]);
					$data[$kt["kgiEmployeeId"]] = [
						"result" => $kgiEmployeeHistory["result"],
						"creater" => $employee["employeeFirstname"] . ' ' . $employee["employeeSurename"],
						"teamName" => $teamName,
						"teamId" => $employee["teamId"],
						"picture" => Employee::employeeImage($employeeId),
						"time" => ModelMaster::timeText($time[1]),
						"status" => $kgiEmployeeHistory["status"],
						"target" => $kgiEmployeeHistory["target"],
						"createDateTime" => ModelMaster::monthDateYearTime($kgiEmployeeHistory["createDateTime"])
					];
				} else {
					$time = explode(' ', $kt["createDateTime"]);
					$data[$kt["kgiEmployeeId"]] = [
						"result" => $kt["result"],
						"creater" => $employee["employeeFirstname"] . ' ' . $employee["employeeSurename"],
						"teamName" => $teamName,
						"teamId" => $employee["teamId"],
						"picture" => Employee::employeeImage($employeeId),
						"time" => ModelMaster::timeText($time[1]),
						"status" => $kt["status"],
						"target" => $kt["target"],
						"createDateTime" => ModelMaster::monthDateYearTime($kt["createDateTime"])
					];
				}
			endforeach;
		}
		return json_encode($data);
	}
	public function actionKgiEachTeamEmployeeHistory($kgiId, $teamId, $month, $year)
	{

		$kgiEmployee = KgiEmployee::find()
			->select('e.employeeFirstname,e.employeeSurename,t.titleName,kgi_employee.kgiEmployeeId,e.picture')
			->JOIN("LEFT JOIN", "employee e", "e.employeeId=kgi_employee.employeeId")
			->JOIN("LEFT JOIN", "title t", "t.titleId=e.titleId")
			->where(["kgi_employee.kgiId" => $kgiId, "e.teamId" => $teamId])
			->orderBy('e.employeeFirstname')
			->asArray()
			->all();
		$data = [];
		if (isset($kgiEmployee) && count($kgiEmployee) > 0) {
			foreach ($kgiEmployee as $ke):
				$kgiEmployeeHistory = KgiEmployeeHistory::find()
					->where(["kgiEmployeeId" => $ke["kgiEmployeeId"], "month" => $month, "year" => $year])
					->orderBy("status DESC,updateDateTime DESC")
					->asArray()
					->one();
				if (isset($kgiEmployeeHistory) && !empty($kgiEmployeeHistory)) {
					$img = "image/user.png";

					if ($ke["picture"] != '') {
						$img = $ke["picture"];
					} else {
						$img = "image/user.png";
					}
					$target = $kgiEmployeeHistory["target"];
					$result = $kgiEmployeeHistory["result"];
					$data[$ke["kgiEmployeeId"]] = [
						"employeeName" => $ke["employeeFirstname"] . ' ' . $ke["employeeSurename"],
						"picture" => $img,
						"title" => $ke["titleName"],
						"target" => ModelMaster::pimNumberFormat($target),
						"result" => ModelMaster::pimNumberFormat($result),
						"updateDateTime" => ModelMaster::monthDateYearTime($kgiEmployeeHistory["updateDateTime"]),
						"employeeHistory" => KgiEmployeeHistory::allHistory($ke["kgiEmployeeId"], $month, $year)
					];
					if ($target == '252450.90') {
						throw new Exception(print_r($data[$ke["kgiEmployeeId"]], true));
					}
				}
			endforeach;
		}
		return json_encode($data);
	}
	public function actionAssignedKgiEmployee($kgiId, $kgiHistoryId)
	{

		if ($kgiHistoryId == 0) {
			$kgi = Kgi::find()->where(["kgiId" => $kgiId])->asArray()->one();
		} else {
			$kgi = KgiHistory::find()->where(["kgiHistoryId" => $kgiHistoryId])
				->asArray()
				->one();
		}
		$kgiEmployee = KgiEmployee::find()
			->select('e.picture,e.employeeId,e.gender,t.titleName,e.employeeFirstname,e.employeeSurename,e.teamId,
			kgi_employee.target,kgi_employee.result,kgi_employee.updateDateTime,team.teamName')
			->JOIN("LEFT JOIN", "employee e", "e.employeeId=kgi_employee.employeeId")
			->JOIN("LEFT JOIN", "title t", "t.titleId=e.titleId")
			->JOIN("LEFT JOIN", "team", "team.teamId=e.teamId")
			->where([
				"kgi_employee.status" => [1, 2, 4],
				"kgi_employee.kgiId" => $kgiId,
				"e.status" => 1,
				"kgi_employee.month" => $kgi["month"],
				"kgi_employee.year" => $kgi["year"]
			])
			->andWhere("kgi_employee.employeeId is not null")
			->orderBy("team.teamName,e.employeeFirstname")
			->asArray()
			->all();
		$employeeData = [];
		if (isset($kgiEmployee) && count($kgiEmployee) > 0) {
			foreach ($kgiEmployee as $ke) :
				if ($ke["picture"] != "") {
					$picture = $ke["picture"];
				} else {
					$picture =  'images/icons/Settings/personblack.svg';
				}
				$target = ModelMaster::pimNumberFormat($ke["target"]);
				$result = ModelMaster::pimNumberFormat($ke["result"]);
				$employeeData[$ke["teamId"]][$ke["employeeId"]] = [
					"employeeName" => $ke["employeeFirstname"] . ' ' . $ke["employeeSurename"],
					"teamName" => $ke["teamName"],
					"title" => $ke["titleName"],
					"picture" => $picture,
					"target" => $target,
					"result" => $result,
					"updateDateTime" => ModelMaster::monthDateYearTime($ke["updateDateTime"]),
				];
			endforeach;
			return json_encode($employeeData);
		}
	}
}
