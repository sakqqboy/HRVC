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
use backend\models\hrvc\Unit;
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
	public function actionEmployeeKpi($userId)
	{
		$employeeId = Employee::employeeId($userId);
		/*$kpis = Kpi::find()
			->select('kpi.*')
			->JOIN("LEFT JOIN", "kpi_employee ke", "ke.kpiId=kpi.kpiId")
			->where(["kpi.status" => [1, 2, 4], "ke.status" => 1, "ke.employeeId" => $employeeId])
			->asArray()
			->orderBy('kpi.updateDateTime DESC')
			->all();*/
		$kpiEmployee = KpiEmployee::find()
			->select('k.kpiName,k.priority,k.quantRatio,k.amountType,k.code,kpi_employee.target,kpi_employee.result,
			kpi_employee.status,k.unitId,kpi_employee.month,kpi_employee.year,k.kpiId,k.companyId,
			kpi_employee.kpiEmployeeId,e.employeeFirstname,e.employeeSurename')
			->JOIN("LEFT JOIN", "kpi k", "kpi_employee.kpiId=k.kpiId")
			->JOIN("LEFT JOIN", "employee e", "e.employeeId=kpi_employee.employeeId")
			->where(["kpi_employee.status" => [1, 2, 4], "k.status" => [1, 2, 4], "kpi_employee.employeeId" => $employeeId])
			->orderby('k.createDateTime')
			->asArray()
			->all();
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
						->where(["kpiEmployeeId" => $kpiEmployee["kpiEmployeeId"], "status" => [1, 2, 4]])
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

				$data[$kpi["kpiEmployeeId"]] = [
					"kpiId" => $kpi["kpiId"],
					"kpiName" => $kpi["kpiName"],
					"companyId" => $kpi['companyId'],
					"kpiEmployeeId" => $kpi["kpiEmployeeId"],
					"employeeName" => $kpi["employeeFirstname"] . ' ' . $kpi["employeeSurename"],
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
					"ratio" => number_format($ratio, 2),
					"periodCheck" => ModelMaster::engDate(KpiEmployee::lastestCheckDate($kpiEmployeeHistory["kpiEmployeeId"]), 2),
					"nextCheck" =>  ModelMaster::engDate($kpiEmployeeHistory["nextCheckDate"], 2),
					"countTeam" => KpiTeam::kpiTeam($kpi["kpiId"]),
					"flag" => Country::countryFlagBycompany($kpi["companyId"]),
					"status" => $kpiEmployeeHistory["status"],
					"countryName" => Country::countryNameBycompany($kpi['companyId']),
					"issue" => KpiIssue::lastestIssue($kpi["kpiId"])["issue"],
					"solution" => KpiIssue::lastestIssue($kpi["kpiId"])["solution"],
					"fromDate" => ModelMaster::engDate($kpiEmployeeHistory["fromDate"], 2),
					"toDate" => ModelMaster::engDate($kpiEmployeeHistory["toDate"], 2),
					"isOver" => ModelMaster::isOverDuedate(KpiEmployee::nextCheckDate($kpiEmployeeHistory['kpiEmployeeId'])),
					"amountType" => $kpi["amountType"],
					"canEdit" => 1
				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionKpiEmployeeDetail($kpiEmployeeId)
	{
		$kpiEmployee = KpiEmployeeHistory::find()
			->select('ke.target,kpi_employee_history.result,kpi_employee_history.kpiEmployeeId,ke.employeeId,
			kpi_employee_history.lastCheckDate,kpi_employee_history.nextCheckDate,kpi_employee_history.detail,
			kpi_employee_history.status,kpi_employee_history.month,kpi_employee_history.year,ke.remark')
			->JOIN("LEFT JOIN", "kpi_employee ke", "ke.kpiEmployeeId=kpi_employee_history.kpiEmployeeId")
			->where(["kpi_employee_history.kpiEmployeeId" => $kpiEmployeeId])
			->orderBy('kpi_employee_history.kpiEmployeeHistoryId DESC')
			->asArray()
			->one();
		if (!isset($kpiEmployee) || empty($kpiEmployee)) {
			$kpiEmployee = KpiEmployee::find()
				->where(["kpiEmployeeId" => $kpiEmployeeId])
				->one();
			$kpiId = $kpiEmployee["kpiId"];
			$employeeId = $kpiEmployee["employeeId"];
		} else {
			$kpiE = KpiEmployee::find()
				->select('kpiId,employeeId')
				->where(["kpiEmployeeId" => $kpiEmployee["kpiEmployeeId"]])
				->asArray()
				->one();
			$kpiId = $kpiE["kpiId"];
			$employeeId = $kpiE["employeeId"];
		}
		$data = [];
		$ratio = 0;
		$kpiDetail = Kpi::find()
			//->select('kpiName')
			->where(["kpiId" => $kpiId])
			->one();
		if (isset($kpiEmployee) && !empty($kpiEmployee)) {
			if ($kpiEmployee["target"] != '' && $kpiEmployee["target"] != 0) {
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
				"kpiName" => $kpiDetail["kpiName"],
				"monthName" => ModelMaster::monthEng($kpiDetail['month'], 1),
				"priority" => $kpiDetail["priority"],
				"quantRatio" => $kpiDetail["quantRatio"],
				"amountType" => $kpiDetail["amountType"],
				"code" => $kpiDetail["code"],
				"ratio" => $ratio,
				"unitText" => Unit::unitName($kpiDetail["unitId"]),
				"target" => $kpiEmployee["target"],
				"result" => $kpiEmployee["result"],
				"detail" => isset($kpiEmployee["detail"]) ? $kpiEmployee["detail"] : null,
				"nextCheckDate" => isset($kpiEmployee["nextCheckDate"]) ? $kpiEmployee["nextCheckDate"] : null,
				"lastCheckDate" => isset($kpiEmployee["lastCheckDate"]) ? $kpiEmployee["lastCheckDate"] : null,
				"status" => $kpiEmployee["status"],
				"employeeName" => $employee["employeeFirstname"] . " " . $employee["employeeSurename"],
				"month" => $kpiEmployee["month"],
				"year" => $kpiEmployee["year"],
				"remark" => $kpiEmployee["remark"]
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
			kpi_employee.employeeId,kpi_employee.target,kpi_employee.month,e.employeeFirstname,e.employeeSurename')
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
					throw new exception(1111);
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
				$data[$kpiEmployee["kpiEmployeeId"]] = [
					"kpiName" => $kpiEmployee["kpiName"],
					"kpiId" => $kpiEmployee["kpiId"],
					"companyName" => Company::companyName($kpiEmployee["companyId"]),
					"employee" => KpiEmployee::kpiEmployee($kpiEmployee["kpiId"]),
					"employeeName" => $kpiEmployee["employeeFirstname"] . ' ' . $kpiEmployee["employeeSurename"],
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
					"flag" => Country::countryFlagBycompany($kpiEmployee["companyId"]),
					"countryName" => Country::countryNameBycompany($kpiEmployee['companyId']),
					"kpiEmployee" => KpiEmployee::kpiEmployee($kpiEmployee["kpiId"]),
					"ratio" => number_format($ratio, 2),
					"isOver" => ModelMaster::isOverDuedate(KpiEmployee::nextCheckDate($kpiEmployeeHistory['kpiEmployeeId'])),
					"amountType" => $kpiEmployee["amountType"],
					"issue" => KpiIssue::lastestIssue($kpiEmployee["kpiId"])["issue"],
					"solution" => KpiIssue::lastestIssue($kpiEmployee["kpiId"])["solution"],
					"countTeam" => KpiTeam::kpiTeam($kpiEmployee["kpiId"]),
				];
			endforeach;
		}
		return json_encode($data);
	}
}