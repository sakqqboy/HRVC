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
			->select('companyName,companyId,picture')
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
		$branches = Branch::find()
		->select([
			'branch.*',
			'co.countryName',
			'c.companyName',
			'c.picture',
			'co.flag',
			'c.city'
		])
		->join('LEFT JOIN', 'company c', 'branch.companyId = c.companyId')
		->join('LEFT JOIN', 'country co', 'co.countryId = c.countryId')
		->where(['branch.companyId' => $id])
		->orderBy(['c.companyName' => SORT_ASC])
		->asArray()
		->all();

		return json_encode($branches);
	}

	public function actionCompanyBranchFilter($id)
	{
		$branches = Branch::find()
		->select([
			'branch.*',
			'co.countryName',
			'c.companyName',
			'c.picture',
			'co.flag',
			'c.city'
		])
		->join('LEFT JOIN', 'company c', 'branch.companyId = c.companyId')
		->join('LEFT JOIN', 'country co', 'co.countryId = c.countryId')
		->where(['branch.companyId' => $id])
		->orderBy(['c.companyName' => SORT_ASC])
		->asArray()
		->all();

		return json_encode($branches);
	}



	// public function actionCompanyGroupFilter($id, $countryId, $page,$limit)
	// {
	// 	// if($page == 'list'){
	// 	//     $limit = 7;
	// 	// }else{
	// 	//     $limit = 6;
	// 	// }
	
	// 	// $limit = 6;
	
	// 	$offset = ($page - 1) * $limit;
	
	// 	$query = Company::find()
	// 		->select('company.companyName, company.companyId, company.city, c.countryName,
	// 				  company.picture, company.headQuaterId, company.industries, g.groupName, 
	// 				  c.flag, company.about')
	// 		->join("LEFT JOIN", "country c", "c.countryId = company.countryId")
	// 		->join("LEFT JOIN", "`group` g", "g.groupId = company.groupId")
	// 		->where(["company.groupId" => $id, "company.status" => 1]);
	
	// 	if (!empty($countryId)) {
	// 		$query->andWhere(["company.countryId" => $countryId]);
	// 	}
	
	// 	$company = $query
	// 		->offset($offset)
	// 		->limit($limit)
	// 		->orderBy('company.companyName')
	// 		->asArray()
	// 		->all();
	
	// 	return json_encode($company);
	// }
}