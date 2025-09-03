<?php

namespace frontend\modules\kpi\controllers;

use frontend\models\hrvc\KpiHistory;
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

class KpiTeamController extends Controller
{
	public function beforeAction($action)
	{
		if (Yii::$app->user->id == '') {
			Yii::$app->response->redirect(Yii::$app->homeUrl . 'site/login');
			return false;
		}

		return parent::beforeAction($action);
	}
	public function actionKpiTeamSetting($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$role = UserRole::userRight();
		if ($role < 3) return $this->redirect(Yii::$app->homeUrl . 'kpi/management/index');

		$kpiId = $param["kpiId"];
		$kpiTeams = Api::connectApi(Path::Api() . 'kpi/kpi-team/kpi-team?kpiId=' . $kpiId);
		$kpiDetail = Api::connectApi(Path::Api() . 'kpi/management/kpi-detail?id=' . $kpiId . '&&kpiHistoryId=0');

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

		$teamDetail = Api::connectApi(Path::Api() . 'masterdata/team/team-detail?id=' . $teamId);
		$kpi = Kpi::find()->select('kpiName')->where(["kpiId" => $kpiId])->asArray()->one();
		$kpiTeamHistory = Api::connectApi(Path::Api() . 'kpi/kpi-team/kpi-team-history?kpiId=' . $kpiId . '&&teamId=' . $teamId);

		$teamText = $this->renderAjax('team_progress', ["kpiTeamHistory" => $kpiTeamHistory]);
		$res["teamName"] = $teamDetail["teamName"];
		$res["kpiName"] = $kpi["kpiName"];
		$res["history"] = $teamText;
		return json_encode($res);
	}

