<?php

namespace backend\modules\kgi\controllers;

use backend\models\hrvc\GroupHasKgi;
use backend\models\hrvc\KgiGroup;
use backend\models\hrvc\KgiTeam;
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
}
