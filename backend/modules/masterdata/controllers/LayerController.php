<?php

namespace backend\modules\masterdata\controllers;

use backend\models\hrvc\Layer;
use Exception;
use yii\web\Controller;
use Yii;
use yii\web\Response;

/**
 * Default controller for the `masterdata` module
 */
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
class LayerController extends Controller
{
	public function beforeAction($action)
	{
		$authHeader = Yii::$app->request->getHeaders()->get('TcgHrvcAuthorization');

		if (!$authHeader || $authHeader !== '9f1b3c4d5e6a7b8c9d0e1f2a3b4c5d6e') {
			Yii::$app->response->format = Response::FORMAT_JSON;
			Yii::$app->response->statusCode = 401;
			Yii::$app->response->data = [
				'status' => 'error',
				'message' => 'Invalid or missing token.'
			];
			return false;
		}

		return parent::beforeAction($action);
	}
	public function actionAllLayer()
	{
		$layer = Layer::find()
			->where(["status" => 1])
			->orderBy('priority')
			->asArray()
			->orderBy('layerId ASC')
			->all();
		return json_encode($layer);
	}
}