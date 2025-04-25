<?php

namespace backend\modules\masterdata\controllers;

use backend\models\hrvc\Branch;
use backend\models\hrvc\Department;
use backend\models\hrvc\Team;
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
class BranchController extends Controller
{

	public function actionIndex()
	{
		// return $this->render('index');
	}
	public function actionCompanyBranch($id) //companyId
	{
		$branch = [];
		$branch = Branch::find()
			->select('branch.*,co.countryName,c.companyName,c.picture,co.flag,c.city')
			->JOIN("LEFT JOIN", "company c", "branch.companyId=c.companyId")
			->JOIN("LEFT JOIN", "country co", "co.countryId=c.countryId")
			->where(["branch.status" => 1, "branch.companyId" => $id])
			->orderBy('branch.branchName')
			->asArray()
			->all();
		return json_encode($branch);
	}
	
	public function actionActiveBranch()
	{
		$branch = [];
		$branch = Branch::find()
			->select('branch.*,co.countryName,c.companyName,c.picture,co.flag,c.city')
			->JOIN("LEFT JOIN", "company c", "branch.companyId=c.companyId")
			->JOIN("LEFT JOIN", "country co", "co.countryId=c.countryId")
			->where(["branch.status" => 1])
			->orderBy('c.companyName')
			->asArray()->all();
		return json_encode($branch);
	}

	public function actionActiveBranchFilter($id, $countryId, $page,$limit)
	{

		$offset = ($page - 1) * $limit;

		$branch = [];
		// $branch = Branch::find()
		// 	->select('branch.*,co.countryName,c.companyName,c.picture,co.flag,c.city')
		// 	->JOIN("LEFT JOIN", "company c", "branch.companyId=c.companyId")
		// 	->JOIN("LEFT JOIN", "country co", "co.countryId=c.countryId")
		// 	->where(["branch.status" => 1])
		// 	->orderBy('c.companyName')
		// 	->asArray()->all();
		
		$query = Branch::find()
			->select('branch.*, co.countryName, c.companyName, c.picture, co.flag, c.city')
			->join('LEFT JOIN', 'company c', 'branch.companyId = c.companyId')
			->join('LEFT JOIN', 'country co', 'co.countryId = c.countryId')
			->where(['branch.status' => 1]);

		if (!empty($countryId)) {
			$query->andWhere(['c.countryId' => $countryId]);
		}

		$branch = $query
			->offset($offset)
			->limit($limit)
			->orderBy('c.companyName')
			->asArray()
			->all();

	
			
		return json_encode($branch);	
	}


		
    public function actionBranchPage($page,$countryId ,$limit)
    {
        
        $query = Branch::find()
            ->where(["branch.status" => 1]);
    
        if ($countryId != 0) {
            $query->andWhere(["branch.countryId" => $countryId]);
        }
    
        $totalRows = $query->count(); // นับหลังจากใส่เงื่อนไขทั้งหมดแล้ว
    
        $totalPages = ceil($totalRows / $limit);
    
        return json_encode([
            'totalPages' => $totalPages,
            'totalRows' => $totalRows,
            'perPage' => $limit,
            'nowPage' => $page
        ]);
    }

	public function actionBranchDetail($id)
	{

		$branch = [];
		$branch = Branch::find()
			->where(["branchId" => $id])
			->asArray()
			->orderBy('branchName')
			->one();
		return json_encode($branch);
	}
	
	public function actionBranchTeam($id)
	{
		$team = [];
		$department = Department::find()
			->where(["branchId" => $id, "status" => 1])
			->asArray()
			->all();
		if (isset($department) && count($department) > 0) {
			foreach ($department as $dep) :
				$teams = Team::find()
					->where(["departmentId" => $dep["departmentId"], "status" => 1])
					->asArray()
					->orderBy('teamName')
					->all();
				if (isset($teams) && count($teams) > 0) {
					foreach ($teams as $t) :
						$team[$t["teamId"]] = [
							"teamId" => $t['teamId'],
							"teamName" => $t["teamName"]
						];
					endforeach;
				}
			endforeach;
		}
		return json_encode($team);
	}
}