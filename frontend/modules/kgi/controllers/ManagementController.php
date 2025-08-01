<?php

namespace frontend\modules\kgi\controllers;

use common\helpers\Path;
use common\helpers\Session;
use common\models\ModelMaster;
use Exception;
use frontend\models\hrvc\Branch;
use frontend\models\hrvc\Company;
use frontend\models\hrvc\Department;
use frontend\models\hrvc\Employee;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\GroupHasKgi;
use frontend\models\hrvc\Kfi;
use frontend\models\hrvc\Kgi;
use frontend\models\hrvc\KgiBranch;
use frontend\models\hrvc\KgiDepartment;
use frontend\models\hrvc\KgiEmployee;
use frontend\models\hrvc\KgiEmployeeHistory;
use frontend\models\hrvc\KgiHasKpi;
use frontend\models\hrvc\KgiHistory;
use frontend\models\hrvc\KgiIssue;
use frontend\models\hrvc\KgiSolution;
use frontend\models\hrvc\KgiTeam;
use frontend\models\hrvc\KgiTeamHistory;
use frontend\models\hrvc\Kpi;
use frontend\models\hrvc\Role;
use frontend\models\hrvc\Team;
use frontend\models\hrvc\Title;
use frontend\models\hrvc\Unit;
use frontend\models\hrvc\User;
use frontend\models\hrvc\UserRole;
use Yii;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\UploadedFile;

