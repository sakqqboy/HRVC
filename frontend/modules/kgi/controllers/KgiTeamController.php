<?php

namespace frontend\modules\kgi\controllers;

use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
use frontend\models\hrvc\Company;
use frontend\models\hrvc\Department;
use frontend\models\hrvc\Employee;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\Kgi;
use frontend\models\hrvc\KgiBranch;
use frontend\models\hrvc\KgiEmployee;
use frontend\models\hrvc\KgiEmployeeHistory;
use frontend\models\hrvc\KgiGroup;
use frontend\models\hrvc\KgiTeam;
use frontend\models\hrvc\KgiTeamHistory;
use frontend\models\hrvc\Team;
use frontend\models\hrvc\Unit;
use frontend\models\hrvc\User;
use frontend\models\hrvc\UserRole;
use Yii;
use yii\db\Expression;
use yii\web\Controller;

// header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
// header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
// header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
// header("Cache-Control: post-check=0, pre-check=0", false);
// header("Pragma: no-cache");
class KgiTeamController extends Controller
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
	public function actionKgiTeamSetting($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$kgiId = $param["kgiId"];
		$role = UserRole::userRight();
		if ($role < 3) {
			return $this->redirect(Yii::$app->homeUrl . 'kgi/management/index');
		}

		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-team/kgi-team?kgiId=' . $kgiId);
		$kgiTeams = curl_exec($api);
		$kgiTeams = json_decode($kgiTeams, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiId);
		$kgiDetail = curl_exec($api);
		$kgiDetail = json_decode($kgiDetail, true);
		curl_close($api);
		return $this->render('kgi_team_setting', [
			"kgiTeams" => $kgiTeams,
			"kgiDetail" => $kgiDetail,
			"kgiId" => $kgiId,
			"role" => $role
		]);
	}
	public function actionSetTeamTarget()
	{
		if (isset($_POST["kgiId"])) {
			if (isset($_POST["teamTerget"]) && count($_POST["teamTerget"])) {
				foreach ($_POST["teamTerget"] as $teamId => $target) :
					if ($_POST["role"] == 3) {
						$historyStatus = 88; //if team leder updated need to have the improvement from supervisor or mg
					} else {
						$historyStatus = 1;
					}
					if ($target != '') {
						$kgiTeam = KgiTeam::find()
							->where(["kgiId" => $_POST["kgiId"], "teamId" => $teamId])
							->one();
						$oldTarget = $kgiTeam->target;
						if ($_POST["role"] != 3) { // higher than Team Leader, don't need to approve
							$target = str_replace(",", "", $target);
							$kgiTeam->target = $target;
							$kgiTeam->updateDateTime = new Expression('NOW()');
							$kgiTeam->createrId = Yii::$app->user->id;
							$kgiTeam->remark = $_POST["remark"][$teamId];
							$kgiTeam->save(false);
						}
						//throw new Exception($target . "=>" . $oldTarget);
						if ($oldTarget != $target) {
							$history = KgiTeamHistory::find()
								->where(["kgiTeamId" => $kgiTeam->kgiTeamId, "status" => 88])
								->one();
							if (!isset($history) || empty($history)) {
								$history = new KgiTeamHistory();
								$history->createDateTime = new Expression('NOW()');
							}
							$history->kgiTeamId = $kgiTeam->kgiTeamId;
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
		return $this->redirect(Yii::$app->homeUrl . 'kgi/management/grid');
	}
	public function actionTeamProgress()
	{
		$kgiId = $_POST["kgiId"];
		$teamId = $_POST["teamId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/team/team-detail?id=' . $teamId);
		$teamDetail = curl_exec($api);
		$teamDetail = json_decode($teamDetail, true);


		$kgi = Kgi::find()->select('kgiName')->where(["kgiId" => $kgiId])->asArray()->one();
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-team/kgi-team-history?kgiId=' . $kgiId . '&&teamId=' . $teamId);
		$kgiTeamHistory = curl_exec($api);
		$kgiTeamHistory = json_decode($kgiTeamHistory, true);
		curl_close($api);
		//throw new Exception(print_r($kgiTeamHistory, true));
		$teamText = $this->renderAjax('team_progress', ["kgiTeamHistory" => $kgiTeamHistory]);
		//throw new Exception($teamText);
		$res["teamName"] = $teamDetail["teamName"];
		$res["kgiName"] = $kgi["kgiName"];
		$res["history"] = $teamText;
		return json_encode($res);
	}
	public function actionTeamKgi()
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

		$userTeamId = Team::userTeam($userId);
		$userBranchId = User::userBranchId();
		$userTeamId = Team::userTeam($userId);
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-team/all-team-kgi?userId=' . $userId . '&&role=' . $role);
		$teamKgis = curl_exec($api);
		$teamKgis = json_decode($teamKgis, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/unit/all-unit');
		$units = curl_exec($api);
		$units = json_decode($units, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$companies = curl_exec($api);
		$companies = json_decode($companies, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-team/wait-for-approve?branchId=' . $userBranchId . '&&isAdmin=' . $isAdmin);
		$waitForApprove = curl_exec($api);
		$waitForApprove = json_decode($waitForApprove, true);


		curl_close($api);
		//throw new Exception($role);
		$isManager = UserRole::isManager();
		$months = ModelMaster::monthFull(1);
		return $this->render('team_kgi', [
			"units" => $units,
			"months" => $months,
			"teamKgis" => $teamKgis,
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
	public function actionTeamKgiGrid()
	{
		$role = UserRole::userRight();
		if ($role < 3) {
			//return $this->redirect(Yii::$app->homeUrl . 'kgi/management/grid');
		}
		$groupId = Group::currentGroupId();
		$isAdmin = UserRole::isAdmin();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		$userId = Yii::$app->user->id;
		$userTeamId = Team::userTeam($userId);
		$userBranchId = User::userBranchId();
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-team/all-team-kgi?userId=' . $userId . '&&role=' . $role);
		$teamKgis = curl_exec($api);
		$teamKgis = json_decode($teamKgis, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/unit/all-unit');
		$units = curl_exec($api);
		$units = json_decode($units, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$companies = curl_exec($api);
		$companies = json_decode($companies, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-team/wait-for-approve?branchId=' . $userBranchId . '&&isAdmin=' . $isAdmin);
		$waitForApprove = curl_exec($api);
		$waitForApprove = json_decode($waitForApprove, true);

		curl_close($api);
		// throw new Exception(Yii::$app->user->id);

		//throw new Exception($role);
		// throw new Exception(print_r($teamKgis,true));
		$isManager = UserRole::isManager();
		$months = ModelMaster::monthFull(1);
		return $this->render('kgi_team_grid', [
			"units" => $units,
			"months" => $months,
			"teamKgis" => $teamKgis,
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
	public function actionSearchKgiTeam()
	{
		$companyId = isset($_POST["companyId"]) && $_POST["companyId"] != null ? $_POST["companyId"] : null;
		$branchId = isset($_POST["branchId"]) && $_POST["branchId"] != null ? $_POST["branchId"] : null;
		$teamId = isset($_POST["teamId"]) && $_POST["teamId"] != null ? $_POST["teamId"] : null;
		$month = isset($_POST["month"]) && $_POST["month"] != null ? $_POST["month"] : null;
		$status = isset($_POST["status"]) && $_POST["status"] != null ? $_POST["status"] : null;
		$year = isset($_POST["year"]) && $_POST["year"] != null ? $_POST["year"] : null;
		$type = $_POST["type"];
		return $this->redirect(Yii::$app->homeUrl . 'kgi/kgi-team/kgi-team-search-result/' . ModelMaster::encodeParams([
			"companyId" => $companyId,
			"branchId" => $branchId,
			"teamId" => $teamId,
			"month" => $month,
			"status" => $status,
			"year" => $year,
			"type" => $type
		]));
	}
	public function actionKgiTeamSearchResult($hash)
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
				return $this->redirect(Yii::$app->homeUrl . 'kgi/kgi-team/team-kgi');
			} else {
				return $this->redirect(Yii::$app->homeUrl . 'kgi/kgi-team/team-kgi-grid');
			}
		}
		$paramText = 'companyId=' . $companyId . '&&branchId=' . $branchId . '&&teamId=' . $teamId . '&&month=' . $month . '&&status=' . $status . '&&year=' . $year;
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		//throw new Exception($paramText);
		$userId = Yii::$app->user->id;
		$userTeamId = Team::userTeam($userId);
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-team/kgi-team-filter?' . $paramText);
		$teamKgis = curl_exec($api);
		$teamKgis = json_decode($teamKgis, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/unit/all-unit');
		$units = curl_exec($api);
		$units = json_decode($units, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$companies = curl_exec($api);
		$companies = json_decode($companies, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-team/wait-for-approve?branchId=' . $userBranchId . '&&isAdmin=' . $isAdmin);
		$waitForApprove = curl_exec($api);
		$waitForApprove = json_decode($waitForApprove, true);

		curl_close($api);
		//throw new exception(print_r($teamKgis, true));
		if ($type == "list") {
			$file = "team_kgi";
		} else {
			$file = "kgi_team_grid";
		}
		$months = ModelMaster::monthFull(1);
		$role = UserRole::userRight();
		$isManager = UserRole::isManager();

		return $this->render($file, [
			"units" => $units,
			"months" => $months,
			"teamKgis" => $teamKgis,
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
		$param = ModelMaster::decodeParams($hash);
		$kgiTeamId = $param["kgiTeamId"];
		$role = UserRole::userRight();
		if ($role < 3) {
			return $this->redirect(Yii::$app->homeUrl . 'kgi/management/index');
		}
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-team/kgi-team-detail?kgiTeamId=' . $kgiTeamId . '&&kgiTeamHistoryId=0');
		$kgiTeamDetail = curl_exec($api);
		$kgiTeamDetail = json_decode($kgiTeamDetail, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiTeamDetail['kgiId'] . '&&kgiHistoryId=0');
		$kgi = curl_exec($api);
		$kgi = json_decode($kgi, true);

		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/company-branch?id=' . $kgi["companyId"]);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-branch?id=' . $kgiTeamDetail["kgiId"]);
		$kgiBranch = curl_exec($api);
		$kgiBranch = json_decode($kgiBranch, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-department?id=' . $kgiTeamDetail['kgiId']);
		$kgiDepartment = curl_exec($api);
		$kgiDepartment = json_decode($kgiDepartment, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-team?id=' . $kgiTeamDetail['kgiId']);
		$kgiTeam = curl_exec($api);
		$kgiTeam = json_decode($kgiTeam, true);

		$companyId = $kgi["companyId"];
		$company = [
			"companyId" => $kgi["companyId"],
			"companyName" => Company::companyName($kgi["companyId"]),
			"companyImg" => Company::companyImage($kgi["companyId"]),
		];

		$unit = Unit::find()->where(["unitId" => $kgi["unitId"]])->asArray()->one();

		curl_close($api);
		return $this->render('kgi_form', [
			"kgi" => $kgi,
			"data" => $kgiTeamDetail,
			"company" => $company ?? [],
			"kgiBranch" => $kgiBranch ?? [],
			"kgiDepartment" => $kgiDepartment ?? [],
			"kgiTeam" => $kgiTeam ?? [],
			"role" => $role,
			"unit"  => $unit,
			"kgiTeamId"  => $kgiTeamId,
			"statusform" =>  "update",
			"url" => Yii::$app->request->referrer
		]);
		//$res["kgiTeam"] = $kgiTeam;
		//return json_encode($res);
	}
	public function actionUpdateKgiTeam()
	{
		$kgiTeamId = $_POST["kgiTeamId"];
		$oldKgiTeam = KgiTeam::find()->where(["kgiTeamId" => $kgiTeamId])->orderBy("")->asArray()->one();
		$status =  $_POST["status"];
		$role = UserRole::userRight();
		//throw new exception(print_r(Yii::$app->request->post(), true));
		//throw new exception($oldKgiTeam["target"] . 'เก่าคือ' . $_POST["targetAmount"]);
		if (isset($oldKgiTeam) && !empty($oldKgiTeam)) {
			if (($oldKgiTeam["target"] != $_POST["targetAmount"]) && $role == 3) {
				$status = 88;
			}
		}
		if (isset($_POST["result"])) {
			$result = $_POST["result"];
		} else {
			$result = $_POST["autoUpdate"];
		}
		$kgiTeamHistory = new KgiTeamHistory();
		$kgiTeamHistory->kgiTeamId = $kgiTeamId;
		$kgiTeamHistory->result = $result;
		if (isset($_POST["targetAmount"])) {
			$kgiTeamHistory->target = $_POST["targetAmount"];
		} else {
			$teamKgi = KgiTeam::find()->where(["kgiTeamId" => $kgiTeamId])->one();
			$kgiTeamHistory->target = $teamKgi["target"];
			$teamKgi->save(false);
		}
		// $kgiTeamHistory->status = $_POST["status"];
		$kgiTeamHistory->status = $status;
		$kgiTeamHistory->month = $_POST["month"];
		$kgiTeamHistory->year = $_POST["year"];
		$kgiTeamHistory->fromDate = $_POST["fromDate"];
		$kgiTeamHistory->toDate = $_POST["toDate"];
		$kgiTeamHistory->nextCheckDate = $_POST["nextDate"];
		//$kgiTeamHistory->detail = $_POST["remark"];
		$kgiTeamHistory->createrId = Yii::$app->user->id;
		$kgiTeamHistory->createDateTime = new Expression('NOW()');
		$kgiTeamHistory->updateDateTime = new Expression('NOW()');
		if ($kgiTeamHistory->save(false)) {
			$teamKgi = KgiTeam::find()->where(["kgiTeamId" => $kgiTeamId])->one();
			$teamKgi->status = $_POST["status"];
			$teamKgi->month = $_POST["month"];
			$teamKgi->year = $_POST["year"];
			if (isset($_POST["targetAmount"]) && $role > 3) { //if changed by over team leader
				$teamKgi->target = $_POST["targetAmount"];
			}
			$teamKgi->result = $result;
			$teamKgi->fromDate = $_POST["fromDate"];
			$teamKgi->toDate = $_POST["toDate"];
			$teamKgi->nextCheckDate = $_POST["nextDate"];
			$teamKgi->updateDateTime = new Expression('NOW()');
			$teamKgi->save(false);
		}
		return $this->redirect($_POST["url"]);
		//return $this->redirect('team-kgi');
	}
	public function actionKgiTeamView()
	{
		$kgiTeamId = $_POST["kgiTeamId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-team/kgi-team-detail?kgiTeamId=' . $kgiTeamId . '&&kgiTeamHistoryId=0');
		$kgiTeam = curl_exec($api);
		$kgiTeam = json_decode($kgiTeam, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-team/kgi-team-history-view?kgiTeamId=' . $kgiTeamId);
		$kgiTeamHistory = curl_exec($api);
		$kgiTeamHistory = json_decode($kgiTeamHistory, true);

		curl_close($api);

		$teamText = $this->renderAjax('team_history', ["kgiTeamHistory" => $kgiTeamHistory]);
		$res["kgiTeam"] = $kgiTeam;
		$res["history"] = $teamText;
		return json_encode($res);
	}
	public function actionKgiTeamView2()
	{
		$kgiId = $_POST['kgiId'];
		$teamId = $_POST['teamId'];
		$kgiTeam = KgiTeam::find()->select('kgiTeamId')
			->where(["teamId" => $teamId, "kgiId" => $kgiId, "status" => [1, 2]])
			->asArray()
			->one();
		if (isset($kgiTeam) && !empty($kgiTeam)) {
			$kgiTeamId = $kgiTeam["kgiTeamId"];
			$res["status"] = true;
		} else {
			$res["status"] = false;
		}
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-team/kgi-team-detail?kgiTeamId=' . $kgiTeamId . '&&kgiTeamHistoryId=0');
		$kgiTeam = curl_exec($api);
		$kgiTeam = json_decode($kgiTeam, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-team/kgi-team-history-view?kgiTeamId=' . $kgiTeamId);
		$kgiTeamHistory = curl_exec($api);
		$kgiTeamHistory = json_decode($kgiTeamHistory, true);

		curl_close($api);

		//throw new exception($kgiTeamId);
		$teamText = $this->renderAjax('team_history', ["kgiTeamHistory" => $kgiTeamHistory]);
		$res["kgiTeam"] = $kgiTeam;
		$res["history"] = $teamText;
		return json_encode($res);
	}
	public function actionKgiTeam()
	{
		$kgiId = $_POST["kgiId"];
		$kgiIds = [];
		$res = [];
		$kgi = KgiTeam::find()->where(["kgiId" => $kgiId, "status" => [1, 2, 4]])->asArray()->all();
		if (isset($kgi) && count($kgi) > 0) {
			$i = 0;
			foreach ($kgi as $k) :
				$kgiIds[$i] = $k["teamId"];
				$i++;
			endforeach;
		}
		if (count($kgiIds) > 0) {
			$res["status"] = true;
		} else {
			$res["status"] = false;
		}
		$res["kgiId"] = $kgiIds;
		return json_encode($res);
	}
	public function actionDeleteKgiTeam()
	{
		$kgiTeamId = $_POST["kgiTeamId"];
		// throw new exception($kgiTeamId);
		KgiTeam::updateAll(["status" => 99], ["kgiTeamId" => $kgiTeamId]);
		KgiTeamHistory::updateAll(["status" => 99], ["kgiTeamId" => $kgiTeamId]);
		$res["status"] = true;
		return json_encode($res);
	}
	public function actionUpdateTargetKgiTeam()
	{
		$teamKgi = KgiTeam::find()->where(["status" => [1, 2]])->asArray()->all();
		if (isset($teamKgi) && count($teamKgi) > 0) {
			foreach ($teamKgi as $tk) :
				KgiTeamHistory::updateAll(["target" => $tk["target"]], ["kgiTeamId" => $tk["kgiTeamId"]]);
			endforeach;
		}
	}
	public function actionAssignKgiTeam()
	{
		$kgiId = $_POST["kgiId"];
		$teams = Team::find()
			->where(["status" => 1])
			->orderBy("departmentId,teamName")
			->all();
		$textTeam = $this->renderAjax('team', ["teams" => $teams, "kgiId" => $kgiId, "checkAll" => '']);
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
		$kgiId = $_POST["kgiId"];
		$departmentId = $_POST["departmentId"];
		$teams = Team::find()
			->where(["status" => 1])
			->andWhere("teamName LIKE  '" . $teamName . "%'")
			->andFilterWhere(["departmentId" => $departmentId])
			->orderBy("departmentId,teamName")
			->all();
		$textTeam = $this->renderAjax('team', ["teams" => $teams, "kgiId" => $kgiId, "checkAll" => '']);
		$res["textTeam"] = $textTeam;
		return json_encode($res);
	}
	public function actionKgiAssignTeam()
	{
		$teamId = $_POST["teamId"];
		$kgiId = $_POST["kgiId"];
		$checked = $_POST["checked"];
		$kgiTeam = KgiTeam::find()
			->where(["kgiId" => $kgiId, "teamId" => $teamId, "status" => [1, 2]])
			->one();
		if (isset($kgiTeam) && !empty($kgiTeam)) {
			if ($checked == 1) {
				KgiTeam::updateAll(["status" => 1], ["kgiId" => $kgiId, "teamId" => $teamId]);
			} else {
				$kgiTeam->delete();
			}
		} else {
			$kgiTeam = new KgiTeam();
			$kgiTeam->kgiId = $kgiId;
			$kgiTeam->teamId = $teamId;
			$kgiTeam->status = 1;
			$kgiTeam->createDateTime = new Expression('NOW()');
			$kgiTeam->updateDateTime = new Expression('NOW()');
			$kgiTeam->save(false);
		}
		$kgiTeams = KgiTeam::find()
			->where(["kgiId" => $kgiId, "status" => [1, 2, 4]])
			->asArray()
			->all();
		$res["status"] = true;
		$res["countTeam"] = count($kgiTeams);
		return json_encode($res);
	}
	public function actionCheckAllKgiTeam()
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
	public function actionNextKgiTeamHistory()
	{
		$kgiTeamHistoryId = $_POST["kgiTeamHistoryId"];
		$currentHistory = KgiTeamHistory::find()->where(["kgiTeamHistoryId" => $kgiTeamHistoryId])->asArray()->one();
		$kgiTeam = KgiTeam::find()->where(["kgiTeamId" => $currentHistory["kgiTeamId"]])->asArray()->one();
		$kgi = Kgi::find()->where(["kgiId" => $kgiTeam["kgiId"]])->asArray()->one();
		$unit = Unit::find()->where(["unitId" => $kgi["unitId"]])->asArray()->one();
		if ($currentHistory["month"] != "" && $currentHistory["year"] != "") {
			$nextTargetMonthYear = ModelMaster::nextTargetMonthYear($unit["unitName"], $currentHistory["month"], $currentHistory["year"]);
			$nextMonth = $nextTargetMonthYear["nextMonth"];
			$nextYear = $nextTargetMonthYear["nextYear"];
		} else {
			$nextMonth = null;
			$nextYear = null;
		}
		$kgiTeamHistory = new KgiTeamHistory();
		$kgiTeamHistory->kgiTeamId = $currentHistory["kgiTeamId"];
		$kgiTeamHistory->detail = 'Set new target';
		$kgiTeamHistory->nextCheckDate = null;
		$kgiTeamHistory->status = 1;
		$kgiTeamHistory->target = $currentHistory["target"];
		$kgiTeamHistory->result = 0;
		$kgiTeamHistory->month = $nextMonth;
		$kgiTeamHistory->createrId = Yii::$app->user->id;
		$kgiTeamHistory->year = $nextYear;
		$kgiTeamHistory->createDateTime = new Expression('NOW()');
		$kgiTeamHistory->updateDateTime = new Expression('NOW()');
		if ($kgiTeamHistory->save(false)) {
			$kgiTeam = KgiTeam::find()->where(["kgiTeamId" => $currentHistory["kgiTeamId"]])->one();
			$kgiTeam->status = 1;
			$kgiTeam->month = $nextMonth;
			$kgiTeam->year = $nextYear;
			$kgiTeam->updateDateTime = new Expression('NOW()');
			if($kgiTeam->save(false)){
				// $KgiEmployee = KgiEmployee::find()->where(["kgiId" => $kgiTeam["kgiId"]])->all();

				$KgiEmployee = KgiEmployee::find()
				->leftJoin("employee" , "employee.employeeId = kgi_employee.employeeId")
				->where(["kgi_employee.kgiId" => $kgiTeam["kgiId"],"employee.teamId" => $kgiTeam["teamId"],"kgi_employee.status" => [1,2,4]])
				->all();
				
				// throw new Exception(print_r($kpiEmpoyee, true)); 
				foreach($KgiEmployee as $empoyee) :
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
						$KgiEmployeeHistory = new KgiEmployeeHistory();
						$KgiEmployeeHistory->kgiEmployeeId = $empoyee -> kgiEmployeeId;
						$KgiEmployeeHistory->createrId = Yii::$app->user->id;
						$KgiEmployeeHistory->month = $nextMonth;
						$KgiEmployeeHistory->year = $nextYear;
						$KgiEmployeeHistory->createDateTime = new Expression('NOW()');
						$KgiEmployeeHistory->updateDateTime = new Expression('NOW()');
						$KgiEmployeeHistory-> detail = "auto set from company kpi";
						$KgiEmployeeHistory->status = $status;
						$KgiEmployeeHistory->save(false);
						$empoyee -> save(false);

					}
				endforeach;
			}
		}
		// return $this->redirect(Yii::$app->homeUrl . 'kgi/kgi-team/team-kgi-grid');
		return $this->redirect(Yii::$app->request->referrer);
	}
	public function actionKgiTeamHistory($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$kgiTeamId = $param["kgiTeamId"];
		$openTab = isset($param["openTab"]) ? $param["openTab"] : 1;
		$kgiTeamHistoryId = $param["kgiTeamHistoryId"];
		// throw new exception(print_r($kgiTeamHistoryId, true));
		$kgiTeamHistory = KgiTeamHistory::find()
			->select('kgiTeamHistoryId')
			->where(["kgiTeamId" => $kgiTeamId])
			->orderBy("kgiTeamHistoryId DESC")
			->asArray()
			->one();
		if (isset($kgiTeamHistory) && !empty($kgiTeamHistory)) {
			$kgiTeamHistoryId = $kgiTeamHistory["kgiTeamHistoryId"];
		}
		$kgiId = $param["kgiId"];
		$role = UserRole::userRight();
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-team/kgi-team-detail?kgiTeamId=' . $kgiTeamId . '&&kgiTeamHistoryId=' . $kgiTeamHistoryId);
		$kgiTeamDetail = curl_exec($api);
		$kgiTeamDetail = json_decode($kgiTeamDetail, true);

				// throw new exception(print_r($kgiTeamDetail, true));

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/unit/all-unit');
		$units = curl_exec($api);
		$units = json_decode($units, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$companies = curl_exec($api);
		$companies = json_decode($companies, true);
		curl_close($api);
		$res["kgiTeam"] = $kgiTeamDetail;
		$isManager = UserRole::isManager();
		$months = ModelMaster::monthFull(1);
		//throw new exception(print_r($kgiTeamDetail, true));
		return $this->render('kgi_team_history', [
			"role" => $role,
			"kgiTeamDetail" => $kgiTeamDetail,
			"units" => $units,
			"months" => $months,
			"isManager" => $isManager,
			"companies" => $companies,
			"kgiId" => $kgiId,
			"kgiTeamHistoryId" => $kgiTeamHistoryId,
			"openTab" => $openTab,
			"kgiTeamId" => $kgiTeamId
		]);
	}
	public function actionKgiTeamEmployee()
	{
		$kgiId = $_POST["kgiId"];
		$kgiTeamHistoryId = $_POST["kgiTeamHistoryId"];
		$res["kgiEmployeeTeam"] = "";
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-team/kgi-team-summarize?kgiId=' . $kgiId);
		$kgiTeams = curl_exec($api);
		$kgiTeams = json_decode($kgiTeams, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiId . "&&kgiHistoryId=0");
		$kgiDetail = curl_exec($api);
		$kgiDetail = json_decode($kgiDetail, true);
		curl_close($api);
		$res["kgiEmployeeTeam"] = $this->renderAjax("kgi_employee_team", [
			"kgiTeams" => $kgiTeams,
			"kgiDetail" => $kgiDetail

		]);
		return json_encode($res);
	}
	public function actionAllKgiHistory()
	{
		$kgiTeamId = $_POST["kgiTeamId"];
		$kgiTeamHistoryId = $_POST["kgiTeamHistoryId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiId);
		// $kgi = curl_exec($api);
		// $kgi = json_decode($kgi, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-team/kgi-team-history2?kgiTeamId=' . $kgiTeamId . '&&kgiTeamHistoryId=' . $kgiTeamHistoryId);
		$history = curl_exec($api);
		$history = json_decode($history, true);
		curl_close($api);
		$monthDetail = [];
		$summarizeMonth = [];
		//throw new Exception(print_r($history, true));
		$res["monthlyDetailHistoryText"] = "";
		if ($kgiTeamHistoryId != 0) {
			$kgiTeamHistory = KgiTeamHistory::find()
				->where(["kgiTeamHistoryId" => $kgiTeamHistoryId])
				->asArray()
				->one();
			$year = $kgiTeamHistory["year"];
			$month = $kgiTeamHistory["month"];
		} else {
			$year = 0;
			$month = 0;
		}
		if (isset($history) && count($history) > 0) {
			//krsort($history);
			foreach ($history as $kgiHistoryId => $ht):
				if ($year != 0 && $month != 0 && $ht["year"] <= $year) {
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
									"kgiHistoryId" => $kgiHistoryId

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
								"kgiHistoryId" => $kgiHistoryId

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
							"kgiHistoryId" => $kgiHistoryId

						];
					}
				}
			endforeach;
			$res["monthlyDetailHistoryText"] = $this->renderAjax('kgi_update_history', [
				"monthDetail" => $monthDetail,
				"summarizeMonth" => $summarizeMonth
			]);
		}
		return json_encode($res);
	}
	public function actionKgiTeamChart()
	{
		$kgiId = $_POST["kgiId"];
		$kgiTeamHistoryId = $_POST["kgiTeamHistoryId"];
		$kgiTeamId = $_POST["kgiTeamId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		//curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-history?kgiId=' . $kgiId);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-team/kgi-team-history-for-chart?kgiTeamHistoryId=' . $kgiTeamHistoryId . '&&kgiTeamId=' . $kgiTeamId);
		$history = curl_exec($api);
		$history = json_decode($history, true);
		curl_close($api);
		$monthDetail = [];
		$summarizeMonth = [];
		$summarizeMonth2 = [];
		$months = ModelMaster::month();
		$monthText = '';
		$target = [];
		$targetText = "";
		$resultText = "";
		$result = [];
		//ksort($month);
		$res["monthlyDetailHistoryText"] = "";
		if ($kgiTeamHistoryId != 0) {
			$kgiHistory = KgiTeamHistory::find()
				->where(["kgiTeamHistoryId" => $kgiTeamHistoryId])
				->asArray()
				->one();
			$year = $kgiHistory["year"];
			$month = $kgiHistory["month"];
		} else {
			$year = '';
			$month = '';
		}
		//throw new exception(print_r($history, true));
		if (isset($history) && count($history) > 0) {
			$i = 0;
			foreach ($history as $kgiTeamHistoryId => $ht):
				if ($year != '' && $month != '' && $ht["year"] <= $year) {
					if ($ht["year"] == $year) {
						if ($ht["month"] <= $month) {
							if (!isset($summarizeMonth[$ht["year"]][$ht["month"]])) {
								$summarizeMonth[$ht["year"]][$ht["month"]] = [
									"year" => $ht["year"],
									"kgiTeamHistoryId" => $kgiTeamHistoryId
								];
								$summarizeMonth2[$i] = [
									"year" => $ht["year"],
									"month" => ModelMaster::fullMonthText($ht["month"]),
									"result" => $ht["result"],
									"target" => $ht["target"],
									"kgiTeamHistoryId" => $kgiTeamHistoryId
								];
							}
						}
					} else {
						if (!isset($summarizeMonth[$ht["year"]][$ht["month"]])) {
							$summarizeMonth[$ht["year"]][$ht["month"]] = [
								"year" => $ht["year"],
								"kgiTeamHistoryId" => $kgiTeamHistoryId
							];
							$summarizeMonth2[$i] = [
								"year" => $ht["year"],
								"month" => ModelMaster::fullMonthText($ht["month"]),
								"result" => $ht["result"],
								"target" => $ht["target"],
								"kgiTeamHistoryId" => $kgiTeamHistoryId
							];
						}
					}
				} else {
					if (!isset($summarizeMonth[$ht["year"]][$ht["month"]])) {
						$summarizeMonth[$ht["year"]][$ht["month"]] = [
							"year" => $ht["year"],
							"kgiTeamHistoryId" => $kgiTeamHistoryId
						];
						$summarizeMonth2[$i] = [
							"year" => $ht["year"],
							"month" => ModelMaster::fullMonthText($ht["month"]),
							"result" => $ht["result"],
							"target" => $ht["target"],
							"kgiTeamHistoryId" => $kgiTeamHistoryId
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
		$res["kgiChart"] = $this->renderAjax('kgi_chart', [
			"month" => $monthText,
			"target" => $targetText,
			"result" => $resultText
		]);
		return json_encode($res);
	}
	public function actionKgiTeamUpdate()
	{
		$kgiId = $_POST["kgiId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-team/kgi-team?kgiId=' . $kgiId);
		$kgiTeams = curl_exec($api);
		$kgiTeams = json_decode($kgiTeams, true);

		// throw new Exception( print_r($kgiTeams, true));

		curl_close($api);
		$allDepartment = [];
		if (isset($kgiTeams) && count($kgiTeams) > 0) {
			foreach ($kgiTeams as $kgt):
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
				"kgiId" => $kgiId
			]);
		}
		$res["textTeam"] = $textTeam;
		$res["countTeam"] = count($kgiTeams);
		return json_encode($res);
	}
	public function actionAutoResult()
	{
		$kgiTeamId = $_POST["kgiTeamId"];
		$kgiTeam = KgiTeam::find()->where(["kgiTeamId" => $kgiTeamId])->asArray()->one();
		$year = $kgiTeam["year"];
		$month = $kgiTeam["month"];
		$kgiEmployee = KgiEmployee::find()
			->JOIN("LEFT JOIN", "employee e", "e.employeeId=kgi_employee.employeeId")
			->where([
				"e.teamId" => $kgiTeam["teamId"],
				"e.status" => 1,
				"kgi_employee.status" => [1, 2, 4],
				"kgi_employee.month" => $month,
				"kgi_employee.year" => $year
			])
			->asArray()
			->all();
		$autoResult = 0;
		if (isset($kgiEmployee) && count($kgiEmployee) > 0) {
			foreach ($kgiEmployee as $kg):
				$autoResult += $kg["result"];
			endforeach;
		}
		$res["result"] = $autoResult;
		return json_encode($res);
	}
	public function actionKgiUpdateHistory()
	{
		$kgiId = $_POST["kgiId"];
		$res = [];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiId . '&&kgiHistoryId=0');
		$kgi = curl_exec($api);
		$kgi = json_decode($kgi, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-team/kgi-history-team?kgiId=' . $kgiId);
		$kgiHistoryTeam = curl_exec($api);
		$kgiHistoryTeam = json_decode($kgiHistoryTeam, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-personal/kgi-history-employee?kgiId=' . $kgiId);
		$kgiHistoryEmployee = curl_exec($api);
		$kgiHistoryEmployee = json_decode($kgiHistoryEmployee, true);

		curl_close($api);
		$res["month"] = $kgi["monthFullName"];
		$res["year"] = $kgi["year"];
		$res["fromDate"] = $kgi["fromDateFormat"];
		$res["toDate"] = $kgi["toDateFormat"];
		$res["target"] = number_format($kgi["targetAmount"]);
		$res["result"] = number_format($kgi["result"]);
		$res["ratio"] = (int)$kgi["ratio"];
		$res["dueBehide"] = 100 - (int)$kgi["ratio"];

		$teamText = $this->renderAjax('team_history', ["kgiHistoryTeam" => $kgiHistoryTeam]);
		$individualText = $this->renderAjax('individual_history', ["kgiHistoryEmployee" => $kgiHistoryEmployee]);
		$res["teamText"] = $teamText;
		$res["individualText"] = $individualText;
		return json_encode($res);
	}
}