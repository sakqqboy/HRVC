<?php

namespace backend\modules\evaluation\controllers;

use backend\models\hrvc\Attribute;
use backend\models\hrvc\Environment;
use backend\models\hrvc\Frame;
use backend\models\hrvc\FrameTerm;
use backend\models\hrvc\TermItem;
use common\models\ModelMaster;
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
	public function actionEnvironmentDetail($environmentId)
	{
		$environment = Environment::find()
			->select('environment.environmentId,environment.status,c.picture,b.branchName,
			country.countryName,country.flag,c.city,c.companyName')
			->JOIN("LEFT JOIN", "company c", "c.companyId=environment.companyId")
			->JOIN("LEFT JOIN", "country", "c.countryId=country.countryId")
			->JOIN("LEFT JOIN", "branch b", "b.branchId=environment.branchId")
			->where(["environmentId" => $environmentId])
			->asArray()
			->one();
		$data = [];
		if (isset($environment) && count($environment) > 0) {
			$data = [
				"status" => $environment["status"],
				"picture" => $environment["picture"],
				"branchName" => $environment["branchName"],
				"countryName" => $environment["countryName"],
				"city" => $environment["city"],
				"flag" => $environment["flag"],
				"companyName" => $environment["companyName"]
				//"totalFrame" => Frame::countEnvironment($environment["environmentId"]),
			];
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
	public function actionEnvironmentFrame($environmentId)
	{
		$frames = Frame::find()
			->select('frame.*,a.attributeName,a.attributeId')
			->JOIN("LEFT JOIN", "attribute a", "a.attributeId=frame.attributeId")
			->where(["frame.environmentId" => $environmentId])
			->asArray()
			->orderBy('frame.createDateTime')
			->all();
		return json_encode($frames);
	}
	public function actionFrameTermWithItems($frameId)
	{
		$terms = FrameTerm::find()
			->where(["frameId" => $frameId])
			->asArray()
			->orderBy('sort')
			->all();
		$data = [];
		if (isset($terms) && count($terms) > 0) {
			foreach ($terms as $term) :
				$termItems = TermItem::find()
					->select('ts.stepName,term_item.*')
					->JOIN("LEFT JOIN", "term_step ts", "ts.stepId=term_item.stepId")
					->where(["term_item.termId" => $term["termId"]])
					->orderBy('ts.sort')
					->asArray()
					->all();
				$items = [];
				if (isset($termItems) && count($termItems) > 0) {
					foreach ($termItems as $item) :
						$items[$item["termItemId"]] = [
							"termId" => $item["termId"],
							"stepId" => $item["stepId"],
							"stepName" => $item["stepName"],
							"startDate" => ModelMaster::dateFullFormat($item["startDate"]),
							"finishDate" => ModelMaster::dateFullFormat($item["finishDate"]),
							"status" => $item["status"],
							"duration" => ModelMaster::dateDuration($item["startDate"], $item["finishDate"])
						];
					endforeach;
				}
				$data[$term["termId"]] = [
					"termName" => $term["termName"],
					"startDate" => ModelMaster::dateFullFormat($term["startDate"]),
					"finishDate" => ModelMaster::dateFullFormat($term["endDate"]),
					"startDateValue" => $term["startDate"],
					"finishDateValue" => $term["endDate"],
					"midDateValue" => $term["midDate"],
					"minDate" => ModelMaster::dateFullFormat($term["midDate"]),
					"isBonus" => (int)$term["isIncludeBonus"],
					"items" => $items
				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionFrameDetail($frameId)
	{
		$frame = Frame::find()->where(["frameId" => $frameId])->asArray()->one();
		$terms = FrameTerm::find()
			->where(["frameId" => $frameId])
			->asArray()
			->orderBy('sort')
			->all();
		$allTerm = [];
		if (isset($terms) && count($terms) > 0) {
			foreach ($terms as $term) :
				$allTerm[$term["termId"]] = [
					"termName" => $term["termName"],
					"status" => $term["status"]
				];
			endforeach;
		}
		$data = [
			"frameName" => $frame["frameName"],
			"startDate" => ModelMaster::engDate($frame["startDate"], 2),
			"finishDate" => ModelMaster::engDate($frame["endDate"], 2),
			"status" => $frame["status"],
			"allTerm" => $allTerm
		];
		return json_encode($data);
	}
	public function actionTermDetail($termId)
	{
		$term = FrameTerm::find()
			->where(["termId" => $termId])
			->orderBy('sort')
			->asArray()
			->one();
		$data = [];
		if (isset($term) && !empty($term)) {
			$termItems = TermItem::find()
				->select('ts.stepName,term_item.*')
				->JOIN("LEFT JOIN", "term_step ts", "term_item.stepId=ts.stepId")
				->where(["term_item.termId" => $termId])
				->asArray()
				->orderBy('ts.sort')
				->all();
			$items = [];
			if (isset($termItems) && count($termItems) > 0) {
				foreach ($termItems as $item) :
					$items[$item["termItemId"]] = [
						"stepName" => $item["stepName"],
						"startDate" => ModelMaster::dateFullFormat($item["startDate"]),
						"finishDate" => ModelMaster::dateFullFormat($item["finishDate"]),
						"duration" => ModelMaster::dateDuration($item["startDate"], $item["finishDate"])
					];
				endforeach;
			}
			$data = [
				"termId" => $term["termId"],
				"termName" => $term["termName"],
				"frameId" => $term["frameId"],
				"startDate" => ModelMaster::engDate($term["startDate"], 2),
				"endDate" => ModelMaster::engDate($term["endDate"], 2),
				"midDate" => ModelMaster::engDate($term["midDate"], 2),
				"items" => $items
			];
		}
		return json_encode($data);
	}
}
