<?php

namespace backend\modules\masterdata\controllers;

use backend\models\hrvc\Branch;
use backend\models\hrvc\Company;
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
class CompanyController extends Controller
{
	/**
	 * Renders the index view for the module
	 * @return string
	 */
	public function actionIndex()
	{
		return $this->render('index');
	}
	public function actionAllCompany()
	{
		$company = Company::find()
			->select('companyName,companyId')
			->where(["status" => 1])->asArray()->orderBy("companyName")->all();
		return json_encode($company);
	}
	public function actionCompanyDetail($id)
	{
		$company = [];
		$company = Company::find()
			->where(["companyId" => $id])
			->asArray()
			->one();
		return json_encode($company);
	}

	public function actionHeader($id)
	{
		// เอาemployeeที่มีสถาณะมากกว่า 3
		// $headQuater = Company::find()
		// 	->select('companyId,companyName')
		// 	->where(["groupId" => $id, "headQuaterId" => null])
		// 	->asArray()
		// 	->one();
		$headQuater =  Employee::find()
		->select([
			'employee.employeeId',
			'employee.employeeFirstname',
			'employee.employeeSurename',
			'ur.userId'
		])
		->innerJoin('user u', 'employee.employeeId = u.employeeId')
		->innerJoin('user_role ur', 'ur.userId = u.userId')
		->where(['<=', 'roleId', 3])
		->groupBy('ur.userId')
		->asArray()
		->all();
			
		return json_encode($headQuater);
	}
	public function actionCompanyBranch($id)
	{
		$branches = [];
		$branches = Branch::find()
			->select('branchId,branchName')
			->where(["companyId" => $id, "status" => 1])
			->orderBy('branchName')
			->asArray()
			->all();
		return json_encode($branches);
	}
}