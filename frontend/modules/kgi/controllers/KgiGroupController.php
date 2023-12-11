<?php

namespace frontend\modules\kgi\controllers;

use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\KgiGroup;
use frontend\models\hrvc\UserRole;
use Yii;
use yii\db\Expression;
use yii\web\Controller;

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
class KgiGroupController extends Controller
{
	public function beforeAction($action)
	{
		if (!Yii::$app->user->id) {
			return $this->redirect(Yii::$app->homeUrl . 'site/login');
		}
		$isManager = UserRole::isManager();
		if ($isManager == 0) {
			return $this->redirect(Yii::$app->homeUrl . 'kgi/management/index');
		}
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		$role = UserRole::userRight();
		if ($role < 3) {
			return $this->redirect(Yii::$app->homeUrl . 'kgi/management/index');
		}
		//$this->setDefault();
		return true;
	}
	public function actionIndex()
	{
		$api = curl_init();
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-group/index');
		$kgiGroups = curl_exec($api);
		$kgiGroups = json_decode($kgiGroups, true);
		curl_close($api);

		return $this->render('index', [
			"kgiGroups" => $kgiGroups
		]);
	}
	public function actionCreate()
	{
		if (isset($_POST["kgiGroupName"])) {
			$kgiGroup = new KgiGroup();
			$kgiGroup->kgiGroupName = $_POST["kgiGroupName"];
			$kgiGroup->companyId = $_POST["company"];
			$kgiGroup->kgiGroupDetail = $_POST["detail"];
			$kgiGroup->target = $_POST["target"];
			$kgiGroup->createrId = Yii::$app->user->id;
			$kgiGroup->status = 1;
			$kgiGroup->createDateTime = new Expression('NOW()');
			$kgiGroup->updateDateTime = new Expression('NOW()');
			if ($kgiGroup->save(false)) {
				return $this->redirect('index');
			}
		}
		$groupId = Group::currentGroupId();
		$api = curl_init();
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$companies = curl_exec($api);
		$companies = json_decode($companies, true);
		return $this->render('create', [
			"companies" => $companies
		]);
	}
	public function actionUpdate($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$kgiGroupId = $param["kgiGroupId"];
		$groupId = Group::currentGroupId();
		$api = curl_init();
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-group/kgi-group-detail?kgiGroupId=' . $kgiGroupId);
		$kgiGroup = curl_exec($api);
		$kgiGroup = json_decode($kgiGroup, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$companies = curl_exec($api);
		$companies = json_decode($companies, true);

		curl_close($api);
		return $this->render('update', [
			"kgiGroup" => $kgiGroup,
			"companies" => $companies
		]);
	}
	public function actionSaveUpdateKgiGroup()
	{
		if (isset($_POST["kgiGroupName"])) {
			$kgiGroup = KgiGroup::find()->where(["kgiGroupId" => $_POST['kgiGroupId']])->one();
			$kgiGroup->kgiGroupName = $_POST["kgiGroupName"];
			$kgiGroup->companyId = $_POST["company"];
			$kgiGroup->kgiGroupDetail = $_POST["detail"];
			$kgiGroup->target = str_replace(",", "", $_POST["target"]);
			$kgiGroup->createrId = Yii::$app->user->id;
			$kgiGroup->status = 1;
			$kgiGroup->updateDateTime = new Expression('NOW()');
			if ($kgiGroup->save(false)) {
				return $this->redirect('index');
			} else {
				return $this->redirect('update/' . ModelMaster::encodeParams(["kgiGroupId" => $_POST['kgiGroupId']]));
			}
		}
	}
	public function actionCheckKgiGroupName()
	{
		$groupName = $_POST["name"];
		$companyId = $_POST["companyId"];
		$res = [];
		$res["status"] = true;
		if (trim($groupName) != '') {
			if ($companyId != '') {
				$kgiGroup = KgiGroup::find()->where(["kgiGroupName" => $groupName, "companyId" => $companyId, "status" => 1])->one();
			}
			if (isset($kgiGroup) && !empty($kgiGroup)) {
				$res["status"] = false;
			}
		}
		return json_encode($res);
	}
	public function actionCheckKgiGroupNameUpdate()
	{
		$groupName = $_POST["name"];
		$companyId = $_POST["companyId"];
		$kgiGroupId = $_POST["kgiGroupId"];
		$res = [];
		$res["status"] = true;
		if (trim($groupName) != '') {
			if ($companyId != '') {
				$kgiGroup = KgiGroup::find()
					->where(["kgiGroupName" => $groupName, "companyId" => $companyId, "status" => 1])
					->andWhere("kgiGroupId!=" . $kgiGroupId)
					->one();
			}
			if (isset($kgiGroup) && !empty($kgiGroup)) {
				$res["status"] = false;
			}
		}
		return json_encode($res);
	}
	public function actionDeleteKgiGroup()
	{
		KgiGroup::updateAll(["status" => 99], ["kgiGroupId" => $_POST["kgiGroupId"]]);
		$res["status"] = true;
		return json_encode($res);
	}
}
