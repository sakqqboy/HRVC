<?php

namespace backend\modules\kgi\controllers;

use backend\models\hrvc\GroupHasKgi;
use backend\models\hrvc\KgiGroup;
use backend\models\hrvc\KgiTeam;
use backend\models\hrvc\KgiTeamHistory;
use common\models\ModelMaster;
use Exception;
use yii\web\Controller;

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
class KgiTeamController extends Controller
{
	public function actionKgiTeam($kgiId)
	{
		$kgiTeams = KgiTeam::find()
			->select('kgi_team.teamId,t.teamName,kgi_team.target')
			->JOIN("LEFT JOIN", "team t", "t.teamId=kgi_team.teamId")
			->where(["kgi_team.status" => [1, 2, 4], "t.status" => [1, 2, 4]])
			->andWhere(["kgi_team.kgiId" => $kgiId])
			->orderBy('t.teamId')
			->asArray()
			->all();
		return json_encode($kgiTeams);
	}
	public function actionKgiTeamHistory($kgiId, $teamId)
	{
		$kgiTeamHistory = KgiTeamHistory::find()
			->select('kgi_team_history.*,e.employeeFirstname,e.employeeSurename')
			->JOIN("LEFT JOIN", "kgi_team kt", "kt.kgiTeamId=kgi_team_history.kgiTeamId")
			->JOIN("LEFT JOIN", "user u", "u.userId=kgi_team_history.createrId")
			->JOIN("LEFT JOIN", "employee e", "e.employeeId=u.employeeId")
			->where([
				"kt.kgiId" => $kgiId,
				"kt.teamId" => $teamId
			])
			->orderBy('kgi_team_history.createDateTime DESC')
			->asArray()
			->all();
		if (!isset($kgiTeamHistory) || count($kgiTeamHistory) == 0) {
			$kgiTeamHistory = KgiTeam::find()
				->select('kgi_team.*,e.employeeFirstname,e.employeeSurename')
				->JOIN("LEFT JOIN", "user u", "u.userId=kgi_team.createrId")
				->JOIN("LEFT JOIN", "employee e", "e.employeeId=u.employeeId")
				->where([
					"kgi_team..kgiId" => $kgiId,
					"kgi_team..teamId" => $teamId
				])
				->asArray()
				->all();
		}
		return json_encode($kgiTeamHistory);
	}
	public function actionAllTeamKgi()
	{
		$kgiTeams = KgiTeam::find()
			->select('k.kgiName,k.unitId,k.quantio,k.priority,k.amountType,k.code,kgi_team.kgiTeamId')
			->JOIN("LEFT JOIN", "kgi k", "k.kgiId=kgi_team.kgiId")
			->JOIN("LEFT JOIN", "team t", "t.teamId=kgi_team.teamId")
			->where(["kgi_team.status" => [1, 2, 4], "k.status" => [1, 2, 4]])
			->orderBy("k.createDateTime DESC,t.teamName ASC")
			->asArray()
			->all();
		if (isset($kgiTeams) && count($kgiTeams) > 0) {
			foreach ($kgiTeams as $kgiTeam) :
				$kgiTeamHistory = KgiTeamHistory::find()
					->where(["kgiTeamId" => $kgiTeam["kgiTeamId"]])
					->asArray()
					->orderBy('createDateTime DESC')
					->one();
				if (!isset($kgiTeamHistory) || empty($kgiTeamHistory)) {
					$kgiTeamHistory = KgiTeam::find()
						->where(["kgiTeamId" => $kgiTeam["kgiTeamId"]])
						->asArray()
						->orderBy('createDateTime DESC')
						->one();
				}
			endforeach;
		}
	}
}
