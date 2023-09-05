<?php

namespace frontend\modules\setting\controllers;

use common\helpers\Path;
use frontend\models\hrvc\Layer;
use frontend\models\hrvc\SubLayer;
use yii\db\Expression;
use yii\web\Controller;

/**
 * Default controller for the `setting` module
 */
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
class LayerController extends Controller
{
	public function actionIndex()
	{
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/layer/all-layer');
		$layers = curl_exec($api);
		curl_close($api);
		$layers = json_decode($layers, true);
		return $this->render('index', [
			"layers" => $layers
		]);
	}
	public function actionAddSubLayer()
	{

		$layerId = $_POST["layerId"];
		$subLayerName = $_POST["sublayerName"];
		$check = SubLayer::find()
			->select('subLayerId')
			->where(["layerId" => $layerId, "subLayerName" => $subLayerName])
			->asArray()
			->one();
		if (isset($check) && !empty($check)) {
			$res["status"] = false;
		} else {
			$subLayer = new SubLayer();
			$subLayer->layerId = $layerId;
			$subLayer->subLayerName = $subLayerName;
			$subLayer->status = 1;
			$subLayer->createDateTime = new Expression('NOW()');
			$subLayer->updateDateTime = new Expression('NOW()');
			$subLayer->save(false);
			$res["status"] = true;
		}
		return json_encode($res);
	}
	public function actionUpdateLayerName()
	{
		$layerId = $_POST["layerId"];
		$layerName = $_POST["layerName"];
		$check = Layer::find()
			->select('layerId')
			->where(["layerName" => $layerName])
			->andWhere("layerId!=$layerId")
			->asArray()
			->one();
		if (isset($check) && !empty($check)) {
			$res["status"] = false;
		} else {
			$layer = Layer::find()->where(["layerId" => $layerId])->one();
			$layer->layerName = $layerName;
			$layer->save(false);
			$res["status"] = true;
		}
		return json_encode($res);
	}
	public function actionUpdateLayerTag()
	{
		$layerId = $_POST["layerId"];
		$tag = $_POST["tag"];
		$layer = Layer::find()->where(["layerId" => $layerId])->one();
		$layer->shortTag = $tag;
		$layer->save(false);
		$res["status"] = true;
		return json_encode($res);
	}
}