	public function actionTeamKpi($hash = null)
	{
		$role = UserRole::userRight();
		$adminId = '';
		$gmId = '';
		$teamLeaderId = '';
		$managerId = '';
		$supervisorId = '';
		$staffId = '';
		$companyId = '';
		if ($role == 7) $adminId = Yii::$app->user->id;
		if ($role == 6) $gmId = Yii::$app->user->id;
		if ($role == 5) $managerId = Yii::$app->user->id;
		if ($role == 4) $supervisorId = Yii::$app->user->id;
		if ($role == 3) $teamLeaderId = Yii::$app->user->id;
		if ($role == 1 || $role == 2) $staffId = Yii::$app->user->id;
		$userId = Yii::$app->user->id;
		$isAdmin = UserRole::isAdmin();
		$userBranchId = User::userBranchId();
		$userTeamId = Team::userTeam($userId);
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		$session = Yii::$app->session;
		if ($session->has('kpiTeam')) {
			$filter = $session->get('kpiTeam');
			$companyId = $filter["companyId"] ?? null;
			$branchId = $filter["branchId"] ?? null;
			$teamId = $filter["teamId"] ?? null;
			$month = $filter["month"] ?? null;
			$status = $filter["status"] ?? null;
			$year = $filter["year"] ?? null;
			$type = "list";
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
		$currentPage = 1;
		if ($hash && $hash != '') {
			$pageArr = explode('page', $hash);
			$currentPage = $pageArr[1];
		}
		$limit = 20;

		$teamKpis = Api::connectApi(Path::Api() . 'kpi/kpi-team/all-team-kpi?userId=' . $userId . '&&role=' . $role . '&&currentPage=' . $currentPage . '&&limit=' . $limit);
		$units = Api::connectApi(Path::Api() . 'masterdata/unit/all-unit');
		$companies = Api::connectApi(Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$waitForApprove = Api::connectApi(Path::Api() . 'kpi/kpi-team/wait-for-approve?branchId=' . $userBranchId . '&&isAdmin=' . $isAdmin);
		$allCompany = Api::connectApi(Path::Api() . 'masterdata/company/all-company');

		$totalBranch = Branch::totalBranch();
		$countAllCompany = 0;
		if (count($allCompany) > 0) {
			$countAllCompany = count($allCompany);
			$companyPic = Company::randomPic($allCompany, 3);
		}
		$employee = Employee::employeeDetailByUserId(Yii::$app->user->id);
		$employeeCompanyId = $employee["companyId"];
		$isManager = UserRole::isManager();
		$months = ModelMaster::monthFull(1);
		$totalKpi = KpiTeam::totalKpiTeam($adminId, $gmId, $managerId, $supervisorId, $teamLeaderId, $staffId, $employee["employeeId"]);
		$totalPage = ceil($totalKpi / $limit);
		$pagination = ModelMaster::getPagination($currentPage, $totalPage);

		return $this->render('team_kpi', [
			"units" => $units,
			"months" => $months,
			"teamKpis" => $teamKpis,
			"role" => $role,
			"userId" => $userId,
			"isManager" => $isManager,
			"companies" => $companies,
			"userTeamId" => $userTeamId,
			"allCompany" => $countAllCompany,
			"companyPic" => $companyPic,
			"totalBranch" => $totalBranch,
			"companyId" => null,
			"branchId" => null,
			"teamId" => null,
			"month" => null,
			"status" => null,
			"year" => null,
			"waitForApprove" => $waitForApprove,
			"employeeCompanyId" => $employeeCompanyId,
			"totalKpi" => $totalKpi,
			"currentPage" => $currentPage,
			"totalPage" => $totalPage,
			"pagination" => $pagination,
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
		$kpiTeamHistoryId = isset($param["kpiTeamHistoryId"]) ? $param["kpiTeamHistoryId"] : 0;
		$openTab = array_key_exists("openTab", $param) ? $param["openTab"] : 0;
		$kpiTeamDetail = Api::connectApi(Path::Api() . 'kpi/kpi-team/kpi-team-detail?kpiTeamId=' . $kpiTeamId . '&&kpiTeamHistoryId=' . $kpiTeamHistoryId);
		$companies = Api::connectApi(Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$units = Api::connectApi(Path::Api() . 'masterdata/unit/all-unit');
		$kpiTeams = Api::connectApi(Path::Api() . 'kpi/kpi-team/kpi-team-summarize?kpiId=' . $kpiId);
		$allCompany = Api::connectApi(Path::Api() . 'masterdata/company/all-company');
		$countAllCompany = 0;
		if (count($allCompany) > 0) {
			$countAllCompany = count($allCompany);
			$companyPic = Company::randomPic($allCompany, 3);
		}
		$totalBranch = Branch::totalBranch();
		$res["kgiTeam"] = $kpiTeamDetail;
		$isManager = UserRole::isManager();
		$months = ModelMaster::monthFull(1);
		return $this->render('kpi_team_history', [
			"role" => $role,
			"kpiTeamDetail" => $kpiTeamDetail,
			"units" => $units,
			"months" => $months,
			"isManager" => $isManager,
			"companies" => $companies,
			"kpiId" => $kpiId,
			"kpiTeams" => $kpiTeams,
			"kpiTeamHistoryId" => $kpiTeamHistoryId,
			"openTab" => $openTab,
			"kpiTeamId" => $kpiTeamId,
			"allCompany" => $countAllCompany,
			"companyPic" => $companyPic,
			"totalBranch" => $totalBranch
		]);
	}

	public function actionKpiTeamEmployee()
	{
		$kpiId = $_POST["kpiId"];
		if (isset($_POST["kpiTeamId"])) {
			$kpiTeamId = $_POST["kpiTeamId"];
		} else {
			$kpiEmployeeId = $_POST["kpiEmployeeId"];
			$kpiTeamId  =  KpiEmployee::employeeKpiTeamId($kpiEmployeeId);
		}
		$month = $_POST["month"];
		$year = $_POST["year"];
		$res["kpiEmployeeTeam"] = "";
		$kpiTeams = Api::connectApi(Path::Api() . 'kpi/kpi-team/kpi-team-summarize?kpiId=' . $kpiId);
		$kpiDetail = Api::connectApi(Path::Api() . 'kpi/kpi-personal/assigned-kpi-employee?kpiId=' . $kpiId . "&&kpiHistoryId=0");
		$res["kpiEmployeeTeam"] = $this->renderAjax("kpi_employee_team_all", [
			"kpiTeams" => $kpiTeams,
			"kpiDetail" => $kpiDetail,
			"kpiId" => $kpiId
		]);
		return json_encode($res);
	}


	public function actionAllKpiHistory()
	{
		$kpiTeamHistoryId = $_POST["kpiTeamHistoryId"];
		$kpiId = $_POST["kpiId"];
		$kpiTeamId = $_POST["kpiTeamId"];
		$history = Api::connectApi(Path::Api() . 'kpi/kpi-team/kpi-history?kpiId=' . $kpiId . '&&kpiTeamId=' . $kpiTeamId . '&&kpiTeamHistoryId=' . $kpiTeamHistoryId);
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
							"title" => isset($ht["title"]) ? $ht["title"] : '',
							"status" => $ht["status"],
							"picture" => $ht["picture"],
							"result" => isset($ht["result"]) ? $ht["result"] : 0,
							"createDateTime" => $ht["createDateTime"] ?? null,
						];
					} else {
						$monthDetail[$ht["year"]][$ht["month"]][0] = [
							"creater" => $ht["creater"],
							"title" => isset($ht["title"]) ? $ht["title"] : '',
							"status" => $ht["status"],
							"picture" => $ht["picture"],
							"result" => isset($ht["result"]) ? $ht["result"] : 0,
							"createDateTime" => $ht["createDateTime"] ?? null,
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
		$history = Api::connectApi(Path::Api() . 'kpi/kpi-team/kpi-history-for-chart?kpiId=' . $kpiId . '&&kpiTeamId=' . $kpiTeamId . '&&kpiTeamHistoryId=' . $kpiTeamHistoryId);
		$monthDetail = [];
		$summarizeMonth = [];
		$summarizeMonth2 = [];
		$year = 2024;
		$months = ModelMaster::month();
		$monthText = '';
		$target = [];
		$targetText = "";
		$resultText = "";
		$result = [];
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

	public function actionTeamKpiGrid($hash = null)
	{
		$role = UserRole::userRight();
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		$userId = Yii::$app->user->id;
		$isAdmin = UserRole::isAdmin();
		$userBranchId = User::userBranchId();
		$adminId = '';
		$gmId = '';
		$teamLeaderId = '';
		$managerId = '';
		$supervisorId = '';
		$staffId = '';
		$companyId = '';
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
		}
		$userTeamId = Team::userTeam($userId);
		$session = Yii::$app->session;
		if ($session->has('kpiTeam')) {
			$filter = $session->get('kpiTeam');
			$companyId = isset($filter["companyId"]) && $filter["companyId"] != null ? $filter["companyId"] : null;
			$branchId = isset($filter["branchId"]) && $filter["branchId"] != null ? $filter["branchId"] : null;
			$teamId = isset($filter["teamId"]) && $filter["teamId"] != null ? $filter["teamId"] : null;
			$month = isset($filter["month"]) && $filter["month"] != null ? $filter["month"] : null;
			$status = isset($filter["status"]) && $filter["status"] != null ? $filter["status"] : null;
			$year = isset($filter["year"]) && $filter["year"] != null ? $filter["year"] : null;
			$type = "grid";
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
		$currentPage = 1;
		if (isset($hash) && $hash != '') {
			$pageArr = explode('page', $hash);
			$currentPage = $pageArr[1];
		}
		$limit = 20;
		$teamKpis = Api::connectApi(Path::Api() . 'kpi/kpi-team/all-team-kpi?userId=' . $userId . '&&role=' . $role . '&&currentPage=' . $currentPage . '&&limit=' . $limit);
		$units = Api::connectApi(Path::Api() . 'masterdata/unit/all-unit');
		$companies = Api::connectApi(Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$waitForApprove = Api::connectApi(Path::Api() . 'kpi/kpi-team/wait-for-approve?branchId='  . $userBranchId . '&&isAdmin=' . $isAdmin);
		$allCompany = Api::connectApi(Path::Api() . 'masterdata/company/all-company');
		$isManager = UserRole::isManager();
		$months = ModelMaster::monthFull(1);
		$totalBranch = Branch::totalBranch();
		$countAllCompany = 0;
		if (count($allCompany) > 0) {
			$countAllCompany = count($allCompany);
			$companyPic = Company::randomPic($allCompany, 3);
		}
		$employee = Employee::employeeDetailByUserId(Yii::$app->user->id);
		$employeeCompanyId = $employee["companyId"];
		$totalKpi = KpiTeam::totalKpiTeam($adminId, $gmId, $managerId, $supervisorId, $teamLeaderId, $staffId, $employee["employeeId"]);
		$totalPage = ceil($totalKpi / $limit);
		$pagination = ModelMaster::getPagination($currentPage, $totalPage);
		return $this->render('kpi_team_grid', [
			"units" => $units,
			"months" => $months,
			"teamKpis" => $teamKpis,
			"role" => $role,
			"userId" => Yii::$app->user->id,
			"isManager" => $isManager,
			"companies" => $companies,
			"userTeamId" => $userTeamId,
			"allCompany" => $countAllCompany,
			"companyPic" => $companyPic,
			"totalBranch" => $totalBranch,
			"companyId" => null,
			"branchId" => null,
			"teamId" => null,
			"month" => null,
			"status" => null,
			"year" => null,
			"waitForApprove" => $waitForApprove,
			"employeeCompanyId" => $employeeCompanyId,
			"totalKpi" => $totalKpi,
			"currentPage" => $currentPage,
			"totalPage" => $totalPage,
			"pagination" => $pagination
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
	public function actionAutoResult()
	{
		$kpiTeamId = $_POST["kpiTeamId"];
		$kpiTeam = KpiTeam::find()->where(["kpiTeamId" => $kpiTeamId])->asArray()->one();
		$year = $kpiTeam["year"];
		$month = $kpiTeam["month"];
		$kpiEmployee = KpiEmployee::find()
			->JOIN("LEFT JOIN", "employee e", "e.employeeId=kpi_employee.employeeId")
			->where([
				"e.teamId" => $kpiTeam["teamId"],
				"e.status" => 1,
				"kpi_employee.status" => [1, 2, 4],
				"kpi_employee.month" => $month,
				"kpi_employee.year" => $year
			])
			->asArray()
			->all();
		$autoResult = 0;
		if (isset($kpiEmployee) && count($kpiEmployee) > 0) {
			foreach ($kpiEmployee as $kg):
				$autoResult += $kg["result"];
			endforeach;
		}
		$res["result"] = $autoResult;
		return json_encode($res);
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
		$session = Yii::$app->session;
		$session->open();
		$session->set('kpiTeam', [
			"companyId" => $companyId,
			"branchId" => $branchId,
			"teamId" => $teamId,
			"month" => $month,
			"year" => $year,
			"status" => $status,
			"type" => $type
		]);
		Session::PimTeamFilter($companyId, $branchId, $teamId, $month, $year, $status, $type);
		if ($companyId == "" && $branchId == "" && $teamId == "" && $month == "" && $status == "" && $year == "") {
			if ($type == "list") {
				return $this->redirect(Yii::$app->homeUrl . 'kpi/kpi-team/team-kpi');
			} else {
				return $this->redirect(Yii::$app->homeUrl . 'kpi/kpi-team/team-kpi-grid');
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
		$teamKpis = Api::connectApi(Path::Api() . 'kpi/kpi-team/kpi-team-filter?' . $paramText);
		$units = Api::connectApi(Path::Api() . 'masterdata/unit/all-unit');
		$companies = Api::connectApi(Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$waitForApprove = Api::connectApi(Path::Api() . 'kpi/kpi-team/wait-for-approve?branchId='  . $userBranchId . '&&isAdmin=' . $isAdmin);
		$allCompany = Api::connectApi(Path::Api() . 'masterdata/company/all-company');
		$totalBranch = Branch::totalBranch();
		$countAllCompany = 0;
		if (count($allCompany) > 0) {
			$countAllCompany = count($allCompany);
			$companyPic = Company::randomPic($allCompany, 3);
		}
		$employee = Employee::employeeDetailByUserId(Yii::$app->user->id);
		$employeeCompanyId = $employee["companyId"];
		$file = $type == "list" ? "team_kpi" : "kpi_team_grid";
		$months = ModelMaster::monthFull(1);
		$role = UserRole::userRight();
		$isManager = UserRole::isManager();
		$totalKpi = $teamKpis["total"];
		$totalPage = ceil($totalKpi / $limit);
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
			"teamKpis" => $teamKpis,
			"role" => $role,
			"userId" => $userId,
			"userTeamId" => $userTeamId,
			"isManager" => $isManager,
			"companies" => $companies,
			"allCompany" => $countAllCompany,
			"companyPic" => $companyPic,
			"totalBranch" => $totalBranch,
			"companyId" => $companyId,
			"branchId" => $branchId,
			"teamId" => $teamId,
			"month" => $month,
			"status" => $status,
			"year" => $year,
			"waitForApprove" => $waitForApprove,
			"employeeCompanyId" => $employeeCompanyId,
			"filter" => $filter,
			"pagination" => $pagination,
			"totalKpi" => $totalKpi,
			"currentPage" => $currentPage,
			"totalPage" => $totalPage,
		]);
	}

	public function actionPrepareUpdate($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$role = UserRole::userRight();
		$kpiTeamId = $param["kpiTeamId"];
		$kpiTeamDetail = Api::connectApi(Path::Api() . 'kpi/kpi-team/kpi-team-detail?kpiTeamId=' . $kpiTeamId . '&&kpiTeamHistoryId=0');
		$kpi = Api::connectApi(Path::Api() . 'kpi/management/kpi-detail?id=' . $kpiTeamDetail['kpiId'] . '&&kpiHistoryId=0');
		$kpiBranch = Api::connectApi(Path::Api() . 'kpi/management/kpi-branch?id=' . $kpiTeamDetail["kpiId"]);
		$kpiDepartment = Api::connectApi(Path::Api() . 'kpi/management/kpi-department?id=' . $kpiTeamDetail['kpiId']);
		$kpiTeam = Api::connectApi(Path::Api() . 'kpi/management/kpi-team?id=' . $kpiTeamDetail['kpiId']);
		$companyId = $kpi["companyId"];
		$company = [
			"companyId" => $kpi["companyId"],
			"companyName" => Company::companyName($kpi["companyId"]),
			"companyImg" => Company::companyImage($kpi["companyId"]),
		];
		$unit = Unit::find()->where(["unitId" => $kpi["unitId"]])->asArray()->one();
		$allCompany = Api::connectApi(Path::Api() . 'masterdata/company/all-company');
		$totalBranch = Branch::totalBranch();
		$countAllCompany = 0;
		if (count($allCompany) > 0) {
			$countAllCompany = count($allCompany);
			$companyPic = Company::randomPic($allCompany, 3);
		}
		return $this->render('kpi_from', [
			"kpi" => $kpi,
			"data" => $kpiTeamDetail,
			"company" => $company ?? [],
			"kpiBranch" => $kpiBranch ?? [],
			"kpiDepartment" => $kpiDepartment ?? [],
			"kpiTeam" => $kpiTeam ?? [],
			"role" => $role,
			"unit"  => $unit,
			"kpiTeamId"  => $kpiTeamId,
			"statusform" =>  "update",
			"url" => Yii::$app->request->referrer,
			"allCompany" => $countAllCompany,
			"companyPic" => $companyPic,
			"totalBranch" => $totalBranch
		]);
	}
	public function actionUpdateKpiTeam()
	{
		$data = [
			'kpiTeamId' => $_POST["kpiTeamId"],
			'targetAmount' => $_POST["targetAmount"],
			'status' => $_POST["status"],
			'result' => $_POST["result"],
			'month' => $_POST["month"],
			'year' => $_POST["year"],
			'toDate' => $_POST["toDate"],
			'fromDate' => $_POST["fromDate"],
			'nextCheckDate' => $_POST["nextDate"],
		];
		$nextMonth = $data['month'] + 1;
		$nextYear = $data['year'];
		if ($nextMonth > 12) {
			$nextMonth = 1;
			$nextYear++;
		}
		$kpiTeamId = $_POST["kpiTeamId"];
		$role = UserRole::userRight();
		$status =  $_POST["status"];
		$teamkpi = KpiTeam::find()->where(["kpiTeamId" => $kpiTeamId])->one();
		$teamkpi->status = $_POST["status"];
		$teamkpi->month = $_POST["month"];
		$teamkpi->year = $_POST["year"];
		$teamkpi->result = str_replace(",", "",  $_POST["result"]);
		if (isset($_POST["targetAmount"])) {
			$teamkpi->target = str_replace(",", "",  $_POST["targetAmount"]);
		}
		$teamkpi->fromDate = $_POST["fromDate"];
		$teamkpi->toDate = $_POST["toDate"];
		$teamkpi->nextCheckDate = $_POST["nextDate"];
		$teamkpi->updateDateTime = new Expression('NOW()');
		if ($teamkpi->save(false)) {
			$kpiTeamHistory = new KpiTeamHistory();
			$kpiTeamHistory->kpiTeamId = $kpiTeamId;
			$kpiTeamHistory->result = str_replace(",", "",  $_POST["result"]);
			if (isset($_POST["targetAmount"])) {
				$kpiTeamHistory->target = str_replace(",", "",  $_POST["targetAmount"]);
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
			$kpiTeamHistory->nextCheckDate = $_POST["nextDate"];
			$kpiTeamHistory->createrId = Yii::$app->user->id;
			$kpiTeamHistory->createDateTime = new Expression('NOW()');
			$kpiTeamHistory->updateDateTime = new Expression('NOW()');
			if ($kpiTeamHistory->save(false)) {
				$kpiTeamHistory = KpiTeamHistory::find()
					->where(["kpiTeamId" => $kpiTeamId, "status" => 5, "month" => $nextMonth, "year" => $nextYear])
					->one();
				if ($kpiTeamHistory !== null && $status == 2) {
					$teamkpi->month = $kpiTeamHistory->month;
					$teamkpi->year = $kpiTeamHistory->year;
					$teamkpi->status = 1;
					$teamkpi->save(false);
					$kpiTeamHistory->status = 1;
					$kpiTeamHistory->updateDateTime = new Expression('NOW()');
					$kpiTeamHistory->save(false);
				}
			}
		}
		return $this->redirect($_POST["url"]);
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
		if ($role >= 4) {
			$history = Api::connectApi(Path::Api() . 'kpi/management/kpi-history-employee?kpiId='  . $kpiId . '&month=' . $month . '&year=' . $year);
		} else {
			$history = Api::connectApi(Path::Api() . 'kpi/kpi-team/kpi-history-employee?kpiId='  . $kpiId . '&month=' . $month . '&year=' . $year . '&teamId=' . $teamId);
		}
		$historyTeam = Api::connectApi(Path::Api() . 'kpi/management/kpi-history-team?kpiId='  . $kpiId . '&month=' . $month . '&year=' . $year);
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
		header("Content-Type: application/json");
		echo json_encode($data);
		exit;
	}
	public function actionKpiTeamView()
	{
		$kpiTeamId = $_POST["kpiTeamId"];
		$kpiTeam = Api::connectApi(Path::Api() . 'kpi/kpi-team/kpi-team-detail?kpiTeamId=' . $kpiTeamId . '&&kpiTeamHistoryId=0');
		$kpiTeamHistory = Api::connectApi(Path::Api() . 'kpi/kpi-team/kpi-team-history-view?kpiTeamId=' . $kpiTeamId);
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
		$kpiTeam = Api::connectApi(Path::Api() . 'kpi/kpi-team/kpi-team-detail?kpiTeamId=' . $kpiTeamId . '&&kpiTeamHistoryId=0');
		$kpiTeamHistory = Api::connectApi(Path::Api() . 'kpi/kpi-team/kpi-team-history-view?kpiTeamId=' . $kpiTeamId);
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
			$kpiTeam->fromDate = null;
			$kpiTeam->toDate = null;
			$kpiTeam->nextCheckDate = null;
			$kpiTeam->result = 0.00;
			$kpiTeam->updateDateTime = new Expression('NOW()');
			if ($kpiTeam->save(false)) {

				$kpiEmpoyee = KpiEmployee::find()
					->leftJoin("employee", "employee.employeeId = kpi_employee.employeeId")
					->where(["kpi_employee.kpiId" => $kpiTeam["kpiId"], "employee.teamId" => $kpiTeam["teamId"], "kpi_employee.status" => [1, 2, 4]])
					->all();

				// throw new Exception(print_r($kpiEmpoyee, true)); 
				foreach ($kpiEmpoyee as $empoyee) :
					if ($empoyee->month  == $nextMonth && $empoyee->year  == $nextYear) {
						//ปัญหาคือ พอก็อปหน้าคอมปานีมา มันไม่มีในเอ็มพรอยี่ด้วย 
						//สามารถข้ามเดือนได้ 

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
						$kpiEmpoyeeHistory = new KpiEmployeeHistory();
						$kpiEmpoyeeHistory->kpiEmployeeId = $empoyee->kpiEmployeeId;
						$kpiEmpoyeeHistory->createrId = Yii::$app->user->id;
						$kpiEmpoyeeHistory->month = $nextMonth;
						$kpiEmpoyeeHistory->year = $nextYear;
						$kpiEmpoyeeHistory->createDateTime = new Expression('NOW()');
						$kpiEmpoyeeHistory->updateDateTime = new Expression('NOW()');
						$kpiEmpoyeeHistory->detail = "auto set from company kpi";
						$kpiEmpoyeeHistory->status = $status;
						$kpiEmpoyeeHistory->save(false);
						$empoyee->save(false);
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
		$kpiTeams = Api::connectApi(Path::Api() . 'kpi/kpi-team/kpi-team?kpiId=' . $kpiId);
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

	public function actionCheckKpiEmployee()
	{
		$kpiTeamId = $_POST["kpiTeamId"];
		$kpiTeam = KpiTeam::find()->where(["kpiTeamId" => $kpiTeamId])->asArray()->one();
		$teamId = $kpiTeam["teamId"];
		$kpiId = $kpiTeam["kpiId"];
		$kpiEmployee = KpiEmployee::find()
			->select('kpi_employee.status')
			->JOIN("LEFT JOIN", "employee e", "e.employeeId=kpi_employee.employeeId")
			->where(["kpi_employee.kpiId" => $kpiId, "kpi_employee.status" => 1, "e.teamId" => $teamId, "e.status" => [1]])
			->one();
		$res = [];
		$res["status"] = true;
		if (isset($kpiEmployee) && !empty($kpiEmployee)) {
			$res["status"] = true;
		} else {
			$res["status"] = false;
		}
		return json_encode($res);
	}
}
