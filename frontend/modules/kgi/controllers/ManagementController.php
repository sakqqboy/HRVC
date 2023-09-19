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
use frontend\models\hrvc\KgiTeam;
use frontend\models\hrvc\Team;
use Yii;
use yii\db\Expression;
use yii\web\Controller;

/**
 * Default controller for the `kgi` module
 */
class ManagementController extends Controller
{
	public function actionIndex()
	{
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		//$units = ["1" => "Monthly", "2" => "Weekly", "3" => "QuaterLy", "4" => "Daily"];

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
		return $this->render('kgi_grid');
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
		$api = curl_init();
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/company-branch?id=' . $companyId);
		$branches = curl_exec($api);
		$branches = json_decode($branches, true);
		$branchText = $this->renderAjax('multi_branch', ["branches" => $branches]);
		curl_close($api);
		$res["status"] = true;
		$res["branchText"] = $branchText;
		return json_encode($res);
	}
	public function actionBranchMultiDepartment()
	{
		$res["status"] = false;
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
			$textDepartment = $this->renderAjax('multi_department', [
				"d" => $d
			]);
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
			$textTeam .= $this->renderAjax('multi_team', [
				"t" => $t
			]);
			$res["status"] = true;
			$res["textTeam"] = $textTeam;
		}
		return json_encode($res);
	}
	public function saveKgiBranch($branch, $kgiId)
	{
		if (count($branch) > 0) {
			foreach ($branch as $b) :
				$kgiBranch = new KgiBranch();
				$kgiBranch->kgiId = $kgiId;
				$kgiBranch->branchId = $b;
				$kgiBranch->status = 1;
				$kgiBranch->createDateTime = new Expression('NOW()');
				$kgiBranch->updateDateTime = new Expression('NOW()');
				$kgiBranch->save(false);
			endforeach;
		}
	}
	public function saveKgiDepartment($department, $kgiId)
	{
		if (count($department) > 0) {
			foreach ($department as $d) :
				$kgiDepartment = new KgiDepartment();
				$kgiDepartment->kgiId = $kgiId;
				$kgiDepartment->departmentId = $d;
				$kgiDepartment->status = 1;
				$kgiDepartment->createDateTime = new Expression('NOW()');
				$kgiDepartment->updateDateTime = new Expression('NOW()');
				$kgiDepartment->save(false);
			endforeach;
		}
	}
	public function saveKgiTeam($team, $kgiId)
	{
		if (count($team) > 0) {
			foreach ($team as $t) :
				$kgiTeam = new KgiTeam();
				$kgiTeam->kgiId = $kgiId;
				$kgiTeam->teamId = $t;
				$kgiTeam->status = 1;
				$kgiTeam->createDateTime = new Expression('NOW()');
				$kgiTeam->updateDateTime = new Expression('NOW()');
				$kgiTeam->save(false);
			endforeach;
		}
	}
}
