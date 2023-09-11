<?php

namespace backend\modules\kfi\controllers;

use backend\models\hrvc\Branch;
use backend\models\hrvc\Company;
use backend\models\hrvc\Kfi;
use backend\models\hrvc\KfiHistory;
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
		$data = [];
		$kfis = Kfi::find()->where(["status" => [1, 2]])->asArray()->all();
		if (isset($kfis) && count($kfis) > 0) {
			foreach ($kfis as $kfi) :
				$data[$kfi["kfiId"]] = [
					"kfiName" => $kfi["kfiName"],
					"companyName" => Company::companyName($kfi['companyId']),
					"branchName" => Branch::branchName($kfi['branchId']),
					"quantRatio" => "",
					"target" => $kfi['targetAmount'],
					"code" => "",
					"result" => "",
					"ratio" => 0,
					"unit" => $kfi['unitId'],
					"month" => ModelMaster::monthEng($kfi['month'], 1),
					"nextCheck" => "",
					"amountType" => "",
					"status" => $kfi['status'],
					"quantRatio" => "",
					"code" =>  "",
					"result" => "",
					"ratio" => 0,
					"nextCheck" => "",
					"amountType" => "",
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
						"branchName" => Branch::branchName($kfi['branchId']),
						"quantRatio" => "",
						"target" => $kfi['targetAmount'],
						"code" => "",
						"result" => "",
						"unit" => $kfi['unitId'],
						"month" => ModelMaster::monthEng($kfi['month'], 1),
						"nextCheck" => "",
						"amountType" => "",
						"status" => $kfi['status'],
						"quantRatio" => $kfiHistory["quantRatio"],
						"code" =>  $kfiHistory["code"],
						"result" => $kfiHistory["result"],
						"ratio" => number_format($ratio, 2),
						"nextCheck" => ModelMaster::engDate($kfiHistory["nextCheckDate"]),
						"amountType" => $kfiHistory["amountType"],
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
		$res["branchName"] = Branch::branchName($kfi['branchId']);
		$res["unitId"] = $kfi["unitId"];
		$res["detail"] = $kfi["kfiDetail"];
		$res["targetAmount"] = $kfi["targetAmount"];
		$res["status"] = $kfi["status"];
		$res["monthName"] = strtoupper(ModelMaster::monthEng($kfi['month'], 1));

		$kfiHistory = KfiHistory::find()
			->where(["kfiId" => $kfiId, "status" => [1, 4]])
			->orderBy('kfiHistoryId DESC')
			->asArray()
			->one();
		if (isset($kfiHistory) && !empty($kfiHistory)) {
			$res2["quantRatio"] = $kfiHistory["quantRatio"];
			$res2["code"] =  $kfiHistory["code"];
			$res2["result"] = $kfiHistory["result"];
			$res2["amountType"] = $kfiHistory["amountType"];
			$res2["kfiStatus"] = $kfiHistory["historyStatus"];
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
	}
}
