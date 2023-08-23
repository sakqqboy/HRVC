<?php

namespace backend\modules\masterdata\controllers;


use backend\models\hrvc\Department;
use Exception;
use yii\web\Controller;

/**
 * Default controller for the `masterdata` module
 */
class DepartmentController extends Controller
{

	public function actionIndex()
	{
		// return $this->render('index');
	}
	public function actionAllDepartment()
	{
		$department = [];
		$department = Department::find()
			->where(["status" => 1])
			->asArray()
			->orderBy('departmentName')
			->all();
		//throw  new Exception(print_r($department, true));
		return json_encode($department);
	}
}
