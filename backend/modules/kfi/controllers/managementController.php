<?php

namespace backend\modules\kfi\controllers;

use backend\models\hrvc\Branch;
use backend\models\hrvc\Company;
use backend\models\hrvc\Country;
use backend\models\hrvc\Department;
use backend\models\hrvc\Employee;
use backend\models\hrvc\Kfi;
use backend\models\hrvc\KfiBranch;
use backend\models\hrvc\KfiDepartment;
use backend\models\hrvc\KfiEmployee;
use backend\models\hrvc\KfiHasKgi;
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
	public function actionIndex($adminId, $gmId, $managerId, $supervisorId, $teamLeaderId, $staffId)
	{
		$data = [];
		$kfis = Kfi::find()
			->where(["status" => [1, 2, 4]])
			->asArray()
			->orderBy('updateDateTime DESC')
			->all();
		if (isset($kfis) && count($kfis) > 0) {
			foreach ($kfis as $kfi) :
				$allEmployee = KfiEmployee::kfiEmployee($kfi["kfiId"]);
				$selectPic = [];
				if (count($allEmployee) >= 3) {
					$randomEmpployee = array_rand($allEmployee, 3);
					$selectPic[0] = $allEmployee[$randomEmpployee[0]];
					$selectPic[1] = $allEmployee[$randomEmpployee[1]];
					$selectPic[2] = $allEmployee[$randomEmpployee[2]];
				} else {
					if (count($allEmployee) > 0) {
						$selectPic = $allEmployee;
						sort($selectPic);
					}
				}
				$data[$kfi["kfiId"]] = [
					"kfiName" => $kfi["kfiName"],
					"companyName" => Company::companyName($kfi['companyId']),
					"companyId" => $kfi['companyId'],
					"branchName" => Branch::kfiBranchName($kfi["kfiId"]),
					"kfiBranch" => KfiBranch::kfiBranch($kfi["kfiId"]),
					//"kfiEmployee" => KfiEmployee::kfiEmployee($kfi["kfiId"]),
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
					"toDate" => "",
					"active" => $kfi["active"],
					"countKfiHasKgi" => KfiHasKgi::countKgiInkfi($kfi["kfiId"]),
					"kfiEmployee" => $selectPic,
					"countEmployee" => count($allEmployee),

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
							//$ratio = ((int)$kfi['targetAmount'] / (int)$kfiHistory["result"]) * 100;
							if ($kfiHistory["result"] != '' && $kfiHistory["result"] != 0) {
								$ratio = ((int)$kfi["targetAmount"] / (int)$kfiHistory["result"]) * 100;
							} else {
								$ratio = 0;
							}
						}
					}
					$data[$kfi["kfiId"]] = [
						"kfiName" => $kfi["kfiName"],
						"companyName" => Company::companyName($kfi['companyId']),
						"companyId" => $kfi['companyId'],
						"branchName" => Branch::kfiBranchName($kfi["kfiId"]),
						//"kfiEmployee" => KfiEmployee::kfiEmployee($kfi["kfiId"]),
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
						"active" => $kfi["active"],
						"countKfiHasKgi" => KfiHasKgi::countKgiInkfi($kfi["kfiId"]),
						"kfiEmployee" => $selectPic,
						"countEmployee" => count($allEmployee),
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
		$res["targetAmount"] = $kfi["targetAmount"];
		$res["status"] = $kfi["status"];
		$res["creater"] = User::employeeNameByuserId($kfi["createrId"]);
		$res["monthName"] = strtoupper(ModelMaster::monthEng($kfi['month'], 1));
		$res["month"] = $kfi['month'];
		$res["unit"] = Unit::unitName($kfi['unitId']);
		$res["countryName"] = Country::countryNameBycompany($kfi['companyId']);
		$res["flag"] = Country::countryFlagBycompany($kfi["companyId"]);
		$res["active"] = $kfi["active"];
		$res["branch"] = KfiBranch::kfiBranchShort($kfiId);
		$res["kfiEmployeeDetail"] = KfiEmployee::kfiEmployeeDetail($kfi["kfiId"]);
		$kfiHistory = KfiHistory::find()
			->where(["kfiId" => $kfiId, "status" => [1, 2]])
			->orderBy('kfiHistoryId DESC')
			->asArray()
			->one();
		if (isset($kfiHistory) && !empty($kfiHistory)) {
			$res2["quantRatio"] = $kfiHistory["quantRatio"];
			$res2["code"] =  $kfiHistory["code"];
			$res2["result"] = $kfiHistory["result"];
			$res2["amountType"] = $kfiHistory["amountType"];
			$res2["kfiStatus"] = $kfiHistory["historyStatus"];
			$res2["nextCheck"] = ModelMaster::engDate($kfiHistory["nextCheckDate"], 2);
			$res2["checkDate"] = ModelMaster::engDate($kfiHistory["checkPeriodDate"], 2);
			$res2["nextCheckDate"] = $kfiHistory["nextCheckDate"];
			$res2["isOver"] = ModelMaster::isOverDuedate(Kfi::nextCheckDate($kfiHistory['kfiId']));
			$res["creater"] = User::employeeNameByuserId($kfiHistory["createrId"]);
			//$res2["periodCheck"] = $kfiHistory["checkPeriodDate"];
			$res2["fromDate"] = $kfiHistory["fromDate"];
			$res2["toDate"] = $kfiHistory["toDate"];
			$res2["fromDateDetail"] = ModelMaster::engDate($kfiHistory["fromDate"], 2);
			$res2["toDateDetail"] = ModelMaster::engDate($kfiHistory["toDate"], 2);
			if ($kfi["targetAmount"] == null || $kfi["targetAmount"] == '' || $kfi["targetAmount"] == 0) {
				$ratio = 0;
			} else {
				if ($kfiHistory["code"] == '<' || $kfiHistory["code"] == '=') {
					$ratio = ((int)$kfiHistory['result'] / (int)$kfi["targetAmount"]) * 100;
				} else {
					if ($kfiHistory["result"] != '' && $kfiHistory["result"] != 0) {
						$ratio = ((int)$kfi["targetAmount"] / (int)$kfiHistory["result"]) * 100;
					} else {
						$ratio = 0;
					}
					//$ratio = ((int)$kfi["targetAmount"] / (int)$kfiHistory['result']) * 100;
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
			$res2["isOver"] = 1;
			//$res2["periodCheck"] = $kfi["periodDate"];
		}
		$res3 = array_merge($res, $res2);
		return json_encode($res3);
	}
	public function actionKfiHistory($kfiId)
	{
		$kfiHistory = KfiHistory::find()
			->where(["kfiId" => $kfiId, "status" => [1, 2, 4]])
			->orderBy('kfiHistoryId DESC')
			->asArray()
			->all();
		$data = [];
		if (isset($kfiHistory) && count($kfiHistory) > 0) {
			foreach ($kfiHistory as $history) :
				$time = explode(' ', $history["createDateTime"]);
				$employeeId = Employee::employeeId($history["createrId"]);
				$data[$history["kfiHistoryId"]] = [
					"title" => $history["titleProgress"],
					"remark" => $history["remark"],
					//"result" => $history["result"],
					"picture" => Employee::employeeImage($employeeId),
					"createDate" => ModelMaster::engDateHr($history["createDateTime"]),
					"time" => ModelMaster::timeText($time[1]),
					"status" => $history["historyStatus"],
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
	public function actionKfiHistorySummarize($kfiId)
	{
		$kfiHistory = KfiHistory::find()
			->select('kfi_history.kfiHistoryId,kfi_history.month,kfi_history.year,kfi_history.status,kfi_history.nextCheckDate,k.kfiName,kfi_history.result,
			k.kfiId,k.targetAmount,kfi_history.fromDate,kfi_history.toDate,kfi_history.unitId,kfi_history.code,kfi_history.quantRatio,kfi_history.checkPeriodDate,
			kfi_history.nextCheckDate,kfi_history.amountType,kfi_history.fromDate,kfi_history.toDate,k.active,k.companyId')
			->JOIN("LEFT JOIN", "kfi k", "k.kfiId=kfi_history.kfiId")
			->where(["kfi_history.kfiId" => $kfiId])
			->andWhere("kfi_history.status!=99")
			->orderBy("kfi_history.year DESC,kfi_history.month DESC,kfi_history.kfiHistoryId DESC")
			->asArray()
			->all();
		$data = [];
		if (isset($kfiHistory) && count($kfiHistory) > 0) {
			$allEmployee = KfiEmployee::kfiEmployee($kfiId);
			$selectPic = [];
			if (count($allEmployee) >= 3) {
				$randomEmpployee = array_rand($allEmployee, 3);
				$selectPic[0] = $allEmployee[$randomEmpployee[0]];
				$selectPic[1] = $allEmployee[$randomEmpployee[1]];
				$selectPic[2] = $allEmployee[$randomEmpployee[2]];
			} else {
				if (count($allEmployee) > 0) {
					$selectPic = $allEmployee;
					sort($selectPic);
				}
			}
			foreach ($kfiHistory as $history):
				if (!isset($data[$history["year"]][$history["month"]])) {
					$ratio = 0;
					if ($history["code"] == '<' || $history["code"] == '=') {
						$ratio = ((int)$history['result'] / (int)$history["targetAmount"]) * 100;
					} else {
						if ($history["result"] != '' && $history["result"] != 0) {
							$ratio = ((int)$history["targetAmount"] / (int)$history["result"]) * 100;
						} else {
							$ratio = 0;
						}
					}
					$data[$history["year"]][$history["month"]] = [
						"kfiHistoryId" => $history["kfiHistoryId"],
						"kfiName" => $history["kfiName"],
						"companyId" => $history['companyId'],
						"target" => $history['targetAmount'],
						"unit" => Unit::unitName($history['unitId']),
						"month" => ModelMaster::monthEng($history['month'], 1),
						"year" => $history["year"],
						"status" => $history['status'],
						"quantRatio" => $history["quantRatio"],
						"code" =>  $history["code"],
						"result" => $history["result"],
						"ratio" => number_format($ratio, 2),
						"nextCheck" => ModelMaster::engDate($history["nextCheckDate"], 2),
						"checkDate" => ModelMaster::engDate($history["checkPeriodDate"], 2),
						"amountType" => $history["amountType"],
						"isOver" => ModelMaster::isOverDuedate($history["nextCheckDate"]),
						"fromDate" => ModelMaster::engDate($history["fromDate"], 2),
						"toDate" => ModelMaster::engDate($history["toDate"], 2),
						"active" => $history["active"],
						"employee" => count($allEmployee),
						"kfiEmployee" => $selectPic,
					];
				}

			endforeach;
		}
		//throw new exception(print_r($data, true));
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
	public function actionKfiFilter($companyId, $branchId, $month, $status, $year, $active, $adminId, $gmId, $managerId, $supervisorId, $teamLeaderId, $staffId)
	{
		$data = [];
		//$kfis = Kfi::find()->where(["status" => [1, 2]])->asArray()->all();
		/*if ($adminId != '') {
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
					"kfi.year" => $year,
					"kfi.active" => isset($active) ? $active : null
				])
				->orderBy('kfi.createDateTime ASC')
				->all();
		}
		if ($gmId != '') {
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
					"kfi.year" => $year,
					"kfi.active" => isset($active) ? $active : null
				])
				->orderBy('kfi.createDateTime ASC')
				->all();
		}
		if ($managerId != '') {
			$mCompanyId = Company::userCompany($managerId); //userId
			$mBranchId = Branch::companyBranch($mCompanyId);
			$kfis = Kfi::find()
				->select('kfi.*')
				->JOIN("LEFT JOIN", "kfi_branch kb", "kb.kfiId=kfi.kfiId")
				->JOIN("LEFT JOIN", "company c", "c.companyId=kfi.companyId")
				->where(["c.status" => 1, 'kb.status' => 1, 'kb.branchId' => $mBranchId])
				->andWhere("kfi.status!=99")
				->andFilterWhere([
					"kfi.companyId" => $companyId,
					"kb.branchId" => $branchId,
					"kfi.month" => $month,
					"kfi.status" => $status,
					"kfi.year" => $year,
					"kfi.active" => isset($active) ? $active : null
				])
				->orderBy('kfi.createDateTime ASC')
				->all();
		}
		if ($supervisorId != '') {
			//$mDepartmentId = Department::userDepartmentId($supervisorId);
			$mBranchId = Branch::userBranchId($supervisorId);
			$kfis = Kfi::find()
				->select('kfi.*')
				->JOIN("LEFT JOIN", "kfi_branch kb", "kb.kfiId=kfi.kfiId")
				//->JOIN("LEFT JOIN", "kfi_department kd", "kd.kfiId=kfi.kfiId")
				->JOIN("LEFT JOIN", "company c", "c.companyId=kfi.companyId")
				//->where(["c.status" => 1, "kd.status" => 1, "kd.departmentId" => $mDepartmentId])
				->where(["c.status" => 1, "kb.status" => 1, "kb.branchId" => $mBranchId])
				->andWhere("kfi.status!=99")
				->andFilterWhere([
					"kfi.companyId" => $companyId,
					"kb.branchId" => $branchId,
					"kfi.month" => $month,
					"kfi.status" => $status,
					"kfi.year" => $year,
					"kfi.active" => isset($active) ? $active : null
				])
				->orderBy('kfi.createDateTime ASC')
				->all();
		}
		if ($teamLeaderId != '') {
			$mBranchId = Branch::userBranchId($supervisorId);
			$kfis = Kfi::find()
				->select('kfi.*')
				->JOIN("LEFT JOIN", "kfi_branch kb", "kb.kfiId=kfi.kfiId")
				->where(["kgi.status" => [1, 2, 4], "kb.branchId" => $mBranchId])
				->andFilterWhere([
					"kgi.companyId" => $companyId,
					"kb.branchId" => $branchId,
					"kgi.month" => $month,
					"kgi.status" => $status,
					"kgi.year" => $year,
				])
				->orderBy('kgi.createDateTime ASC')
				->all();
		}
		if ($staffId != '') {
			$employeeId = Employee::employeeId($staffId);
			$kfis = Kfi::find()
				->select('kfi.*')
				->JOIN("LEFT JOIN", "kfi_branch kb", "kb.kfiId=kfi.kfiId")
				->JOIN("LEFT JOIN", "kfi_employee ke", "ke.kfiId=kfi.kfiId")
				->JOIN("LEFT JOIN", "company c", "c.companyId=kfi.companyId")
				->where(["c.status" => 1, "ke.status" => 1, "ke.employeeId" => $employeeId])
				->andWhere("kfi.status!=99")
				->andFilterWhere([
					"kfi.companyId" => $companyId,
					"kb.branchId" => $branchId,
					"kfi.month" => $month,
					"kfi.status" => $status,
					"kfi.year" => $year,
					"kfi.active" => isset($active) ? $active : null
				])
				->orderBy('kfi.createDateTime ASC')
				->all();
		}*/
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
				"kfi.year" => $year,
				"kfi.active" => isset($active) ? $active : null
			])
			->orderBy('kfi.createDateTime ASC')
			//->groupBy('kfi.kfiId')
			->all();
		//throw new Exception(print_r($kfis, true));
		if (isset($kfis) && count($kfis) > 0) {
			foreach ($kfis as $kfi) :
				$allEmployee = KfiEmployee::kfiEmployee($kfi["kfiId"]);
				$selectPic = [];
				if (count($allEmployee) >= 3) {
					$randomEmpployee = array_rand($allEmployee, 3);
					$selectPic[0] = $allEmployee[$randomEmpployee[0]];
					$selectPic[1] = $allEmployee[$randomEmpployee[1]];
					$selectPic[2] = $allEmployee[$randomEmpployee[2]];
				} else {
					if (count($allEmployee) > 0) {
						$selectPic = $allEmployee;
						sort($selectPic);
					}
				}
				$data[$kfi["kfiId"]] = [
					"kfiName" => $kfi["kfiName"],
					"companyName" => Company::companyName($kfi['companyId']),
					//"companyName" => $kfi['companyName'],
					"branchName" => Branch::kfiBranchName($kfi["kfiId"]),
					"companyId" => $kfi['companyId'],
					"kfiBranch" => KfiBranch::kfiBranch($kfi["kfiId"]),
					//"kfiEmployee" => KfiEmployee::kfiEmployee($kfi["kfiId"]),
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
					"active" => $kfi["active"],
					"countKfiHasKgi" => KfiHasKgi::countKgiInkfi($kfi["kfiId"]),
					"kfiEmployee" => $selectPic,
					"countEmployee" => count($allEmployee),
				];
				// $kfiHistory = KfiHistory::find()
				// 	->where(["kfiId" => $kfi["kfiId"], "status" => [1, 2]])
				// 	->orderBy('kfiHistoryId DESC')
				// 	->one();
				$kfiHistory = KfiHistory::find()
					->where(["kfiId" => $kfi["kfiId"], "status" => [1, 2]])
					->andFilterWhere([
						//"kfi.companyId" => $companyId,
						//"kb.branchId" => $branchId,
						"month" => $month,
						"status" => $status,
						"year" => $year,
						//"kfi.active" => isset($active) ? $active : null
					])
					->orderBy('kfiHistoryId DESC')
					->one();
				if (isset($kfiHistory) && !empty($kfiHistory)) {
					if ($kfi["targetAmount"] == null || $kfi["targetAmount"] == '' || $kfi["targetAmount"] == 0) {
						$ratio = 0;
					} else {
						if ($kfiHistory["code"] == '<' || $kfiHistory["code"] == '=') {
							$ratio = ((int)$kfiHistory['result'] / (int)$kfi["targetAmount"]) * 100;
						} else {
							if ($kfiHistory["result"] != '' && $kfiHistory["result"] != 0) {
								$ratio = ((int)$kfi["targetAmount"] / (int)$kfiHistory["result"]) * 100;
							} else {
								$ratio = 0;
							}
							//$ratio = ((int)$kfi["targetAmount"] / (int)$kfiHistory['result']) * 100;
						}
					}
					$data[$kfi["kfiId"]] = [
						"kfiName" => $kfi["kfiName"],
						"companyName" => Company::companyName($kfi['companyId']),
						//"companyName" => $kfi['companyName'],
						"branchName" => Branch::kfiBranchName($kfi["kfiId"]),
						"companyId" => $kfi['companyId'],
						"kfiBranch" => KfiBranch::kfiBranch($kfi["kfiId"]),
						//"kfiEmployee" => KfiEmployee::kfiEmployee($kfi["kfiId"]),
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
						"active" => $kfi["active"],
						"countKfiHasKgi" => KfiHasKgi::countKgiInkfi($kfi["kfiId"]),
						"kfiEmployee" => $selectPic,
						"countEmployee" => count($allEmployee),
					];
				}

			endforeach;
		}
		//throw new Exception(print_r($data, true));
		return json_encode($data);
	}
	public function actionKfiHasKgi($kfiId)
	{
		$kfiHasKgi = KfiHasKgi::find()
			->select('kgi.kgiName,kgi.kgiId,kgi.unitId,kgi.targetAmount,kgi.month,kgi.code,kgi.result')
			->JOIN("LEFT JOIN", "kgi", "kgi.kgiId=kfi_has_kgi.kgiId")
			->JOIN("LEFT JOIN", "kfi", "kfi.kfiId=kfi_has_kgi.kfiId")
			->where([
				"kfi_has_kgi.kfiId" => $kfiId,
				"kfi_has_kgi.status" => 1,
				"kgi.status" => [1, 2],
				"kfi.status" => [1, 2]
			])
			->asArray()
			->all();
		return json_encode($kfiHasKgi);
	}
	public function actionKfiBranch($kfiId)
	{
		$kfiBranch = KfiBranch::kfiBranch($kfiId);
		return json_encode($kfiBranch);
	}
	public function actionKfiTeamEmployee($kfiId)
	{
		$employeeInTeam = Employee::find()
			->select('t.teamId,t.teamName,employee.employeeFirstname,employee.employeeSurename,employee.employeeId,ti.titleName,employee.picture,employee.gender,d.departmentName')
			->JOIN('LEFT JOIN', "team t", "employee.teamId=t.teamId")
			->JOIN('LEFT JOIN', "department d", "d.departmentId=t.departmentId")
			->JOIN("LEFT JOIN", "title ti", "ti.titleId=employee.titleId")
			->where(["employee.status" => 1])
			->orderBy("t.teamName")
			->asArray()
			->all();
		$data = [];
		$totalEmployee = 0;
		$totalTargetAll = 0;
		if (isset($employeeInTeam) && count($employeeInTeam) > 0) {
			foreach ($employeeInTeam as $employee):
				if ($employee["picture"] != '') {
					$img = $employee["picture"];
				} else {
					if ($employee["gender"] == 1) {
						$img = "image/user.png";
					} else {
						$img = "image/lady.jpg";
					}
				}
				$kfiEmployee = KfiEmployee::find()
					->where(["employeeId" => $employee["employeeId"], "kfiId" => $kfiId])
					->andWhere("status!=99")
					->orderBy('createDateTime DESC')
					->asArray()
					->one();
				if (isset($kfiEmployee) && !empty($kfiEmployee)) {
					$checked = "checked";
					$target = $kfiEmployee["target"];
					$totalEmployee += 1;
					$totalTargetAll += $kfiEmployee["target"];
				} else {
					$checked = "";
					$target = 0;
				}
				$data[$employee["teamId"]]["employee"][$employee["employeeId"]] = [
					"employeeFirstname" => $employee["employeeFirstname"],
					"employeeSurename" => $employee["employeeSurename"],
					"target" => $target,
					"picture" => $img,
					"checked" => $checked,
					"titleName" => $employee["titleName"]
				];
				/*if (isset($totalTeam[$employee["teamId"]]["total"]) && $totalTeam[$employee["teamId"]]["total"] != null) {
					$totalTeam[$employee["teamId"]]["total"] += $kfiEmployee["target"];
				} else {
					$totalTeam[$employee["teamId"]]["total"] = $kfiEmployee["target"];
				}*/
				if (!isset($data[$employee["teamId"]]["team"])) {
					$data[$employee["teamId"]]["team"] = [
						"teamName" => $employee["teamName"],
						"departmentName" => $employee["departmentName"]
					];
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
}
