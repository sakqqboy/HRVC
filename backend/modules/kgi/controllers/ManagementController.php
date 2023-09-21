<?php

namespace backend\modules\kgi\controllers;

use backend\models\hrvc\Branch;
use backend\models\hrvc\Company;
use backend\models\hrvc\Country;
use backend\models\hrvc\Kgi;
use backend\models\hrvc\KgiBranch;
use backend\models\hrvc\KgiDepartment;
use backend\models\hrvc\KgiHistory;
use backend\models\hrvc\KgiTeam;
use backend\models\hrvc\Unit;
use common\models\ModelMaster;
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
					"nextCheck" => "",
					"countTeam" => KgiTeam::kgiTeam($kgi["kgiId"]),
					"flag" => Country::countryFlagBycompany($kgi["companyId"]),
					"employee" => "",
					"countryName" => Country::countryNameBycompany($kgi['companyId']),
					//"team" => KgiTeam::kgiTeam($kgi["kgiId"])
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
			$data = [
				"kgiName" => $kgi["kgiName"],
				//"companyName" => Company::companyName($kgi["companyId"]),
				"companyId" => $kgi["companyId"],
				//"branch" => KgiBranch::kgiBranch($kgi["kgiId"]),
				"detail" => $kgiHistory['description'],
				"quantRatio" => $kgiHistory["quantRatio"],
				"targetAmount" => $kgiHistory["targetAmount"],
				"amountType" => $kgiHistory["amountType"],
				"code" => $kgiHistory["code"],
				"result" => $kgiHistory["result"],
				"unitId" => $kgiHistory["unitId"],
				"month" => $kgiHistory['month'],
				"priority" => $kgiHistory["priority"],
				"periodCheck" => $kgiHistory["periodDate"],
				"status" => $kgiHistory["status"],
				"nextCheck" => $kgiHistory["nextCheckDate"],
				"remark" => $kgiHistory["remark"],
				//"countTeam" => KgiTeam::kgiTeam($kgi["kgiId"]),
				//"flag" => Country::countryFlagBycompany($kgi["companyId"]),
				//"employee" => "",
				//"countryName" => Country::countryNameBycompany($kgi['companyId']),
				//"team" => KgiTeam::kgiTeam($kgi["kgiId"])
			];
		} else {
			$kgi = Kgi::find()->where(["kgiId" => $id])->asArray()->one();
			$data = [
				"kgiName" => $kgi["kgiName"],
				//"companyName" => Company::companyName($kgi["companyId"]),
				"companyId" => $kgi["companyId"],
				//"branch" => KgiBranch::kgiBranch($kgi["kgiId"]),
				"detail" => $kgi['kgiDetail'],
				"quantRatio" => $kgi["quantRatio"],
				"targetAmount" => $kgi["targetAmount"],
				"amountType" => $kgi["amountType"],
				"code" => $kgi["code"],
				"result" => $kgi["result"],
				"unitId" => $kgi["unitId"],
				"month" => $kgi['month'],
				"priority" => $kgi["priority"],
				"periodCheck" => $kgi["periodDate"],
				"status" => $kgi["status"],
				"nextCheck" => "",
				"remark" => "",
				//"countTeam" => KgiTeam::kgiTeam($kgi["kgiId"]),
				//"flag" => Country::countryFlagBycompany($kgi["companyId"]),
				//"employee" => "",
				//"countryName" => Country::countryNameBycompany($kgi['companyId']),
				//"team" => KgiTeam::kgiTeam($kgi["kgiId"])
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
}
