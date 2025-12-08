<?php

namespace frontend\modules\kgi\controllers;

use common\helpers\Path;
use common\helpers\Session;
use common\models\ModelMaster;
use Exception;
use frontend\components\Api;
use frontend\models\hrvc\Branch;
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

class KgiTeamController extends Controller
{
	public function beforeAction($action)
	{
		if (Yii::$app->user->id == '') {
			Yii::$app->response->redirect(Yii::$app->homeUrl . 'site/login');
			return false;
		}
		return parent::beforeAction($action);
	}
	public function actionKgiTeamSetting($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$kgiId = $param["kgiId"];
		$role = UserRole::userRight();
		if ($role < 3) {
			return $this->redirect(Yii::$app->homeUrl . 'kgi/management/index');
		}
		$kgiTeams = Api::connectApi(Path::Api() . 'kgi/kgi-team/kgi-team?kgiId=' . $kgiId);
		$kgiDetail = Api::connectApi(Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiId);
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
					$historyStatus = ($_POST["role"] == 3) ? 88 : 1;
					if ($target != '') {
						$kgiTeam = KgiTeam::find()->where(["kgiId" => $_POST["kgiId"], "teamId" => $teamId])->one();
						$oldTarget = $kgiTeam->target;
						if ($_POST["role"] != 3) {
							$target = str_replace(",", "", $target);
							$kgiTeam->target = $target;
							$kgiTeam->updateDateTime = new Expression('NOW()');
							$kgiTeam->createrId = Yii::$app->user->id;
							$kgiTeam->remark = $_POST["remark"][$teamId];
							$kgiTeam->save(false);
						}
						if ($oldTarget != $target) {
							$history = KgiTeamHistory::find()->where(["kgiTeamId" => $kgiTeam->kgiTeamId, "status" => 88])->one();
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
		$teamDetail = Api::connectApi(Path::Api() . 'masterdata/team/team-detail?id=' . $teamId);
		$kgi = Kgi::find()->select('kgiName')->where(["kgiId" => $kgiId])->asArray()->one();
		$kgiTeamHistory = Api::connectApi(Path::Api() . 'kgi/kgi-team/kgi-team-history?kgiId=' . $kgiId . '&&teamId=' . $teamId);
		$teamText = $this->renderAjax('team_progress', ["kgiTeamHistory" => $kgiTeamHistory]);
		$res["teamName"] = $teamDetail["teamName"];
		$res["kgiName"] = $kgi["kgiName"];
		$res["history"] = $teamText;
		return json_encode($res);
	}
	public function actionTeamKgi($hash = null)
	{
		$role = UserRole::userRight();
		$adminId = $gmId = $teamLeaderId = $managerId = $supervisorId = $staffId = '';
		if ($role == 7) $adminId = Yii::$app->user->id;
		if ($role == 6) $gmId = Yii::$app->user->id;
		if ($role == 5) $managerId = Yii::$app->user->id;
		if ($role == 4) $supervisorId = Yii::$app->user->id;
		if ($role == 3) $teamLeaderId = Yii::$app->user->id;
		if ($role == 1 || $role == 2) $staffId = Yii::$app->user->id;
		$groupId = Group::currentGroupId();
		if ($groupId == null) return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		$userId = Yii::$app->user->id;
		$isAdmin = UserRole::isAdmin();
		$userTeamId = Team::userTeam($userId);
		$userBranchId = User::userBranchId();
		$session = Yii::$app->session;
		if ($session->has('kgiTeam')) {
			$filter = $session->get('kgiTeam');
			$companyId = $filter["companyId"] ?? null;
			$branchId = $filter["branchId"] ?? null;
			$teamId = $filter["teamId"] ?? null;
			$month = $filter["month"] ?? null;
			$status = $filter["status"] ?? null;
			$year = $filter["year"] ?? null;
			$type = "list";
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
		$currentPage = (isset($hash) && $hash != '') ? explode('page', $hash)[1] : 1;
		$limit = 20;
		$teamKgis = Api::connectApi(Path::Api() . 'kgi/kgi-team/all-team-kgi?userId=' . $userId . '&&role=' . $role . '&&currentPage=' . $currentPage . '&&limit=' . $limit);
		$units = Api::connectApi(Path::Api() . 'masterdata/unit/all-unit');
		$companies = Api::connectApi(Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$waitForApprove = Api::connectApi(Path::Api() . 'kgi/kgi-team/wait-for-approve?branchId=' . $userBranchId . '&&isAdmin=' . $isAdmin);
		$allCompany = Api::connectApi(Path::Api() . 'masterdata/company/all-company');
		$totalBranch = Branch::totalBranch();
		$countAllCompany = count($allCompany) > 0 ? count($allCompany) : 0;
		$companyPic = $countAllCompany > 0 ? Company::randomPic($allCompany, 3) : null;
		$employee = Employee::employeeDetailByUserId(Yii::$app->user->id);
		$employeeCompanyId = $employee["companyId"];
		$isManager = UserRole::isManager();
		$months = ModelMaster::monthFull(1);
		$totalKgi = KgiTeam::totalKgiTeam($adminId, $gmId, $managerId, $supervisorId, $teamLeaderId, $staffId, $employee["employeeId"]);
		$totalPage = ceil($totalKgi / $limit);
		$pagination = ModelMaster::getPagination($currentPage, $totalPage);
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
			"waitForApprove" => $waitForApprove,
			"employeeCompanyId" => $employeeCompanyId,
			"allCompany" => $countAllCompany,
			"companyPic" => $companyPic,
			"totalBranch" => $totalBranch,
			"totalKgi" => $totalKgi,
			"currentPage" => $currentPage,
			"totalPage" => $totalPage,
			"pagination" => $pagination
		]);
	}

	public function actionTeamKgiGrid($hash = null)
	{
		$role = UserRole::userRight();
		$adminId = $gmId = $managerId = $supervisorId = $teamLeaderId = $staffId = '';

		if ($role == 7) $adminId = Yii::$app->user->id;
		if ($role == 6) $gmId = Yii::$app->user->id;
		if ($role == 5) $managerId = Yii::$app->user->id;
		if ($role == 4) $supervisorId = Yii::$app->user->id;
		if ($role == 3) $teamLeaderId = Yii::$app->user->id;
		if ($role == 1 || $role == 2) $staffId = Yii::$app->user->id;

		$groupId = Group::currentGroupId();
		$isAdmin = UserRole::isAdmin();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}

		$userId = Yii::$app->user->id;
		$userTeamId = Team::userTeam($userId);
		$userBranchId = User::userBranchId();

		$session = Yii::$app->session;
		if ($session->has('kgiTeam')) {
			$filter = $session->get('kgiTeam');
			return $this->redirect(
				Yii::$app->homeUrl . 'kgi/kgi-team/kgi-team-search-result/' .
					ModelMaster::encodeParams([
						"companyId" => $filter["companyId"] ?? null,
						"branchId" => $filter["branchId"] ?? null,
						"teamId" => $filter["teamId"] ?? null,
						"month" => $filter["month"] ?? null,
						"status" => $filter["status"] ?? null,
						"year" => $filter["year"] ?? null,
						"type" => "grid"
					])
			);
		}

		$currentPage = 1;
		if (!empty($hash)) {
			$pageArr = explode('page', $hash);
			$currentPage = $pageArr[1] ?? 1;
		}
		$limit = 20;
		// throw new exception('kgi/kgi-team/all-team-kgi?userId=' . $userId . '&&role=' . $role . '&&currentPage=' . $currentPage . '&&limit=' . $limit);
		// ใช้ Api::connectApi() แทน curl
		$teamKgis = Api::connectApi(Path::Api() . 'kgi/kgi-team/all-team-kgi?userId=' . $userId . '&&role=' . $role . '&&currentPage=' . $currentPage . '&&limit=' . $limit);
		$units = Api::connectApi(Path::Api() . 'masterdata/unit/all-unit');
		$companies = Api::connectApi(Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$waitForApprove = Api::connectApi(Path::Api() . 'kgi/kgi-team/wait-for-approve?branchId=' . $userBranchId . '&&isAdmin=' . $isAdmin);
		$allCompany = Api::connectApi(Path::Api() . 'masterdata/company/all-company');

		$totalBranch = Branch::totalBranch();
		$countAllCompany = 0;
		if (!empty($allCompany)) {
			$countAllCompany = count($allCompany);
			$companyPic = Company::randomPic($allCompany, 3);
		}

		$employee = Employee::employeeDetailByUserId($userId);
		$employeeCompanyId = $employee["companyId"];
		$isManager = UserRole::isManager();
		$months = ModelMaster::monthFull(1);

		$totalKgi = KgiTeam::totalKgiTeam($adminId, $gmId, $managerId, $supervisorId, $teamLeaderId, $staffId, $employee["employeeId"]);
		$totalPage = ceil($totalKgi / $limit);
		$pagination = ModelMaster::getPagination($currentPage, $totalPage);

		return $this->render('kgi_team_grid', [
			"units" => $units,
			"months" => $months,
			"teamKgis" => $teamKgis,
			"role" => $role,
			"userId" => $userId,
			"isManager" => $isManager,
			"companies" => $companies,
			"userTeamId" => $userTeamId,
			"allCompany" => $countAllCompany,
			"companyPic" => $companyPic ?? null,
			"totalBranch" => $totalBranch,
			"companyId" => null,
			"branchId" => null,
			"teamId" => null,
			"month" => null,
			"status" => null,
			"year" => null,
			"waitForApprove" => $waitForApprove,
			"employeeCompanyId" => $employeeCompanyId,
			"totalKgi" => $totalKgi,
			"currentPage" => $currentPage,
			"totalPage" => $totalPage,
			"pagination" => $pagination,
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
		Session::PimTeamFilter($companyId, $branchId, $teamId, $month, $year, $status, $type);
		if ($companyId == "" && $branchId == "" && $teamId == "" && $month == "" && $status == "" && $year == "") {
			if ($type == "list") {
				return $this->redirect(Yii::$app->homeUrl . 'kgi/kgi-team/team-kgi');
			} else {
				return $this->redirect(Yii::$app->homeUrl . 'kgi/kgi-team/team-kgi-grid');
			}
		}
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		$currentPage = 1;
		$limit = 20;
		if (isset($param["currentPage"])) {
			$currentPage = $param["currentPage"];
		}
		$paramText = 'companyId=' . $companyId . '&&branchId=' . $branchId . '&&teamId=' . $teamId . '&&month=' . $month . '&&status=' . $status . '&&year=' . $year . '&&currentPage=' . $currentPage . '&&limit=' . $limit;

		$userId = Yii::$app->user->id;
		$userTeamId = Team::userTeam($userId);
		$teamKgis = Api::connectApi(Path::Api() . 'kgi/kgi-team/kgi-team-filter?' . $paramText);
		$units = Api::connectApi(Path::Api() . 'masterdata/unit/all-unit');
		$companies = Api::connectApi(Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$waitForApprove = Api::connectApi(Path::Api() . 'kgi/kgi-team/wait-for-approve?branchId=' . $userBranchId . '&&isAdmin=' . $isAdmin);
		$allCompany = Api::connectApi(Path::Api() . 'masterdata/company/all-company');

		$totalBranch = Branch::totalBranch();
		$countAllCompany = 0;
		if (count($allCompany) > 0) {
			$countAllCompany = count($allCompany);
			$companyPic = Company::randomPic($allCompany, 3);
		}
		$employee = Employee::employeeDetailByUserId(Yii::$app->user->id);
		$employeeCompanyId = $employee["companyId"];
		if ($type == "list") {
			$file = "team_kgi";
		} else {
			$file = "kgi_team_grid";
		}
		$months = ModelMaster::monthFull(1);
		$role = UserRole::userRight();
		$isManager = UserRole::isManager();
		$totalKgi = $teamKgis["total"];
		$totalPage = ceil($totalKgi / $limit);
		$pagination = ModelMaster::getPagination($currentPage, $totalPage);
		$filter = [
			"companyId" => $companyId,
			"branchId" => $branchId,
			"teamId" => $teamId,
			"month" => $month,
			"year" => $year,
			"status" => $status,
			"perPage" => 20,
		];
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
			"waitForApprove" => $waitForApprove,
			"allCompany" => $countAllCompany,
			"companyPic" => $companyPic,
			"totalBranch" => $totalBranch,
			"filter" => $filter,
			"employeeCompanyId" => $employeeCompanyId,
			"pagination" => $pagination,
			"totalKgi" => $totalKgi,
			"currentPage" => $currentPage,
			"totalPage" => $totalPage,
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

		$kgiTeamDetail = Api::connectApi(Path::Api() . 'kgi/kgi-team/kgi-team-detail?kgiTeamId=' . $kgiTeamId . '&&kgiTeamHistoryId=0');
		$kgi = Api::connectApi(Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiTeamDetail['kgiId'] . '&&kgiHistoryId=0');
		$kgiBranch = Api::connectApi(Path::Api() . 'kgi/management/kgi-branch?id=' . $kgiTeamDetail["kgiId"]);
		$kgiDepartment = Api::connectApi(Path::Api() . 'kgi/management/kgi-department?id=' . $kgiTeamDetail['kgiId']);
		$kgiTeam = Api::connectApi(Path::Api() . 'kgi/management/kgi-team?id=' . $kgiTeamDetail['kgiId']);
		$allCompany = Api::connectApi(Path::Api() . 'masterdata/company/all-company');

		$companyId = $kgi["companyId"];
		$company = [
			"companyId" => $kgi["companyId"],
			"companyName" => Company::companyName($kgi["companyId"]),
			"companyImg" => Company::companyImage($kgi["companyId"]),
		];

		$unit = Unit::find()->where(["unitId" => $kgi["unitId"]])->asArray()->one();

		$totalBranch = Branch::totalBranch();
		$countAllCompany = 0;
		if (count($allCompany) > 0) {
			$countAllCompany = count($allCompany);
			$companyPic = Company::randomPic($allCompany, 3);
		}

		return $this->render('kgi_form', [
			"kgi" => $kgi,
			"data" => $kgiTeamDetail,
			"company" => $company ?? [],
			"kgiBranch" => $kgiBranch ?? [],
			"kgiDepartment" => $kgiDepartment ?? [],
			"kgiTeam" => $kgiTeam ?? [],
			"role" => $role,
			"unit" => $unit,
			"kgiTeamId" => $kgiTeamId,
			"statusform" => "update",
			"url" => Yii::$app->request->referrer,
			"allCompany" => $countAllCompany,
			"companyPic" => $companyPic,
			"totalBranch" => $totalBranch
		]);
	}

	public function actionUpdateKgiTeam()
	{

		$post = Yii::$app->request->post();
		//throw new exception(print_r($post, true));
		$kgiTeamId = $post['kgiTeamId'] ?? null;
		$status    = $post['status'] ?? 1;
		$role      = UserRole::userRight();
		$oldKgiTeam = KgiTeam::find()
			->where(["kgiTeamId" => $kgiTeamId])
			->asArray()
			->one();
		if ($oldKgiTeam && $role == 3) {
			if (($oldKgiTeam["target"] ?? null) != ($post['targetAmount'] ?? null)) {
				$status = 88;
			}
		}
		$result = $post["result"] ?? ($post["autoUpdate"] ?? 0);
		$kgiTeamHistory = new KgiTeamHistory();
		$kgiTeamHistory->kgiTeamId     = $kgiTeamId;
		$kgiTeamHistory->result        = $result;
		$kgiTeamHistory->target        = $post['targetAmount'] ?? ($oldKgiTeam["targetAmount"] ?? 0);
		$kgiTeamHistory->status        = $status;
		$kgiTeamHistory->month         = $post["month"] ?? null;
		$kgiTeamHistory->year          = $post["year"] ?? null;
		$kgiTeamHistory->fromDate      = $post["fromDate"] ?? null;
		$kgiTeamHistory->toDate        = $post["toDate"] ?? null;
		$kgiTeamHistory->nextCheckDate = $post["nextDate"] ?? null;
		$kgiTeamHistory->createrId     = Yii::$app->user->id;
		$kgiTeamHistory->createDateTime = new Expression('NOW()');
		$kgiTeamHistory->updateDateTime = new Expression('NOW()');
		if ($kgiTeamHistory->save()) {
			$teamKgi = KgiTeam::find()->where(["kgiTeamId" => $kgiTeamId])->one();

			if ($teamKgi) {
				$teamKgi->status        = $status;
				$teamKgi->month         = $post["month"] ?? null;
				$teamKgi->year          = $post["year"] ?? null;
				if (!empty($post['targetAmount']) && $role > 3) {
					// อัปเดต target เฉพาะกรณี role > 3
					$teamKgi->target = $post['targetAmount'];
				}
				$teamKgi->result        = $result;
				$teamKgi->fromDate      = $post["fromDate"] ?? null;
				$teamKgi->toDate        = $post["toDate"] ?? null;
				$teamKgi->nextCheckDate = $post["nextDate"] ?? null;
				$teamKgi->updateDateTime = new Expression('NOW()');
				$teamKgi->save(false);
			}
		}

		return $this->redirect($post["url"] ?? Yii::$app->homeUrl . 'kgi/kgi-team/team-kgi-grid');

		//return $this->redirect('team-kgi');
	}
	public function actionKgiTeamView()
	{
		$kgiTeamId = $_POST["kgiTeamId"];
		$kgiTeam = Api::connectApi(Path::Api() . 'kgi/kgi-team/kgi-team-detail?kgiTeamId=' . $kgiTeamId . '&&kgiTeamHistoryId=0');
		$kgiTeamHistory = Api::connectApi(Path::Api() . 'kgi/kgi-team/kgi-team-history-view?kgiTeamId=' . $kgiTeamId);
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
		$kgiTeam = Api::connectApi(Path::Api() . 'kgi/kgi-team/kgi-team-detail?kgiTeamId=' . $kgiTeamId . '&&kgiTeamHistoryId=0');
		$kgiTeamHistory = Api::connectApi(Path::Api() . 'kgi/kgi-team/kgi-team-history-view?kgiTeamId=' . $kgiTeamId);
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
			$kgiTeam->fromDate = null;
			$kgiTeam->toDate = null;
			$kgiTeam->nextCheckDate = null;
			$kgiTeam->result = 0.00;
			$kgiTeam->updateDateTime = new Expression('NOW()');
			if ($kgiTeam->save(false)) {
				// $KgiEmployee = KgiEmployee::find()->where(["kgiId" => $kgiTeam["kgiId"]])->all();

				$KgiEmployee = KgiEmployee::find()
					->leftJoin("employee", "employee.employeeId = kgi_employee.employeeId")
					->where(["kgi_employee.kgiId" => $kgiTeam["kgiId"], "employee.teamId" => $kgiTeam["teamId"], "kgi_employee.status" => [1, 2, 4]])
					->all();

				// throw new Exception(print_r($kpiEmpoyee, true)); 
				foreach ($KgiEmployee as $empoyee) :
					if ($empoyee->month  == $nextMonth && $empoyee->year  == $nextYear) {
						//ปัญหาคือ พอก็อปหน้าคอมปานีมา มันไม่มีในเอ็มพรอยี่ด้วย 
						//สามารถข้ามเดือนได้ 
						//มี employee kgiอยู่แล้วของ next month, year อยู่แล้ว

					} else {
						if ($empoyee->status == 1) {
							$status = 5;
						}
						if ($empoyee->status == 2) {
							$status = 1;
							// throw new Exception(print_r($empoyee -> status, true)); 
							$empoyee->status = 1;
							$empoyee->month = $nextMonth;
							$empoyee->year = $nextYear;
							$empoyee->fromDate = null;
							$empoyee->toDate = null;
							$empoyee->nextCheckDate = null;
							$empoyee->result = 0.00;
						}
						$KgiEmployeeHistory = new KgiEmployeeHistory();
						$KgiEmployeeHistory->kgiEmployeeId = $empoyee->kgiEmployeeId;
						$KgiEmployeeHistory->createrId = Yii::$app->user->id;
						$KgiEmployeeHistory->month = $nextMonth;
						$KgiEmployeeHistory->year = $nextYear;
						$KgiEmployeeHistory->createDateTime = new Expression('NOW()');
						$KgiEmployeeHistory->updateDateTime = new Expression('NOW()');
						$KgiEmployeeHistory->detail = "auto set from company kgi";
						$KgiEmployeeHistory->status = $status;
						$KgiEmployeeHistory->save(false);
						$empoyee->save(false);
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
		$kgiId = $param["kgiId"];
		$role = UserRole::userRight();
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		$kgiTeamDetail = Api::connectApi(Path::Api() . 'kgi/kgi-team/kgi-team-detail?kgiTeamId=' . $kgiTeamId . '&&kgiTeamHistoryId=' . $kgiTeamHistoryId);
		$units = Api::connectApi(Path::Api() . 'masterdata/unit/all-unit');
		$companies = Api::connectApi(Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$allCompany = Api::connectApi(Path::Api() . 'masterdata/company/all-company');
		$countAllCompany = 0;
		if (count($allCompany) > 0) {
			$countAllCompany = count($allCompany);
			$companyPic = Company::randomPic($allCompany, 3);
		}
		$totalBranch = Branch::totalBranch();
		$isManager = UserRole::isManager();
		$months = ModelMaster::monthFull(1);
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
			"kgiTeamId" => $kgiTeamId,
			"allCompany" => $countAllCompany,
			"companyPic" => $companyPic,
			"totalBranch" => $totalBranch
		]);
	}
	public function actionKgiTeamEmployee()
	{
		$kgiId = $_POST["kgiId"];
		$kgiTeamHistoryId = $_POST["kgiTeamHistoryId"];
		$kgiTeamId = $_POST["kgiTeamId"];
		$res["kgiEmployeeTeam"] = "";
		$kgiTeams = Api::connectApi(Path::Api() . 'kgi/kgi-team/kgi-team-summarize?kgiId=' . $kgiId);
		$kgiDetail = Api::connectApi(Path::Api() . 'kgi/kgi-personal/assigned-kgi-employee?kgiId=' . $kgiId . "&&kgiHistoryId=0");
		$res["kgiEmployeeTeam"] = $this->renderAjax("kgi_employee_team_all", [
			"kgiTeams" => $kgiTeams,
			"kgiDetail" => $kgiDetail,
			"kgiId" => $kgiId
		]);
		return json_encode($res);
	}
	public function actionAllKgiHistory2() //ถ้าactionAllKgiHistory2 มีปัญหาให้กลับมาใช้ตัวนี้
	{
		$kgiTeamId = $_POST["kgiTeamId"];
		$kgiTeamHistoryId = $_POST["kgiTeamHistoryId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

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
	public function actionAllKgiHistory()
	{
		$kgiTeamId = $_POST["kgiTeamId"];
		$kgiTeamHistoryId = $_POST["kgiTeamHistoryId"];
		$history = Api::connectApi(Path::Api() . 'kgi/kgi-team/kgi-team-history2?kgiTeamId=' . $kgiTeamId . '&&kgiTeamHistoryId=' . $kgiTeamHistoryId);
		$monthDetail = [];
		$summarizeMonth = [];
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
			foreach ($history as $kgiHistoryId => $ht):
				if ($year != 0 && $month != 0 && $ht["year"] <= $year) {
					if ($ht["year"] == $year && $ht["month"] > $month) continue;
				}
				if (isset($monthDetail[$ht["year"]][$ht["month"]])) {
					$totalCount = count($monthDetail[$ht["year"]][$ht["month"]]);
				} else {
					$totalCount = 0;
					$summarizeMonth[$ht["year"]][$ht["month"]] = [
						"year" => $ht["year"],
						"month" => ModelMaster::fullMonthText($ht["month"]),
						"result" => $ht["result"],
						"target" => $ht["target"],
						"kgiHistoryId" => $kgiHistoryId
					];
				}
				$monthDetail[$ht["year"]][$ht["month"]][$totalCount] = [
					"creater" => $ht["creater"],
					"title" => $ht["title"],
					"status" => $ht["status"],
					"picture" => $ht["picture"],
					"result" => $ht["result"],
					"createDateTime" => $ht["createDateTime"]
				];
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
		$history = Api::connectApi(Path::Api() . 'kgi/kgi-team/kgi-team-history-for-chart?kgiTeamHistoryId=' . $kgiTeamHistoryId . '&&kgiTeamId=' . $kgiTeamId);

		$summarizeMonth = [];
		$summarizeMonth2 = [];
		$monthText = '';
		$target = [];
		$targetText = "";
		$resultText = "";
		$result = [];
		$res["kgiChart"] = "";

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

		if (isset($history) && count($history) > 0) {
			$i = 0;
			foreach ($history as $kgiTeamHistoryId => $ht) {
				if ($year != '' && $month != '' && $ht["year"] <= $year) {
					if ($ht["year"] == $year && $ht["month"] > $month) continue;
				}
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
				$i++;
			}
		}

		$summarizeMonth2 = array_slice($summarizeMonth2, -8);
		foreach ($summarizeMonth2 as $index => $data) {
			$target[$index] = $data["target"];
			$result[$index] = $data["result"];
			$targetText .= $target[$index] . ',';
			$resultText .= $result[$index] . ',';
			$monthText .= '"' . substr($data["month"], 0, 3) . substr($data["year"], -2) . '",';
		}

		$monthText = rtrim($monthText, ',');
		$targetText = rtrim($targetText, ',');
		$resultText = rtrim($resultText, ',');

		$res["kgiChart"] = $this->renderAjax('kgi_chart', [
			"month" => $monthText,
			"target" => $targetText,
			"result" => $resultText
		]);

		return json_encode($res);
	}

	// public function actionKgiTeamChart()
	// {
	// 	$kgiId = $_POST["kgiId"];
	// 	$kgiTeamHistoryId = $_POST["kgiTeamHistoryId"];
	// 	$kgiTeamId = $_POST["kgiTeamId"];
	// 	$api = curl_init();
	// 	curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
	// 	curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

	// 	//curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-history?kgiId=' . $kgiId);
	// 	curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-team/kgi-team-history-for-chart?kgiTeamHistoryId=' . $kgiTeamHistoryId . '&&kgiTeamId=' . $kgiTeamId);
	// 	$history = curl_exec($api);
	// 	$history = json_decode($history, true);
	// 	curl_close($api);
	// 	$monthDetail = [];
	// 	$summarizeMonth = [];
	// 	$summarizeMonth2 = [];
	// 	$months = ModelMaster::month();
	// 	$monthText = '';
	// 	$target = [];
	// 	$targetText = "";
	// 	$resultText = "";
	// 	$result = [];
	// 	//ksort($month);
	// 	$res["monthlyDetailHistoryText"] = "";
	// 	if ($kgiTeamHistoryId != 0) {
	// 		$kgiHistory = KgiTeamHistory::find()
	// 			->where(["kgiTeamHistoryId" => $kgiTeamHistoryId])
	// 			->asArray()
	// 			->one();
	// 		$year = $kgiHistory["year"];
	// 		$month = $kgiHistory["month"];
	// 	} else {
	// 		$year = '';
	// 		$month = '';
	// 	}
	// 	//throw new exception(print_r($history, true));
	// 	if (isset($history) && count($history) > 0) {
	// 		$i = 0;
	// 		foreach ($history as $kgiTeamHistoryId => $ht):
	// 			if ($year != '' && $month != '' && $ht["year"] <= $year) {
	// 				if ($ht["year"] == $year) {
	// 					if ($ht["month"] <= $month) {
	// 						if (!isset($summarizeMonth[$ht["year"]][$ht["month"]])) {
	// 							$summarizeMonth[$ht["year"]][$ht["month"]] = [
	// 								"year" => $ht["year"],
	// 								"kgiTeamHistoryId" => $kgiTeamHistoryId
	// 							];
	// 							$summarizeMonth2[$i] = [
	// 								"year" => $ht["year"],
	// 								"month" => ModelMaster::fullMonthText($ht["month"]),
	// 								"result" => $ht["result"],
	// 								"target" => $ht["target"],
	// 								"kgiTeamHistoryId" => $kgiTeamHistoryId
	// 							];
	// 						}
	// 					}
	// 				} else {
	// 					if (!isset($summarizeMonth[$ht["year"]][$ht["month"]])) {
	// 						$summarizeMonth[$ht["year"]][$ht["month"]] = [
	// 							"year" => $ht["year"],
	// 							"kgiTeamHistoryId" => $kgiTeamHistoryId
	// 						];
	// 						$summarizeMonth2[$i] = [
	// 							"year" => $ht["year"],
	// 							"month" => ModelMaster::fullMonthText($ht["month"]),
	// 							"result" => $ht["result"],
	// 							"target" => $ht["target"],
	// 							"kgiTeamHistoryId" => $kgiTeamHistoryId
	// 						];
	// 					}
	// 				}
	// 			} else {
	// 				if (!isset($summarizeMonth[$ht["year"]][$ht["month"]])) {
	// 					$summarizeMonth[$ht["year"]][$ht["month"]] = [
	// 						"year" => $ht["year"],
	// 						"kgiTeamHistoryId" => $kgiTeamHistoryId
	// 					];
	// 					$summarizeMonth2[$i] = [
	// 						"year" => $ht["year"],
	// 						"month" => ModelMaster::fullMonthText($ht["month"]),
	// 						"result" => $ht["result"],
	// 						"target" => $ht["target"],
	// 						"kgiTeamHistoryId" => $kgiTeamHistoryId
	// 					];
	// 				}
	// 			}
	// 			$i++;
	// 		endforeach;
	// 	}
	// 	$summarizeMonth2 = array_slice($summarizeMonth2, -8);
	// 	foreach ($summarizeMonth2 as $index => $data):
	// 		$target[$index] = $data["target"];
	// 		$result[$index] = $data["result"];
	// 		$targetText .= $target[$index] . ',';
	// 		$resultText .= $result[$index] . ',';
	// 		$monthText .= '"' . substr($data["month"], 0, 3) . substr($data["year"], -2) . '",';
	// 	endforeach;
	// 	$monthText = substr($monthText, 0, -1);
	// 	$targetText = substr($targetText, 0, -1);
	// 	$resultText = substr($resultText, 0, -1);
	// 	$res["kgiChart"] = $this->renderAjax('kgi_chart', [
	// 		"month" => $monthText,
	// 		"target" => $targetText,
	// 		"result" => $resultText
	// 	]);
	// 	return json_encode($res);
	// }
	public function actionKgiTeamUpdate()
	{
		$kgiId = $_POST["kgiId"];
		$kgiTeams = Api::connectApi(Path::Api() . 'kgi/kgi-team/kgi-team?kgiId=' . $kgiId);

		$allDepartment = [];
		if (isset($kgiTeams) && count($kgiTeams) > 0) {
			foreach ($kgiTeams as $kgt) {
				$allDepartment[$kgt["departmentId"]] = $kgt["departmentId"];
			}
		}

		$t = [];
		$textTeam = "";
		if (count($allDepartment) > 0) {
			foreach ($allDepartment as $dId => $id) {
				$teams = Team::find()
					->where(["departmentId" => $dId])
					->andWhere("status!=99")
					->asArray()
					->orderBy("teamName")
					->all();
				if (isset($teams) && count($teams) > 0) {
					foreach ($teams as $team) {
						$t[$dId][$team["teamId"]] = $team["teamName"];
					}
				}
			}
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
				"kgi_employee.kgiId" => $kgiTeam["kgiId"],
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
		} else {
			$res["result"] = '';
		}
		$res["result"] = $autoResult;
		return json_encode($res);
	}
	public function actionKgiUpdateHistory()
	{
		$kgiId = $_POST["kgiId"];
		$res = [];

		$kgi = Api::connectApi(Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiId . '&&kgiHistoryId=0');
		$kgiHistoryTeam = Api::connectApi(Path::Api() . 'kgi/kgi-team/kgi-history-team?kgiId=' . $kgiId);
		$kgiHistoryEmployee = Api::connectApi(Path::Api() . 'kgi/kgi-personal/kgi-history-employee?kgiId=' . $kgiId);

		$res["month"] = $kgi["monthFullName"];
		$res["year"] = $kgi["year"];
		$res["fromDate"] = $kgi["fromDateFormat"];
		$res["toDate"] = $kgi["toDateFormat"];
		$res["target"] = number_format($kgi["targetAmount"]);
		$res["result"] = number_format($kgi["result"]);
		$res["ratio"] = (int)$kgi["ratio"];
		$res["dueBehide"] = 100 - (int)$kgi["ratio"];

		$res["teamText"] = $this->renderAjax('team_history', ["kgiHistoryTeam" => $kgiHistoryTeam]);
		$res["individualText"] = $this->renderAjax('individual_history', ["kgiHistoryEmployee" => $kgiHistoryEmployee]);

		return json_encode($res);
	}

	public function actionCheckKgiEmployee()
	{
		$kgiTeamId = $_POST["kgiTeamId"];
		$kgiTeam = KgiTeam::find()->where(["kgiTeamId" => $kgiTeamId])->asArray()->one();
		$teamId = $kgiTeam["teamId"];
		$kgiId = $kgiTeam["kgiId"];
		$kgiEmployee = KgiEmployee::find()
			->select('kgi_employee.status')
			->JOIN("LEFT JOIN", "employee e", "e.employeeId=kgi_employee.employeeId")
			->where(["kgi_employee.kgiId" => $kgiId, "kgi_employee.status" => 1, "e.teamId" => $teamId, "e.status" => [1]])
			->one();
		$res = [];
		$res["status"] = true;
		if (isset($kgiEmployee) && !empty($kgiEmployee)) {
			$res["status"] = true;
		} else {
			$res["status"] = false;
		}
		return json_encode($res);
	}
}
