<?php

namespace backend\modules\masterdata\controllers;

use backend\models\hrvc\Branch;
use backend\models\hrvc\Team;
use Exception;
use yii\web\Controller;

/**
 * Default controller for the `masterdata` module
 */
class TeamController extends Controller
{

	public function actionIndex()
	{
		// return $this->render('index');
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
	public function actionDepartmentTeam($id)
	{
		$teams = [];
		$teams = Team::find()
			->select("teamName,teamId")
			->where(["departmentId" => $id, "status" => 1])
			->asArray()
			->all();
		return json_encode($teams);
	}
}
