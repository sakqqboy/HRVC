<?php

namespace backend\modules\masterdata\controllers;

use backend\models\hrvc\Title;
use Exception;
use yii\web\Controller;

/**
 * Default controller for the `masterdata` module
 */
class TitleController extends Controller
{
	public function actionTitleList()
	{
		$titles = Title::find()->select('titleId,titleName')->where(["status" => 1])->asArray()->all();
		return json_encode($titles);
	}
}
