<?php

namespace backend\modules\kgi\controllers;

use backend\models\hrvc\Branch;
use backend\models\hrvc\Company;
use backend\models\hrvc\Country;
use backend\models\hrvc\Employee;
use backend\models\hrvc\Kgi;
use backend\models\hrvc\KgiBranch;
use backend\models\hrvc\KgiDepartment;
use backend\models\hrvc\KgiHistory;
use backend\models\hrvc\KgiIssue;
use backend\models\hrvc\KgiSolution;
use backend\models\hrvc\KgiTeam;
use backend\models\hrvc\Unit;
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
	public function actionIndex()
	{
		$kgis = Kgi::find()->where(["status" => [1, 4]])->asArray()->all();
		$data = [];
		if (count($kgis) > 0) {
			foreach ($kgis as $kgi) :
				$ratio = 0;
				if ($kgi["targetAmount"] != '' && $kgi["targetAmount"] != 0 && $kgi["targetAmount"] != null) {
					$ratio = ($kgi["result"] / $kgi["targetAmount"]) * 100;
				}
				$data[$kgi["kgiId"]] = [
					"kgiName" => $kgi["kgiName"],
					"companyName" => Company::companyName($kgi["companyId"]),
					"branch" => KgiBranch::kgiBranch($kgi["kgiId"]),
					"quantRatio" => $kgi["quantRatio"],
					"targetAmount" => number_format($kgi["targetAmount"], 2),
					"code" => $kgi["code"],
					"result" => number_format($kgi["result"], 2),
					"unit" => Unit::unitName($kgi["unitId"]),
					"month" => ModelMaster::monthEng($kgi['month'], 1),
					"priority" => $kgi["priority"],
					"ratio" => number_format($ratio, 2),
					"periodCheck" => ModelMaster::engDate($kgi["periodDate"], 2),
					"nextCheck" => Kgi::nextCheckDate($kgi['kgiId']),
					"countTeam" => KgiTeam::kgiTeam($kgi["kgiId"]),
					"flag" => Country::countryFlagBycompany($kgi["companyId"]),
					"employee" => "",
					"status" => $kgi["status"],
					"countryName" => Country::countryNameBycompany($kgi['companyId']),
					"issue" => KgiIssue::lastestIssue($kgi["kgiId"])["issue"],
					"solution" => KgiIssue::lastestIssue($kgi["kgiId"])["solution"],
					"employee" => KgiTeam::employeeTeam($kgi['kgiId'])
				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionKgiDetail($id)
	{
		$kgiHistory = KgiHistory::find()->where(["status" => [1, 4], "kgiId" => $id])->orderBy('kgiHistoryId DESC')->asArray()->one();
		if (isset($kgiHistory) && !empty($kgiHistory)) { //wait edit
			$kgi = Kgi::find()->where(["kgiId" => $id])->asArray()->one();
			if ($kgi["targetAmount"] != '' && $kgi["targetAmount"] != 0) {
				$ratio = ($kgi["result"] / $kgi["targetAmount"]) * 100;
			} else {
				$ratio = 0;
			}
			$data = [
				"kgiName" => $kgi["kgiName"],
				"companyId" => $kgi["companyId"],
				"detail" => $kgiHistory['description'],
				"quantRatio" => $kgiHistory["quantRatio"],
				"targetAmount" => $kgiHistory["targetAmount"],
				"amountType" => $kgiHistory["amountType"],
				"code" => $kgiHistory["code"],
				"result" => $kgiHistory["result"],
				"unitId" => $kgiHistory["unitId"],
				"month" => $kgiHistory['month'],
				"monthName" => strtoupper(ModelMaster::monthEng($kgi['month'], 2)),
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
			];
		} else {
			$kgi = Kgi::find()->where(["kgiId" => $id])->asArray()->one();
			if ($kgi["targetAmount"] != '' && $kgi["targetAmount"] != 0) {
				$ratio = ($kgi["result"] / $kgi["targetAmount"]) * 100;
			} else {
				$ratio = 0;
			}
			$data = [
				"kgiName" => $kgi["kgiName"],
				"companyId" => $kgi["companyId"],
				"detail" => $kgi['kgiDetail'],
				"quantRatio" => $kgi["quantRatio"],
				"targetAmount" => $kgi["targetAmount"],
				"amountType" => $kgi["amountType"],
				"code" => $kgi["code"],
				"result" => $kgi["result"],
				"unitId" => $kgi["unitId"],
				"month" => $kgi['month'],
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
			];
		}

		return json_encode($data);
	}
	public function actionKgiBranch($id)
	{
		$kgiBranches = KgiBranch::find()
			->select('kgi_branch.branchId,b.branchName')
			->JOIN("LEFT JOIN", "branch b", "b.branchId=kgi_branch.branchId")
			->where(["kgi_branch.kgiId" => $id])
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
			->where(["kgi_department.kgiId" => $id])
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
			->where(["kgi_team.kgiId" => $id])
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
		$kgiTeams = KgiTeam::find()
			->select('teamId')
			->where(["kgiId" => $id])
			->asArray()
			->all();
		$data = [];
		if (isset($kgiTeams) && count($kgiTeams) > 0) {
			foreach ($kgiTeams as $team) :
				$employee = Employee::find()->select('employeeFirstname,employeeSurename,employeeNumber,employeeId,picture')
					->where(["teamId" => $team["teamId"], "status" => 1])
					->asArray()
					->orderBy('employeeNumber')
					->all();
				if (isset($employee) && count($employee) > 0) {
					foreach ($employee as $em) :
						$data[$em["employeeId"]] = [
							"firstname" => $em["employeeFirstname"],
							"surename" => $em["employeeSurename"],
							"image" => $em["picture"],
						];
					endforeach;
				}

			endforeach;
		}

		return json_encode($data);
	}
	public function actionKgiHistory($kgiId)
	{
		$kgiHistory = KgiHistory::find()
			->where(["kgiId" => $kgiId, "status" => [1, 4]])
			->orderBy('kgiHistoryId DESC')
			->asArray()
			->all();
		$data = [];
		if (isset($kgiHistory) && count($kgiHistory) > 0) {
			foreach ($kgiHistory as $history) :
				$time = explode(' ', $history["createDateTime"]);
				$data[$history["kgiHistoryId"]] = [
					"title" => $history["titleProcess"],
					"remark" => $history["remark"],
					"result" => $history["result"],
					"createDate" => ModelMaster::engDateHr($history["createDateTime"]),
					"time" => ModelMaster::timeText($time[1]),
					"status" => $history["status"]
				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionKgiIssue($kgiId)
	{
		$kgiIssue = KgiIssue::find()
			->where(["status" => [1, 4], "kgiId" => $kgiId])
			->orderBy("kgiIssueId")
			->asArray()
			->all();

		$data = [];
		if (isset($kgiIssue) && count($kgiIssue) > 0) {
			foreach ($kgiIssue as $issue) :
				$employee = Employee::EmployeeDetail($issue["employeeId"]);
				$data[$issue["kgiIssueId"]] = [
					"issue" => $issue["issue"],
					"file" => $issue["file"],
					"employeeName" => $employee["employeeFirstname"] . ' ' . $employee["employeeSurename"],
					"image" => Employee::EmployeeDetail($issue["employeeId"])["picture"],
					"createDateTime" => ModelMaster::engDate($issue["createDateTime"], 2),
					"solutionList" => KgiSolution::solutionList($issue["kgiIssueId"])
				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionKgiFilter($companyId, $branchId, $teamId, $month, $status, $year)
	{
		$data = [];
		$kgis = Kgi::find()
			->select('kgi.*')
			->JOIN("LEFT JOIN", "kgi_branch kb", "kb.kgiId=kgi.kgiId")
			->JOIN("LEFT JOIN", "kgi_team kt", "kt.kgiId=kgi.kgiId")
			->where(["kgi.status" => [1, 4]])
			->andFilterWhere([
				"kgi.companyId" => $companyId,
				"kb.branchId" => $branchId,
				"kt.teamId" => $teamId,
				"kgi.month" => $month,
				"kgi.status" => $status,
				"kgi.year" => $year,
			])
			->orderBy('kgi.createDateTime ASC')
			->all();
		if (count($kgis) > 0) {
			foreach ($kgis as $kgi) :
				$ratio = 0;
				if ($kgi["targetAmount"] != '' && $kgi["targetAmount"] != 0 && $kgi["targetAmount"] != null) {
					$ratio = ($kgi["result"] / $kgi["targetAmount"]) * 100;
				}
				$data[$kgi["kgiId"]] = [
					"kgiName" => $kgi["kgiName"],
					"companyName" => Company::companyName($kgi["companyId"]),
					"branch" => KgiBranch::kgiBranch($kgi["kgiId"]),
					"quantRatio" => $kgi["quantRatio"],
					"targetAmount" => number_format($kgi["targetAmount"], 2),
					"code" => $kgi["code"],
					"result" => number_format($kgi["result"], 2),
					"unit" => Unit::unitName($kgi["unitId"]),
					"month" => ModelMaster::monthEng($kgi['month'], 1),
					"priority" => $kgi["priority"],
					"ratio" => number_format($ratio, 2),
					"periodCheck" => ModelMaster::engDate($kgi["periodDate"], 2),
					"nextCheck" => Kgi::nextCheckDate($kgi['kgiId']),
					"countTeam" => KgiTeam::kgiTeam($kgi["kgiId"]),
					"flag" => Country::countryFlagBycompany($kgi["companyId"]),
					"employee" => "",
					"status" => $kgi["status"],
					"countryName" => Country::countryNameBycompany($kgi['companyId']),
					"issue" => KgiIssue::lastestIssue($kgi["kgiId"])["issue"],
					"solution" => KgiIssue::lastestIssue($kgi["kgiId"])["solution"],
					"employee" => KgiTeam::employeeTeam($kgi['kgiId']),
					"year" => $kgi["year"],
				];
			endforeach;
		}
		return json_encode($data);
	}
}
