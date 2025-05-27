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
class TeamController extends Controller
{

	
	public function actionIndex($id,$page = null, $limit = null)
	{

		$offset = ($page - 1) * $limit;
		$indexGrid = [];

		$query = Department::find()
		->select([
			'd.departmentId',
			'd.departmentName',
			'd.branchId',
			'b.branchName',
			'b.description',
			'b.companyId',
			'c.companyName',
			'c.picture',
			'c.city',
			'c.countryId',
			'cu.countryName',
			'cu.flag',
		])
		->alias('d')
		->leftJoin('branch b', 'b.branchId = d.branchId')
		->leftJoin('company c', 'c.companyId = b.companyId')
		->leftJoin('country cu', 'cu.countryId = c.countryId')
		->where(['d.status' => 1]);
			
			if (!empty($id)) {
			// if ($id > 0) {
				$query->andWhere(["d.departmentId" => $id]);
			}

			if (!empty($limit)) {
			// if ($limit > 0) {
				$query ->offset($offset)
				->limit($limit);
			}

			$indexGrid = $query
			->asArray()
			->all();

		return json_encode($indexGrid);
	}

	public function actionIndexFilter($departmentId,$branchId,$companyId,$page,$limit)
	{

		$offset = ($page - 1) * $limit;
		$indexGrid = [];

		$query = Department::find()
		->select([
			'd.departmentId',
			'd.departmentName',
			'd.branchId',
			'b.branchName',
			'b.description',
			'b.companyId',
			'c.companyName',
			'c.picture',
			'c.city',
			'c.countryId',
			'cu.countryName',
			'cu.flag',
		])
		->alias('d')
		->leftJoin('branch b', 'b.branchId = d.branchId')
		->leftJoin('company c', 'c.companyId = b.companyId')
		->leftJoin('country cu', 'cu.countryId = c.countryId')
		->where(['d.status' => 1]);

		
			if (!empty($companyId)) {
			// if ($companyId > 0) {
				$query->andWhere(["b.companyId" => $companyId]);
			}
			if (!empty($branchId)) {
			// if ($branchId > 0) {
				$query->andWhere(["d.branchId" => $branchId]);
			}
			if (!empty($departmentId)) {
			// if ($departmentId > 0) {
				$query->andWhere(["d.departmentId" => $departmentId]);
			}

			if (!empty($limit)) {
			// if ($limit > 0) {
				$query ->offset($offset)
				->limit($limit);
			}

			$indexGrid = $query
			->asArray()
			->all();

		return json_encode($indexGrid);
	}

	public function actionAllTeamsDetail()
	{
		$teams = [];
		$teams = Team::find()
			->select('team.teamName,d.departmentName,b.branchName,c.companyName,co.flag,team.teamId,co.countryName')
			->JOIN("LEFT JOIN", "department d", "d.departmentId=team.departmentId")
			->JOIN("LEFT JOIN", "branch b", "b.branchId=d.branchId")
			->JOIN("LEFT JOIN", "company c", "c.companyId=b.companyId")
			->JOIN("LEFT JOIN", "country co", "co.countryId=c.countryId")
			->where(["team.status" => 1])
			->orderBy('team.teamName')
			->asArray()
			->all();
		return json_encode($teams);
	}
	public function actionCompanyTeam($id)
	{
		$teams = [];
		$teams = Team::find()
			->select('team.teamName,d.departmentName,b.branchName,c.companyName,co.flag,team.teamId,co.countryName')
			->JOIN("LEFT JOIN", "department d", "d.departmentId=team.departmentId")
			->JOIN("LEFT JOIN", "branch b", "b.branchId=d.branchId")
			->JOIN("LEFT JOIN", "company c", "c.companyId=b.companyId")
			->JOIN("LEFT JOIN", "country co", "co.countryId=c.countryId")
			->where([
				"team.status" => 1,
				"d.status" => 1,
				"b.status" => 1,
				"c.status" => 1,
				"c.companyId" => $id
			])
			->orderBy('team.teamName')
			->asArray()
			->all();
		return json_encode($teams);
	}
	public function actionTeamDetail($id)
	{
		$teams = [];
		$teams = Team::find()
			->select('team.teamName,d.departmentName,b.branchName,c.companyName,co.flag,team.teamId,co.countryName')
			->JOIN("LEFT JOIN", "department d", "d.departmentId=team.departmentId")
			->JOIN("LEFT JOIN", "branch b", "b.branchId=d.branchId")
			->JOIN("LEFT JOIN", "company c", "c.companyId=b.companyId")
			->JOIN("LEFT JOIN", "country co", "co.countryId=c.countryId")
			->where(["team.teamId" => $id])
			->asArray()
			->one();
		return json_encode($teams);
	}
	public function actionDepartmentTeam($id,$page = null, $limit = null)
	{
		// $teams = [];
		// $teams = Team::find()
		// 	->select("teamName,teamId")
		// 	->where(["departmentId" => $id, "status" => 1])
		// 	->asArray()
		// 	->all();

		$offset = ($page - 1) * $limit;

			$teams = [];
		
	
			$query = Team::find()
			->select("teamName,teamId")
			->where(["departmentId" => $id, "status" => 1]);
			
			// if ($limit > 0) {
			if (!empty($limit)) {
				$query ->offset($offset)
				->limit($limit);
			}
	
			$teams = $query
				->asArray()
				->all();

		return json_encode($teams);
	}
	
	public function actionTeamPage($id,$page ,$limit)
    {
        
      $query = Team::find()
		->select('team.*')
		->join('LEFT JOIN', 'department d', 'd.departmentId = team.departmentId')
		->where(['team.status' => 1]);

		if (!empty($id)) {
			$query->andWhere(['team.departmentId' => $id]);
		}
		$totalRows = $query->count(); // นับจำนวนแถวทั้งหมดตามเงื่อนไข
		$totalPages = ceil($totalRows / $limit);

		// ดึงข้อมูลตามเงื่อนไข พร้อมใส่ limit/offset ถ้าจำเป็น
		// $data = $query->asArray()->all();

		return json_encode([
            'totalPages' => $totalPages,
            'totalRows' => $totalRows,
            'perPage' => $limit,
            'nowPage' => $page
        ]);

	}

	public function actionTeamPageFilter($id,$page ,$limit)
    {
        
        $query =  Team::find()
		->select('team.*')	
		->join('LEFT JOIN', 'department d', 'd.departmentId = team.departmentId')
		->where(['team.status' => 1]);

		if (!empty($id)) {
			$query->andWhere(["team.departmentId" => $id]);
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

}