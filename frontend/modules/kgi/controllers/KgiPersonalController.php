<?php

namespace frontend\modules\kgi\controllers;

use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
use FFI\Exception as FFIException;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\KgiEmployee;
use frontend\models\hrvc\KgiEmployeeHistory;
use frontend\models\hrvc\UserRole;
use Yii;
use yii\db\Expression;
use yii\web\Controller;

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
class KgiPersonalController extends Controller
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
	public function actionIndivisualSetting($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$kgiId = $param["kgiId"];
		$role = UserRole::userRight();
		if ($role < 3) {
			return $this->redirect(Yii::$app->homeUrl . 'kgi/management/index');
		}
		$api = curl_init();
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-personal/kgi-team-employee?kgiId=' . $kgiId);
		$kgiEmployees = curl_exec($api);
		$kgiEmployees = json_decode($kgiEmployees, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiId);
		$kgiDetail = curl_exec($api);
		$kgiDetail = json_decode($kgiDetail, true);

		curl_close($api);

		//throw new Exception(print_r($kgiEmployees, true));
		return $this->render('indivisual_setting', [
			"kgiDetail" => $kgiDetail,
			"kgiId" => $kgiId,
			"kgiEmployees" => $kgiEmployees,
			"role" => $role
		]);
	}
	public function actionSetPersonalTarget()
	{
		if (isset($_POST["kgiId"])) {
			if (isset($_POST["target"]) && count($_POST["target"])) {
				foreach ($_POST["target"] as $employeeId => $target) :
					if ($target != '') {
						$target = str_replace(",", "", $target);
						$kgiEmployee = KgiEmployee::find()
							->where(["kgiId" => $_POST["kgiId"], "employeeId" => $employeeId])
							->one();
						if (isset($kgiEmployee) && !empty($kgiEmployee)) {
							$kgiEmployee->target = $target;
							$kgiEmployee->updateDateTime = new Expression('NOW()');
							$kgiEmployee->createrId = Yii::$app->user->id;
							$kgiEmployee->save(false);
						} else {
							if ($target != '0.00') {
								$kgiEmployee = new KgiEmployee();
								$kgiEmployee->target = $target;
								$kgiEmployee->kgiId = $_POST["kgiId"];
								$kgiEmployee->employeeId = $employeeId;
								$kgiEmployee->updateDateTime = new Expression('NOW()');
								$kgiEmployee->createrId = Yii::$app->user->id;
								$kgiEmployee->save(false);
							}
						}
					}
				endforeach;
			}
		}
		return $this->redirect(Yii::$app->homeUrl . 'kgi/management/assign-kgi');
	}
	public function actionIndividualKgi()
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
		$staffId = Yii::$app->user->id;
		$api = curl_init();
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$companies = curl_exec($api);
		$companies = json_decode($companies, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/unit/all-unit');
		$units = curl_exec($api);
		$units = json_decode($units, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-personal/employee-kgi?userId=' . Yii::$app->user->id);
		$kgis = curl_exec($api);
		$kgis = json_decode($kgis, true);

		curl_close($api);
		$months = ModelMaster::monthFull(1);
		$isManager = UserRole::isManager();
		return $this->render('index', [
			"units" => $units,
			"companies" => $companies,
			"months" => $months,
			"isManager" => $isManager,
			"role" => $role,
			"kgis" => $kgis,
			"userId" => Yii::$app->user->id
		]);
	}
	public function actionUpdatePersonalKgi($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$kgiEmployeeId = $param["kgiEmployeeId"];

		$api = curl_init();
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-personal/kgi-employee-detail?kgiEmployeeId=' . $kgiEmployeeId);
		$kgiEmployeeDetail = curl_exec($api);
		$kgiEmployeeDetail = json_decode($kgiEmployeeDetail, true);

		curl_close($api);
		return $this->render('update_personal_kgi', [
			"kgiEmployeeId" => $kgiEmployeeId,
			"kgiEmployeeDetail" => $kgiEmployeeDetail
		]);
	}
	public function actionSaveUpdatePersonalKgi()
	{
		if (isset($_POST["kgiEmployeeId"])) {
			$history = KgiEmployeeHistory::find()
				->where(["kgiEmployeeId" => $_POST["kgiEmployeeId"], "status" => [1, 2, 4]])
				->orderBy('kgiEmployeeHistoryId DESC')
				->one();
			$status = $_POST["status"];
			if (isset($history) && !empty($history)) {
				$nextCheckDateArr = explode(' ', $history["nextCheckDate"]);
				$nextCheckDate = $nextCheckDateArr[0];
				$lastCheck = $history->nextCheckDate;
				if ($history->target == str_replace(",", "", $_POST["target"]) && $history->result == str_replace(",", "", $_POST["result"]) && $nextCheckDate == $_POST["nextCheckDate"]) {
					$history->status = $_POST["status"];
					$history->updateDateTime = new Expression('NOW()');
				} else {
					if ($history->target != str_replace(",", "", $_POST["target"])) {
						$status = 88;
					}
					$history = KgiEmployeeHistory::find()
						->where(["kgiEmployeeId" => $_POST["kgiEmployeeId"], "status" => 88])
						->one();
					if (!isset($history) || empty($history)) {
						$history = new KgiEmployeeHistory();
					}
					$history->kgiEmployeeId = $_POST["kgiEmployeeId"];
					$history->target = str_replace(",", "", $_POST["target"]);
					$history->result = str_replace(",", "", $_POST["result"]);
					$history->detail = $_POST["detail"];
					$history->nextCheckDate = $_POST["nextCheckDate"] . ' 00:00:00';
					$history->lastCheckDate = $lastCheck;
					$history->status = $status;
					$history->createDateTime = new Expression('NOW()');
					$history->updateDateTime = new Expression('NOW()');
				}
			} else {
				$history = new KgiEmployeeHistory();
				$history->kgiEmployeeId = $_POST["kgiEmployeeId"];
				$history->target = str_replace(",", "", $_POST["target"]);
				$history->result = str_replace(",", "", $_POST["result"]);
				$history->detail = $_POST["detail"];
				$history->nextCheckDate = $_POST["nextCheckDate"] . ' 00:00:00';
				$history->status = $_POST["status"];
				$history->createDateTime = new Expression('NOW()');
				$history->updateDateTime = new Expression('NOW()');
			}
			$kgiEmployee = KgiEmployee::find()
				->where(["kgiEmployeeId" => $_POST["kgiEmployeeId"]])
				->one();
			if ($status != 88) {
				$kgiEmployee->target = $_POST["target"];
				$kgiEmployee->result = $_POST["result"];
			} else {
				$kgiEmployee->status = 1;
			}
			$kgiEmployee->updateDateTime = new Expression('NOW()');
			$kgiEmployee->save(false);
			$history->createrId = Yii::$app->user->id;
			if ($history->save(false)) {
				return $this->redirect(Yii::$app->homeUrl . 'kgi/kgi-personal/individual-kgi');
			}
		}
	}
	public function actionViewPersonalKgi($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$kgiEmployeeId = $param["kgiEmployeeId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-personal/kgi-employee-detail?kgiEmployeeId=' . $kgiEmployeeId);
		$kgiEmployeeDetail = curl_exec($api);
		$kgiEmployeeDetail = json_decode($kgiEmployeeDetail, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-personal/kgi-employee-history?kgiEmployeeId=' . $kgiEmployeeId);
		$kgiEmployeeHistory = curl_exec($api);
		$kgiEmployeeHistory = json_decode($kgiEmployeeHistory, true);

		curl_close($api);
		return $this->render('personal_view', [
			"kgiEmployeeId" => $kgiEmployeeId,
			"kgiEmployeeDetail" => $kgiEmployeeDetail,
			"kgiEmployeeHistory" => $kgiEmployeeHistory
		]);
	}
}
