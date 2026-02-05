<?php

namespace frontend\modules\evaluation\controllers;

use backend\models\hrvc\BonusTerm;
use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
use frontend\models\hrvc\BonusRecord;
use frontend\models\hrvc\EmployeeSalary;
use frontend\models\hrvc\Frame;
use frontend\models\hrvc\Group;
use Yii;
use yii\db\Expression;
use yii\web\Controller;
use frontend\components\Api;

class BonusController extends Controller
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
		return true; //go to origin request
	}
	public function actionIndex($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$termId = $param["termId"];
		// $api = curl_init();
		// curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		// curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/term-detail?termId=' . $termId);
		$terms = Api::connectApi(Path::Api() . 'evaluation/environment/term-detail?termId=' . $termId);
		// $terms = curl_exec($api);
		// $terms = json_decode($terms, true);

		$frameId = $terms["frameId"];
		$frameName = Frame::frameName($frameId);
		$environmentId = Frame::getEnvironmentId($frameId);

		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/environment-detail?environmentId=' . $environmentId);
		$environmentDetail = Api::connectApi(Path::Api() . 'evaluation/environment/environment-detail?environmentId=' . $environmentId);
		// $environmentDetail = curl_exec($api);
		// $environmentDetail = json_decode($environmentDetail, true);

		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/rank/index?termId=' . $termId);
		$ranks = Api::connectApi(Path::Api() . 'evaluation/rank/index?termId=' . $termId);
		// $ranks = curl_exec($api);
		// $ranks = json_decode($ranks, true);

		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/bonus/bonus-detail?termId=' . $termId . '&&branchId=' . $environmentDetail["branchId"]);
		$bonusDetail = Api::connectApi(Path::Api() . 'evaluation/bonus/bonus-detail?termId=' . $termId . '&&branchId=' . $environmentDetail["branchId"]);
		// $bonusDetail = curl_exec($api);
		// $bonusDetail = json_decode($bonusDetail, true);

		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/bonus/bonus-list?termId=' . $termId . '&&branchId=' . $environmentDetail["branchId"]);
		$employeeList = Api::connectApi(Path::Api() . 'evaluation/bonus/bonus-list?termId=' . $termId . '&&branchId=' . $environmentDetail["branchId"]);
		// $employeeList = curl_exec($api);
		// $employeeList = json_decode($employeeList, true);

		// curl_close($api);

		//throw new Exception(print_r($employeeList, true));
		return $this->render('index', [
			"terms" => $terms,
			"termId" => $termId,
			"environmentDetail" => $environmentDetail,
			"frameName" => $frameName,
			"ranks" => $ranks,
			"employeeList" => $employeeList,
			"bonusDetail" => $bonusDetail
		]);
	}
	public function actionSaveBonusBudget()
	{
		$termId = $_POST["termId"];
		$budget = (float) $_POST["totalBudget"];
		$totalBonus = $_POST["totalBonus"];
		$adjustmentAmount = $budget - $totalBonus;
		$payableBonus = $totalBonus;
		if ($adjustmentAmount > 0) {
			$adjustmentAmount = 0;
		}
		$res["status"] = false;
		$bonusTerm = BonusTerm::find()->where(["termId" => $termId, "status" => 1])->orderBy("createDateTime DESC")->one();
		if (isset($bonusTerm) && !empty($bonusTerm)) {
			if ($budget != $bonusTerm->budget) {
				$bonusTerm->status = 99;
				$bonusTerm->save(false);
				$bonus = new BonusTerm();
				$bonus->termId = $termId;
				$bonus->budget = $budget;
				$bonus->totalBonus = $totalBonus;
				$bonus->totalAdjust = $adjustmentAmount;
				$bonus->totalPayable = $payableBonus;
				$bonus->status = 1;
				$bonus->createDateTime = new Expression('NOW()');
				$bonus->updateDateTime = new Expression('NOW()');
				$bonus->save(false);
				$res["status"] = true;
			}
		} else {
			$bonus = new BonusTerm();
			$bonus->termId = $termId;
			$bonus->budget = $budget;
			$bonus->totalBonus = $totalBonus;
			$bonus->totalAdjust = $adjustmentAmount;
			$bonus->totalPayable = $payableBonus;
			$bonus->status = 1;
			$bonus->createDateTime = new Expression('NOW()');
			$bonus->updateDateTime = new Expression('NOW()');
			$bonus->save(false);
			$res["status"] = true;
		}
		$res["status"] = true;
		$res["adjustment"] = $adjustmentAmount;
		$res["budget"] = number_format($budget, 2);
		return json_encode($res);
	}
	public function actionSaveFinalAdjustment()
	{
		$employeeId = $_POST["employeeId"];
		$termId = $_POST["termId"];
		$adjustValue = $_POST["adjustmentValue"];
		$trueBonusRate = 0;
		$bonusRecord = BonusRecord::find()->where(["employeeId" => $employeeId, "termId" => $termId])->one();
		if (isset($bonusRecord) && !empty($bonusRecord)) {
			$bonusRecord->finalAdjustment = $_POST["adjustmentValue"];
			$bonusRecord->creator = Yii::$app->user->id;
			$bonusRecord->save(false);
			$salary = $bonusRecord->salary;
			$res["realBonus"] = $bonusRecord->bonusRate * $bonusRecord->salary;
		} else {
			$bonusRecord = new BonusRecord();
			$bonusRecord->termId = $termId;
			$bonusRecord->salary = EmployeeSalary::EmployeeCurrentSalary($employeeId);
			$bonusRecord->employeeId = $employeeId;
			$bonusRecord->finalAdjustment = $adjustValue;
			$bonusRecord->creator = Yii::$app->user->id;
			$bonusRecord->createDateTime = new Expression('NOW()');
			$bonusRecord->updateDateTime = new Expression('NOW()');
			$salary = $bonusRecord->salary;
			$bonusRecord->save(false);
		}
		if ($salary != 0) {
			$trueBonusRate = number_format($adjustValue / $salary, 1);
		}
		$res["status"] = true;
		$res["trueBonusRate"] = $trueBonusRate;
		$res["adjustValue"] = $adjustValue;
		return json_encode($res);
	}
}
