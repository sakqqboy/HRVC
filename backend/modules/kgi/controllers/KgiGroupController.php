<?php

namespace backend\modules\kgi\controllers;

use backend\models\hrvc\GroupHasKgi;
use backend\models\hrvc\KgiGroup;
use common\models\ModelMaster;
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
class KgiGroupController extends Controller
{
	public function actionIndex()
	{
		$kgiGroup = KgiGroup::find()
			->where(["status" => 1])
			->asArray()
			->orderBy("createDateTime DESC")
			->all();
		return json_encode($kgiGroup);
	}
	public function actionKgiGroupDetail($kgiGroupId)
	{
		$kgiGroup = KgiGroup::find()
			->where(["kgiGroupId" => $kgiGroupId])
			->asArray()
			->one();
		return json_encode($kgiGroup);
	}
	public function actionCompanyKgiGroup($companyId)
	{
		$kgiGroup = KgiGroup::find()
			->where(["status" => 1, "companyId" => $companyId])
			->asArray()
			->all();
		return json_encode($kgiGroup);
	}
}
