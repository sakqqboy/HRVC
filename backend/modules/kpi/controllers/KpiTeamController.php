<?php

namespace backend\modules\kpi\controllers;

use backend\models\hrvc\KpiTeam;
use Exception;
use yii\web\Controller;

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
class KpiTeamController extends Controller
{
	public function actionKpiTeam($kpiId)
	{
		$kpiTeams = KpiTeam::find()
			->select('kpi_team.teamId,t.teamName,kpi_team.target')
			->JOIN("LEFT JOIN", "team t", "t.teamId=kpi_team.teamId")
			->where(["kpi_team.status" => [1, 2, 4]])
			->andWhere(["kpi_team.kpiId" => $kpiId])
			->orderBy('t.teamName')
			->asArray()
			->all();
		return json_encode($kpiTeams);
	}
}
