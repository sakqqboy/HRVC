<?php

namespace frontend\modules\kpi\controllers;

use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\User;
use frontend\models\hrvc\UserRole;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `kpi` module
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
		$param = ModelMaster::decodeParams($hash);
		$kpiId = $param["kpiId"];
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

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/kpi-detail?id=' . $kpiId);
		$kpiDetail = curl_exec($api);
		$kpiDetail = json_decode($kpiDetail, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/kpi-history-summarize?kpiId=' . $kpiId);
		//curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/index?adminId=' . $adminId . '&&gmId=' . $gmId . '&&managerId=' . $managerId . '&&supervisorId=' . $supervisorId . '&&teamLeaderId=' . $teamLeaderId . '&&staffId=' . $staffId);
		$kpis = curl_exec($api);
		$kpis = json_decode($kpis, true);
		curl_close($api);
		//throw new Exception($kpiId);
		//throw new Exception(print_r($kpis, true));

		return $this->render('kpi_view', [
			"role" => $role,
			"kpiDetail" => $kpiDetail,
			"kpis" => $kpis
		]);
	}
	public function actionKpiTeamHistory($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$role = UserRole::userRight();
		$kpiTeamId = $param["kpiTeamId"];
		$kpiId = $param["kpiId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-team/kpi-team-history-summarize?kpiTeamId=' . $kpiTeamId);
		$kpiTeamsHistory = curl_exec($api);
		$kpiTeamsHistory = json_decode($kpiTeamsHistory, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/kpi-detail?id=' . $kpiId);
		$kpiDetail = curl_exec($api);
		$kpiDetail = json_decode($kpiDetail, true);

		curl_close($api);
		return $this->render('kpi_team_history', [
			"role" => $role,
			"kpiDetail" => $kpiDetail,
			"kpiTeamsHistory" => $kpiTeamsHistory
		]);
	}
	public function actionKpiIndividualHistory($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$role = UserRole::userRight();
		$kpiEmployeeId = $param["kpiEmployeeId"];
		$kpiId = $param["kpiId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/kpi-detail?id=' . $kpiId);
		$kpiDetail = curl_exec($api);
		$kpiDetail = json_decode($kpiDetail, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-personal/kpi-individual-summarize?kpiEmployeeId=' . $kpiEmployeeId);
		$kpiEmployeeHistory = curl_exec($api);
		$kpiEmployeeHistory = json_decode($kpiEmployeeHistory, true);


		curl_close($api);
		return $this->render('kpi_employee_history', [
			"role" => $role,
			"kpiDetail" => $kpiDetail,
			"kpiEmployeeHistory" => $kpiEmployeeHistory
		]);
	}
	public function actionKpiHistory($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$role = UserRole::userRight();
		$kpiId = $param["kpiId"];
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/kpi-detail?id=' . $kpiId);
		$kpiDetail = curl_exec($api);
		$kpiDetail = json_decode($kpiDetail, true);

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
		//throw new Exception(print_r($kpiTeams, true));
		return $this->render('kpi_history', [
			"role" => $role,
			"kpiDetail" => $kpiDetail,
			"kpiId" => $kpiId,
			"months" => $months,
			"isManager" => $isManager,
			"units" => $units,
			"companies" => $companies,
			"kpiTeams" => $kpiTeams
		]);
	}
	public function actionKpiTeamEmployee()
	{
		$kpiId = $_POST["kpiId"];
		$res["kpiEmployeeTeam"] = "";
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-team/kpi-team-summarize?kpiId=' . $kpiId);
		$kpiTeams = curl_exec($api);
		$kpiTeams = json_decode($kpiTeams, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/kpi-detail?id=' . $kpiId);
		$kpiDetail = curl_exec($api);
		$kpiDetail = json_decode($kpiDetail, true);
		curl_close($api);
		$res["kpiEmployeeTeam"] = $this->renderAjax("kpi_employee_team", [
			"kpiTeams" => $kpiTeams,
			"kpiDetail" => $kpiDetail,
			"kpiId" => $kpiId

		]);
		return json_encode($res);
	}
	public function actionAllKpiHistory()
	{
		$kpiId = $_POST["kpiId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/kpi-history?kpiId=' . $kpiId);
		$history = curl_exec($api);
		$history = json_decode($history, true);
		curl_close($api);
		$monthDetail = [];
		$summarizeMonth = [];
		$res["monthlyDetailHistoryText"] = "";
		if (isset($history) && count($history) > 0) {
			//krsort($history);
			foreach ($history as $kpiHistoryId => $ht):
				if (isset($monthDetail[$ht["year"]][$ht["month"]])) {
					$totalCount = count($monthDetail[$ht["year"]][$ht["month"]]);
					$monthDetail[$ht["year"]][$ht["month"]][$totalCount] = [
						"creater" => $ht["creater"],
						"title" => $ht["title"],
						"status" => $ht["status"],
						"picture" => $ht["picture"],
						"result" => $ht["result"],
						"createDateTime" => $ht["createDateTime"]
					];
				} else {
					$monthDetail[$ht["year"]][$ht["month"]][0] = [
						"creater" => $ht["creater"],
						"title" => $ht["title"],
						"status" => $ht["status"],
						"picture" => $ht["picture"],
						"result" => $ht["result"],
						"createDateTime" => $ht["createDateTime"]
					];
					$summarizeMonth[$ht["year"]][$ht["month"]] = [
						"year" => $ht["year"],
						"month" => ModelMaster::fullMonthText($ht["month"]),
						"result" => $ht["result"],
						"target" => $ht["target"],
						"kpiHistoryId" => $kpiHistoryId

					];
				}
			endforeach;
			$res["monthlyDetailHistoryText"] = $this->renderAjax('kpi_update_history', [
				"monthDetail" => $monthDetail,
				"summarizeMonth" => $summarizeMonth
			]);
		}
		return json_encode($res);
	}
	public function actionKpiIssue()
	{
		$kpiId = $_POST["kpiId"];
		$userId = Yii::$app->user->id;
		$employeeId = User::employeeIdFromUserId($userId);
		$res["kpiIssue"] = "";

		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/kpi-issue?kpiId=' . $kpiId);
		$kpiIssue = curl_exec($api);
		$kpiIssue = json_decode($kpiIssue, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/employee/employee-detail?id=' . $employeeId);
		$profile = curl_exec($api);
		$profile = json_decode($profile, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/kpi-detail?id=' . $kpiId);
		$kpiDetail = curl_exec($api);
		$kpiDetail = json_decode($kpiDetail, true);

		curl_close($api);
		$res["kpiIssue"] = $this->renderAjax("kpi_issue_solution", [
			"kpiId" => $kpiId,
			"kpiIssue" => $kpiIssue,
			"profile" => $profile,
			"employeeId" => $employeeId,
			"kpiName" => $kpiDetail["kpiName"]
		]);
		return json_encode($res);
	}
	public function actionKpiChart()
	{
		$kpiId = $_POST["kpiId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/kpi-history?kpiId=' . $kpiId);
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
			foreach ($history as $kpiHistoryId => $ht):
				if (!isset($summarizeMonth[$ht["year"]][$ht["month"]])) {
					$summarizeMonth[$ht["year"]][$ht["month"]] = [
						"year" => $ht["year"],
						"month" => ModelMaster::fullMonthText($ht["month"]),
						"result" => $ht["result"],
						"target" => $ht["target"],
						"kpiHistoryId" => $kpiHistoryId
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
		$res["kpiChart"] = $this->renderAjax('kpi_chart', [
			"month" => $monthText,
			"target" => $targetText,
			"result" => $resultText
		]);
		return json_encode($res);
	}
	public function actionKpiKgi()
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
		$kpiId = $_POST["kpiId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/kgi-kpi?kpiId=' . $kpiId);
		$kgiHasKpi = curl_exec($api);
		$kgiHasKpi = json_decode($kgiHasKpi, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/kpi-detail?id=' . $kpiId);
		$kpiDetail = curl_exec($api);
		$kpiDetail = json_decode($kpiDetail, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/index?adminId=' . $adminId . '&&gmId=' . $gmId . '&&managerId=' . $managerId . '&&supervisorId=' . $supervisorId . '&&teamLeaderId=' . $teamLeaderId . '&&staffId=' . $staffId);
		$kgis = curl_exec($api);
		$kgis = json_decode($kgis, true);


		$ghp = [];
		if (count($kgiHasKpi) > 0) {
			foreach ($kgiHasKpi as $gp):
				$ghp[$gp["kgiId"]] = 1;
			endforeach;
		}

		curl_close($api);

		$res["kgi"] = $this->renderAjax('kgi_kpi', [
			"kgiHasKpi" => $kgiHasKpi,
			"kpiId" => $kpiId,
			"kpiDetail" => $kpiDetail,
			"kgis" => $kgis,
			"ghp" => $ghp
		]);

		return json_encode($res);
	}
	public function actionKgiTeam()
	{
		$role = UserRole::userRight();
		$kgiId = $_POST["kgiId"];
		$userId = Yii::$app->user->id;
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-team/kgi-team2?kgiId=' . $kgiId);
		//curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-team/all-team-kpi?userId=' . $userId . '&&role=' . $role);
		$kgiTeams = curl_exec($api);
		$kgiTeams = json_decode($kgiTeams, true);

		curl_close($api);
		//throw new Exception(print_r($kgiTeams, true));
		$res["kgiTeam"] = $this->renderAjax('kgi_team', [
			"kgiTeams" => $kgiTeams
		]);
		return json_encode($res);
	}
}
