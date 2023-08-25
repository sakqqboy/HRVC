<?php

namespace backend\modules\masterdata\controllers;

use backend\models\hrvc\Status;
use Exception;
use yii\web\Controller;

/**
 * Default controller for the `masterdata` module
 */
class StatusController extends Controller
{
	public function actionActiveStatus()
	{
		$status = Status::find()->where(["status" => 1])->asArray()->orderBy('statusId')->all();
		return json_encode($status);
	}
}
