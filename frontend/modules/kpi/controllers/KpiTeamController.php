<?php

namespace frontend\modules\kpi\controllers;

use frontend\models\hrvc\KpiHistory;
use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
use frontend\models\hrvc\Branch;
use frontend\models\hrvc\Company;
use frontend\models\hrvc\Department;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\Kpi;
use frontend\models\hrvc\KpiEmployee;
use frontend\models\hrvc\KpiEmployeeHistory;
use frontend\models\hrvc\KpiTeam;
use frontend\models\hrvc\KpiTeamHistory;
use frontend\models\hrvc\Team;
use frontend\models\hrvc\User;
use frontend\models\hrvc\Unit;
use frontend\models\hrvc\UserRole;
use Yii;
use yii\db\Expression;
use yii\web\Controller;

// header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
// header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
// header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
// header("Cache-Control: post-check=0, pre-check=0", false);
// header("Pragma: no-cache");
class KpiTeamController extends Controller
{
	public function beforeAction($action)
	{
		if (!Yii::$app->user->id) {
			return $this->redirect(Yii::$app->homeUrl . 'site/login');
		}
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		return true;
	}
	public function actionKpiTeamSetting($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$role = UserRole::userRight();
		if ($role < 3) {
			return $this->redirect(Yii::$app->homeUrl . 'kpi/management/index');
		}
		$kpiId = $param["kpiId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-team/kpi-team?kpiId=' . $kpiId);
		$kpiTeams = curl_exec($api);
		$kpiTeams = json_decode($kpiTeams, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/kpi-detail?id=' . $kpiId . '&&kpiHistoryId=0');
		$kpiDetail = curl_exec($api);
		$kpiDetail = json_decode($kpiDetail, true);
		curl_close($api);
		return $this->render('kpi_team_setting', [
			"kpiTeams" => $kpiTeams,
			"kpiDetail" => $kpiDetail,
			"kpiId" => $kpiId,
			"role" => $role
		]);
	}
	public function actionSetTeamTarget()
	{
		if (isset($_POST["kpiId"])) {
			if (isset($_POST["teamTerget"]) && count($_POST["teamTerget"])) {
				foreach ($_POST["teamTerget"] as $teamId => $target) :
					if ($_POST["role"] == 3) {
						$historyStatus = 88; //if team leder updated need to have the improvement from supervisor or mg
					} else {
						$historyStatus = 1;
					}
					if ($target != '') {
						$kpiTeam = KpiTeam::find()
							->where(["kpiId" => $_POST["kpiId"], "teamId" => $teamId])
							->one();
						if ($_POST["role"] != 3) { // higher than Team Leader, don't need to approve
							$target = str_replace(",", "", $target);
							$kpiTeam->target = $target;
							$kpiTeam->remark = $_POST["remark"][$teamId];
							$kpiTeam->updateDateTime = new Expression('NOW()');
							$kpiTeam->createrId = Yii::$app->user->id;
							$kpiTeam->save(false);
						}
						if ($kpiTeam->target != $target) {
							$history = KpiTeamHistory::find()
								->where(["kpiTeamId" => $kpiTeam->kpiTeamId, "status" => 88])
								->one();
							if (!isset($history) || empty($history)) {
								$history = new KpiTeamHistory();
								$history->createDateTime = new Expression('NOW()');
							}
							$history->kpiTeamId = $kpiTeam->kpiTeamId;
							$history->detail = $_POST["remark"][$teamId] != '' ? $_POST["remark"][$teamId] : '';
							$history->target = $target;
							$history->createrId = Yii::$app->user->id;
							$history->status = $historyStatus;
							$history->updateDateTime = new Expression('NOW()');
							$history->save(false);
						}
					}
				endforeach;
			}
		}
		return $this->redirect(Yii::$app->homeUrl . 'kpi/management/grid');
	}
	public function actionTeamProgress()
	{
		$kpiId = $_POST["kpiId"];
		$teamId = $_POST["teamId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/team/team-detail?id=' . $teamId);
		$teamDetail = curl_exec($api);
		$teamDetail = json_decode($teamDetail, true);


		$kpi = Kpi::find()->select('kpiName')->where(["kpiId" => $kpiId])->asArray()->one();
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-team/kpi-team-history?kpiId=' . $kpiId . '&&teamId=' . $teamId);
		$kpiTeamHistory = curl_exec($api);
		$kpiTeamHistory = json_decode($kpiTeamHistory, true);
		curl_close($api);
		//throw new Exception(print_r($kpiTeamHistory, true));
		$teamText = $this->renderAjax('team_progress', ["kpiTeamHistory" => $kpiTeamHistory]);
		//throw new Exception($teamText);
		$res["teamName"] = $teamDetail["teamName"];
		$res["kpiName"] = $kpi["kpiName"];
		$res["history"] = $teamText;
		return json_encode($res);
	}
	public function actionTeamKpi()
	{
		$role = UserRole::userRight();

		$userId = Yii::$app->user->id;
		$isAdmin = UserRole::isAdmin();
		$userBranchId = User::userBranchId();
		$userTeamId = Team::userTeam($userId);
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-team/all-team-kpi?userId=' . $userId . '&&role=' . $role);
		$teamKpis = curl_exec($api);
		$teamKpis = json_decode($teamKpis, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/unit/all-unit');
		$units = curl_exec($api);
		$units = json_decode($units, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$companies = curl_exec($api);
		$companies = json_decode($companies, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-team/wait-for-approve?branchId='  . $userBranchId . '&&isAdmin=' . $isAdmin);
		$waitForApprove = curl_exec($api);
		$waitForApprove = json_decode($waitForApprove, true);

		curl_close($api);
		// throw new Exception(print_r($teamKpis,true));

		$isManager = UserRole::isManager();
		$months = ModelMaster::monthFull(1);
		return $this->render('team_kpi', [
			"units" => $units,
			"months" => $months,
			"teamKpis" => $teamKpis,
			"role" => $role,
			"userId" => $userId,
			"isManager" => $isManager,
			"companies" => $companies,
			"userTeamId" => $userTeamId,
			"companyId" => null,
			"branchId" => null,
			"teamId" => null,
			"month" => null,
			"status" => null,
			"year" => null,
			"waitForApprove" => $waitForApprove

		]);
	}
	public function actionKpiTeamHistory($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$role = UserRole::userRight();
		$kpiId = $param["kpiId"];
		$kpiTeamId = $param["kpiTeamId"];
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		if (isset($param["kpiTeamHistoryId"])) {
			$kpiTeamHistoryId = $param["kpiTeamHistoryId"];
		} else {
			$kpiTeamHistoryId = 0;
		}
		$kpiTeamHistoryId = KpiTeamHistory::find()
		->select('kpiTeamHistoryId')
		->where(["kpiTeamId" => $kpiTeamId])
		->orderBy('kpiTeamHistoryId DESC')
		->asArray()->one();
		
		if(isset($kpiTeamHistoryId) && !empty($kpiTeamHistoryId)) {
			$kpiTeamHistoryId = $kpiTeamHistoryId['kpiTeamHistoryId'];
		}

		$openTab = array_key_exists("openTab", $param) ? $param["openTab"] : 0;
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-team/kpi-team-detail?kpiTeamId=' . $kpiTeamId . '&&kpiTeamHistoryId=' . $kpiTeamHistoryId);
		$kpiTeamDetail = curl_exec($api);
		$kpiTeamDetail = json_decode($kpiTeamDetail, true);
		//throw new Exception(print_r($kpiTeamDetail,true));

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$companies = curl_exec($api);
		$companies = json_decode($companies, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/unit/all-unit');
		$units = curl_exec($api);
		$units = json_decode($units, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-team/kpi-team-summarize?kpiId=' . $kpiId);
		$kpiTeams = curl_exec($api);
		$kpiTeams = json_decode($kpiTeams, true);

		curl_close($api);
		$months = ModelMaster::monthFull(1);
		$isManager = UserRole::isManager();

		return $this->render('kpi_team_history', [
			"role" => $role,
			"kpiDetail" => $kpiTeamDetail,
			"openTab" => $openTab,
			"months" => $months,
			"isManager" => $isManager,
			"units" => $units,
			"companies" => $companies,
			"kpiId" => $kpiId,
			"kpiTeamId" => $kpiTeamId,
			"kpiTeams" => $kpiTeams,
			"kpiTeamHistoryId" => $kpiTeamHistoryId
		]);
	}

	public function actionAllKpiHistory()
	{
		$kpiTeamHistoryId = $_POST["kpiTeamHistoryId"];
		$kpiId = $_POST["kpiId"];
		$kpiTeamId = $_POST["kpiTeamId"];
		
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-team/kpi-history?kpiId=' . $kpiId . '&&kpiTeamId=' . $kpiTeamId .'&&kpiTeamHistoryId=' . $kpiTeamHistoryId);
		$history = curl_exec($api);
		$history = json_decode($history, true);
		  //throw new Exception(print_r($history,true));
		curl_close($api);
		//eturn json_encode($history);
		$monthDetail = [];
		$summarizeMonth = [];
		$res["monthlyDetailHistoryText"] = "";
		if ($kpiTeamHistoryId != 0) {
			$kpiHistory = KpiTeamHistory::find()
				->where(["kpiTeamHistoryId" => $kpiTeamHistoryId])
				->asArray()
				->one();
			$year = $kpiHistory["year"];
			$month = $kpiHistory["month"];
		} else {
			$year = '';
			$month = '';
		}
		if (isset($history) && count($history) > 0) {
			foreach ($history as $kpiHistoryId2 => $ht):
				if ($year != '' && $month != '' && $ht["year"] <= $year) {
					if ($ht["year"] == $year) {
						if ($ht["month"] <= $month) {
							if (isset($monthDetail[$ht["year"]][$ht["month"]])) {
								$totalCount = count($monthDetail[$ht["year"]][$ht["month"]]);
								$monthDetail[$ht["year"]][$ht["month"]][$totalCount] = [
									"creater" => $ht["creater"],
									"status" => $ht["status"],
									"picture" => $ht["picture"],
									"result" => isset($ht["result"]) ? $ht["result"] : 0,
									"createDateTime" => $ht["createDate"]
								];
							} else {
								$monthDetail[$ht["year"]][$ht["month"]][0] = [
									"creater" => $ht["creater"],
									"status" => $ht["status"],
									"picture" => $ht["picture"],
									"result" => isset($ht["result"]) ? $ht["result"] : 0,
									"createDateTime" => $ht["createDate"]
								];
								$summarizeMonth[$ht["year"]][$ht["month"]] = [
									"year" => $ht["year"],
									"month" => ModelMaster::fullMonthText($ht["month"]),
									"result" => isset($ht["result"]) ? $ht["result"] : 0,
									"target" => isset($ht["target"]) ? $ht["target"] : 0,
									"kpiHistoryId" => $kpiHistoryId2
								];
							}
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
							"result" => isset($ht["result"]) ? $ht["result"] : 0,
							"createDateTime" => $ht["createDateTime"]
						];
					} else {
						$monthDetail[$ht["year"]][$ht["month"]][0] = [
							"creater" => $ht["creater"],
							"title" => $ht["title"],
							"status" => $ht["status"],
							"picture" => $ht["picture"],
							"result" => isset($ht["result"]) ? $ht["result"] : 0,
							"createDateTime" => $ht["createDateTime"]
						];
						$summarizeMonth[$ht["year"]][$ht["month"]] = [
							"year" => $ht["year"],
							"month" => ModelMaster::fullMonthText($ht["month"]),
							"result" => isset($ht["result"]) ? $ht["result"] : 0,
							"target" => isset($ht["target"]) ? $ht["target"] : 0,
							"kpiHistoryId" => $kpiHistoryId2
						];
					}
				}
			endforeach;
			$res["monthlyDetailHistoryText"] = $this->renderAjax('kpi_update_history', [
				"monthDetail" => $monthDetail,
				"summarizeMonth" => $summarizeMonth
			]);
		}
		
		return json_encode($res);
	}


	public function actionKpiChart()
	{
		$kpiTeamHistoryId = $_POST["kpiTeamHistoryId"];
		$kpiId = $_POST["kpiId"];
		$kpiTeamId = $_POST["kpiTeamId"];

		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-team/kpi-history-for-chart?kpiId=' . $kpiId . '&&kpiTeamId=' . $kpiTeamId .'&&kpiTeamHistoryId=' . $kpiTeamHistoryId);
		$history = curl_exec($api);
		$history = json_decode($history, true);
		curl_close($api);
		// throw new Exception($kpiTeamHistoryId);
		// throw new Exception(print_r($history,true));
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
		if ($kpiTeamHistoryId != 0) {
			$kpiTeamHistory = KpiTeamHistory::find()
				->where(["kpiTeamHistoryId" => $kpiTeamHistoryId])
				->asArray()
				->one();
			$year = $kpiTeamHistory["year"];
			$month = $kpiTeamHistory["month"];
		} else {
			$year = '';
			$month = '';
		}
		if (isset($history) && count($history) > 0) {
			$i = 0;
			foreach ($history as $kpiHistoryId => $ht):
				if ($year != '' && $month != '' && $ht["year"] <= $year) {
					if ($ht["year"] == $year) {
						if ($ht["month"] <= $month) {
							if (!isset($summarizeMonth[$ht["year"]][$ht["month"]])) {
								$summarizeMonth[$ht["year"]][$ht["month"]] = [
									"year" => $ht["year"],
									"month" => ModelMaster::fullMonthText($ht["month"]),
									"result" => $ht["result"] ?? 0, // ใช้ ?? กำหนดค่าเริ่มต้น
									"target" => $ht["target"] ?? 0,
									"kpiHistoryId" => $kpiHistoryId
								];
								$summarizeMonth2[$i] = [
									"year" => $ht["year"],
									"month" => ModelMaster::fullMonthText($ht["month"]),
									"result" => $ht["result"] ?? 0,
									"target" => $ht["target"] ?? 0,
									"kpiHistoryId" => $kpiHistoryId
								];
							}
						}
					} else {
						if (!isset($summarizeMonth[$ht["year"]][$ht["month"]])) {
							$summarizeMonth[$ht["year"]][$ht["month"]] = [
								"year" => $ht["year"],
								"month" => ModelMaster::fullMonthText($ht["month"]),
								"result" => $ht["result"] ?? 0,
								"target" => $ht["target"] ?? 0,
								"kpiHistoryId" => $kpiHistoryId
							];
							$summarizeMonth2[$i] = [
								"year" => $ht["year"],
								"month" => ModelMaster::fullMonthText($ht["month"]),
								"result" => $ht["result"] ?? 0,
								"target" => $ht["target"] ?? 0,
								"kpiHistoryId" => $kpiHistoryId
							];
						}
					}
				} else {
					if (!isset($summarizeMonth[$ht["year"]][$ht["month"]])) {
						$summarizeMonth[$ht["year"]][$ht["month"]] = [
							"year" => $ht["year"],
							"month" => ModelMaster::fullMonthText($ht["month"]),
							"result" => $ht["result"] ?? 0,
							"target" => $ht["target"] ?? 0,
							"kpiHistoryId" => $kpiHistoryId
						];
						$summarizeMonth2[$i] = [
							"year" => $ht["year"],
							"month" => ModelMaster::fullMonthText($ht["month"]),
							"result" => $ht["result"] ?? 0,
							"target" => $ht["target"] ?? 0,
							"kpiHistoryId" => $kpiHistoryId
						];
					}
				}
				$i++;
			endforeach;
		}
		

		$summarizeMonth2 = array_slice($summarizeMonth2, -8);
		foreach ($summarizeMonth2 as $index => $data):
			$target[$index] = $data["target"];
			$result[$index] = $data["result"];
			$targetText .= $target[$index] . ',';
			$resultText .= $result[$index] . ',';
			$monthText .= '"' . substr($data["month"], 0, 3) . substr($data["year"], -2) . '",';
		endforeach;
		$monthText = substr($monthText, 0, -1);
		$targetText = substr($targetText, 0, -1);
		$resultText = substr($resultText, 0, -1);
		$res["kpiChart"] = $this->renderAjax('kpi_chart', [
			"month" => $monthText,
			"target" => $targetText,
			"result" => $resultText
		]);
		return json_encode($res);
	}

	public function actionTeamKpiGrid()
	{
		$role = UserRole::userRight();
		if ($role < 3) {
			//return $this->redirect(Yii::$app->homeUrl . 'kgi/management/grid');
		}
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		$userId = Yii::$app->user->id;
		$isAdmin = UserRole::isAdmin();
		$userBranchId = User::userBranchId();

		$userTeamId = Team::userTeam($userId);
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-team/all-team-kpi?userId=' . $userId . '&&role=' . $role);
		$teamKpis = curl_exec($api);
		$teamKpis = json_decode($teamKpis, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/unit/all-unit');
		$units = curl_exec($api);
		$units = json_decode($units, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$companies = curl_exec($api);
		$companies = json_decode($companies, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-team/wait-for-approve?branchId='  . $userBranchId . '&&isAdmin=' . $isAdmin);
		$waitForApprove = curl_exec($api);
		$waitForApprove = json_decode($waitForApprove, true);

		// throw new Exception(print_r($teamKpis, true));

		curl_close($api);
		//throw new Exception($role);
		$isManager = UserRole::isManager();
		$months = ModelMaster::monthFull(1);
		return $this->render('kpi_team_grid', [
			"units" => $units,
			"months" => $months,
			"teamKpis" => $teamKpis,
			"role" => $role,
			"userId" => Yii::$app->user->id,
			"isManager" => $isManager,
			"companies" => $companies,
			"userTeamId" => $userTeamId,
			"companyId" => null,
			"branchId" => null,
			"teamId" => null,
			"month" => null,
			"status" => null,
			"year" => null,
			"waitForApprove" => $waitForApprove
		]);
	}
	public function actionSearchKpiTeam()
	{
		$companyId = isset($_POST["companyId"]) && $_POST["companyId"] != null ? $_POST["companyId"] : null;
		$branchId = isset($_POST["branchId"]) && $_POST["branchId"] != null ? $_POST["branchId"] : null;
		$teamId = isset($_POST["teamId"]) && $_POST["teamId"] != null ? $_POST["teamId"] : null;
		$month = isset($_POST["month"]) && $_POST["month"] != null ? $_POST["month"] : null;
		$status = isset($_POST["status"]) && $_POST["status"] != null ? $_POST["status"] : null;
		$year = isset($_POST["year"]) && $_POST["year"] != null ? $_POST["year"] : null;
		$type = $_POST["type"];
		return $this->redirect(Yii::$app->homeUrl . 'kpi/kpi-team/kpi-team-search-result/' . ModelMaster::encodeParams([
			"companyId" => $companyId,
			"branchId" => $branchId,
			"teamId" => $teamId,
			"month" => $month,
			"status" => $status,
			"year" => $year,
			"type" => $type
		]));
	}
	
	
	public function actionKpiTeamSearchResult($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$isAdmin = UserRole::isAdmin();
		$userBranchId = User::userBranchId();
		$companyId = $param["companyId"];
		$branchId = $param["branchId"];
		$teamId = $param["teamId"];
		$month = $param["month"];
		$status = $param["status"];
		$year = $param["year"];
		$type = $param["type"];
		if ($companyId == "" && $branchId == "" && $teamId == "" && $month == "" && $status == "" && $year == "") {
			if ($type == "list") {
				return $this->redirect(Yii::$app->homeUrl . 'kpi/kpi-team/team-kpi');
			} else {
				return $this->redirect(Yii::$app->homeUrl . 'kpi/kpi-team/team-kpi-grid');
			}
		}
		$paramText = 'companyId=' . $companyId . '&&branchId=' . $branchId . '&&teamId=' . $teamId . '&&month=' . $month . '&&status=' . $status . '&&year=' . $year;
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		$userId = Yii::$app->user->id;
		$userTeamId = Team::userTeam($userId);
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-team/kpi-team-filter?' . $paramText);
		$teamKpis = curl_exec($api);
		$teamKpis = json_decode($teamKpis, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/unit/all-unit');
		$units = curl_exec($api);
		$units = json_decode($units, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$companies = curl_exec($api);
		$companies = json_decode($companies, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-team/wait-for-approve?branchId='  . $userBranchId . '&&isAdmin=' . $isAdmin);
		$waitForApprove = curl_exec($api);
		$waitForApprove = json_decode($waitForApprove, true);

		curl_close($api);

		// throw new exception(print_r($teamKpis, true));

		if ($type == "list") {
			$file = "team_kpi";
		} else {
			$file = "kpi_team_grid";
		}
		$months = ModelMaster::monthFull(1);
		$role = UserRole::userRight();
		$isManager = UserRole::isManager();
		return $this->render($file, [
			"units" => $units,
			"months" => $months,
			"teamKpis" => $teamKpis,
			"role" => $role,
			"userId" => $userId,
			"userTeamId" => $userTeamId,
			"isManager" => $isManager,
			"companies" => $companies,
			"companyId" => $companyId,
			"branchId" => $branchId,
			"teamId" => $teamId,
			"month" => $month,
			"status" => $status,
			"year" => $year,
			"waitForApprove" => $waitForApprove
		]);
	}
	public function actionPrepareUpdate($hash)
	{
		// $kpiTeamId = $_GET["kpiTeamId"];
		$param = ModelMaster::decodeParams($hash);
		$role = UserRole::userRight();

		$kpiTeamId = $param["kpiTeamId"];

		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-team/kpi-team-detail?kpiTeamId=' . $kpiTeamId . '&&kpiTeamHistoryId=0');
		$kpiTeamDetail = curl_exec($api);
		$kpiTeamDetail = json_decode($kpiTeamDetail, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/kpi-detail?id=' . $kpiTeamDetail['kpiId'] . '&&kpiHistoryId=0');
		$kpi = curl_exec($api);
		$kpi = json_decode($kpi, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/company-branch?id=' . $kpi["companyId"]);
		$kpiBranch = curl_exec($api);
		$kpiBranch = json_decode($kpiBranch, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/kpi-department?id=' . $kpiTeamDetail['kpiId']);
		$kpiDepartment = curl_exec($api);
		$kpiDepartment = json_decode($kpiDepartment, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/kpi-team?id=' . $kpiTeamDetail['kpiId']);
		$kpiTeam = curl_exec($api);
		$kpiTeam = json_decode($kpiTeam, true);

		curl_close($api);

		    $companyId = $kpi["companyId"];
			$company= [
				"companyId" => $kpi["companyId"],
				"companyName" => Company::companyName($kpi["companyId"]),
				"companyImg" => Company::companyImage($kpi["companyId"]),
			];

			$unit = Unit::find()->where(["unitId" => $kpi["unitId"]])->asArray()->one();
			
		// throw new exception(print_r($kpiTeamDetail	, true));
		
		return $this->render('kpi_from', [
			"kpi" => $kpi,
			"data" => $kpiTeamDetail,
			"company" => $company ?? [],  
			"kpiBranch" => $kpiBranch ?? [],  
			"kpiDepartment" => $kpiDepartment ?? [],
			"kpiTeam" => $kpiTeam ?? [],
			"role" => $role,
			"unit"  => $unit ,
			"kpiTeamId"  => $kpiTeamId,
			"lastUrl" => Yii::$app->request->referrer,	
			"statusform" =>  "update"
		]);
	}
	public function actionUpdateKpiTeam()
	{

		$data = [
            'kpiTeamId' => $_POST["kpiTeamId"],
			'targetAmount' => $_POST["amount"], 
			'status' => $_POST["status"],   
			'result' => $_POST["result"],
			'month' => $_POST["month"],      
			'year' => $_POST["year"],      
			'toDate' => $_POST["toDate"],
			'fromDate' => $_POST["fromDate"],
			'nextCheckDate' => $_POST["nextCheckDate"],            
      
        ];



		//  throw new Exception(print_r($data,true));
		//เมื่อกดอัพเดต 
		// อัพเดต KpiTeam จากนั้น อัพเดต KpiTeamHistory โดยเช็คเงื่อนไขดังนี้
		// ให้อินเสริท KpiTeam และ KpiTeamHistory ปกติ ให้เดือน + 1  เอาไปค้นหาใน KpiTeamHistory ด้วย kpiTeamId  เดือน + 1 สเตตัส 5
		//เช็คว่าสเตตัสเป็น 2 และ มี ใน KpiTeamHistory ไหม ถ้ามี ให้อัพเดต 5 เป็น 1  ด้วย

		//สมมุต เดือนนี้ 03 มี สเตตัส 5 ในเดือน 04 และกดอัพเดต เดือน 04 มา 
		//มันจะอินเสริจ เดือน 04 อันใหม่ก่อนแล้วจากนั้นค่อยไปอัพเดต 04 สเตตัส 5 อีกที 
		//ผลลัพมันจะกลายเป็น เดือน 04 สเตตัส 1 สองอันใน KpiTeamHistory

		//วิธีแก้ถ้ามีเดือนกับปีอยู่แล้ว ให้หน้าฟรอมแก้ไขไม่ได้ แต่ถ้าไม่มีให้แก่ไขได้ เฉพาะทีม

		
		$nextMonth = $data['month'] + 1;
		$nextYear = $data['year'];

		// ถ้าเดือนเกิน 12 ให้กลับไปเป็น 1 และเพิ่มปี
		if ($nextMonth > 12) {
			$nextMonth = 1;
			$nextYear++;
		}
		$kpiTeamId = $_POST["kpiTeamId"];
		$role = UserRole::userRight();
		$status =  $_POST["status"];
		if (isset($oldKpiTeam) && !empty($oldKpiTeam)) {
			if (($oldKpiTeam["target"] != $_POST["amount"]) && $role == 3) {
				$status = 88;
			}
		}
		$teamkpi = KpiTeam::find()->where(["kpiTeamId" => $kpiTeamId])->one();
		$teamkpi->status = $_POST["status"];
		$teamkpi->month = $_POST["month"];
		$teamkpi->year = $_POST["year"];
		$teamkpi->result = str_replace(",", "",  $_POST["result"]); 
		if (isset($_POST["amount"])) {
			$teamkpi->target = str_replace(",", "",  $_POST["amount"]);
		}
		$teamkpi->fromDate = $_POST["fromDate"];
		$teamkpi->toDate = $_POST["toDate"];
		$teamkpi->nextCheckDate = $_POST["nextCheckDate"];
		$teamkpi->updateDateTime = new Expression('NOW()');
		if ($teamkpi->save(false)) {
			$kpiTeamHistory = new KpiTeamHistory();
			$kpiTeamHistory->kpiTeamId = $kpiTeamId;
			$kpiTeamHistory->result = str_replace(",", "",  $_POST["result"]); 
			if (isset($_POST["amount"])) {
				$kpiTeamHistory->target = str_replace(",", "",  $_POST["amount"]);
			} else {
				$teamKpi = KpiTeam::find()->where(["kpiTeamId" => $kpiTeamId])->one();
				$kpiTeamHistory->target = str_replace(",", "",   $teamKpi["target"]);
				$teamKpi->save(false);
			}
			$kpiTeamHistory->status = $status;
			$kpiTeamHistory->month = $_POST["month"];
			$kpiTeamHistory->fromDate = $_POST["fromDate"];
			$kpiTeamHistory->toDate = $_POST["toDate"];
			$kpiTeamHistory->month = $_POST["month"];
			$kpiTeamHistory->year = $_POST["year"];
			$kpiTeamHistory->nextCheckDate = $_POST["nextCheckDate"];
			$kpiTeamHistory->createrId = Yii::$app->user->id;
			$kpiTeamHistory->createDateTime = new Expression('NOW()');
			$kpiTeamHistory->updateDateTime = new Expression('NOW()');
			if ($kpiTeamHistory->save(false)) {
				//check ว่า มีอันนี้ที่เป็นสเตตัส 5 ในเดือนที่มากกว่า ที่ส่งมา +1 และปีปัจจุบัน รึยัง ถ้ามีแล้วให้อัพเดต 5 เป็น 1
				$kpiTeamHistory = KpiTeamHistory::find()
				->where(["kpiTeamId" => $kpiTeamId, "status" => 5 , "month" => $nextMonth, "year" => $nextYear])
				->one(); // ไม่ใช้ asArray() เพื่อให้เป็น object				
				if ($kpiTeamHistory !== null && $status == 2) {
					$teamkpi->month = $kpiTeamHistory -> month;
					$teamkpi->year = $kpiTeamHistory -> year;
					$teamkpi->status = 1;
					$teamkpi ->save(false);
					$kpiTeamHistory->status = 1;
					$kpiTeamHistory->updateDateTime = new Expression('NOW()');
					$kpiTeamHistory->save(false);

				}
				// throw new Exception(print_r($kpiTeamHistory, true));	

			}
		}
		
		
		// return $this->redirect(Yii::$app->homeUrl . 'kpi/kpi-team/team-kpi-grid');
		return $this->redirect($_POST["lastUrl"]);
	}
	public function actionKpiTeam()
	{
		$kpiId = $_POST["kpiId"];
		$kpiIds = [];
		$res = [];
		$kpi = KpiTeam::find()->where(["kpiId" => $kpiId, "status" => [1, 2, 4]])->asArray()->all();
		if (isset($kpi) && count($kpi) > 0) {
			$i = 0;
			foreach ($kpi as $k) :
				$kpiIds[$i] = $k["teamId"];
				$i++;
			endforeach;
		}
		if (count($kpiIds) > 0) {
			$res["status"] = true;
		} else {
			$res["status"] = false;
		}
		$res["kpiId"] = $kpiIds;
		return json_encode($res);
	}

	public function actionModalHistory()
    {	
        $percentage = $_POST["percentage"];
        $result = $_POST["result"];
        $sumvalue = $_POST["sumvalue"];
        $targetAmount = $_POST["targetAmount"];
        $kpiId = $_POST["kpiId"];
        $month = $_POST["month"];
		$monthName = $_POST["monthName"];
        $year = $_POST["year"];
        $formattedRange = $_POST["formattedRange"];
        $kpiTeamId = $_POST["kpiTeamId"];
		$kpiTeamHistoryId = $_POST["kpiTeamHistoryId"];
		$role = UserRole::userRight();
		$userId = Yii::$app->user->id;
		$teamId = Team::userTeam($userId);

		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		if ($role >= 4) {
			curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/kpi-history-employee?kpiId='  . $kpiId . '&month=' . $month . '&year=' . $year);
			$history = curl_exec($api);
			$history = json_decode($history, true);
		}else{
			curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-team/kpi-history-employee?kpiId='  . $kpiId . '&month=' . $month . '&year=' . $year . '&teamId=' . $teamId);
			$history = curl_exec($api);
			$history = json_decode($history, true);
		}
		
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/kpi-history-team?kpiId='  . $kpiId . '&month=' . $month . '&year=' . $year );
		$historyTeam = curl_exec($api);
		$historyTeam = json_decode($historyTeam, true);

		curl_close($api);
        // throw new Exception(print_r($history,true));

        $data = [
            "percentage" => $percentage,
            "result" => $result,
            "sumvalue" => $sumvalue,
            "targetAmount" => $targetAmount,
            "kpiId" => $kpiId,
            "month" => $monthName,
            "year" => $year,
            "formattedRange" => $formattedRange,
            "history" => $history,
            "historyTeam" => $historyTeam
        ];

                // throw new Exception(print_r($data,true));

        
    
        header("Content-Type: application/json");
        echo json_encode($data);
        exit;
    }
	public function actionKpiTeamView()
	{
		$kpiTeamId = $_POST["kpiTeamId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-team/kpi-team-detail?kpiTeamId=' . $kpiTeamId . '&&kpiTeamHistoryId=0');
		$kpiTeam = curl_exec($api);
		$kpiTeam = json_decode($kpiTeam, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-team/kpi-team-history-view?kpiTeamId=' . $kpiTeamId);
		$kpiTeamHistory = curl_exec($api);
		$kpiTeamHistory = json_decode($kpiTeamHistory, true);

		curl_close($api);

		//throw new Exception(print_r($kpiTeamHistory, true));
		$teamText = $this->renderAjax('team_history', ["kpiTeamHistory" => $kpiTeamHistory]);
		$res["kpiTeam"] = $kpiTeam;
		$res["history"] = $teamText;
		return json_encode($res);
	}
	public function actionKpiTeamView2()
	{
		$kpiId = $_POST['kpiId'];
		$teamId = $_POST['teamId'];
		$kpiTeam = KpiTeam::find()->select('kpiTeamId')
			->where(["teamId" => $teamId, "kpiId" => $kpiId, "status" => [1, 2]])
			->asArray()
			->one();
		if (isset($kpiTeam) && !empty($kpiTeam)) {
			$kpiTeamId = $kpiTeam["kpiTeamId"];
			$res["status"] = true;
		} else {
			$res["status"] = false;
		}
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-team/kpi-team-detail?kpiTeamId=' . $kpiTeamId . '&&kpiTeamHistoryId=0');
		$kpiTeam = curl_exec($api);
		$kpiTeam = json_decode($kpiTeam, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-team/kpi-team-history-view?kpiTeamId=' . $kpiTeamId);
		$kpiTeamHistory = curl_exec($api);
		$kpiTeamHistory = json_decode($kpiTeamHistory, true);

		curl_close($api);

		//throw new exception($kpiTeamId);
		$teamText = $this->renderAjax('team_history', ["kpiTeamHistory" => $kpiTeamHistory]);
		$res["kpiTeam"] = $kpiTeam;
		$res["history"] = $teamText;
		return json_encode($res);
	}
	public function actionAssignKpiTeam()
	{
		$kpiId = $_POST["kpiId"];
		$teams = Team::find()
			->where(["status" => 1])
			->orderBy("departmentId,teamName")
			->all();
		$textTeam = $this->renderAjax('team', ["teams" => $teams, "kpiId" => $kpiId, "checkAll" => '']);
		$departmentText = '<option value="">Deparment</option>';
		$departments = Department::find()
			->where(["status" => 1])
			->orderBy("departmentName")
			->asArray()
			->all();
		if (isset($departments) && count($departments)) {
			foreach ($departments as $dep) :
				$departmentText .= '<option value="' . $dep['departmentId'] . '">' . $dep['departmentName'] . '</option>';
			endforeach;
		}
		$res["textTeam"] = $textTeam;
		$res["textDepartment"] = $departmentText;
		return json_encode($res);
	}
	public function actionSearchTeam()
	{
		$teamName = $_POST["teamName"];
		$kpiId = $_POST["kpiId"];
		$departmentId = $_POST["departmentId"];
		$teams = Team::find()
			->where(["status" => 1])
			->andWhere("teamName LIKE  '" . $teamName . "%'")
			->andFilterWhere(["departmentId" => $departmentId])
			->orderBy("departmentId,teamName")
			->all();
		$textTeam = $this->renderAjax('team', ["teams" => $teams, "kpiId" => $kpiId, "checkAll" => '']);
		$res["textTeam"] = $textTeam;
		return json_encode($res);
	}
	public function actionDeleteKpiTeam()
	{
		$kpiTeamId = $_POST["kpiTeamId"];
		KpiTeam::updateAll(["status" => 99], ["kpiTeamId" => $kpiTeamId]);
		KpiTeamHistory::updateAll(["status" => 99], ["kpiTeamId" => $kpiTeamId]);
		$res["status"] = true;
		return json_encode($res);
	}
	public function actionKpiAssignTeam()
	{
		$teamId = $_POST["teamId"];
		$kpiId = $_POST["kpiId"];
		$checked = $_POST["checked"];
		$kpiTeam = KpiTeam::find()
			->where(["kpiId" => $kpiId, "teamId" => $teamId, "status" => [1, 2]])
			->one();
		if (isset($kpiTeam) && !empty($kpiTeam)) {
			if ($checked == 1) {
				KpiTeam::updateAll(["status" => 1], ["kpiId" => $kpiId, "teamId" => $teamId]);
			} else {
				$kpiTeam->delete();
			}
		} else {
			$kpiTeam = new KpiTeam();
			$kpiTeam->kpiId = $kpiId;
			$kpiTeam->teamId = $teamId;
			$kpiTeam->status = 1;
			$kpiTeam->createDateTime = new Expression('NOW()');
			$kpiTeam->updateDateTime = new Expression('NOW()');
			$kpiTeam->save(false);
		}
		$kpiTeams = KpiTeam::find()
			->where(["kpiId" => $kpiId, "status" => [1, 2, 4]])
			->asArray()
			->all();
		$res["status"] = true;
		$res["countTeam"] = count($kpiTeams);
		return json_encode($res);
	}
	public function actionCheckAllKpiTeam()
	{
		$teams = Team::find()
			->where(["status" => 1])
			->asArray()
			->all();
		$team = [];
		if (isset($teams) && count($teams) > 0) {
			$i = 0;
			foreach ($teams as $t) :
				$team[$i] = $t["teamId"];
				$i++;
			endforeach;
		}
		$res["team"] = $team;
		return json_encode($res);
	}
	public function actionNextKpiTeamHistory()
	{
		$kpiTeamHistoryId = $_POST["kpiTeamHistoryId"];
		$currentHistory = KpiTeamHistory::find()->where(["kpiTeamHistoryId" => $kpiTeamHistoryId])->asArray()->one();
		$kpiTeam = KpiTeam::find()->where(["kpiTeamId" => $currentHistory["kpiTeamId"]])->asArray()->one();
		$kpi = Kpi::find()->where(["kpiId" => $kpiTeam["kpiId"]])->asArray()->one();
		$unit = Unit::find()->where(["unitId" => $kpi["unitId"]])->asArray()->one();
		if ($currentHistory["month"] != "" && $currentHistory["year"] != "") {
			$nextTargetMonthYear = ModelMaster::nextTargetMonthYear($unit["unitName"], $currentHistory["month"], $currentHistory["year"]);
			$nextMonth = $nextTargetMonthYear["nextMonth"];
			$nextYear = $nextTargetMonthYear["nextYear"];
		} else {
			$nextMonth = null;
			$nextYear = null;
		}
		$kpiTeamHistory = new KpiTeamHistory();
		$kpiTeamHistory->kpiTeamId = $currentHistory["kpiTeamId"];
		$kpiTeamHistory->detail = 'New target';
		$kpiTeamHistory->nextCheckDate = null;
		$kpiTeamHistory->status = 1;
		$kpiTeamHistory->target = $currentHistory["target"];
		$kpiTeamHistory->result = 0;
		$kpiTeamHistory->month = $nextMonth;
		$kpiTeamHistory->year = $nextYear;
		$kpiTeamHistory->createDateTime = new Expression('NOW()');
		$kpiTeamHistory->updateDateTime = new Expression('NOW()');
		if ($kpiTeamHistory->save(false)) {
			$kpiTeam = KpiTeam::find()->where(["kpiTeamId" => $currentHistory["kpiTeamId"]])->one();
			$kpiTeam->status = 1;
			$kpiTeam->month = $nextMonth;
			$kpiTeam->year = $nextYear;
			$kpiTeam->updateDateTime = new Expression('NOW()');
			if($kpiTeam->save(false)){

				$kpiEmpoyee = KpiEmployee::find()
				->leftJoin("employee" , "employee.employeeId = kpi_employee.employeeId")
				->where(["kpi_employee.kpiId" => $kpiTeam["kpiId"],"employee.teamId" => $kpiTeam["teamId"],"kpi_employee.status" => [1,2,4]])
				->all();

				// throw new Exception(print_r($kpiEmpoyee, true)); 
				foreach($kpiEmpoyee as $empoyee) :
					if($empoyee -> month  == $nextMonth && $empoyee -> year  == $nextYear){
						//ปัญหาคือ พอก็อปหน้าคอมปานีมา มันไม่มีในเอ็มพรอยี่ด้วย 
						//สามารถข้ามเดือนได้ 
						
					}else{
						if($empoyee -> status == 1){
                            $status = 5;
                        }
                        if($empoyee -> status == 2){
                            $status = 1;
							// throw new Exception(print_r($empoyee -> status, true)); 
                            $empoyee -> status = 1;
                            $empoyee -> month = $nextMonth;
                            $empoyee -> year = $nextYear;
                        }
						$kpiEmpoyeeHistory = new KpiEmployeeHistory();
						$kpiEmpoyeeHistory->kpiEmployeeId = $empoyee -> kpiEmployeeId;
						$kpiEmpoyeeHistory->createrId = Yii::$app->user->id;
						$kpiEmpoyeeHistory->month = $nextMonth;
						$kpiEmpoyeeHistory->year = $nextYear;
						$kpiEmpoyeeHistory->createDateTime = new Expression('NOW()');
						$kpiEmpoyeeHistory->updateDateTime = new Expression('NOW()');
						$kpiEmpoyeeHistory-> detail = "auto set from company kpi";
						$kpiEmpoyeeHistory->status = $status;
						$kpiEmpoyeeHistory->save(false);
						$empoyee -> save(false);
						// if ($kpiEmpoyeeHistory->save(false)) {
						// 	$empoyee -> updateDateTime = new Expression('NOW()');
						// 	$empoyee -> save(false);
						// }

					}
				endforeach;
			}
		}
		// return $this->redirect(Yii::$app->homeUrl . 'kpi/kpi-team/team-kpi-grid');
		return $this->redirect(Yii::$app->request->referrer);

	}
	
	public function actionKpiTeamUpdate()
	{
		$kpiId = $_POST["kpiId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-team/kpi-team?kpiId=' . $kpiId);
		$kpiTeams = curl_exec($api);
		$kpiTeams = json_decode($kpiTeams, true);


		curl_close($api);
	//	throw new Exception(print_r($kpiTeams, true));

		$allDepartment = [];
		if (isset($kpiTeams) && count($kpiTeams) > 0) {
			foreach ($kpiTeams as $kgt):
				$allDepartment[$kgt["departmentId"]] = $kgt["departmentId"];
			endforeach;
		}
		$t = [];
		$textTeam = "";
		if (count($allDepartment) > 0) {
			foreach ($allDepartment as $dId => $id) :
				$teams = Team::find()
					->where(["departmentId" => $dId])
					->andWhere("status!=99")
					->asArray()
					->orderBy("teamName")
					->all();
				if (isset($teams) && count($teams) > 0) {
					foreach ($teams as $team) :
						$t[$dId][$team["teamId"]] = $team["teamName"];
					endforeach;
				}
			endforeach;
			$textTeam .= $this->renderAjax('multi_team_update', [
				"t" => $t,
				"kpiId" => $kpiId
			]);
		}
		$res["textTeam"] = $textTeam;
		$res["countTeam"] = count($kpiTeams);
		return json_encode($res);
	}
}