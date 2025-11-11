<?php

namespace backend\modules\masterdata\controllers;

use backend\models\hrvc\Branch;
use backend\models\hrvc\Company;
use backend\models\hrvc\Employee;
use common\helpers\Path;
use Exception;
use yii\web\Controller;
use Yii;
use yii\web\Response;

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
	public function beforeAction($action)
	{
		$authHeader = Yii::$app->request->getHeaders()->get('TcgHrvcAuthorization');

		if (!$authHeader || $authHeader !== '9f1b3c4d5e6a7b8c9d0e1f2a3b4c5d6e') {
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

		if (isset($company) && !empty($company)) {
			$banner = 'image/company.jpg';
			$picture = 'image/no-company.svg';
			if ($company["banner"] != '') {
				$url1 = Path::frontendUrl() . $company["banner"];
				$headers = @get_headers($url1);
				if ($headers !== false && strpos($headers[0], '200') !== false) {
					$banner = $company["banner"];
				}
			}
			if ($company["picture"] != '') {
				$url2 = Path::frontendUrl() . $company["picture"];
				$headers2 = @get_headers($url2);
				if ($headers2 !== false && strpos($headers2[0], '200') !== false) {
					$picture = $company["picture"];
				}
			}
			$company["banner"] = $banner;
			$company["picture"] = $picture;
		}
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
