<?php

namespace frontend\modules\kgi\controllers;

use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
use frontend\models\hrvc\Department;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\Kgi;
use frontend\models\hrvc\KgiBranch;
use frontend\models\hrvc\KgiDepartment;
use frontend\models\hrvc\KgiHistory;
use frontend\models\hrvc\KgiIssue;
use frontend\models\hrvc\KgiSolution;
use frontend\models\hrvc\KgiTeam;
use frontend\models\hrvc\Team;
use frontend\models\hrvc\User;
use Yii;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\UploadedFile;

/**
 * Default controller for the `kgi` module
 */
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
class ManagementController extends Controller
{
	public function beforeAction($action)
	{
		if (!Yii::$app->user->id) {
			return $this->redirect(Yii::$app->homeUrl . 'site/login');
		}
		return true;
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

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/unit/all-unit');
		$units = curl_exec($api);
		$units = json_decode($units, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/index');
		$kgis = curl_exec($api);
		$kgis = json_decode($kgis, true);

		curl_close($api);
		$months = ModelMaster::monthFull(1);
		return $this->render('index', [
			"units" => $units,
			"companies" => $companies,
			"months" => $months,
			"kgis" => $kgis
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

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/unit/all-unit');
		$units = curl_exec($api);
		$units = json_decode($units, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/index');
		$kgis = curl_exec($api);
		$kgis = json_decode($kgis, true);

		curl_close($api);
		$months = ModelMaster::monthFull(1);
		return $this->render('kgi_grid', [
			"units" => $units,
			"companies" => $companies,
			"months" => $months,
			"kgis" => $kgis
		]);
	}
	public function actionCreateKgi()
	{
		if (isset($_POST["kgiName"]) && trim($_POST["kgiName"])) {
			$kgi = new Kgi();
			$kgi->kgiName = $_POST["kgiName"];
			$kgi->companyId = $_POST["companyId"];
			$kgi->unitId = $_POST["unit"];
			$kgi->periodDate = $_POST["periodDate"];
			$kgi->targetAmount = $_POST["targetAmount"];
			$kgi->kgiDetail = $_POST["detail"];
			$kgi->quantRatio = $_POST["quantRatio"];
			$kgi->priority = $_POST["priority"];
			$kgi->amountType = $_POST["amountType"];
			$kgi->code = $_POST["code"];
			$kgi->status = $_POST["status"];
			$kgi->month = $_POST["month"];
			$kgi->result = $_POST["result"];
			$kgi->createrId = 1;
			$kgi->createDateTime = new Expression('NOW()');
			$kgi->updateDateTime = new Expression('NOW()');
			if ($kgi->save(false)) {
				$kgiId = Yii::$app->db->lastInsertID;
				if (isset($_POST["branch"]) && count($_POST["branch"]) > 0) {
					$this->saveKgiBranch($_POST["branch"], $kgiId);
				}
				if (isset($_POST["department"]) && count($_POST["department"]) > 0) {
					$this->saveKgiDepartment($_POST["department"], $kgiId);
				}
				if (isset($_POST["team"]) && count($_POST["team"]) > 0) {
					$this->saveKgiTeam($_POST["team"], $kgiId);
				}
				return $this->redirect('index');
			}
		}
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
			$kgiId = $_POST["kgiId"];
			$branchText = $this->renderAjax('multi_branch_update', [
				"branches" => $branches,
				"kgiId" => $kgiId
			]);
		}
		curl_close($api);
		$res["status"] = true;
		$res["branchText"] = $branchText;
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
		if (isset($_POST["multiBranch"]) && count($_POST["multiBranch"]) > 0) {
			foreach ($_POST["multiBranch"] as $branchId) :
				if (isset($_POST["multiDepartment"]) && count($_POST["multiDepartment"]) > 0) {
					foreach ($_POST["multiDepartment"] as $departmentId) :
						if ($branchId != '') {
							$department = Department::find()
								->where(["departmentId" => $departmentId, "branchId" => $branchId])
								->one();
							if (isset($department) && !empty($department)) {
								$branchDepartment[$branchId][$departmentId] = $departmentId;
							}
						}
					endforeach;
				}

			endforeach;
		}

		if (count($branchDepartment) > 0) {

			foreach ($branchDepartment as $branchId => $departments) :

				foreach ($departments as $dId => $id) :
					$teams = Team::find()
						->where(["departmentId" => $dId])
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
	public function saveKgiTeam($team, $kgiId)
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
				$old = KgiTeam::find()->where(["kgiId" => $kgiId, "teamId" => $t, "status" => 1])->one();
				if (!isset($old) || empty($old)) {
					$kgiTeam = new KgiTeam();
					$kgiTeam->kgiId = $kgiId;
					$kgiTeam->teamId = $t;
					$kgiTeam->status = 1;
					$kgiTeam->createDateTime = new Expression('NOW()');
					$kgiTeam->updateDateTime = new Expression('NOW()');
					$kgiTeam->save(false);
				}
			endforeach;
		}
	}
	public function actionPrepareUpdate()
	{
		$kgiId = $_POST["kgiId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiId);
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
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-department?id=' . $kgiId);
		$kgiDepartment = curl_exec($api);
		$kgiDepartment = json_decode($kgiDepartment, true);
		$kgiDepartmentText = $this->renderAjax('multi_department_update', [
			"d" => $kgiDepartment,
			"kgiId" => $kgiId
		]);
		$department["textDepartment"] = $kgiDepartmentText;


		$kgiTeamText = '';
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-team?id=' . $kgiId);
		$kgiTeam = curl_exec($api);
		$kgiTeam = json_decode($kgiTeam, true);
		$kgiTeamText = $this->renderAjax('multi_team_update', [
			"t" => $kgiTeam,
			"kgiId" => $kgiId
		]);
		$team["textTeam"] = $kgiTeamText;


		$data = array_merge($kgi, $branch, $department, $team);
		//throw new Exception(print_r($data, true));
		curl_close($api);
		return json_encode($data);
	}
	public function actionUpdateKgi()
	{
		//throw new Exception(print_r(Yii::$app->request->post(), true));
		if (isset($_POST["kgiId"]) && $_POST["kgiId"] != "") {
			$kgiId = $_POST["kgiId"];
			//throw new Exception(print_r(Yii::$app->request->post(), true));
			$kgi = Kgi::find()->where(["kgiId" => $kgiId])->one();
			//$kgi->kgiName = $_POST["kgiName"];
			$kgi->companyId = $_POST["companyId"];
			$kgi->unitId = $_POST["unit"];
			$kgi->periodDate = $_POST["periodDate"];
			$kgi->targetAmount = $_POST["targetAmount"];
			$kgi->kgiDetail = $_POST["detail"];
			$kgi->quantRatio = $_POST["quantRatio"];
			$kgi->priority = $_POST["priority"];
			$kgi->amountType = $_POST["amountType"];
			$kgi->code = $_POST["code"];
			$kgi->status = $_POST["status"];
			$kgi->month = $_POST["month"];
			$kgi->result = $_POST["result"];
			$kgi->createrId = 1;
			$kgi->updateDateTime = new Expression('NOW()');
			if ($kgi->save(false)) {
				$kgiHistory = new KgiHistory();
				$kgiHistory->kgiId = $_POST["kgiId"];
				$kgiHistory->kgiHistoryName = $_POST["historyName"];
				$kgiHistory->titleProcess = $_POST["historyName"];
				$kgiHistory->unitId = $_POST["unit"];
				$kgiHistory->periodDate = $_POST["periodDate"];
				$kgiHistory->nextCheckDate = $_POST["nextDate"];
				$kgiHistory->targetAmount = $_POST["targetAmount"];
				$kgiHistory->description = $_POST["detail"];
				$kgiHistory->remark = $_POST["remark"];
				$kgiHistory->quantRatio = $_POST["quantRatio"];
				$kgiHistory->priority = $_POST["priority"];
				$kgiHistory->amountType = $_POST["amountType"];
				$kgiHistory->code = $_POST["code"];
				$kgiHistory->status = $_POST["status"];
				$kgiHistory->month = $_POST["month"];
				$kgiHistory->result = $_POST["result"];
				$kgiHistory->createrId = 1;
				$kgiHistory->createDateTime = new Expression('NOW()');
				$kgiHistory->updateDateTime = new Expression('NOW()');
				$kgiHistory->save(false);
				if (isset($_POST["branch"]) && count($_POST["branch"]) > 0) {
					$this->saveKgiBranch($_POST["branch"], $kgiId);
				}
				if (isset($_POST["department"]) && count($_POST["department"]) > 0) {
					$this->saveKgiDepartment($_POST["department"], $kgiId);
				}
				if (isset($_POST["team"]) && count($_POST["team"]) > 0) {
					$this->saveKgiTeam($_POST["team"], $kgiId);
				}
				return $this->redirect('index');
			}
		}
		return $this->redirect('index');
	}
	public function actionHistory()
	{
		$kgiId = $_POST["kgiId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiId);
		$kgi = curl_exec($api);
		$kgi = json_decode($kgi, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-team?id=' . $kgiId);
		$kgiTeams = curl_exec($api);
		$kgiTeams = json_decode($kgiTeams, true);
		//throw new Exception(print_r($kgiTeams, true));
		$res["teamText"] = $this->renderAjax('kgi_team', ["kgiTeams" => $kgiTeams]);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-employee?id=' . $kgiId);
		$kgiEmloyee = curl_exec($api);
		$kgiEmloyee = json_decode($kgiEmloyee, true);
		$res["employeeText"] = $this->renderAjax('kgi_member', ["kgiEmloyee" => $kgiEmloyee]);

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
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiId);
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
	public function actionCreateNewIssue()
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
				return $this->redirect('index');
			}
		}
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
		$createDateTime = date('Y-m-d');
		if ($answer->save(false)) {
			$res["commentText"] = $this->renderAjax('comment', [
				"name" => User::userHeaderName(),
				"image" => User::userHeaderImage(),
				"answer" => $solution,
				"createDateTime" => ModelMaster::engDate($createDateTime, 2),
				"kgiIssueId" => $kgiIssueId,
				"file" => $file,
				"fileName" => $fileName
			]);
			$res["status"] = true;
		}
		return json_encode($res);
	}
}
