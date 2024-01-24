<?php

namespace backend\modules\kpi\controllers;

use backend\models\hrvc\Employee;
use backend\models\hrvc\Kpi;
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
					->select('e.employeeId,e.employeeFirstname,e.employeeSurename')
					->JOIN("LEFT JOIN", "employee e", "e.employeeId=kpi_employee.employeeId")
					->JOIN("LEFT JOIN", "user u", "u.employeeId=e.employeeId")
					->JOIN("LEFT JOIN", "user_role ur", "ur.userId=u.userId")
					->where(['e.teamId' => $team["teamId"], "kpi_employee.kpiId" => $kpiId])
					->asArray()
					->orderBy('ur.roleId,e.employeeFirstname')
					->all();
				if (isset($kpiEmployee) && count($kpiEmployee) > 0) {
					foreach ($kpiEmployee as $employee) :
						$employeeTeam[$team["teamId"]][$employee["employeeId"]] = [
							"employeeId" => $employee["employeeId"],
							"target" => KpiEmployee::kpiEmployeeTarget($kpiId, $employee["employeeId"]),
							"employeeName" => $employee["employeeFirstname"] . " " . $employee["employeeSurename"],
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
		$kpiEmployee = KpiEmployee::find()
			->select('k.kpiName,k.priority,k.quantRatio,k.amountType,k.code,kpi_employee.target,kpi_employee.result,
			kpi_employee.status,k.unitId,k.month,k.kpiId,k.fromDate,k.toDate,k.companyId,k.periodDate,
			kpi_employee.kpiEmployeeId')
			->JOIN("LEFT JOIN", "kpi k", "kpi_employee.kpiId=k.kpiId")
			->where(["kpi_employee.status" => [1, 2, 4], "kpi_employee.employeeId" => $employeeId])
			->orderby('k.createDateTime')
			->asArray()
			->all();
		$data = [];
		if (count($kpiEmployee) > 0) {
			foreach ($kpiEmployee as $kpi) :
				if ($kpi["target"] != '' && $kpi["target"] != 0) {
					if ($kpi["code"] == '<' || $kpi["code"] == '=') {
						$ratio = ($kpi["result"] / $kpi["target"]) * 100;
					} else {
						$ratio = ($kpi["target"] / $kpi["result"]) * 100;
					}
				} else {
					$ratio = 0;
				}
				$data[$kpi["kpiId"]] = [
					"kpiName" => $kpi["kpiName"],
					"companyId" => $kpi['companyId'],
					"kpiEmployeeId" => $kpi["kpiEmployeeId"],
					//"companyName" => Company::companyName($kgi["companyId"]),
					//"branch" => KgiBranch::kgiBranch($kgi["kgiId"]),
					//"kgiBranch" => KgiBranch::kgiBranches($kgi["kgiId"]),
					"kpiEmployee" => KpiEmployee::kpiEmployee($kpi["kpiId"]),
					"quantRatio" => $kpi["quantRatio"],
					//"creater" => User::employeeNameByuserId($kgi["createrId"]),
					"targetAmount" => $kpi["target"],
					"code" => $kpi["code"],
					"result" => $kpi["result"],
					"unit" => Unit::unitName($kpi["unitId"]),
					"month" => ModelMaster::monthEng($kpi['month'], 1),
					"priority" => $kpi["priority"],
					"ratio" => number_format($ratio, 2),
					"periodCheck" => ModelMaster::engDate($kpi["periodDate"], 2),
					"nextCheck" => Kpi::nextCheckDate($kpi['kpiId']),
					"countTeam" => KpiTeam::kpiTeam($kpi["kpiId"]),
					//"flag" => Country::countryFlagBycompany($kgi["companyId"]),
					"status" => $kpi["status"],
					//"countryName" => Country::countryNameBycompany($kgi['companyId']),
					"issue" => KpiIssue::lastestIssue($kpi["kpiId"])["issue"],
					"solution" => KpiIssue::lastestIssue($kpi["kpiId"])["solution"],
					"employee" => KpiTeam::employeeTeam($kpi['kpiId']),
					"fromDate" => ModelMaster::engDate($kpi["fromDate"], 2),
					"toDate" => ModelMaster::engDate($kpi["toDate"], 2),
					"isOver" => ModelMaster::isOverDuedate(Kpi::nextCheckDate($kpi['kpiId'])),
					//"countKgiHasKfi" => KfiHasKgi::countKfiWithKgi($kgi['kgiId']),
					//"countKgiHasKpi" => KgiHasKpi::countKgiHasKpi($kgi['kgiId']),
					"amountType" => $kpi["amountType"]
				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionKpiEmployeeDetail($kpiEmployeeId)
	{
		$kpiEmployee = KpiEmployeeHistory::find()
			->where(["kpiEmployeeId" => $kpiEmployeeId])
			->orderBy('kpiEmployeeHistoryId DESC')
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
		$kpiDetail = Kpi::find()
			//->select('kpiName')
			->where(["kpiId" => $kpiId])
			->one();
		if (isset($kpiEmployee) && !empty($kpiEmployee)) {
			if ($kpiEmployee["target"] != '' && $kpiEmployee["target"] != 0) {
				if ($kpiDetail["code"] == '<' || $kpiDetail["code"] == '=') {
					$ratio = ($kpiEmployee["result"] / $kpiEmployee["target"]) * 100;
				} else {
					$ratio = ($kpiEmployee["target"] / $kpiEmployee["result"]) * 100;
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
				"employeeName" => $employee["employeeFirstname"] . " " . $employee["employeeSurename"]
			];
		}
		return json_encode($data);
	}
	public function actionKpiEmployeeHistory($kpiEmployeeId)
	{
		$kpiHistory = KpiEmployeeHistory::find()
			->where(["kpiEmployeeId" => $kpiEmployeeId, "status" => [1, 2, 4, 88, 89]])
			->asArray()
			->orderBy("createDateTime DESC")
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
}
