<?php

namespace frontend\modules\kpi\controllers;

use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
use frontend\models\hrvc\Department;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\Kpi;
use frontend\models\hrvc\KpiTeam;
use frontend\models\hrvc\KpiTeamHistory;
use frontend\models\hrvc\Team;
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

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/kpi-detail?id=' . $kpiId);
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
		/*if (isset($_POST["kpiId"])) {
			if (isset($_POST["teamTerget"]) && count($_POST["teamTerget"])) {
				foreach ($_POST["teamTerget"] as $teamId => $target) :
					if ($target != '') {
						$kpiTeam = KpiTeam::find()
							->where(["kpiId" => $_POST["kpiId"], "teamId" => $teamId])
							->one();
						$target = str_replace(",", "", $target);
						$kpiTeam->target = $target;
						$kpiTeam->updateDateTime = new Expression('NOW()');
						$kpiTeam->createrId = Yii::$app->user->id;
						$kpiTeam->save(false);
					}
				endforeach;
			}
		}
		return $this->redirect(Yii::$app->homeUrl . 'kpi/management/assign-kpi');*/

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
		if ($role < 3) {
			return $this->redirect(Yii::$app->homeUrl . 'kpi/management/grid');
		}
		$userId = Yii::$app->user->id;
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

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-team/wait-for-approve');
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

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-team/wait-for-approve');
		$waitForApprove = curl_exec($api);
		$waitForApprove = json_decode($waitForApprove, true);

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

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-team/wait-for-approve');
		$waitForApprove = curl_exec($api);
		$waitForApprove = json_decode($waitForApprove, true);

		curl_close($api);
		
		// throw new exception(print_r($teamkpis, true));

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
	public function actionPrepareUpdate()
	{
		$kpiTeamId = $_POST["kpiTeamId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-team/kpi-team-detail?kpiTeamId=' . $kpiTeamId);
		$kpiTeam = curl_exec($api);
		$kpiTeam = json_decode($kpiTeam, true);
		curl_close($api);
		$res["kpiTeam"] = $kpiTeam;
		return json_encode($res);
	}
	public function actionUpdateKpiTeam()
	{
		$kpiTeamId = $_POST["kpiTeamId"];
		$kpiTeamHistory = new KpiTeamHistory();
		$kpiTeamHistory->kpiTeamId = $kpiTeamId;
		$kpiTeamHistory->result = $_POST["result"];
		if (isset($_POST["targetAmount"])) {
			$kpiTeamHistory->target = $_POST["targetAmount"];
		} else {
			$teamKpi = KpiTeam::find()->where(["kpiTeamId" => $kpiTeamId])->one();
			$kpiTeamHistory->target = $teamKpi["target"];
			$teamKpi->save(false);
		}
		$kpiTeamHistory->status = $_POST["status"];
		$kpiTeamHistory->month = $_POST["month"];
		$kpiTeamHistory->fromDate = $_POST["fromDate"];
		$kpiTeamHistory->toDate = $_POST["toDate"];
		$kpiTeamHistory->month = $_POST["month"];
		$kpiTeamHistory->year = $_POST["year"];
		$kpiTeamHistory->nextCheckDate = $_POST["nextDate"];
		$kpiTeamHistory->detail = $_POST["remark"];
		$kpiTeamHistory->createrId = Yii::$app->user->id;
		$kpiTeamHistory->createDateTime = new Expression('NOW()');
		$kpiTeamHistory->updateDateTime = new Expression('NOW()');
		if ($kpiTeamHistory->save(false)) {
			$teamkpi = KpiTeam::find()->where(["kpiTeamId" => $kpiTeamId])->one();
			$teamkpi->status = $_POST["status"];
			$teamkpi->month = $_POST["month"];
			$teamkpi->year = $_POST["year"];
			$teamkpi->result = $_POST["result"];
			if (isset($_POST["targetAmount"])) {
				$teamkpi->target = $_POST["targetAmount"];
			}
			$teamkpi->fromDate = $_POST["fromDate"];
			$teamkpi->toDate = $_POST["toDate"];
			$teamkpi->nextCheckDate = $_POST["nextDate"];
			$teamkpi->updateDateTime = new Expression('NOW()');
			$teamkpi->save(false);
		}
		return $this->redirect(Yii::$app->request->referrer);
		//return $this->redirect('team-kpi');
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
	public function actionKpiTeamView()
	{
		$kpiTeamId = $_POST["kpiTeamId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-team/kpi-team-detail?kpiTeamId=' . $kpiTeamId);
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

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-team/kpi-team-detail?kpiTeamId=' . $kpiTeamId);
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
			$kpiTeam->save(false);
		}
		return $this->redirect(Yii::$app->homeUrl . 'kpi/kpi-team/team-kpi-grid');
	}
}