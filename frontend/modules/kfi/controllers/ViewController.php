<?php

namespace frontend\modules\kfi\controllers;

use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\UserRole;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `kgi` module
 */
class ViewController extends Controller
{
	public function beforeAction($action)
	{
		if (!Yii::$app->user->id) {
			return $this->redirect(Yii::$app->homeUrl . 'site/login');
		}
		return true;
	}
	public function actionIndex($hash)
	{
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		$role = UserRole::userRight();
		$param = ModelMaster::decodeParams($hash);
		$kfiId = $param["kfiId"];
		$role = UserRole::userRight();
		$adminId = '';
		$gmId = '';
		$teamLeaderId = '';
		$managerId = '';
		$supervisorId = '';
		$staffId = '';
		if ($role == 7) {
			$adminId = Yii::$app->user->id;
		}
		if ($role == 6) {
			$gmId = Yii::$app->user->id;
		}
		if ($role == 5) {
			$managerId = Yii::$app->user->id;
		}
		if ($role == 4) {
			$supervisorId = Yii::$app->user->id;
		}
		if ($role == 3) {
			$teamLeaderId = Yii::$app->user->id;
		}
		if ($role == 1 || $role == 2) {
			$staffId = Yii::$app->user->id;
			//return $this->redirect(Yii::$app->homeUrl);
		}
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kfi/management/kfi-detail?kfiId=' . $kfiId);
		$kfiDetail = curl_exec($api);
		$kfiDetail = json_decode($kfiDetail, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$companies = curl_exec($api);
		$companies = json_decode($companies, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/unit/all-unit');
		$units = curl_exec($api);
		$units = json_decode($units, true);

		$months = ModelMaster::monthFull(1);
		$isManager = UserRole::isManager();

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kfi/management/kfi-history-summarize?kfiId=' . $kfiId);
		//curl_setopt($api, CURLOPT_URL, Path::Api() . 'kfi/management/index?adminId=' . $adminId . '&&gmId=' . $gmId . '&&managerId=' . $managerId . '&&supervisorId=' . $supervisorId . '&&teamLeaderId=' . $teamLeaderId . '&&staffId=' . $staffId);
		$kfis = curl_exec($api);
		$kfis = json_decode($kfis, true);
		curl_close($api);
		// throw new Exception(print_r($kfis, true));

		return $this->render('kfi_view', [
			"role" => $role,
			"kfiDetail" => $kfiDetail,
			"kfis" => $kfis,
			"kfiId" => $kfiId,
			"companies" => $companies,
			"units" => $units,
			"months" => $months,
			"isManager" => $isManager
		]);
	}
	public function actionKfiHistory($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$role = UserRole::userRight();
		$kfiId = $param["kfiId"];
		$openTab = array_key_exists("openTab", $param) ? $param["openTab"] : 0;
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kfi/management/kfi-detail?kfiId=' . $kfiId);
		$kfiDetail = curl_exec($api);
		$kfiDetail = json_decode($kfiDetail, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$companies = curl_exec($api);
		$companies = json_decode($companies, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/unit/all-unit');
		$units = curl_exec($api);
		$units = json_decode($units, true);

		curl_close($api);
		$months = ModelMaster::monthFull(1);
		$isManager = UserRole::isManager();
		//throw new Exception(print_r($kfiTeams, true));
		return $this->render('kfi_history', [
			"role" => $role,
			"kfiDetail" => $kfiDetail,
			"kfiId" => $kfiId,
			"openTab" => $openTab,
			"months" => $months,
			"isManager" => $isManager,
			"units" => $units,
			"companies" => $companies,
		]);
	}
	public function actionKfiEmployee()
	{
		$kfiId = $_POST["kfiId"];
		$res["kfiEmployeeTeam"] = "";
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kfi/management/kfi-detail?kfiId=' . $kfiId);
		$kfiDetail = curl_exec($api);
		$kfiDetail = json_decode($kfiDetail, true);
		curl_close($api);
		$res["kfiEmployeeTeam"] = $this->renderAjax("kfi_employee", [
			"kfiDetail" => $kfiDetail

		]);
		return json_encode($res);
	}
	public function actionAllKfiHistory()
	{
		$kfiId = $_POST["kfiId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kfi/management/kfi-history?kfiId=' . $kfiId);
		$history = curl_exec($api);
		$history = json_decode($history, true);
		curl_close($api);
		$monthDetail = [];
		$summarizeMonth = [];
		$res["monthlyDetailHistoryText"] = "";
		if (isset($history) && count($history) > 0) {
			//krsort($history);
			foreach ($history as $kfiHistoryId => $ht):
				if (isset($monthDetail[$ht["year"]][$ht["month"]])) {
					$totalCount = count($monthDetail[$ht["year"]][$ht["month"]]);
					$monthDetail[$ht["year"]][$ht["month"]][$totalCount] = [
						"creater" => $ht["creater"],
						"title" => $ht["title"],
						"status" => $ht["status"],
						"picture" => $ht["picture"],
						"result" => $ht["result"],
						"createDateTime" => $ht["createDate"]
					];
				} else {
					$monthDetail[$ht["year"]][$ht["month"]][0] = [
						"creater" => $ht["creater"],
						"title" => $ht["title"],
						"status" => $ht["status"],
						"picture" => $ht["picture"],
						"result" => $ht["result"],
						"createDateTime" => $ht["createDate"]
					];
					$summarizeMonth[$ht["year"]][$ht["month"]] = [
						"year" => $ht["year"],
						"month" => ModelMaster::fullMonthText($ht["month"]),
						"result" => $ht["result"],
						"target" => $ht["target"],
						"kfiHistoryId" => $kfiHistoryId

					];
				}
			endforeach;
			$res["monthlyDetailHistoryText"] = $this->renderAjax('kfi_update_history', [
				"monthDetail" => $monthDetail,
				"summarizeMonth" => $summarizeMonth
			]);
		}
		return json_encode($res);
	}
	public function actionKfiChart()
	{
		$kfiId = $_POST["kfiId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kfi/management/kfi-history?kfiId=' . $kfiId);
		$history = curl_exec($api);
		$history = json_decode($history, true);
		curl_close($api);
		$monthDetail = [];
		$summarizeMonth = [];
		$year = 2024;
		$months = ModelMaster::month();
		$monthText = '';
		$target = [];
		$targetText = "";
		$resultText = "";
		$result = [];
		//ksort($month);
		$res["monthlyDetailHistoryText"] = "";


		if (isset($history) && count($history) > 0) {
			foreach ($history as $kfiHistoryId => $ht):
				if (!isset($summarizeMonth[$ht["year"]][$ht["month"]])) {
					$summarizeMonth[$ht["year"]][$ht["month"]] = [
						"year" => $ht["year"],
						"month" => ModelMaster::fullMonthText($ht["month"]),
						"result" => $ht["result"],
						"target" => $ht["target"],
						"kfiHistoryId" => $kfiHistoryId
					];
				}
			endforeach;
		}
		foreach ($months as $index => $month):
			if (isset($summarizeMonth[$year][$index])) {
				$target[$index] = $summarizeMonth[$year][$index]["target"];
				$result[$index] = $summarizeMonth[$year][$index]["result"];
			} else {
				$target[$index] = 0;
				$result[$index] = 0;
			}
			$targetText .= $target[$index] . ',';
			$resultText .= $result[$index] . ',';
			$monthText .= '"' . $month . '",';
		endforeach;
		$monthText = substr($monthText, 0, -1);
		$targetText = substr($targetText, 0, -1);
		$resultText = substr($resultText, 0, -1);
		//throw new Exception($resultText);
		//throw new Exception(print_r($summarizeMonth, true));
		$res["kfiChart"] = $this->renderAjax('kfi_chart', [
			"month" => $monthText,
			"target" => $targetText,
			"result" => $resultText
		]);
		return json_encode($res);
	}
	public function actionKfiKgi()
	{
		$role = UserRole::userRight();
		$adminId = '';
		$gmId = '';
		$teamLeaderId = '';
		$managerId = '';
		$supervisorId = '';
		$staffId = '';
		if ($role == 7) {
			$adminId = Yii::$app->user->id;
		}
		if ($role == 6) {
			$gmId = Yii::$app->user->id;
		}
		if ($role == 5) {
			$managerId = Yii::$app->user->id;
		}
		if ($role == 4) {
			$supervisorId = Yii::$app->user->id;
		}
		if ($role == 3) {
			$teamLeaderId = Yii::$app->user->id;
		}
		if ($role == 1 || $role == 2) {
			$staffId = Yii::$app->user->id;
			//return $this->redirect(Yii::$app->homeUrl . 'kpi/kpi-personal/individual-kpi');
		}
		$kfiId = $_POST["kfiId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kfi/management/kfi-has-kgi?kfiId=' . $kfiId);
		$kfiHasKgi = curl_exec($api);
		$kfiHasKgi = json_decode($kfiHasKgi, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kfi/management/kfi-detail?kfiId=' . $kfiId);
		$kfiDetail = curl_exec($api);
		$kfiDetail = json_decode($kfiDetail, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/index?adminId=' . $adminId . '&&gmId=' . $gmId . '&&managerId=' . $managerId . '&&supervisorId=' . $supervisorId . '&&teamLeaderId=' . $teamLeaderId . '&&staffId=' . $staffId);
		$kgis = curl_exec($api);
		$kgis = json_decode($kgis, true);


		$ghp = [];
		if (count($kfiHasKgi) > 0) {
			foreach ($kfiHasKgi as $fg):
				$ghp[$fg["kgiId"]] = 1;
			endforeach;
		}

		curl_close($api);

		$res["kgi"] = $this->renderAjax('kfi_kgi', [
			"kfiHasKgi" => $kfiHasKgi,
			"kfiId" => $kfiId,
			"kfiDetail" => $kfiDetail,
			"kgis" => $kgis,
			"ghp" => $ghp
		]);

		return json_encode($res);
	}
	public function actionKfiHasKgi()
	{
		$role = UserRole::userRight();
		$adminId = '';
		$gmId = '';
		$teamLeaderId = '';
		$managerId = '';
		$supervisorId = '';
		$staffId = '';
		if ($role == 7) {
			$adminId = Yii::$app->user->id;
		}
		if ($role == 6) {
			$gmId = Yii::$app->user->id;
		}
		if ($role == 5) {
			$managerId = Yii::$app->user->id;
		}
		if ($role == 4) {
			$supervisorId = Yii::$app->user->id;
		}
		if ($role == 3) {
			$teamLeaderId = Yii::$app->user->id;
		}
		if ($role == 1 || $role == 2) {
			$staffId = Yii::$app->user->id;
			//return $this->redirect(Yii::$app->homeUrl . 'kpi/kpi-personal/individual-kpi');
		}
		$kfiId = $_POST["kfiId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kfi/management/kfi-has-kgi?kfiId=' . $kfiId);
		$kfiHasKgi = curl_exec($api);
		$kfiHasKgi = json_decode($kfiHasKgi, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kfi/management/kfi-detail?id=' . $kfiId);
		$kfiDetail = curl_exec($api);
		$kfiDetail = json_decode($kfiDetail, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/index?adminId=' . $adminId . '&&gmId=' . $gmId . '&&managerId=' . $managerId . '&&supervisorId=' . $supervisorId . '&&teamLeaderId=' . $teamLeaderId . '&&staffId=' . $staffId);
		$kgis = curl_exec($api);
		$kgis = json_decode($kgis, true);


		$ghp = [];
		// if (count($kgiHasKpi) > 0) {
		// 	foreach ($kgiHasKpi as $gp):
		// 		$ghp[$gp["kpiId"]] = 1;
		// 	endforeach;
		// }

		curl_close($api);

		$res["kgi"] = $this->renderAjax('kgi', [
			"kfiHasKgi" => $kfiHasKgi,
			"kfiId" => $kfiId,
			"kfiDetail" => $kfiDetail,
			"kgis" => $kgis,
			"ghp" => $ghp
		]);

		return json_encode($res);
	}
}