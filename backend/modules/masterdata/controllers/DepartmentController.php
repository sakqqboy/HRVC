<?php

namespace backend\modules\masterdata\controllers;


use backend\models\hrvc\Department;
use backend\models\hrvc\Title;
use common\models\ModelMaster;
use Exception;
use Yii;
use yii\web\Controller;
use yii\web\Response;

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
	
	public function actionIndex($id,$page,$limit)
{

	$offset = ($page - 1) * $limit;
	$indexGrid = [];

    $query = Department::find()
        ->select([
            'd.departmentId',
            'd.departmentName',
            'd.branchId',
            'b.branchName',
            'b.companyId',
            'c.companyName',
            'c.picture',
            'c.city',
            'c.countryId',
            'cu.countryName',
            'cu.flag'
        ])
        ->alias('d')
        ->leftJoin('branch b', 'b.branchId = d.branchId')
        ->leftJoin('company c', 'c.companyId = b.companyId')
        ->leftJoin('country cu', 'cu.countryId = c.countryId')
        ->where(['d.status' => 1]);

		if ($limit > 0) {
			$query ->offset($offset)
			->limit($limit);
		}

        $indexGrid = $query
		->asArray()
		->all();

    return json_encode($indexGrid);
}

	public function actionEncodeParamsPage() {
		Yii::$app->response->format = Response::FORMAT_JSON;
	
		$countryId = Yii::$app->request->post('countryId');
		$page = Yii::$app->request->post('page');
		$nextPage = Yii::$app->request->post('nextPage');

		// throw new exception(print_r($nextPage, true));

		$url =  ModelMaster::encodeParams(['countryId' => $countryId, 'nextPage' => $nextPage]);
	
		if($page == 'grid') {
			return $this->redirect(Yii::$app->homeUrl . 'setting/branch/company-grid-filter/'. $url );
		}else if($page == 'list') {
			return $this->redirect(Yii::$app->homeUrl . 'setting/branch/index-filter/'. $url );
		}else{
			if($page == 'view'){
				return $this->redirect(Yii::$app->homeUrl . 'setting/branch/branch-view/'. $url );
			}
			return "eror";
		}
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
	public function actionBranchDepartment($id,$page,$limit)
	{
		// $department = Department::find()
		// 	->where(["status" => 1, "branchId" => $id])
		// 	->asArray()
		// 	->orderBy('departmentName')
		// 	->all();

			$offset = ($page - 1) * $limit;

			$department = [];
		
	
			$query = Department::find()
			->select('department.*')
			->join('LEFT JOIN', 'branch b', 'b.branchId = department.branchId')
			->join('LEFT JOIN', 'company c', 'c.companyId = b.companyId')
			->where(['department.status' => 1, 'department.branchId' => $id]);
			
			if ($limit > 0) {
				$query ->offset($offset)
				->limit($limit);
			}
	
			$department = $query
				->asArray()
				->orderBy('departmentName')
				->all();

		return json_encode($department);
	}
	public function actionBranchDepartmentFilter($id,$companyId,$page,$limit)
	{
		$department = [];
		$department = Department::find()
			->select('department.*')
			->JOIN("LEFT JOIN", "branch b", "b.branchId=department.branchId")
			->JOIN("LEFT JOIN", "company c", "c.companyId=b.companyId")
			->where(["department.status" => 1])
			->asArray()
			->orderBy('department.departmentName')
			->all();
		
		$offset = ($page - 1) * $limit;

		$department = [];

		$query = Department::find()
			->select('department.*')
			->join('LEFT JOIN', 'branch b', 'b.branchId = department.branchId')
			->join('LEFT JOIN', 'company c', 'c.companyId = b.companyId')
			->where(['department.status' => 1]);

		if ($id > 0) {
			$query->andFilterWhere([
				'department.branchId' => $id
			]);
		}

		if ($companyId > 0) {
			$query->andFilterWhere([
				'b.companyId' => $companyId
			]);
		}

		if ($limit > 0) {
			$query->offset($offset)
				->limit($limit);
		}

		$department = $query
			->asArray()
			->orderBy('department.departmentName')
			->all();

		return json_encode($department);

		// return json_encode($limit);
		

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

	public function actionDepartmentPage($id,$page,$countryId ,$limit)
    {
        
        $query =  Department::find()
		->select('department.*')
		->join('LEFT JOIN', 'branch b', 'b.branchId = department.branchId')
		->join('LEFT JOIN', 'company c', 'c.companyId = b.companyId')
		->where(['department.status' => 1]);
		
		if ($id != 0) {
            $query->andWhere(["department.branchId" => $id]);
        }
    

        if ($countryId != 0) {
            $query->andWhere(["c.countryId" => $countryId]);
        }
    
        $totalRows = $query->count(); // นับหลังจากใส่เงื่อนไขทั้งหมดแล้ว
    
        $totalPages = ceil($totalRows / $limit);
    
        return json_encode([
            'totalPages' => $totalPages,
            'totalRows' => $totalRows,
            'perPage' => $limit,
            'nowPage' => $page
        ]);

		// return json_encode($id);
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