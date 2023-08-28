<?php

namespace backend\modules\masterdata\controllers;

use backend\models\hrvc\Employee;
use Exception;
use yii\web\Controller;

/**
 * Default controller for the `masterdata` module
 */
class EmployeeController extends Controller
{
	public function actionEmployeeDetail($id)
	{
		$employee = Employee::find()
			->select('employee.*,c.companyName,co.countryName,co.flag,t.titleName,condition.employeeConditionName,s.statusName')
			->JOIN("LEFT JOIN", "company c", "c.companyId=employee.companyId")
			->JOIN("LEFT JOIN", "title t", "t.titleId=employee.titleId")
			->JOIN("LEFT JOIN", "country co", "co.countryId=c.countryId")
			->JOIN("LEFT JOIN", "employee_status es", "es.employeeId=employee.employeeId")
			->JOIN("LEFT JOIN", "status s", "s.statusId=es.statusId")
			->JOIN("LEFT JOIN", "employee_condition condition", "condition.employeeConditionId=employee.employeeConditionId")
			->where(["employee.employeeId" => $id])
			->asArray()
			->one();
		return json_encode($employee);
	}
	public function actionAllEmployeeDetail()
	{
		$employee = Employee::find()
			->select('employee.*,c.companyName,co.countryName,co.flag,t.titleName,condition.employeeConditionName,s.statusName')
			->JOIN("LEFT JOIN", "company c", "c.companyId=employee.companyId")
			->JOIN("LEFT JOIN", "title t", "t.titleId=employee.titleId")
			->JOIN("LEFT JOIN", "country co", "co.countryId=c.countryId")
			->JOIN("LEFT JOIN", "employee_status es", "es.employeeId=employee.employeeId")
			->JOIN("LEFT JOIN", "status s", "s.statusId=es.statusId")
			->JOIN("LEFT JOIN", "employee_condition condition", "condition.employeeConditionId=employee.employeeConditionId")
			->where(["employee.status" => 1])
			->asArray()
			->all();
		return json_encode($employee);
	}
}
