<?php

namespace backend\modules\evaluation\controllers;

use backend\models\hrvc\Attribute;
use backend\models\hrvc\Employee;
use backend\models\hrvc\EmployeeEvaluation;
use backend\models\hrvc\Environment;
use backend\models\hrvc\Frame;
use backend\models\hrvc\FrameTerm;
use backend\models\hrvc\Kfi;
use backend\models\hrvc\KfiEmployee;
use backend\models\hrvc\KfiWeight;
use backend\models\hrvc\Kgi;
use backend\models\hrvc\KgiEmployee;
use backend\models\hrvc\KgiWeight;
use backend\models\hrvc\Kpi;
use backend\models\hrvc\KpiEmployee;
use backend\models\hrvc\KpiWeight;
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
					"countAssignedKFI" => KfiEmployee::countKfiFromEmployee($em["employeeId"]),
					"countAssignedKGI" => KgiEmployee::countKgiFromEmployee($em["employeeId"]),
					"countAssignedKPI" => KpiEmployee::countKpiFromEmployee($em["employeeId"]),
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
				"pimWeightId" => $pimTerm["pimWeightId"],
				"kfi" => $pimTerm["kfiWeight"],
				"kgi" =>  $pimTerm["kgiWeight"],
				"kpi" =>  $pimTerm["kpiWeight"],
			];
		}
		return json_encode($data);
	}
	public function actionMasterKfi($termId)
	{
		$data = [];
		$kfiWeight = KfiWeight::find()
			->select('k.kfiId,k.targetAmount,kfi_weight.weight,k.createDateTime,k.kfiName')
			->JOIN("LEFT JOIN", "kfi k", "kfi_weight.kfiId=k.kfiId")
			->where([
				"kfi_weight.termId" => $termId,
				"k.status" => 1,
				"kfi_weight.status" => 1,

			])
			->asArray()
			->orderBy('k.createDateTime DESC')
			->all();
		if (isset($kfiWeight) && count($kfiWeight) > 0) {
			foreach ($kfiWeight as $kfi) :
				$data[$kfi["kfiId"]] = [
					"kfiName" => $kfi["kfiName"],
					"target" => $kfi["targetAmount"],
					"weight" => $kfi["weight"]
				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionMasterKgi($termId)
	{
		$kgiWeight = KgiWeight::find()
			->select('k.kgiId,k.targetAmount,kgi_weight.weight,k.createDateTime,k.kgiName')
			->JOIN("LEFT JOIN", "kgi k", "kgi_weight.kgiId=k.kgiId")
			->where([
				"kgi_weight.termId" => $termId,
				"k.status" => 1,
				"kgi_weight.status" => 1,

			])
			->asArray()
			->orderBy('k.createDateTime DESC')
			->all();
		if (isset($kgiWeight) && count($kgiWeight) > 0) {
			foreach ($kgiWeight as $kgi) :
				$data[$kgi["kgiId"]] = [
					"kgiName" => $kgi["kgiName"],
					"target" => $kgi["targetAmount"],
					"weight" => $kgi["weight"]
				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionMasterKpi($termId)
	{
		$kpiWeight = KpiWeight::find()
			->select('k.kpiId,k.targetAmount,kpi_weight.weight,k.createDateTime,k.kpiName')
			->JOIN("LEFT JOIN", "kpi k", "kpi_weight.kpiId=k.kpiId")
			->where([
				"kpi_weight.termId" => $termId,
				"k.status" => 1,
				"kpi_weight.status" => 1,

			])
			->asArray()
			->orderBy('k.createDateTime DESC')
			->all();
		if (isset($kpiWeight) && count($kpiWeight) > 0) {
			foreach ($kpiWeight as $kpi) :
				$data[$kpi["kpiId"]] = [
					"kpiName" => $kpi["kpiName"],
					"target" => $kpi["targetAmount"],
					"weight" => $kpi["weight"]
				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionPimWeight($termId)
	{
		$pimWeight = PimWeight::find()->where(["termId" => $termId])->asArray()->one();
		if (isset($pimWeight) && !empty($pimWeight)) {
			$data = [
				"kfi" => $pimWeight["kfiWeight"],
				"kgi" => $pimWeight["kgiWeight"],
				"kpi" => $pimWeight["kpiWeight"]
			];
		} else {
			$data = [
				"kfi" => 0,
				"kgi" => 0,
				"kpi" => 0
			];
		}
		return json_encode($data);
	}
	public function actionKfiWeight($termId)
	{
		$kfis = Kfi::find()->where(["status" => [1, 4]])
			->asArray()
			->orderBy("createDateTime")
			->all();
		$data = [];
		if (isset($kfis) && count($kfis) > 0) {
			foreach ($kfis as $kfi) :
				$level1 = '';
				$level2 = '';
				$level3 = '';
				$level4 = '';
				$level5 = '';
				$level6 = '';
				$weight = 0;
				$status = 0;
				$kfiWeight = KfiWeight::find()
					->where(["kfiId" => $kfi["kfiId"], "termId" => $termId])
					->asArray()
					->one();
				if (isset($kfiWeight) && !empty($kfiWeight)) {
					$level1 = $kfiWeight["level1"];
					$level2 = $kfiWeight["level2"];
					$level3 = $kfiWeight["level3"];
					$level4 = $kfiWeight["level4"];
					$level5 = $kfiWeight["level5"];
					$level6 = $kfiWeight["level6"];
					$weight = $kfiWeight["weight"];
					$status = $kfiWeight["status"];
				}
				$data[$kfi["kfiId"]] = [
					"kfiName" => $kfi["kfiName"],
					"target" => $kfi["targetAmount"],
					"level1" => $level1,
					"level2" => $level2,
					"level3" => $level3,
					"level4" => $level4,
					"level5" => $level5,
					"level6" => $level6,
					"weight" => $weight,
					"status" => $status
				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionKgiWeight($termId)
	{
		$kgis = Kgi::find()->where(["status" => [1, 4]])
			->asArray()
			->orderBy("createDateTime")
			->all();
		$data = [];
		if (isset($kgis) && count($kgis) > 0) {
			foreach ($kgis as $kgi) :
				$level1 = '';
				$level2 = '';
				$level3 = '';
				$level4 = '';
				$weight = 0;
				$status = 0;
				$kgiWeight = KgiWeight::find()
					->where(["kgiId" => $kgi["kgiId"], "termId" => $termId])
					->asArray()
					->one();
				if (isset($kfiWeight) && !empty($kfiWeight)) {
					$level1 = $kgiWeight["level1"];
					$level2 = $kgiWeight["level2"];
					$level3 = $kgiWeight["level3"];
					$level4 = $kgiWeight["level4"];
					$weight = $kgiWeight["weight"];
					$status = $kgiWeight["status"];
				}
				$data[$kgi["kgiId"]] = [
					"kgiName" => $kgi["kgiName"],
					"target" => $kgi["targetAmount"],
					"level1" => $level1,
					"level2" => $level2,
					"level3" => $level3,
					"level4" => $level4,
					"weight" => $weight,
					"status" => $status
				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionKpiWeight($termId)
	{
		$kpis = Kpi::find()->where(["status" => [1, 4]])
			->asArray()
			->orderBy("createDateTime")
			->all();
		$data = [];
		if (isset($kpis) && count($kpis) > 0) {
			foreach ($kpis as $kpi) :
				$level1 = '';
				$level2 = '';
				$level3 = '';
				$level4 = '';
				$weight = 0;
				$status = 0;
				$kpiWeight = KpiWeight::find()
					->where(["kpiId" => $kpi["kpiId"], "termId" => $termId])
					->asArray()
					->one();
				if (isset($kfiWeight) && !empty($kfiWeight)) {
					$level1 = $kpiWeight["level1"];
					$level2 = $kpiWeight["level2"];
					$level3 = $kpiWeight["level3"];
					$level4 = $kpiWeight["level4"];
					$weight = $kpiWeight["weight"];
					$status = $kpiWeight["status"];
				}
				$data[$kpi["kpiId"]] = [
					"kpiName" => $kpi["kpiName"],
					"target" => $kpi["targetAmount"],
					"level1" => $level1,
					"level2" => $level2,
					"level3" => $level3,
					"level4" => $level4,
					"weight" => $weight,
					"status" => $status
				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionPimCountEmployee($termId)
	{
		$pimWeight = PimWeight::find()->select('pimWeightId')
			->where(["termId" => $termId])
			->asArray()
			->one();
		$data = [];
		if (isset($pimWeight) && !empty($pimWeight)) {
			$employee = EmployeeEvaluation::find()
				->select('e.picture,e.employeeId')
				->JOIN("LEFT JOIN", "employee e", "e.employeeId=employee_evaluation.employeeId")
				->where(["pimWeightId" => $pimWeight["pimWeightId"]])
				->asArray()
				->all();
			if (isset($employee) && count($employee) > 0) {
				foreach ($employee as $em) :
					$data[$em["employeeId"]] = [
						"picture" => $em["picture"]
					];
				endforeach;
			}
		}
		return json_encode($data);
	}
}
