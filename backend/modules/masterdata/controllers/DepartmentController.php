<?php

namespace backend\modules\masterdata\controllers;


use backend\models\hrvc\Department;
use backend\models\hrvc\Title;
use Exception;
use Yii;
use yii\web\Controller;

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

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
	public function actionDepartmentDetail($id)
	{

		$department = [];
		$department = Department::find()
			->where(["departmentId" => $id])
			->asArray()
			->orderBy('departmentName')
			->one();
		//throw  new Exception(print_r($department, true));
		return json_encode($department);
	}
	public function actionBranchDepartment($id)
	{
		$department = [];
		$department = Department::find()
			->where(["status" => 1, "branchId" => $id])
			->asArray()
			->orderBy('departmentName')
			->all();
		return json_encode($department);
	}
	public function actionBranchDepartmentFilter($branchId, $companyId)
	{
		$department = [];
		$department = Department::find()
			->select('department.*')
			->JOIN("LEFT JOIN", "branch b", "b.branchId=department.branchId")
			->JOIN("LEFT JOIN", "company c", "c.companyId=b.companyId")
			->where(["department.status" => 1])
			->andFilterWhere([
				"department.branchId" => $branchId,
				"b.companyId" => $companyId
			])
			->asArray()
			->orderBy('department.departmentName')
			->all();
		return json_encode($department);
	}
	public function actionCompanyDepartment($id)
	{
		$department = [];
		$department = Department::find()
			->select('department.*')
			->JOIN("LEFT JOIN", "branch b", "b.branchId=department.branchId")
			->JOIN("LEFT JOIN", "company c", "c.companyId=b.companyId")
			->where(["department.status" => 1, "c.companyId" => $id])
			->asArray()
			->orderBy('department.departmentName')
			->all();
		//throw  new Exception(print_r($department, true));
		return json_encode($department);
	}
	public function actionDepartmentTitle($id)
	{
		$title = Title::find()
			->select('titleId,titleName')
			->where(["departmentId" => $id, "status" => 1])
			->orderBy('layerId')
			->asArray()
			->all();
		return json_encode($title);
	}
}
