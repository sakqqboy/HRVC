<?php

namespace backend\modules\kgi\controllers;

use backend\models\hrvc\Company;
use backend\models\hrvc\Country;
use backend\models\hrvc\Department;
use backend\models\hrvc\Employee;
use backend\models\hrvc\GroupHasKgi;
use backend\models\hrvc\Kgi;
use backend\models\hrvc\KgiBranch;
use backend\models\hrvc\KgiEmployee;
use backend\models\hrvc\KgiGroup;
use backend\models\hrvc\KgiIssue;
use backend\models\hrvc\KgiTeam;
use backend\models\hrvc\KgiTeamHistory;
use backend\models\hrvc\KpiTeam;
use backend\models\hrvc\KpiTeamHistory;
use backend\models\hrvc\Team;
use backend\models\hrvc\Unit;
use backend\models\hrvc\User;
use common\models\ModelMaster;
use Exception;
use yii\web\Controller;
use Yii;
use yii\web\Response;
use common\helpers\Athorize;

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
class KgiTeamController extends Controller
{
	public function beforeAction($action)
	{
		$authHeader = Yii::$app->request->getHeaders()->get('TcgHrvcAuthorization');
		$check = Athorize::CheckRequest($authHeader);
		if ($check == 0) {
			Yii::$app->response->format = Response::FORMAT_JSON;
			Yii::$app->response->statusCode = 401;
			Yii::$app->response->data = [
				'status' => 'error',
				'message' => 'Invalid or missing token.'
			];
			return false;
		}
		return parent::beforeAction($action);
	}
	public function actionKgiTeam($kgiId, $month, $year)
	{
		$kgiTeams = KgiTeam::find()
			->select('kgi_team.teamId,t.teamName,kgi_team.target,kgi_team.remark,d.departmentName,d.departmentId')
			->JOIN("LEFT JOIN", "team t", "t.teamId=kgi_team.teamId")
			->JOIN("LEFT JOIN", "department d", "d.departmentId=t.departmentId")
			->where(["kgi_team.status" => [1, 2, 4], "t.status" => [1, 2, 4], "kgi_team.month" => $month, "kgi_team.year" => $year])
			->andWhere(["kgi_team.kgiId" => $kgiId])
			->orderBy('t.teamId')
			->asArray()
			->all();
		return json_encode($kgiTeams);
	}
	public function actionKgiTeamEachUnit($kgiId, $month, $year)
	{
		// $kgiTeams = KgiTeam::find()
		// 	->select('kgi_team.teamId,t.teamName,kgi_team.target,kgi_team.remark,d.departmentName,d.departmentId')
		// 	->JOIN("LEFT JOIN", "team t", "t.teamId=kgi_team.teamId")
		// 	->JOIN("LEFT JOIN", "department d", "d.departmentId=t.departmentId")
		// 	->where(["kgi_team.status" => [1, 2, 4], "t.status" => [1, 2, 4], "kgi_team.month" => $month, "kgi_team.year" => $year])
		// 	->andWhere(["kgi_team.kgiId" => $kgiId])
		// 	->orderBy('t.teamId')
		// 	->asArray()
		// 	->all();
		$kgiTeamHistory = KgiTeamHistory::find()
			->select('kgi_team_history.month,kgi_team_history.year,kgi_team_history.kgiTeamId,kt.teamId,kgi_team_history.target')
			->JOIN("LEFT JOIN", "kgi_team kt", "kt.kgiTeamId=kgi_team_history.kgiTeamId")
			->where(["kt.kgiId" => $kgiId, "kgi_team_history.month" => $month, "kgi_team_history.year" => $year])
			->andWhere("kgi_team_history.status!=99")
			->orderBy('kgi_team_history.status DESC,kgi_team_history.updateDateTime DESC')
			->asArray()
			->all();
		if (!isset($kgiTeamHistory) || count($kgiTeamHistory) == 0) {
			$kgiTeamHistory = KgiTeam::find()
				->where(["kgiId" => $kgiId, "month" => $month, "year" => $year])
				->andWhere("status!=99")
				->asArray()
				->all();
		}
		$team = [];
		if (isset($kgiTeamHistory) || count($kgiTeamHistory) == 0) {
			foreach ($kgiTeamHistory as $kgh):
				if (!isset($team[$kgh["teamId"]])) {
					$team[$kgh["teamId"]] = [
						"target" => $kgh["target"],
						"teamId" => $kgh["teamId"]
					];
				}
			endforeach;
		}
		return json_encode($team);
		//return json_encode($kgiTeams);
	}
	public function actionKgiTeamSummarize($kgiId)
	{
		$kgiTeams = KgiTeam::find()
			->select('kgi_team.teamId,t.teamName,t.departmentId,kgi_team.target,kgi_team.result,kgi_team.updateDateTime')
			->JOIN("LEFT JOIN", "team t", "t.teamId=kgi_team.teamId")
			->where(["kgi_team.status" => [1, 2, 4], "t.status" => [1, 2, 4], "kgi_team.kgiId" => $kgiId])
			->orderBy('t.teamName')
			->asArray()
			->all();
		$data = [];
		if (isset($kgiTeams) && count($kgiTeams) > 0) {
			foreach ($kgiTeams as $kt):
				$target = ModelMaster::pimNumberFormat($kt["target"]);
				$result = ModelMaster::pimNumberFormat($kt["result"]);
				$data[$kt["teamId"]] = [
					"teamName" => $kt["teamName"],
					"totalEmployee" => KgiEmployee::totolEmployeeInTeam($kgiId, $kt["teamId"]),
					"departmentName" => Department::departmentName($kt["departmentId"]),
					"target" => $target,
					"result" => $result,
					"updateDateTime" => ModelMaster::monthDateYearTime($kt["updateDateTime"]),
				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionKgiTeam2($kgiId)
	{
		$kgiTeams = KgiTeam::find()
			->select('kgi_team.teamId,t.teamName,kgi_team.target,kgi_team.remark,kgi_team.result,kgi_team.kgiTeamId,kgi_team.kgiId,k.code,t.departmentId,
			kgi_team.month,kgi_team.year,kgi_team.nextCheckDate,kgi_team.status,kgi_team.fromDate,kgi_team.toDate')
			->JOIN("LEFT JOIN", "team t", "t.teamId=kgi_team.teamId")
			->JOIN("LEFT JOIN", "kgi k", "k.kgiId=kgi_team.kgiId")
			->where(["kgi_team.status" => [1, 2, 4]])
			->andWhere(["kgi_team.kgiId" => $kgiId])
			->orderBy('t.teamName')
			->asArray()
			->all();
		$data = [];
		if (isset($kgiTeams) && count($kgiTeams) > 0) {
			foreach ($kgiTeams as $kgiTeam) :
				// $kgiTeamHistory = KgiTeamHistory::find()
				// 	->where(["kgiTeamId" => $kgiTeam["kgiTeamId"]])
				// 	->asArray()
				// 	->orderBy('createDateTime DESC')
				// 	->one();
				// if (!isset($kgiTeamHistory) || empty($kgiTeamHistory)) {
				// 	$kgiTeamHistory = KgiTeam::find()
				// 		->where(["kgiTeamId" => $kgiTeam["kgiTeamId"]])
				// 		->asArray()
				// 		->orderBy('createDateTime DESC')
				// 		->one();
				// }
				$ratio = 0;
				if ($kgiTeam["target"] != '' && $kgiTeam["target"] != 0 && $kgiTeam["target"] != null) {
					if ($kgiTeam["code"] == '<' || $kgiTeam["code"] == '=') {
						$ratio = ($kgiTeam["result"] / $kgiTeam["target"]) * 100;
					} else {
						if ($kgiTeam["result"] != '' && $kgiTeam["result"] != 0) {
							$ratio = ($kgiTeam["target"] / $kgiTeam["result"]) * 100;
						} else {
							$ratio = 0;
						}
					}
				} else {
					$ratio = 0;
				}
				$teamEmployee = KgiEmployee::countKgiFromTeam($kgiTeam["kgiId"], $kgiTeam["teamId"], $kgiTeam["month"], $kgiTeam["year"]);
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
				$data[$kgiTeam["kgiTeamId"]] = [
					"teamId" => $kgiTeam["teamId"],
					"teamName" => Team::teamName($kgiTeam["teamId"]),
					"departmentName" => Department::departmentName($kgiTeam["departmentId"]),
					"target" => $kgiTeam["target"],
					"result" => $kgiTeam["result"],
					"month" =>  ModelMaster::monthEng($kgiTeam['month'], 1),
					"year" => $kgiTeam['year'],
					"fromDate" => ModelMaster::engDate($kgiTeam["fromDate"], 2),
					"toDate" => ModelMaster::engDate($kgiTeam["toDate"], 2),
					"periodCheck" => ModelMaster::engDate(KgiTeam::lastestCheckDate($kgiTeam["kgiTeamId"]), 2), //lastest check date
					"nextCheckDate" =>  ModelMaster::engDate($kgiTeam["nextCheckDate"], 2),
					"ratio" => number_format($ratio, 2),
					"status" => $kgiTeam["status"],
					"countTeam" => KgiTeam::kgiTeam($kgiTeam["kgiId"], $kgiTeam["month"], $kgiTeam["year"]),
					"countTeamEmployee" => $countTeamEmployee,
					"kgiEmployeeSelect" => $selectPic,
				];
			endforeach;
		}

		return json_encode($data);
	}
	public function actionKgiTeamHistory($kgiId, $teamId)
	{
		$kgiTeamHistory = KgiTeamHistory::find()
			->select('kgi_team_history.*,e.employeeFirstname,e.employeeSurename,kt.remark,kt.updateDateTime')
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
	public function actionAllTeamKgi($userId, $role, $currentPage, $limit)
	{
		$data = [];
		$data1 = [];
		$data2 = [];
		$data3 = [];
		$data4 = [];
		$total = 0;
		$employeeId = Employee::employeeId($userId);
		$employee = Employee::EmployeeDetail($employeeId);
		$teamId = $employee["teamId"];
		$startAt = (($currentPage - 1) * $limit);
		if ($role <= 3) {
			$kgiTeams = KgiTeam::find()
				->select('k.kgiName,k.kgiId,k.unitId,k.quantRatio,k.priority,k.amountType,k.code,kgi_team.kgiTeamId,k.companyId,kgi_team.month,kgi_team.year,
			kgi_team.teamId,kgi_team.target,kgi_team.result,kgi_team.updateDateTime,kgi_team.fromDate,kgi_team.toDate,kgi_team.nextCheckDate,kgi_team.status')
				->JOIN("LEFT JOIN", "kgi k", "k.kgiId=kgi_team.kgiId")
				->JOIN("LEFT JOIN", "company c", "c.companyId=k.companyId")
				->JOIN("LEFT JOIN", "team t", "t.teamId=kgi_team.teamId")
				->where(["kgi_team.status" => [1, 2, 4], "k.status" => [1, 2, 4]])
				->andWhere("t.teamId is not null and k.companyId is not null")
				->andFilterWhere(["kgi_team.teamId" => $teamId])
				->orderBy("k.createDateTime DESC,t.teamName ASC")
				->asArray()
				->all();
		} else {
			$kgiTeams = KgiTeam::find()
				->select('k.kgiName,k.kgiId,k.unitId,k.quantRatio,k.priority,k.amountType,k.code,kgi_team.kgiTeamId,k.companyId,kgi_team.month,kgi_team.year,
			kgi_team.teamId,kgi_team.target,kgi_team.result,kgi_team.updateDateTime,kgi_team.fromDate,kgi_team.toDate,kgi_team.nextCheckDate,kgi_team.status')
				->JOIN("LEFT JOIN", "kgi k", "k.kgiId=kgi_team.kgiId")
				->JOIN("LEFT JOIN", "company c", "c.companyId=k.companyId")
				->JOIN("LEFT JOIN", "team t", "t.teamId=kgi_team.teamId")
				->where(["kgi_team.status" => [1, 2, 4], "k.status" => [1, 2, 4]])
				->andWhere("t.teamId is not null and k.companyId is not null")
				->orderBy("k.createDateTime DESC,t.teamName ASC")
				->asArray()
				->all();
		}
		if (isset($kgiTeams) && count($kgiTeams) > 0) {
			$i = 0;
			$count = 1;
			foreach ($kgiTeams as $kgiTeam) :
				$commonData = [];
				$ratio = 0;
				if ($kgiTeam["target"] != '' && $kgiTeam["target"] != 0 && $kgiTeam["target"] != null) {
					if ($kgiTeam["code"] == '<' || $kgiTeam["code"] == '=') {
						$ratio = ($kgiTeam["result"] / $kgiTeam["target"]) * 100;
					} else {
						if ($kgiTeam["result"] != '' && $kgiTeam["result"] != 0) {
							$ratio = ($kgiTeam["target"] / $kgiTeam["result"]) * 100;
						} else {
							$ratio = 0;
						}
					}
				}
				$teamEmployee = KgiEmployee::countKgiFromTeam($kgiTeam["kgiId"], $kgiTeam["teamId"], $kgiTeam["month"], $kgiTeam["year"]);
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

				$isOver = ModelMaster::isOverDuedate($kgiTeam['nextCheckDate']);
				$kgiTeamId = $kgiTeam["kgiTeamId"];
				$commonData = [
					"kgiName" => $kgiTeam["kgiName"],
					"kgiId" => $kgiTeam["kgiId"],
					"teamId" => $kgiTeam["teamId"],
					"companyName" => Company::companyName($kgiTeam["companyId"]),
					"companyId" => $kgiTeam["companyId"],
					"branch" => KgiBranch::kgiBranch($kgiTeam["kgiId"]),
					"priority" => $kgiTeam["priority"],
					"unit" => Unit::unitName($kgiTeam["unitId"]),
					"teamName" => Team::teamName($kgiTeam["teamId"]),
					"quantRatio" => $kgiTeam["quantRatio"],
					"target" => $kgiTeam["target"],
					"result" => $kgiTeam["result"],
					"code" => $kgiTeam["code"],
					"month" =>  ModelMaster::monthEng($kgiTeam['month'], 1),
					"year" => $kgiTeam['year'],
					"fromDate" => $kgiTeam["fromDate"] == '' ? '' : ModelMaster::engDate($kgiTeam["fromDate"], 2),
					"toDate" => $kgiTeam["toDate"] == '' ? '' : ModelMaster::engDate($kgiTeam["toDate"], 2),
					"periodCheck" => ModelMaster::engDate(KgiTeam::lastestCheckDate($kgiTeam["kgiTeamId"]), 2), //lastest check date
					"nextCheckDate" =>  ModelMaster::engDate($kgiTeam["nextCheckDate"], 2),
					"status" => $kgiTeam["status"],
					// "kgiTeamHistoryId" => $kgiTeamHistory["kgiTeamHistoryId"] ?? 0,
					"kgiTeamHistoryId" => 0,
					"flag" => Country::countryFlagBycompany($kgiTeam["companyId"]),
					"countryName" => Country::countryNameBycompany($kgiTeam['companyId']),
					// "kgiEmployee" =>  KgiEmployee::kgiEmployee($kgiTeamHistory["kgiId"],$kgiTeamHistory["month"],$kgiTeamHistory["year"]),
					"ratio" => number_format($ratio, 2),
					"isOver" => $isOver,
					"employee" => KgiTeam::kgiTeamEmployee($kgiTeam['kgiId'], $teamId),
					"countTeam" => KgiTeam::kgiTeam($kgiTeam["kgiId"], $kgiTeam["month"], $kgiTeam["year"]),
					"amountType" => $kgiTeam["amountType"],
					"issue" => KgiIssue::lastestIssue($kgiTeam["kgiId"])["issue"],
					"solution" => KgiIssue::lastestIssue($kgiTeam["kgiId"])["solution"],
					"countTeamEmployee" => $countTeamEmployee,
					"kgiEmployeeSelect" => $selectPic,
					"lastestUpdate" => ModelMaster::engDate($kgiTeam["updateDateTime"], 2),
				];
				if (!empty($commonData)) {
					if (($kgiTeam["fromDate"] == "" || $kgiTeam["toDate"] == "") && $isOver == 2) {
						$data1[$kgiTeamId] = $commonData;
					} elseif ($isOver == 1 && $kgiTeam["status"] == 1) {
						$data2[$kgiTeamId] = $commonData;
					} elseif ($kgiTeam["status"] == 2) {
						$data4[$kgiTeamId] = $commonData;
					} else {
						$data3[$kgiTeamId] = $commonData;
					}
					$count++;
					$i++;
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
	public function actionKgiTeamDetail($kgiTeamId, $kgiTeamHistoryId)
	{
		$data = [];
		$ratio = 0;
		if ($kgiTeamHistoryId != 0) {
			$kgiTeamHistory = KgiTeamHistory::find()
				->select('k.kgiName,k.kgiId,k.unitId,k.quantRatio,k.priority,k.companyId,k.code,kt.target,kt.kgiTeamId,
		kt.teamId,kgi_team_history.result,kgi_team_history.fromDate,kgi_team_history.toDate,kgi_team_history.month,kgi_team_history.kgiTeamHistoryId,
		kgi_team_history.status,kgi_team_history.nextCheckDate,k.kgiDetail,kgi_team_history.year,k.amountType,kt.remark')
				->JOIN("LEFT JOIN", "kgi_team kt", "kt.kgiTeamId=kgi_team_history.kgiTeamId")
				->JOIN("LEFT JOIN", "kgi k", "k.kgiId=kt.kgiId")
				->where(["kgi_team_history.kgiTeamHistoryId" => $kgiTeamHistoryId, "kgi_team_history.status" => [1, 2]])
				->asArray()
				->one();
		} else {
			$kgiTeamHistory = KgiTeamHistory::find()
				->select('k.kgiName,k.kgiId,k.unitId,k.quantRatio,k.priority,k.companyId,k.code,kt.target,kt.kgiTeamId,
		kt.teamId,kgi_team_history.result,kgi_team_history.fromDate,kgi_team_history.toDate,kgi_team_history.month,kgi_team_history.kgiTeamHistoryId,
		kgi_team_history.status,kgi_team_history.nextCheckDate,k.kgiDetail,kgi_team_history.year,k.amountType,kt.remark')
				->JOIN("LEFT JOIN", "kgi_team kt", "kt.kgiTeamId=kgi_team_history.kgiTeamId")
				->JOIN("LEFT JOIN", "kgi k", "k.kgiId=kt.kgiId")
				->where(["kgi_team_history.kgiTeamId" => $kgiTeamId, "kgi_team_history.status" => [1, 2]])
				->asArray()
				->orderBy('kgi_team_history.year DESC, kgi_team_history.month DESC,kgi_team_history.createDateTime DESC')
				->one();
		}

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
				"kgiTeamHistoryId" =>  !empty($kgiTeamHistory["kgiTeamHistoryId"]) ? $kgiTeamHistory["kgiTeamHistoryId"] : 0,
				"kgiName" => $kgiTeamHistory["kgiName"],
				"kgiId" => $kgiTeamHistory["kgiId"],
				"priority" => $kgiTeamHistory["priority"],
				"unit" => Unit::unitName($kgiTeamHistory["unitId"]),
				"unitId" => $kgiTeamHistory["unitId"],
				"teamName" => Team::teamName($kgiTeamHistory["teamId"]),
				"quantRatio" => $kgiTeamHistory["quantRatio"] == 1 ? 'Quantity' : 'Quality',
				"amountType" => $kgiTeamHistory["amountType"] == 1 ? '%' : 'Number',
				"target" => $kgiTeamHistory["target"] != null ? $kgiTeamHistory["target"] : null,
				"result" => $kgiTeamHistory["result"],
				"codeText" => $kgiTeamHistory["code"] . ' &nbsp;(' . Kgi::codeDetail($kgiTeamHistory["code"]) . ')',
				"code" => $kgiTeamHistory["code"],
				"month" =>  $kgiTeamHistory['month'],
				"monthName" =>  ModelMaster::monthEng($kgiTeamHistory['month']),
				"year" => $kgiTeamHistory['year'],
				"fromDate" => $kgiTeamHistory["fromDate"],
				"toDate" => $kgiTeamHistory["toDate"],
				"nextCheckDate" =>  $kgiTeamHistory["nextCheckDate"],
				"nextCheckText" => ModelMaster::engDate($kgiTeamHistory["nextCheckDate"], 2),
				"status" => $kgiTeamHistory["status"],
				"kgiEmployee" => KgiEmployee::kgiEmployee($kgiTeamHistory["kgiId"], $kgiTeamHistory["month"], $kgiTeamHistory["year"]),
				"ratio" => number_format($ratio, 2),
				"kgiDetail" => $kgiTeamHistory["kgiDetail"],
				"remark" => $kgiTeamHistory["remark"],
				"isOver" => ModelMaster::isOverDuedate(KgiTeamHistory::nextCheckDate($kgiTeamHistory["kgiTeamHistoryId"])),
				//"detail" => $kgiTeamHistory['kgiDetail'],

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
			->orderBy('kgi_team_history.year DESC,kgi_team_history.month DESC,kgi_team_history.createDateTime DESC')
			->asArray()
			->all();
		return json_encode($kgiTeamHistory);
	}
	public function actionKgiTeamFilter($companyId, $branchId, $teamId, $month, $status, $year, $currentPage, $limit)
	{
		$data = [];
		$data1 = [];
		$data2 = [];
		$data3 = [];
		$data4 = [];
		$searchStatus = '';
		if ($status == 1 || $status == 3 || $status == 4) {
			$searchStatus = 1;
		}
		if ($status == 2) {
			$searchStatus = 2;
		}
		$total = 0;
		$startAt = (($currentPage - 1) * $limit);
		$kgiTeams = KgiTeam::find()
			->select('k.kgiName,k.kgiId,k.unitId,k.quantRatio,k.priority,k.amountType,k.code,kgi_team.kgiTeamId,k.companyId,kgi_team.updateDateTime,kgi_team.month,kgi_team.year,
			kgi_team.teamId,kgi_team.target,kgi_team.status,kgi_team.fromDate,kgi_team.toDate,kgi_team.nextCheckDate')
			->JOIN("LEFT JOIN", "kgi k", "k.kgiId=kgi_team.kgiId")
			->JOIN("LEFT JOIN", "company c", "c.companyId=k.companyId")
			->JOIN("LEFT JOIN", "kgi_branch kb", "kb.kgiId=k.kgiId")
			->JOIN("LEFT JOIN", "team t", "t.teamId=kgi_team.teamId")
			->where("kgi_team.status!=99 and k.status!=99")
			->andWhere("t.teamId is not null and k.companyId is not null")
			->andFilterWhere([
				"k.companyId" => $companyId,
				"kb.branchId" => $branchId,
				"kgi_team.teamId" => $teamId
			])
			->orderBy("k.createDateTime DESC,t.teamName ASC")
			->asArray()
			->all();
		if (isset($kgiTeams) && count($kgiTeams) > 0) {
			foreach ($kgiTeams as $kgiTeam) :
				$commonData = [];
				$show = 0;
				$kgiTeamHistory = KgiTeamHistory::find()
					->select('kgi_team_history.*')
					->JOIN("LEFT JOIN", "kgi_team kt", "kt.kgiTeamId=kgi_team_history.kgiTeamId")
					->where([
						"kgi_team_history.kgiTeamId" => $kgiTeam["kgiTeamId"],
						"kgi_team_history.status" => [1, 2]
					])
					->andFilterWhere([
						"kgi_team_history.month" => $month,
						"kgi_team_history.year" => $year,
						"kgi_team_history.status" => $searchStatus,
					])
					->orderBy('kgi_team_history.year DESC,kgi_team_history.month DESC,kgi_team_history.status DESC,kgi_team_history.createDateTime DESC')
					->asArray()
					->one();
				$ratio = 0;
				$checkComplete = 0;
				if ($status == 1) {
					$checkComplete = KgiTeam::checkComplete($kgiTeam["kgiTeamId"], $month, $year, $kgiTeam["year"]);
				}
				if (isset($kgiTeamHistory) && !empty($kgiTeamHistory)  && $checkComplete == 0) {
					if ($kgiTeamHistory["target"] != '' && $kgiTeamHistory["target"] != 0 && $kgiTeamHistory["target"] != null) {
						if ($kgiTeam["code"] == '<' || $kgiTeam["code"] == '=') {
							$ratio = ($kgiTeamHistory["result"] / $kgiTeamHistory["target"]) * 100;
						} else {
							if ($kgiTeamHistory["result"] != '' && $kgiTeamHistory["result"] != 0) {
								$ratio = ($kgiTeamHistory["target"] / $kgiTeamHistory["result"]) * 100;
							} else {
								$ratio = 0;
							}
						}
					}
					$teamEmployee = KgiEmployee::countKgiFromTeam($kgiTeam["kgiId"], $kgiTeam["teamId"], $kgiTeamHistory["month"], $kgiTeamHistory["year"]);
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
					if ($kgiTeam["status"] == 2) {
						$isOver = 0;
					} else {
						if ($kgiTeam["status"] == 1 && $kgiTeam["year"] > $year && $year != '') {
							$isOver = 0;
						} else {
							$isOver = ModelMaster::isOverDuedate($kgiTeamHistory["nextCheckDate"]);
						}
					}
					$kgiTeamId = $kgiTeam["kgiTeamId"];
					if ($status == 1 && $isOver == 0 && $kgiTeam["status"] == 1) {
						$show = 1;
					} else if ($status == 3 && $isOver == 1) {
						$show = 1;
					} else if ($status == 4 && $isOver == 2) {
						$show = 1;
					} else if ($status == 2 && $kgiTeamHistory["status"] == 2) {
						$show = 1;
					} elseif ($status == '') {
						$show = 1;
					}
					if ($show == 1) {
						$commonData = [
							"kgiName" => $kgiTeam["kgiName"],
							"kgiId" => $kgiTeam["kgiId"],
							"teamId" => $kgiTeam["teamId"],
							"companyName" => Company::companyName($kgiTeam["companyId"]),
							"companyId" => $kgiTeam["companyId"],
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
							"kgiTeamHistoryId" => $kgiTeamHistory["kgiTeamHistoryId"] ?? 0,
							"flag" => Country::countryFlagBycompany($kgiTeam["companyId"]),
							"countryName" => Country::countryNameBycompany($kgiTeam['companyId']),
							"kgiEmployee" => KgiEmployee::kgiEmployee($kgiTeam["kgiId"], $kgiTeamHistory["month"], $kgiTeamHistory["year"]),
							"ratio" => number_format($ratio, 2),
							"isOver" => $isOver,
							"employee" => KgiTeam::kgiTeamEmployee($kgiTeam['kgiId'], $kgiTeam["teamId"]),
							"amountType" => $kgiTeam["amountType"],
							"issue" => KgiIssue::lastestIssue($kgiTeam["kgiId"])["issue"],
							"countTeam" => KgiTeam::kgiTeam($kgiTeam["kgiId"], $kgiTeamHistory["month"], $kgiTeamHistory["year"]),
							"solution" => KgiIssue::lastestIssue($kgiTeam["kgiId"])["solution"],
							"countTeamEmployee" => $countTeamEmployee,
							"kgiEmployeeSelect" => $selectPic,
							"lastestUpdate" => ModelMaster::engDate($kgiTeamHistory["updateDateTime"], 2),
						];
					}
					if (!empty($commonData)) {
						if (($kgiTeamHistory["fromDate"] == "" || $kgiTeamHistory["toDate"] == "") && $isOver == 2) {
							$data1[$kgiTeamId] = $commonData;
						} elseif ($isOver == 1 && $kgiTeamHistory["status"] == 1) {
							$data2[$kgiTeamId] = $commonData;
						} elseif ($kgiTeamHistory["status"] == 2) {
							$data4[$kgiTeamId] = $commonData;
						} else {
							$data3[$kgiTeamId] = $commonData;
						}
						$total++;
					}
				}
			endforeach;
		}
		$data = $data1 + $data2 + $data3 + $data4;
		$data = array_slice($data, $startAt, $limit, true);
		$result["data"] = $data;
		$result["total"] = $total;
		return json_encode($result);
	}
	public function actionEachTeamEmployeeKgi($teamId, $kgiId)
	{
		$employees = Employee::find()
			->select('employeeId,employeeFirstname,employeeSurename,picture,gender')
			->where(["teamId" => $teamId, "status" => 1])
			->asArray()
			->orderBy('employeeFirstname')
			->all();
		$totalTarget = 0.00;
		$isMore = 1;
		$kgiTeam = KgiTeam::find()->select('target')->where(["kgiId" => $kgiId, "teamId" => $teamId])->asArray()->one();
		if (isset($kgiTeam) && !empty($kgiTeam)) {
			$teamTarget = $kgiTeam['target'];
		} else {
			$teamTarget = 0.00;
		}
		$data = [];
		if (isset($employees) && count($employees) > 0) {
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
				$employeeTarget = "";
				$kgiEmployee = KgiEmployee::find()
					->select('employeeId,target')
					->where(["kgiId" => $kgiId, "employeeId" => $employee["employeeId"]])
					->asArray()
					->orderBy('createDateTime DESC')
					->one();
				$checked = 0;
				if (isset($kgiEmployee) && count($kgiEmployee) > 0) {
					$employeeTarget = $kgiEmployee["target"];
					$totalTarget += $employeeTarget;
					$checked = "checked";
				} else {
					$employeeTarget = "";
					$checked = "";
				}
				$data["employee"][$employee["employeeId"]] = [
					"employeeFirstname" => $employee["employeeFirstname"],
					"employeeSurename" => $employee["employeeSurename"],
					"target" => $employeeTarget,
					"picture" => $img,
					"checked" => $checked
				];
			endforeach;

			$data["totalTarget"] = $totalTarget;

			if ($totalTarget > $teamTarget) {
				if ($teamTarget > 0) {
					$percentage = (($totalTarget / $teamTarget) * 100) - 100;
				} else {
					$percentage = 0;
				}
				$isMore = 1;
			} else {
				if ($teamTarget > 0) {
					$percentage = 100 - (($totalTarget / $teamTarget) * 100);
				} else {
					$percentage = 0;
				}
				$isMore = 0;
				if ($totalTarget == $teamTarget) {
					$percentage = 0;
					$isMore = "-";
				}
			}
			$data["percentage"] = $percentage;
			$data["isMore"] = $isMore;
		}

		return json_encode($data);
	}
	public function actionKgiTeamEmployee($kgiId, $month, $year)
	{
		// $kgiTeams = KgiTeam::find()
		// 	->select('kgi_team.kgiId,kgi_team.teamId,t.teamName,kgi_team.target,d.departmentName')
		// 	->JOIN("LEFT JOIN", "team t", "t.teamId=kgi_team.teamId")
		// 	->JOIN("LEFT JOIN", "department d", "d.departmentId=t.departmentId")
		// 	->where(["kgi_team.kgiId" => $kgiId, "t.status" => 1])
		// 	->andWhere("kgi_team.status != 99")
		// 	->asArray()
		// 	->all();

		$kgiTeams = KgiTeamHistory::find()
			->select('kt.kgiId,kt.teamId,t.teamName,kgi_team_history.target,d.departmentName,kgi_team_history.month,kgi_team_history.year')
			->JOIN("LEFT JOIN", "kgi_team kt", "kt.kgiTeamId=kgi_team_history.kgiTeamId")
			->JOIN("LEFT JOIN", "team t", "t.teamId=kt.teamId")
			->JOIN("LEFT JOIN", "department d", "d.departmentId=t.departmentId")
			->where(["kt.kgiId" => $kgiId, "kgi_team_history.month" => $month, "kgi_team_history.year" => $year])
			->andWhere("kgi_team_history.status != 99")
			->orderBy('kgi_team_history.status DESC,kgi_team_history.kgiTeamHistoryId DESC')
			->asArray()
			->all();
		if (!isset($kgiTeams) || count($kgiTeams) == 0) {
			$kgiTeams = KgiTeam::find()
				->select('kgi_team.kgiId,kgi_team.teamId,t.teamName,kgi_team.target,d.departmentName,kgi_team.month,kgi_team.year')
				->JOIN("LEFT JOIN", "team t", "t.teamId=kgi_team.teamId")
				->JOIN("LEFT JOIN", "department d", "d.departmentId=t.departmentId")
				->where(["kgi_team.kgiId" => $kgiId, "kgi_team.month" => $month, "kgi_team.year" => $year])
				->andWhere("kgi_team.status != 99")
				//->orderBy('kgi_team_history.status DESC,kgi_team_history.kgiTeamHistoryId DESC')
				->asArray()
				->all();
		}
		//throw new exception(print_r($kgiTeams, true));
		$data = [];
		$team = [];
		$totalEmployee = 0;
		$totalTargetAll = 0;

		if (isset($kgiTeams) && count($kgiTeams) > 0) {
			foreach ($kgiTeams as $kgiTeam):
				if (!isset($team[$kgiTeam["teamId"]])) {
					$team[$kgiTeam["teamId"]] = true;
					$employees = Employee::find()
						->where(["status" => 1, "teamId" => $kgiTeam["teamId"]])
						->asArray()
						->orderBy('employeeFirstname')
						->all();
					$totalTeamTarget = 0;
					$teamTarget = $kgiTeam['target'];

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
						$kgiEmployee = KgiEmployee::find()
							->where(["employeeId" => $employee["employeeId"], "kgiId" => $kgiId, "month" => $month, "year" => $year])
							->andWhere("status != 99")
							->asArray()
							->orderBy('createDateTime DESC')
							->one();

						if (isset($kgiEmployee) && !empty($kgiEmployee)) {
							if (isset($kgiEmployee) && count($kgiEmployee) > 0) {
								$employeeTarget = $kgiEmployee["target"];
								$totalTeamTarget += $employeeTarget;
								$checked = "checked";
								$totalEmployee++;
							} else {
								$employeeTarget = "";
								$checked = "";
							}
							$data[$kgiTeam["teamId"]]["employee"][$employee["employeeId"]] = [
								"employeeFirstname" => $employee["employeeFirstname"],
								"employeeSurename" => $employee["employeeSurename"],
								"target" => $employeeTarget,
								"picture" => $img,
								"checked" => "checked"
							];
						} else {
							$data[$kgiTeam["teamId"]]["employee"][$employee["employeeId"]] = [
								"employeeFirstname" => $employee["employeeFirstname"],
								"employeeSurename" => $employee["employeeSurename"],
								"target" => "",
								"picture" => $img,
								"checked" => ""
							];
						}
					endforeach;
					$data[$kgiTeam["teamId"]]["team"] = [
						"totalTeamTarget" => $totalTeamTarget
					];
					if ($totalTeamTarget > $teamTarget) {
						if ($teamTarget > 0) {
							$percentage = (($totalTeamTarget / $teamTarget) * 100) - 100;
						} else {
							$percentage = 0;
						}
						$isMore = 1;
					} else {
						if ($teamTarget > 0) {
							$percentage = 100 - (($totalTeamTarget / $teamTarget) * 100);
						} else {
							$percentage = 0;
						}
						$isMore = 0;
						if ($totalTeamTarget == $teamTarget) {
							$percentage = 0;
							$isMore = "-";
						}
					}
					$data[$kgiTeam["teamId"]]["team"]["percentage"] = $percentage;
					$data[$kgiTeam["teamId"]]["team"]["isMore"] = $isMore;
					$data[$kgiTeam["teamId"]]["team"]["teamName"] = $kgiTeam["teamName"];
					$data[$kgiTeam["teamId"]]["team"]["departmentName"] = $kgiTeam["departmentName"];
					$totalTargetAll += $totalTeamTarget;
				}
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
	public function actionKgiEachTeamEmployee($kgiTeamId)
	{
		$kgiTeam = KgiTeam::find()->where(["kgiTeamId" => $kgiTeamId])->asArray()->one();
		$month = $kgiTeam["month"];
		$year = $kgiTeam["year"];
		$kgiId = $kgiTeam["kgiId"];
		$kgiEmployee = KgiEmployee::find()
			->select('e.picture,e.employeeId,e.gender,t.titleName,e.employeeFirstname,e.employeeSurename')
			->JOIN("LEFT JOIN", "employee e", "e.employeeId=kgi_employee.employeeId")
			->JOIN("LEFT JOIN", "title t", "t.titleId=e.titleId")
			->where([
				"kgi_employee.status" => [1, 2, 4],
				"kgi_employee.kgiId" => $kgiId,
				"e.status" => 1,
				"e.teamId" => $kgiTeam["teamId"],
				"kgi_employee.month" => $month,
				"kgi_employee.year" => $year
			])
			->andWhere("kgi_employee.employeeId is not null")
			->asArray()
			->all();
		$employee = [];
		if (isset($kgiEmployee) && count($kgiEmployee) > 0) {
			foreach ($kgiEmployee as $ke) :
				if ($ke["picture"] != "") {
					$employee[$ke["employeeId"]]["picture"] = $ke["picture"];
				} else {
					$employee[$ke["employeeId"]]["picture"] = 'images/icons/Settings/personblack.svg';
				}
				$employee[$ke["employeeId"]]["name"] = $ke["employeeFirstname"] . ' ' . $ke["employeeSurename"];
				$employee[$ke["employeeId"]]["title"] = $ke["titleName"];
			endforeach;
		}
		$data["kgiEmployeeDetail"] = $employee;
		return json_encode($data);
	}
	public function actionKgiTeamHistorySummarize($kgiTeamId)
	{
		$kgiTeamHistory = KgiTeamHistory::find()
			->select('kgi_team_history.*,k.unitId,k.quantRatio,k.code,k.amountType,k.kgiId')
			->JOIN("LEFT JOIN", "kgi_team kt", "kt.kgiTeamId=kgi_team_history.kgiTeamId")
			->JOIN("LEFT JOIN", "kgi k", "k.kgiId=kt.kgiId")
			->where([
				"kgi_team_history.kgiTeamId" => $kgiTeamId,
				"kgi_team_history.status" => [1, 2, 4]
			])
			->andWhere("kgi_team_history.status!=99")
			->orderBy("kgi_team_history.year DESC,kgi_team_history.month DESC,kgi_team_history.status DESC,kgi_team_history.kgiTeamHistoryId DESC")
			->asArray()
			->all();
		$data = [];
		if (isset($kgiTeamHistory) && count($kgiTeamHistory) > 0) {
			foreach ($kgiTeamHistory as $history):
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
						"kgiTeamHistoryId" => $history["kgiTeamHistoryId"],
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
						"countTeam" => KgiTeam::kgiTeam2($history["kgiId"], $history["month"], $history["year"]),
						"kgiId" => $history["kgiId"]
					];
				}
			endforeach;
		}
		return json_encode($data);
	}
	public function actionWaitForApprove($branchId, $isAdmin)
	{
		if ($isAdmin == 1) {
			$kgiTeam = KgiTeamHistory::find()
				->where(["status" => 88])
				->asArray()
				->all();
		} else {
			$kgiTeam = KgiTeamHistory::find()
				->select('k.kgiName,k.kgiId,MAX(kgi_team_history.kgiTeamHistoryId)')
				->JOIN("LEFT JOIN", "kgi_team kg", "kg.kgiTeamId=kgi_team_history.kgiTeamId")
				->JOIN("LEFT JOIN", "kgi k", "k.kgiId=kg.kgiId")
				->JOIN("LEFT JOIN", "kgi_branch kb", "kb.kgiId=k.kgiId")
				->where(["kgi_team_history.status" => 88, "kb.branchId" => $branchId])
				//->orderBy('kgi_team_history.kgiTeamHistoryId DESC')
				->groupBy('k.kgiId')

				->asArray()
				->all();
		}
		//	throw new exception(print_r($kgiTeam, true));
		$res["totalRequest"] = count($kgiTeam);

		return json_encode($res);
	}
	public function actionKgiTeamHistory2($kgiTeamId, $kgiTeamHistoryId)
	{
		// $kgiHistory = KgiHistory::find()
		// 	->where(["kgiId" => $kgiId, "status" => [1, 2]])
		// 	->orderBy('kgiHistoryId DESC')
		// 	->asArray()
		// 	->all();
		if ($kgiTeamHistoryId == 0) {
			$kgiHistory = KgiTeamHistory::find()
				->where(["kgiTeamId" => $kgiTeamId, "status" => [1, 2, 4]])
				->orderBy('year DESC,month DESC,kgiTeamHistoryId DESC')
				->asArray()
				->all();
		} else {
			$mainHistory = KgiTeamHistory::find()
				->where(["kgiTeamHistoryId" => $kgiTeamHistoryId])
				->asArray()
				->one();
			$year = $mainHistory["year"];
			$kgiHistory = KgiTeamHistory::find()
				->where(["kgiTeamId" => $mainHistory["kgiTeamId"], "status" => [1, 2, 4]])
				->andWhere("year<=$year")
				->orderBy('year DESC,month DESC,kgiTeamHistoryId DESC')
				->asArray()
				->all();
		}
		$data = [];
		if (isset($kgiHistory) && count($kgiHistory) > 0) {
			foreach ($kgiHistory as $history) :
				$time = explode(' ', $history["createDateTime"]);
				$employeeId = Employee::employeeId($history["createrId"]);
				$data[$history["kgiTeamHistoryId"]] = [
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
	public function actionKgiTeamHistoryForChart($kgiTeamHistoryId, $kgiTeamId)
	{
		if ($kgiTeamHistoryId == 0) {
			$kgiHistory = KgiTeamHistory::find()
				->where(["kgiTeamId" => $kgiTeamId, "status" => [1, 2, 4]])
				->orderBy('year ASC,month ASC,kgiTeamHistoryId DESC')
				->asArray()
				->all();
		} else {
			$mainHistory = KgiTeamHistory::find()
				->where(["kgiTeamHistoryId" => $kgiTeamHistoryId])
				->asArray()
				->one();
			$month = $mainHistory["month"];
			$year = $mainHistory["year"];
			$kgiHistory = KgiTeamHistory::find()
				->where(["kgiTeamId" => $kgiTeamId, "status" => [1, 2, 4]])
				->andWhere("year<=$year")
				->orderBy('year ASC,month ASC,kgiTeamHistoryId DESC')
				->asArray()
				->all();
		}
		$data = [];
		if (isset($kgiHistory) && count($kgiHistory) > 0) {
			foreach ($kgiHistory as $history) :
				$time = explode(' ', $history["createDateTime"]);
				$employeeId = Employee::employeeId($history["createrId"]);
				$data[$history["kgiTeamHistoryId"]] = [
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
	public function actionKgiHistoryTeam($kgiId, $month, $year)
	{
		$kgiTeam = KgiTeam::find()
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
		if (isset($kgiTeam) && count($kgiTeam) > 0) {
			foreach ($kgiTeam as $kt):
				$kgiTeamHistory = KgiTeamHistory::find()
					->where([
						"kgiTeamId" => $kt["kgiTeamId"],
						"status" => [1, 2, 4],
						"month" => $month != '' ? $month : 0,
						"year" => $year != '' ? $year : 0,
					])
					->orderBy('createDateTime DESC')
					->asArray()
					->one();
				if (isset($kgiTeamHistory) && !empty($kgiTeamHistory)) {
					$time = explode(' ', $kgiTeamHistory["createDateTime"]);
					$data[$kt["kgiTeamId"]] = [
						"teamName" => Team::teamName($kt["teamId"]),
						"createDate" => ModelMaster::engDateHr($kgiTeamHistory["createDateTime"]),
						"time" => ModelMaster::timeText($time[1] ?? '00:00'),
						"target" => $kgiTeamHistory["target"] ?? '0.00',
						"result" => $kgiTeamHistory["result"] ?? '0.00',
						"createDateTime" => ModelMaster::monthDateYearTime($kgiTeamHistory["createDateTime"]),
						"departmentName" => Department::teamDepartment($kt["teamId"])
					];
				} else {
					$time = explode(' ', $kt["createDateTime"]);
					$data[$kt["kgiTeamId"]] = [
						"teamName" => Team::teamName($kt["teamId"]),
						"createDate" => ModelMaster::engDateHr($kt["createDateTime"]),
						"time" => ModelMaster::timeText($time[1] ?? '00:00'),
						"target" => $kt["target"] ?? '0.00',
						"result" => $kt["result"] ?? '0.00',
						"createDateTime" => ModelMaster::monthDateYearTime($kt["createDateTime"]),
						"departmentName" => Department::teamDepartment($kt["teamId"])
					];
				}
			endforeach;
		}
		return json_encode($data);
	}
}
