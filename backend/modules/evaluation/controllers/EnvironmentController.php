<?php

namespace backend\modules\evaluation\controllers;

use backend\models\hrvc\Attribute;
use backend\models\hrvc\Employee;
use backend\models\hrvc\Environment;
use backend\models\hrvc\Frame;
use backend\models\hrvc\FrameTerm;
use backend\models\hrvc\MasterKfiEvaluation;
use backend\models\hrvc\MasterKgiEvaluation;
use backend\models\hrvc\MasterKpiEvaluation;
use backend\models\hrvc\PimWeight;
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
			country.countryName,country.flag,c.city,c.companyId')
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
					"companyId" => $environment["companyId"],
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
			country.countryName,country.flag,c.city,c.companyName,environment.branchId,environment.companyId')
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
				"companyName" => $environment["companyName"],
				"companyId" => $environment["companyId"],
				"branchId" => $environment["branchId"]
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
	public function actionCompanyEmployeePim($companyId)
	{
		$employees = Employee::find()
			->where(["companyId" => $companyId, "status" => 1])
			->asArray()->orderBy('departmentId,titleId,employeeFirstname')
			->all();
		$data = [];
		if (isset($employees) && count($employees) > 0) {
			foreach ($employees as $em) :

				$data[$em["employeeId"]] = [
					// "assignedKFI"=>"",
					// "assignedKFGI"=>"",
					// "assignedKPI"=>"",
					"firstName" => $em["employeeFirstname"],
					"sureName" => $em["employeeSurename"],
					"picture" => $em["picture"],
				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionPimTerm($termId)
	{
		$pimTerm = PimWeight::find()->where(["termId" => $termId, "status" => 1])->asArray()->one();
		$data = [
			"kfi" => 0,
			"kgi" => 0,
			"kpi" => 0,
		];
		if (isset($pimTerm) && !empty($pimTerm)) {
			$data = [
				"kfi" => $pimTerm["kfiWeight"],
				"kgi" =>  $pimTerm["kgiWeight"],
				"kpi" =>  $pimTerm["kpiWeight"],
			];
		}
		return json_encode($data);
	}
	public function actionMasterKfi($termId)
	{
		$pimTerm = PimWeight::find()->where(["termId" => $termId, "status" => 1])->asArray()->one();
		$data = [];
		if (isset($pimTerm) && !empty($pimTerm)) {
			$pimWeightId = $pimTerm["pimWeightId"];
			$masterKfi = MasterKfiEvaluation::find()
				->select('k.kfiId,k.targetAmount,master_kfi_evaluation.weight')
				->JOIN("LEFT JOIN", "kfi k", "master_kfi_evaluation.kfiId=k.kfiId")
				->where([
					"master_kfi_evaluation.pimWeightId" => $pimWeightId,
					"k.status" => 1,
					"master_kfi_evaluation.status" => 1,

				])
				->asArray()
				->orderBy('createDateTime DESC')
				->all();
			if (isset($masterKfi) && count($masterKfi) > 0) {
				foreach ($masterKfi as $kfi) :
					$data[$kfi["mKfiId"]] = [
						"kfiName" => $kfi["kfiname"],
						"target" => $kfi["targetAmount"],
						"weight" => $kfi["weight"]

					];
				endforeach;
			}
		}
		return json_encode($data);
	}
	public function actionMasterKgi($termId)
	{
		$pimTerm = PimWeight::find()->where(["termId" => $termId, "status" => 1])->asArray()->one();
		$data = [];
		if (isset($pimTerm) && !empty($pimTerm)) {
			$pimWeightId = $pimTerm["pimWeightId"];
			$masterKgi = MasterKgiEvaluation::find()
				->select('k.kgiId,k.targetAmount,master_kgi_evaluation.weight')
				->JOIN("LEFT JOIN", "kgi k", "master_kgi_evaluation.kgiId=k.kgiId")
				->where([
					"master_kgi_evaluation.pimWeightId" => $pimWeightId,
					"k.status" => 1,
					"master_kgi_evaluation.status" => 1,

				])
				->asArray()
				->orderBy('createDateTime DESC')
				->all();
			if (isset($masterKgi) && count($masterKgi) > 0) {
				foreach ($masterKgi as $kgi) :
					$data[$kgi["mKgiId"]] = [
						"kgiName" => $kgi["kginame"],
						"target" => $kgi["targetAmount"],
						"weight" => $kgi["weight"],
						"code" => $kgi["code"]
					];
				endforeach;
			}
		}
		return json_encode($data);
	}
	public function actionMasterKpi($termId)
	{
		$pimTerm = PimWeight::find()->where(["termId" => $termId, "status" => 1])->asArray()->one();
		$data = [];
		if (isset($pimTerm) && !empty($pimTerm)) {
			$pimWeightId = $pimTerm["pimWeightId"];
			$masterKpi = MasterKpiEvaluation::find()
				->select('k.kpiId,k.targetAmount,master_kpi_evaluation.weight')
				->JOIN("LEFT JOIN", "kpi k", "master_kpi_evaluation.kpiId=k.kpiId")
				->where([
					"master_kpi_evaluation.pimWeightId" => $pimWeightId,
					"k.status" => 1,
					"master_kpi_evaluation.status" => 1,

				])
				->asArray()
				->orderBy('createDateTime DESC')
				->all();
			if (isset($masterKpi) && count($masterKpi) > 0) {
				foreach ($masterKpi as $kpi) :
					$data[$kpi["mKpiId"]] = [
						"kpiName" => $kpi["kpiname"],
						"target" => $kpi["targetAmount"],
						"weight" => $kpi["weight"],
						"code" => $kpi["code"]
					];
				endforeach;
			}
		}
		return json_encode($data);
	}
}
