<?php

namespace frontend\modules\kgi\controllers;

use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
use frontend\models\hrvc\Department;
use frontend\models\hrvc\Employee;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\Kgi;
use frontend\models\hrvc\KgiBranch;
use frontend\models\hrvc\KgiGroup;
use frontend\models\hrvc\KgiTeam;
use frontend\models\hrvc\KgiTeamHistory;
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

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-team/wait-for-approve');
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
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		$userId = Yii::$app->user->id;
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

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-team/wait-for-approve');
		$waitForApprove = curl_exec($api);
		$waitForApprove = json_decode($waitForApprove, true);

		curl_close($api);
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

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-team/wait-for-approve');
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
	public function actionPrepareUpdate()
	{
		$kgiTeamId = $_POST["kgiTeamId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-team/kgi-team-detail?kgiTeamId=' . $kgiTeamId);
		$kgiTeam = curl_exec($api);
		$kgiTeam = json_decode($kgiTeam, true);
		curl_close($api);
		$res["kgiTeam"] = $kgiTeam;
		return json_encode($res);
	}
	public function actionUpdateKgiTeam()
	{
		$kgiTeamId = $_POST["kgiTeamId"];
		$oldKgiTeam = KgiTeam::find()->where(["kgiTeamId" => $kgiTeamId])->orderBy("")->asArray()->one();
		$status = 1;
		$role = UserRole::userRight();
		//throw new exception($oldKgiTeam["target"] . 'เก่าคือ' . $_POST["targetAmount"]);
		if (isset($oldKgiTeam) && !empty($oldKgiTeam)) {
			if (($oldKgiTeam["target"] != $_POST["targetAmount"]) && $role == 3) {
				$status = 88;
			}
		}
		$kgiTeamHistory = new KgiTeamHistory();
		$kgiTeamHistory->kgiTeamId = $kgiTeamId;
		$kgiTeamHistory->result = $_POST["result"];
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
		$kgiTeamHistory->detail = $_POST["remark"];
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
			$teamKgi->result = $_POST["result"];
			$teamKgi->fromDate = $_POST["fromDate"];
			$teamKgi->toDate = $_POST["toDate"];
			$teamKgi->nextCheckDate = $_POST["nextDate"];
			$teamKgi->updateDateTime = new Expression('NOW()');
			$teamKgi->save(false);
		}
		return $this->redirect(Yii::$app->request->referrer);
		//return $this->redirect('team-kgi');
	}
	public function actionKgiTeamView()
	{
		$kgiTeamId = $_POST["kgiTeamId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-team/kgi-team-detail?kgiTeamId=' . $kgiTeamId);
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

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-team/kgi-team-detail?kgiTeamId=' . $kgiTeamId);
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
		$kgiTeamHistory->detail = 'New target';
		$kgiTeamHistory->nextCheckDate = null;
		$kgiTeamHistory->status = 1;
		$kgiTeamHistory->target = $currentHistory["target"];
		$kgiTeamHistory->result = 0;
		$kgiTeamHistory->month = $nextMonth;
		$kgiTeamHistory->year = $nextYear;
		$kgiTeamHistory->createDateTime = new Expression('NOW()');
		$kgiTeamHistory->updateDateTime = new Expression('NOW()');
		if ($kgiTeamHistory->save(false)) {
			$kgiTeam = KgiTeam::find()->where(["kgiTeamId" => $currentHistory["kgiTeamId"]])->one();
			$kgiTeam->status = 1;
			$kgiTeam->month = $nextMonth;
			$kgiTeam->year = $nextYear;
			$kgiTeam->updateDateTime = new Expression('NOW()');
			$kgiTeam->save(false);
		}
		return $this->redirect(Yii::$app->homeUrl . 'kgi/kgi-team/team-kgi-grid');
	}
}
