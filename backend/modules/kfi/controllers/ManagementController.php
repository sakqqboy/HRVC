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
use backend\models\hrvc\KgiTeam;
use common\helpers\Athorize;
use Yii;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\Response;

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
	public function actionIndex($adminId, $gmId, $managerId, $supervisorId, $teamLeaderId, $staffId, $currentPage = null, $limit = null)
	{
		$startAt = (($currentPage - 1) * $limit);
		$data = [];
		$data1 = [];
		$data2 = [];
		$data3 = [];
		$data4 = [];
		$total = 0;
		if (!empty($adminId) || !empty($gmId) || !empty($managerId)) {
			$kfis = Kfi::find()
				->where(["status" => [1, 2, 4]])
				->asArray()
				->orderBy('updateDateTime DESC')
				->all();
		}
		if (!empty($supervisorId) || !empty($teamLeaderId) || !empty($staffId)) {
			if ($supervisorId != '') {
				$userId = $supervisorId;
			}
			if ($teamLeaderId != '') {
				$userId = $teamLeaderId;
			}
			if ($staffId != '') {
				$userId = $staffId;
			}
			$employeeId = Employee::employeeId($userId);
			$companyId = Employee::EmployeeDetail($employeeId)["companyId"];
			$kfis = Kfi::find()
				->where([
					"status" => [1, 2, 4],
					"companyId" => $companyId
				])
				->asArray()
				->orderBy('updateDateTime DESC')
				->all();
		}
		if (isset($kfis) && count($kfis) > 0) {
			foreach ($kfis as $kfi) :
				$commonData = [];
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
				if (strlen($kfi["kfiName"]) > 34) {
					$kfiname = substr($kfi["kfiName"], 0, 34) . '. . .';
				} else {
					$kfiname = $kfi["kfiName"];
				}
				$isOver = ModelMaster::isOverDuedate(Kfi::nextCheckDate($kfi['kfiId']));
				$kfiId = $kfi["kfiId"];
				// $commonData = [
				// 	"kfiName" => $kfiname,
				// 	"companyName" => Company::companyName($kfi['companyId']),
				// 	"companyId" => $kfi['companyId'],
				// 	"branchName" => Branch::kfiBranchName($kfi["kfiId"]),
				// 	"kfiBranch" => KfiBranch::kfiBranch($kfi["kfiId"]),
				// 	//"kfiEmployee" => KfiEmployee::kfiEmployee($kfi["kfiId"]),
				// 	"quantRatio" => "",
				// 	"creater" => User::employeeNameByuserId($kfi["createrId"]),
				// 	"target" => $kfi['targetAmount'],
				// 	"code" => "",
				// 	"result" => "",
				// 	"ratio" => 0,
				// 	"unit" => Unit::unitName($kfi['unitId']),
				// 	"month" => ModelMaster::monthEng($kfi['month'], 1),
				// 	"amountType" => "",
				// 	"status" => $kfi['status'],
				// 	"nextCheck" => "",
				// 	"checkDate" => "",
				// 	"countryName" => Country::countryNameBycompany($kfi['companyId']),
				// 	"flag" => Country::countryFlagBycompany($kfi['companyId']),
				// 	"isOver" => 0,
				// 	"fromDate" => "",
				// 	"toDate" => "",
				// 	"active" => $kfi["active"],
				// 	"countKfiHasKgi" => KfiHasKgi::countKgiInkfi($kfi["kfiId"]),
				// 	"kfiEmployee" => $selectPic,
				// 	//"countEmployee" => count($allEmployee),

				// 	"countEmployee" => count(KfiEmployee::kfiEmployeeByMonth($kfi["kfiId"], $kfi["month"], $kfi["year"])),

				// ];
				$kfiHistory = KfiHistory::find()
					->where(["kfiId" => $kfi["kfiId"], "status" => [1, 2]])
					->orderBy('year DESC,month DESC,status DESC,createDateTime DESC')
					->asArray()
					->one();
				if (!isset($kfiHistory) || empty($kfiHistory)) {
					$kfiHistory = Kfi::find()
						->where(["kfiId" => $kfi["kfiId"], "status" => [1, 2]])
						->asArray()
						->one();
				}
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
					$commonData = [
						"kfiName" => $kfiname,
						"companyName" => Company::companyName($kfi['companyId']),
						"companyId" => $kfi['companyId'],
						"branchName" => Branch::kfiBranchName($kfi["kfiId"]),
						//"kfiEmployee" => KfiEmployee::kfiEmployee($kfi["kfiId"]),
						"kfiBranch" => KfiBranch::kfiBranch($kfi["kfiId"]),
						"target" => $kfi['targetAmount'],
						"unit" => Unit::unitName($kfi['unitId']),
						"month" => ModelMaster::monthEng($kfi['month'], 1),
						"creater" => User::employeeNameByuserId($kfiHistory["createrId"]),
						"status" => $kfiHistory['status'],
						"quantRatio" => $kfiHistory["quantRatio"],
						"code" =>  $kfiHistory["code"],
						"result" => $kfiHistory["result"],
						"ratio" => number_format($ratio, 2),
						//"ratio" => number_format('1000.00', 2),
						"nextCheck" => ModelMaster::engDate($kfiHistory["nextCheckDate"], 2),
						"checkDate" => ModelMaster::engDate($kfiHistory["checkPeriodDate"], 2),
						"amountType" => $kfiHistory["amountType"],
						"countryName" => Country::countryNameBycompany($kfi['companyId']),
						"flag" => Country::countryFlagBycompany($kfi['companyId']),
						"isOver" => $isOver,
						"fromDate" => ModelMaster::engDate($kfiHistory["fromDate"], 2),
						"toDate" => ModelMaster::engDate($kfiHistory["toDate"], 2),
						"active" => $kfi["active"],
						"countKfiHasKgi" => KfiHasKgi::countKgiInkfi($kfi["kfiId"]),
						"kfiEmployee" => $selectPic,
						//"countEmployee" => count($allEmployee),
						"countEmployee" => count(KfiEmployee::kfiEmployeeByMonth($kfi["kfiId"], $kfi["month"], $kfi["year"])),
						"aa" => $kfiHistory['kfiHistoryId'],
						"lastestUpdate" => ModelMaster::engDate($kfi["updateDateTime"], 2)
					];
					if (($kfiHistory["fromDate"] == "" || $kfiHistory["toDate"] == "") && $isOver == 2) {
						$data1[$kfiId] = $commonData;
					} elseif ($isOver == 1 && $kfi["status"] == 1) {
						$data2[$kfiId] = $commonData;
					} elseif ($kfi["status"] == 2) {
						$data4[$kfiId] = $commonData;
					} else {
						$data3[$kfiId] = $commonData;
					}
					$total++;
				}

			endforeach;
		}
		$data = $data1 + $data2 + $data3 + $data4;
		if (isset($limit)) {
			$data = array_slice($data, $startAt, $limit, true);
		}
		$result["data"] = $data;
		$result["total"] = $total;
		return json_encode($result);
	}
	public function actionKfiDetail($kfiId, $kfiHistoryId)
	{
		$res = [];
		$res2 = [];
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
		$res["monthName"] = !empty($kfi['month']) ? strtoupper(ModelMaster::monthEng($kfi['month'], 1)) : '0';
		$res["month"] = $kfi['month'];
		$res["unit"] = Unit::unitName($kfi['unitId']);
		$res["countryName"] = Country::countryNameBycompany($kfi['companyId']);
		$res["flag"] = Country::countryFlagBycompany($kfi["companyId"]);
		$res["active"] = $kfi["active"];
		$res["branch"] = KfiBranch::kfiBranchShort($kfiId);
		$res["kfiEmployeeDetail"] = KfiEmployee::kfiEmployeeDetail($kfi["kfiId"]);

		if ($kfiHistoryId == 0) {
			$kfiHistory = KfiHistory::find()
				->where(["kfiId" => $kfiId, "status" => [1, 2]])
				->orderBy('kfiHistoryId DESC')
				->asArray()
				->one();
		} else {
			$kfiHistory = KfiHistory::find()
				->where(["kfiHistoryId" => $kfiHistoryId])
				->asArray()
				->one();
		}
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
			$res["monthFullName"] = ModelMaster::monthEng($kfiHistory['month'], 1);
			$res2["fromDate"] = $kfiHistory["fromDate"];
			$res2["toDate"] = $kfiHistory["toDate"];
			$res2["fromDateDetail"] = ModelMaster::engDate($kfiHistory["fromDate"], 2);
			$res2["toDateDetail"] = ModelMaster::engDate($kfiHistory["toDate"], 2);
			$res2["lastUpdate"] = ModelMaster::dateNumber($kfiHistory["updateDateTime"]);
			$res["status"] = $kfiHistory["status"];
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
	public function actionKfiHistory($kfiId, $kfiHistoryId)
	{
		if ($kfiHistoryId == 0) {
			$kfiHistory = KfiHistory::find()
				->where(["kfiId" => $kfiId, "status" => [1, 2, 4]])
				->orderBy('year DESC,month DESC,kfiHistoryId DESC')
				->asArray()
				->all();
		} else {
			$mainHistory = KfiHistory::find()
				->where(["kfiHistoryId" => $kfiHistoryId])
				->asArray()
				->one();
			$month = $mainHistory["month"];
			$year = $mainHistory["year"];
			$kfiHistory = KfiHistory::find()
				->where(["kfiId" => $kfiId, "status" => [1, 2, 4]])
				->andWhere("year<=$year")
				->orderBy('year DESC,month DESC,kfiHistoryId DESC')
				->asArray()
				->all();
		}
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
	public function actionKfiHistoryForChart($kfiId, $kfiHistoryId)
	{
		if ($kfiHistoryId == 0) {
			$kfiHistory = KfiHistory::find()
				->where(["kfiId" => $kfiId, "status" => [1, 2, 4]])
				->orderBy('year ASC,month ASC,kfiHistoryId DESC')
				->asArray()
				->all();
		} else {
			$mainHistory = KfiHistory::find()
				->where(["kfiHistoryId" => $kfiHistoryId])
				->asArray()
				->one();
			$month = $mainHistory["month"];
			$year = $mainHistory["year"];
			$kfiHistory = KfiHistory::find()
				->where(["kfiId" => $kfiId, "status" => [1, 2, 4]])
				->andWhere("year<=$year")
				->orderBy('year ASC,month ASC,kfiHistoryId DESC')
				->asArray()
				->all();
		}
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
			->select('kfi_history.kfiHistoryId,
			kfi_history.month,
			kfi_history.year,
			kfi_history.status,
			k.kfiName,
			kfi_history.result,
			kfi_history.kfiId,
			kfi_history.target,
			kfi_history.unitId,
			kfi_history.code,
			kfi_history.quantRatio,
			kfi_history.checkPeriodDate,
			kfi_history.nextCheckDate,
			kfi_history.amountType,
			kfi_history.fromDate,
			kfi_history.toDate,
			k.active,
			k.companyId')
			->JOIN("LEFT JOIN", "kfi k", "k.kfiId=kfi_history.kfiId")
			->where(["kfi_history.kfiId" => $kfiId])
			->andWhere("kfi_history.status!=99")
			->orderBy("kfi_history.year DESC,kfi_history.month DESC,status DESC,kfiHistoryId DESC")
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
				if (!isset($data[$history["year"]][$history["month"]]) || count($data[$history["year"]][$history["month"]]) == 0) {
					$ratio = 0;
					if ($history["code"] == '<' || $history["code"] == '=') {
						if ($history["target"] != 0) {
							$ratio = ((int)$history['result'] / (int)$history["target"]) * 100;
						}
					} else {
						if ($history["result"] != '' && $history["result"] != 0) {
							$ratio = ((int)$history["target"] / (int)$history["result"]) * 100;
						} else {
							$ratio = 0;
						}
					}
					$data[$history["year"]][$history["month"]] = [
						"kfiHistoryId" => $history["kfiHistoryId"],
						"kfiName" => $history["kfiName"],
						"companyId" => $history['companyId'],
						"target" => $history["target"],
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
						//"employee" => count($allEmployee),
						"employee" => count(KfiEmployee::kfiEmployeeByMonth($kfiId, $history["month"], $history["year"])),
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
	public function actionKfiFilter($companyId, $branchId, $month, $status, $year, $active, $adminId, $gmId, $managerId, $supervisorId, $teamLeaderId, $staffId, $currentPage, $limit)
	{
		$startAt = (($currentPage - 1) * $limit);
		$data = [];
		$data1 = [];
		$data2 = [];
		$data3 = [];
		$data4 = [];
		$total = 0;
		$searchStatus = '';
		if ($status == 1 || $status == 3 || $status == 4) {
			$searchStatus = 1;
		}
		if ($status == 2) {
			$searchStatus = 2;
		}
		if (!empty($adminId) || !empty($gmId) || !empty($managerId)) {
			$kfis = Kfi::find()
				->select('kfi.*,kb.kfiId')
				->JOIN("LEFT JOIN", "kfi_branch kb", "kb.kfiId=kfi.kfiId")
				->JOIN("LEFT JOIN", "company c", "c.companyId=kfi.companyId")
				->where(["c.status" => 1, "kfi.status" => [1, 2, 4]])
				->andFilterWhere([
					"kfi.companyId" => $companyId,
					"kb.branchId" => $branchId,
					"kfi.active" => isset($active) ? $active : null
				])
				->orderBy('kfi.createDateTime DESC')
				->asArray()
				->all();
		}
		if (!empty($supervisorId) || !empty($teamLeaderId) || !empty($staffId)) {
			if ($supervisorId != '') {
				$userId = $supervisorId;
			}
			if ($teamLeaderId != '') {
				$userId = $teamLeaderId;
			}
			if ($staffId != '') {
				$userId = $staffId;
			}
			$employeeId = Employee::employeeId($userId);
			$companyId = Employee::EmployeeDetail($employeeId)["companyId"];
			$kfis = Kfi::find()
				->select('kfi.*,kb.kfiId')
				->JOIN("LEFT JOIN", "kfi_branch kb", "kb.kfiId=kfi.kfiId")
				->JOIN("LEFT JOIN", "company c", "c.companyId=kfi.companyId")
				->where(["c.status" => 1, "kfi.companyId" => $companyId, "kfi.status" => [1, 2, 4]])
				->andFilterWhere([
					"kb.branchId" => $branchId,
					"kfi.active" => isset($active) ? $active : null
				])
				->orderBy('kfi.createDateTime DESC')
				->asArray()
				->all();
		}
		if (isset($kfis) && count($kfis) > 0) {
			foreach ($kfis as $kfi) :
				$show = 0;
				$commonData = [];
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
				if (strlen($kfi["kfiName"]) > 34) {
					$kfiname = substr($kfi["kfiName"], 0, 34) . '. . .';
				} else {
					$kfiname = $kfi["kfiName"];
				}

				$kfiHistory = KfiHistory::find()
					->where(["kfiId" => $kfi["kfiId"], "status" => [1, 2]])
					->andFilterWhere([
						"month" => $month,
						"year" => $year,
						"status" => $searchStatus
					])
					->orderBy('year DESC,month DESC,status DESC,createDateTime DESC')
					->asArray()
					->one();
				$checkComplete = 0;
				if ($status == 1) {
					$checkComplete = Kfi::checkComplete($kfi["kfiId"], $month, $year, $kfi["month"], $kfi["year"]);
				}

				//throw new exception(print_r($kfiHistory, true));
				// if (!isset($kfiHistory) || empty($kfiHistory) || $checkComplete == 1) {
				// 	$kfiHistory = Kfi::find()
				// 		->where(["kfiId" => $kfi["kfiId"], "status" => [1, 2]])
				// 		->andFilterWhere([
				// 			"month" => $month,
				// 			"status" => $searchStatus,
				// 			"year" => $year,
				// 		])
				// 		->asArray()
				// 		->one();
				// }
				if (isset($kfiHistory) && !empty($kfiHistory) && $checkComplete == 0) {
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
						}
					}
					if ($kfi["status"] == 2) {
						$isOver = 0;
					} else {
						if ($kfi["status"] == 1 && $kfi["year"] > $year && $year != '') {
							$isOver = 0;
						} else {
							$isOver = ModelMaster::isOverDuedate($kfiHistory["nextCheckDate"]);
						}
					}
					$kfiId = $kfi["kfiId"];
					if ($status == 1 && $isOver == 0 && $kfi["status"] == 1) {
						$show = 1;
					} else if ($status == 3 && $isOver == 1) {
						$show = 1;
					} else if ($status == 4 && $isOver == 2) {
						$show = 1;
					} else if ($status == 2 && $kfiHistory["status"] == 2) {
						$show = 1;
					} elseif ($status == '') {
						$show = 1;
					}
					if ($show == 1) {
						$commonData = [
							"kfiName" => $kfiname,
							"companyName" => Company::companyName($kfi['companyId']),
							"branchName" => Branch::kfiBranchName($kfi["kfiId"]),
							"companyId" => $kfi['companyId'],
							"kfiBranch" => KfiBranch::kfiBranch($kfi["kfiId"]),
							"target" => $kfiHistory['target'],
							"unit" => Unit::unitName($kfi['unitId']),
							"month" => ModelMaster::monthEng($kfiHistory['month'], 1),
							"status" => $kfiHistory['status'],
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
							"isOver" => $isOver,
							"active" => $kfi["active"],
							"countKfiHasKgi" => KfiHasKgi::countKgiInkfi($kfi["kfiId"]),
							"kfiEmployee" => $selectPic,
							"countEmployee" => count($allEmployee),
							"lastestUpdate" => ModelMaster::engDate($kfiHistory["updateDateTime"], 2)
						];
					}
					if (!empty($commonData)) {
						if (($kfiHistory["fromDate"] == "" || $kfiHistory["toDate"] == "") && $isOver == 2) {
							$data1[$kfiId] = $commonData;
						} elseif ($isOver == 1 && $kfi["status"] == 1) {
							$data2[$kfiId] = $commonData;
						} elseif ($kfi["status"] == 2) {
							$data4[$kfiId] = $commonData;
						} else {
							$data3[$kfiId] = $commonData;
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
	public function actionKfiHasKgi($kfiId)
	{
		$kfiHasKgi = KfiHasKgi::find()
			->select('kgi.kgiName,kgi.kgiId,kgi.unitId,kgi.targetAmount,kgi.month,kgi.year,kgi.code,kgi.result')
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
		$data = [];
		if (isset($kfiHasKgi) && count($kfiHasKgi) > 0) {
			foreach ($kfiHasKgi as $kgi):
				$ratio = 0;
				if ($kgi["targetAmount"] != '' && $kgi["targetAmount"] != 0 && $kgi["targetAmount"] != null) {
					if ($kgi["code"] == '<' || $kgi["code"] == '=') {
						$ratio = ($kgi["result"] / $kgi["targetAmount"]) * 100;
					} else {
						if ($kgi["result"] != '' && $kgi["result"] != 0) {
							$ratio = ($kgi["targetAmount"] / $kgi["result"]) * 100;
						} else {
							$ratio = 0;
						}
					}
				}
				$data[$kgi["kgiId"]] = [
					"kgiName" => $kgi["kgiName"],
					"kgiId" => $kgi["kgiId"],
					"unitId" => $kgi["unitId"],
					"targetAmount" => number_format($kgi["targetAmount"], 2),
					"code" => $kgi["code"],
					"result" => $kgi["result"],
					"unit" => Unit::unitName($kgi["unitId"]),
					"month" => ModelMaster::monthEng($kgi['month'], 1),
					"ratio" => number_format($ratio, 2),
					"countTeam" => KgiTeam::kgiTeam($kgi["kgiId"], $kgi["month"], $kgi["year"]),
				];
			endforeach;
		}

		return json_encode($data);
	}
	public function actionKfiBranch($kfiId)
	{
		$kfiBranch = KfiBranch::kfiBranch($kfiId);
		return json_encode($kfiBranch);
	}
	public function actionKfiTeamEmployee($kfiId, $companyId)
	{
		$employeeInTeam = Employee::find()
			->select('t.teamId,t.teamName,employee.employeeFirstname,employee.employeeSurename,employee.employeeId,ti.titleName,employee.picture,employee.gender,d.departmentName')
			->JOIN('LEFT JOIN', "team t", "employee.teamId=t.teamId")
			->JOIN('LEFT JOIN', "department d", "d.departmentId=t.departmentId")
			->JOIN("LEFT JOIN", "branch b", "b.branchId=d.branchId")
			->JOIN("LEFT JOIN", "title ti", "ti.titleId=employee.titleId")
			->where([
				"employee.status" => 1,
				"d.status" => 1,
				"b.status" => 1,
				"b.companyId" => $companyId
			])
			->orderBy("t.teamName")
			->asArray()
			->all();
		$data = [];
		$totalEmployee = 0;
		$totalTargetAll = 0;
		$kfi = Kfi::find()->where(["kfiId" => $kfiId])->asArray()->one();
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
					->where(["employeeId" => $employee["employeeId"], "kfiId" => $kfiId, "month" => $kfi["month"], "year" => $kfi["year"]])
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
				if ($employee["teamId"] != null) {
					$data[$employee["teamId"]]["employee"][$employee["employeeId"]] = [
						"employeeFirstname" => $employee["employeeFirstname"],
						"employeeSurename" => $employee["employeeSurename"],
						"target" => $target,
						"picture" => $img,
						"checked" => $checked,
						"titleName" => $employee["titleName"]
					];
				}
				/*if (isset($totalTeam[$employee["teamId"]]["total"]) && $totalTeam[$employee["teamId"]]["total"] != null) {
					$totalTeam[$employee["teamId"]]["total"] += $kfiEmployee["target"];
				} else {
					$totalTeam[$employee["teamId"]]["total"] = $kfiEmployee["target"];
				}*/
				if (!isset($data[$employee["teamId"]]["team"])) {
					if ($employee["teamId"] != null) {
						$data[$employee["teamId"]]["team"] = [
							"teamName" => $employee["teamName"],
							"departmentName" => $employee["departmentName"]
						];
					}
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
