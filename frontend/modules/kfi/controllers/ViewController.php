<?php

namespace frontend\modules\kfi\controllers;

use frontend\models\hrvc\KfiHistory;
use frontend\models\hrvc\Kfi;

use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
use frontend\components\Api;
use frontend\models\hrvc\Branch;
use frontend\models\hrvc\Company;
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
		$kfiDetail = Api::connectApi(Path::Api() . 'kfi/management/kfi-detail?kfiId=' . $kfiId . "&&kfiHistoryId=0");
		$companies = Api::connectApi(Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$units = Api::connectApi(Path::Api() . 'masterdata/unit/all-unit');


		$months = ModelMaster::monthFull(1);
		$isManager = UserRole::isManager();

		$kfis = Api::connectApi(Path::Api() . 'kfi/management/kfi-history-summarize?kfiId=' . $kfiId);
		$allCompany = Api::connectApi(Path::Api() . 'masterdata/company/all-company');


		$countAllCompany = 0;
		if (count($allCompany) > 0) {
			$countAllCompany = count($allCompany);
			$companyPic = Company::randomPic($allCompany, 3);
		}
		$totalBranch = Branch::totalBranch();

		return $this->render('kfi_view', [
			"role" => $role,
			"kfiDetail" => $kfiDetail,
			"kfis" => $kfis,
			"kfiId" => $kfiId,
			"companies" => $companies,
			"units" => $units,
			"months" => $months,
			"isManager" => $isManager,
			"allCompany" => $countAllCompany,
			"companyPic" => $companyPic,
			"totalBranch" => $totalBranch
		]);
	}
	public function actionKfiHistory($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$role = UserRole::userRight();
		$kfiId = $param["kfiId"];
		//$openTab = $param["openTab"];
		$openTab = array_key_exists("openTab", $param) ? $param["openTab"] : 0;
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		if (isset($param["kfiHistoryId"])) {
			$kfiHistoryId = $param["kfiHistoryId"];
		} else {
			$kfiHistoryId = 0;
		}
		$kfiDetail = Api::connectApi(Path::Api() . 'kfi/management/kfi-detail?kfiId=' . $kfiId . "&&kfiHistoryId=" . $kfiHistoryId);
		$companies = Api::connectApi(Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$units = Api::connectApi(Path::Api() . 'masterdata/unit/all-unit');
		$allCompany = Api::connectApi(Path::Api() . 'masterdata/company/all-company');


		$countAllCompany = 0;
		if (count($allCompany) > 0) {
			$countAllCompany = count($allCompany);
			$companyPic = Company::randomPic($allCompany, 3);
		}
		$totalBranch = Branch::totalBranch();
		$months = ModelMaster::monthFull(1);
		$isManager = UserRole::isManager();

		return $this->render('kfi_history', [
			"role" => $role,
			"kfiDetail" => $kfiDetail,
			"kfiId" => $kfiId,
			"openTab" => $openTab,
			"months" => $months,
			"isManager" => $isManager,
			"units" => $units,
			"companies" => $companies,
			"kfiHistoryId" => $kfiHistoryId,
			"totalBranch" => $totalBranch,
			"allCompany" => $countAllCompany,
			"companyPic" => $companyPic,
		]);
	}
	public function actionDeleteKfi()
	{
		$kfiId = $_POST["kfiId"];
		KfiHistory::updateAll(["status" => 99], ["kfiId" => $kfiId]);
		KfiHistory::updateAll(["status" => 99], ["kfiId" => $kfiId]);
		Kfi::updateAll(["status" => 99], ["kfiId" => $kfiId]);
		$res["status"] = true;
		return json_encode($res);
	}
	public function actionKfiEmployee()
	{
		$kfiId = $_POST["kfiId"];
		$res["kfiEmployeeTeam"] = "";
		$kfiDetail = Api::connectApi(Path::Api() . 'kfi/management/kfi-detail?kfiId=' . $kfiId . "&&kfiHistoryId=0");

		$res["kfiEmployeeTeam"] = $this->renderAjax("kfi_employee", [
			"kfiDetail" => $kfiDetail

		]);
		return json_encode($res);
	}
	public function actionAllKfiHistory()
	{
		$kfiId = $_POST["kfiId"];
		$kfiHistoryId = $_POST["kfiHistoryId"];
		$history = Api::connectApi(Path::Api() . 'kfi/management/kfi-history?kfiId=' . $kfiId . "&&kfiHistoryId=" . $kfiHistoryId);
		$monthDetail = [];
		$summarizeMonth = [];
		$res["monthlyDetailHistoryText"] = "";
		if ($kfiHistoryId != 0) {
			$kfiHistory = KfiHistory::find()
				->where(["kfiHistoryId" => $kfiHistoryId])
				->asArray()
				->one();
			$year = $kfiHistory["year"];
			$month = $kfiHistory["month"];
		} else {
			$year = '';
			$month = '';
		}
		if (isset($history) && count($history) > 0) {
			//krsort($history);
			foreach ($history as $kfiHistoryId => $ht):
				if ($year != '' && $month != '' && $ht["year"] <= $year) {
					if ($ht["year"] == $year) {
						if ($ht["month"] <= $month) {
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
						}
					} else {
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
					}
				} else {
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
				}
			endforeach;
			//throw new Exception(print_r($monthDetail, true));
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
		$kfiHistoryId = $_POST["kfiHistoryId"];
		$history = Api::connectApi(Path::Api() . 'kfi/management/kfi-history-for-chart?kfiId=' . $kfiId . "&&kfiHistoryId=" . $kfiHistoryId);
		$monthDetail = [];
		$summarizeMonth = [];
		//$year = 2024;
		$months = ModelMaster::month();
		$monthText = '';
		$target = [];
		$summarizeMonth2 = [];
		$targetText = "";
		$resultText = "";
		$result = [];
		//ksort($month);
		$res["monthlyDetailHistoryText"] = "";
		if ($kfiHistoryId != 0) {
			$kfiHistory = KfiHistory::find()
				->where(["kfiHistoryId" => $kfiHistoryId])
				->asArray()
				->one();
			$year = $kfiHistory["year"];
			$month = $kfiHistory["month"];
		} else {
			$year = '';
			$month = '';
		}
		if (isset($history) && count($history) > 0) {
			$i = 0;
			foreach ($history as $kfiHistoryId => $ht):
				if ($year != '' && $month != '' && $ht["year"] <= $year) {
					if ($ht["year"] == $year) {
						if ($ht["month"] <= $month) {
							if (!isset($summarizeMonth[$ht["year"]][$ht["month"]])) {
								$summarizeMonth[$ht["year"]][$ht["month"]] = [
									"year" => $ht["year"],
									"month" => ModelMaster::fullMonthText($ht["month"]),
									"result" => $ht["result"],
									"target" => $ht["target"],
									"kfiHistoryId" => $kfiHistoryId
								];
								$summarizeMonth2[$i] = [
									"year" => $ht["year"],
									"month" => ModelMaster::fullMonthText($ht["month"]),
									"result" => $ht["result"],
									"target" => $ht["target"],
									"kfiHistoryId" => $kfiHistoryId
								];
							}
						}
					} else {
						if (!isset($summarizeMonth[$ht["year"]][$ht["month"]])) {
							$summarizeMonth[$ht["year"]][$ht["month"]] = [
								"year" => $ht["year"],
								"month" => ModelMaster::fullMonthText($ht["month"]),
								"result" => $ht["result"],
								"target" => $ht["target"],
								"kfiHistoryId" => $kfiHistoryId
							];
							$summarizeMonth2[$i] = [
								"year" => $ht["year"],
								"month" => ModelMaster::fullMonthText($ht["month"]),
								"result" => $ht["result"],
								"target" => $ht["target"],
								"kfiHistoryId" => $kfiHistoryId
							];
						}
					}
				} else {
					if (!isset($summarizeMonth[$ht["year"]][$ht["month"]])) {
						$summarizeMonth[$ht["year"]][$ht["month"]] = [
							"year" => $ht["year"],
							"month" => ModelMaster::fullMonthText($ht["month"]),
							"result" => $ht["result"],
							"target" => $ht["target"],
							"kfiHistoryId" => $kfiHistoryId
						];
						$summarizeMonth2[$i] = [
							"year" => $ht["year"],
							"month" => ModelMaster::fullMonthText($ht["month"]),
							"result" => $ht["result"],
							"target" => $ht["target"],
							"kfiHistoryId" => $kfiHistoryId
						];
					}
				}
				$i++;
			endforeach;
		}
		$summarizeMonth2 = array_slice($summarizeMonth2, -8);
		foreach ($summarizeMonth2 as $index => $data):
			if ($index == 7) {
				if ($data["result"] != 0) {
					$target[$index] = $data["target"];
					$result[$index] = $data["result"];
					$targetText .= $target[$index] . ',';
					$resultText .= $result[$index] . ',';
					$monthText .= '"' . substr($data["month"], 0, 3) . substr($data["year"], -2) . '",';
				}
			} else {
				$target[$index] = $data["target"];
				$result[$index] = $data["result"];
				$targetText .= $target[$index] . ',';
				$resultText .= $result[$index] . ',';
				$monthText .= '"' . substr($data["month"], 0, 3) . substr($data["year"], -2) . '",';
			}

		endforeach;
		$monthText = substr($monthText, 0, -1);
		$targetText = substr($targetText, 0, -1);
		$resultText = substr($resultText, 0, -1);
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
		$kfiHasKgi = Api::connectApi(Path::Api() . 'kfi/management/kfi-has-kgi?kfiId=' . $kfiId);
		$kfiDetail = Api::connectApi(Path::Api() . 'kfi/management/kfi-detail?kfiId=' . $kfiId . "&&kfiHistoryId=0");



		$ghp = [];
		if (count($kfiHasKgi) > 0) {
			foreach ($kfiHasKgi as $fg):
				$ghp[$fg["kgiId"]] = 1;
			endforeach;
		}

		$res["kgi"] = $this->renderAjax('kfi_kgi', [
			"kfiHasKgi" => $kfiHasKgi,
			"kfiId" => $kfiId,
			"kfiDetail" => $kfiDetail,
			//"kgis" => $kgis,
			"ghp" => $ghp,
			"role" => $role
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
		$kfiHasKgi = Api::connectApi(Path::Api() . 'kfi/management/kfi-has-kgi?kfiId=' . $kfiId);
		$kfiDetail = Api::connectApi(Path::Api() . 'kfi/management/kfi-detail?id=' . $kfiId . "&&kfiHistoryId=0");
		$kgis = Api::connectApi(Path::Api() . 'kgi/management/index?adminId=' . $adminId . '&&gmId=' . $gmId . '&&managerId=' . $managerId . '&&supervisorId=' . $supervisorId . '&&teamLeaderId=' . $teamLeaderId . '&&staffId=' . $staffId);

		$ghp = [];

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
