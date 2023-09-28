<?php

namespace backend\modules\kfi\controllers;

use backend\models\hrvc\Branch;
use backend\models\hrvc\Company;
use backend\models\hrvc\Country;
use backend\models\hrvc\Employee;
use backend\models\hrvc\Kfi;
use backend\models\hrvc\KfiHistory;
use backend\models\hrvc\KfiSolution;
use backend\models\hrvc\Unit;
use backend\models\hrvc\User;
use common\models\ModelMaster;
use Exception;
use frontend\models\hrvc\KfiIssue;
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
		$kfis = Kfi::find()->where(["status" => [1, 2]])->asArray()->all();
		if (isset($kfis) && count($kfis) > 0) {
			foreach ($kfis as $kfi) :
				$data[$kfi["kfiId"]] = [
					"kfiName" => $kfi["kfiName"],
					"companyName" => Company::companyName($kfi['companyId']),
					"branchName" => Branch::kfiBranchName($kfi["kfiId"]),
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
					"countryName" => Country::countryNameBycompany($kfi['companyId'])
				];
				$kfiHistory = KfiHistory::find()
					->where(["kfiId" => $kfi["kfiId"], "status" => [1, 4]])
					->orderBy('kfiHistoryId DESC')->one();
				if (isset($kfiHistory) && !empty($kfiHistory)) {
					if ($kfi["targetAmount"] == null || $kfi["targetAmount"] == '' || $kfi["targetAmount"] == 0) {
						$ratio = 0;
					} else {
						$ratio = ((int)$kfiHistory['result'] / (int)$kfi["targetAmount"]) * 100;
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
						"amountType" => $kfiHistory["amountType"],
						"countryName" => Country::countryNameBycompany($kfi['companyId'])
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
		$res["companyName"] = Company::companyName($kfi['companyId']);
		$res["branchName"] = Branch::kfiBranchName($kfiId);
		$res["unitId"] = $kfi["unitId"];
		$res["detail"] = $kfi["kfiDetail"];
		$res["targetAmount"] = number_format($kfi["targetAmount"], 2);
		$res["status"] = $kfi["status"];
		$res["monthName"] = strtoupper(ModelMaster::monthEng($kfi['month'], 1));
		$res["unit"] = Unit::unitName($kfi['unitId']);
		$res["countryName"] = Country::countryNameBycompany($kfi['companyId']);
		$res["flag"] = Country::countryFlagBycompany($kfi["companyId"]);

		$kfiHistory = KfiHistory::find()
			->where(["kfiId" => $kfiId, "status" => [1, 4]])
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
			if ($kfi["targetAmount"] == null || $kfi["targetAmount"] == '' || $kfi["targetAmount"] == 0) {
				$ratio = 0;
			} else {
				$ratio = ((int)$kfiHistory['result'] / (int)$kfi["targetAmount"]) * 100;
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
					"status" => $history["historyStatus"]
				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionKfiIssue($kfiId)
	{
		$kfiIssue = KfiIssue::find()
			->where(["status" => [1, 4], "kfiId" => $kfiId])
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
}
