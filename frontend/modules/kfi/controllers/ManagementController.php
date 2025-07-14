<?php

namespace frontend\modules\kfi\controllers;

use common\helpers\Path;
use common\helpers\Session;
use common\models\ModelMaster;
use DateTime;
use Exception;
use frontend\models\hrvc\Branch;
use frontend\models\hrvc\Company;
use frontend\models\hrvc\Department;
use frontend\models\hrvc\Employee;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\Kfi;
use frontend\models\hrvc\KfiBranch;
use frontend\models\hrvc\KfiDepartment;
use frontend\models\hrvc\KfiEmployee;
use frontend\models\hrvc\KfiHasKgi;
use frontend\models\hrvc\KfiHistory;
use frontend\models\hrvc\KfiIssue;
use frontend\models\hrvc\KfiSolution;
use frontend\models\hrvc\Kgi;
use frontend\models\hrvc\KgiHistory;
use frontend\models\hrvc\Kpi;
use frontend\models\hrvc\KpiHistory;
use frontend\models\hrvc\Team;
use frontend\models\hrvc\Title;
use frontend\models\hrvc\Unit;
use frontend\models\hrvc\User;
use frontend\models\hrvc\UserRole;
use Yii;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\UploadedFile;

use function PHPUnit\Framework\throwException;

// header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
// header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
// header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
// header("Cache-Control: post-check=0, pre-check=0", false);
// header("Pragma: no-cache");
/**
 * Default controller for the `kfi` module
 */