class ManagementController extends Controller
{
	public function beforeAction($action)
	{
		if (!Yii::$app->user->id) {
			return $this->redirect(Yii::$app->homeUrl . 'site/login');
		}
		$this->setDefault();
		return true;
	}
	public function actionIndex($hash = null)
	{
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		$role = UserRole::userRight();
		$adminId = '';
		$gmId = '';
		$teamLeaderId = '';
		$managerId = '';
		$supervisorId = '';
		$staffId = '';
		$session = Yii::$app->session;
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
			//return $this->redirect(Yii::$app->homeUrl . 'kgi/kgi-personal/individual-kgi');
		}
		if ($session->has('kgi')) {
			$filter = $session->get('kgi');
			$companyId = isset($filter["companyId"]) && $filter["companyId"] != null ? $filter["companyId"] : null;
			$branchId = isset($filter["branchId"]) && $filter["branchId"] != null ? $filter["branchId"] : null;
			$teamId = isset($filter["teamId"]) && $filter["teamId"] != null ? $filter["teamId"] : null;
			$month = isset($filter["month"]) && $filter["month"] != null ? $filter["month"] : null;
			$status = isset($filter["status"]) && $filter["status"] != null ? $filter["status"] : null;
			$year = isset($filter["year"]) && $filter["year"] != null ? $filter["year"] : null;
			$type = "list";
			return $this->redirect(Yii::$app->homeUrl . 'kgi/management/kgi-search-result/' . ModelMaster::encodeParams([
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
		$limit = 10;
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$companies = curl_exec($api);
		$companies = json_decode($companies, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/unit/all-unit');
		$units = curl_exec($api);
		$units = json_decode($units, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/index?adminId=' . $adminId . '&&gmId=' . $gmId . '&&managerId=' . $managerId . '&&supervisorId=' . $supervisorId . '&&teamLeaderId=' . $teamLeaderId . '&&staffId=' . $staffId . '&&currentPage=' . $currentPage . '&&limit=' . $limit);
		$kgis = curl_exec($api);
		$kgis = json_decode($kgis, true);

		curl_close($api);
		$months = ModelMaster::monthFull(1);
		$isManager = UserRole::isManager();
		//$url = 'kgi/management/index?adminId=' . $adminId . '&&gmId=' . $gmId . '&&managerId=' . $managerId . '&&supervisorId=' . $supervisorId . '&&teamLeaderId=' . $teamLeaderId . '&&staffId=' . $staffId;
		$employee = Employee::employeeDetailByUserId(Yii::$app->user->id);
		$employeeCompanyId = $employee["companyId"];
		$totalKgi = Kgi::totalKgi($adminId, $gmId, $managerId, $supervisorId, $teamLeaderId, $staffId);
		$totalPage = ceil($totalKgi / $limit);
		$pagination = ModelMaster::getPagination($currentPage, $totalPage);

		//$branchId = Branch::userBranchId(Yii::$app->user->id);

		return $this->render('index', [
			"units" => $units,
			"companies" => $companies,
			"months" => $months,
			"kgis" => $kgis,
			"isManager" => $isManager,
			"role" => $role,
			"userId" => Yii::$app->user->id,
			"userId" => Yii::$app->user->id,
			"employeeCompanyId" => $employeeCompanyId,
			"totalKgi" => $totalKgi,
			"currentPage" => $currentPage,
			"totalPage" => $totalPage,
			"pagination" => $pagination
		]);
	}
	public function actionGrid($hash = null)
	{
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
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
		}
		$session = Yii::$app->session;
		if ($session->has('kgi')) {
			$filter = $session->get('kgi');
			$companyId = isset($filter["companyId"]) && $filter["companyId"] != null ? $filter["companyId"] : null;
			$branchId = isset($filter["branchId"]) && $filter["branchId"] != null ? $filter["branchId"] : null;
			$teamId = isset($filter["teamId"]) && $filter["teamId"] != null ? $filter["teamId"] : null;
			$month = isset($filter["month"]) && $filter["month"] != null ? $filter["month"] : null;
			$status = isset($filter["status"]) && $filter["status"] != null ? $filter["status"] : null;
			$year = isset($filter["year"]) && $filter["year"] != null ? $filter["year"] : null;
			$type = "grid";
			return $this->redirect(Yii::$app->homeUrl . 'kgi/management/kgi-search-result/' . ModelMaster::encodeParams([
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

		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$companies = curl_exec($api);
		$companies = json_decode($companies, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/unit/all-unit');
		$units = curl_exec($api);
		$units = json_decode($units, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/index?adminId=' . $adminId . '&&gmId=' . $gmId . '&&managerId=' . $managerId . '&&supervisorId=' . $supervisorId . '&&teamLeaderId=' . $teamLeaderId . '&&staffId=' . $staffId . '&&currentPage=' . $currentPage . '&&limit=' . $limit);
		$kgis = curl_exec($api);
		$kgis = json_decode($kgis, true);
		//throw new exception('kgi/management/index?adminId=' . $adminId . '&&gmId=' . $gmId . '&&managerId=' . $managerId . '&&supervisorId=' . $supervisorId . '&&teamLeaderId=' . $teamLeaderId . '&&staffId=' . $staffId);
		//throw new exception(print_r($kgis, true));
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/all-company');
		$allCompany = curl_exec($api);
		$allCompany = json_decode($allCompany, true);


		curl_close($api);

		$countAllCompany = 0;
		if (count($allCompany) > 0) {
			$countAllCompany = count($allCompany);
			$companyPic = Company::randomPic($allCompany, 3);
		}
		$months = ModelMaster::monthFull(1);
		$isManager = UserRole::isManager();
		$employee = Employee::employeeDetailByUserId(Yii::$app->user->id);
		$employeeCompanyId = $employee["companyId"];
		$totalKgi = Kgi::totalKgi($adminId, $gmId, $managerId, $supervisorId, $teamLeaderId, $staffId);
		$totalPage = ceil($totalKgi / $limit);
		$pagination = ModelMaster::getPagination($currentPage, $totalPage);
		$totalBranch = Branch::totalBranch();

		return $this->render('kgi_grid', [
			"units" => $units,
			"companies" => $companies,
			"months" => $months,
			"kgis" => $kgis,
			"isManager" => $isManager,
			"role" => $role,
			"userId" => Yii::$app->user->id,
			"employeeCompanyId" => $employeeCompanyId,
			"totalKgi" => $totalKgi,
			"currentPage" => $currentPage,
			"totalPage" => $totalPage,
			"pagination" => $pagination,
			"allCompany" => $countAllCompany,
			"companyPic" => $companyPic,
			"totalBranch" => $totalBranch

		]);
	}
	public function actionCreateKgi()
	{
		if (isset($_POST["kgiName"]) && trim($_POST["kgiName"])) {
			//throw new exception(print_r(Yii::$app->request->post(), true));
			$result = isset($_POST["result"]) && $_POST["result"] != '' ? $_POST["result"] : 0;
			$kgi = new Kgi();
			$kgi->kgiName = $_POST["kgiName"];
			$kgi->companyId = $_POST["companyId"];
			$kgi->unitId = $_POST["unitId"];
			//$kgi->periodDate = $_POST["periodDate"];
			$kgi->fromDate = $_POST["fromDate"];
			$kgi->toDate = $_POST["toDate"];
			$kgi->targetAmount =  str_replace(",", "", $_POST["amount"]);
			$kgi->kgiDetail = $_POST["detail"];
			$kgi->quantRatio = $_POST["quantRatio"];
			$kgi->priority = $_POST["priority"];
			$kgi->amountType = $_POST["amountType"];
			$kgi->code = $_POST["code"];
			$kgi->status = $_POST["status"];
			$kgi->month = $_POST["month"];
			$kgi->year = $_POST["year"];
			//$kgi->result = str_replace(",", "", $result);
			$kgi->createrId = Yii::$app->user->id;
			$kgi->createDateTime = new Expression('NOW()');
			$kgi->updateDateTime = new Expression('NOW()');
			if ($kgi->save(false)) {
				$kgiId = Yii::$app->db->lastInsertID;
				$kgiHistory = new KgiHistory();
				$kgiHistory->kgiId = $kgiId;
				//$kgiHistory->updaterId = Yii::$app->user->id;
				// $kgiHistory->kgiHistoryName = $_POST["historyName"];
				// $kgiHistory->titleProcess = $_POST["historyName"];
				$kgiHistory->unitId = $_POST["unitId"];
				//$kgiHistory->periodDate = $_POST["periodDate"];
				$kgiHistory->nextCheckDate = $_POST["nextCheckDate"];
				$kgiHistory->targetAmount =  str_replace(",", "", $_POST["amount"]);
				$kgiHistory->description = $_POST["detail"];
				$kgiHistory->quantRatio = $_POST["quantRatio"];
				$kgiHistory->priority = $_POST["priority"];
				$kgiHistory->amountType = $_POST["amountType"];
				$kgiHistory->code = $_POST["code"];
				$kgiHistory->status = $_POST["status"];
				$kgiHistory->year = $_POST["year"];
				$kgiHistory->month = $_POST["month"];
				//$kgiHistory->result = str_replace(",", "", $result);
				$kgiHistory->createrId = Yii::$app->user->id;
				$kgiHistory->createDateTime = new Expression('NOW()');
				$kgiHistory->updateDateTime = new Expression('NOW()');
				$kgiHistory->fromDate = $_POST["fromDate"];
				$kgiHistory->toDate = $_POST["toDate"];
				$kgiHistory->save(false);
				//$kgiId = Yii::$app->db->lastInsertID;
				if (isset($_POST["branch"]) && count($_POST["branch"]) > 0) {
					$this->saveKgiBranch($_POST["branch"], $kgiId);
				}
				if (isset($_POST["department"]) && count($_POST["department"]) > 0) {
					$this->saveKgiDepartment($_POST["department"], $kgiId);
				}
				if (isset($_POST["team"]) && count($_POST["team"]) > 0) {
					//เพิ่มการบันถึกเดือนและปี
					$this->saveKgiTeam($_POST["team"], $kgiId, $_POST["month"], $_POST["year"]);
				}
				// if (isset($_POST["kgiGroup"]) && count($_POST["kgiGroup"]) > 0) {
				// 	$this->saveKgiGroup($_POST["kgiGroup"], $kgiId);
				// }
				return $this->redirect(Yii::$app->homeUrl . 'kgi/assign/assign/' . ModelMaster::encodeParams(["kgiId" => $kgiId, "companyId" => $_POST["companyId"], "month" => $_POST["month"], "year" => $_POST["year"]]));
				//return $this->redirect(Yii::$app->request->referrer);
				//return $this->redirect('grid');
			}
		} else {
			$groupId = Group::currentGroupId();
			if ($groupId == null) {
				return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
			}
			$role = UserRole::userRight();
			$api = curl_init();
			curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
			curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

			curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
			$companies = curl_exec($api);
			$companies = json_decode($companies, true);

			curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/unit/all-unit');
			$units = curl_exec($api);
			$units = json_decode($units, true);

			curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/all-company');
			$allCompany = curl_exec($api);
			$allCompany = json_decode($allCompany, true);
			curl_close($api);

			$countAllCompany = 0;
			if (count($allCompany) > 0) {
				$countAllCompany = count($allCompany);
				$companyPic = Company::randomPic($allCompany, 3);
			}
			$totalBranch = Branch::totalBranch();
			return $this->render('kgi_form', [
				"statusform" => 'create',
				"role" => $role,
				"companies" => $companies,
				"units" => $units,
				"allCompany" => $countAllCompany,
				"companyPic" => $companyPic,
				"totalBranch" => $totalBranch
			]);
		}
	}
	public function actionCompanyMultiBranch()
	{
		$companyId = $_POST["companyId"];
		$acType = $_POST["acType"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/company-branch?id=' . $companyId);
		$branches = curl_exec($api);
		$branches = json_decode($branches, true);
		if ($acType == "create") {
			$branchText = $this->renderAjax('multi_branch', ["branches" => $branches]);
		} else {
			$kgiId = $_POST["kgiId"];
			$branchText = $this->renderAjax('multi_branch_update', [
				"branches" => $branches,
				"kgiId" => $kgiId
			]);
		}
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-group/company-kgi-group?companyId=' . $companyId);
		$kgiGroups = curl_exec($api);
		$kgiGroups = json_decode($kgiGroups, true);
		$kgiGroup = $this->renderAjax('kgi_group', [
			"kgiGroups" => $kgiGroups,
			"kgiId" => 0
		]);

		curl_close($api);
		$res["status"] = true;
		$res["branchText"] = $branchText;
		$res["kgiGroup"] = $kgiGroup;
		return json_encode($res);
	}
	public function actionBranchMultiDepartment()
	{
		$res["status"] = false;
		$acType = $_POST["acType"];
		if (isset($_POST["multiBranch"]) && count($_POST["multiBranch"]) > 0) {
			//throw new Exception(print_r($_POST["multiBranch"], true));
			$branchIdArr = $_POST["multiBranch"];
			$d = [];
			if (count($branchIdArr) > 0) {
				$i = 0;
				foreach ($branchIdArr as $branchId) :
					$department = Department::find()->where(["branchId" => $branchId, "status" => 1])->asArray()->all();
					if (isset($department) && count($department) > 0) {
						foreach ($department as $dep) :
							$d[$dep["branchId"]][$dep["departmentId"]] = $dep["departmentName"];
						endforeach;
					}
				endforeach;
			}
			if ($acType == "create") {
				$textDepartment = $this->renderAjax('multi_department', [
					"d" => $d,
				]);
			} else {
				$kgiId = $_POST["kgiId"];
				$textDepartment = $this->renderAjax('multi_department_update', [
					"d" => $d,
					"kgiId" => $kgiId
				]);
			}
			$res["status"] = true;
			$res["textDepartment"] = $textDepartment;
		}
		return json_encode($res);
	}
	public function actionDepartmentMultiTeam()
	{
		$res["status"] = false;
		$t = [];
		$textTeam = '';
		$branchDepartment = [];
		$acType = $_POST["acType"];
		//throw new exception(print_r($_POST["multiBranch"], true));
		if (isset($_POST["multiBranch"]) && count($_POST["multiBranch"]) > 0) {
			foreach ($_POST["multiBranch"] as $branchId) :
				if (isset($_POST["multiDepartment"]) && count($_POST["multiDepartment"]) > 0) {
					foreach ($_POST["multiDepartment"] as $departmentId) :
						if ($branchId != '') {
							$department = Department::find()
								->where(["departmentId" => $departmentId, "branchId" => $branchId])
								->andWhere("status!=99")
								->one();
							if (isset($department) && !empty($department)) {
								$branchDepartment[$branchId][$departmentId] = $departmentId;
							}
						}
					endforeach;
				}
			endforeach;
		}
		//throw new exception(print_r($branchDepartment, true));
		if (count($branchDepartment) > 0) {

			foreach ($branchDepartment as $branchId => $departments) :

				foreach ($departments as $dId => $id) :
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
			endforeach;
			//throw new Exception(print_r($t, true));
			if ($acType == "create") {
				$textTeam .= $this->renderAjax('multi_team', [
					"t" => $t,
				]);
			} else {
				$kgiId = $_POST["kgiId"];
				$textTeam .= $this->renderAjax('multi_team_update', [
					"t" => $t,
					"kgiId" => $kgiId
				]);
			}
			$res["status"] = true;
			$res["textTeam"] = $textTeam;
		}
		return json_encode($res);
	}
	public function saveKgiBranch($branch, $kgiId)
	{
		$kgiBranch = KgiBranch::find()->where(["kgiId" => $kgiId, "status" => 1])->all();
		if (isset($kgiBranch) && count($kgiBranch) > 0) {
			foreach ($kgiBranch as $kb) :
				foreach ($branch as $bb) :
					if ($kb->branchId == $bb) {
						$saveBranch[$kb->branchId] = 1;
						break;
					} else {
						$saveBranch[$kb->branchId] = 0;
					}
				endforeach;
				if ($saveBranch[$kb["branchId"]] == 0) {
					$kb->status = 99;
					$kb->save(false);
				}
			endforeach;
		}
		if (count($branch) > 0) {
			foreach ($branch as $b) :
				$old = KgiBranch::find()->where(["kgiId" => $kgiId, "branchId" => $b, "status" => 1])->one();
				if (!isset($old) || empty($old)) {
					$kgiBranch = new KgiBranch();
					$kgiBranch->kgiId = $kgiId;
					$kgiBranch->branchId = $b;
					$kgiBranch->status = 1;
					$kgiBranch->createDateTime = new Expression('NOW()');
					$kgiBranch->updateDateTime = new Expression('NOW()');
					$kgiBranch->save(false);
				}
			endforeach;
		}
	}
	public function saveKgiDepartment($department, $kgiId)
	{
		$kgiDepartment = KgiDepartment::find()->where(["kgiId" => $kgiId, "status" => 1])->all();
		if (isset($kgiDepartment) && count($kgiDepartment) > 0) {
			foreach ($kgiDepartment as $kd) :
				foreach ($department as $dp) :
					if ($kd->departmentId == $dp) {
						$saveDepartment[$kd->departmentId] = 1;
						break;
					} else {
						$saveDepartment[$kd->departmentId] = 0;
					}
				endforeach;
				if ($saveDepartment[$kd->departmentId] == 0) {
					$kd->status = 99;
					$kd->save(false);
				}
			endforeach;
		}
		if (count($department) > 0) {
			foreach ($department as $d) :
				$old = KgiDepartment::find()->where(["kgiId" => $kgiId, "departmentId" => $d, "status" => 1])->one();
				if (!isset($old) || empty($old)) {
					$kgiDepartment = new KgiDepartment();
					$kgiDepartment->kgiId = $kgiId;
					$kgiDepartment->departmentId = $d;
					$kgiDepartment->status = 1;
					$kgiDepartment->createDateTime = new Expression('NOW()');
					$kgiDepartment->updateDateTime = new Expression('NOW()');
					$kgiDepartment->save(false);
				}
			endforeach;
		}
	}
	public function saveKgiTeam($team, $kgiId, $month, $year)
	{
		$kgiTeam = KgiTeam::find()->where(["kgiId" => $kgiId, "status" => 1])->all();
		if (isset($kgiTeam) && count($kgiTeam) > 0) {
			foreach ($kgiTeam as $kt) :
				foreach ($team as $tt) :
					if ($kt->teamId == $tt) {
						$saveTeam[$kt->teamId] = 1;
						break;
					} else {
						$saveTeam[$kt->teamId] = 0;
					}
				endforeach;
				if ($saveTeam[$kt["teamId"]] == 0) {
					$kt->status = 99;
					$kt->save(false);
				}
			endforeach;
		}
		if (count($team) > 0) {
			foreach ($team as $t) :
				$old = KgiTeam::find()->where(["kgiId" => $kgiId, "teamId" => $t, "status" => [1, 2, 4]])->one();
				if (!isset($old) || empty($old)) {
					$kgiTeam = new KgiTeam();
					$kgiTeam->kgiId = $kgiId;
					$kgiTeam->teamId = $t;
					$kgiTeam->status = 1;
					$kgiTeam->month = $month;
					$kgiTeam->year = $year;
					$kgiTeam->createDateTime = new Expression('NOW()');
					$kgiTeam->updateDateTime = new Expression('NOW()');
					$kgiTeam->save(false);
					$kgiTeamId = Yii::$app->db->lastInsertID;
					$kgiTeamHistory = new KgiTeamHistory();
					$kgiTeamHistory->kgiTeamId = $kgiTeamId;
					$kgiTeamHistory->target = null;
					$kgiTeamHistory->result = null;
					$kgiTeamHistory->createrId = Yii::$app->user->id;
					$kgiTeamHistory->status = 1;
					$kgiTeamHistory->month = $month;
					$kgiTeamHistory->year = $year;
					$kgiTeamHistory->createDateTime = new Expression('NOW()');
					$kgiTeamHistory->updateDateTime = new Expression('NOW()');
					$kgiTeamHistory->save(false);
				}
			endforeach;
		}
	}
	public function saveKgiEmployee($team, $kgiId)
	{
		if (count($team) > 0) {
			foreach ($team as $t) :
				$employee = Employee::find()->where(["teamId" => $t, "status" => 1])->all();
				if (isset($employee) && count($employee) > 0) {
					foreach ($employee as $e) :
						$kgiEmployee = new KgiEmployee();
						$kgiEmployee->employeeId = $e->employeeId;
						$kgiEmployee->kgiId = $kgiId;
						$kgiEmployee->createrId = Yii::$app->user->id;
						$kgiEmployee->status = 1;
						$kgiEmployee->createDateTime = new Expression('NOW()');
						$kgiEmployee->updateDateTime = new Expression('NOW()');

						$kgiEmployee->save(false);
						$kgiEmployeeId = Yii::$app->db->lastInsertID;
						$kgiEmployeeHistory = new KgiEmployeeHistory();
						$kgiEmployeeHistory->kgiEmployeeId = $kgiEmployeeId;
						$kgiEmployeeHistory->target = null;
						$kgiEmployeeHistory->result = null;
						$kgiEmployeeHistory->createrId = Yii::$app->user->id;
						$kgiEmployeeHistory->status = 1;
						$kgiEmployeeHistory->createDateTime = new Expression('NOW()');
						$kgiEmployeeHistory->updateDateTime = new Expression('NOW()');
						$kgiEmployeeHistory->save(false);
					endforeach;
				}
			endforeach;
		}
	}
	public function saveKgiGroup($kgiGroup, $kgiId)
	{
		GroupHasKgi::updateAll(["status" => 99], ["kgiId" => $kgiId]);
		if (count($kgiGroup) > 0) {
			foreach ($kgiGroup as $groupId) :
				$groupHasKgi = new GroupHasKgi();
				$groupHasKgi->kgiId = $kgiId;
				$groupHasKgi->kgiGroupId = $groupId;
				$groupHasKgi->status = 1;
				$groupHasKgi->createDateTime = new Expression('NOW()');
				$groupHasKgi->updateDateTime = new Expression('NOW()');
				$groupHasKgi->save(false);
			endforeach;
		}
	}
	public function actionPrepareUpdate($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$kgiId = $param["kgiId"];
		$kgiHistoryId = $param["kgiHistoryId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiId . '&&kgiHistoryId=' . $kgiHistoryId);
		$kgi = curl_exec($api);
		$kgi = json_decode($kgi, true);

		$companyId = $kgi["companyId"];
		$kgiBranchText = '';
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/company-branch?id=' . $companyId);
		$kgiBranch = curl_exec($api);
		$kgiBranch = json_decode($kgiBranch, true);
		$kgiBranchText = $this->renderAjax('multi_branch_update', [
			"branches" => $kgiBranch,
			"kgiId" => $kgiId
		]);
		$branch["textBranch"] = $kgiBranchText;

		$kgiDepartmentText = '';
		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-department?id=' . $kgiId);
		// $kgiDepartment = curl_exec($api);
		// $kgiDepartment = json_decode($kgiDepartment, true);
		$branchIdArr = KgiBranch::kgiBranch($kgiId);
		$d = [];
		if (count($branchIdArr) > 0) {
			$i = 0;
			foreach ($branchIdArr as $branchId) :
				$department = Department::find()->where(["branchId" => $branchId, "status" => 1])->asArray()->all();
				if (isset($department) && count($department) > 0) {
					foreach ($department as $dep) :
						$d[$dep["branchId"]][$dep["departmentId"]] = $dep["departmentName"];
					endforeach;
				}
			endforeach;
		}
		$kgiDepartmentText = $this->renderAjax('multi_department_update', [
			"d" => $d,
			"kgiBranch" => $kgiBranch,
			"kgiId" => $kgiId
		]);
		$department["textDepartment"] = $kgiDepartmentText;

		$kgiTeamText = '';
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-team?id=' . $kgiId);
		$kgiTeam = curl_exec($api);
		$kgiTeam = json_decode($kgiTeam, true);
		$kgiDepartment = KgiDepartment::kgiDepartment($kgiId);
		$t = [];
		if (count($kgiDepartment) > 0) {
			$i = 0;
			foreach ($kgiDepartment as $departmentId) :
				$teams = Team::find()->where(["departmentId" => $departmentId, "status" => 1])->asArray()->all();
				if (isset($teams) && count($teams) > 0) {
					foreach ($teams as $team) :
						$t[$team["departmentId"]][$team["teamId"]] = $team["teamName"];
					endforeach;
				}
			endforeach;
		}
		$kgiTeamText = $this->renderAjax('multi_team_update', [
			"t" => $t,
			"kgiId" => $kgiId
		]);
		//throw new exception($kgiTeamText);
		$team["textTeam"] = $kgiTeamText;
		$data = array_merge($kgi, $branch, $department, $team);

		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		$role = UserRole::userRight();
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$companies = curl_exec($api);
		$companies = json_decode($companies, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/unit/all-unit');
		$units = curl_exec($api);
		$units = json_decode($units, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/all-company');
		$allCompany = curl_exec($api);
		$allCompany = json_decode($allCompany, true);
		curl_close($api);

		$countAllCompany = 0;
		if (count($allCompany) > 0) {
			$countAllCompany = count($allCompany);
			$companyPic = Company::randomPic($allCompany, 3);
		}
		$totalBranch = Branch::totalBranch();
		return $this->render('kgi_form', [
			"statusform" => 'update',
			"role" => $role,
			"companies" => $companies,
			"units" => $units,
			"data" => $data,
			"kgiBranchText" => $kgiBranchText,
			"kgiDepartmentText" => $kgiDepartmentText,
			"kgiTeamText" => $kgiTeamText,
			"kgiId" => $kgiId,
			"url" => Yii::$app->request->referrer,
			"allCompany" => $countAllCompany,
			"companyPic" => $companyPic,
			"totalBranch" => $totalBranch

		]);
	}
	public function actionUpdateKgi()
	{
		$isManager = UserRole::isManager();
		//throw new exception(print_r(Yii::$app->request->post(), true));
		if (isset($_POST["kgiId"]) && $_POST["kgiId"] != "") {
			//$result = isset($_POST["result"]) && $_POST["result"] != '' ? $_POST["result"] : 0;
			if (isset($_POST["result"])) {
				$result = $_POST["result"];
			} else {
				$result = $_POST["autoUpdate"];
			}
			$kgiId = $_POST["kgiId"];
			$kgi = Kgi::find()->where(["kgiId" => $kgiId])->one();
			$kgi->kgiName = $_POST["kgiName"];
			$kgi->companyId = $_POST["companyId"];
			$kgi->unitId = $_POST["unitId"];
			//if ($kgi->fromDate == "") {
			$kgi->fromDate = $_POST["fromDate"];
			//}
			//if ($kgi->toDate == "") {
			$kgi->toDate = $_POST["toDate"];
			//}
			if ($isManager == 1 &&  $_POST["amount"] != "") {
				$kgi->targetAmount = str_replace(",", "", $_POST["amount"]);
			}
			//$kgi->targetAmount = $_POST["targetAmount"];
			$kgi->kgiDetail = $_POST["detail"];
			$kgi->quantRatio = $_POST["quantRatio"];
			$kgi->priority = $_POST["priority"];
			$kgi->amountType = $_POST["amountType"];
			$kgi->code = $_POST["code"];
			$kgi->status = $_POST["status"];
			$kgi->month = $_POST["month"];
			$kgi->year = $_POST["year"];
			$kgi->result = str_replace(",", "", $result);
			$kgi->updateDateTime = new Expression('NOW()');
			if ($kgi->save(false)) {
				$kgiHistory = new KgiHistory();
				$kgiHistory->kgiId = $_POST["kgiId"];
				// $kgiHistory->kgiHistoryName = $_POST["historyName"];
				// $kgiHistory->titleProcess = $_POST["historyName"];
				$kgiHistory->unitId = $_POST["unitId"];
				$kgiHistory->nextCheckDate = $_POST["nextCheckDate"];
				if ($isManager == 1) {
					$kgiHistory->targetAmount = str_replace(",", "", $_POST["amount"]);
				} else {
					$kgiHistory->targetAmount = $kgi->targetAmount;
				}
				$kgiHistory->description = $_POST["detail"];
				//$kgiHistory->remark = $_POST["remark"];
				$kgiHistory->quantRatio = $_POST["quantRatio"];
				$kgiHistory->priority = $_POST["priority"];
				$kgiHistory->amountType = $_POST["amountType"];
				$kgiHistory->code = $_POST["code"];
				$kgiHistory->status = $_POST["status"];
				$kgiHistory->month = $_POST["month"];
				$kgiHistory->year = $_POST["year"];
				$kgiHistory->result = str_replace(",", "", $result);
				$kgiHistory->createrId = Yii::$app->user->id;
				$kgiHistory->createDateTime = new Expression('NOW()');
				$kgiHistory->updateDateTime = new Expression('NOW()');
				$kgiHistory->fromDate = $_POST["fromDate"];
				$kgiHistory->toDate = $_POST["toDate"];
				$kgiHistory->save(false);
				if (isset($_POST["branch"]) && count($_POST["branch"]) > 0) {
					$this->saveKgiBranch($_POST["branch"], $kgiId);
				}
				if (isset($_POST["department"]) && count($_POST["department"]) > 0) {
					$this->saveKgiDepartment($_POST["department"], $kgiId);
				}
				if (isset($_POST["team"]) && count($_POST["team"]) > 0) {
					$this->saveKgiTeam($_POST["team"], $kgiId, $_POST["month"], $_POST["year"]);
				}
				if (isset($_POST["kgiGroup"]) && count($_POST["kgiGroup"]) > 0) {
				}
				return $this->redirect($_POST["url"]);
			}
		}
		return $this->redirect('grid');
	}
	public function actionHistory()
	{
		$kgiId = $_POST["kgiId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiId . '&&kgiHistoryId=0');
		$kgi = curl_exec($api);
		$kgi = json_decode($kgi, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-team?id=' . $kgiId);
		$kgiTeams = curl_exec($api);
		$kgiTeams = json_decode($kgiTeams, true);
		//throw new Exception(print_r($kgiTeams, true));
		$res["teamText"] = $this->renderAjax('kgi_team', ["kgiTeams" => $kgiTeams, "kgiId" => $kgiId]);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-employee?id=' . $kgiId);
		$kgiEmloyee = curl_exec($api);
		$kgiEmloyee = json_decode($kgiEmloyee, true);
		$res["employeeText"] = $this->renderAjax('kgi_member', ["kgiEmloyee" => $kgiEmloyee, "kgiId" => $kgiId]);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-history?kgiId=' . $kgiId);
		$history = curl_exec($api);
		$history = json_decode($history, true);
		$res["historyText"] = $this->renderAjax('kgi_history', ["history" => $history]);

		curl_close($api);

		$res["kgi"] = $kgi;


		return json_encode($res);
	}
	public function actionDeleteKgi()
	{
		$kgiId = $_POST["kgiId"];
		KgiTeam::updateAll(["status" => 99], ["kgiId" => $kgiId]);
		KgiDepartment::updateAll(["status" => 99], ["kgiId" => $kgiId]);
		KgiBranch::updateAll(["status" => 99], ["kgiId" => $kgiId]);
		KgiHistory::updateAll(["status" => 99], ["kgiId" => $kgiId]);
		Kgi::updateAll(["status" => 99], ["kgiId" => $kgiId]);
		$res["status"] = true;
		return json_encode($res);
	}

	public function actionShowComment()
	{
		$userId = Yii::$app->user->id;
		$employeeId = User::employeeIdFromUserId($userId);
		$kgiId = $_POST["kgiId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiId . '&&kgiHistoryId=0');
		$kgi = curl_exec($api);
		$kgi = json_decode($kgi, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-issue?kgiId=' . $kgiId);
		$kgiIssue = curl_exec($api);
		$kgiIssue = json_decode($kgiIssue, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/employee/employee-detail?id=' . $employeeId);
		$profile = curl_exec($api);
		$profile = json_decode($profile, true);

		curl_close($api);
		$res["status"] = true;
		$res["issueText"] = $this->renderAjax('kgi_issue', [
			"kgiIssue" => $kgiIssue,
			"kgiId" => $kgiId,
			"profile" => $profile,
			"employeeId" => $employeeId,
			"kgiName" => $kgi["kgiName"]
		]);
		$res["historyText"] =  $this->renderAjax('kgi_history2', [
			"kgiIssue" => $kgiIssue,
			"kgiId" => $kgiId,
			"profile" => $profile,
			"employeeId" => $employeeId,
			"kgiName" => $kgi["kgiName"]
		]);
		$res["kgi"] = $kgi;

		return json_encode($res);
	}
	/*public function actionCreateNewIssue()
	{
		if (isset($_POST["newIssue"]) && trim($_POST["newIssue"]) != "") {
			$kgiIssue = new KgiIssue();
			$kgiIssue->issue = $_POST["newIssue"];
			$kgiIssue->kgiId = $_POST["kgiId"];
			$kgiIssue->employeeId = $_POST["employeeId"];
			$kgiIssue->status = 1;
			$kgiIssue->createDateTime = new Expression('NOW()');
			$kgiIssue->updateDateTime = new Expression('NOW()');
			$fileObj = UploadedFile::getInstanceByName("attachKgiFile");
			if (isset($fileObj) && !empty($fileObj)) {
				//throw new Exception("asdfad");
				$path = Path::getHost() . 'file/kgi/';
				if (!file_exists($path)) {
					mkdir($path, 0777, true);
				}
				$file = $fileObj->name;
				$filenameArray = explode('.', $file);
				$countArrayFile = count($filenameArray);
				$fileName = Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[$countArrayFile - 1];
				$pathSave = $path . $fileName;
				$fileObj->saveAs($pathSave);
				$kgiIssue->file = 'file/kgi/' . $fileName;
			}
			//throw new Exception(print_r(Yii::$app->request->post(), true));
			if ($kgiIssue->save(false)) {
				//return $this->redirect('grid');
			}
		}
	}*/
	public function actionCreateNewIssue()
	{
		$kgiIssue = new KgiIssue();
		$kgiIssue->issue = $_POST["issue"];
		$kgiIssue->description = $_POST["description"];
		$kgiIssue->kgiId = $_POST["kgiId"];
		$kgiIssue->employeeId = $_POST["employeeId"];
		$kgiIssue->status = 1;
		$kgiIssue->createDateTime = new Expression('NOW()');
		$kgiIssue->updateDateTime = new Expression('NOW()');
		$file = '';
		$fileName = '';
		$res = [];
		if (isset($_FILES['file']['name'])) {
			$fileObj = UploadedFile::getInstanceByName("file");
			$filename = $_FILES['file']['name'];
			$path = Path::getHost() . 'file/kgi/';
			if (!file_exists($path)) {
				mkdir($path, 0777, true);
			}
			$filenameArray = explode('.', $filename);
			$fileName = Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[1];
			$pathSave = $path . $fileName;
			$fileObj->saveAs($pathSave);
			$kgiIssue->file = 'file/kgi/' . $fileName;
			$file = 'file/kgi/' . $fileName;
		}
		if ($kgiIssue->save(false)) {
			$res["status"] = true;
			$api = curl_init();
			curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
			curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-issue?kgiId=' . $_POST["kgiId"]);
			$kgiIssue = curl_exec($api);
			$kgiIssue = json_decode($kgiIssue, true);

			curl_close($api);
			$res["text"] = $this->renderAjax("issue_history", [
				"kgiIssue" => $kgiIssue,
				"kgiId" => $_POST["kgiId"],
				"employeeId" => $_POST["employeeId"]
			]);
		}
		return json_encode($res);
	}
	public function actionSaveKgiAnswer()
	{
		$solution = $_POST["answer"];
		$kgiIssueId = $_POST["kgiIssueId"];
		$employeeId = User::employeeIdFromUserId(Yii::$app->user->id);
		$answer = new KgiSolution();
		$res["status"] = false;
		$file = '';
		$fileName = '';
		$lastestKgiIssue = KgiSolution::find()
			->where(["kgiIssueId" => $kgiIssueId])
			->orderBy('kgiSolutionId DESC')
			->asArray()
			->one();
		if (isset($lastestKgiIssue)) {
			$res["lastest"] = $lastestKgiIssue["kgiSolutionId"];
		} else {
			$res["lastest"] = 0;
		}
		if (isset($_FILES['file']['name'])) {
			$fileObj = UploadedFile::getInstanceByName("file");
			$filename = $_FILES['file']['name'];
			$path = Path::getHost() . 'file/kgi/';
			if (!file_exists($path)) {
				mkdir($path, 0777, true);
			}
			$filenameArray = explode('.', $filename);
			$fileName = Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[1];
			$pathSave = $path . $fileName;
			$fileObj->saveAs($pathSave);
			$answer->file = 'file/kgi/' . $fileName;
			$file = 'file/kgi/' . $fileName;
		}

		$answer->kgiIssueId = $kgiIssueId;
		$answer->solution = $solution;
		$answer->parentId = null;
		$answer->employeeId = $employeeId;
		$answer->status = 1;
		$answer->createDateTime = new Expression('NOW()');
		$answer->updateDateTime = new Expression('NOW()');
		$createDateTime = date('Y-m-d H:i:s');
		if ($answer->save(false)) {
			$kgiSolutionId = Yii::$app->db->lastInsertID;
			$kgiIssue = KgiIssue::find()
				->select('kgiId,issue')
				->where(["kgiIssueId" => $kgiIssueId])
				->one();
			$kgiIssue->updateDateTime = new Expression('NOW()');
			$kgiId = $kgiIssue->kgiId;
			$kgiIssue->save(false);

			$res["commentText"] = $this->renderAjax('comment', [
				"name" => User::userHeaderName(),
				"image" => User::userHeaderImage(),
				"answer" => $solution,
				"createDateTime" => ModelMaster::timeMonthDateYear($createDateTime),
				"kgiIssueId" => $kgiIssueId,
				"file" => $file,
				"fileName" => $fileName,
				"lastestKgiSolutionId" => $res["lastest"],
				"kgiSolutionId" => $kgiSolutionId
			]);
			$res["status"] = true;
			$res["issue"] = $kgiIssue["issue"];
			$res["solution"] = $solution;
			$res["kgiId"] = $kgiId;
		}

		return json_encode($res);
	}
	public function actionSearchKgi()
	{
		$companyId = isset($_POST["companyId"]) && $_POST["companyId"] != null ? $_POST["companyId"] : null;
		$branchId = isset($_POST["branchId"]) && $_POST["branchId"] != null ? $_POST["branchId"] : null;
		$teamId = isset($_POST["teamId"]) && $_POST["teamId"] != null ? $_POST["teamId"] : null;
		$month = isset($_POST["month"]) && $_POST["month"] != null ? $_POST["month"] : null;
		$status = isset($_POST["status"]) && $_POST["status"] != null ? $_POST["status"] : null;
		$year = isset($_POST["year"]) && $_POST["year"] != null ? $_POST["year"] : null;
		$type = $_POST["type"];
		return $this->redirect(Yii::$app->homeUrl . 'kgi/management/kgi-search-result/' . ModelMaster::encodeParams([
			"companyId" => $companyId,
			"branchId" => $branchId,
			"teamId" => $teamId,
			"month" => $month,
			"status" => $status,
			"year" => $year,
			"type" => $type
		]));
	}
	public function actionKgiSearchResult($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$companyId = $param["companyId"];
		$branchId = $param["branchId"];
		$teamId = isset($param["teamId"]) ? $param["teamId"] : null;
		$month = $param["month"];
		$status = $param["status"];
		$year = $param["year"];
		$type = $param["type"];
		$branches = [];
		$teams = [];
		Session::PimFilter($companyId, $branchId, $month, $year, $status, $type);
		if ($companyId == "" && $branchId == "" && $month == "" && $status == "" && $year == "") {
			if ($type == "list") {
				return $this->redirect(Yii::$app->homeUrl . 'kgi/management/index');
			} else {
				return $this->redirect(Yii::$app->homeUrl . 'kgi/management/grid');
			}
		}
		$currentPage = 1;
		$limit = 20;
		if (isset($param["currentPage"])) {
			$currentPage = $param["currentPage"];
		}
		$paramText = 'companyId=' . $companyId . '&&branchId=' . $branchId . '&&teamId=' . $teamId . '&&month=' . $month . '&&status=' . $status . '&&year=' . $year;

		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
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
			//return $this->redirect(Yii::$app->homeUrl . 'kgi/kgi-personal/individual-kgi');
		}
		//$paramText .= '&&adminId=' . $adminId . '&&managerId=' . $managerId . '&&supervisorId=' . $supervisorId . '&&staffId=' . $staffId;
		$paramText .= '&&adminId=' . $adminId . '&&gmId=' . $gmId . '&&managerId=' . $managerId . '&&supervisorId=' . $supervisorId . '&&teamLeaderId=' . $teamLeaderId . '&&staffId=' . $staffId . '&&currentPage=' . $currentPage . '&&limit=' . $limit;
		//throw new exception($paramText);
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-filter?' . $paramText);
		$kgis = curl_exec($api);
		$kgis = json_decode($kgis, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$companies = curl_exec($api);
		$companies = json_decode($companies, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/unit/all-unit');
		$units = curl_exec($api);
		$units = json_decode($units, true);

		if ($companyId != "") {
			curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/company-branch?id=' . $companyId);
			$branches = curl_exec($api);
			$branches = json_decode($branches, true);
		}
		if ($branchId != "") {
			curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/branch-team?id=' . $branchId);
			$teams = curl_exec($api);
			$teams = json_decode($teams, true);
		}

		curl_close($api);
		$months = ModelMaster::monthFull(1);
		if ($type == "list") {
			$file = "index";
		} else {
			$file = "kgi_grid";
		}
		$filter = [
			"companyId" => $companyId,
			"branchId" => $branchId,
			"month" => $month,
			"year" => $year,
			"status" => $status,
			"branches" => $branches,
			"perPage" => 5,
		];
		//throw new exception(print_r($kgis, true));
		$employee = Employee::employeeDetailByUserId(Yii::$app->user->id);
		$employeeCompanyId = $employee["companyId"];
		$isManager = UserRole::isManager();
		$totalKgi = $kgis["total"];
		$totalPage = ceil($totalKgi / $limit);
		$pagination = ModelMaster::getPagination($currentPage, $totalPage);
		return $this->render($file, [
			"units" => $units,
			"companies" => $companies,
			"months" => $months,
			"kgis" => $kgis,
			"companyId" => $companyId,
			"employeeCompanyId" => $employeeCompanyId,
			"branchId" => $branchId,
			"teamId" => $teamId,
			"month" => $month,
			"status" => $status,
			"year" => $year,
			"branches" => $branches,
			"teams" => $teams,
			"isManager" => $isManager,
			"role" => $role,
			"userId" => Yii::$app->user->id,
			"pagination" => $pagination,
			"totalKgi" => $totalKgi,
			"currentPage" => $currentPage,
			"totalPage" => $totalPage,
			"filter" => $filter
		]);
	}
	public function actionCopyKgi($kgiId)
	{
		$role = UserRole::userRight();
		if ($role < 3) {
			return $this->redirect(Yii::$app->homeUrl . 'kgi/management/index');
		}
		$kgi = Kgi::find()->where(["kgiId" => $kgiId])->asArray()->one();
		$copy = new Kgi();
		$copy->kgiName = $kgi["kgiName"] . ' copy';
		$copy->companyId = $kgi["companyId"];
		$copy->unitId = $kgi["unitId"];
		//$kgi->periodDate = $_POST["periodDate"];
		$copy->fromDate = $kgi["fromDate"];
		$copy->toDate = $kgi["toDate"];
		$copy->targetAmount = $kgi["targetAmount"];
		$copy->kgiDetail = $kgi["kgiDetail"];
		$copy->quantRatio = $kgi["quantRatio"];
		$copy->priority = $kgi["priority"];
		$copy->amountType = $kgi["amountType"];
		$copy->code = $kgi["code"];
		$copy->status = $kgi["status"];
		$copy->month = $kgi["month"];
		$copy->result = $kgi["result"];
		$copy->createrId = Yii::$app->user->id;
		$copy->createDateTime = new Expression('NOW()');
		$copy->updateDateTime = new Expression('NOW()');
		if ($copy->save(false)) {
			$kgiCopyId = Yii::$app->db->lastInsertID;
			$branch = [];
			$branches = KgiBranch::find()
				->select('branchId')
				->where(["kgiId" => $kgiId])
				->asArray()
				->all();
			if (count($branches) > 0) {
				$i = 0;
				foreach ($branches as $b) :
					$branch[$i] = $b["branchId"];
					$i++;
				endforeach;
			}
			if (count($branch) > 0) {
				$this->saveKgiBranch($branch, $kgiCopyId);
			}
			$department = [];
			$departments = KgiDepartment::find()
				->select('departmentId')
				->where(["kgiId" => $kgiId])
				->asArray()
				->all();
			if (count($departments) > 0) {
				$i = 0;
				foreach ($departments as $d) :
					$department[$i] = $d["departmentId"];
					$i++;
				endforeach;
			}
			if (count($department) > 0) {
				$this->saveKgiDepartment($department, $kgiCopyId);
			}
			$team = [];
			$teams = KgiTeam::find()
				->select('teamId')
				->where(["kgiId" => $kgiId])
				->asArray()
				->all();
			if (count($teams) > 0) {
				$i = 0;
				foreach ($teams as $t) :
					$team[$i] = $t["teamId"];
					$i++;
				endforeach;
			}
			if (count($team) > 0) {
				$this->saveKgiTeam($team, $kgiCopyId, $kgi["month"], $kgi["year"]);
			}
			return $this->redirect('grid');
		}
	}
	public function actionAssignKgi()
	{
		$role = UserRole::userRight();
		if ($role < 3) {
			return $this->redirect(Yii::$app->homeUrl . 'kgi/management/index');
		}
		$adminId = '';
		$managerId = '';
		$supervisorId = '';
		$staffId = '';
		$gmId = '';
		$teamLeaderId = '';
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
			return $this->redirect(Yii::$app->homeUrl . 'kgi/kgi-personal/individual-kgi');
		}
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/index?adminId=' . $adminId . '&&gmId=' . $gmId . '&&managerId=' . $managerId . '&&supervisorId=' . $supervisorId . '&&teamLeaderId=' . $teamLeaderId . '&&staffId=' . $staffId);
		//curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/index?adminId=' . $adminId . '&&managerId=' . $managerId . '&&supervisorId=' . $supervisorId . '&&staffId=' . $staffId);
		$kgis = curl_exec($api);
		$kgis = json_decode($kgis, true);

		curl_close($api);
		$months = ModelMaster::monthFull(1);
		return $this->render('assign', [
			"kgis" => $kgis,
			"months" => $months
		]);
	}
	public function actionKgiBranch()
	{
		$companyId = $_POST["companyId"];
		$kgiId = $_POST["kgiId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/company-branch?id=' . $companyId);
		$branches = curl_exec($api);
		$branches = json_decode($branches, true);
		$textBranch = "";
		$textBranch .= $this->renderAjax('company_branch', ["branches" => $branches, "kgiId" => $kgiId]);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiId . '&&kgiHistoryId=0');
		$kgi = curl_exec($api);
		$kgi = json_decode($kgi, true);

		curl_close($api);
		$res["kgiName"] = $kgi["kgiName"];
		$res["companyName"] = $kgi["companyName"];
		$res["textBranch"] = $textBranch;
		if ($textBranch != "") {
			$res["status"] = true;
		} else {
			$res["status"] = false;
		}
		return json_encode($res);
	}
	public function actionKgiAssignBranch()
	{
		$kgiId = $_POST["kgiId"];
		$branchId = $_POST["branchId"];
		$checked = $_POST["checked"];
		if ($checked == 1) {
			// $kgiBranch = KgiBranch::find()
			// 	->where(["kgiId" => $kgiId, "branchId" => $branchId])
			// 	->one();
			// if (isset($kgiBranch) && !empty($kgiBranch)) {
			// 	$kgiBranch->status = 1;
			/*$branchDepartment = Department::find()->where(["branchId" => $branchId])->asArray()->all();
				if (isset($branchDepartment) && count($branchDepartment) > 0) {
					foreach ($branchDepartment as $department) :
						KgiDepartment::updateAll(["status" => 1], ["departmentId" => $department["departmentId"], "kgiId" => $kgiId, "status" => 98]);
						$teams = Team::find()
							->where(["departmentId" => $department["departmentId"], "status" => 1])
							->asArray()
							->all();
						if (isset($teams) && count($teams) > 0) {
							foreach ($teams as $team) :
								KgiTeam::updateAll(["status" => 1], ["teamId" => $team["teamId"], "kgiId" => $kgiId, "status" => 98]);
								$employee = Employee::find()
									->where(["teamId" => $team["teamId"]])
									->asArray()
									->all();
								if (isset($employee) && count($employee) > 0) {
									foreach ($employee as $em) :
										KgiEmployee::updateAll(["status" => 1], ["employeeId" => $em["employeeId"], "kgiId" => $kgiId, "status" => 98]);
									endforeach;
								}

							endforeach;
						}
					endforeach;
				}*/
			//} else {
			$kgiBranch = new KgiBranch();
			$kgiBranch->branchId = $branchId;
			$kgiBranch->kgiId = $kgiId;
			$kgiBranch->status = 1;
			$kgiBranch->createDateTime = new Expression('NOW()');
			$kgiBranch->updateDateTime = new Expression('NOW()');
			//}
			$kgiBranch->save(false);
		} else {
			//KgiBranch::updateAll(["status" => 98], ["branchId" => $branchId, "kgiId" => $kgiId, "status" => 1]);
			KgiBranch::deleteAll(["branchId" => $branchId, "kgiId" => $kgiId]);
			$branchDepartment = Department::find()->where(["branchId" => $branchId])->asArray()->all();
			if (isset($branchDepartment) && count($branchDepartment) > 0) {
				foreach ($branchDepartment as $department) :
					//KgiDepartment::updateAll(["status" => 98], ["departmentId" => $department["departmentId"], "kgiId" => $kgiId, "status" => 1]);
					KgiDepartment::deleteAll(["departmentId" => $department["departmentId"], "kgiId" => $kgiId]);
					$teams = Team::find()
						->where(["departmentId" => $department["departmentId"], "status" => 1])
						->asArray()
						->all();
					if (isset($teams) && count($teams) > 0) {
						foreach ($teams as $team) :
							//KgiTeam::updateAll(["status" => 98], ["teamId" => $team["teamId"], "kgiId" => $kgiId, "status" => 1]);
							KgiTeam::deleteAll(["teamId" => $team["teamId"], "kgiId" => $kgiId]);
							$employee = Employee::find()
								->where(["teamId" => $team["teamId"]])
								->asArray()
								->all();
							if (isset($employee) && count($employee) > 0) {
								foreach ($employee as $em) :
									//KgiEmployee::updateAll(["status" => 98], ["employeeId" => $em["employeeId"], "kgiId" => $kgiId, "status" => 1]);
									KgiEmployee::deleteAll(["employeeId" => $em["employeeId"], "kgiId" => $kgiId]);
								endforeach;
							}

						endforeach;
					}
				endforeach;
			}
		}
		$kgiBranch = KgiBranch::find()
			->where(["kgiId" => $kgiId, "status" => 1])
			->asArray()
			->all();
		$res["status"] = true;
		$res["totalBranch"] = count($kgiBranch);
		return json_encode($res);
	}
	public function actionKgiEmployee()
	{
		$kgiId = $_POST["kgiId"];
		$kgiBranch = KgiBranch::find()
			->where(["kgiId" => $kgiId, "status" => 1])
			->asArray()
			->all();
		$employees = [];
		$departmentText = '<option value="">Department</option>';
		if (isset($kgiBranch) && count($kgiBranch) > 0) {
			$i = 0;
			foreach ($kgiBranch as $kb) :
				$employee = Employee::find()
					->where(["branchId" => $kb["branchId"], "status" => 1])
					->asArray()
					->orderBy('branchId,titleId')
					->all();
				if (isset($employee) && count($employee) > 0) {
					foreach ($employee as $em) :
						if ($em["picture"] != "") {
							$picture = $em['picture'];
						} else {
							if ($em['gender'] == 1) {
								$picture = 'image/user.png';
							} else {
								$picture = 'image/lady.jpg';
							}
						}
						$employees[$i] = [
							"name" => $em["employeeFirstname"] . ' ' . $em["employeeSurename"],
							"id" => $em["employeeId"],
							"branch" => Branch::branchName($em["branchId"]),
							"department" => Department::departmentNAme($em["departmentId"]),
							"team" => Team::teamName($em["teamId"]),
							"picture" => $picture,
							"title" => Title::titleName($em["titleId"])
						];
						$i++;
					endforeach;
				}
				$departments = Department::find()
					->select('departmentId,departmentName')
					->where(["branchId" => $kb["branchId"], "status" => 1])->asArray()
					->orderBy("departmentName")
					->all();
				if (isset($departments) && count($departments) > 0) {
					foreach ($departments as $dp) :
						$departmentText .= '<option value="' . $dp["departmentId"] . '">' . $dp["departmentName"] . '</option>';
					endforeach;
				}

			endforeach;
		}

		$textEmployee = $this->renderAjax('branch_employee', ["employees" => $employees, "kgiId" => $kgiId]);
		$res["status"] = true;
		$res["textEmployee"] = $textEmployee;
		$res["departmentText"] = $departmentText;
		return json_encode($res);
	}
	public function actionKgiAssignEmployee()
	{
		$kgiId = $_POST["kgiId"];
		$employeeId = $_POST["employeeId"];
		$checked = $_POST["checked"];
		if ($checked == 1) {
			// $kgiEmployee = KgiEmployee::find()
			// 	->where(["kgiId" => $kgiId, "employeeId" => $employeeId])
			// 	->one();
			// if (isset($kgiEmployee) && !empty($kgiEmployee)) {
			// 	$kgiEmployee->status = 1;
			// } else {
			$kgiEmployee = new KgiEmployee();
			$kgiEmployee->employeeId = $employeeId;
			$kgiEmployee->kgiId = $kgiId;
			$kgiEmployee->createrId = Yii::$app->user->id;
			$kgiEmployee->status = 1;
			$kgiEmployee->createDateTime = new Expression('NOW()');
			$kgiEmployee->updateDateTime = new Expression('NOW()');
			//}
			$kgiEmployee->save(false);
			$kgiEmployeeId = Yii::$app->db->lastInsertID;
			$kgiEmployeeHistory = new KgiEmployeeHistory();
			$kgiEmployeeHistory->kgiEmployeeId = $kgiEmployeeId;
			$kgiEmployeeHistory->target = null;
			$kgiEmployeeHistory->result = null;
			$kgiEmployeeHistory->createrId = Yii::$app->user->id;
			$kgiEmployeeHistory->status = 1;
			$kgiEmployeeHistory->createDateTime = new Expression('NOW()');
			$kgiEmployeeHistory->updateDateTime = new Expression('NOW()');
			//}
			$kgiEmployeeHistory->save(false);

			$employee = Employee::find()
				->select('departmentId,teamId')
				->where(["employeeId" => $employeeId, "status" => 1])
				->asArray()
				->one();
			if (isset($employee) && !empty($employee)) {
				$kgiDepartment = KgiDepartment::find()
					->where(["kgiId" => $kgiId, "departmentId" => $employee["departmentId"], "status" => 1])
					->one();
				if (!isset($kgiDepartment) || empty($kgiDepartment)) {
					$kgiDepartment = new KgiDepartment();
					$kgiDepartment->kgiId = $kgiId;
					$kgiDepartment->departmentId = $employee["departmentId"];
					$kgiDepartment->status = 1;
					$kgiDepartment->createDateTime = new Expression('NOW()');
					$kgiDepartment->updateDateTime = new Expression('NOW()');
					$kgiDepartment->save(false);
				}
				$kgiTeam = KgiTeam::find()
					->where(["kgiId" => $kgiId, "teamId" => $employee["teamId"], "status" => 1])
					->one();
				if (!isset($kgiTeam) || empty($kgiTeam)) {
					$kgiTeam = new KgiTeam();
					$kgiTeam->kgiId = $kgiId;
					$kgiTeam->teamId = $employee["teamId"];
					$kgiTeam->createrId = Yii::$app->user->id;
					$kgiTeam->status = 1;
					$kgiTeam->createDateTime = new Expression('NOW()');
					$kgiTeam->updateDateTime = new Expression('NOW()');
					$kgiTeam->save(false);
				}
			}
		} else {
			KgiEmployee::deleteAll(["employeeId" => $employeeId, "kgiId" => $kgiId]);
		}
		$kgiEmployee = KgiEmployee::find()
			->where(["kgiId" => $kgiId, "status" => 1])
			->asArray()
			->all();
		$res["status"] = true;
		$res["totalEmployee"] = count($kgiEmployee);
		return json_encode($res);
	}
	public function actionSearchKgiEmployee()
	{
		$searchText = $_POST["searchText"];
		$kgiId = $_POST["kgiId"];
		$kgiBranch = KgiBranch::find()
			->where(["kgiId" => $kgiId, "status" => 1])
			->asArray()
			->all();
		$teams = Team::find()->where(["status" => 1, "departmentId" => $_POST["departmentId"]])
			->asArray()
			->orderBy('teamId')
			->all();
		$textTeam = '<option value="">Team</option>';
		if (isset($teams) && count($teams) > 0) {
			foreach ($teams as $team) :
				$textTeam .= '<option value="' . $team["teamId"] . '">' . $team["teamName"] . '</option>';
			endforeach;
		}
		$employees = [];
		if (isset($kgiBranch) && count($kgiBranch) > 0) {
			$i = 0;
			foreach ($kgiBranch as $kb) :
				$employee = Employee::find()
					->where(["status" => 1, "branchId" => $kb["branchId"]])
					->andWhere("employeeFirstName LIKE '" . $searchText . "%' or employeeSureName LIKE '" . $searchText . "%'")
					->andFilterWhere([
						"departmentId" => $_POST["departmentId"],
						"teamId" => $_POST["teamId"]
					])
					->orderBy('branchId,titleId')
					->asArray()
					->all();
				if (isset($employee) && count($employee) > 0) {
					$i = 0;
					foreach ($employee as $em) :
						if ($em["picture"] != "") {
							$picture = $em['picture'];
						} else {
							if ($em['gender'] == 1) {
								$picture = 'image/user.png';
							} else {
								$picture = 'image/lady.jpg';
							}
						}
						$employees[$i] = [
							"name" => $em["employeeFirstname"] . ' ' . $em["employeeSurename"],
							"id" => $em["employeeId"],
							"branch" => Branch::branchName($em["branchId"]),
							"department" => Department::departmentNAme($em["departmentId"]),
							"team" => Team::teamName($em["teamId"]),
							"picture" => $picture,
							"title" => Title::titleName($em["titleId"])
						];
						$i++;
					endforeach;
				}
			endforeach;
		}
		//$textSearch = $this->renderAjax('search_employee', [
		$textSearch = $this->renderAjax('branch_employee', [
			"employees" => $employees,
			"kgiId" => $kgiId
		]);
		$res["status"] = true;
		$res["textEmployee"] = $textSearch;
		$res["textTeam"] = $textTeam;
		return json_encode($res);
	}
	public function actionCheckAllKgiEmployee()
	{
		$kgiId = $_POST["kgiId"];
		$kgiBranch = KgiBranch::find()
			->where(["kgiId" => $kgiId, "status" => 1])
			->asArray()
			->all();
		$employees = [];
		if (isset($kgiBranch) && count($kgiBranch) > 0) {
			$i = 0;
			foreach ($kgiBranch as $kb) :
				$employee = Employee::find()
					->where(["branchId" => $kb["branchId"], "status" => 1])
					->asArray()
					->orderBy('branchId,titleId')
					->all();
				if (isset($employee) && count($employee) > 0) {
					foreach ($employee as $em) :
						$employees[$i] = $em["employeeId"];
						$i++;
					endforeach;
				}
			endforeach;
		}
		$res["employeeId"] = $employees;
		return json_encode($res);
	}
	public function actionSearchAssignKgi()
	{

		$month = $_POST['month'];
		$year = $_POST['year'];
		$paramText = 'companyId=&&branchId=&&teamId=&&month=' . $month . '&&status=&&year=' . $year;
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
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
			//return $this->redirect(Yii::$app->homeUrl . 'kgi/kgi-personal/individual-kgi');
		}
		if ($month == '' && $year == '') {
			return $this->redirect(Yii::$app->homeUrl . 'kgi/management/assign-kgi');
		}
		//$paramText .= '&&adminId=' . $adminId . '&&managerId=' . $managerId . '&&supervisorId=' . $supervisorId . '&&staffId=' . $staffId;
		$paramText .= '&&adminId=' . $adminId . '&&gmId=' . $gmId . '&&managerId=' . $managerId . '&&supervisorId=' . $supervisorId . '&&teamLeaderId=' . $teamLeaderId . '&&staffId=' . $staffId;
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-filter?' . $paramText);
		$kgis = curl_exec($api);
		$kgis = json_decode($kgis, true);
		curl_close($api);
		//throw new exception(print_r($paramText, true));
		$kgiText = $this->renderAjax('assign_search', [
			"kgis" => $kgis
		]);
		$res["kgiText"] = $kgiText;
		$res["status"] = true;
		return json_encode($res);
	}
	public function actionKgiKfi($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$kgiId = $param["kgiId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kfi-kgi?kgiId=' . $kgiId);
		$kgiHasKfi = curl_exec($api);
		$kgiHasKfi = json_decode($kgiHasKfi, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiId . '&&kgiHistoryId=0');
		$kgiDetail = curl_exec($api);
		$kgiDetail = json_decode($kgiDetail, true);
		curl_close($api);
		return $this->render('kfi_kgi', [
			"kgiDetail" => $kgiDetail,
			"kgiHasKfi" => $kgiHasKfi
		]);
	}
	public function actionKgiKpi($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$kgiId = $param["kgiId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-has-kpi?kgiId=' . $kgiId);
		$kgiHasKpi = curl_exec($api);
		$kgiHasKpi = json_decode($kgiHasKpi, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiId . '&&kgiHistoryId=0');
		$kgiDetail = curl_exec($api);
		$kgiDetail = json_decode($kgiDetail, true);
		curl_close($api);
		return $this->render('kgi_kpi', [
			"kgiHasKpi" => $kgiHasKpi,
			"kgiId" => $kgiId,
			"kgiDetail" => $kgiDetail
		]);
	}
	public function actionAssignKpi($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$kgiId = $param["kgiId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-branch?id=' . $kgiId);
		$kgiBranch = curl_exec($api);
		$kgiBranch = json_decode($kgiBranch, true);

		curl_close($api);
		$kgiName = Kgi::kgiName($kgiId);
		return $this->render('assign_kpi', [
			"kgiBranch" => $kgiBranch,
			"kgiName" => $kgiName,
			"kgiId" => $kgiId
		]);
	}
	public function actionKpiBranch()
	{
		$branchId = $_POST["branchId"];
		$kgiId = $_POST["kgiId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/branch-kpi?branchId=' . $branchId);
		$kpiBranch = curl_exec($api);
		$kpiBranch = json_decode($kpiBranch, true);
		curl_close($api);
		$kpiText = $this->renderAjax('branch_kpi', [
			"kpiBranch" => $kpiBranch,
			"branchId" => $branchId,
			"kgiId" => $kgiId
		]);
		$res["status"] = true;
		$res["kpiText"] = $kpiText;
		return json_encode($res);
	}
	public function actionWaitApprove()
	{
		$role = UserRole::userRight();
		$teamKgis = [];
		$employeeKgis = [];
		if ($role < 3) {
			return $this->redirect(Yii::$app->homeUrl . 'kgi/kgi-personal/individual-kgi');
		}
		$branchId = User::userBranchId();
		$admin = UserRole::isAdmin();
		if ($admin == 1) {
			$departments = Department::find()
				->where(["status" => 1])
				->asArray()->all();
		} else {
			$departments = Department::find()
				->where(["branchId" => $branchId, "status" => 1])
				->asArray()->all();
		}
		if (isset($departments) && count($departments) > 0) {
			foreach ($departments as $department) :
				$teams = Team::find()
					->where(["departmentId" => $department["departmentId"], "status" => 1])
					->asArray()
					->all();
				if (isset($teams) && count($teams) > 0) {
					foreach ($teams as $team) :
						$kgiTeams = KgiTeam::find()
							->where(["teamId" => $team["teamId"]])
							->andWhere("status!=99")
							->asArray()
							->all();
						if (isset($kgiTeams) && count($kgiTeams) > 0) {
							foreach ($kgiTeams as $kgiTeam) :
								$kgiTeamHistory = KgiTeamHistory::find()
									->where(["kgiTeamId" => $kgiTeam["kgiTeamId"], "status" => 88])
									->orderBy("createDateTime DESC")
									->asArray()
									->one();
								$mainKgi = Kgi::find()
									->select('priority,amountType')
									->where(["kgiId" => $kgiTeam["kgiId"]])
									->asArray()
									->one();
								if (isset($kgiTeamHistory) && !empty($kgiTeamHistory)) {
									$teamKgis[$kgiTeamHistory["kgiTeamHistoryId"]] = [
										"kgiId" => $kgiTeam["kgiId"],
										"kgiTeamId" => $kgiTeam["kgiTeamId"],
										"kgiName" => Kgi::kgiName($kgiTeam["kgiId"]),
										"company" => Branch::companyName($branchId),
										"branch" => Branch::branchName($branchId),
										"department" => Department::departmentNAme($department["departmentId"]),
										"teamId" => $kgiTeam["teamId"],
										"teamName" => Team::teamName($kgiTeam["teamId"]),
										"target" => $kgiTeam["target"],
										"reson" => $kgiTeamHistory["detail"],
										"newTarget" => $kgiTeamHistory["target"],
										"creater" => User::employeeNameByuserId($kgiTeamHistory["createrId"]), // userId
										"isOver" => ModelMaster::isOverDuedate(KgiTeam::nextCheckDate($kgiTeam['kgiTeamId'])),
										"priority" => $mainKgi["priority"],
										"month" => ModelMaster::fullMonthText($kgiTeamHistory["month"]),
										"status" => $kgiTeamHistory["status"],
										"amountType" => $mainKgi["amountType"]
									];
								}
							endforeach;
						}
					endforeach;
				}
			endforeach;
		}
		return $this->render('wait_approve1', [
			"role" => $role,
			"teamKgis" => $teamKgis,
			"employeeKgis" => $employeeKgis,
		]);
	}
	public function actionWaitApproveKgiPersonal()
	{
		$role = UserRole::userRight();
		$employeeKgis = [];
		if ($role < 3) {
			return $this->redirect(Yii::$app->homeUrl . 'kgi/kgi-personal/individual-kgi');
		}
		if ($role == 3) { //Team Leader
			$teamId = User::userTeamId();
			$kgiEmployees = KgiEmployee::find()
				->select('kgi_employee.*,k.priority')
				->JOIN("LEFT JOIN", "employee e", "e.employeeId=kgi_employee.employeeId")
				->JOIN("LEFT JOIN", "kgi k", "k.kgiId=kgi_employee.kgiId")
				->where(["e.teamId" => $teamId, "k.status" => [1, 2]])
				->asArray()
				->orderBy('createDateTime')
				->all();
			if (isset($kgiEmployees) && count($kgiEmployees) > 0) {
				foreach ($kgiEmployees as $kgiEmployee) :
					$kgiEmployeeHistory = KgiEmployeeHistory::find()
						->where(["kgiEmployeeId" => $kgiEmployee["kgiEmployeeId"], "status" => 88])
						->orderBy("createDateTime DESC")
						->asArray()
						->one();
					if (isset($kgiEmployeeHistory) && !empty($kgiEmployeeHistory)) {
						$employeeKgis[$kgiEmployeeHistory["kgiEmployeeHistoryId"]] = [
							"kgiId" => $kgiEmployee["kgiId"],
							"kgiName" => Kgi::kgiName($kgiEmployee["kgiId"]),
							"employeeName" => Employee::employeeName($kgiEmployee["employeeId"]),
							"target" => $kgiEmployee["target"],
							"newTarget" => $kgiEmployeeHistory["target"],
							"reson" => $kgiEmployeeHistory["detail"],
							"priority" => $kgiEmployee["priority"],
							"isOver" => ModelMaster::isOverDuedate(KgiEmployee::nextCheckDate($kgiEmployee['kgiEmployeeId'])),
							"month" => ModelMaster::fullMonthText($kgiEmployeeHistory["month"]),
							"status" => $kgiEmployee["status"],
						];
					}
				endforeach;
			}
		}
		return $this->render('wait_approve_employee', [
			"role" => $role,
			"employeeKgis" => $employeeKgis,
		]);
	}

	public function actionApproveKgiTeam($hash)
	{
		$param = ModelMaster::decodeParams($hash);

		$kgiTeamHistory = KgiTeamHistory::find()
			->where(["kgiTeamHistoryId" => $param["kgiTeamHistoryId"]])
			->asArray()
			->one();
		$kgiTeam = KgiTeam::find()
			->where(["kgiTeamId" => $kgiTeamHistory["kgiTeamId"]])
			->asArray()
			->one();

		$kgiTeamHistories = KgiTeamHistory::find()
			->where(["kgiTeamId" => $kgiTeamHistory["kgiTeamId"]])
			->asArray()
			->orderBy('createDateTime DESC')
			->all();
		$allTeams = KgiTeam::find()
			->select('t.teamName,kgi_team.*')
			->JOIN("LEFT JOIN", "team t", "t.teamId=kgi_team.teamId")
			->where(["kgiId" => $kgiTeam["kgiId"]])
			->asArray()
			->all();
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiTeam["kgiId"] . '&&kgiHistoryId=0');
		$kgiDetail = curl_exec($api);
		$kgiDetail = json_decode($kgiDetail, true);

		curl_close($api);

		return $this->render('kgi_team_history_detail', [
			"kgiDetail" => $kgiDetail,
			"teamName" => Team::teamName($kgiTeam["teamId"]),
			"kgiTeamHistories" => $kgiTeamHistories,
			"allTeams" => $allTeams,
			"kgiTeam" => $kgiTeam
		]);
	}

	public function actionApproveKgiTarget()
	{
		$kgiTeamId = $_POST["kgiTeamId"];
		$approve = $_POST["approve"];
		$history = KgiTeamHistory::find()
			->where(["kgiTeamId" => $kgiTeamId, "status" => 88])
			->orderBy('createDateTime DESC')
			->one();
		if ($approve == 1) {
			$history->status = 3;
			$kgiTeam = KgiTeam::find()->where(["kgiTeamId" => $kgiTeamId])->one();
			$kgiTeam->target = $history["target"];
			$kgiTeam->status = 1;
			$kgiTeam->save(false);
		} else {
			$history->status = 89;
		}
		$history->save(false);
		$res["status"] = true;
		return json_encode($res);
	}
	public function actionApproveKgiEmployee($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$kgiEmployeeHistoryId = $param["kgiEmployeeHistoryId"];
		$teamId = User::userTeamId();
		$kgiEmployeeHistory = KgiEmployeeHistory::find()
			->where(["kgiEmployeeHistoryId" => $kgiEmployeeHistoryId])
			->asArray()
			->one();
		$kgiEmployee = KgiEmployee::find()
			->where(["kgiEmployeeId" => $kgiEmployeeHistory["kgiEmployeeId"]])
			->asArray()
			->one();
		$kgiEmployees = KgiEmployeeHistory::find()
			->where(["kgiEmployeeId" => $kgiEmployee["kgiEmployeeId"]])
			->orderBy('createDateTime DESC')
			->asArray()
			->all();
		$allEmployee = KgiEmployee::find()
			->select('e.employeeFirstname,e.employeeSureName,e.teamId,kgi_employee.*')
			->JOIN("LEFT JOIN", "employee e", "e.employeeId=kgi_employee.employeeId")
			->where(["kgi_employee.kgiId" => $kgiEmployee["kgiId"], "e.teamId" => $teamId])
			->orderBy('e.employeeFirstname')
			->asArray()
			->all();
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiEmployee["kgiId"] . '&&kgiHistoryId=0');
		$kgiDetail = curl_exec($api);
		$kgiDetail = json_decode($kgiDetail, true);
		//throw new exception(print_r($kgiEmployees, true));

		curl_close($api);

		return $this->render('kgi_employee_history_detail', [
			"allEmployee" => $allEmployee,
			"kgiDetail" => $kgiDetail,
			"employeeName" => Employee::employeeName($kgiEmployee["employeeId"]),
			"kgiEmployee" => $kgiEmployee,
			"kgiEmployeeHistory" => $kgiEmployeeHistory,
			"kgiEmployees" => $kgiEmployees
		]);
	}
	public function actionApproveKgiEmployeeTarget()
	{
		$kgiEmployeeHistoryId = $_POST["kgiEmployeeHistoryId"];
		$approve = $_POST["approve"];
		$history = KgiEmployeeHistory::find()
			->where(["kgiEmployeeHistoryId" => $kgiEmployeeHistoryId, "status" => 88])
			->one();
		if ($approve == 1) {
			$kgiEmployee = KgiEmployee::find()->where(["kgiEmployeeId" => $history->kgiEmployeeId])->one();
			//KgiEmployeeHistory::updateAll(["status" => 90], ["status" => [1, 2]]);
			$history->status = 1;
			$kgiEmployee->target = $history["target"];
			$kgiEmployee->status = 1;
			$kgiEmployee->save(false);
		} else {
			$history->status = 89;
		}
		$history->save(false);
		$res["status"] = true;
		return json_encode($res);
	}
	public function actionAssignKpiToKgi()
	{
		$kgiId = $_POST["kgiId"];
		$kpiIds = $_POST["selectedKpi"];
		$unCheck = $_POST["unCheck"];
		if ($kpiIds != '') {
			if (isset($kpiIds) && count($kpiIds) > 0) {
				foreach ($kpiIds as $kpiId) :
					$kgiKpi = KgiHasKpi::find()->where(["kpiId" => $kpiId, "kgiId" => $kgiId, "status" => 1])->one();
					if (!isset($kgiKpi) || empty($kgiKpi)) {
						$kgiKpi = new KgiHasKpi();
						$kgiKpi->kgiId = $kgiId;
						$kgiKpi->kpiId = $kpiId;
						$kgiKpi->status = 1;
						$kgiKpi->createDateTime = new Expression('NOW()');
						$kgiKpi->updateDateTime = new Expression('NOW()');
						$kgiKpi->save(false);
					}
				endforeach;
			}
		}
		if ($unCheck != "") {
			$kgiKpi = KgiHasKpi::find()
				->where(["kgiId" => $kgiId, "status" => 1, "kpiId" => $unCheck])
				->all();
			if (isset($kgiKpi) && count($kgiKpi) > 0) {
				foreach ($kgiKpi as $fg) :
					$fg->delete();
				endforeach;
			}
		}
		$res["status"] = true;
		return json_encode($res);
	}
	public function actionRelatedKfi()
	{
		$kgiId = $_POST["kgiId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kfi-kgi?kgiId=' . $kgiId);
		$kgiHasKfi = curl_exec($api);
		$kgiHasKfi = json_decode($kgiHasKfi, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiId . '&&kgiHistoryId=0');
		$kgiDetail = curl_exec($api);
		$kgiDetail = json_decode($kgiDetail, true);
		curl_close($api);
		$text = $this->renderAjax('kfi_has_kgi', ["kgiHasKfi" => $kgiHasKfi]);
		$res["kfiText"] = $text;
		$res["kgiName"] = $kgiDetail["kgiName"];
		return json_encode($res);
	}
	public function actionRelatedKpi()
	{
		$kgiId = $_POST["kgiId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-has-kpi?kgiId=' . $kgiId);
		$kgiHasKpi = curl_exec($api);
		$kgiHasKpi = json_decode($kgiHasKpi, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiId . '&&kgiHistoryId=0');
		$kgiDetail = curl_exec($api);
		$kgiDetail = json_decode($kgiDetail, true);
		curl_close($api);
		$text = $this->renderAjax('kgi_has_kpi', ["kgiHasKpi" => $kgiHasKpi]);
		$res["kpiText"] = $text;
		$res["kgiName"] = $kgiDetail["kgiName"];
		return json_encode($res);
	}
	public function actionKgiDetail($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$kgiId = $param["kgiId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiId . '&&kgiHistoryId=0');
		$kgi = curl_exec($api);
		$kgi = json_decode($kgi, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-team?id=' . $kgiId);
		$kgiTeams = curl_exec($api);
		$kgiTeams = json_decode($kgiTeams, true);
		$res["teamText"] = $this->renderAjax('kgi_team', ["kgiTeams" => $kgiTeams, "kgiId" => $kgiId]);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-employee?id=' . $kgiId);
		$kgiEmployee = curl_exec($api);
		$kgiEmployee = json_decode($kgiEmployee, true);
		$res["employeeText"] = $this->renderAjax('kgi_member', ["kgiEmloyee" => $kgiEmployee, "kgiId" => $kgiId]);
		//throw new exception($kgiId);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-history?kgiId=' . $kgiId);
		$history = curl_exec($api);
		$history = json_decode($history, true);
		$res["historyText"] = $this->renderAjax('kgi_history', ["history" => $history]);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-issue?kgiId=' . $kgiId);
		$kgiIssue = curl_exec($api);
		$kgiIssue = json_decode($kgiIssue, true);
		$res["issueText"] =  $this->renderAjax('kgi_issue_detail', [
			"kgiIssue" => $kgiIssue,
			"kgiId" => $kgiId,
		]);

		curl_close($api);

		$role = UserRole::userRight();
		return $this->render('kgi_detail', [
			'kgi' => $kgi,
			"kgiId" => $kgiId,
			"role" => $role,
			"kgiTeams" => $kgiTeams,
			"kgiEmloyee" => $kgiEmployee,
			"res" => $res
		]);
	}
	public function setDefault()
	{
		$deletedCompany = Company::find()->where(["status" => 99])->asArray()->all();
		if (isset($deletedCompany) && count($deletedCompany) > 0) {
			foreach ($deletedCompany as $company) :
				Kfi::updateAll(["status" => 99], ["companyId" => $company["companyId"]]);
				Kgi::updateAll(["status" => 99], ["companyId" => $company["companyId"]]);
				Kpi::updateAll(["status" => 99], ["companyId" => $company["companyId"]]);
			endforeach;
		}
	}

	public function actionNextKgiHistory()
	{
		$kgiHistoryId = $_POST["kgiHistoryId"];
		//   throw new Exception($kgiHistoryId);
		$currentHistory = KgiHistory::find()->where(["kgiHistoryId" => $kgiHistoryId])->asArray()->one();

		//   throw new Exception(print_r($currentHistory,true));
		$kgiId = $currentHistory["kgiId"];
		$unit = Unit::find()->where(["unitId" => $currentHistory["unitId"]])->asArray()->one();
		if ($currentHistory["month"] != "" && $currentHistory["year"] != "") {
			$nextTargetMonthYear = ModelMaster::nextTargetMonthYear($unit["unitName"], $currentHistory["month"], $currentHistory["year"]);
			$nextMonth = $nextTargetMonthYear["nextMonth"];
			$nextYear = $nextTargetMonthYear["nextYear"];
		} else {
			$nextMonth = null;
			$nextYear = null;
		}
		$kgiHistory = new KgiHistory();
		$kgiHistory->kgiId = $currentHistory["kgiId"];
		$kgiHistory->createrId = Yii::$app->user->id;
		$kgiHistory->titleProcess = 'New target';
		$kgiHistory->description =  $currentHistory["description"];
		$kgiHistory->nextCheckDate = null;
		$kgiHistory->amountType = $currentHistory["amountType"];
		$kgiHistory->code = $currentHistory["code"];
		$kgiHistory->status = 1;
		$kgiHistory->quantRatio = $currentHistory["quantRatio"];
		$kgiHistory->targetAmount = $currentHistory["targetAmount"];
		$kgiHistory->result = 0;
		$kgiHistory->priority = $currentHistory["priority"];
		$kgiHistory->unitId =  $currentHistory["unitId"];
		$kgiHistory->month = $nextMonth;
		$kgiHistory->year = $nextYear;
		$kgiHistory->createDateTime = new Expression('NOW()');
		$kgiHistory->updateDateTime = new Expression('NOW()');
		if ($kgiHistory->save(false)) {
			$kgi = Kgi::find()->where(["kgiId" => $currentHistory["kgiId"]])->one();
			$kgi->status = 1;
			$kgi->month = $nextMonth;
			$kgi->year = $nextYear;
			$kgi->result = 0.00;
			$kgi->toDate = null;
			$kgi->fromDate = null;
			$kgi->updateDateTime = new Expression('NOW()');
			if ($kgi->save(false)) {

				$oldKgiTeams = KgiTeam::find()->where([
					"kgiId" => $kgiId,
					"month" => $currentHistory["month"],
					"year" => $currentHistory["year"],
				])
					->asArray()
					->all();
				if (isset($oldKgiTeams) && count($oldKgiTeams) > 0) {
					foreach ($oldKgiTeams as $ot) {
						$kgiTeam = KgiTeam::find()->where([
							"kgiId" => $ot["kgiId"],
							"teamId" => $ot["teamId"],
							"month" => $nextMonth,
							"year" => $nextYear,
							"status" => 1
						])
							->one();
						if (!isset($kgiTeam) || empty($kgiTeam)) {
							$team = KgiTeam::find()
								->where([
									"kgiId" => $ot["kgiId"],
									"teamId" => $ot["teamId"],
									"month" => $currentHistory["month"],
									"year" => $currentHistory["year"],
								])
								->andWhere("status!=99")
								->one();
							if (isset($team) && !empty($team)) { //ยังไม่มีเดือนใหม่ หาเดือนปัจจุบัน
								if ($team->status == 1) { // ถ้า สถานะเเป็น ดำเนินการ (ยังไม่ completed)
									//$team->status = 5;
									$status = 5;
								}
								if ($team->status == 2) { //ถ้า สถานะเป็น เสร็จแล้ว (ยังไม่กด next target)
									$team->status = 1;
									$team->month = $nextMonth;
									$team->year = $nextYear;
									$team->fromDate = null;
									$team->toDate = null;
									$team->NextCheckDate = null;
									$team->result = 0.00;
									$status = 1;
								}

								$newHistory = new KgiTeamHistory();
								$newHistory->kgiTeamId = $team->kgiTeamId;
								$newHistory->target = $team->target;
								$newHistory->detail = "auto set from company kgi";
								$newHistory->month = $nextMonth;
								$newHistory->year = $nextYear;
								$newHistory->createrId = Yii::$app->user->id;
								$newHistory->status = $status;
								$newHistory->createDateTime = new Expression('NOW()');
								$newHistory->updateDateTime = new Expression('NOW()');
								if ($newHistory->save(false)) {
									//เพิ่ม employee ทั้งหมดใน  kgiTeamId นี้
									$KgiEmployee = KgiEmployee::find()
										->leftJoin("employee", "employee.employeeId = kgi_employee.employeeId")
										->where(["kgi_employee.kgiId" => $team->kgiId, "employee.teamId" => $team->teamId, "kgi_employee.status" => [1, 2, 4]])
										->all();

									foreach ($KgiEmployee as $empoyee) :
										if ($empoyee->month  == $nextMonth && $empoyee->year  == $nextYear) {
										} else {
											if ($empoyee->status == 1) {
												$status = 5;
											}
											if ($empoyee->status == 2) {
												$status = 1;
												$empoyee->status = 1;
												$empoyee->month = $nextMonth;
												$empoyee->year = $nextYear;
												$empoyee->fromDate = null;
												$empoyee->toDate = null;
												$empoyee->NextCheckDate = null;
												$empoyee->result = 0.00;
											}
											$KgiEmployeeHistory = new KgiEmployeeHistory();
											$KgiEmployeeHistory->kgiEmployeeId = $empoyee->kgiEmployeeId;
											$KgiEmployeeHistory->createrId = Yii::$app->user->id;
											$KgiEmployeeHistory->month = $nextMonth;
											$KgiEmployeeHistory->year = $nextYear;
											$KgiEmployeeHistory->createDateTime = new Expression('NOW()');
											$KgiEmployeeHistory->updateDateTime = new Expression('NOW()');
											$KgiEmployeeHistory->detail = "auto set from company kpi";
											$KgiEmployeeHistory->status = $status;
											$KgiEmployeeHistory->save(false);
											$empoyee->save(false);
										}
									endforeach;
								}
								$team->save(false);
							}
						} else {
							// if ($kgiTeam->status == 5) {
							// 	$kgiTeam->status = 1;
							// 	$kgiTeam->save(false);
							// }
						}
					}
				}
			}
		}
		// return $this->redirect(Yii::$app->homeUrl . 'kgi/management/grid');
		return $this->redirect(Yii::$app->request->referrer);
	}
	public function actionChanngeTeamTargetReason()
	{
		$kgiTeamHistoryId = $_POST["kgiTeamHistoryId"];
		$kgiTeamHistory = KgiTeamHistory::find()
			->where(["kgiTeamHistoryId" => $kgiTeamHistoryId])
			->asArray()
			->one();

		if (isset($kgiTeamHistory) && !empty($kgiTeamHistory)) {
			$res["reason"] = $kgiTeamHistory["detail"];
		} else {
			$res["reason"] = "";
		}
		return json_encode($res);
	}
	public function actionAutoResult()
	{
		$kgiId = $_POST["kgiId"];
		$kgi = Kgi::find()->where(["kgiId" => $kgiId])->asArray()->one();
		$year = $kgi["year"];
		$month = $kgi["month"];
		$kgiTeam = KgiTeam::find()
			->select('kgiTeamId,result')
			->where([
				"kgiId" => $kgiId,
				"status" => [1, 2, 4],
				"month" => $month,
				"year" => $year
			])
			->asArray()
			->all();
		$autoResult = 0;
		if (isset($kgiTeam) && count($kgiTeam) > 0) {
			foreach ($kgiTeam as $kg):
				$autoResult += $kg["result"];
			endforeach;
		}
		$res["result"] = $autoResult;
		return json_encode($res);
	}
	public function actionKgiUpdateHistory()
	{
		$kgiId = $_POST["kgiId"];
		$month = $_POST["month"];
		$year = $_POST["year"];
		$res = [];
		$role = UserRole::userRight();

		$teamId = Team::userTeam(Yii::$app->user->id);
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiId . '&&kgiHistoryId=0');
		$kgi = curl_exec($api);
		$kgi = json_decode($kgi, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-team/kgi-history-team?kgiId=' . $kgiId . '&&month=' . $month . '&&year=' . $year);
		$kgiHistoryTeam = curl_exec($api);
		$kgiHistoryTeam = json_decode($kgiHistoryTeam, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-personal/kgi-history-employee?kgiId=' . $kgiId . '&&month=' . $month . '&&year=' . $year);
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
		$individualText = $this->renderAjax('individual_history', ["kgiHistoryEmployee" => $kgiHistoryEmployee, "role" => $role, "teamId" => $teamId]);
		$res["teamText"] = $teamText;
		$res["individualText"] = $individualText;
		return json_encode($res);
	}
	public function actionCheckKgiTeam()
	{
		$kgiId = $_POST["kgiId"];
		$kgiTeam = KgiTeam::find()->where(["kgiId" => $kgiId, "status" => 1])->asArray()->all();
		$res = [];
		$res["status"] = true;
		if (isset($kgiTeam) && count($kgiTeam) > 0) {
			$res["count"] = count($kgiTeam);
		} else {
			$res["count"] = 0;
		}
		return json_encode($res);
	}
}
