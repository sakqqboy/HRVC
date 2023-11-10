<?php

namespace backend\modules\kfi\controllers;

use backend\models\hrvc\Branch;
use backend\models\hrvc\Company;
use backend\models\hrvc\Country;
use backend\models\hrvc\Employee;
use backend\models\hrvc\Kfi;
use backend\models\hrvc\KfiBranch;
use backend\models\hrvc\KfiDepartment;
use backend\models\hrvc\KfiEmployee;
use backend\models\hrvc\KfiHistory;
use backend\models\hrvc\KfiSolution;
use backend\models\hrvc\Unit;
use backend\models\hrvc\User;
use common\models\ModelMaster;
use Exception;
use backend\models\hrvc\KfiIssue;
use yii\db\Expression;
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
		$data = [];
		$kfis = Kfi::find()->where(["status" => [1, 2]])->asArray()->orderBy('updateDateTime DESC')->all();
		if (isset($kfis) && count($kfis) > 0) {
			foreach ($kfis as $kfi) :
				$data[$kfi["kfiId"]] = [
					"kfiName" => $kfi["kfiName"],
					"companyName" => Company::companyName($kfi['companyId']),
					"companyId" => $kfi['companyId'],
					"branchName" => Branch::kfiBranchName($kfi["kfiId"]),
					"kfiBranch" => KfiBranch::kfiBranch($kfi["kfiId"]),
					"kfiEmployee" => KfiEmployee::kfiEmployee($kfi["kfiId"]),
					"quantRatio" => "",
					"creater" => User::employeeNameByuserId($kfi["createrId"]),
					"target" => $kfi['targetAmount'],
					"code" => "",
					"result" => "",
					"ratio" => 0,
					"unit" => Unit::unitName($kfi['unitId']),
					"month" => ModelMaster::monthEng($kfi['month'], 1),
					"amountType" => "",
					"status" => $kfi['status'],
					"nextCheck" => "",
					"checkDate" => "",
					"countryName" => Country::countryNameBycompany($kfi['companyId']),
					"flag" => Country::countryFlagBycompany($kfi['companyId']),
					"isOver" => 0,
					"fromDate" => "",
					"toDate" => ""
				];
				$kfiHistory = KfiHistory::find()
					->where(["kfiId" => $kfi["kfiId"], "status" => [1, 2]])
					->orderBy('kfiHistoryId DESC')->one();
				if (isset($kfiHistory) && !empty($kfiHistory)) {
					if ($kfi["targetAmount"] == null || $kfi["targetAmount"] == '' || $kfi["targetAmount"] == 0) {
						$ratio = 0;
					} else {
						if ($kfiHistory["code"] == '<' || $kfiHistory["code"] == '=') {
							$ratio = ((int)$kfiHistory['result'] / (int)$kfi["targetAmount"]) * 100;
						} else {
							$ratio = ((int)$kfi['targetAmount'] / (int)$kfiHistory["result"]) * 100;
						}
					}
					$data[$kfi["kfiId"]] = [
						"kfiName" => $kfi["kfiName"],
						"companyName" => Company::companyName($kfi['companyId']),
						"companyId" => $kfi['companyId'],
						"branchName" => Branch::kfiBranchName($kfi["kfiId"]),
						"kfiEmployee" => KfiEmployee::kfiEmployee($kfi["kfiId"]),
						"kfiBranch" => KfiBranch::kfiBranch($kfi["kfiId"]),
						"target" => $kfi['targetAmount'],
						"unit" => Unit::unitName($kfi['unitId']),
						"month" => ModelMaster::monthEng($kfi['month'], 1),
						"creater" => User::employeeNameByuserId($kfiHistory["createrId"]),
						"status" => $kfi['status'],
						"quantRatio" => $kfiHistory["quantRatio"],
						"code" =>  $kfiHistory["code"],
						"result" => $kfiHistory["result"],
						"ratio" => number_format($ratio, 2),
						"nextCheck" => ModelMaster::engDate($kfiHistory["nextCheckDate"], 2),
						"checkDate" => ModelMaster::engDate($kfiHistory["checkPeriodDate"], 2),
						"amountType" => $kfiHistory["amountType"],
						"countryName" => Country::countryNameBycompany($kfi['companyId']),
						"flag" => Country::countryFlagBycompany($kfi['companyId']),
						"isOver" => ModelMaster::isOverDuedate($kfiHistory["nextCheckDate"]),
						"fromDate" => ModelMaster::engDate($kfiHistory["fromDate"], 2),
						"toDate" => ModelMaster::engDate($kfiHistory["toDate"], 2),
					];
				}

			endforeach;
		}
		//throw new Exception(print_r($data, true));
		return json_encode($data);
	}
	public function actionKfiDetail($kfiId)
	{
		$kfi = Kfi::find()->where(["kfiId" => $kfiId])->asArray()->one();
		$res["kfiName"] = $kfi["kfiName"];
		$res["year"] = $kfi["year"];
		$res["companyName"] = Company::companyName($kfi['companyId']);
		$res["companyId"] = $kfi['companyId'];
		$res["branchName"] = Branch::kfiBranchName($kfiId);
		$res["kfiBranch"] = KfiBranch::kfiBranch($kfiId);
		$res["unitId"] = $kfi["unitId"];
		$res["detail"] = $kfi["kfiDetail"];
		$res["targetAmount"] = number_format($kfi["targetAmount"], 2);
		$res["status"] = $kfi["status"];
		$res["creater"] = User::employeeNameByuserId($kfi["createrId"]);
		$res["monthName"] = strtoupper(ModelMaster::monthEng($kfi['month'], 1));
		$res["month"] = $kfi['month'];
		$res["unit"] = Unit::unitName($kfi['unitId']);
		$res["countryName"] = Country::countryNameBycompany($kfi['companyId']);
		$res["flag"] = Country::countryFlagBycompany($kfi["companyId"]);
		$kfiHistory = KfiHistory::find()
			->where(["kfiId" => $kfiId, "status" => [1, 2]])
			->orderBy('kfiHistoryId DESC')
			->asArray()
			->one();
		if (isset($kfiHistory) && !empty($kfiHistory)) {
			$res2["quantRatio"] = $kfiHistory["quantRatio"];
			$res2["code"] =  $kfiHistory["code"];
			$res2["result"] = number_format($kfiHistory["result"], 2);
			$res2["amountType"] = $kfiHistory["amountType"];
			$res2["kfiStatus"] = $kfiHistory["historyStatus"];
			$res2["nextCheck"] = ModelMaster::engDate($kfiHistory["nextCheckDate"], 2);
			$res2["checkDate"] = ModelMaster::engDate($kfiHistory["checkPeriodDate"], 2);
			$res2["nextCheckDate"] = $kfiHistory["nextCheckDate"];
			$res["creater"] = User::employeeNameByuserId($kfiHistory["createrId"]);
			//$res2["periodCheck"] = $kfiHistory["checkPeriodDate"];
			$res2["fromDate"] = $kfiHistory["fromDate"];
			$res2["toDate"] = $kfiHistory["toDate"];

			if ($kfi["targetAmount"] == null || $kfi["targetAmount"] == '' || $kfi["targetAmount"] == 0) {
				$ratio = 0;
			} else {
				if ($kfiHistory["code"] == '<' || $kfiHistory["code"] == '=') {
					$ratio = ((int)$kfiHistory['result'] / (int)$kfi["targetAmount"]) * 100;
				} else {
					$ratio = ((int)$kfi["targetAmount"] / (int)$kfiHistory['result']) * 100;
				}
			}
			$res2["ratio"] = number_format($ratio, 2);
		} else {
			$res2["quantRatio"] = "";
			$res2["code"] = "";
			$res2["result"] = "";
			$res2["amountType"] = "";
			$res2["kfistatus"] = "";
			$res2["ratio"] = 0;
			$res2["nextCheck"] = "";
			$res2["checkDate"] = "";
			$res2["nextCheckDate"] = null;
			$res2["fromDate"] = null;
			$res2["toDate"] = null;
			//$res2["periodCheck"] = $kfi["periodDate"];
		}
		$res3 = array_merge($res, $res2);
		return json_encode($res3);
	}
	public function actionKfiHistory($kfiId)
	{
		$kfiHistory = KfiHistory::find()
			->where(["kfiId" => $kfiId, "status" => [1, 4]])
			->orderBy('kfiHistoryId DESC')
			->asArray()
			->all();
		$data = [];
		if (isset($kfiHistory) && count($kfiHistory) > 0) {


			foreach ($kfiHistory as $history) :
				$time = explode(' ', $history["createDateTime"]);
				$data[$history["kfiHistoryId"]] = [
					"title" => $history["titleProgress"],
					"remark" => $history["remark"],
					"result" => $history["result"],
					"createDate" => ModelMaster::engDateHr($history["createDateTime"]),
					"time" => ModelMaster::timeText($time[1]),
					"status" => $history["historyStatus"],
					"creater" => User::employeeNameByuserId($history["createrId"])
				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionKfiIssue($kfiId)
	{
		$kfiIssue = KfiIssue::find()
			->where(["status" => [1, 2], "kfiId" => $kfiId])
			->orderBy("kfiIssueId")
			->asArray()
			->all();

		$data = [];
		if (isset($kfiIssue) && count($kfiIssue) > 0) {
			foreach ($kfiIssue as $issue) :
				$employee = Employee::EmployeeDetail($issue["employeeId"]);
				$data[$issue["kfiIssueId"]] = [
					"issue" => $issue["issue"],
					"file" => $issue["file"],
					"employeeName" => $employee["employeeFirstname"] . ' ' . $employee["employeeSurename"],
					"image" => Employee::EmployeeDetail($issue["employeeId"])["picture"],
					"createDateTime" => ModelMaster::engDate($issue["createDateTime"], 2),
					"solutionList" => KfiSolution::solutionList($issue["kfiIssueId"])
				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionKfiDepartment($id)
	{
		$kfiDepartments = KfiDepartment::find()
			->select('kfi_department.departmentId,d.departmentName,d.branchId')
			->JOIN("LEFT JOIN", "department d", "d.departmentId=kfi_department.departmentId")
			->where(["kfi_department.kfiId" => $id])
			->asArray()
			->all();
		$data = [];
		if (isset($kfiDepartments) && count($kfiDepartments)) {
			foreach ($kfiDepartments as $kfiDepartment) :
				$data[$kfiDepartment["branchId"]][$kfiDepartment["departmentId"]] = $kfiDepartment["departmentName"];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionKfiFilter($companyId, $branchId, $month, $status, $year)
	{
		$data = [];
		//$kfis = Kfi::find()->where(["status" => [1, 2]])->asArray()->all();
		$kfis = Kfi::find()
			->select('kfi.*')
			->JOIN("LEFT JOIN", "kfi_branch kb", "kb.kfiId=kfi.kfiId")
			->JOIN("LEFT JOIN", "company c", "c.companyId=kfi.companyId")
			->where(["c.status" => 1])
			->andWhere("kfi.status!=99")
			->andFilterWhere([
				"kfi.companyId" => $companyId,
				"kb.branchId" => $branchId,
				"kfi.month" => $month,
				"kfi.status" => $status,
				"kfi.year" => $year
			])
			->orderBy('kfi.createDateTime ASC')
			->all();
		if (isset($kfis) && count($kfis) > 0) {
			foreach ($kfis as $kfi) :
				$data[$kfi["kfiId"]] = [
					"kfiName" => $kfi["kfiName"],
					"companyName" => Company::companyName($kfi['companyId']),
					"branchName" => Branch::kfiBranchName($kfi["kfiId"]),
					"creater" => User::employeeNameByuserId($kfi["createrId"]),
					"quantRatio" => "",
					"target" => $kfi['targetAmount'],
					"code" => "",
					"result" => "",
					"ratio" => 0,
					"unit" => Unit::unitName($kfi['unitId']),
					"month" => ModelMaster::monthEng($kfi['month'], 1),
					"amountType" => "",
					"status" => $kfi['status'],
					"nextCheck" => "",
					"checkDate" => "",
					"countryName" => Country::countryNameBycompany($kfi['companyId']),
					"flag" => Country::countryFlagBycompany($kfi['companyId']),
					"year" => $year,
					"fromDate" => "",
					"isOver" => 0,
					"toDate" => "",
				];
				$kfiHistory = KfiHistory::find()
					->where(["kfiId" => $kfi["kfiId"], "status" => [1, 2]])
					->orderBy('kfiHistoryId DESC')->one();
				if (isset($kfiHistory) && !empty($kfiHistory)) {
					if ($kfi["targetAmount"] == null || $kfi["targetAmount"] == '' || $kfi["targetAmount"] == 0) {
						$ratio = 0;
					} else {
						if ($kfiHistory["code"] == '<' || $kfiHistory["code"] == '=') {
							$ratio = ((int)$kfiHistory['result'] / (int)$kfi["targetAmount"]) * 100;
						} else {
							$ratio = ((int)$kfi["targetAmount"] / (int)$kfiHistory['result']) * 100;
						}
					}
					$data[$kfi["kfiId"]] = [
						"kfiName" => $kfi["kfiName"],
						"companyName" => Company::companyName($kfi['companyId']),
						"branchName" => Branch::kfiBranchName($kfi["kfiId"]),
						"target" => $kfi['targetAmount'],
						"unit" => Unit::unitName($kfi['unitId']),
						"month" => ModelMaster::monthEng($kfi['month'], 1),
						"status" => $kfi['status'],
						"quantRatio" => $kfiHistory["quantRatio"],
						"code" =>  $kfiHistory["code"],
						"result" => $kfiHistory["result"],
						"ratio" => number_format($ratio, 2),
						"nextCheck" => ModelMaster::engDate($kfiHistory["nextCheckDate"], 2),
						"checkDate" => ModelMaster::engDate($kfiHistory["checkPeriodDate"], 2),
						"creater" => User::employeeNameByuserId($kfiHistory["createrId"]),
						"amountType" => $kfiHistory["amountType"],
						"countryName" => Country::countryNameBycompany($kfi['companyId']),
						"flag" => Country::countryFlagBycompany($kfi['companyId']),
						"year" => $year,
						"fromDate" => ModelMaster::engDate($kfiHistory["fromDate"], 2),
						"toDate" => ModelMaster::engDate($kfiHistory["toDate"], 2),
						"isOver" => ModelMaster::isOverDuedate($kfiHistory["nextCheckDate"]),
					];
				}

			endforeach;
		}
		//throw new Exception(print_r($data, true));
		return json_encode($data);
	}
}
