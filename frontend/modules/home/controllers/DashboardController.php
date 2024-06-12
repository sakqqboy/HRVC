<?php

namespace frontend\modules\home\controllers;

use common\helpers\Path;
use Exception;
use frontend\models\hrvc\Employee;
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

		$termId = FrameTerm::currentTermId($employee["companyId"]);

		//$termId = 20;
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/employee-evaluator?employeeId=' . $employeeId . '&&termId=' . $termId);
		$evaluator = curl_exec($api);
		$evaluator = json_decode($evaluator, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/term-detail?termId=' . $termId);
		$terms = curl_exec($api);
		$terms = json_decode($terms, true);

		$frameId = $terms["frameId"];
		$frameName = Frame::frameName($frameId);
		//throw new Exception(print_r($terms, true));
		return $this->render('index', [
			"employee" => $employee,
			"evaluator" => $evaluator,
			"terms" => $terms,
			"frameName" => $frameName,
		]);
	}
}
