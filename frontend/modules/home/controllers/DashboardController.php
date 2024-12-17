<?php

namespace frontend\modules\home\controllers;

use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
use frontend\models\hrvc\Employee;
use frontend\models\hrvc\EmployeePimWeight;
use frontend\models\hrvc\Frame;
use frontend\models\hrvc\FrameTerm;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\User;
use Yii;
use yii\web\Controller;

class DashboardController extends Controller
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
	public function actionIndex()
	{
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		$employeeId = User::employeeIdFromUserId();
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/employee/employee-detail?id=' . $employeeId);
		$employee = curl_exec($api);
		$employee = json_decode($employee, true);

		$termId = FrameTerm::currentTermId($employee["companyId"], $employee["branchId"]);

		//$termId = 20;
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/employee-evaluator?employeeId=' . $employeeId . '&&termId=' . $termId);
		$evaluator = curl_exec($api);
		$evaluator = json_decode($evaluator, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/term-detail?termId=' . $termId);
		$terms = curl_exec($api);
		$terms = json_decode($terms, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/eva/employee-pim?employeeId=' . $employeeId . '&&termId=' . $termId);
		$employeePim = curl_exec($api);
		$employeePim = json_decode($employeePim, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/eva/all-current-term?employeeId=' . $employeeId . '&&companyId=' . $employee["companyId"] . '&&branchId=' . $employee["branchId"]);
		$allCurrentTerm = curl_exec($api);
		$allCurrentTerm = json_decode($allCurrentTerm, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/eva/subordinate-current-term?evaluatorId=' .  $employeeId);
		$subordinateTerm = curl_exec($api);
		$subordinateTerm = json_decode($subordinateTerm, true);

		$frameId = $terms["frameId"];
		$frameName = Frame::frameName($frameId);
		// throw new exception(print_r($subordinateTerm, true));
		return $this->render('index', [
			"employee" => $employee,
			"evaluator" => $evaluator,
			"terms" => $terms,
			"frameName" => $frameName,
			"employeePim" => $employeePim,
			"allCurrentTerm" => $allCurrentTerm,
			"termId" => $termId,
			"subordinateTerm" => $subordinateTerm
		]);
	}
	public function actionKgiEmployeeId()
	{
		$kgiEmployeeId=$_POST["id"];
		$res["kgiEmployeeId"]=ModelMaster::encodeParams(["kgiEmployeeId"=>$kgiEmployeeId]);
		return json_encode($res);
	}

	public function actionKpiEmployeeId()
	{
		$kpiEmployeeId=$_POST["id"];
		$res["kpiEmployeeId"]=ModelMaster::encodeParams(["kpiEmployeeId"=>$kpiEmployeeId]);
		return json_encode($res);
	}
}