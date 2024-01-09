<?php

namespace backend\modules\kgi\controllers;

use backend\models\hrvc\Employee;
use backend\models\hrvc\Kgi;
use backend\models\hrvc\KgiEmployee;
use backend\models\hrvc\KgiEmployeeHistory;
use backend\models\hrvc\KgiIssue;
use backend\models\hrvc\KgiTeam;
use backend\models\hrvc\Unit;
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
					->select('e.employeeId,e.employeeFirstname,e.employeeSurename')
					->JOIN("LEFT JOIN", "employee e", "e.employeeId=kgi_employee.employeeId")
					->JOIN("LEFT JOIN", "user u", "u.employeeId=e.employeeId")
					->JOIN("LEFT JOIN", "user_role ur", "ur.userId=u.userId")
					->where(['e.teamId' => $team["teamId"]])
					->asArray()
					->orderBy('ur.roleId,e.employeeFirstname')
					->all();
				if (isset($kgiEmployee) && count($kgiEmployee) > 0) {
					foreach ($kgiEmployee as $employee) :
						$employeeTeam[$team["teamId"]][$employee["employeeId"]] = [
							"employeeId" => $employee["employeeId"],
							"target" => KgiEmployee::kgiEmployeeTarget($kgiId, $employee["employeeId"]),
							"employeeName" => $employee["employeeFirstname"] . " " . $employee["employeeSurename"],
						];
					endforeach;
				}
			endforeach;
		}
		return json_encode($employeeTeam);
	}
	public function actionEmployeeKgi($userId)
	{
		$employeeId = Employee::employeeId($userId);
		/*$kgis = Kgi::find()
			->select('kgi.*')
			->JOIN("LEFT JOIN", "kgi_employee ke", "ke.kgiId=kgi.kgiId")
			->where(["kgi.status" => [1, 2, 4], "ke.status" => 1, "ke.employeeId" => $employeeId])
			->asArray()
			->orderBy('kgi.updateDateTime DESC')
			->all();*/
		$kgiEmployee = KgiEmployee::find()
			->select('k.kgiName,k.priority,k.quantRatio,k.amountType,k.code,kgi_employee.target,kgi_employee.result,
			kgi_employee.status,k.unitId,k.month,k.kgiId,k.fromDate,k.toDate,k.companyId,k.periodDate,
			kgi_employee.kgiEmployeeId')
			->JOIN("LEFT JOIN", "kgi k", "kgi_employee.kgiId=k.kgiId")
			->where(["kgi_employee.status" => [1, 2, 4], "kgi_employee.employeeId" => $employeeId])
			->orderby('k.createDateTime')
			->asArray()
			->all();
		$data = [];
		if (count($kgiEmployee) > 0) {
			foreach ($kgiEmployee as $kgi) :
				// $ratio = 0;
				// if ($kgi["target"] != '' && $kgi["target"] != 0 && $kgi["target"] != null) {
				// 	$ratio = ($kgi["result"] / $kgi["target"]) * 100;
				// }

				if ($kgi["target"] != '' && $kgi["target"] != 0) {
					if ($kgi["code"] == '<' || $kgi["code"] == '=') {
						$ratio = ($kgi["result"] / $kgi["target"]) * 100;
					} else {
						$ratio = ($kgi["target"] / $kgi["result"]) * 100;
					}
				} else {
					$ratio = 0;
				}



				$data[$kgi["kgiId"]] = [
					"kgiName" => $kgi["kgiName"],
					"companyId" => $kgi['companyId'],
					"kgiEmployeeId" => $kgi["kgiEmployeeId"],
					//"companyName" => Company::companyName($kgi["companyId"]),
					//"branch" => KgiBranch::kgiBranch($kgi["kgiId"]),
					//"kgiBranch" => KgiBranch::kgiBranches($kgi["kgiId"]),
					"kgiEmployee" => KgiEmployee::kgiEmployee($kgi["kgiId"]),
					"quantRatio" => $kgi["quantRatio"],
					//"creater" => User::employeeNameByuserId($kgi["createrId"]),
					"targetAmount" => $kgi["target"],
					"code" => $kgi["code"],
					"result" => $kgi["result"],
					"unit" => Unit::unitName($kgi["unitId"]),
					"month" => ModelMaster::monthEng($kgi['month'], 1),
					"priority" => $kgi["priority"],
					"ratio" => number_format($ratio, 2),
					"periodCheck" => ModelMaster::engDate($kgi["periodDate"], 2),
					"nextCheck" => Kgi::nextCheckDate($kgi['kgiId']),
					"countTeam" => KgiTeam::kgiTeam($kgi["kgiId"]),
					//"flag" => Country::countryFlagBycompany($kgi["companyId"]),
					"status" => $kgi["status"],
					//"countryName" => Country::countryNameBycompany($kgi['companyId']),
					"issue" => KgiIssue::lastestIssue($kgi["kgiId"])["issue"],
					"solution" => KgiIssue::lastestIssue($kgi["kgiId"])["solution"],
					"employee" => KgiTeam::employeeTeam($kgi['kgiId']),
					"fromDate" => ModelMaster::engDate($kgi["fromDate"], 2),
					"toDate" => ModelMaster::engDate($kgi["toDate"], 2),
					"isOver" => ModelMaster::isOverDuedate(Kgi::nextCheckDate($kgi['kgiId'])),
					//"countKgiHasKfi" => KfiHasKgi::countKfiWithKgi($kgi['kgiId']),
					//"countKgiHasKpi" => KgiHasKpi::countKgiHasKpi($kgi['kgiId']),
					"amountType" => $kgi["amountType"]
				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionKgiEmployeeDetail($kgiEmployeeId)
	{
		/*$kgiEmployee = KgiEmployeeHistory::find()
			->where(["kgiEmployeeId" => $kgiEmployeeId])
			->orderBy('kgiEmployeeHistoryId DESC')
			->asArray()
			->one();*/
		//if (!isset($kgiEmployee) || empty($kgiEmployee)) {
		$kgiEmployee = KgiEmployee::find()
			->where(["kgiEmployeeId" => $kgiEmployeeId])
			->one();
		$kgiId = $kgiEmployee["kgiId"];
		$employeeId = $kgiEmployee["employeeId"];
		/*} else {
			$kgiE = KgiEmployee::find()
				->select('kgiId,employeeId')
				->where(["kgiEmployeeId" => $kgiEmployee["kgiEmployeeId"]])
				->asArray()
				->one();
			$kgiId = $kgiE["kgiId"];
			$employeeId = $kgiE["employeeId"];
		}*/
		$data = [];
		$kgiDetail = Kgi::find()
			//->select('kgiName')
			->where(["kgiId" => $kgiId])
			->one();
		if (isset($kgiEmployee) && !empty($kgiEmployee)) {
			if ($kgiEmployee["target"] != '' && $kgiEmployee["target"] != 0) {
				if ($kgiDetail["code"] == '<' || $kgiDetail["code"] == '=') {
					$ratio = ($kgiEmployee["result"] / $kgiEmployee["target"]) * 100;
				} else {
					$ratio = ($kgiEmployee["target"] / $kgiEmployee["result"]) * 100;
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
				"employeeName" => $employee["employeeFirstname"] . " " . $employee["employeeSurename"]
			];
		}
		return json_encode($data);
	}
	public function actionKgiEmployeeHistory($kgiEmployeeId)
	{
		$kgiHistory = KgiEmployeeHistory::find()
			->where(["kgiEmployeeId" => $kgiEmployeeId, "status" => [1, 2, 4, 88, 89]])
			->asArray()
			->orderBy("createDateTime DESC")
			->all();
		return json_encode($kgiHistory);
	}
}
