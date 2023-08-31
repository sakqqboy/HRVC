<?php

namespace backend\modules\masterdata\controllers;

use backend\models\hrvc\Title;
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
class TitleController extends Controller
{
	public function actionTitleList()
	{
		$titles = Title::find()->select('titleId,titleName')->where(["status" => 1])->asArray()->all();
		return json_encode($titles);
	}
}
