<?php

namespace frontend\modules\kfi\controllers;

use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
use frontend\models\hrvc\Branch;
use frontend\models\hrvc\Company;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\Kfi;
use frontend\models\hrvc\KfiHistory;
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
		//throw new Exception(print_r($kfis, true));

		$units = ["1" => "Monthly", "2" => "Weekly", "3" => "QuaterLy", "4" => "Daily"];
		$months = ModelMaster::monthFull(1);
		//throw new Exception(print_r($months, true));
		return $this->render('index', [
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
			$kfi->branchId = $_POST["branch"];
			$kfi->unitId = $_POST["unit"];
			$kfi->targetAmount = $_POST["amount"];
			$kfi->month = $_POST["month"];
			$kfi->kfiDetail = $_POST["detail"];
			$kfi->createrId = 1;
			$kfi->status = 1;
			$kfi->createDateTime = new Expression('NOW()');
			$kfi->updateDateTime = new Expression('NOW()');
			if ($kfi->save(false)) {
				return $this->redirect('index');
			}
		}
	}
	public function actionSaveUpdateKfi()
	{
		if (isset($_POST["kfiId"])) {
			$kfi = Kfi::find()->where(["kfiId" => $_POST["kfiId"]])->one();
			$kfi->unitId = $_POST["unit"];
			$kfi->kfiDetail = $_POST["detail"];
			$kfi->quantRatio = $_POST["quantio"];
			$kfi->status = $_POST["status"];
			$kfi->save(false);
			$kfiHistory = new KfiHistory();
			$kfiHistory->kfiId = $_POST["kfiId"];
			$kfiHistory->checkPeriodDate = $_POST["periodDate"];
			$kfiHistory->nextCheckDate = $_POST["nextCheckDate"];
			$kfiHistory->amountType = $_POST["amountType"];
			$kfiHistory->code = $_POST["code"];
			$kfiHistory->status = 1;
			$kfiHistory->historyStatus = $_POST["status"];
			$kfiHistory->result =  $_POST["result"];
			$kfiHistory->fomular = $_POST["formular"];
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
		$res["branchName"] = Branch::branchName($kfi['branchId']);
		$res["unitId"] = $kfi["unitId"];
		$res["detail"] = $kfi["kfiDetail"];
		$res["targetAmount"] = $kfi["targetAmount"];
		$res["status"] = true;
		$res["monthName"] = ModelMaster::monthEng($kfi['month'], 1);

		$kfiHistory = KfiHistory::find()
			->where(["kfiId" => $kfi["kfiId"], "status" => [1, 4]])
			->orderBy('kfiHistoryId DESC')
			->one();
		if (isset($kfiHistory) && !empty($kfiHistory)) {
			$res["quantRatio"] = $kfiHistory["quantRatio"];
			$res["code"] =  $kfiHistory["code"];
			$res["result"] = $kfiHistory["result"];
			$res["amountType"] = $kfiHistory["amountType"];
			$res["kfistatus"] = $kfiHistory["historyStatus"];
			$res["code"] = $kfiHistory["code"];
		} else {
			$res["quantRatio"] = "";
			$res["code"] = "";
			$res["result"] = "";
			$res["amountType"] = "";
			$res["kfistatus"] = "";
			$res["code"] = "";
		}
		return json_encode($res);
	}
}
