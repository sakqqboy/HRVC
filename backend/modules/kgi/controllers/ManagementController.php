<?php

namespace backend\modules\kgi\controllers;

use backend\models\hrvc\Branch;
use backend\models\hrvc\Company;
use backend\models\hrvc\Country;
use backend\models\hrvc\Kgi;
use backend\models\hrvc\KgiBranch;
use backend\models\hrvc\KgiTeam;
use backend\models\hrvc\Unit;
use common\models\ModelMaster;
use yii\web\Controller;

/**
 * Default controller for the `masterdata` module
 */
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
class ManagementController extends Controller
{
	public function actionIndex()
	{
		$kgis = Kgi::find()->where(["status" => [1, 4]])->asArray()->all();
		$data = [];
		if (count($kgis) > 0) {
			foreach ($kgis as $kgi) :
				$ratio = 0;
				if ($kgi["targetAmount"] != '' && $kgi["targetAmount"] != 0 && $kgi["targetAmount"] != null) {
					$ratio = ($kgi["result"] / $kgi["targetAmount"]) * 100;
				}
				$data[$kgi["kgiId"]] = [
					"kgiName" => $kgi["kgiName"],
					"companyName" => Company::companyName($kgi["companyId"]),
					"branch" => KgiBranch::kgiBranch($kgi["kgiId"]),
					"quantRatio" => $kgi["quantRatio"],
					"targetAmount" => number_format($kgi["targetAmount"], 2),
					"code" => $kgi["code"],
					"result" => number_format($kgi["result"], 2),
					"unit" => Unit::unitName($kgi["unitId"]),
					"month" => ModelMaster::monthEng($kgi['month'], 1),
					"priority" => $kgi["priority"],
					"ratio" => number_format($ratio, 2),
					"periodCheck" => ModelMaster::engDate($kgi["periodDate"], 2),
					"nextCheck" => "",
					"countTeam" => KgiTeam::kgiTeam($kgi["kgiId"]),
					"flag" => "",
					"employee" => "",
					"countryName" => Country::countryNameBycompany($kgi['companyId']),
					//"team" => KgiTeam::kgiTeam($kgi["kgiId"])
				];
			endforeach;
		}
		return json_encode($data);
	}
}