class ManagementController extends Controller
{
	/**
	 * Renders the index view for the module
	 * @return string
	 */
	public function beforeAction($action)
	{
		if (!Yii::$app->user->id) {
			return $this->redirect(Yii::$app->homeUrl . 'site/login');
		}
		$this->setDefault();
		return true; //go to origin request
	}
	public function actionIndex()
	{
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		$role = UserRole::userRight();
		$session = Yii::$app->session;
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
		if ($session->has('kfi')) {
			$filter = $session->get('kfi');
			$companyId = isset($filter["companyId"]) && $filter["companyId"] != null ? $filter["companyId"] : null;
			$branchId = isset($filter["branchId"]) && $filter["branchId"] != null ? $filter["branchId"] : null;
			$teamId = isset($filter["teamId"]) && $filter["teamId"] != null ? $filter["teamId"] : null;
			$month = isset($filter["month"]) && $filter["month"] != null ? $filter["month"] : null;
			$status = isset($filter["status"]) && $filter["status"] != null ? $filter["status"] : null;
			$year = isset($filter["year"]) && $filter["year"] != null ? $filter["year"] : null;
			$type = "list";
			return $this->redirect(Yii::$app->homeUrl . 'kfi/management/kfi-search-result/' . ModelMaster::encodeParams([
				"companyId" => $companyId,
				"branchId" => $branchId,
				"teamId" => $teamId,
				"month" => $month,
				"status" => $status,
				"year" => $year,
				"type" => $type
			]));
		}
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$companies = curl_exec($api);
		$companies = json_decode($companies, true);

		//curl_setopt($api, CURLOPT_URL, Path::Api() . 'kfi/management/index?adminId=' . $adminId . '&&managerId=' . $managerId . '&&supervisorId=' . $supervisorId . '&&staffId=' . $staffId);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kfi/management/index?adminId=' . $adminId . '&&gmId=' . $gmId . '&&managerId=' . $managerId . '&&supervisorId=' . $supervisorId . '&&teamLeaderId=' . $teamLeaderId . '&&staffId=' . $staffId);
		$kfis = curl_exec($api);
		$kfis = json_decode($kfis, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/unit/all-unit');
		$units = curl_exec($api);
		$units = json_decode($units, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/all-company');
		$allCompany = curl_exec($api);
		$allCompany = json_decode($allCompany, true);

		$isManager = UserRole::isManager();
		$part = Path::Api() . 'kfi/management/index?adminId=' . $adminId . '&&managerId=' . $managerId . '&&supervisorId=' . $supervisorId . '&&staffId=' . $staffId;
		//throw new Exception($part);
		curl_close($api);
		$employee = Employee::employeeDetailByUserId(Yii::$app->user->id);
		$employeeCompanyId = $employee["companyId"];

		$countAllCompany = 0;
		if (count($allCompany) > 0) {
			$countAllCompany = count($allCompany);
			$companyPic = Company::randomPic($allCompany, 3);
		}
		$totalBranch = Branch::totalBranch();

		$months = ModelMaster::monthFull(1);

		return $this->render('index', [
			"companies" => $companies,
			"units" => $units,
			"months" => $months,
			"kfis" => $kfis,
			"isManager" => $isManager,
			"role" => $role,
			"userId" => Yii::$app->user->id,
			"employeeCompanyId" => $employeeCompanyId,
			"allCompany" => $countAllCompany,
			"companyPic" => $companyPic,
			"totalBranch" => $totalBranch
		]);
	}
	public function actionGrid()
	{
		$groupId = Group::currentGroupId();
		$role = UserRole::userRight();
		$session = Yii::$app->session;
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
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
		if ($session->has('kfi')) {
			$filter = $session->get('kfi');
			$companyId = isset($filter["companyId"]) && $filter["companyId"] != null ? $filter["companyId"] : null;
			$branchId = isset($filter["branchId"]) && $filter["branchId"] != null ? $filter["branchId"] : null;
			$teamId = isset($filter["teamId"]) && $filter["teamId"] != null ? $filter["teamId"] : null;
			$month = isset($filter["month"]) && $filter["month"] != null ? $filter["month"] : null;
			$status = isset($filter["status"]) && $filter["status"] != null ? $filter["status"] : null;
			$year = isset($filter["year"]) && $filter["year"] != null ? $filter["year"] : null;
			$type = "grid";
			return $this->redirect(Yii::$app->homeUrl . 'kfi/management/kfi-search-result/' . ModelMaster::encodeParams([
				"companyId" => $companyId,
				"branchId" => $branchId,
				"teamId" => $teamId,
				"month" => $month,
				"status" => $status,
				"year" => $year,
				"type" => $type
			]));
		}
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$companies = curl_exec($api);
		$companies = json_decode($companies, true);

		//curl_setopt($api, CURLOPT_URL, Path::Api() . 'kfi/management/index?adminId=' . $adminId . '&&managerId=' . $managerId . '&&supervisorId=' . $supervisorId . '&&staffId=' . $staffId);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kfi/management/index?adminId=' . $adminId . '&&gmId=' . $gmId . '&&managerId=' . $managerId . '&&supervisorId=' . $supervisorId . '&&teamLeaderId=' . $teamLeaderId . '&&staffId=' . $staffId);
		$kfis = curl_exec($api);
		$kfis = json_decode($kfis, true);
		// throw new Exception(Path::Api() . 'kfi/management/index?adminId=' . $adminId . '&&gmId=' . $gmId . '&&managerId=' . $managerId . '&&supervisorId=' . $supervisorId . '&&teamLeaderId=' . $teamLeaderId . '&&staffId=' . $staffId);

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

		// $units = ["1" => "Monthly", "2" => "Weekly", "3" => "QuaterLy", "4" => "Daily"];
		$months = ModelMaster::monthFull(1);
		$isManager = UserRole::isManager();
		$employee = Employee::employeeDetailByUserId(Yii::$app->user->id);
		$employeeCompanyId = $employee["companyId"];

		$totalBranch = Branch::totalBranch();
		// throw new Exception(print_r($kfis, true));
		return $this->render('index_grid', [
			"companies" => $companies,
			"units" => $units,
			"months" => $months,
			"kfis" => $kfis,
			"isManager" => $isManager,
			"role" => $role,
			"userId" => Yii::$app->user->id,
			"employeeCompanyId" => $employeeCompanyId,
			"allCompany" => $countAllCompany,
			"companyPic" => $companyPic,
			"totalBranch" => $totalBranch
		]);
	}

	public function actionCreateKfi()
	{
		if (isset($_POST["kfiName"])) {

			// if (Yii::$app->request->isPost) {
			// 	Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

			$data = [
				'kfiName' => $_POST["kfiName"],
				'company' => $_POST["company"],
				'branch' => $_POST["branch"],
				'unit' => $_POST["unit"],
				'amount' => $_POST["amount"],
				'month' => $_POST["month"],
				'year' => $_POST["year"],
				'detail' => $_POST["detail"],
				'amountType' => $_POST["amountType"],
				'code' => $_POST["code"],
				'quantRatio' => $_POST["quantRatio"],
				'nextCheckDate' => $_POST["nextCheckDate"],
				'fromDate' => $_POST["fromDate"],
				'toDate' => $_POST["toDate"],
				'department' => $_POST["department"],
				'status' => $_POST["status"],
				'result' => $_POST["result"],
			];

			//  throw new Exception(print_r($data,true));

			$kfi = new Kfi();
			$kfi->kfiName = $_POST["kfiName"];
			$kfi->companyId = $_POST["company"];
			//$kfi->branchId = $_POST["branch"];
			$kfi->unitId = $_POST["unit"];
			$kfi->targetAmount = $_POST["amount"];
			$kfi->month = $_POST["month"];
			$kfi->year = $_POST["year"];
			$kfi->kfiDetail = $_POST["detail"];
			$kfi->createrId = Yii::$app->user->id;
			$kfi->status =  isset($_POST["status"]) && $_POST["status"] !== '' ? $_POST["status"] : 1;
			$kfi->createDateTime = new Expression('NOW()');
			$kfi->updateDateTime = new Expression('NOW()');

			$isManager = UserRole::isManager();

			if ($kfi->save(false)) {
				$kfiId = Yii::$app->db->lastInsertID;
				$kfiHistory = new KfiHistory();
				$kfiHistory->kfiId = $kfiId;
				$kfiHistory->createrId = Yii::$app->user->id;
				$kfiHistory->nextCheckDate = $_POST["nextCheckDate"];
				$kfiHistory->amountType = $_POST["amountType"] ?? null;
				$kfiHistory->code = $_POST["code"] ?? null;
				$kfiHistory->status = $_POST["status"] ?? 1;
				$kfiHistory->quantRatio = $_POST["quantRatio"] ?? null;
				$kfiHistory->historyStatus = (string) ($_POST["status"] ?? '1');
				if ($isManager == 1) {
					$kfiHistory->target = str_replace(",", "", $_POST["amount"] ?? 0);
				}

				$kfiHistory->result = $_POST["result"] ?? 0;
				$kfiHistory->unitId = $_POST["unit"] ?? null;
				$kfiHistory->month = $_POST["month"] ?? null;
				$kfiHistory->year = $_POST["year"] ?? null;
				$kfiHistory->description = $_POST["detail"] ?? null;
				$kfiHistory->fromDate = $_POST["fromDate"];
				$kfiHistory->toDate = $_POST["toDate"];
				$kfiHistory->createDateTime = new Expression('NOW()');
				$kfiHistory->updateDateTime = new Expression('NOW()');
				if ($kfiHistory->validate()) {
					$kfiHistory->save(false);

					if (isset($_POST["branch"]) && count($_POST["branch"]) > 0) {

						$this->saveKfiBranch($_POST["branch"], $kfiId);
					}
					if (isset($_POST["department"]) && count($_POST["department"]) > 0) {
						$this->saveKfiDepartment($_POST["department"], $kfiId);
					}
				} else {
					$errors = $kfiHistory->getErrors();
					return [
						'message' => false,
						'error' => $errors
					];
				}

				return $this->redirect(Yii::$app->homeUrl . 'kfi/management/grid');

				// 	//return $this->redirect('index');
			} else {
				$errors = $kfi->getErrors();

				return [
					'message' => false,
					'error' => $errors
				];
			}
		} else {
			$role = UserRole::userRight();
			$groupId = Group::currentGroupId();
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
			$data = [];

			$countAllCompany = 0;
			if (count($allCompany) > 0) {
				$countAllCompany = count($allCompany);
				$companyPic = Company::randomPic($allCompany, 3);
			}
			$totalBranch = Branch::totalBranch();

			return $this->render('kfi_from', [
				"role" => $role,
				"companies" => $companies,
				"units" => $units,
				"data" => $data,
				"statusform" =>  "create",
				"allCompany" => $countAllCompany,
				"companyPic" => $companyPic,
				"totalBranch" => $totalBranch
			]);
		}
	}
	public function actionSaveUpdateKfi()
	{
		$data = [
			'kfiName' => $_POST["kfiName"],
			'company' => $_POST["company"],
			'branch' => $_POST["branch"],
			'unit' => $_POST["unit"],
			'amount' => $_POST["amount"],
			'month' => $_POST["month"],
			'year' => $_POST["year"],
			'detail' => $_POST["detail"],
			'amountType' => $_POST["amountType"],
			'code' => $_POST["code"],
			'quantRatio' => $_POST["quantRatio"],
			'nextCheckDate' => $_POST["nextCheckDate"],
			'fromDate' => $_POST["fromDate"],
			'toDate' => $_POST["toDate"],
			'department' => $_POST["department"],
			'status' => $_POST["status"],
			'result' => $_POST["result"],
		];

		// throw new Exception(print_r($data,true));

		$isManager = UserRole::isManager();
		if (isset($_POST["kfiId"])) {
			$kfi = Kfi::find()->where(["kfiId" => $_POST["kfiId"]])->one();
			$kfi->kfiName = $_POST["kfiName"];
			$kfi->unitId = $_POST["unit"];
			$kfi->kfiDetail = $_POST["detail"];
			$kfi->status = $_POST["status"];
			$kfi->month = $_POST["month"];
			$kfi->year = $_POST["year"];
			if ($isManager == 1) {
				$kfi->targetAmount = str_replace(",", "", $_POST["amount"]);
			}
			$kfi->save(false);
			$kfiHistory = new KfiHistory();
			$kfiHistory->kfiId = $_POST["kfiId"];
			$kfiHistory->createrId = Yii::$app->user->id;
			$kfiHistory->fromDate = $_POST["fromDate"];
			$kfiHistory->toDate = $_POST["toDate"];
			$kfiHistory->nextCheckDate = $_POST["nextCheckDate"];
			$kfiHistory->amountType = $_POST["amountType"];
			$kfiHistory->code = $_POST["code"];
			$kfiHistory->status = $_POST["status"];
			$kfiHistory->quantRatio = $_POST["quantRatio"];
			$kfiHistory->historyStatus = $_POST["status"];
			if ($isManager == 1) {
				$kfiHistory->target =  str_replace(",", "", $_POST["amount"]);
			} else {
				$kfiHistory->target = $kfi->targetAmount;
			}
			$kfiHistory->result =  str_replace(",", "", $_POST["result"]);
			$kfiHistory->unitId =  $_POST["unit"];
			$kfiHistory->month = $_POST["month"];
			$kfiHistory->year = $_POST["year"];
			$kfiHistory->description = $_POST["detail"];
			$kfiHistory->createDateTime = new Expression('NOW()');
			$kfiHistory->updateDateTime = new Expression('NOW()');
			$kfiHistory->save(false);
			if (isset($_POST["branch"]) && count($_POST["branch"]) > 0) {
				$this->saveKfiBranch($_POST["branch"], $_POST["kfiId"]);
			}
			if (isset($_POST["department"]) && count($_POST["department"]) > 0) {
				$this->saveKfiDepartment($_POST["department"], $_POST["kfiId"]);
			}

			return $this->redirect(Yii::$app->homeUrl . 'kfi/management/grid');
		}
	}
	public function actionUpdateKfi($hash)
	{
		$param = ModelMaster::decodeParams($hash);

		$kfiId = $param["kfiId"];
		$kfiHistoryId = $param["kfiHistoryId"];

		$role = UserRole::userRight();
		$groupId = Group::currentGroupId();

		$api = curl_init();

		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		// ดึงข้อมูล KFI
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kfi/management/kfi-detail?kfiId=' . $kfiId . "&kfiHistoryId=" . $kfiHistoryId);
		$kfi = curl_exec($api);
		$kfi = json_decode($kfi, true);

		$companyId = $kfi["companyId"];

		// ดึงข้อมูลสาขา
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/company-branch?id=' . $companyId);
		$kfiBranch = curl_exec($api);
		$kfiBranch = json_decode($kfiBranch, true);

		$kfiBranchText = $this->renderAjax('multi_branch_update', [
			"branches" => $kfiBranch,
			"kfiId" => $kfiId
		]);

		$branch["textBranch"] = $kfiBranchText;
		// ดึงข้อมูลแผนก
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kfi/management/kfi-department?id=' . $kfiId);
		$kfiDepartment = curl_exec($api);
		$kfiDepartment = json_decode($kfiDepartment, true);

		$kfiDepartmentText = $this->renderAjax('multi_department_update', [
			"d" => $kfiDepartment,
			"kfiId" => $kfiId
		]);

		$department["textDepartment"] = $kfiDepartmentText;

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/unit/all-unit');
		$units = curl_exec($api);
		$units = json_decode($units, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$companies = curl_exec($api);
		$companies = json_decode($companies, true);

		curl_close($api);

		// รวมข้อมูลทั้งหมด
		$data = array_merge($kfi, $branch, $department);

		// เรนเดอร์หน้า 'create' และส่งข้อมูลไปแสดงผล
		return $this->render('kfi_from', [
			"data" => $data,
			"role" => $role,
			"units" => $units,
			"companies" => $companies,
			"kfiBranchText" => $kfiBranchText,
			"kfiDepartmentText" => $kfiDepartmentText,
			"kfiId" => $kfiId,
			"statusform" =>  "update"
		]);
	}

	public function actionBranchMultiDepartment()
	{
		$res["status"] = false;
		$acType = $_POST["acType"];
		if (isset($_POST["multiBranch"]) && count($_POST["multiBranch"]) > 0) {
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
				$kfiId = $_POST["kfiId"];
				$textDepartment = $this->renderAjax('multi_department_update', [
					"d" => $d,
					"kfiId" => $kfiId
				]);
			}
			$res["status"] = true;
			$res["textDepartment"] = $textDepartment;
		}
		return json_encode($res);
	}
	public function saveKfiBranch($branch, $kfiId)
	{
		$kfiBranch = KfiBranch::find()->where(["kfiId" => $kfiId, "status" => 1])->all();
		if (isset($kfiBranch) && count($kfiBranch) > 0) {
			foreach ($kfiBranch as $kb) :
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
				$old = kfiBranch::find()->where(["kfiId" => $kfiId, "branchId" => $b, "status" => 1])->one();
				if (!isset($old) || empty($old)) {
					$kfiBranch = new KfiBranch();
					$kfiBranch->kfiId = $kfiId;
					$kfiBranch->branchId = $b;
					$kfiBranch->status = 1;
					$kfiBranch->createDateTime = new Expression('NOW()');
					$kfiBranch->updateDateTime = new Expression('NOW()');
					$kfiBranch->save(false);
				}
			endforeach;
		}
	}
	public function saveKfiDepartment($department, $kfiId)
	{
		$kfiDepartment = KfiDepartment::find()->where(["kfiId" => $kfiId, "status" => 1])->all();
		if (isset($kfiDepartment) && count($kfiDepartment) > 0) {
			foreach ($kfiDepartment as $kd) :
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
				$old = KfiDepartment::find()->where(["kfiId" => $kfiId, "departmentId" => $d, "status" => 1])->one();
				if (!isset($old) || empty($old)) {
					$kfiDepartment = new KfiDepartment();
					$kfiDepartment->kfiId = $kfiId;
					$kfiDepartment->departmentId = $d;
					$kfiDepartment->status = 1;
					$kfiDepartment->createDateTime = new Expression('NOW()');
					$kfiDepartment->updateDateTime = new Expression('NOW()');
					$kfiDepartment->save(false);
				}
			endforeach;
		}
	}
	public function actionHistory()
	{
		$kfiId = $_POST["kfiId"];
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);


		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kfi/management/kfi-detail?kfiId=' . $kfiId . "&&kfiHistoryId=0");
		$kfi = curl_exec($api);
		$kfi = json_decode($kfi, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kfi/management/kfi-history?kfiId=' . $kfiId);
		$history = curl_exec($api);
		$history = json_decode($history, true);
		curl_close($api);
		//throw new exception(print_r($history, true));

		$historyText = $this->renderAjax('history', [
			"history" => $history
		]);
		//throw new exception(print_r($kfi, true));
		$res["kfi"] = $kfi;
		$res["history"] = $historyText;
		$res["status"] = true;
		return json_encode($res);
	}
	public function actionDeleteKfi()
	{
		$kfiId = $_POST["kfiId"];
		KfiHistory::updateAll(["status" => 99], ["kfiId" => $kfiId]);
		Kfi::updateAll(["status" => 99], ["kfiId" => $kfiId]);
		$res["status"] = true;
		return json_encode($res);
	}
	public function actionCompanyBranch()
	{
		$companyId = $_POST["companyId"];
		$text = "<option value=''>Select Branch</option>";
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/company-branch?id=' . $companyId);
		$branch = curl_exec($api);
		$branch = json_decode($branch, true);
		curl_close($api);
		$res["status"] = false;
		if (isset($branch) && count($branch) > 0) {
			$res["status"] = true;
			$text .= "<option value='all'> All </option>";
			foreach ($branch as $b) :
				$text .= "<option value='" . $b['branchId'] . "'>" . $b['branchName'] . "</option>";
			endforeach;
		}
		$res["branchText"] = $text;
		return json_encode($res);
	}
	public function actionBranchDepartment()
	{
		$branchId = $_POST["branchId"];
		$text = "<option value=''>Select Department</option>";
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/branch-department?id=' . $branchId);
		$departments = curl_exec($api);
		$departments = json_decode($departments, true);
		curl_close($api);
		$res["status"] = false;
		if (isset($departments) && count($departments) > 0) {
			$res["status"] = true;
			$text .= "<option value='all'> All </option>";
			foreach ($departments as $d) :
				$text .= "<option value='" . $d['departmentId'] . "'>" . $d['departmentName'] . "</option>";
			endforeach;
		}
		$res["departmentText"] = $text;
		return json_encode($res);
	}
	public function actionShowComment()
	{
		$userId = Yii::$app->user->id;
		$employeeId = User::employeeIdFromUserId($userId);
		$kfiId = $_POST["kfiId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kfi/management/kfi-detail?kfiId=' . $kfiId . "&&kfiHistoryId=0");
		$kfi = curl_exec($api);
		$kfi = json_decode($kfi, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kfi/management/kfi-issue?kfiId=' . $kfiId);
		$kfiIssue = curl_exec($api);
		$kfiIssue = json_decode($kfiIssue, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/employee/employee-detail?id=' . $employeeId);
		$profile = curl_exec($api);
		$profile = json_decode($profile, true);

		curl_close($api);
		$res["status"] = true;
		$res["issueText"] = $this->renderAjax('kfi_issue', [
			"kfiIssue" => $kfiIssue,
			"kfiId" => $kfiId,
			"profile" => $profile,
			"employeeId" => $employeeId,
			"kfiName" => $kfi["kfiName"]
		]);
		$res["historyText"] =  $this->renderAjax('kfi_history', [
			"kfiIssue" => $kfiIssue,
			"kfiId" => $kfiId,
			"profile" => $profile,
			"employeeId" => $employeeId,
			"kfiName" => $kfi["kfiName"]
		]);
		$res["kfi"] = $kfi;

		return json_encode($res);
	}
	public function actionCreateNewIssue()
	{
		if (isset($_POST["newIssue"]) && trim($_POST["newIssue"]) != "") {
			$kfiIssue = new KfiIssue();

			$kfiIssue->issue = $_POST["newIssue"];
			$kfiIssue->kfiId = $_POST["kfiId"];
			$kfiIssue->employeeId = $_POST["employeeId"];
			$kfiIssue->status = 1;
			$kfiIssue->createDateTime = new Expression('NOW()');
			$kfiIssue->updateDateTime = new Expression('NOW()');
			$fileObj = UploadedFile::getInstanceByName("attachKfiFile");
			if (isset($fileObj) && !empty($fileObj)) {
				//throw new Exception("asdfad");
				$path = Path::getHost() . 'file/kfi/';
				if (!file_exists($path)) {
					mkdir($path, 0777, true);
				}
				$file = $fileObj->name;
				$filenameArray = explode('.', $file);
				$countArrayFile = count($filenameArray);
				$fileName = Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[$countArrayFile - 1];
				$pathSave = $path . $fileName;
				$fileObj->saveAs($pathSave);
				$kfiIssue->file = 'file/kfi/' . $fileName;
			}
			//throw new Exception(print_r(Yii::$app->request->post(), true));
			if ($kfiIssue->save(false)) {
				return $this->redirect('index');
			}
		}
	}
	public function actionSaveKfiAnswer()
	{
		$solution = $_POST["answer"];
		$kfiIssueId = $_POST["kfiIssueId"];
		$employeeId = User::employeeIdFromUserId(Yii::$app->user->id);
		$answer = new KfiSolution();
		$res["status"] = false;
		$file = '';
		$fileName = '';
		if (isset($_FILES['file']['name'])) {
			$fileObj = UploadedFile::getInstanceByName("file");
			$filename = $_FILES['file']['name'];
			$path = Path::getHost() . 'file/kfi/';
			if (!file_exists($path)) {
				mkdir($path, 0777, true);
			}
			$filenameArray = explode('.', $filename);
			$fileName = Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[1];
			$pathSave = $path . $fileName;
			$fileObj->saveAs($pathSave);
			$answer->file = 'file/kfi/' . $fileName;
			$file = 'file/kfi/' . $fileName;
		}

		$answer->kfiIssueId = $kfiIssueId;
		$answer->solution = $solution;
		$answer->parentId = null;
		$answer->employeeId = $employeeId;
		$answer->status = 1;
		$answer->createDateTime = new Expression('NOW()');
		$answer->updateDateTime = new Expression('NOW()');
		$createDateTime = date('Y-m-d');
		if ($answer->save(false)) {
			$res["commentText"] = $this->renderAjax('comment', [
				"name" => User::userHeaderName(),
				"image" => User::userHeaderImage(),
				"answer" => $solution,
				"createDateTime" => ModelMaster::engDate($createDateTime, 2),
				"kfiIssueId" => $kfiIssueId,
				"file" => $file,
				"fileName" => $fileName
			]);
			$res["status"] = true;
		}
		return json_encode($res);
	}
	public function actionSearchKfi()
	{
		$companyId = isset($_POST["companyId"]) && $_POST["companyId"] != null ? $_POST["companyId"] : null;
		$branchId = isset($_POST["branchId"]) && $_POST["branchId"] != null ? $_POST["branchId"] : null;
		// $teamId = isset($_POST["teamId"]) && $_POST["teamId"] != null ? $_POST["teamId"] : null;
		$month = isset($_POST["month"]) && $_POST["month"] != null ? $_POST["month"] : null;
		$status = isset($_POST["status"]) && $_POST["status"] != null ? $_POST["status"] : null;
		$year = isset($_POST["year"]) && $_POST["year"] != null ? $_POST["year"] : null;
		$type = $_POST["type"];
		return $this->redirect(Yii::$app->homeUrl . 'kfi/management/kfi-search-result/' . ModelMaster::encodeParams([
			"companyId" => $companyId,
			"branchId" => $branchId,
			// "teamId" => $teamId,
			"month" => $month,
			"status" => $status,
			"year" => $year,
			"type" => $type
		]));
	}
	public function actionKfiSearchResult($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$companyId = $param["companyId"];
		$branchId = $param["branchId"];
		// $teamId = $param["teamId"];
		$month = $param["month"];
		$status = $param["status"];
		$year = $param["year"];
		$type = $param["type"];
		$branches = [];
		$teams = [];
		Session::PimFilter($companyId, $branchId, $month, $year, $status, $type);
		if ($companyId == "" && $branchId == "" && $month == "" && $status == "" && $year == "") {
			if ($type == "list") {
				return $this->redirect(Yii::$app->homeUrl . 'kfi/management/index');
			} else {
				return $this->redirect(Yii::$app->homeUrl . 'kfi/management/grid');
			}
		}
		$paramText = 'companyId=' . $companyId . '&&branchId=' . $branchId . '&&month=' . $month . '&&status=' . $status . '&&year=' . $year . '&&active=';

		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		//throw new exception($paramText);
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
		$paramText .= '&&adminId=' . $adminId . '&&gmId=' . $gmId . '&&managerId=' . $managerId . '&&supervisorId=' . $supervisorId . '&&teamLeaderId=' . $teamLeaderId . '&&staffId=' . $staffId;
		//throw new Exception($paramText);
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kfi/management/kfi-filter?' . $paramText);
		$kfis = curl_exec($api);
		$kfis = json_decode($kfis, true);
		//throw new exception($paramText);

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
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/all-company');
		$allCompany = curl_exec($api);
		$allCompany = json_decode($allCompany, true);

		curl_close($api);
		$months = ModelMaster::monthFull(1);
		if ($type == "list") {
			$file = "index";
		} else {
			$file = "index_grid";
		}
		$isManager = UserRole::isManager();
		$employee = Employee::employeeDetailByUserId(Yii::$app->user->id);
		$employeeCompanyId = $employee["companyId"];

		$countAllCompany = 0;
		if (count($allCompany) > 0) {
			$countAllCompany = count($allCompany);
			$companyPic = Company::randomPic($allCompany, 3);
		}

		$totalBranch = Branch::totalBranch();
		return $this->render($file, [
			"units" => $units,
			"companies" => $companies,
			"months" => $months,
			"kfis" => $kfis,
			"companyId" => $companyId,
			"branchId" => $branchId,
			"month" => $month,
			"status" => $status,
			"year" => $year,
			"branches" => $branches,
			"isManager" => $isManager,
			"role" => $role,
			"allCompany" => $countAllCompany,
			"companyPic" => $companyPic,
			"totalBranch" => $totalBranch,
			"employeeCompanyId" => $employeeCompanyId
		]);
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
			$kfiId = $_POST["kfiId"];
			$branchText = $this->renderAjax('multi_branch_update', [
				"branches" => $branches,
				"kfiId" => $kfiId
			]);
		}
		curl_close($api);
		$res["status"] = true;
		$res["branchText"] = $branchText;
		return json_encode($res);
	}
	public function actionCopyKfi($kfiId)
	{
		$role = UserRole::userRight();
		if ($role < 3) {
			return $this->redirect(Yii::$app->homeUrl . 'kfi/management/index');
		}
		$kfi = Kfi::find()->where(["kfiId" => $kfiId])->asArray()->one();
		$copy = new Kfi();
		$copy->kfiName = $kfi["kfiName"] . ' (copy)';
		$copy->companyId = $kfi["companyId"];
		$copy->unitId = $kfi["unitId"];
		$copy->targetAmount = $kfi["targetAmount"];
		$copy->month = $kfi["month"];
		$copy->year = $kfi["year"];
		$copy->kfiDetail = $kfi["kfiDetail"];
		$copy->createrId = Yii::$app->user->id;
		$copy->status = 1;
		$copy->createDateTime = new Expression('NOW()');
		$copy->updateDateTime = new Expression('NOW()');
		if ($copy->save(false)) {
			$kfiCoypId = Yii::$app->db->lastInsertID;
			$branch = [];
			$branches = KfiBranch::find()
				->select('branchId')
				->where(["kfiId" => $kfiId])
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
				$this->saveKfiBranch($branch, $kfiCoypId);
			}
			$department = [];
			$departments = KfiDepartment::find()
				->select('departmentId')
				->where(["kfiId" => $kfiId])
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
				$this->saveKfiDepartment($department, $kfiCoypId);
			}
			return $this->redirect('index');
		}
	}
	public function actionAssignKfi()
	{
		$role = UserRole::userRight();
		if ($role < 3) {
			return $this->redirect(Yii::$app->homeUrl . 'kfi/management/index');
		}
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
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

		//curl_setopt($api, CURLOPT_URL, Path::Api() . 'kfi/management/index?adminId=' . $adminId . '&&managerId=' . $managerId . '&&supervisorId=' . $supervisorId . '&&staffId=' . $staffId);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kfi/management/index?adminId=' . $adminId . '&&gmId=' . $gmId . '&&managerId=' . $managerId . '&&supervisorId=' . $supervisorId . '&&teamLeaderId=' . $teamLeaderId . '&&staffId=' . $staffId);
		$kfis = curl_exec($api);
		$kfis = json_decode($kfis, true);

		$isManager = UserRole::isManager();
		curl_close($api);
		$months = ModelMaster::monthFull(1);
		return $this->render('assign', [
			"months" => $months,
			"kfis" => $kfis,
			"isManager" => $isManager

		]);
	}
	public function actionKfiBranch()
	{
		$companyId = $_POST["companyId"];
		$kfiId = $_POST["kfiId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/company-branch?id=' . $companyId);
		$branches = curl_exec($api);
		$branches = json_decode($branches, true);
		$textBranch = "";
		$textBranch .= $this->renderAjax('company_branch', ["branches" => $branches, "kfiId" => $kfiId]);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kfi/management/kfi-detail?kfiId=' . $kfiId . "&&kfiHistoryId=0");
		$kfi = curl_exec($api);
		$kfi = json_decode($kfi, true);

		curl_close($api);
		$res["kfiName"] = $kfi["kfiName"];
		$res["companyName"] = $kfi["companyName"];
		$res["textBranch"] = $textBranch;
		if ($textBranch != "") {
			$res["status"] = true;
		} else {
			$res["status"] = false;
		}
		return json_encode($res);
	}
	public function actionKfiAssignBranch()
	{
		$kfiId = $_POST["kfiId"];
		$branchId = $_POST["branchId"];
		$checked = $_POST["checked"];
		if ($checked == 1) {
			$kfiBranch = KfiBranch::find()
				->where(["kfiId" => $kfiId, "branchId" => $branchId])
				->one();
			if (isset($kfiBranch) && !empty($kfiBranch)) {
				$kfiBranch->status = 1;
			} else {
				$kfiBranch = new KfiBranch();
				$kfiBranch->branchId = $branchId;
				$kfiBranch->kfiId = $kfiId;
				$kfiBranch->status = 1;
				$kfiBranch->createDateTime = new Expression('NOW()');
				$kfiBranch->updateDateTime = new Expression('NOW()');
			}
			$kfiBranch->save(false);
		} else {
			KfiBranch::updateAll(["status" => 99], ["branchId" => $branchId, "kfiId" => $kfiId]);
		}
		$kfiBranch = KfiBranch::find()
			->where(["kfiId" => $kfiId, "status" => 1])
			->asArray()
			->all();
		$res["status"] = true;
		$res["totalBranch"] = count($kfiBranch);
		return json_encode($res);
	}
	public function actionKfiEmployee()
	{
		$kfiId = $_POST["kfiId"];
		$kfiBranch = KfiBranch::find()
			->where(["kfiId" => $kfiId, "status" => 1])
			->asArray()
			->all();
		$employees = [];
		$departmentText = '<option value="">Department</option>';
		if (isset($kfiBranch) && count($kfiBranch) > 0) {
			$i = 0;
			foreach ($kfiBranch as $kb) :
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

		$textEmployee = $this->renderAjax('branch_employee', ["employees" => $employees, "kfiId" => $kfiId]);
		$res["status"] = true;
		$res["textEmployee"] = $textEmployee;
		$res["departmentText"] = $departmentText;
		return json_encode($res);
	}
	public function actionCheckAllKfiEmployee()
	{
		$kfiId = $_POST["kfiId"];
		$kfiBranch = KfiBranch::find()
			->where(["kfiId" => $kfiId, "status" => 1])
			->asArray()
			->all();
		$employees = [];
		if (isset($kfiBranch) && count($kfiBranch) > 0) {
			$i = 0;
			foreach ($kfiBranch as $kb) :
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
	public function actionKfiAssignEmployee()
	{
		$kfiId = $_POST["kfiId"];
		$employeeId = $_POST["employeeId"];
		$checked = $_POST["checked"];
		if ($checked == 1) {
			$kfiEmployee = KfiEmployee::find()
				->where(["kfiId" => $kfiId, "employeeId" => $employeeId])
				->one();
			if (isset($kfiBranch) && !empty($kfiBranch)) {
				$kfiEmployee->status = 1;
			} else {
				$kfiEmployee = new KfiEmployee();
				$kfiEmployee->employeeId = $employeeId;
				$kfiEmployee->kfiId = $kfiId;
				$kfiEmployee->status = 1;
				$kfiEmployee->createDateTime = new Expression('NOW()');
				$kfiEmployee->updateDateTime = new Expression('NOW()');
			}
			$kfiEmployee->save(false);
		} else {
			KfiEmployee::updateAll(["status" => 99], ["employeeId" => $employeeId, "kfiId" => $kfiId]);
		}
		$kfiEmployee = KfiEmployee::find()
			->where(["kfiId" => $kfiId, "status" => 1])
			->asArray()
			->all();
		$res["status"] = true;
		$res["totalEmployee"] = count($kfiEmployee);
		return json_encode($res);
	}
	public function actionSearchKfiEmployee()
	{
		$searchText = $_POST["searchText"];
		$kfiId = $_POST["kfiId"];
		$kfiBranch = KfiBranch::find()
			->where(["kfiId" => $kfiId, "status" => 1])
			->asArray()
			->all();
		$employees = [];
		if (isset($kfiBranch) && count($kfiBranch) > 0) {
			$i = 0;
			foreach ($kfiBranch as $kb) :
				$employee = Employee::find()
					->where(["status" => 1, "branchId" => $kb["branchId"]])
					->andWhere("employeeFirstName LIKE '" . $searchText . "%' or employeeSureName LIKE '" . $searchText . "%'")
					->andFilterWhere([
						"departmentId" => $_POST["departmentId"]
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
		$textSearch = $this->renderAjax('search_employee', [
			"employees" => $employees,
			"kfiId" => $kfiId
		]);
		$res["status"] = true;
		$res["textEmployee"] = $textSearch;
		return json_encode($res);
	}
	public function actionChangeKfiStatus()
	{
		$status = $_POST["status"];
		$kfiId = $_POST["kfiId"];
		$kfi = Kfi::find()->where(["kfiId" => $kfiId])->one();
		$kfi->active = $status;
		if ($kfi->save(false)) {
			$res["status"] = true;
			if ($status == 1) {
				$res["newButton"] = '<a href="javascript:changeKfiStatus(0,' . $kfiId . ')" class="btn btn-primary btn-sm font-size-12">Active</a>';
			} else {
				$res["newButton"] = '<a href="javascript:changeKfiStatus(1,' . $kfiId . ')" class="btn btn-danger btn-sm font-size-12">In Active</a>';
			}
		} else {
			$res["status"] = false;
		}
		return json_encode($res);
	}
	public function actionSearchAssignKfi()
	{
		$month = $_POST['month'];
		$active = $_POST['active'];
		$paramText = 'companyId=&&branchId=&&month=' . $month . '&&status=&&year=&&active=' . $active;
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		//throw new exception($paramText);
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kfi/management/kfi-filter?' . $paramText);
		$kfis = curl_exec($api);
		$kfis = json_decode($kfis, true);
		curl_close($api);
		//throw new exception(print_r($kfis, true));
		$kfiText = $this->renderAjax('assign_search', [
			"kfis" => $kfis
		]);
		$res["kfiText"] = $kfiText;
		$res["status"] = true;
		return json_encode($res);
	}
	public function actionKfiKgi($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$kfiId = $param["kfiId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kfi/management/kfi-has-kgi?kfiId=' . $kfiId);
		$kfiHasKgi = curl_exec($api);
		$kfiHasKgi = json_decode($kfiHasKgi, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kfi/management/kfi-detail?kfiId=' . $kfiId . "&&kfiHistoryId=0");
		$kfiDetail = curl_exec($api);
		$kfiDetail = json_decode($kfiDetail, true);
		curl_close($api);
		return $this->render('kfi_kgi', [
			"kfiHasKgi" => $kfiHasKgi,
			"kfiId" => $kfiId,
			"kfiDetail" => $kfiDetail
		]);
	}
	public function actionAssignKgi($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$kfiId = $param["kfiId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kfi/management/kfi-branch?kfiId=' . $kfiId);
		$kfiBranch = curl_exec($api);
		$kfiBranch = json_decode($kfiBranch, true);

		curl_close($api);
		$kfiName = Kfi::kfiName($kfiId);
		return $this->render('assign_kgi', [
			"kfiBranch" => $kfiBranch,
			"kfiName" => $kfiName,
			"kfiId" => $kfiId
		]);
	}
	public function actionKgiBranch()
	{
		$branchId = $_POST["branchId"];
		$kfiId = $_POST["kfiId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/branch-kgi?branchId=' . $branchId);
		$kgiBranch = curl_exec($api);
		$kgiBranch = json_decode($kgiBranch, true);
		curl_close($api);
		$kgiText = $this->renderAjax('branch_kgi', [
			"kgiBranch" => $kgiBranch,
			"branchId" => $branchId,
			"kfiId" => $kfiId
		]);
		$res["status"] = true;
		$res["kgiText"] = $kgiText;
		return json_encode($res);
	}
	public function actionAssignKgiToKfi()
	{
		$kfiId = $_POST["kfiId"];
		$kgiIds = $_POST["selectedKgi"];
		$unCheck = $_POST["unCheck"];
		if ($kgiIds != '') {
			if (isset($kgiIds) && count($kgiIds) > 0) {
				foreach ($kgiIds as $kgiId) :
					$kfiKgi = KfiHasKgi::find()->where(["kfiId" => $kfiId, "kgiId" => $kgiId, "status" => 1])->one();
					if (!isset($kfiKgi) || empty($kfiKgi)) {
						$kfiKgi = new KfiHasKgi();
						$kfiKgi->kfiId = $kfiId;
						$kfiKgi->kgiId = $kgiId;
						$kfiKgi->status = 1;
						$kfiKgi->createDateTime = new Expression('NOW()');
						$kfiKgi->updateDateTime = new Expression('NOW()');
						$kfiKgi->save(false);
					}
				endforeach;
			}
		}
		if ($unCheck != "") {
			$kfiKgi = KfiHasKgi::find()
				->where(["kfiId" => $kfiId, "status" => 1, "kgiId" => $unCheck])
				->all();
			if (isset($kfiKgi) && count($kfiKgi) > 0) {
				foreach ($kfiKgi as $fg) :
					$fg->delete();
				endforeach;
			}
		}
		$res["status"] = true;
		return json_encode($res);
	}
	public function actionRelatedKgi()
	{
		$kfiId = $_POST["kfiId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kfi/management/kfi-has-kgi?kfiId=' . $kfiId);
		$kfiHasKgi = curl_exec($api);
		$kfiHasKgi = json_decode($kfiHasKgi, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kfi/management/kfi-detail?kfiId=' . $kfiId . "&&kfiHistoryId=0");
		$kfiDetail = curl_exec($api);
		$kfiDetail = json_decode($kfiDetail, true);
		curl_close($api);
		$text = $this->renderAjax('kfi_has_kgi', [
			"kfiHasKgi" => $kfiHasKgi
		]);
		$res["kgiText"] = $text;
		$res["kfiName"] = $kfiDetail["kfiName"];
		return json_encode($res);
	}
	public function actionKfiDetail($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$kfiId = $param["kfiId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kfi/management/kfi-detail?kfiId=' . $kfiId . "&&kfiHistoryId=0");
		$kfi = curl_exec($api);
		$kfi = json_decode($kfi, true);



		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kfi/management/kfi-history?kfiId=' . $kfiId);
		$history = curl_exec($api);
		$history = json_decode($history, true);
		$res["historyText"] = $this->renderAjax('history', ["history" => $history]);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kfi/management/kfi-issue?kfiId=' . $kfiId);
		$kfiIssue = curl_exec($api);
		$kfiIssue = json_decode($kfiIssue, true);
		$res["issueText"] =  $this->renderAjax('kfi_issue_detail', [
			"kfiIssue" => $kfiIssue,
			"kfiId" => $kfiId,
		]);

		curl_close($api);

		$role = UserRole::userRight();
		return $this->render('kfi_detail', [
			'kfi' => $kfi,
			"kfiId" => $kfiId,
			"role" => $role,
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
	public function actionSetDefaultCreater()
	{
		Kfi::updateAll(["createrId" => 7]);
		Kgi::updateAll(["createrId" => 7]);
		Kpi::updateAll(["createrId" => 7]);
		KfiHistory::updateAll(["createrId" => 7]);
		KgiHistory::updateAll(["createrId" => 7]);
		KpiHistory::updateAll(["createrId" => 7]);
	}
	public function actionKfiDefaultEmployee()
	{
		$kfi = Kfi::find()->where(["status" => [1, 2]])->asArray()->all();
		if (isset($kfi) && count($kfi) > 0) {
			foreach ($kfi as $k) :
				$kfiDeartment = KfiDepartment::find()
					->where(["kfiId" => $k["kfiId"], "status" => 1])
					->asArray()
					->all();
				if (isset($kfiDeartment) && count($kfiDeartment) > 0) {
					foreach ($kfiDeartment as $kd) :
						$employee = Employee::find()
							->where(["departmentId" => $kd["departmentId"], "status" => 1])
							->asArray()
							->all();
						if (isset($employee) && count($employee) > 0) {
							foreach ($employee as $em) :
								$kfiEmployee = new KfiEmployee();
								$kfiEmployee->employeeId = $em["employeeId"];
								$kfiEmployee->kfiId = $k["kfiId"];
								$kfiEmployee->status = 1;
								$kfiEmployee->createDateTime = new Expression('NOW()');
								$kfiEmployee->updateDateTime = new Expression('NOW()');
								$kfiEmployee->save(false);
							endforeach;
						}
					endforeach;
				}
			endforeach;
		}
	}
	public function actionUpdateTeamKfi()
	{
		$employeeIds = [];
		if (isset($_POST["employee"]) && count($_POST["employee"]) > 0) {
			$month = $_POST["month"];
			$year = $_POST["year"];
			$i = 0;

			foreach ($_POST["employee"] as $employeeId => $type):
				$employeeDetail = Employee::find()
					->select('branchId,departmentId')
					->where(["employeeId" => $employeeId])
					->asArray()
					->one();
				$kfiBranch = KfiBranch::find()->where([
					"kfiId" => $_POST["kfiId"],
					"branchId" => $employeeDetail["branchId"]
				])
					->andWhere("status!=99")
					->one();
				if (!isset($kfiBranch) || empty($kfiBranch)) {
					$newKfiBranch = new KfiBranch();
					$newKfiBranch->branchId =  $employeeDetail["branchId"];
					$newKfiBranch->kfiId = $_POST["kfiId"];
					$newKfiBranch->status = 1;
					$newKfiBranch->createDateTime = new Expression('NOW()');
					$newKfiBranch->updateDateTime = new Expression('NOW()');
					$newKfiBranch->save(false);
				}
				$kfiDepartment = KfiDepartment::find()->where([
					"kfiId" => $_POST["kfiId"],
					"departmentId" => $employeeDetail["departmentId"]
				])
					->andWhere("status!=99")
					->one();
				if (!isset($kfiDepartment) || empty($kfiDepartment)) {
					$newKfiDepartment = new KfiDepartment();
					$newKfiDepartment->departmentId =  $employeeDetail["departmentId"];
					$newKfiDepartment->kfiId = $_POST["kfiId"];
					$newKfiDepartment->status = 1;
					$newKfiDepartment->createDateTime = new Expression('NOW()');
					$newKfiDepartment->updateDateTime = new Expression('NOW()');
					$newKfiDepartment->save(false);
				}
				$kfiEmployee = KfiEmployee::find()
					->where([
						"kfiId" => $_POST["kfiId"],
						"employeeId" => $employeeId,
						"month" => $month,
						"year" => $year
					])
					->andWhere("status!=99")
					->one();
				if (!isset($kfiEmployee) || empty($kfiEmployee)) {
					$kfiEmployee = new KfiEmployee();
					$kfiEmployee->kfiId = $_POST["kfiId"];
					$kfiEmployee->employeeId = $employeeId;
					$kfiEmployee->month = $month;
					$kfiEmployee->year = $year;
					$kfiEmployee->status = 1;
					$kfiEmployee->createDateTime = new Expression('NOW()');
					$kfiEmployee->updateDateTime = new Expression('NOW()');
					$kfiEmployee->save(false);
				}
				$employeeIds[$i] = $employeeId;
				$i++;
			endforeach;
		}
		if (!isset($_POST["employee"]) || count($_POST["employee"]) == 0) {
			$dKfiemployee = KfiEmployee::find()
				->where([
					"kfiId" => $_POST["kfiId"],
					"month" => $month,
					"year" => $year
				])
				->all();
			if (isset($dKfiemployee) && count($dKfiemployee) > 0) {
				foreach ($dKfiemployee as $delKfi):
					$delKfi->status = 99;
					$delKfi->save(false);
				endforeach;
			}
		}
		if (count($employeeIds) > 0) {
			$deleteKfiEmployee = KfiEmployee::find()
				->where(['not in', 'employeeId', $employeeIds])
				->andWhere([
					"kfiId" => $_POST["kfiId"],
					"month" => $month,
					"year" => $year
				])
				->all();
			if (isset($deleteKfiEmployee) && count($deleteKfiEmployee) > 0) {
				foreach ($deleteKfiEmployee as $delKfi):
					$delKfi->status = 99;
					$delKfi->save(false);
				endforeach;
			}
		}
		return $this->redirect(Yii::$app->homeUrl . 'kfi/assign/assign/' . ModelMaster::encodeParams(['kfiId' => $_POST["kfiId"], "companyId" => $_POST["companyId"], "url" => $_POST["url"]]));
	}
	public function actionNextKfiHistory()
	{
		$nextMonth = null;
		$nextYear = null;
		$kfiHistoryId = $_POST["kfiHistoryId"];
		$currentHistory = KfiHistory::find()->where(["kfiHistoryId" => $kfiHistoryId])->asArray()->one();
		$unit = Unit::find()->where(["unitId" => $currentHistory["unitId"]])->asArray()->one();
		if ($currentHistory["month"] != "" && $currentHistory["year"] != "") {
			// throw new exception($unit["unitName"]);
			$nextTargetMonthYear = ModelMaster::nextTargetMonthYear($unit["unitName"], $currentHistory["month"], $currentHistory["year"]);
			// throw new exception($currentHistory["year"]);

			$nextMonth = $nextTargetMonthYear["nextMonth"];
			$nextYear = $nextTargetMonthYear["nextYear"];
		} else {
			$nextMonth = null;
			$nextYear = null;
		}
		$kfiHistory = new KfiHistory();
		$kfiHistory->kfiId = $currentHistory["kfiId"];
		$kfiHistory->createrId = Yii::$app->user->id;
		$kfiHistory->titleProgress = 'New target';
		// $kfiHistory->nextCheckDate = $currentHistory["nextCheckDate"];
		$kfiHistory->amountType = $currentHistory["amountType"];
		$kfiHistory->code = $currentHistory["code"];
		$kfiHistory->status = 1;
		$kfiHistory->quantRatio = $currentHistory["quantRatio"];
		$kfiHistory->historyStatus = 1;
		$kfiHistory->target = $currentHistory["target"];
		$kfiHistory->result = 0;
		$kfiHistory->unitId =  $currentHistory["unitId"];
		$kfiHistory->month = $nextMonth;
		$kfiHistory->year = $nextYear;
		$kfiHistory->createDateTime = new Expression('NOW()');
		$kfiHistory->updateDateTime = new Expression('NOW()');
		if ($kfiHistory->save(false)) {
			$kfi = Kfi::find()->where(["kfiId" => $currentHistory["kfiId"]])->one();
			$kfi->status = 1;
			$kfi->month = $nextMonth;
			$kfi->year = $nextYear;
			$kfi->fromDate = null;
			$kfi->toDate = null;
			$kfi->updateDateTime = new Expression('NOW()');
			$kfi->save(false);
			$kfiEmployee = KfiEmployee::find()->where(["kfiId" => $currentHistory["kfiId"], "status" => [1, 2, 4]])->all();
			if (isset($kfiEmployee) && count($kfiEmployee) > 0) {
				foreach ($kfiEmployee as $employee) :
					$oldEmployee = KfiEmployee::find()
						->where([
							"kfiId" => $currentHistory["kfiId"],
							"employeeId" => $employee->employeeId,
							"status" => [1, 2, 4],
							"month" => $nextMonth,
							"year" => $nextYear
						])
						->one();
					if (!isset($oldEmployee) || empty($oldEmployee)) {
						$newKfiEmployee = new kfiEmployee();
						$newKfiEmployee->employeeId = $employee->employeeId;
						$newKfiEmployee->kfiId = $currentHistory["kfiId"];
						$newKfiEmployee->target = $currentHistory["target"];
						$newKfiEmployee->status = 1;
						$newKfiEmployee->month = $nextMonth;
						$newKfiEmployee->year = $nextYear;
						$newKfiEmployee->updateDateTime = new Expression('NOW()');
						$newKfiEmployee->createDateTime = new Expression('NOW()');
						$newKfiEmployee->save(false);
					}

				endforeach;
			}
		}

		// return print_r($nextTargetMonthYear, true);
		// return $this->redirect(Yii::$app->homeUrl . 'kfi/management/grid');
		return $this->redirect(Yii::$app->request->referrer);
	}
}
