<?php

namespace frontend\modules\kfi\controllers;

use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
use frontend\models\hrvc\Branch;
use frontend\models\hrvc\Company;
use frontend\models\hrvc\Department;
use frontend\models\hrvc\Employee;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\Kfi;
use frontend\models\hrvc\KfiBranch;
use frontend\models\hrvc\KfiDepartment;
use frontend\models\hrvc\KfiHistory;
use frontend\models\hrvc\KfiIssue;
use frontend\models\hrvc\KfiSolution;
use frontend\models\hrvc\Kgi;
use frontend\models\hrvc\KgiHistory;
use frontend\models\hrvc\Kpi;
use frontend\models\hrvc\KpiHistory;
use frontend\models\hrvc\User;
use frontend\models\hrvc\UserRole;
use Yii;
use yii\base\Model;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\UploadedFile;

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
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
		$api = curl_init();
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$companies = curl_exec($api);
		$companies = json_decode($companies, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kfi/management/index');
		$kfis = curl_exec($api);
		$kfis = json_decode($kfis, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/unit/all-unit');
		$units = curl_exec($api);
		$units = json_decode($units, true);

		$isManager = UserRole::isManager();

		curl_close($api);
		//throw new Exception(print_r($kfis, true));

		// $units = ["1" => "Monthly", "2" => "Weekly", "3" => "QuaterLy", "4" => "Daily"];
		$months = ModelMaster::monthFull(1);
		return $this->render('index', [
			"companies" => $companies,
			"units" => $units,
			"months" => $months,
			"kfis" => $kfis,
			"isManager" => $isManager

		]);
	}
	public function actionGrid()
	{
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		$api = curl_init();
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$companies = curl_exec($api);
		$companies = json_decode($companies, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kfi/management/index');
		$kfis = curl_exec($api);
		$kfis = json_decode($kfis, true);
		// throw new Exception(print_r($kfis, true));

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/unit/all-unit');
		$units = curl_exec($api);
		$units = json_decode($units, true);

		curl_close($api);
		// $units = ["1" => "Monthly", "2" => "Weekly", "3" => "QuaterLy", "4" => "Daily"];
		$months = ModelMaster::monthFull(1);
		$isManager = UserRole::isManager();
		//throw new Exception(print_r($kfis, true));
		return $this->render('index_grid', [
			"companies" => $companies,
			"units" => $units,
			"months" => $months,
			"kfis" => $kfis,
			"isManager" => $isManager

		]);
	}
	public function actionCreateKfi()
	{
		if (isset($_POST["kfiName"])) {
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
			$kfi->status = 1;
			$kfi->createDateTime = new Expression('NOW()');
			$kfi->updateDateTime = new Expression('NOW()');
			if ($kfi->save(false)) {
				$kfiId = Yii::$app->db->lastInsertID;
				if (isset($_POST["branch"]) && count($_POST["branch"]) > 0) {
					$this->saveKfiBranch($_POST["branch"], $kfiId);
				}
				if (isset($_POST["department"]) && count($_POST["department"]) > 0) {
					$this->saveKfiDepartment($_POST["department"], $kfiId);
				}
				return $this->redirect('index');
			}
		}
	}
	public function actionSaveUpdateKfi()
	{
		$isManager = UserRole::isManager();
		if (isset($_POST["kfiId"])) {
			//throw new Exception(print_r(Yii::$app->request->post(), true));
			$kfi = Kfi::find()->where(["kfiId" => $_POST["kfiId"]])->one();
			$kfi->unitId = $_POST["unit"];
			$kfi->kfiDetail = $_POST["detail"];
			$kfi->status = $_POST["status"];
			if ($isManager == 1) {
				$kfi->targetAmount = $_POST["targetAmount"];
			}
			$kfi->save(false);
			$kfiHistory = new KfiHistory();
			$kfiHistory->kfiId = $_POST["kfiId"];
			$kfiHistory->createrId = Yii::$app->user->id;
			$kfiHistory->titleProgress = $_POST["progressTitle"];
			$kfiHistory->remark = $_POST["progressTitle"];
			//$kfiHistory->checkPeriodDate = $_POST["periodDate"];
			$kfiHistory->fromDate = $_POST["fromDate"];
			$kfiHistory->toDate = $_POST["toDate"];
			$kfiHistory->nextCheckDate = $_POST["nextCheckDate"];
			$kfiHistory->amountType = $_POST["amountType"];
			$kfiHistory->code = $_POST["code"];
			$kfiHistory->status = 1;
			$kfiHistory->quantRatio = $_POST["quanRatio"];
			$kfiHistory->historyStatus = $_POST["status"];
			$kfiHistory->result =  $_POST["result"];
			$kfiHistory->unitId =  $_POST["unit"];
			$kfiHistory->formular = $_POST["formular"];
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
			return $this->redirect('index');
		}
	}
	public function actionUpdateKfi()
	{
		$kfiId = $_POST["kfiId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kfi/management/kfi-detail?kfiId=' . $kfiId);
		$kfi = curl_exec($api);
		$kfi = json_decode($kfi, true);

		$companyId = $kfi["companyId"];
		$kfiBranchText = '';
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/company-branch?id=' . $companyId);
		$kfiBranch = curl_exec($api);
		$kfiBranch = json_decode($kfiBranch, true);
		$kfiBranchText = $this->renderAjax('multi_branch_update', [
			"branches" => $kfiBranch,
			"kfiId" => $kfiId
		]);
		$branch["textBranch"] = $kfiBranchText;

		$kfiDepartmentText = '';
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kfi/management/kfi-department?id=' . $kfiId);
		$kfiDepartment = curl_exec($api);
		$kfiDepartment = json_decode($kfiDepartment, true);
		$kfiDepartmentText = $this->renderAjax('multi_department_update', [
			"d" => $kfiDepartment,
			"kfiId" => $kfiId
		]);
		$department["textDepartment"] = $kfiDepartmentText;
		curl_close($api);

		$data = array_merge($kfi, $branch, $department);
		return json_encode($data);
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
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kfi/management/kfi-detail?kfiId=' . $kfiId);
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
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, false);
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
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, false);
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
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kfi/management/kfi-detail?kfiId=' . $kfiId);
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
		if ($companyId == "" && $branchId == "" && $month == "" && $status == "" && $year == "") {
			if ($type == "list") {
				return $this->redirect(Yii::$app->homeUrl . 'kfi/management/index');
			} else {
				return $this->redirect(Yii::$app->homeUrl . 'kfi/management/grid');
			}
		}
		$paramText = 'companyId=' . $companyId . '&&branchId=' . $branchId . '&&month=' . $month . '&&status=' . $status . '&&year=' . $year;
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}

		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kfi/management/kfi-filter?' . $paramText);
		$kfis = curl_exec($api);
		$kfis = json_decode($kfis, true);

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
			$file = "kfi_search_result";
		} else {
			$file = "kfi_search_result_grid";
		}
		$isManager = UserRole::isManager();

		return $this->render($file, [
			"units" => $units,
			"companies" => $companies,
			"months" => $months,
			"kfis" => $kfis,
			"companyId" => $companyId,
			"branchId" => $branchId,
			// "teamId" => $teamId,
			"month" => $month,
			"status" => $status,
			"year" => $year,
			"branches" => $branches,
			"isManager" => $isManager
		]);
	}
	public function actionCompanyMultiBranch()
	{
		$companyId = $_POST["companyId"];
		$acType = $_POST["acType"];
		$api = curl_init();
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
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		$api = curl_init();
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kfi/management/index');
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
}
