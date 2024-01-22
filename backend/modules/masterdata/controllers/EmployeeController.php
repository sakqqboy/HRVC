<?php

namespace backend\modules\masterdata\controllers;

use backend\models\hrvc\Employee;
use Exception;
use yii\web\Controller;

/**
 * Default controller for the `masterdata` module
 */
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
class EmployeeController extends Controller
{
	public function actionEmployeeDetail($id)
	{
		$employee = Employee::find()
			->select('employee.*,c.companyName,co.countryName,co.flag,t.titleName,
			condition.employeeConditionName,s.statusName,na.nationalityName')
			->JOIN("LEFT JOIN", "company c", "c.companyId=employee.companyId")
			->JOIN("LEFT JOIN", "title t", "t.titleId=employee.titleId")
			->JOIN("LEFT JOIN", "country co", "co.countryId=c.countryId")
			->JOIN("LEFT JOIN", "nationality na", "na.numCode=employee.nationalityId")
			->JOIN("LEFT JOIN", "employee_status es", "es.employeeId=employee.employeeId")
			->JOIN("LEFT JOIN", "status s", "s.statusId=es.statusId")
			->JOIN("LEFT JOIN", "employee_condition condition", "condition.employeeConditionId=employee.employeeConditionId")
			->where(["employee.employeeId" => $id])
			->asArray()
			->one();
		return json_encode($employee);
	}
	public function actionAllEmployeeDetail($companyId)
	{
		$employee = Employee::find()
			->select('employee.*,c.companyName,co.countryName,co.flag,t.titleName,
			condition.employeeConditionName,s.statusName,na.nationalityName')
			->JOIN("LEFT JOIN", "company c", "c.companyId=employee.companyId")
			->JOIN("LEFT JOIN", "title t", "t.titleId=employee.titleId")
			->JOIN("LEFT JOIN", "country co", "co.countryId=c.countryId")
			->JOIN("LEFT JOIN", "nationality na", "na.numCode=employee.nationalityId")
			->JOIN("LEFT JOIN", "employee_status es", "es.employeeId=employee.employeeId")
			->JOIN("LEFT JOIN", "status s", "s.statusId=es.statusId")
			->JOIN("LEFT JOIN", "employee_condition condition", "condition.employeeConditionId=employee.employeeConditionId")
			->where(["employee.status" => 1])
			->andFilterWhere(["employee.companyId" => $companyId])
			->orderBy('employee.employeeFirstname')
			->asArray()
			->all();
		return json_encode($employee);
	}
}
