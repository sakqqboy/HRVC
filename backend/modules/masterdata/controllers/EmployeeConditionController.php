<?php

namespace backend\modules\masterdata\controllers;

use backend\models\hrvc\EmployeeCondition;
use Exception;
use yii\web\Controller;

/**
 * Default controller for the `masterdata` module
 */
class EmployeeConditionController extends Controller
{
	public function actionActiveCondition()
	{
		$condition = EmployeeCondition::find()->where(["status" => 1])->asArray()->orderBy('employeeConditionId')->all();
		return json_encode($condition);
	}
}
