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
use frontend\models\hrvc\User;
use Yii;
use yii\db\Expression;
use yii\web\Controller;

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

		curl_close($api);
		//throw new Exception(print_r($kfis, true));

		$units = ["1" => "Monthly", "2" => "Weekly", "3" => "QuaterLy", "4" => "Daily"];
		$months = ModelMaster::monthFull(1);
		return $this->render('index', [
			"companies" => $companies,
			"units" => $units,
			"months" => $months,
			"kfis" => $kfis

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
		//throw new Exception(print_r($kfis, true));
		curl_close($api);
		$units = ["1" => "Monthly", "2" => "Weekly", "3" => "QuaterLy", "4" => "Daily"];
		$months = ModelMaster::monthFull(1);
		//throw new Exception(print_r($kfis, true));
		return $this->render('index_grid', [
			"companies" => $companies,
			"units" => $units,
			"months" => $months,
			"kfis" => $kfis

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
			$kfi->kfiDetail = $_POST["detail"];
			$kfi->createrId = 1;
			$kfi->status = 1;
			$kfi->createDateTime = new Expression('NOW()');
			$kfi->updateDateTime = new Expression('NOW()');
			if ($kfi->save(false)) {
				$kfiId = Yii::$app->db->lastInsertID;
				if ($_POST["branch"] != "all") {
					$branch = new KfiBranch();
					$branch->branchId = $_POST["branch"];
					$branch->kfiId = $kfiId;
					$branch->status = 1;
					$branch->createDateTime = new Expression('NOW()');
					$branch->updateDateTime = new Expression('NOW()');
					$branch->save(false);
					$department = new KfiDepartment();
					$department->departmentId = $_POST["department"];
					$department->kfiId = $kfiId;
					$department->status = 1;
					$department->createDateTime = new Expression('NOW()');
					$department->updateDateTime = new Expression('NOW()');
					$department->save(false);
				} else {
					$branches = Branch::find()
						->where(["companyId" => $_POST["company"], "status" => 1])
						->asArray()
						->all();
					if (isset($branches) && count($branches) > 0) {
						foreach ($branches as $branch) :
							$kfiBranch = new KfiBranch();
							$kfiBranch->branchId = $branch["branchId"];
							$kfiBranch->kfiId = $kfiId;
							$kfiBranch->status = 1;
							$kfiBranch->createDateTime = new Expression('NOW()');
							$kfiBranch->updateDateTime = new Expression('NOW()');
							$kfiBranch->save(false);
							$departments = Department::find()
								->where(["branchId" => $branch["branchId"], "status" => 1])
								->asArray()
								->all();
							if (isset($departments) && count($departments) > 0) {
								foreach ($departments as $d) :
									$kfiDepartment = new KfiDepartment();
									$kfiDepartment->departmentId = $d["departmentId"];
									$kfiDepartment->kfiId = $kfiId;
									$kfiDepartment->status = 1;
									$kfiDepartment->createDateTime = new Expression('NOW()');
									$kfiDepartment->updateDateTime = new Expression('NOW()');
									$kfiDepartment->save(false);
								endforeach;
							}
						endforeach;
					}
				}
				return $this->redirect('index');
			}
		}
	}
	public function actionSaveUpdateKfi()
	{
		if (isset($_POST["kfiId"])) {
			//throw new Exception(print_r(Yii::$app->request->post(), true));
			$kfi = Kfi::find()->where(["kfiId" => $_POST["kfiId"]])->one();
			$kfi->unitId = $_POST["unit"];
			$kfi->kfiDetail = $_POST["detail"];
			$kfi->status = $_POST["status"];
			$kfi->save(false);
			$kfiHistory = new KfiHistory();
			$kfiHistory->kfiId = $_POST["kfiId"];
			$kfiHistory->titleProgress = $_POST["progressTitle"];
			$kfiHistory->remark = $_POST["progressTitle"];
			$kfiHistory->checkPeriodDate = $_POST["periodDate"];
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
			return $this->redirect('index');
		}
	}
	public function actionUpdateKfi()
	{
		$kfiId = $_POST["kfiId"];
		$kfi = Kfi::find()->where(["kfiId" => $kfiId])->asArray()->one();
		$res["kfiName"] = $kfi["kfiName"];
		$res["companyName"] = Company::companyName($kfi['companyId']);
		$res["branchName"] = Branch::kfiBranchName($kfiId); //Branch::branchName($kfi['branchId']);//if count==1 show branch name else show all
		$res["unitId"] = $kfi["unitId"];
		$res["detail"] = $kfi["kfiDetail"];
		$res["targetAmount"] = $kfi["targetAmount"];
		$res["status"] = true;
		$res["monthName"] = ModelMaster::monthEng($kfi['month'], 1);
		$res["departmentName"] = KfiDepartment::kfiDepartmentName($kfiId);
		$kfiHistory = KfiHistory::find()
			->where(["kfiId" => $kfi["kfiId"], "status" => [1, 4]])
			->orderBy('kfiHistoryId DESC')
			->one();
		if (isset($kfiHistory) && !empty($kfiHistory)) {
			$res["quantRatio"] = $kfiHistory["quantRatio"];
			$res["code"] =  $kfiHistory["code"];
			$res["result"] = $kfiHistory["result"];
			$res["amountType"] = $kfiHistory["amountType"];
			$res["kfiStatus"] = $kfiHistory["historyStatus"];
			$res["code"] = $kfiHistory["code"];
			$res["result"] = $kfiHistory["result"];
		} else {
			$res["quantRatio"] = "";
			$res["code"] = "";
			$res["result"] = "";
			$res["amountType"] = "";
			$res["kfistatus"] = "";
			$res["code"] = "";
			$res["result"] = "";
		}
		return json_encode($res);
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
			"employeeId" => $employeeId
		]);
		$res["historyText"] =  $this->renderAjax('kfi_history');;
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
			if ($kfiIssue->save(false)) {
				return $this->redirect('index');
			}
		}
	}
}
