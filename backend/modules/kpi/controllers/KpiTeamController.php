<?php

namespace backend\modules\kpi\controllers;

use backend\models\hrvc\Company;
use backend\models\hrvc\Country;
use backend\models\hrvc\Department;
use backend\models\hrvc\Employee;
use backend\models\hrvc\Kgi;
use backend\models\hrvc\Kpi;
use backend\models\hrvc\KpiBranch;
use backend\models\hrvc\KpiEmployee;
use backend\models\hrvc\KpiIssue;
use backend\models\hrvc\KpiTeam;
use backend\models\hrvc\KpiTeamHistory;
use backend\models\hrvc\Team;
use backend\models\hrvc\Unit;
use common\models\ModelMaster;
use Exception;
use yii\web\Controller;

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
class KpiTeamController extends Controller
{
	public function actionKpiTeam($kpiId)
	{
		$kpiTeams = KpiTeam::find()
			->select('kpi_team.teamId,t.teamName,kpi_team.target,kpi_team.remark')
			->JOIN("LEFT JOIN", "team t", "t.teamId=kpi_team.teamId")
			->where(["kpi_team.status" => [1, 2, 4]])
			->andWhere(["kpi_team.kpiId" => $kpiId])
			->orderBy('t.teamName')
			->asArray()
			->all();
		return json_encode($kpiTeams);
	}
	public function actionKpiTeamSummarize($kpiId)
	{
		$kpiTeams = KpiTeam::find()
			->select('kpi_team.teamId,t.teamName,t.departmentId')
			->JOIN("LEFT JOIN", "team t", "t.teamId=kpi_team.teamId")
			->where(["kpi_team.status" => [1, 2, 4], "t.status" => [1, 2, 4]])
			->andWhere(["kpi_team.kpiId" => $kpiId])
			->orderBy('t.teamName')
			->asArray()
			->all();
		$data = [];
		if (isset($kpiTeams) && count($kpiTeams) > 0) {
			foreach ($kpiTeams as $kt):
				$data[$kt["teamId"]] = [
					"teamName" => $kt["teamName"],
					"totalEmployee" => KpiEmployee::totolEmployeeInTeam($kpiId, $kt["teamId"]),
					"departmentName" => Department::departmentName($kt["departmentId"])
				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionKpiTeam2($kpiId)
	{
		$kpiTeams = KpiTeam::find()
			->select('kpi_team.teamId,t.teamName,kpi_team.target,kpi_team.remark,kpi_team.result,kpi_team.kpiTeamId,kpi_team.kpiId,k.code,t.departmentId')
			->JOIN("LEFT JOIN", "team t", "t.teamId=kpi_team.teamId")
			->JOIN("LEFT JOIN", "kpi k", "k.kpiId=kpi_team.kpiId")
			->where(["kpi_team.status" => [1, 2, 4]])
			->andWhere(["kpi_team.kpiId" => $kpiId])
			->orderBy('t.teamName')
			->asArray()
			->all();
		$data = [];
		if (isset($kpiTeams) && count($kpiTeams) > 0) {
			foreach ($kpiTeams as $kpiTeam) :
				$kpiTeamHistory = KpiTeamHistory::find()
					->where(["kpiTeamId" => $kpiTeam["kpiTeamId"]])
					->asArray()
					->orderBy('createDateTime DESC')
					->one();
				if (!isset($kpiTeamHistory) || empty($kpiTeamHistory)) {
					$kpiTeamHistory = KpiTeam::find()
						->where(["kpiTeamId" => $kpiTeam["kpiTeamId"]])
						->asArray()
						->orderBy('createDateTime DESC')
						->one();
				}
				$ratio = 0;
				if ($kpiTeam["target"] != '' && $kpiTeam["target"] != 0 && $kpiTeam["target"] != null) {
					if ($kpiTeam["code"] == '<' || $kpiTeam["code"] == '=') {
						$ratio = ($kpiTeamHistory["result"] / $kpiTeam["target"]) * 100;
					} else {
						if ($kpiTeamHistory["result"] != '' && $kpiTeamHistory["result"] != 0) {
							$ratio = ($kpiTeam["target"] / $kpiTeamHistory["result"]) * 100;
						} else {
							$ratio = 0;
						}
					}
				} else {
					$ratio = 0;
				}
				$teamEmployee = KpiEmployee::countKpiFromTeam($kpiTeam["kpiId"], $kpiTeam["teamId"]);
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
				$data[$kpiTeam["kpiTeamId"]] = [
					"teamId" => $kpiTeam["teamId"],

					"teamName" => Team::teamName($kpiTeam["teamId"]),
					//"quantRatio" => $kpiTeam["quantRatio"],
					"target" => $kpiTeam["target"],
					"result" => $kpiTeamHistory["result"],
					"departmentName" => Department::departmentName($kpiTeam["departmentId"]),
					//"code" => $kpiTeam["code"],
					"month" =>  ModelMaster::monthEng($kpiTeamHistory['month'], 1),
					"year" => $kpiTeamHistory['year'],
					"fromDate" => ModelMaster::engDate($kpiTeamHistory["fromDate"], 2),
					"toDate" => ModelMaster::engDate($kpiTeamHistory["toDate"], 2),
					"periodCheck" => ModelMaster::engDate(KpiTeam::lastestCheckDate($kpiTeam["kpiTeamId"]), 2), //lastest check date
					"nextCheckDate" =>  ModelMaster::engDate($kpiTeamHistory["nextCheckDate"], 2),
					"status" => $kpiTeamHistory["status"],
					//"flag" => Country::countryFlagBycompany($kpiTeam["companyId"]),
					//"kpiEmployee" => KpiEmployee::kpiEmployee($kpiTeam["kpiId"]),
					"ratio" => number_format($ratio, 2),
					//"isOver" => ModelMaster::isOverDuedate(KpiTeam::nextCheckDate($kpiTeam['kpiTeamId'])),
					//"employee" => KpiTeam::kpiTeamEmployee($kpiTeam['kpiId'], $teamId),
					"countTeam" => KpiTeam::kpiTeam($kpiTeam["kpiId"]),
					//"amountType" => $kpiTeam["amountType"],
					//"issue" => KpiIssue::lastestIssue($kpiTeam["kpiId"])["issue"],
					//"solution" => KpiIssue::lastestIssue($kpiTeam["kpiId"])["solution"],
					"countTeamEmployee" => $countTeamEmployee,
					"kpiEmployeeSelect" => $selectPic,

				];
			endforeach;
		}

		return json_encode($data);
	}
	public function actionKpiTeamHistory($kpiId, $teamId)
	{
		$kpiTeamHistory = KpiTeamHistory::find()
			->select('kpi_team_history.*,e.employeeFirstname,e.employeeSurename')
			->JOIN("LEFT JOIN", "kpi_team kt", "kt.kpiTeamId=kpi_team_history.kpiTeamId")
			->JOIN("LEFT JOIN", "user u", "u.userId=kpi_team_history.createrId")
			->JOIN("LEFT JOIN", "employee e", "e.employeeId=u.employeeId")
			->where([
				"kt.kpiId" => $kpiId,
				"kt.teamId" => $teamId
			])
			->orderBy('kpi_team_history.createDateTime DESC')
			->asArray()
			->all();
		if (!isset($kpiTeamHistory) || count($kpiTeamHistory) == 0) {
			$kpiTeamHistory = KpiTeam::find()
				->select('kpi_team.*,e.employeeFirstname,e.employeeSurename')
				->JOIN("LEFT JOIN", "user u", "u.userId=kpi_team.createrId")
				->JOIN("LEFT JOIN", "employee e", "e.employeeId=u.employeeId")
				->where([
					"kpi_team..kpiId" => $kpiId,
					"kpi_team..teamId" => $teamId
				])
				->asArray()
				->all();
		}
		return json_encode($kpiTeamHistory);
	}
	public function actionAllTeamKpi($userId, $role)
	{
		$employeeId = Employee::employeeId($userId);
		$employee = Employee::EmployeeDetail($employeeId);
		$teamId = $employee["teamId"];
		if ($role <= 3) {
			$kpiTeams = KpiTeam::find()
				->select('k.kpiName,k.kpiId,k.unitId,k.quantRatio,k.priority,k.amountType,k.code,kpi_team.kpiTeamId,k.companyId,
			kpi_team.teamId,kpi_team.target')
				->JOIN("LEFT JOIN", "kpi k", "k.kpiId=kpi_team.kpiId")
				->JOIN("LEFT JOIN", "team t", "t.teamId=kpi_team.teamId")
				->where(["kpi_team.status" => [1, 2, 4], "k.status" => [1, 2, 4]])
				->andFilterWhere(["kpi_team.teamId" => $teamId])
				->orderBy("k.createDateTime DESC,t.teamName ASC")
				->asArray()
				->all();
		} else {
			$kpiTeams = KpiTeam::find()
				->select('k.kpiName,k.kpiId,k.unitId,k.quantRatio,k.priority,k.amountType,k.code,kpi_team.kpiTeamId,k.companyId,
			kpi_team.teamId,kpi_team.target')
				->JOIN("LEFT JOIN", "kpi k", "k.kpiId=kpi_team.kpiId")
				->JOIN("LEFT JOIN", "team t", "t.teamId=kpi_team.teamId")
				->where(["kpi_team.status" => [1, 2, 4], "k.status" => [1, 2, 4]])
				->orderBy("k.createDateTime DESC,t.teamName ASC")
				->asArray()
				->all();
		}
		$employeeId = Employee::employeeId($userId);
		$employee = Employee::EmployeeDetail($employeeId);
		$teamId = $employee["teamId"];

		if (isset($kpiTeams) && count($kpiTeams) > 0) {
			foreach ($kpiTeams as $kpiTeam) :
				$kpiTeamHistory = KpiTeamHistory::find()
					->where(["kpiTeamId" => $kpiTeam["kpiTeamId"]])
					->asArray()
					->orderBy('createDateTime DESC')
					->one();
				if (!isset($kpiTeamHistory) || empty($kpiTeamHistory)) {
					$kpiTeamHistory = KpiTeam::find()
						->where(["kpiTeamId" => $kpiTeam["kpiTeamId"]])
						->asArray()
						->orderBy('createDateTime DESC')
						->one();
				}
				$ratio = 0;
				if ($kpiTeam["target"] != '' && $kpiTeam["target"] != 0 && $kpiTeam["target"] != null) {
					if ($kpiTeam["code"] == '<' || $kpiTeam["code"] == '=') {
						$ratio = ($kpiTeamHistory["result"] / $kpiTeam["target"]) * 100;
					} else {
						if ($kpiTeamHistory["result"] != '' && $kpiTeamHistory["result"] != 0) {
							$ratio = ($kpiTeam["target"] / $kpiTeamHistory["result"]) * 100;
						} else {
							$ratio = 0;
						}
					}
				} else {
					$ratio = 0;
				}
				$teamEmployee = KpiEmployee::countKpiFromTeam($kpiTeam["kpiId"], $kpiTeam["teamId"]);
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
				$data[$kpiTeam["kpiTeamId"]] = [
					"kpiName" => $kpiTeam["kpiName"],
					"kpiId" => $kpiTeam["kpiId"],
					"teamId" => $kpiTeam["teamId"],
					"companyName" => Company::companyName($kpiTeam["companyId"]),
					"companyId" => $kpiTeam["companyId"],
					"branch" => KpiBranch::kpiBranch($kpiTeam["kpiId"]),
					"priority" => $kpiTeam["priority"],
					"unit" => Unit::unitName($kpiTeam["unitId"]),
					"teamName" => Team::teamName($kpiTeam["teamId"]),
					"quantRatio" => $kpiTeam["quantRatio"],
					"target" => $kpiTeam["target"],
					"result" => $kpiTeamHistory["result"],
					"code" => $kpiTeam["code"],
					"month" =>  ModelMaster::monthEng($kpiTeamHistory['month'], 1),
					"year" => $kpiTeamHistory['year'],
					"fromDate" => ModelMaster::engDate($kpiTeamHistory["fromDate"], 2),
					"toDate" => ModelMaster::engDate($kpiTeamHistory["toDate"], 2),
					"periodCheck" => ModelMaster::engDate(KpiTeam::lastestCheckDate($kpiTeam["kpiTeamId"]), 2), //lastest check date
					"nextCheckDate" =>  ModelMaster::engDate($kpiTeamHistory["nextCheckDate"], 2),
					"status" => $kpiTeamHistory["status"],
					"flag" => Country::countryFlagBycompany($kpiTeam["companyId"]),
					"countryName" => Country::countryNameBycompany($kpiTeam['companyId']),
					"kpiEmployee" => KpiEmployee::kpiEmployee($kpiTeam["kpiId"]),
					"ratio" => number_format($ratio, 2),
					"isOver" => ModelMaster::isOverDuedate(KpiTeam::nextCheckDate($kpiTeam['kpiTeamId'])),
					"employee" => KpiTeam::kpiTeamEmployee($kpiTeam['kpiId'], $teamId),
					"countTeam" => KpiTeam::kpiTeam($kpiTeam["kpiId"]),
					"amountType" => $kpiTeam["amountType"],
					"issue" => KpiIssue::lastestIssue($kpiTeam["kpiId"])["issue"],
					"solution" => KpiIssue::lastestIssue($kpiTeam["kpiId"])["solution"],
					"countTeamEmployee" => $countTeamEmployee,
					"kpiEmployeeSelect" => $selectPic,

				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionKpiTeamDetail($kpiTeamId)
	{
		$data = [];
		$ratio = 0;
		$kpiTeamHistory = KpiTeamHistory::find()
			->select('k.kpiName,k.kpiId,k.unitId,k.quantRatio,k.priority,k.companyId,k.code,kt.target,kt.kpiTeamId,
		kt.teamId,kpi_team_history.result,kpi_team_history.fromDate,kpi_team_history.toDate,kpi_team_history.month,
		kpi_team_history.status,kpi_team_history.nextCheckDate,k.kpiDetail,kpi_team_history.year,k.amountType,kt.remark')
			->JOIN("LEFT JOIN", "kpi_team kt", "kt.kpiTeamId=kpi_team_history.kpiTeamId")
			->JOIN("LEFT JOIN", "kpi k", "k.kpiId=kt.kpiId")
			->where(["kpi_team_history.kpiTeamId" => $kpiTeamId, "kpi_team_history.status" => [1, 2]])
			->asArray()
			->orderBy('kpi_team_history.createDateTime DESC')
			->one();
		if (!isset($kpiTeamHistory) || empty($kpiTeamHistory)) {
			$kpiTeamHistory = KpiTeam::find()
				->select('k.kpiName,k.kpiId,k.unitId,k.quantRatio,k.priority,k.companyId,k.code,kpi_team.target,kpi_team.kpiTeamId,
		kpi_team.teamId,kpi_team.result,kpi_team.fromDate,kpi_team.toDate,kpi_team.month,kpi_team.year,
		kpi_team.status,kpi_team.nextCheckDate,k.kpiDetail,k.amountType')
				->JOIN("LEFT JOIN", "kpi k", "k.kpiId=kpi_team.kpiId")
				->where(["kpi_team.kpiTeamId" => $kpiTeamId, "kpi_team.status" => [1, 2]])
				->asArray()
				->one();
		}
		if (isset($kpiTeamHistory) && !empty($kpiTeamHistory)) {
			$ratio = 0;
			if ($kpiTeamHistory["target"] != '' && $kpiTeamHistory["target"] != 0 && $kpiTeamHistory["target"] != null) {
				if ($kpiTeamHistory["code"] == '<' || $kpiTeamHistory["code"] == '=') {
					$ratio = ($kpiTeamHistory["result"] / $kpiTeamHistory["target"]) * 100;
				} else {
					if ($kpiTeamHistory["result"] != '' && $kpiTeamHistory["result"] != 0) {
						$ratio = ($kpiTeamHistory["target"] / $kpiTeamHistory["result"]) * 100;
					} else {
						$ratio = 0;
					}
				}
			}
			$data = [
				"kpiName" => $kpiTeamHistory["kpiName"],
				"kpiId" => $kpiTeamHistory["kpiId"],
				"priority" => $kpiTeamHistory["priority"],
				"unit" => Unit::unitName($kpiTeamHistory["unitId"]),
				"unitId" => $kpiTeamHistory["unitId"],
				"teamName" => Team::teamName($kpiTeamHistory["teamId"]),
				"quantRatio" => $kpiTeamHistory["quantRatio"] == 1 ? 'Quantity' : 'Quality',
				"amountType" => $kpiTeamHistory["amountType"] == 1 ? '%' : 'Number',
				"target" => $kpiTeamHistory["target"] != null ? $kpiTeamHistory["target"] : null,
				"result" => $kpiTeamHistory["result"],
				"codeText" => $kpiTeamHistory["code"] . ' &nbsp;(' . Kgi::codeDetail($kpiTeamHistory["code"]) . ')',
				"code" => $kpiTeamHistory["code"],
				"month" =>  $kpiTeamHistory['month'],
				"year" => $kpiTeamHistory['year'],
				"fromDate" => $kpiTeamHistory["fromDate"],
				"toDate" => $kpiTeamHistory["toDate"],
				"nextCheckDate" =>  $kpiTeamHistory["nextCheckDate"],
				"nextCheckDateText" => ModelMaster::engDate($kpiTeamHistory["nextCheckDate"], 2),
				"status" => $kpiTeamHistory["status"],
				//"kpiEmployee" => KpiEmployee::kpiEmployee($kpiTeamHistory["kpiId"]),
				"ratio" => number_format($ratio, 2),
				"kpiDetail" => $kpiTeamHistory["kpiDetail"],
				"remark" => $kpiTeamHistory["remark"]
			];
		}
		return json_encode($data);
	}
	public function actionKpiTeamHistoryView($kpiTeamId)
	{
		$kpiTeamHistory = KpiTeamHistory::find()
			->select('kpi_team_history.*,e.employeeFirstname,e.employeeSurename,k.code')
			->JOIN("LEFT JOIN", "kpi_team kt", "kt.kpiTeamId=kpi_team_history.kpiTeamId")
			->JOIN("LEFT JOIN", "kpi k", "k.kpiId=kt.kpiId")
			->JOIN("LEFT JOIN", "user u", "u.userId=kpi_team_history.createrId")
			->JOIN("LEFT JOIN", "employee e", "e.employeeId=u.employeeId")
			->where([
				"kpi_team_history.kpiTeamId" => $kpiTeamId,
			])
			->orderBy('kpi_team_history.createDateTime DESC')
			->asArray()
			->all();
		if (!isset($kpiTeamHistory) || count($kpiTeamHistory) == 0) {
			$kpiTeamHistory = KpiTeam::find()
				->select('kpi_team.*,e.employeeFirstname,e.employeeSurename')
				->JOIN("LEFT JOIN", "user u", "u.userId=kpi_team.createrId")
				->JOIN("LEFT JOIN", "employee e", "e.employeeId=u.employeeId")
				->where([
					"kpi_team.kpiTeamId" => $kpiTeamId,
				])
				->asArray()
				->all();
		}
		return json_encode($kpiTeamHistory);
	}
	public function actionKpiTeamFilter($companyId, $branchId, $teamId, $month, $status, $year)
	{
		$kpiTeams = KpiTeam::find()
			->select('k.kpiName,k.kpiId,k.unitId,k.quantRatio,k.priority,k.amountType,k.code,kpi_team.kpiTeamId,k.companyId,
			kpi_team.teamId,kpi_team.target')
			->JOIN("LEFT JOIN", "kpi k", "k.kpiId=kpi_team.kpiId")
			->JOIN("LEFT JOIN", "kpi_branch kb", "kb.kpiId=k.kpiId")
			->JOIN("LEFT JOIN", "team t", "t.teamId=kpi_team.teamId")
			->where("kpi_team.status!=99 and k.status!=99")
			->andFilterWhere([
				"kb.branchId" => $branchId,
				"kpi_team.teamId" => $teamId,
				"kpi_team.month" => $month,
				"kpi_team.year" => $year,
				"kpi_team.status" => $status,
			])
			->orderBy("k.createDateTime DESC,t.teamName ASC")
			->asArray()
			->all();
		$data = [];
		$ratio = 0;
		if (isset($kpiTeams) && count($kpiTeams) > 0) {
			foreach ($kpiTeams as $kpiTeam) :
				$kpiTeamHistory = KpiTeamHistory::find()
					->select('kpi_team_history.*')
					->JOIN("LEFT JOIN", "kpi_team kt", "kt.kpiTeamId=kpi_team_history.kpiTeamId")
					->where([
						"kpi_team_history.kpiTeamId" => $kpiTeam["kpiTeamId"],
						"kpi_team_history.status" => [1, 2]
					])
					->andFilterWhere([
						"kt.teamId" => $teamId,
						"kpi_team_history.month" => $month,
						"kpi_team_history.year" => $year,
						"kpi_team_history.status" => $status,
					])
					->asArray()
					->orderBy('kpi_team_history.createDateTime DESC')
					->one();
				if (!isset($kpiTeamHistory) || empty($kpiTeamHistory)) {
					$kpiTeamHistory = KpiTeam::find()
						->where(["kpiTeamId" => $kpiTeam["kpiTeamId"]])
						->andFilterWhere([
							"teamId" => $teamId,
							"month" => $month,
							"year" => $year,
							"status" => $status,
						])
						->asArray()
						->orderBy('createDateTime DESC')
						->one();
				}
				if ($kpiTeam["target"] != '' && $kpiTeam["target"] != 0 && $kpiTeam["target"] != null) {
					if ($kpiTeam["code"] == '<' || $kpiTeam["code"] == '=') {
						$ratio = ($kpiTeamHistory["result"] / $kpiTeam["target"]) * 100;
					} else {
						if ($kpiTeamHistory["result"] != '' && $kpiTeamHistory["result"] != 0) {
							$ratio = ($kpiTeam["target"] / $kpiTeamHistory["result"]) * 100;
						} else {
							$ratio = 0;
						}
					}
				} else {
					$ratio = 0;
				}
				$teamEmployee = KpiEmployee::countKpiFromTeam($kpiTeam["kpiId"], $kpiTeam["teamId"]);
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
				$data[$kpiTeam["kpiTeamId"]] = [
					"kpiName" => $kpiTeam["kpiName"],
					"kpiId" => $kpiTeam["kpiId"],
					"teamId" => $kpiTeam["teamId"],
					"companyName" => Company::companyName($kpiTeam["companyId"]),
					"companyId" => $kpiTeam["companyId"],
					"branch" => KpiBranch::kpiBranch($kpiTeam["kpiId"]),
					"priority" => $kpiTeam["priority"],
					"unit" => Unit::unitName($kpiTeam["unitId"]),
					"teamName" => Team::teamName($kpiTeam["teamId"]),
					"quantRatio" => $kpiTeam["quantRatio"],
					"target" => $kpiTeam["target"],
					"result" => $kpiTeamHistory["result"],
					"code" => $kpiTeam["code"],
					"month" =>  ModelMaster::monthEng($kpiTeamHistory['month'], 1),
					"year" => $kpiTeamHistory['year'],
					"fromDate" => ModelMaster::engDate($kpiTeamHistory["fromDate"], 2),
					"toDate" => ModelMaster::engDate($kpiTeamHistory["toDate"], 2),
					"periodCheck" => ModelMaster::engDate(KpiTeam::lastestCheckDate($kpiTeam["kpiTeamId"]), 2),
					"nextCheckDate" =>  ModelMaster::engDate($kpiTeamHistory["nextCheckDate"], 2),
					"status" => $kpiTeamHistory["status"],
					"flag" => Country::countryFlagBycompany($kpiTeam["companyId"]),
					"countryName" => Country::countryNameBycompany($kpiTeam['companyId']),
					"kpiEmployee" => KpiEmployee::kpiEmployee($kpiTeam["kpiId"]),
					"ratio" => number_format($ratio, 2),
					"isOver" => ModelMaster::isOverDuedate(KpiTeam::nextCheckDate($kpiTeam['kpiTeamId'])),
					"employee" => KpiTeam::kpiTeamEmployee($kpiTeam['kpiId'], $kpiTeam["kpiTeamId"]),
					"countTeam" => KpiTeam::kpiTeam($kpiTeam["kpiId"]),
					"amountType" => $kpiTeam["amountType"],
					"issue" => KpiIssue::lastestIssue($kpiTeam["kpiId"])["issue"],
					"solution" => KpiIssue::lastestIssue($kpiTeam["kpiId"])["solution"],
					"countTeamEmployee" => $countTeamEmployee,
					"kpiEmployeeSelect" => $selectPic,
				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionKpiTeamEmployee($kpiId)
	{
		$kpiTeams = KpiTeam::find()
			->select('kpi_team.kpiId,kpi_team.teamId,t.teamName,kpi_team.target,d.departmentName')
			->JOIN("LEFT JOIN", "team t", "t.teamId=kpi_team.teamId")
			->JOIN("LEFT JOIN", "department d", "d.departmentId=t.departmentId")
			->where(["kpi_team.kpiId" => $kpiId, "t.status" => 1])
			->asArray()
			->all();
		$data = [];
		$totalEmployee = 0;
		$totalTargetAll = 0;
		if (isset($kpiTeams) && count($kpiTeams) > 0) {
			foreach ($kpiTeams as $kpiTeam):
				$employees = Employee::find()
					->where(["status" => 1, "teamId" => $kpiTeam["teamId"]])
					->asArray()
					->orderBy('employeeFirstname')
					->all();
				$totalTeamTarget = 0;
				$teamTarget = $kpiTeam['target'];

				foreach ($employees as $employee):
					if ($employee["picture"] != '') {
						$img = $employee["picture"];
					} else {
						if ($employee["gender"] == 1) {
							$img = "image/user.png";
						} else {
							$img = "image/lady.jpg";
						}
					}
					$kpiEmployee = KpiEmployee::find()
						->where(["employeeId" => $employee["employeeId"], "kpiId" => $kpiId])
						->asArray()
						->orderBy('createDateTime DESC')
						->one();

					if (isset($kpiEmployee) && !empty($kpiEmployee)) {
						if (isset($kpiEmployee) && count($kpiEmployee) > 0) {
							$employeeTarget = $kpiEmployee["target"];
							$totalTeamTarget += $employeeTarget;
							$checked = "checked";
							$totalEmployee++;
						} else {
							$employeeTarget = 0;
							$checked = "";
						}
						$data[$kpiTeam["teamId"]]["employee"][$employee["employeeId"]] = [
							"employeeFirstname" => $employee["employeeFirstname"],
							"employeeSurename" => $employee["employeeSurename"],
							"target" => $employeeTarget,
							"picture" => $img,
							"checked" => $checked
						];
					} else {
						$data[$kpiTeam["teamId"]]["employee"][$employee["employeeId"]] = [
							"employeeFirstname" => $employee["employeeFirstname"],
							"employeeSurename" => $employee["employeeSurename"],
							"target" => 0,
							"picture" => $img,
							"checked" => ""
						];
					}
				endforeach;
				$data[$kpiTeam["teamId"]]["team"] = [
					"totalTeamTarget" => $totalTeamTarget
				];
				if ($totalTeamTarget > $teamTarget) {
					if ($teamTarget > 0) {
						$percentage = (($totalTeamTarget / $teamTarget) * 100);
					} else {
						$percentage = 0;
					}
					$isMore = 1;
				} else {
					if ($teamTarget > 0) {
						$percentage = (($totalTeamTarget / $teamTarget) * 100);
					} else {
						$percentage = 0;
					}
					$isMore = 0;
					if ($totalTeamTarget == $teamTarget) {
						$percentage = 0;
						$isMore = "-";
					}
				}
				$data[$kpiTeam["teamId"]]["team"]["percentage"] = $percentage;
				$data[$kpiTeam["teamId"]]["team"]["isMore"] = $isMore;
				$data[$kpiTeam["teamId"]]["team"]["teamName"] = $kpiTeam["teamName"];
				$data[$kpiTeam["teamId"]]["team"]["departmentName"] = $kpiTeam["departmentName"];
				$totalTargetAll += $totalTeamTarget;

			endforeach;
		}
		$data["base"]["totalTargetAll"] = $totalTargetAll;
		if ($totalEmployee > 0) {
			$data["base"]["averageTarget"] = $totalTargetAll / $totalEmployee;
		} else {
			$data["base"]["averageTarget"] = 0;
		}
		return json_encode($data);
	}
	public function actionKpiTeamHistorySummarize($kpiTeamId)
	{
		$kpiTeamHistory = KpiTeamHistory::find()
			->select('kpi_team_history.*,k.unitId,k.quantRatio,k.code,k.amountType')
			->JOIN("LEFT JOIN", "kpi_team kt", "kt.kpiTeamId=kpi_team_history.kpiTeamId")
			->JOIN("LEFT JOIN", "kpi k", "k.kpiId=kt.kpiId")
			->where([
				"kpi_team_history.kpiTeamId" => $kpiTeamId,
			])
			->andWhere("kpi_team_history.status!=99")
			->orderBy("kpi_team_history.year DESC,kpi_team_history.month DESC,kpi_team_history.kpiTeamHistoryId")
			->asArray()
			->all();
		$data = [];
		if (isset($kpiTeamHistory) && count($kpiTeamHistory) > 0) {
			foreach ($kpiTeamHistory as $history):
				$ratio = 0;
				if ($history["code"] == '<' || $history["code"] == '=') {
					if ((float)$history["target"] != 0) {
						$ratio = ((float)$history['result'] / (float)$history["target"]) * 100;
					} else {
						$ratio = 0;
					}
				} else {
					if ($history["result"] != '' && $history["result"] != 0) {
						$ratio = ((float)$history["target"] / (float)$history["result"]) * 100;
					} else {
						$ratio = 0;
					}
				}
				$data[$history["year"]][$history["month"]] = [
					"kpiTeamHistoryId" => $history["kpiTeamHistoryId"],
					"target" => (float)$history['target'],
					"unit" => Unit::unitName($history['unitId']),
					"month" => ModelMaster::monthEng($history['month'], 1),
					"year" => $history["year"],
					"status" => $history['status'],
					"quantRatio" => $history["quantRatio"],
					"code" =>  $history["code"],
					"result" => (float)$history["result"],
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
	// public function actionWaitForApprove()
	// {
	// 	$kpiTeam = KpiTeamHistory::find()
	// 		->where(["status" => 88])
	// 		->asArray()
	// 		->all();
	// 	$res["totalRqeuest"] = count($kpiTeam);
	// 	return json_encode($res);
	// }

	public function actionWaitForApprove($branchId, $isAdmin)
	{
		if ($isAdmin == 1) {
			$kpiTeam = KpiTeamHistory::find()
				->where(["status" => 88])
				->asArray()
				->all();
		} else {
			$kpiTeam = KpiTeamHistory::find()
				->select('k.kpiName,k.kpiId,MAX(kpi_team_history.kpiTeamHistoryId)')
				->JOIN("LEFT JOIN", "kpi_team kg", "kg.kpiTeamId=kpi_team_history.kpiTeamId")
				->JOIN("LEFT JOIN", "kpi k", "k.kpiId=kg.kpiId")
				->JOIN("LEFT JOIN", "kpi_branch kb", "kb.kpiId=k.kpiId")
				->where(["kpi_team_history.status" => 88, "kb.branchId" => $branchId])
				//->orderBy('kpi_team_history.kpiTeamHistoryId DESC')
				->groupBy('k.kpiId')

				->asArray()
				->all();
		}
		//	throw new exception(print_r($kpiTeam, true));
		$res["totalRequest"] = count($kpiTeam);

		return json_encode($res);
	}
}
