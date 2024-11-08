<?php

namespace backend\modules\kgi\controllers;

use backend\models\hrvc\Company;
use backend\models\hrvc\Country;
use backend\models\hrvc\Employee;
use backend\models\hrvc\Kgi;
use backend\models\hrvc\KgiBranch;
use backend\models\hrvc\KgiEmployee;
use backend\models\hrvc\KgiEmployeeHistory;
use backend\models\hrvc\KgiIssue;
use backend\models\hrvc\KgiTeam;
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
		/*$kgiEmployees = KgiEmployee::find()
			->select('kgi_employee.employeeId,t.teamName,kgi_employee.target,t.teamId,e.employeeFirstname,e.employeeSurename')
			->JOIN("LEFT JOIN", "employee e", "e.employeeId=kgi_employee.employeeId")
			->JOIN("LEFT JOIN", "team t", "t.teamId=e.teamId")
			->where("kgi_employee.status!=99")
			->andWhere(["kgi_employee.kgiId" => $kgiId])
			->orderBy('t.teamName')
			->asArray()
			->all();*/

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
				// $employees = Employee::find()
				// 	->where(["status" => 1, "teamId" => $team["teamId"]])
				// 	->asArray()
				// 	->orderBy('employeeFirstname')
				// 	->all();
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
	public function actionEmployeeKgi($userId, $role)
	{
		$employeeId = Employee::employeeId($userId);
		if ($role <= 3) {
			$kgiEmployee = KgiEmployee::find()
				->select('k.kgiName,k.priority,k.quantRatio,k.amountType,k.code,kgi_employee.target,kgi_employee.result,
			kgi_employee.status,kgi_employee.employeeId,k.unitId,kgi_employee.month,kgi_employee.year,k.kgiId,k.companyId,e.teamId,e.picture,
			kgi_employee.kgiEmployeeId,e.employeeFirstname,e.employeeSurename')
				->JOIN("LEFT JOIN", "kgi k", "kgi_employee.kgiId=k.kgiId")
				->JOIN("LEFT JOIN", "employee e", "e.employeeId=kgi_employee.employeeId")
				->where(["kgi_employee.status" => [1, 2, 4], "k.status" => [1, 2, 4], "kgi_employee.employeeId" => $employeeId])
				->orderby('k.createDateTime')
				->asArray()
				->all();
		} else {
			$kgiEmployee = KgiEmployee::find()
				->select('k.kgiName,k.priority,k.quantRatio,k.amountType,k.code,kgi_employee.target,kgi_employee.result,
			kgi_employee.status,kgi_employee.employeeId,k.unitId,kgi_employee.month,kgi_employee.year,k.kgiId,k.companyId,e.teamId,e.picture,
			kgi_employee.kgiEmployeeId,e.employeeFirstname,e.employeeSurename')
				->JOIN("LEFT JOIN", "kgi k", "kgi_employee.kgiId=k.kgiId")
				->JOIN("LEFT JOIN", "employee e", "e.employeeId=kgi_employee.employeeId")
				->where(["kgi_employee.status" => [1, 2, 4], "k.status" => [1, 2, 4]])
				->orderby('k.createDateTime')
				->asArray()
				->all();
		}
		$data = [];
		if (count($kgiEmployee) > 0) {
			foreach ($kgiEmployee as $kgi) :
				$kgiEmployeeHistory = KgiEmployeeHistory::find()
					->where(["kgiEmployeeId" => $kgi["kgiEmployeeId"], "status" => [1, 2, 4]])
					->asArray()
					->orderBy('createDateTime DESC')
					->one();
				if (!isset($kgiEmployeeHistory) || empty($kgiEmployeeHistory)) {
					$kgiEmployeeHistory = KgiEmployee::find()
						->where(["kgiEmployeeId" => $kgi["kgiEmployeeId"], "status" => [1, 2, 4]])
						->asArray()
						->orderBy('createDateTime DESC')
						->one();
				}
				$ratio = 0;
				if ($kgi["target"] != '' && $kgi["target"] != 0) {
					if ($kgi["code"] == '<' || $kgi["code"] == '=') {
						$ratio = ($kgi["result"] / $kgi["target"]) * 100;
					} else {
						if ($kgi["result"] != '' && $kgi["result"] != 0) {
							$ratio = ($kgi["target"] / $kgi["result"]) * 100;
						} else {
							$ratio = 0;
						}
					}
				} else {
					$ratio = 0;
				}
				$kgiEmployeeInteam = KgiEmployee::countKgiFromTeam($kgi["kgiId"], $kgi["teamId"]);
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
				$picture = Employee::employeeImage($kgi["employeeId"]);
				$data[$kgi["kgiEmployeeId"]] = [
					"kgiId" => $kgi["kgiId"],
					"kgiName" => $kgi["kgiName"],
					"companyId" => $kgi['companyId'],
					"kgiEmployeeId" => $kgi["kgiEmployeeId"],
					"employeeName" => $kgi["employeeFirstname"] . ' ' . $kgi["employeeSurename"],
					"picture" => $picture,
					"companyName" => Company::companyName($kgi["companyId"]),
					"branch" => KgiBranch::kgiBranch($kgi["kgiId"]),
					"employee" => KgiEmployee::kgiEmployee($kgi["kgiId"]),
					"quantRatio" => $kgi["quantRatio"],
					"targetAmount" => $kgi["target"],
					"code" => $kgi["code"],
					"result" => $kgi["result"],
					"unit" => Unit::unitName($kgi["unitId"]),
					"month" => ModelMaster::monthEng($kgi['month'], 1),
					"priority" => $kgi["priority"],
					"ratio" => number_format($ratio, 2),
					"periodCheck" => ModelMaster::engDate(KgiEmployee::lastestCheckDate($kgiEmployeeHistory["kgiEmployeeId"]), 2),
					"nextCheck" =>  ModelMaster::engDate($kgiEmployeeHistory["nextCheckDate"], 2),
					"countTeam" => KgiTeam::kgiTeam($kgi["kgiId"]),
					"flag" => Country::countryFlagBycompany($kgi["companyId"]),
					"status" => $kgiEmployeeHistory["status"],
					"countryName" => Country::countryNameBycompany($kgi['companyId']),
					"issue" => KgiIssue::lastestIssue($kgi["kgiId"])["issue"],
					"solution" => KgiIssue::lastestIssue($kgi["kgiId"])["solution"],
					"fromDate" => ModelMaster::engDate($kgiEmployeeHistory["fromDate"], 2),
					"toDate" => ModelMaster::engDate($kgiEmployeeHistory["toDate"], 2),
					//"isOver" => ModelMaster::isOverDuedate(Kgi::nextCheckDate($kgi['kgiId'])),
					"isOver" => ModelMaster::isOverDuedate(KgiEmployee::nextCheckDate($kgiEmployeeHistory['kgiEmployeeId'])),
					"amountType" => $kgi["amountType"],
					"teamMate" =>  $selectPic,
					"countTeamEmployee" => $countTeamEmployee,
					"canEdit" => 1,
				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionKgiEmployeeDetail($kgiEmployeeId)
	{
		$kgiEmployee = KgiEmployeeHistory::find()
			->select('ke.target,kgi_employee_history.result,kgi_employee_history.kgiEmployeeId,ke.employeeId,
			kgi_employee_history.lastCheckDate,kgi_employee_history.nextCheckDate,kgi_employee_history.detail,
			kgi_employee_history.status,kgi_employee_history.month,kgi_employee_history.year,ke.remark')
			->JOIN("LEFT JOIN", "kgi_employee ke", "ke.kgiEmployeeId=kgi_employee_history.kgiEmployeeId")
			->where(["kgi_employee_history.kgiEmployeeId" => $kgiEmployeeId])
			->orderBy('kgi_employee_history.kgiEmployeeHistoryId DESC')
			->asArray()
			->one();
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
				"monthName" => ModelMaster::monthEng($kgiDetail['month'], 1),
				"priority" => $kgiDetail["priority"],
				"quantRatio" => $kgiDetail["quantRatio"],
				"amountType" => $kgiDetail["amountType"],
				"code" => $kgiDetail["code"],
				"ratio" => $ratio,
				"unitText" => Unit::unitName($kgiDetail["unitId"]),
				"target" => $kgiEmployee["target"],
				"result" => $kgiEmployee["result"],
				"detail" => isset($kgiEmployee["detail"]) ? $kgiEmployee["detail"] : null,
				"nextCheckDate" => isset($kgiEmployee["nextCheckDate"]) ? $kgiEmployee["nextCheckDate"] : null,
				"lastCheckDate" => isset($kgiEmployee["lastCheckDate"]) ? $kgiEmployee["lastCheckDate"] : null,
				"status" => $kgiEmployee["status"],
				"employeeName" => $employee["employeeFirstname"] . " " . $employee["employeeSurename"],
				"month" => $kgiEmployee["month"],
				"year" => $kgiEmployee["year"],
				"remark" => $kgiEmployee["remark"]
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
	public function actionKgiPersonalFilter($companyId, $branchId, $teamId, $month, $status, $year, $userId)
	{
		$employeeId = Employee::employeeId2($userId);
		$kgiEmployees = KgiEmployee::find()
			->select('k.kgiName,k.kgiId,k.unitId,k.quantRatio,k.priority,k.amountType,k.code,kgi_employee.kgiEmployeeId,k.companyId,
			kgi_employee.employeeId,kgi_employee.target,kgi_employee.month,e.employeeFirstname,e.employeeSurename,e.teamId,e.picture')
			->JOIN("LEFT JOIN", "kgi k", "k.kgiId=kgi_employee.kgiId")
			->JOIN("LEFT JOIN", "kgi_branch kb", "kb.kgiId=k.kgiId")
			->JOIN("LEFT JOIN", "employee e", "e.employeeId=kgi_employee.employeeId")
			->where("kgi_employee.status!=99 and k.status!=99")
			->andFilterWhere([
				"kb.branchId" => $branchId,
				"e.teamId" => $teamId,
				"e.branchId" => $branchId,
				"kgi_employee.employeeId" => $employeeId,
				//"kgi_employee.month" => $month,
				//"kgi_employee.year" => $year,
				//"kgi_employee.status" => $status,
			])
			->orderBy("k.createDateTime DESC")
			->asArray()
			->all();
		$data = [];
		if (isset($kgiEmployees) && count($kgiEmployees) > 0) {
			foreach ($kgiEmployees as $kgiEmployee) :
				$kgiEmployeeHistory = KgiEmployeeHistory::find()
					->select('kgi_employee_history.*')
					->JOIN("LEFT JOIN", "kgi_employee ke", "ke.kgiEmployeeId=kgi_employee_history.kgiEmployeeId")
					->JOIN("LEFT JOIN", "employee e", "e.employeeId=ke.employeeId")
					->where([
						"kgi_employee_history.kgiEmployeeId" => $kgiEmployee["kgiEmployeeId"],
						"kgi_employee_history.status" => [1, 2],
					])
					->andFilterWhere([
						"e.teamId" => $teamId,
						"ke.employeeId" => $employeeId,
						"kgi_employee_history.month" => $month,
						"kgi_employee_history.year" => $year,
						"kgi_employee_history.status" => $status,
					])
					->asArray()
					->orderBy('kgi_employee_history.createDateTime DESC')
					->one();
				if (!isset($kgiEmployeeHistory) || empty($kgiEmployeeHistory)) {
					//throw new exception(1111);
					$kgiEmployeeHistory = KgiEmployee::find()
						->JOIN("LEFT JOIN", "employee e", "e.employeeId=kgi_employee.employeeId")
						->where(["kgi_employee.kgiEmployeeId" => $kgiEmployee["kgiEmployeeId"], "kgi_employee.status" => [1, 2]])
						->andFilterWhere([
							"e.teamId" => $teamId,
							"e.employeeId" => $employeeId,
							"kgi_employee.month" => $month,
							"kgi_employee.year" => $year,
							"kgi_employee.status" => $status,
						])
						->asArray()
						->orderBy('createDateTime DESC')
						->one();
				}
				$ratio = 0;
				if ($kgiEmployee["target"] != '' && $kgiEmployee["target"] != 0 && $kgiEmployee["target"] != null) {
					if ($kgiEmployee["code"] == '<' || $kgiEmployee["code"] == '=') {
						$ratio = ($kgiEmployeeHistory["result"] / $kgiEmployee["target"]) * 100;
					} else {
						if ($kgiEmployeeHistory["result"] != '' && $kgiEmployeeHistory["result"] != 0) {
							$ratio = ($kgiEmployee["target"] / $kgiEmployeeHistory["result"]) * 100;
						} else {
							$ratio = 0;
						}
					}
				} else {
					$ratio = 0;
				}
				$kgiEmployeeInteam = KgiEmployee::countKgiFromTeam($kgiEmployee["kgiId"], $kgiEmployee["teamId"]);
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
				$picture = Employee::employeeImage($kgiEmployee["employeeId"]);
				$data[$kgiEmployee["kgiEmployeeId"]] = [
					"kgiName" => $kgiEmployee["kgiName"],
					"kgiId" => $kgiEmployee["kgiId"],
					"companyName" => Company::companyName($kgiEmployee["companyId"]),
					"employee" => KgiEmployee::kgiEmployee($kgiEmployee["kgiId"]),
					"employeeName" => $kgiEmployee["employeeFirstname"] . ' ' . $kgiEmployee["employeeSurename"],
					"picture" => $picture,
					"branch" => KgiBranch::kgiBranch($kgiEmployee["kgiId"]),
					"priority" => $kgiEmployee["priority"],
					"unit" => Unit::unitName($kgiEmployee["unitId"]),
					"quantRatio" => $kgiEmployee["quantRatio"],
					"targetAmount" => $kgiEmployee["target"],
					"result" => $kgiEmployeeHistory["result"],
					"code" => $kgiEmployee["code"],
					"month" =>  ModelMaster::monthEng($kgiEmployeeHistory['month'], 1),
					"year" => $kgiEmployeeHistory['year'],
					"fromDate" => ModelMaster::engDate($kgiEmployeeHistory["fromDate"], 2),
					"toDate" => ModelMaster::engDate($kgiEmployeeHistory["toDate"], 2),
					//"periodCheck" => ModelMaster::engDate(KgiTeam::lastestCheckDate($kgiEmployeeHistory["kgiTeamId"]), 2),
					"periodCheck" => ModelMaster::engDate(KgiEmployee::lastestCheckDate($kgiEmployee["kgiEmployeeId"]), 2),
					"nextCheck" =>  ModelMaster::engDate($kgiEmployeeHistory["nextCheckDate"], 2),
					"status" => $kgiEmployeeHistory["status"],
					"flag" => Country::countryFlagBycompany($kgiEmployee["companyId"]),
					"countryName" => Country::countryNameBycompany($kgiEmployee['companyId']),
					"kgiEmployee" => KgiEmployee::kgiEmployee($kgiEmployee["kgiId"]),
					"ratio" => number_format($ratio, 2),
					"isOver" => ModelMaster::isOverDuedate(KgiEmployee::nextCheckDate($kgiEmployeeHistory['kgiEmployeeId'])),
					"amountType" => $kgiEmployee["amountType"],
					"issue" => KgiIssue::lastestIssue($kgiEmployee["kgiId"])["issue"],
					"solution" => KgiIssue::lastestIssue($kgiEmployee["kgiId"])["solution"],
					"countTeam" => KgiTeam::kgiTeam($kgiEmployee["kgiId"]),
					"teamMate" =>  $selectPic,
					"countTeamEmployee" => $countTeamEmployee,
				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionKgiIndividualSummarize($kgiEmployeeId)
	{
		$kgiEmployeeHistory = KgiEmployeeHistory::find()
			->select('kgi_employee_history.*,k.unitId,k.quantRatio,k.code,k.amountType')
			->JOIN("LEFT JOIN", "kgi_employee ke", "ke.kgiEmployeeId=kgi_employee_history.kgiEmployeeId")
			->JOIN("LEFT JOIN", "kgi k", "k.kgiId=ke.kgiId")
			->where([
				"kgi_employee_history.kgiEmployeeId" => $kgiEmployeeId,
			])
			->andWhere("kgi_employee_history.status!=99")
			->orderBy("kgi_employee_history.year DESC,kgi_employee_history.month DESC,kgi_employee_history.kgiEmployeeHistoryId")
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
}
