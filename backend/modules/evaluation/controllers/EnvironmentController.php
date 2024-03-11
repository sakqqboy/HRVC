<?php

namespace backend\modules\evaluation\controllers;

use backend\models\hrvc\Attribute;
use backend\models\hrvc\Environment;
use backend\models\hrvc\Frame;
use yii\web\Controller;

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
class EnvironmentController extends Controller
{
	public function actionIndex()
	{
		$environments = Environment::find()
			->select('environment.environmentId,environment.status,c.picture,b.branchName,
			country.countryName,country.flag,c.city')
			->JOIN("LEFT JOIN", "company c", "c.companyId=environment.companyId")
			->JOIN("LEFT JOIN", "country", "c.countryId=country.countryId")
			->JOIN("LEFT JOIN", "branch b", "b.branchId=environment.branchId")
			->where("environment.status!=99")
			->asArray()
			->orderBy('environment.createDateTime DESC')
			->all();
		$data = [];
		if (isset($environments) && count($environments) > 0) {
			foreach ($environments as $environment) :
				$data[$environment["environmentId"]] = [
					"status" => $environment["status"],
					"picture" => $environment["picture"],
					"branchName" => $environment["branchName"],
					"countryName" => $environment["countryName"],
					"city" => $environment["city"],
					"flag" => $environment["flag"],
					"totalFrame" => Frame::countEnvironment($environment["environmentId"]),
				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionAttribute()
	{
		$attribute = Attribute::find()->where(["status" => 1])
			->select('attributeName,round,attributeId')
			->asArray()
			->orderBy('attributeId ASC')
			->all();
		return json_encode($attribute);
	}
}
