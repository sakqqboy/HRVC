<?php

namespace backend\modules\kpi\controllers;

use backend\models\hrvc\Company;
use backend\models\hrvc\Country;
use backend\models\hrvc\Employee;
use backend\models\hrvc\KgiEmployee;
use backend\models\hrvc\KgiEmployeeHistory;
use backend\models\hrvc\KgiHistory;
use backend\models\hrvc\KgiTeam;
use backend\models\hrvc\Kpi;
use backend\models\hrvc\KpiBranch;
use backend\models\hrvc\KpiEmployee;
use backend\models\hrvc\KpiEmployeeHistory;
use backend\models\hrvc\KpiHistory;
use backend\models\hrvc\KpiIssue;
use backend\models\hrvc\KpiTeam;
use backend\models\hrvc\Team;
use backend\models\hrvc\Unit;
use backend\models\hrvc\User;
use common\models\ModelMaster;
use Exception;
use yii\db\Query;
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
	public function actionEmployeeKpi($userId, $role, $currentPage, $limit)
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
			$kpiEmployees = KpiEmployee::find()
				->select('k.kpiName,k.priority,k.quantRatio,k.amountType,k.code,kpi_employee.target,kpi_employee.result,kpi_employee.updateDateTime,kpi_employee.month,kpi_employee.year,
			kpi_employee.status,kpi_employee.employeeId,k.unitId,kpi_employee.month,kpi_employee.year,k.kpiId,k.companyId,e.teamId,e.picture,
			kpi_employee.kpiEmployeeId,e.employeeFirstname,e.employeeSurename,kpi_employee.fromDate,kpi_employee.toDate,kpi_employee.nextCheckDate')
				->JOIN("LEFT JOIN", "kpi k", "kpi_employee.kpiId=k.kpiId")
				->JOIN("LEFT JOIN", "employee e", "e.employeeId=kpi_employee.employeeId")
				->where(["kpi_employee.status" => [1, 2, 4], "k.status" => [1, 2, 4], "kpi_employee.employeeId" => $employeeId])
				->orderby('k.createDateTime')
				->asArray()
				->all();
		} else {
			$kpiEmployees = KpiEmployee::find()
				->select('k.kpiName,k.priority,k.quantRatio,k.amountType,k.code,kpi_employee.target,kpi_employee.result,kpi_employee.updateDateTime,kpi_employee.month,kpi_employee.year,
			kpi_employee.status,kpi_employee.employeeId,k.unitId,kpi_employee.month,kpi_employee.year,k.kpiId,k.companyId,e.teamId,e.picture,
			kpi_employee.kpiEmployeeId,e.employeeFirstname,e.employeeSurename,kpi_employee.fromDate,kpi_employee.toDate,kpi_employee.nextCheckDate')
				->JOIN("LEFT JOIN", "kpi k", "kpi_employee.kpiId=k.kpiId")
				->JOIN("LEFT JOIN", "employee e", "e.employeeId=kpi_employee.employeeId")
				->where(["kpi_employee.status" => [1, 2, 4], "k.status" => [1, 2, 4]])
				->orderby('k.createDateTime')
				->asArray()
				->all();
		}
		if (count($kpiEmployees) > 0) {
			foreach ($kpiEmployees as $kpiEmployee) :
				$commonData = [];
				$ratio = 0;
				if ($kpiEmployee["target"] != '' && $kpiEmployee["target"] != 0) {
					if ($kpiEmployee["code"] == '<' || $kpiEmployee["code"] == '=') {
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
				$teamEmployee = KpiEmployee::countKpiFromTeam($kpiEmployee["kpiEmployeeId"], $kpiEmployee["teamId"], $kpiEmployee["month"], $kpiEmployee["year"]);
				$countTeamEmployee = is_array($teamEmployee) && !empty($teamEmployee) ? count($teamEmployee) : 0;
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
				$picture = Employee::employeeImage($kpiEmployee["employeeId"]);
				$isOver = ModelMaster::isOverDuedate($kpiEmployee['nextCheckDate']);
				$kpiEmployeeId = $kpiEmployee["kpiEmployeeId"];
				$commonData = [
					"kpiId" => $kpiEmployee["kpiId"],
					"teamId" => $kpiEmployee["teamId"],
					"kpiName" => $kpiName,
					"companyId" => $kpiEmployee['companyId'],
					"kpiEmployeeId" => $kpiEmployee["kpiEmployeeId"],
					"employeeName" => $kpiEmployee["employeeFirstname"] . ' ' . $kpiEmployee["employeeSurename"],
					"picture" => $picture,
					"companyName" => Company::companyName($kpiEmployee["companyId"]),
					"branch" => KpiBranch::kpiBranch($kpiEmployee["kpiId"]),
					"employee" => KpiEmployee::kpiEmployee($kpiEmployee["kpiId"], $kpiEmployee["month"], $kpiEmployee["year"]),
					"quantRatio" => $kpiEmployee["quantRatio"],
					"targetAmount" => $kpiEmployee["target"],
					"code" => $kpiEmployee["code"],
					"result" => $kpiEmployee["result"],
					"unit" => Unit::unitName($kpiEmployee["unitId"]),
					"month" => ModelMaster::monthEng($kpiEmployee['month'], 1),
					"year" => $kpiEmployee['year'],
					"priority" => $kpiEmployee["priority"],
					"ratio" => $ratio,
					"periodCheck" => ModelMaster::engDate(KpiEmployee::lastestCheckDate($kpiEmployee["kpiEmployeeId"]), 2),
					"nextCheck" =>  ModelMaster::engDate($kpiEmployee["nextCheckDate"], 2),
					"countTeam" => KpiTeam::kpiTeam($kpiEmployee["kpiId"], $kpiEmployee["month"], $kpiEmployee["year"]),
					"flag" => Country::countryFlagBycompany($kpiEmployee["companyId"]),
					"status" => $kpiEmployee["status"],
					"kpiEmployeeHistoryId" => $kpiEmployeeHistory["kpiEmployeeHistoryId"] ?? 0,
					"countryName" => Country::countryNameBycompany($kpiEmployee['companyId']),
					"issue" => KpiIssue::lastestIssue($kpiEmployee["kpiId"])["issue"],
					"solution" => KpiIssue::lastestIssue($kpiEmployee["kpiId"])["solution"],
					"fromDate" => ModelMaster::engDate($kpiEmployee["fromDate"], 2),
					"toDate" => ModelMaster::engDate($kpiEmployee["toDate"], 2),
					"isOver" => $isOver,
					"amountType" => $kpiEmployee["amountType"],
					"teamName" => Team::teamName($kpiEmployee["teamId"]),
					"canEdit" => 1,
					"teamMate" =>  $selectPic,
					"countTeamEmployee" => $countTeamEmployee,
					"lastestUpdate" => ModelMaster::engDate($kpiEmployee["updateDateTime"], 2)
				];
				if (!empty($commonData)) {
					if (($kpiEmployee["fromDate"] == "" || $kpiEmployee["toDate"] == "") && $isOver == 2) {
						$data1[$kpiEmployeeId] = $commonData;
					} elseif ($isOver == 1 && $kpiEmployee["status"] == 1) {
						$data2[$kpiEmployeeId] = $commonData;
					} elseif ($kpiEmployee["status"] == 2) {
						$data4[$kpiEmployeeId] = $commonData;
					} else {
						$data3[$kpiEmployeeId] = $commonData;
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


	public function actionKpiHistory($kpiId, $kpiEmployeeId, $kpiEmployeeHistoryId)
	{
		if ($kpiEmployeeHistoryId == 0) {
			$kpiEmployeeHistory = KpiEmployeeHistory::find()
				->where(["kpiEmployeeId" => $kpiEmployeeId, "status" => [1, 2, 4]])
				->orderBy('year ASC,month ASC,kpiEmployeeHistoryId DESC')
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
					"title" => $employeehistory["detail"],
					"picture" => Employee::employeeImage($employeehistory),
					"createDate" => ModelMaster::engDateHr($employeehistory["createDateTime"]),
					"time" => ModelMaster::timeText($time[1]),
					"status" => $employeehistory["status"],
					"target" => $employeehistory["target"],
					"result" => $employeehistory["result"],
					"month" => $employeehistory["month"],
					"year" => $employeehistory["year"],
					"creater" => User::employeeNameByuserId($employeehistory["createrId"]),
					"createDateTime" => ModelMaster::monthDateYearTime($employeehistory["createDateTime"])
				];
			endforeach;
		}
		return json_encode($data);
	}



	public function actionKpiHistoryEmployee($kpiId, $month, $year, $kpiEmployeeId)
	{
		$data = [];

		$kpiHistory = (new Query())
			->select([
				'keh.kpiEmployeeHistoryId',
				'keh.kpiEmployeeId',
				'keh.result',
				'keh.target',
				'keh.createDateTime',
				'keh.status AS history_status',
				'keh.createrId',
				'keh.updateDateTime',
				'ke.employeeId',
				'ke.kpiId',
				'ke.month',
				'ke.year',
				'CONCAT(e.employeeFirstname, " ", e.employeeSurename) AS employeeFullname',
				'e.picture',
				't.teamId',
				't.teamName'
			])
			->from('kpi_employee_history keh')
			->innerJoin(
				[
					'latest' => (new Query())
						->select(['kpiEmployeeId', 'MAX(updateDateTime) AS latest_update'])
						->from('kpi_employee_history')
						->groupBy('kpiEmployeeId')
				],
				'keh.kpiEmployeeId = latest.kpiEmployeeId AND keh.updateDateTime = latest.latest_update'
			)
			->innerJoin('kpi_employee ke', 'keh.kpiEmployeeId = ke.kpiEmployeeId')
			->innerJoin('employee e', 'ke.employeeId = e.employeeId')
			->innerJoin('team t', 'e.teamId = t.teamId')
			->innerJoin('kpi_history kh', 'kh.kpiId = ke.kpiId')
			->where(['keh.status' => [1, 2, 3]])
			->andWhere(['ke.status' => [1, 2, 3]])
			->andWhere(['ke.kpiId' => $kpiId])
			->andWhere(['ke.month' => $month])
			->andWhere(['ke.year' => $year])
			->andWhere(['ke.kpiEmployeeId' => $kpiEmployeeId])
			->andWhere(['e.status' => 1])
			->groupBy([
				'keh.kpiEmployeeHistoryId',
				'keh.kpiEmployeeId',
				'keh.result',
				'keh.target',
				'keh.createDateTime',
				'keh.status',
				'keh.createrId',
				'keh.updateDateTime',
				'ke.employeeId',
				'ke.kpiId',
				'ke.month',
				'ke.year',
				'employeeFullname',
				'e.picture',
				't.teamId',
				't.teamName'
			])
			->all();

		$data = [];
		if (isset($kpiHistory) && count($kpiHistory) > 0) {
			foreach ($kpiHistory as $history) :
				$time = explode(' ', $history["createDateTime"]);
				$employeeId = Employee::employeeId($history["createrId"]);
				$data[$history["kpiEmployeeHistoryId"]] = [
					"createrId" => $history["createrId"],
					"result" => $history["result"],
					"creater" => User::employeeNameByuserId($history["createrId"]),
					"teamName" => $history["teamName"],
					"picture" => Employee::employeeImage($employeeId),
					"createDate" => ModelMaster::engDateHr($history["createDateTime"]),
					"time" => ModelMaster::timeText($time[1]),
					"status" => $history["history_status"],
					"target" => $history["target"],
					"createDateTime" => ModelMaster::monthDateYearTime($history["createDateTime"])
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
				->orderBy('year ASC,month ASC,kpiEmployeeHistoryId DESC')
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
	{
		if ($kpiEmployeeHistoryId != 0) {
			$kpiEmployee = KpiEmployeeHistory::find()
				->select('ke.target,kpi_employee_history.result,kpi_employee_history.kpiEmployeeId,ke.employeeId,
			kpi_employee_history.lastCheckDate,kpi_employee_history.nextCheckDate,kpi_employee_history.detail,kpi_employee_history.kpiEmployeeHistoryId,
			kpi_employee_history.status,kpi_employee_history.month,kpi_employee_history.year,ke.remark,kpi_employee_history.fromDate,kpi_employee_history.toDate')
				->JOIN("LEFT JOIN", "kpi_employee ke", "ke.kpiEmployeeId=kpi_employee_history.kpiEmployeeId")
				->where(["kpi_employee_history.kpiEmployeeHistoryId" => $kpiEmployeeHistoryId, "kpi_employee_history.status" => [1, 2]])
				->asArray()
				->one();
		} else {
			$kpiEmployee = kpiEmployeeHistory::find()
				->select('ke.target,kpi_employee_history.result,kpi_employee_history.kpiEmployeeId,ke.employeeId,
			kpi_employee_history.lastCheckDate,kpi_employee_history.nextCheckDate,kpi_employee_history.detail,kpi_employee_history.kpiEmployeeHistoryId,
			kpi_employee_history.status,kpi_employee_history.month,kpi_employee_history.year,ke.remark,kpi_employee_history.fromDate,kpi_employee_history.toDate')
				->JOIN("LEFT JOIN", "kpi_employee ke", "ke.kpiEmployeeId=kpi_employee_history.kpiEmployeeId")
				->where(["kpi_employee_history.kpiEmployeeId" => $kpiEmployeeId, "kpi_employee_history.status" => [1, 2]])
				->orderBy('kpi_employee_history.month DESC,kpi_employee_history.year DESC,kpi_employee_history.createDateTime DESC')
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
			->asArray()
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
			// return json_encode(print_r($employee,true));
			$data = [
				"kpiId" => $kpiId,
				"kpiEmployeeHistoryId" => !empty($kpiEmployee["kpiEmployeeHistoryId"]) ? $kpiEmployee["kpiEmployeeHistoryId"] : 0,
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
				"kpiEmployee" => KpiEmployee::kpiEmployee($kpiId, $kpiEmployee["month"], $kpiEmployee["year"]),
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
	public function actionKpiEachTeamEmployeeHistory($kpiId, $teamId, $month, $year)
	{

		$kpiEmployee = KpiEmployee::find()
			->select('e.employeeFirstname,e.employeeSurename,t.titleName,kpi_employee.kpiEmployeeId,e.picture')
			->JOIN("LEFT JOIN", "employee e", "e.employeeId=kpi_employee.employeeId")
			->JOIN("LEFT JOIN", "title t", "t.titleId=e.titleId")
			->where(["kpi_employee.kpiId" => $kpiId, "e.teamId" => $teamId])
			->orderBy('e.employeeFirstname')
			->asArray()
			->all();
		$data = [];
		if (isset($kpiEmployee) && count($kpiEmployee) > 0) {
			foreach ($kpiEmployee as $ke):
				$kpiEmployeeHistory = KpiEmployeeHistory::find()
					->where(["kpiEmployeeId" => $ke["kpiEmployeeId"], "month" => $month, "year" => $year])
					->orderBy("status DESC,updateDateTime DESC")
					->asArray()
					->one();
				if (isset($kpiEmployeeHistory) && !empty($kpiEmployeeHistory)) {
					$img = "image/user.png";

					if ($ke["picture"] != '') {
						$img = $ke["picture"];
					} else {
						$img = "image/user.png";
					}
					$data[$ke["kpiEmployeeId"]] = [
						"employeeName" => $ke["employeeFirstname"] . ' ' . $ke["employeeSurename"],
						"picture" => $img,
						"title" => $ke["titleName"],
						"target" => ModelMaster::pimNumberFormat($kpiEmployeeHistory["target"]),
						"result" => ModelMaster::pimNumberFormat($kpiEmployeeHistory["result"]),
						"updateDateTime" => ModelMaster::monthDateYearTime($kpiEmployeeHistory["updateDateTime"]),
						"employeeHistory" => KpiEmployeeHistory::allHistory($ke["kpiEmployeeId"], $month, $year)
					];
				}
			endforeach;
		}
		return json_encode($data);
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
	public function actionKpiPersonalFilter($companyId, $branchId, $teamId, $month, $status, $year, $userId, $currentPage, $limit)
	{
		$data = [];
		$data1 = [];
		$data2 = [];
		$data3 = [];
		$data4 = [];
		$searchStatus = '';
		$total = 0;
		if ($status == 1 || $status == 3 || $status == 4) {
			$searchStatus = 1;
		}
		if ($status == 2) {
			$searchStatus = 2;
		}
		$startAt = (($currentPage - 1) * $limit);
		$employeeId = Employee::employeeId2($userId);
		$kpiEmployees = KpiEmployee::find()
			->select('k.kpiName,k.kpiId,k.unitId,k.quantRatio,k.priority,k.amountType,k.code,kpi_employee.kpiEmployeeId,k.companyId,kpi_employee.updateDateTime,kpi_employee.month,kpi_employee.year,
			kpi_employee.employeeId,kpi_employee.target,kpi_employee.month,e.employeeFirstname,e.employeeSurename,e.teamId,e.picture')
			->JOIN("LEFT JOIN", "kpi k", "k.kpiId=kpi_employee.kpiId")
			->JOIN("LEFT JOIN", "kpi_branch kb", "kb.kpiId=k.kpiId")
			->JOIN("LEFT JOIN", "employee e", "e.employeeId=kpi_employee.employeeId")
			->where("kpi_employee.status!=99 and k.status!=99")
			->andWhere(["e.status" => [1]])
			->andFilterWhere([
				"kb.branchId" => $branchId,
				"e.teamId" => $teamId,
				"kpi_employee.employeeId" => $employeeId,
				"k.companyId" => $companyId
			])
			->orderBy("k.createDateTime DESC")
			->asArray()
			->all();
		$data = [];
		if (isset($kpiEmployees) && count($kpiEmployees) > 0) {
			foreach ($kpiEmployees as $kpiEmployee) :
				$commonData = [];
				$show = 0;
				$kpiEmployeeHistory = KpiEmployeeHistory::find()
					->select('kpi_employee_history.*,,ke.employeeId')
					->JOIN("LEFT JOIN", "kpi_employee ke", "ke.kpiEmployeeId=kpi_employee_history.kpiEmployeeId")
					->JOIN("LEFT JOIN", "employee e", "e.employeeId=ke.employeeId")
					->where([
						"kpi_employee_history.kpiEmployeeId" => $kpiEmployee["kpiEmployeeId"],
						"kpi_employee_history.status" => [1, 2],
					])
					->andFilterWhere([
						"kpi_employee_history.month" => $month,
						"kpi_employee_history.year" => $year,
						"kpi_employee_history.status" => $searchStatus,
					])
					->orderBy('kpi_employee_history.year DESC,kpi_employee_history.month DESC,kpi_employee_history.status DESC,kpi_employee_history.createDateTime DESC')
					->asArray()
					->one();
				$ratio = 0;
				$checkComplete = 0;
				if ($status == 1) {
					$checkComplete = KpiEmployee::checkComplete($kpiEmployee["kpiEmployeeId"], $month, $year, $kpiEmployee["year"]);
				}
				if (isset($kpiEmployeeHistory) && !empty($kpiEmployeeHistory)  && $checkComplete == 0) {
					if ($kpiEmployeeHistory["target"] != '' && $kpiEmployeeHistory["target"] != 0 && $kpiEmployeeHistory["target"] != null) {
						if ($kpiEmployee["code"] == '<' || $kpiEmployee["code"] == '=') {
							$ratio = ($kpiEmployeeHistory["result"] / $kpiEmployeeHistory["target"]) * 100;
						} else {
							if ($kpiEmployeeHistory["result"] != '' && $kpiEmployeeHistory["result"] != 0) {
								$ratio = ($kpiEmployeeHistory["target"] / $kpiEmployeeHistory["result"]) * 100;
							} else {
								$ratio = 0;
							}
						}
					}
					$teamEmployee = KpiEmployee::countKpiFromTeam($kpiEmployee["kpiId"], $kpiEmployee["teamId"], $kpiEmployeeHistory["month"], $kpiEmployeeHistory["year"]);
					$countTeamEmployee = is_array($teamEmployee) && !empty($teamEmployee) ? count($teamEmployee) : 0;
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
					$kpiEmployeeId = $kpiEmployeeHistory["kpiEmployeeId"];
					if (strlen($kpiEmployee["kpiName"]) > 34) {
						$kpiName = substr($kpiEmployee["kpiName"], 0, 34) . '. . .';
					} else {
						$kpiName = $kpiEmployee["kpiName"];
					}
					if ($kpiEmployeeHistory["status"] == 2) {
						$isOver = 0;
					} else {
						if ($kpiEmployeeHistory["status"] == 1 && $kpiEmployeeHistory["year"] > $year && $year != '') {
							$isOver = 0;
						} else {
							//$isOver = ModelMaster::isOverDuedate(KpiEmployee::nextCheckDate($kpiEmployeeHistory['kpiEmployeeId']));
							$isOver = ModelMaster::isOverDuedate($kpiEmployeeHistory["nextCheckDate"]);
						}
					}
					if ($status == 1 && $isOver == 0 && $kpiEmployee["status"] == 1) {
						$show = 1;
					} else if ($status == 3 && $isOver == 1) {
						$show = 1;
					} else if ($status == 4 && $isOver == 2) {
						$show = 1;
					} else if ($status == 2 && $kpiEmployeeHistory["status"] == 2) {
						$show = 1;
					} elseif ($status == '') {
						$show = 1;
					}
					if ($show == 1) {
						$commonData = [
							"kpiName" => $kpiName,
							"kpiId" => $kpiEmployee["kpiId"],
							"companyName" => Company::companyName($kpiEmployee["companyId"]),
							"employee" => KpiEmployee::kpiEmployee($kpiEmployee["kpiId"], $kpiEmployeeHistory["month"], $kpiEmployeeHistory["year"]),
							"employeeName" => $kpiEmployee["employeeFirstname"] . ' ' . $kpiEmployee["employeeSurename"],
							"picture" => $picture,
							"branch" => KpiBranch::kpiBranch($kpiEmployee["kpiId"]),
							"priority" => $kpiEmployee["priority"],
							"unit" => Unit::unitName($kpiEmployee["unitId"]),
							"quantRatio" => $kpiEmployee["quantRatio"],
							"targetAmount" => $kpiEmployeeHistory["target"],
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
							"kpiEmployee" => KpiEmployee::kpiEmployee($kpiEmployee["kpiId"], $kpiEmployeeHistory["month"], $kpiEmployeeHistory["year"]),
							"ratio" => number_format($ratio, 2),
							"isOver" => $isOver,
							"amountType" => $kpiEmployee["amountType"],
							"issue" => KpiIssue::lastestIssue($kpiEmployee["kpiId"])["issue"],
							"solution" => KpiIssue::lastestIssue($kpiEmployee["kpiId"])["solution"],
							"countTeam" => KpiTeam::kpiTeam($kpiEmployee["kpiId"], $kpiEmployeeHistory["month"], $kpiEmployeeHistory["year"]),
							"teamName" => Team::teamName($kpiEmployee["teamId"]),
							"teamMate" =>  $selectPic,
							"countTeamEmployee" => $countTeamEmployee,
							"canEdit" => 1,
							"lastestUpdate" => ModelMaster::engDate($kpiEmployeeHistory["updateDateTime"], 2)
						];
					}
					if (!empty($commonData)) {
						if (($kpiEmployeeHistory["fromDate"] == "" || $kpiEmployeeHistory["toDate"] == "") && $isOver == 2) {
							$data1[$kpiEmployeeId] = $commonData;
						} elseif ($isOver == 1 && $kpiEmployeeHistory["status"] == 1) {
							$data2[$kpiEmployeeId] = $commonData;
						} elseif ($kpiEmployeeHistory["status"] == 2) {
							$data4[$kpiEmployeeId] = $commonData;
						} else {
							$data3[$kpiEmployeeId] = $commonData;
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
	public function actionKpiIndividualSummarize($kpiEmployeeId)
	{
		$kpiEmployeeHistory = KpiEmployeeHistory::find()
			->select('kpi_employee_history.*,k.unitId,k.quantRatio,k.code,k.amountType')
			->JOIN("LEFT JOIN", "kpi_employee ke", "ke.kpiEmployeeId=kpi_employee_history.kpiEmployeeId")
			->JOIN("LEFT JOIN", "kpi k", "k.kpiId=ke.kpiId")
			->where([
				"kpi_employee_history.kpiEmployeeId" => $kpiEmployeeId,
				"kpi_employee_history.status" => [1, 2, 4]
			])
			->andWhere("kpi_employee_history.status!=99")
			->orderBy("kpi_employee_history.year DESC,kpi_employee_history.month DESC,kpi_employee_history.status DESC,kpi_employee_history.updateDateTime DESC")
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
				if (!isset($data[$history["year"]][$history["month"]])) {
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
				}
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
	public function actionSetNextCheckDate()
	{
		$kgiEmployees = KgiEmployee::find()
			->where("fromDate is not null and toDate is not null and nextCheckDate is null")
			->andWhere(["status" => [1, 2]])
			->all();
		if (isset($kgiEmployees) && count($kgiEmployees) > 0) {
			foreach ($kgiEmployees as $kgiEmployee):
				$kgiEmployeeHistory = KgiEmployeeHistory::find()
					->where([
						"kgiEmployeeId" => $kgiEmployee->kgiEmployeeId,
						"month" => $kgiEmployee->month,
						"year" => $kgiEmployee->year,
					])
					->orderBy('status DESC,createDateTime DESC')
					->one();
				if (isset($kgiEmployeeHistory) && !empty($kgiEmployeeHistory)) {
					if ($kgiEmployeeHistory->fromDate != '' && $kgiEmployeeHistory->toDate != '' && $kgiEmployeeHistory->nextCheckDate != '') {
						$kgiEmployee->fromDate = $kgiEmployeeHistory->fromDate;
						$kgiEmployee->toDate = $kgiEmployeeHistory->toDate;
						$kgiEmployee->nextCheckDate = $kgiEmployeeHistory->nextCheckDate;
					} else {
						$kgiEmployee->fromDate = null;
						$kgiEmployee->toDate = null;
						$kgiEmployee->nextCheckDate = null;
						$kgiEmployeeHistory->fromDate = null;
						$kgiEmployeeHistory->toDate = null;
						$kgiEmployeeHistory->nextCheckDate = null;
					}
					$kgiEmployee->save(false);
					$kgiEmployeeHistory->save(false);
				}
			endforeach;
		}
		$kpiEmployees = KpiEmployee::find()
			->where("fromDate is not null and toDate is not null and nextCheckDate is null")
			->andWhere(["status" => [1, 2]])
			->all();
		if (isset($kpiEmployees) && count($kpiEmployees) > 0) {
			foreach ($kpiEmployees as $kpiEmployee):
				$kpiEmployeeHistory = KpiEmployeeHistory::find()
					->where([
						"kpiEmployeeId" => $kpiEmployee->kpiEmployeeId,
						"month" => $kpiEmployee->month,
						"year" => $kpiEmployee->year,
					])
					->orderBy('status DESC,createDateTime DESC')
					->one();
				if (isset($kpiEmployeeHistory) && !empty($kpiEmployeeHistory)) {
					if ($kpiEmployeeHistory->fromDate != '' && $kpiEmployeeHistory->toDate != '' && $kpiEmployeeHistory->nextCheckDate != '') {
						$kpiEmployee->fromDate = $kpiEmployeeHistory->fromDate;
						$kpiEmployee->toDate = $kpiEmployeeHistory->toDate;
						$kpiEmployee->nextCheckDate = $kpiEmployeeHistory->nextCheckDate;
					} else {
						$kpiEmployee->fromDate = null;
						$kpiEmployee->toDate = null;
						$kpiEmployee->nextCheckDate = null;
						$kpiEmployeeHistory->fromDate = null;
						$kpiEmployeeHistory->toDate = null;
						$kpiEmployeeHistory->nextCheckDate = null;
					}
					$kpiEmployee->save(false);
					$kpiEmployeeHistory->save(false);
				}
			endforeach;
		}
	}
	public function actionCheckDupplicate()
	{
		$i = 0;
		$data = [];
		$kgiTeams = KgiTeam::find()
			->select(['kgiId', 'teamId'])
			->groupBy(['kgiId', 'teamId'])
			->having(['>', 'COUNT(*)', 1])
			->asArray()
			->all();

		if (isset($kgiTeams) && count($kgiTeams) > 0) {
			foreach ($kgiTeams as $kt):
				$data[$i] = [
					"table" => "kgiTeam",
					"kgiId" => $kt["kgiId"],
					"TeamId" => $kt["teamId"],
				];
				$i++;
			endforeach;
		}
		$kpiTeams = KpiTeam::find()
			->select(['kpiId', 'teamId'])
			->groupBy(['kpiId', 'teamId'])
			->having(['>', 'COUNT(*)', 1])
			->asArray()
			->all();

		if (isset($kpiTeams) && count($kpiTeams) > 0) {
			foreach ($kpiTeams as $kt):
				$data[$i] = [
					"table" => "kpiTeam",
					"kpiId" => $kt["kpiId"],
					"TeamId" => $kt["teamId"],
				];
				$i++;
			endforeach;
		}
		$kgiEmployees = KgiEmployee::find()
			->select(['kgiId', 'employeeId'])
			->groupBy(['kgiId', 'employeeId'])
			->having(['>', 'COUNT(*)', 1])
			->asArray()
			->all();

		if (isset($kgiEmployees) && count($kgiEmployees) > 0) {
			foreach ($kgiEmployees as $kt):
				$data[$i] = [
					"table" => "kgiEmployee",
					"kgiId" => $kt["kgiId"],
					"EmployeeId" => $kt["employeeId"],
				];
				$i++;
			endforeach;
		}
		$kpiEmployees = KpiEmployee::find()
			->select(['kpiId', 'employeeId'])
			->groupBy(['kpiId', 'employeeId'])
			->having(['>', 'COUNT(*)', 1])
			->asArray()
			->all();

		if (isset($kpiEmployees) && count($kpiEmployees) > 0) {
			foreach ($kpiEmployees as $kt):
				$data[$i] = [
					"table" => "kpiEmployee",
					"kpiId" => $kt["kpiId"],
					"EmployeeId" => $kt["employeeId"],
				];
				$i++;
			endforeach;
		}
	}
	public function actionAssignedKpiEmployee($kpiId, $kpiHistoryId)
	{

		if ($kpiHistoryId == 0) {
			$kpi = Kpi::find()->where(["kpiId" => $kpiId])->asArray()->one();
		} else {
			$kpi = KpiHistory::find()->where(["kpiHistoryId" => $kpiHistoryId])
				->asArray()
				->one();
		}
		$kpiEmployee = KpiEmployee::find()
			->select('e.picture,e.employeeId,e.gender,t.titleName,e.employeeFirstname,e.employeeSurename,e.teamId,
			kpi_employee.target,kpi_employee.result,kpi_employee.updateDateTime,team.teamName')
			->JOIN("LEFT JOIN", "employee e", "e.employeeId=kpi_employee.employeeId")
			->JOIN("LEFT JOIN", "title t", "t.titleId=e.titleId")
			->JOIN("LEFT JOIN", "team", "team.teamId=e.teamId")
			->where([
				"kpi_employee.status" => [1, 2, 4],
				"kpi_employee.kpiId" => $kpiId,
				"e.status" => 1,
				"kpi_employee.month" => $kpi["month"],
				"kpi_employee.year" => $kpi["year"]
			])
			->andWhere("kpi_employee.employeeId is not null")
			->orderBy("team.teamName,e.employeeFirstname")
			->asArray()
			->all();
		$employeeData = [];
		if (isset($kpiEmployee) && count($kpiEmployee) > 0) {
			foreach ($kpiEmployee as $ke) :
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