<?php

namespace backend\modules\evaluation\controllers;

use backend\models\hrvc\Rank;
use yii\web\Controller;

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
class RankController extends Controller
{
	public function actionIndex($termId)
	{
		$ranks = Rank::find()
			->where(
				["termId" => $termId]
			)->asArray()
			->orderBy('increasement')
			->all();
		$data = [];
		if (isset($ranks) && count($ranks) > 0) {
			foreach ($ranks as $rank) :
				$data[$rank["rankId"]] = [
					"rankName" => $rank["rankName"],
					"min" => $rank["min"],
					"max" => $rank["max"],
					"increasement" => $rank["increasement"],
					"bonus" => $rank["bonusRate"]
				];
			endforeach;
		}
		return json_encode($data);
	}
}
