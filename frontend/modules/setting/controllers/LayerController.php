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
			$tagArr = explode(' ', $subLayerName);
			if (count($tagArr) > 1) {
				$firstDigit = substr($tagArr[0], 0, 1);
				$secondDigit = substr($tagArr[1], 0, 1);
				$tag = strtoupper($firstDigit) . strtoupper($secondDigit);
			} else {
				$firstDigit = substr($tagArr[0], 0, 1);
				$secondDigit = substr($tagArr[0], 1, 1);
				$tag = strtoupper($firstDigit) . strtoupper($secondDigit);
			}
			$subLayer = new SubLayer();
			$subLayer->layerId = $layerId;
			$subLayer->subLayerName = $subLayerName;
			$subLayer->shortTag = $tag;
			$subLayer->status = 1;
			$subLayer->createDateTime = new Expression('NOW()');
			$subLayer->updateDateTime = new Expression('NOW()');
			$subLayer->save(false);
			$res["status"] = true;
		}
		$textSub = '';
		$subLayers = SubLayer::find()
			->select('shortTag')
			->where(["layerId" => $layerId])
			->orderBy('shortTag')
			->asArray()
			->all();
		if (isset($subLayers) && count($subLayers) > 0) {
			foreach ($subLayers as $sub) :
				$textSub .= $sub["shortTag"] . '<br>';
			endforeach;
		}
		$res["tag"] = $textSub;
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
			$text = '';
			if ($layerName != '') {
				$layer = Layer::find()->where(["layerId" => $layerId])->one();
				$layer->layerName = $layerName;
				$layer->save(false);
				$res["status"] = true;
				$textArr = explode(" ", $layerName);
				$text .= $textArr[0];
				if (isset($textArr[1])) {
					$text .= '<p>' . $textArr[1] . '</p>';
				}
				if (isset($textArr[2])) {
					$text .= '<p>' . $textArr[2] . '</p>';
				}
				if (isset($textArr[3])) {
					$text .= '<p>' . $textArr[3] . '</p>';
				}
				$res["layerName"] = $text;
			} else {
				$res["status"] = false;
			}
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
	public function actionAddNewLayer()
	{
		$priority = $_POST["priority"];
		$layer = new Layer();
		$layer->layerName = 'Name this layer';
		$layer->priority = $priority;
		$layer->shortTag = "Short Tag";
		$layer->status = 1;
		$layer->createDateTime = new Expression('NOW()');
		$layer->updateDateTime = new Expression('NOW()');
		if ($layer->save(false)) {
			$res["status"] = true;
		} else {
			$res["status"] = false;
		}
		return json_encode($res);
	}
	public function actionDeleteLayer()
	{
		$layerId = $_POST["layerId"];
		$layer = Layer::find()->where(["layerId" => $layerId])->one();
		SubLayer::updateAll(["status" => 99], ["layerId" => $layerId]);
		$layer->status = 99;
		if ($layer->save(false)) {
			$res["status"] = true;
		} else {
			$res["status"] = false;
		}
		return json_encode($res);
	}
	public function actionShowSubLayer()
	{
		$text = '';
		$layerId = $_POST["layerId"];
		$subLayers = SubLayer::find()->where(["layerId" => $layerId, "status" => 1])->all();
		$layer = Layer::find()->select('layerName')->where(["layerId" => $layerId])->asArray()->one();
		if (count($subLayers) > 0) {
			$text = $this->renderAjax('update_sub', [
				"subLayers" => $subLayers,
				"layerId" => $layerId,
				"layerName" => $layer["layerName"]
			]);
		}

		$res["status"] = true;
		$res["subLayerText"] = $text;

		return json_encode($res);
	}
	public function actionUpdateSubLayerName()
	{
		$subLayerId = $_POST["subLayerId"];
		$subLayerName = $_POST["subLayerName"];
		$layerId = $_POST["layerId"];
		$check = SubLayer::find()
			->select('subLayerId')
			->where(["subLayerName" => $subLayerName, "layerId" => $layerId])
			->andWhere("subLayerId!=$subLayerId")
			->asArray()
			->one();
		if (isset($check) && !empty($check)) {
			$res["status"] = false;
		} else {
			if ($subLayerName != '') {
				$subLayer = SubLayer::find()->where(["subLayerId" => $subLayerId])->one();
				$subLayer->subLayerName = $subLayerName;
				$subLayer->save(false);
				$res["status"] = true;
			} else {
				$res["status"] = false;
			}
		}
		return json_encode($res);
	}
	public function actionUpdateSubLayerTag()
	{
		$subLayerId = $_POST["subLayerId"];
		$tag = $_POST["tag"];
		$subLayer = SubLayer::find()->where(["subLayerId" => $subLayerId])->one();
		$layerId = $subLayer->layerId;
		$subLayer->shortTag = $tag;
		$subLayer->save(false);
		$textSub = '';
		$subLayers = SubLayer::find()
			->select('sub_layer.shortTag,l.priority')
			->JOIN("LEFT JOIN", "layer l", "l.layerId=sub_layer.layerId")
			->where(["sub_layer.layerId" => $layerId])
			->orderBy('l.priority')
			->asArray()
			->all();
		if (isset($subLayers) && count($subLayers) > 0) {
			foreach ($subLayers as $sub) :
				$textSub .= $sub["shortTag"] . '<br>';
			endforeach;
		}
		$res["status"] = true;
		$res["tag"] = $textSub;
		$res["layerId"] = $layerId;
		return json_encode($res);
	}
}
