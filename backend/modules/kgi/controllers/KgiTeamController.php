<?php

namespace backend\modules\kgi\controllers;

use backend\models\hrvc\Company;
use backend\models\hrvc\Country;
use backend\models\hrvc\Employee;
use backend\models\hrvc\GroupHasKgi;
use backend\models\hrvc\Kgi;
use backend\models\hrvc\KgiBranch;
use backend\models\hrvc\KgiEmployee;
use backend\models\hrvc\KgiGroup;
use backend\models\hrvc\KgiIssue;
use backend\models\hrvc\KgiTeam;
use backend\models\hrvc\KgiTeamHistory;
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
class KgiTeamController extends Controller
{
	public function actionKgiTeam($kgiId)
	{
		$kgiTeams = KgiTeam::find()
			->select('kgi_team.teamId,t.teamName,kgi_team.target,kgi_team.remark')
			->JOIN("LEFT JOIN", "team t", "t.teamId=kgi_team.teamId")
			->where(["kgi_team.status" => [1, 2, 4], "t.status" => [1, 2, 4]])
			->andWhere(["kgi_team.kgiId" => $kgiId])
			->orderBy('t.teamId')
			->asArray()
			->all();
		return json_encode($kgiTeams);
	}
	public function actionKgiTeamHistory($kgiId, $teamId)
	{
		$kgiTeamHistory = KgiTeamHistory::find()
			->select('kgi_team_history.*,e.employeeFirstname,e.employeeSurename,kt.remark')
			->JOIN("LEFT JOIN", "kgi_team kt", "kt.kgiTeamId=kgi_team_history.kgiTeamId")
			->JOIN("LEFT JOIN", "user u", "u.userId=kgi_team_history.createrId")
			->JOIN("LEFT JOIN", "employee e", "e.employeeId=u.employeeId")
			->where([
				"kt.kgiId" => $kgiId,
				"kt.teamId" => $teamId
			])
			->orderBy('kgi_team_history.createDateTime DESC')
			->asArray()
			->all();
		if (!isset($kgiTeamHistory) || count($kgiTeamHistory) == 0) {
			$kgiTeamHistory = KgiTeam::find()
				->select('kgi_team.*,e.employeeFirstname,e.employeeSurename')
				->JOIN("LEFT JOIN", "user u", "u.userId=kgi_team.createrId")
				->JOIN("LEFT JOIN", "employee e", "e.employeeId=u.employeeId")
				->where([
					"kgi_team.kgiId" => $kgiId,
					"kgi_team.teamId" => $teamId
				])
				->asArray()
				->all();
		}
		return json_encode($kgiTeamHistory);
	}
	public function actionAllTeamKgi($userId, $role)
	{
		//if ($role < 3) { //staff, hr
		// $kgiTeams = KgiTeam::find()
		// 	->select('k.kgiName,k.kgiId,k.unitId,k.quantRatio,k.priority,k.amountType,k.code,kgi_team.kgiTeamId,k.companyId,
		// kgi_team.teamId,kgi_team.target')
		// 	->JOIN("LEFT JOIN", "kgi k", "k.kgiId=kgi_team.kgiId")
		// 	->JOIN("LEFT JOIN", "team t", "t.teamId=kgi_team.teamId")
		// 	->where(["kgi_team.status" => [1, 2, 4], "k.status" => [1, 2, 4]])
		// 	->orderBy("k.createDateTime DESC,t.teamName ASC")
		// 	->asArray()
		// 	->all();
		//} else {
		$employeeId = Employee::employeeId($userId);
		$employee = Employee::EmployeeDetail($employeeId);
		$teamId = $employee["teamId"];
		$kgiTeams = KgiTeam::find()
			->select('k.kgiName,k.kgiId,k.unitId,k.quantRatio,k.priority,k.amountType,k.code,kgi_team.kgiTeamId,k.companyId,
			kgi_team.teamId,kgi_team.target')
			->JOIN("LEFT JOIN", "kgi k", "k.kgiId=kgi_team.kgiId")
			->JOIN("LEFT JOIN", "team t", "t.teamId=kgi_team.teamId")
			->where(["kgi_team.status" => [1, 2, 4], "k.status" => [1, 2, 4]])
			->andFilterWhere(["kgi_team.teamId" => $teamId])
			->orderBy("k.createDateTime DESC,t.teamName ASC")
			->asArray()
			->all();
		//}
		if (isset($kgiTeams) && count($kgiTeams) > 0) {
			foreach ($kgiTeams as $kgiTeam) :
				$kgiTeamHistory = KgiTeamHistory::find()
					->where(["kgiTeamId" => $kgiTeam["kgiTeamId"]])
					->asArray()
					->orderBy('createDateTime DESC')
					->one();
				if (!isset($kgiTeamHistory) || empty($kgiTeamHistory)) {
					$kgiTeamHistory = KgiTeam::find()
						->where(["kgiTeamId" => $kgiTeam["kgiTeamId"]])
						->asArray()
						->orderBy('createDateTime DESC')
						->one();
				}
				$ratio = 0;
				if ($kgiTeam["target"] != '' && $kgiTeam["target"] != 0 && $kgiTeam["target"] != null) {
					if ($kgiTeam["code"] == '<' || $kgiTeam["code"] == '=') {
						$ratio = ($kgiTeamHistory["result"] / $kgiTeam["target"]) * 100;
					} else {
						if ($kgiTeamHistory["result"] != '' && $kgiTeamHistory["result"] != 0) {
							$ratio = ($kgiTeam["target"] / $kgiTeamHistory["result"]) * 100;
						} else {
							$ratio = 0;
						}
					}
				} else {
					$ratio = 0;
				}
				$data[$kgiTeam["kgiTeamId"]] = [
					"kgiName" => $kgiTeam["kgiName"],
					"kgiId" => $kgiTeam["kgiId"],
					"teamId" => $kgiTeam["teamId"],
					"companyName" => Company::companyName($kgiTeam["companyId"]),
					"branch" => KgiBranch::kgiBranch($kgiTeam["kgiId"]),
					"priority" => $kgiTeam["priority"],
					"unit" => Unit::unitName($kgiTeam["unitId"]),
					"teamName" => Team::teamName($kgiTeam["teamId"]),
					"quantRatio" => $kgiTeam["quantRatio"],
					"target" => $kgiTeam["target"],
					"result" => $kgiTeamHistory["result"],
					"code" => $kgiTeam["code"],
					"month" =>  ModelMaster::monthEng($kgiTeamHistory['month'], 1),
					"year" => $kgiTeamHistory['year'],
					"fromDate" => ModelMaster::engDate($kgiTeamHistory["fromDate"], 2),
					"toDate" => ModelMaster::engDate($kgiTeamHistory["toDate"], 2),
					"periodCheck" => ModelMaster::engDate(KgiTeam::lastestCheckDate($kgiTeam["kgiTeamId"]), 2), //lastest check date
					"nextCheckDate" =>  ModelMaster::engDate($kgiTeamHistory["nextCheckDate"], 2),
					"status" => $kgiTeamHistory["status"],
					"flag" => Country::countryFlagBycompany($kgiTeam["companyId"]),
					"countryName" => Country::countryNameBycompany($kgiTeam['companyId']),
					"kgiEmployee" => KgiEmployee::kgiEmployee($kgiTeam["kgiId"]),
					"ratio" => number_format($ratio, 2),
					"isOver" => ModelMaster::isOverDuedate(KgiTeam::nextCheckDate($kgiTeam['kgiTeamId'])),
					"employee" => KgiTeam::kgiTeamEmployee($kgiTeam['kgiId'], $teamId),
					"countTeam" => KgiTeam::kgiTeam($kgiTeam["kgiId"]),
					"amountType" => $kgiTeam["amountType"],
					"issue" => KgiIssue::lastestIssue($kgiTeam["kgiId"])["issue"],
					"solution" => KgiIssue::lastestIssue($kgiTeam["kgiId"])["solution"],

				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionKgiTeamDetail($kgiTeamId)
	{
		$data = [];
		$ratio = 0;
		$kgiTeamHistory = KgiTeamHistory::find()
			->select('k.kgiName,k.kgiId,k.unitId,k.quantRatio,k.priority,k.companyId,k.code,kt.target,kt.kgiTeamId,
		kt.teamId,kgi_team_history.result,kgi_team_history.fromDate,kgi_team_history.toDate,kgi_team_history.month,
		kgi_team_history.status,kgi_team_history.nextCheckDate,k.kgiDetail,kgi_team_history.year,k.amountType,kt.remark')
			->JOIN("LEFT JOIN", "kgi_team kt", "kt.kgiTeamId=kgi_team_history.kgiTeamId")
			->JOIN("LEFT JOIN", "kgi k", "k.kgiId=kt.kgiId")
			->where(["kgi_team_history.kgiTeamId" => $kgiTeamId, "kgi_team_history.status" => [1, 2]])
			->asArray()
			->orderBy('kgi_team_history.createDateTime DESC')
			->one();
		if (!isset($kgiTeamHistory) || empty($kgiTeamHistory)) {
			$kgiTeamHistory = KgiTeam::find()
				->select('k.kgiName,k.kgiId,k.unitId,k.quantRatio,k.priority,k.companyId,k.code,kgi_team.target,kgi_team.kgiTeamId,
		kgi_team.teamId,kgi_team.result,kgi_team.fromDate,kgi_team.toDate,kgi_team.month,kgi_team.year,
		kgi_team.status,kgi_team.nextCheckDate,k.kgiDetail,k.amountType,kgi_team.remark')
				->JOIN("LEFT JOIN", "kgi k", "k.kgiId=kgi_team.kgiId")
				->where(["kgi_team.kgiTeamId" => $kgiTeamId, "kgi_team.status" => [1, 2]])
				->asArray()
				->one();
		}
		if (isset($kgiTeamHistory) && !empty($kgiTeamHistory)) {
			if ($kgiTeamHistory["target"] != '' && $kgiTeamHistory["target"] != 0 && $kgiTeamHistory["target"] != null) {
				if ($kgiTeamHistory["code"] == '<' || $kgiTeamHistory["code"] == '=') {
					$ratio = ($kgiTeamHistory["result"] / $kgiTeamHistory["target"]) * 100;
				} else {
					if ($kgiTeamHistory["result"] != '' && $kgiTeamHistory["result"] != 0) {
						$ratio = ($kgiTeamHistory["target"] / $kgiTeamHistory["result"]) * 100;
					} else {
						$ratio = 0;
					}
				}
			} else {
				$ratio = 0;
			}
			$data = [
				"kgiName" => $kgiTeamHistory["kgiName"],
				"kgiId" => $kgiTeamHistory["kgiId"],
				"priority" => $kgiTeamHistory["priority"],
				"unit" => Unit::unitName($kgiTeamHistory["unitId"]),
				"unitId" => $kgiTeamHistory["unitId"],
				"teamName" => Team::teamName($kgiTeamHistory["teamId"]),
				"quantRatio" => $kgiTeamHistory["quantRatio"] == 1 ? 'Quantity' : 'Quality',
				"amountType" => $kgiTeamHistory["amountType"] == 1 ? '%' : 'Number',
				"target" => $kgiTeamHistory["target"] != null ? $kgiTeamHistory["target"] : 'not set',
				"result" => $kgiTeamHistory["result"],
				"codeText" => $kgiTeamHistory["code"] . ' &nbsp;(' . Kgi::codeDetail($kgiTeamHistory["code"]) . ')',
				"code" => $kgiTeamHistory["code"],
				"month" =>  $kgiTeamHistory['month'],
				"year" => $kgiTeamHistory['year'],
				"fromDate" => $kgiTeamHistory["fromDate"],
				"toDate" => $kgiTeamHistory["toDate"],
				"nextCheckDate" =>  $kgiTeamHistory["nextCheckDate"],
				"nextCheckDateText" => ModelMaster::engDate($kgiTeamHistory["nextCheckDate"], 2),
				"status" => $kgiTeamHistory["status"],
				"kgiEmployee" => KgiEmployee::kgiEmployee($kgiTeamHistory["kgiId"]),
				"ratio" => number_format($ratio, 2),
				"kgiDetail" => $kgiTeamHistory["kgiDetail"],
				"remark" => $kgiTeamHistory["remark"]
			];
		}
		return json_encode($data);
	}

	public function actionKgiTeamHistoryView($kgiTeamId)
	{
		$kgiTeamHistory = KgiTeamHistory::find()
			->select('kgi_team_history.*,e.employeeFirstname,e.employeeSurename,k.code')
			->JOIN("LEFT JOIN", "kgi_team kt", "kt.kgiTeamId=kgi_team_history.kgiTeamId")
			->JOIN("LEFT JOIN", "kgi k", "k.kgiId=kt.kgiId")
			->JOIN("LEFT JOIN", "user u", "u.userId=kgi_team_history.createrId")
			->JOIN("LEFT JOIN", "employee e", "e.employeeId=u.employeeId")
			->where([
				"kgi_team_history.kgiTeamId" => $kgiTeamId,
			])
			->orderBy('kgi_team_history.createDateTime DESC')
			->asArray()
			->all();
		if (!isset($kgiTeamHistory) || count($kgiTeamHistory) == 0) {
			$kgiTeamHistory = KgiTeam::find()
				->select('kgi_team.*,e.employeeFirstname,e.employeeSurename')
				->JOIN("LEFT JOIN", "user u", "u.userId=kgi_team.createrId")
				->JOIN("LEFT JOIN", "employee e", "e.employeeId=u.employeeId")
				->where([
					"kgi_team.kgiTeamId" => $kgiTeamId,
				])
				->asArray()
				->all();
		}
		return json_encode($kgiTeamHistory);
	}
	public function actionKgiTeamFilter($companyId, $branchId, $teamId, $month, $status, $year)
	{
		$kgiTeams = KgiTeam::find()
			->select('k.kgiName,k.kgiId,k.unitId,k.quantRatio,k.priority,k.amountType,k.code,kgi_team.kgiTeamId,k.companyId,
			kgi_team.teamId,kgi_team.target')
			->JOIN("LEFT JOIN", "kgi k", "k.kgiId=kgi_team.kgiId")
			->JOIN("LEFT JOIN", "kgi_branch kb", "kb.kgiId=k.kgiId")
			->JOIN("LEFT JOIN", "team t", "t.teamId=kgi_team.teamId")
			->where("kgi_team.status!=99 and k.status!=99")
			->andFilterWhere([
				"kb.branchId" => $branchId,
				"kgi_team.teamId" => $teamId,
				//"kgi_team.month" => $month,
				//"kgi_team.year" => $year,
				//"kgi_team.status" => $status,
			])
			->orderBy("k.createDateTime DESC,t.teamName ASC")
			->asArray()
			->all();
		$data = [];
		if (isset($kgiTeams) && count($kgiTeams) > 0) {
			foreach ($kgiTeams as $kgiTeam) :
				$kgiTeamHistory = KgiTeamHistory::find()
					->select('kgi_team_history.*')
					->JOIN("LEFT JOIN", "kgi_team kt", "kt.kgiTeamId=kgi_team_history.kgiTeamId")
					->where([
						"kgi_team_history.kgiTeamId" => $kgiTeam["kgiTeamId"],
						"kgi_team_history.status" => [1, 2]
					])
					->andFilterWhere([
						//"kb.branchId" => $branchId,
						"kt.teamId" => $teamId,
						"kgi_team_history.month" => $month,
						"kgi_team_history.year" => $year,
						"kgi_team_history.status" => $status,
					])
					->asArray()
					->orderBy('kgi_team_history.createDateTime DESC')
					->one();
				if (!isset($kgiTeamHistory) || empty($kgiTeamHistory)) {
					$kgiTeamHistory = KgiTeam::find()
						->where(["kgiTeamId" => $kgiTeam["kgiTeamId"]])
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
				$ratio = 0;
				if ($kgiTeam["target"] != '' && $kgiTeam["target"] != 0 && $kgiTeam["target"] != null) {
					if ($kgiTeam["code"] == '<' || $kgiTeam["code"] == '=') {
						$ratio = ($kgiTeamHistory["result"] / $kgiTeam["target"]) * 100;
					} else {
						if ($kgiTeamHistory["result"] != '' && $kgiTeamHistory["result"] != 0) {
							$ratio = ($kgiTeam["target"] / $kgiTeamHistory["result"]) * 100;
						} else {
							$ratio = 0;
						}
					}
				} else {
					$ratio = 0;
				}
				$data[$kgiTeam["kgiTeamId"]] = [
					"kgiName" => $kgiTeam["kgiName"],
					"kgiId" => $kgiTeam["kgiId"],
					"teamId" => $kgiTeam["teamId"],
					"companyName" => Company::companyName($kgiTeam["companyId"]),
					"branch" => KgiBranch::kgiBranch($kgiTeam["kgiId"]),
					"priority" => $kgiTeam["priority"],
					"unit" => Unit::unitName($kgiTeam["unitId"]),
					"teamName" => Team::teamName($kgiTeam["teamId"]),
					"quantRatio" => $kgiTeam["quantRatio"],
					"target" => $kgiTeamHistory["target"],
					"result" => $kgiTeamHistory["result"],
					"code" => $kgiTeam["code"],
					"month" =>  ModelMaster::monthEng($kgiTeamHistory['month'], 1),
					"year" => $kgiTeamHistory['year'],
					"fromDate" => ModelMaster::engDate($kgiTeamHistory["fromDate"], 2),
					"toDate" => ModelMaster::engDate($kgiTeamHistory["toDate"], 2),
					"periodCheck" => ModelMaster::engDate(KgiTeam::lastestCheckDate($kgiTeam["kgiTeamId"]), 2),
					"nextCheckDate" =>  ModelMaster::engDate($kgiTeamHistory["nextCheckDate"], 2),
					"status" => $kgiTeamHistory["status"],
					"flag" => Country::countryFlagBycompany($kgiTeam["companyId"]),
					"countryName" => Country::countryNameBycompany($kgiTeam['companyId']),
					"kgiEmployee" => KgiEmployee::kgiEmployee($kgiTeam["kgiId"]),
					"ratio" => number_format($ratio, 2),
					"isOver" => ModelMaster::isOverDuedate(KgiTeam::nextCheckDate($kgiTeam['kgiTeamId'])),
					"employee" => KgiTeam::kgiTeamEmployee($kgiTeam['kgiId'], $kgiTeam["teamId"]),
					"amountType" => $kgiTeam["amountType"],
					"issue" => KgiIssue::lastestIssue($kgiTeam["kgiId"])["issue"],
					"solution" => KgiIssue::lastestIssue($kgiTeam["kgiId"])["solution"],
				];
			endforeach;
		}
		return json_encode($data);
	}
}