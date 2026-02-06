<?php

namespace backend\modules\evaluation\controllers;

use backend\models\hrvc\Department;
use backend\models\hrvc\Employee;
use backend\models\hrvc\EmployeePimWeight;
use backend\models\hrvc\Environment;
use backend\models\hrvc\Frame;
use backend\models\hrvc\FrameTerm;
use backend\models\hrvc\TermItem;
use backend\models\hrvc\Title;
use common\models\ModelMaster;
use backend\models\hrvc\EmployeeEvaluator;
use common\helpers\Athorize;
use Yii;
use yii\web\Controller;
use yii\web\Response;

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
class EvaController extends Controller
{
	public function beforeAction($action)
	{
		$authHeader = Yii::$app->request->getHeaders()->get('TcgHrvcAuthorization');
		$check = Athorize::CheckRequest($authHeader);
		if ($check == 0) {
			Yii::$app->response->format = Response::FORMAT_JSON;
			Yii::$app->response->statusCode = 401;
			Yii::$app->response->data = [
				'status' => 'error',
				'message' => 'Invalid or missing token.'
			];
			return false;
		}
		return parent::beforeAction($action);
	}
	public function actionIndex() {}
	public function actionEmployeePim($employeeId, $termId)
	{
		$employeePim = EmployeePimWeight::find()
			->where(["employeeId" => $employeeId, "termId" => $termId])
			->asArray()
			->one();
		if (isset($employeePim) && !empty($employeePim)) {
			$data = [
				"status" => 202,
				"kfiWeight" => $employeePim["kfiWeight"],
				"kgiWeight" => $employeePim["kgiWeight"],
				"kpiWeight" => $employeePim["kpiWeight"]
			];
		} else {
			$data = ["status" => 204];
		}
		return json_encode($data);
	}
	public function actionAllCurrentTerm($employeeId, $companyId, $branchId)
	{
		$environment = Environment::find()->where(["companyId" => $companyId, "status" => 1, "branchId" => $branchId])->asArray()->one();

		if (isset($environment) && !empty($environment)) {
			$frames = Frame::find()
				->where(["environmentId" => $environment["environmentId"]])
				->andWhere("status!=99")
				->asArray()
				->orderBy("status DESC,frameId ASC")
				->all();
			if (isset($frames) && count($frames) > 0) {
				foreach ($frames as $frame) :
					$term = FrameTerm::find()
						->where(["frameId" => $frame["frameId"], "status" => 1])
						->andWhere("status!=99")
						->orderBy('termId')
						->one();
					if (!isset($term) || empty($term)) {
						$term = FrameTerm::find()
							->where(["frameId" => $frame["frameId"]])
							->andWhere("status!=99")
							->orderBy('termId DESC')
							->one();
					}
					if (isset($term) && !empty($term)) {
						$data[$term["termId"]] = [
							"status" => 200,
							"termName" => $term["termName"],
							"frameName" => $frame["frameName"],
							"status" => $term["status"],
							"midDate" => $term["midDate"] == "" ? ' ' : ModelMaster::engDate($term["midDate"]),
							"employeeId" => $employeeId
						];
					}
				endforeach;
			}
		} else {
			$data = ["status" => 204];
		}
		return json_encode($data);
	}
	public function actionSubordinateCurrentTerm($evaluatorId)
	{
		$employeeId = $evaluatorId;
		$employeeEvaluator = EmployeeEvaluator::find()
			->where(["status" => 1])
			->andWhere("primaryId=$employeeId or finalId=$employeeId")
			->asArray()
			->groupBy('employeeId')
			->orderBy('createDateTime')
			->all();
		if (isset($employeeEvaluator) && count($employeeEvaluator) > 0) {
			foreach ($employeeEvaluator as $evaluate) :
				$employeeDetail = Employee::EmployeeDetail($evaluate["employeeId"]);
				$isPrimary = 0;
				$isFinal = 0;
				if ($employeeId == $evaluate["primaryId"]) {
					$isPrimary = 1;
				}
				if ($employeeId == $evaluate["finalId"]) {
					$isFinal = 1;
				}
				$data[$evaluate["employeeId"]] = [
					"termId" => $evaluate["termId"],
					"termName" => FrameTerm::termName($evaluate["termId"]),
					"picture" => $employeeDetail["picture"],
					"employeeName" => $employeeDetail["employeeFirstname"] . ' ' . $employeeDetail["employeeSurename"],
					"primaryId" => $evaluate["primaryId"],
					"finalId" => $evaluate["finalId"],
					"status" => $evaluate["status"],
					"title" => Title::titleName($employeeDetail["titleId"]),
					"department" => Department::departmentName($employeeDetail["departmentId"]),
					"isPrimary" => $isPrimary,
					"isFinal" => $isFinal,
					"evaluatorId" => $employeeId
				];
			endforeach;
		} else {
			$data = [
				"status" => 204
			];
		}
		return json_encode($data);
	}
}
