<?php

namespace backend\modules\evaluation\controllers;

use backend\models\hrvc\Attribute;
use backend\models\hrvc\Employee;
use backend\models\hrvc\EmployeeEvaluation;
use backend\models\hrvc\EmployeeEvaluator;
use backend\models\hrvc\EmployeePimWeight;
use backend\models\hrvc\Environment;
use backend\models\hrvc\Frame;
use backend\models\hrvc\FrameTerm;
use backend\models\hrvc\Kfi;
use backend\models\hrvc\KfiEmployee;
use backend\models\hrvc\KfiHistory;
use backend\models\hrvc\KfiWeight;
use backend\models\hrvc\Kgi;
use backend\models\hrvc\KgiEmployee;
use backend\models\hrvc\KgiEmployeeWeight;
use backend\models\hrvc\KgiTeam;
use backend\models\hrvc\KgiWeight;
use backend\models\hrvc\Kpi;
use backend\models\hrvc\KpiEmployee;
use backend\models\hrvc\KpiTeam;
use backend\models\hrvc\KpiTeamWeight;
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
	public function actionTermInFrame($frameId)
	{
		$terms = FrameTerm::find()
			->where(["frameId" => $frameId])
			->asArray()
			->orderBy('sort')
			->all();
		$data = [];
		if (isset($terms) && count($terms) > 0) {
			foreach ($terms as $term) :
				$data[$term["termId"]] = [
					"termName" => $term["termName"],
					"startDate" => $term["startDate"],
					"endDate" => $term["endDate"],
					"midDate" => $term["midDate"],
					"isIncludeBonus" => $term["isIncludeBonus"],
					"status" => $term["status"]
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
	public function actionCompanyEmployeePim($companyId, $termId)
	{
		$employees = Employee::find()
			->where(["companyId" => $companyId, "status" => 1])
			->asArray()
			->orderBy('departmentId,titleId,employeeFirstname')
			->all();
		$data = [];
		if (isset($employees) && count($employees) > 0) {
			foreach ($employees as $em) :
				$primaryDetail = EmployeeEvaluator::primaryDetail($em["employeeId"], $termId);
				$finalDetail = EmployeeEvaluator::finalDetail($em["employeeId"], $termId);
				$data[$em["employeeId"]] = [
					"countAssignedKFI" => KfiEmployee::countKfiFromEmployee($em["employeeId"]),
					"countAssignedKGI" => KgiEmployee::countKgiFromEmployee($em["employeeId"]),
					"countAssignedKPI" => KpiEmployee::countKpiFromEmployee($em["employeeId"]),
					"ratioKFI" => KfiEmployee::employeeKfiRatio($em["employeeId"]),
					"ratioKGI" => KgiEmployee::employeeKgiRatio($em["employeeId"]),
					"ratioKPI" => KpiEmployee::employeeKpiRatio($em["employeeId"]),
					"firstName" => $em["employeeFirstname"],
					"sureName" => $em["employeeSurename"],
					"picture" => $em["picture"],
					"primaryName" => $primaryDetail["primaryName"],
					"primaryTitle" =>  $primaryDetail["titleName"],
					"primaryBranch" =>  $primaryDetail["branchName"],
					"finalName" => $finalDetail["finalName"],
					"finalTitle" => $finalDetail["titleName"],
					"finalBranch" => $finalDetail["branchName"],
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
	public function actionMasterKfi($termId, $employeeId)
	{
		$data = [];
		$kfiWeight = KfiWeight::find()
			->select('k.kfiId,k.targetAmount,kfi_weight.weight,k.createDateTime,k.kfiName')
			->JOIN("LEFT JOIN", "kfi k", "kfi_weight.kfiId=k.kfiId")
			->where([
				"kfi_weight.termId" => $termId,
				"k.status" => 1,
				"kfi_weight.status" => 1,
				"kfi_weight.employeeId" => $employeeId

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
	public function actionMasterKgi($termId, $employeeId)
	{
		$employee = Employee::EmployeeDetail($employeeId);
		$teamId = $employee["teamId"];
		$kgiWeight = KgiWeight::find()
			->select('k.kgiId,kt.target,kt.result,kgi_weight.weight,k.createDateTime,k.kgiName,
			kt.kgiTeamId,k.code,kgi_weight.kgiWeightId,kgi_weight.result,kgi_weight.midComment,
			kgi_weight.primaryComment,kgi_weight.firstScore,kgi_weight.finalScore')
			->JOIN("LEFT JOIN", "kgi_team kt", "kt.kgiTeamId=kgi_weight.kgiTeamId")
			->JOIN("LEFT JOIN", "kgi k", "kt.kgiId=k.kgiId")
			->where([
				"kgi_weight.termId" => $termId,
				"kgi_weight.employeeId" => $employeeId,
				"k.status" => 1,
				"kt.teamId" => $teamId,
				"kt.status" => [1, 2, 4],
				"kgi_weight.status" => 1,

			])
			->asArray()
			->orderBy('k.createDateTime DESC')
			->all();
		$data = [];
		if (isset($kgiWeight) && count($kgiWeight) > 0) {
			foreach ($kgiWeight as $kgi) :
				$ratio = 0;
				if ($kgi["target"] == null || $kgi["target"] == '' || $kgi["target"] == 0) {
					$ratio = 0;
				} else {
					if ($kgi["code"] == '<' || $kgi["code"] == '=') {
						$ratio = ((int)$kgi['result'] / (int)$kgi["target"]) * 100;
					} else {
						if ($kgi["result"] != '' && $kgi["result"] != 0) {
							$ratio = ((int)$kgi["target"] / (int)$kgi["result"]) * 100;
						} else {
							$ratio = 0;
						}
					}
				}
				$total = ($kgi["result"] + $kgi["firstScore"] + $kgi["finalScore"]) / 3;
				$data[$kgi["kgiWeightId"]] = [
					"kgiName" => $kgi["kgiName"],
					"target" => $kgi["target"],
					"weight" => $kgi["weight"],
					"ratio" => $ratio,
					"kgiTeamId" => $kgi["kgiTeamId"],
					"kgiId" => $kgi["kgiId"],
					"result" => $kgi["result"],
					"midComment" => $kgi["midComment"],
					"primaryComment" => $kgi["primaryComment"],
					"point" => number_format($total, 1)
				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionMasterKgiEmployee($termId, $employeeId)
	{
		$kgiWeight = KgiEmployeeWeight::find()
			->select('k.kgiId,ke.target,ke.result,kgi_employee_weight.weight,k.createDateTime,k.kgiName,
			ke.kgiEmployeeId,k.code,kgi_employee_weight.kgiEmployeeWeightId,kgi_employee_weight.firstScore,
			kgi_employee_weight.finalScore,kgi_employee_weight.result,kgi_employee_weight.midComment,
			kgi_employee_weight.primaryComment')
			->JOIN("LEFT JOIN", "kgi_employee ke", "ke.kgiEmployeeId=kgi_employee_weight.kgiEmployeeId")
			->JOIN("LEFT JOIN", "kgi k", "ke.kgiId=k.kgiId")
			->where([
				"kgi_employee_weight.termId" => $termId,
				"kgi_employee_weight.employeeId" => $employeeId,
				"k.status" => 1,
				"ke.status" => [1, 2, 4],
				"kgi_employee_weight.status" => 1,

			])
			->asArray()
			->orderBy('k.createDateTime DESC')
			->all();
		$data = [];
		if (isset($kgiWeight) && count($kgiWeight) > 0) {
			foreach ($kgiWeight as $kgi) :
				$ratio = 0;
				if ($kgi["target"] == null || $kgi["target"] == '' || $kgi["target"] == 0) {
					$ratio = 0;
				} else {
					if ($kgi["code"] == '<' || $kgi["code"] == '=') {
						$ratio = ((int)$kgi['result'] / (int)$kgi["target"]) * 100;
					} else {
						if ($kgi["result"] != '' && $kgi["result"] != 0) {
							$ratio = ((int)$kgi["target"] / (int)$kgi["result"]) * 100;
						} else {
							$ratio = 0;
						}
					}
				}
				$total = ($kgi["result"] + $kgi["firstScore"] + $kgi["finalScore"]) / 3;
				$data[$kgi["kgiEmployeeId"]] = [
					"kgiName" => $kgi["kgiName"],
					"target" => $kgi["target"],
					"weight" => $kgi["weight"],
					"ratio" => $ratio,
					"kgiId" => $kgi["kgiId"],
					"kgiEmployeeWeightId" => $kgi["kgiEmployeeWeightId"],
					"result" => $kgi["result"],
					"midComment" => $kgi["midComment"],
					"primaryComment" => $kgi["primaryComment"],
					"point" => number_format($total, 1)
				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionMasterKpi($termId, $employeeId)
	{
		$kpiWeight = KpiWeight::find()
			->select('k.kpiId,ke.target,ke.result,kpi_weight.weight,k.createDateTime,k.kpiName,
			ke.kpiEmployeeId,k.code,kpi_weight.kpiWeightId,kpi_weight.result,kpi_weight.midComment,
			kpi_weight.primaryComment,kpi_weight.firstScore,kpi_weight.finalScore')
			->JOIN("LEFT JOIN", "kpi_employee ke", "ke.kpiEmployeeId=kpi_weight.kpiEmployeeId")
			->JOIN("LEFT JOIN", "kpi k", "kpi_weight.kpiId=k.kpiId")
			->where([
				"kpi_weight.termId" => $termId,
				"kpi_weight.employeeId" => $employeeId,
				"ke.status" => [1, 2, 4],
				"k.status" => 1,
				"kpi_weight.status" => 1
			])
			->asArray()
			->orderBy('k.createDateTime DESC')
			->all();
		$data = [];
		if (isset($kpiWeight) && count($kpiWeight) > 0) {
			foreach ($kpiWeight as $kpi) :
				$ratio = 0;
				if ($kpi["target"] == null || $kpi["target"] == '' || $kpi["target"] == 0) {
					$ratio = 0;
				} else {
					if ($kpi["code"] == '<' || $kpi["code"] == '=') {
						$ratio = ((int)$kpi['result'] / (int)$kpi["target"]) * 100;
					} else {
						if ($kpi["result"] != '' && $kpi["result"] != 0) {
							$ratio = ((int)$kpi["target"] / (int)$kpi["result"]) * 100;
						} else {
							$ratio = 0;
						}
					}
				}
				$total = ($kpi["result"] + $kpi["firstScore"] + $kpi["finalScore"]) / 3;
				$data[$kpi["kpiWeightId"]] = [
					"kpiName" => $kpi["kpiName"],
					"target" => $kpi["target"],
					"weight" => $kpi["weight"],
					"ratio" => $ratio,
					"kpiEmployeeId" => $kpi["kpiEmployeeId"],
					"kpiId" => $kpi["kpiId"],
					"result" => $kpi["result"],
					"midComment" => $kpi["midComment"],
					"primaryComment" => $kpi["primaryComment"],
					"point" => number_format($total, 1)
				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionMasterKpiTeam($termId, $employeeId)
	{
		$kpiWeight = KpiTeamWeight::find()
			->select('k.kpiId,kt.target,kt.result,kpi_team_weight.weight,k.createDateTime,
			k.kpiName,kt.kpiTeamId,k.code,kpi_team_weight.kpiTeamWeightId,kpi_team_weight.result,
			kpi_team_weight.midComment,kpi_team_weight.primaryComment,kpi_team_weight.firstScore,kpi_team_weight.finalScore')
			->JOIN("LEFT JOIN", "kpi_team kt", "kt.kpiTeamId=kpi_team_weight.kpiTeamId")
			->JOIN("LEFT JOIN", "kpi k", "kpi_team_weight.kpiId=k.kpiId")
			->where([
				"kpi_team_weight.termId" => $termId,
				"kpi_team_weight.employeeId" => $employeeId,
				"kt.status" => [1, 2, 4],
				"k.status" => 1,
				"kpi_team_weight.status" => 1,
			])
			->asArray()
			->orderBy('k.createDateTime DESC')
			->all();
		$data = [];
		if (isset($kpiWeight) && count($kpiWeight) > 0) {
			foreach ($kpiWeight as $kpi) :
				$ratio = 0;
				if ($kpi["target"] == null || $kpi["target"] == '' || $kpi["target"] == 0) {
					$ratio = 0;
				} else {
					if ($kpi["code"] == '<' || $kpi["code"] == '=') {
						$ratio = ((int)$kpi['result'] / (int)$kpi["target"]) * 100;
					} else {
						if ($kpi["result"] != '' && $kpi["result"] != 0) {
							$ratio = ((int)$kpi["target"] / (int)$kpi["result"]) * 100;
						} else {
							$ratio = 0;
						}
					}
				}
				$total = ($kpi["result"] + $kpi["firstScore"] + $kpi["finalScore"]) / 3;
				$data[$kpi["kpiTeamWeightId"]] = [
					"kpiName" => $kpi["kpiName"],
					"target" => $kpi["target"],
					"weight" => $kpi["weight"],
					"ratio" => $ratio,
					"kpiTeamId" => $kpi["kpiTeamId"],
					"kpiId" => $kpi["kpiId"],
					"result" => $kpi["result"],
					"midComment" => $kpi["midComment"],
					"primaryComment" => $kpi["primaryComment"],
					"point" => number_format($total, 1)
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
	public function actionKfiWeight($termId, $employeeId)
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
				$level1End = '';
				$level2End = '';
				$level3End = '';
				$level4End = '';
				$level5End = '';
				$level6End = '';
				$weightEnd = 0;
				$statusEnd = 0;
				$kfiWeight = KfiWeight::find()
					->where([
						"kfiId" => $kfi["kfiId"],
						"termId" => $termId,
						"employeeId" => $employeeId
					])
					->asArray()
					->one();
				if (isset($kfiWeight) && !empty($kfiWeight)) {
					$level1 = $kfiWeight["level1"];
					$level2 = $kfiWeight["level2"];
					$level3 = $kfiWeight["level3"];
					$level4 = $kfiWeight["level4"];
					$level5 = $kfiWeight["level5"];
					$level6 = $kfiWeight["level6"];
					$level1End = $kfiWeight["level1End"];
					$level2End = $kfiWeight["level2End"];
					$level3End = $kfiWeight["level3End"];
					$level4End = $kfiWeight["level4End"];
					$level5End = $kfiWeight["level5End"];
					$level6End = $kfiWeight["level6End"];
					$weight = $kfiWeight["weight"];
					$status = $kfiWeight["status"];
					$kfiWeightId = $kfiWeight["kfiWeightId"];
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
					"level1End" => $level1End,
					"level2End" => $level2End,
					"level3End" => $level3End,
					"level4End" => $level4End,
					"level5End" => $level5End,
					"level6End" => $level6End,
					"weight" => $weight,
					"status" => $status,
					"kfiWeightId" => $kfiWeightId
				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionKgiWeight($termId, $employeeId)
	{
		$employee = Employee::EmployeeDetail($employeeId);
		$teamId = $employee["teamId"];
		$kgis = KgiTeam::find()
			->select('kgi_team.kgiId,kgi_team.kgiTeamId,k.kgiName,kgi_team.target')
			->JOIN("LEFT JOIN", "kgi k", "k.kgiId=kgi_team.kgiId")
			->where([
				"kgi_team.teamId" => $teamId,
				"kgi_team.status" => [1, 2, 4],
				"k.status" => [1, 2, 4],
			])
			->asArray()
			->orderBy("k.createDateTime")
			->all();
		$data = [];
		if (isset($kgis) && count($kgis) > 0) {
			foreach ($kgis as $kgi) :
				$level1 = '';
				$level2 = '';
				$level3 = '';
				$level4 = '';
				$level1End = '';
				$level2End = '';
				$level3End = '';
				$level4End = '';
				$weight = 0;
				$status = 0;
				$kgiWeight = KgiWeight::find()
					->where([
						"kgiId" => $kgi["kgiId"],
						"termId" => $termId,
						"kgiTeamId" => $kgi["kgiTeamId"],
						"employeeId" => $employeeId
					])
					->asArray()
					->one();
				if (isset($kgiWeight) && !empty($kgiWeight)) {
					$level1 = $kgiWeight["level1"];
					$level2 = $kgiWeight["level2"];
					$level3 = $kgiWeight["level3"];
					$level4 = $kgiWeight["level4"];
					$level1End = $kgiWeight["level1End"];
					$level2End = $kgiWeight["level2End"];
					$level3End = $kgiWeight["level3End"];
					$level4End = $kgiWeight["level4End"];
					$weight = $kgiWeight["weight"];
					$status = $kgiWeight["status"];
					$data[$kgiWeight["kgiWeightId"]] = [
						"kgiName" => $kgi["kgiName"],
						"target" => $kgi["target"],
						"level1" => $level1,
						"level2" => $level2,
						"level3" => $level3,
						"level4" => $level4,
						"level1End" => $level1End,
						"level2End" => $level2End,
						"level3End" => $level3End,
						"level4End" => $level4End,
						"weight" => $weight,
						"status" => $status,
						"kgiId" => $kgi["kgiId"]
					];
				}

			endforeach;
		}
		return json_encode($data);
	}
	public function actionKgiIndividualWeight($termId, $employeeId)
	{
		$kgis = KgiEmployee::find()
			->select('kgi_employee.kgiId,kgi_employee.kgiEmployeeId,k.kgiName,kgi_employee.target')
			->JOIN("LEFT JOIN", "kgi k", "k.kgiId=kgi_employee.kgiId")
			->where([
				"kgi_employee.employeeId" => $employeeId,
				"kgi_employee.status" => [1, 2, 4],
				"k.status" => [1, 2, 4],
			])
			->asArray()
			->orderBy("k.createDateTime")
			->all();
		$data = [];
		if (isset($kgis) && count($kgis) > 0) {
			foreach ($kgis as $kgi) :
				$level1 = '';
				$level2 = '';
				$level3 = '';
				$level4 = '';
				$level1End = '';
				$level2End = '';
				$level3End = '';
				$level4End = '';
				$kgiEmployeeWeightId = '';
				$weight = 0;
				$status = 0;
				$kgiWeight = KgiEmployeeWeight::find()
					->where([
						"kgiId" => $kgi["kgiId"],
						"termId" => $termId,
						"kgiEmployeeId" => $kgi["kgiEmployeeId"],
						"employeeId" => $employeeId
					])
					->asArray()
					->one();
				if (isset($kgiWeight) && !empty($kgiWeight)) {
					$level1 = $kgiWeight["level1"];
					$level2 = $kgiWeight["level2"];
					$level3 = $kgiWeight["level3"];
					$level4 = $kgiWeight["level4"];
					$level1End = $kgiWeight["level1End"];
					$level2End = $kgiWeight["level2End"];
					$level3End = $kgiWeight["level3End"];
					$level4End = $kgiWeight["level4End"];
					$weight = $kgiWeight["weight"];
					$status = $kgiWeight["status"];
					$kgiEmployeeWeightId = $kgiWeight["kgiEmployeeWeightId"];
				}
				$data[$kgi["kgiEmployeeId"]] = [
					"kgiName" => $kgi["kgiName"],
					"target" => $kgi["target"],
					"level1" => $level1,
					"level2" => $level2,
					"level3" => $level3,
					"level4" => $level4,
					"level1End" => $level1End,
					"level2End" => $level2End,
					"level3End" => $level3End,
					"level4End" => $level4End,
					"weight" => $weight,
					"status" => $status,
					"kgiId" => $kgi["kgiId"],
					"kgiEmployeeWeightId" => $kgiEmployeeWeightId
				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionKpiWeight($termId, $employeeId)
	{
		$kpis = KpiEmployee::find()
			->select('kpi_employee.kpiEmployeeId,k.kpiName,kpi_employee.target,kpi_employee.kpiId')
			->JOIN("LEFT JOIN", "kpi k", "k.kpiId=kpi_employee.kpiId")
			->where([
				"kpi_employee.status" => [1, 2, 4],
				"kpi_employee.employeeId" => $employeeId,
				"k.status" => [1, 2, 4],
			])
			->asArray()
			->orderBy('k.createDateTime')
			->all();
		// $kpis = Kpi::find()->where(["status" => [1, 4]])
		// 	->asArray()
		// 	->orderBy("createDateTime")
		// 	->all();
		$data = [];
		if (isset($kpis) && count($kpis) > 0) {
			foreach ($kpis as $kpi) :
				$level1 = '';
				$level2 = '';
				$level3 = '';
				$level4 = '';
				$level1End = '';
				$level2End = '';
				$level3End = '';
				$level4End = '';
				$weight = 0;
				$status = 0;
				$kpiWeight = KpiWeight::find()
					->where([
						"kpiId" => $kpi["kpiId"],
						"termId" => $termId,
						"kpiEmployeeId" => $kpi["kpiEmployeeId"],
						"employeeId" => $employeeId,
					])
					->asArray()
					->one();
				if (isset($kpiWeight) && !empty($kpiWeight)) {
					$level1 = $kpiWeight["level1"];
					$level2 = $kpiWeight["level2"];
					$level3 = $kpiWeight["level3"];
					$level4 = $kpiWeight["level4"];
					$level1End = $kpiWeight["level1End"];
					$level2End = $kpiWeight["level2End"];
					$level3End = $kpiWeight["level3End"];
					$level4End = $kpiWeight["level4End"];
					$weight = $kpiWeight["weight"];
					$status = $kpiWeight["status"];
					$data[$kpiWeight["kpiWeightId"]] = [
						"kpiName" => $kpi["kpiName"],
						"target" => $kpi["target"],
						"level1" => $level1,
						"level2" => $level2,
						"level3" => $level3,
						"level4" => $level4,
						"level1End" => $level1End,
						"level2End" => $level2End,
						"level3End" => $level3End,
						"level4End" => $level4End,
						"weight" => $weight,
						"status" => $status,
						"kpiId" => $kpi["kpiId"],
						"kpiEmployeeId" => $kpi["kpiEmployeeId"]
					];
				}

			endforeach;
		}
		return json_encode($data);
	}
	public function actionKpiTeamWeight($termId, $employeeId)
	{
		$employee = Employee::EmployeeDetail($employeeId);
		$teamId = $employee["teamId"];
		$kpis = KpiTeam::find()
			->select('kpi_team.kpiId,kpi_team.kpiTeamId,k.kpiName,kpi_team.target')
			->JOIN("LEFT JOIN", "kpi k", "k.kpiId=kpi_team.kpiId")
			->where([
				"kpi_team.teamId" => $teamId,
				"kpi_team.status" => [1, 2, 4],
				"k.status" => [1, 2, 4]
			])
			->asArray()
			->orderBy("k.createDateTime")
			->all();
		$data = [];
		if (isset($kpis) && count($kpis) > 0) {
			foreach ($kpis as $kpi) :
				$level1 = '';
				$level2 = '';
				$level3 = '';
				$level4 = '';
				$level1End = '';
				$level2End = '';
				$level3End = '';
				$level4End = '';
				$weight = 0;
				$status = 0;
				$kpiTeamWeight = KpiTeamWeight::find()
					->where([
						"kpiId" => $kpi["kpiId"],
						"termId" => $termId,
						"kpiTeamId" => $kpi["kpiTeamId"],
						"employeeId" => $employeeId
					])
					->asArray()
					->one();
				if (isset($kpiTeamWeight) && !empty($kpiTeamWeight)) {
					$level1 = $kpiTeamWeight["level1"];
					$level2 = $kpiTeamWeight["level2"];
					$level3 = $kpiTeamWeight["level3"];
					$level4 = $kpiTeamWeight["level4"];
					$level1End = $kpiTeamWeight["level1End"];
					$level2End = $kpiTeamWeight["level2End"];
					$level3End = $kpiTeamWeight["level3End"];
					$level4End = $kpiTeamWeight["level4End"];
					$weight = $kpiTeamWeight["weight"];
					$status = $kpiTeamWeight["status"];
					$data[$kpiTeamWeight["kpiTeamWeightId"]] = [
						"kpiName" => $kpi["kpiName"],
						"target" => $kpi["target"],
						"level1" => $level1,
						"level2" => $level2,
						"level3" => $level3,
						"level4" => $level4,
						"level1End" => $level1End,
						"level2End" => $level2End,
						"level3End" => $level3End,
						"level4End" => $level4End,
						"weight" => $weight,
						"status" => $status,
						"kpiId" => $kpi["kpiId"],
						"kpiTeamId" => $kpi["kpiTeamId"]
					];
				}

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
	public function actionEmployeeEvaluator($employeeId, $termId)
	{
		$primaryDetail = EmployeeEvaluator::primaryDetail($employeeId, $termId);
		$finalDetail = EmployeeEvaluator::finalDetail($employeeId, $termId);
		$data = [
			"primaryName" => $primaryDetail["primaryName"],
			"primaryTitle" =>  $primaryDetail["titleName"],
			"primaryBranch" =>  $primaryDetail["branchName"],
			"finalName" => $finalDetail["finalName"],
			"finalTitle" => $finalDetail["titleName"],
			"finalBranch" => $finalDetail["branchName"],
			"primaryPic" => $primaryDetail["picture"],
			"finalPic" => $finalDetail["picture"],
		];
		return json_encode($data);
	}
	public function actionEmployeeTermWeight($employeeId, $termId)
	{
		$employeePimWeight = EmployeePimWeight::find()
			->where(["employeeId" => $employeeId, "termId" => $termId, "status" => 1])
			->asArray()
			->one();
		$data = [
			"kfiWeight" => "",
			"kgiWeight" => "",
			"kpiWeight" => ""

		];
		if (isset($employeePimWeight) && !empty($employeePimWeight)) {
			$data = [
				"kfiWeight" => number_format($employeePimWeight["kfiWeight"]),
				"kgiWeight" =>  number_format($employeePimWeight["kgiWeight"]),
				"kpiWeight" =>  number_format($employeePimWeight["kpiWeight"])
			];
		}
		return json_encode($data);
	}
	public function actionEmployeeTermKfi($employeeId, $termId)
	{
		$kfiWeight = KfiWeight::find()
			->select('k.kfiName,k.kfiName,kfi_weight.kfiId,kfi_weight.kfiWeightId,k.targetAmount,
			kfi_weight.weight,kfi_weight.result,kfi_weight.midComment,kfi_weight.primaryComment,kfi_weight.firstScore,kfi_weight.finalScore')
			->JOIN("LEFT JOIN", "kfi k", "k.kfiId=kfi_weight.kfiId")
			->where(["kfi_weight.employeeId" => $employeeId, "kfi_weight.termId" => $termId, "kfi_weight.status" => 1])
			->asArray()
			->orderBy('kfi_weight.kfiId')
			->all();
		$data = [];
		if (isset($kfiWeight) && count($kfiWeight) > 0) {
			foreach ($kfiWeight as $kfi) :
				$kfiHistory = KfiHistory::find()
					->where(["kfiId" => $kfi["kfiId"], "status" => [1, 2]])
					->orderBy('kfiHistoryId DESC')->one();
				$ratio = 0;
				if (isset($kfiHistory) && !empty($kfiHistory)) {
					if ($kfi["targetAmount"] == null || $kfi["targetAmount"] == '' || $kfi["targetAmount"] == 0) {
						$ratio = 0;
					} else {
						if ($kfiHistory["code"] == '<' || $kfiHistory["code"] == '=') {
							$ratio = ((int)$kfiHistory['result'] / (int)$kfi["targetAmount"]) * 100;
						} else {
							//$ratio = ((int)$kfi['targetAmount'] / (int)$kfiHistory["result"]) * 100;
							if ($kfiHistory["result"] != '' && $kfiHistory["result"] != 0) {
								$ratio = ((int)$kfi["targetAmount"] / (int)$kfiHistory["result"]) * 100;
							} else {
								$ratio = 0;
							}
						}
					}
				}
				$total = ($kfi["result"] + $kfi["firstScore"] + $kfi["finalScore"]) / 3;
				$data[$kfi["kfiId"]] = [
					"kfiWeightId" => $kfi["kfiWeightId"],
					"result" => $kfi["result"],
					"midComment" => $kfi["midComment"],
					"primaryComment" => $kfi["primaryComment"],
					"kfiName" => $kfi["kfiName"],
					"target" => $kfi["targetAmount"],
					"weight" => number_format($kfi["weight"]),
					"ratio" => number_format($ratio),
					"point" => number_format($total, 1)
				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionIndividualKfiWeight($kfiWeightId)
	{
		$kfiWeight = KfiWeight::find()
			->where([
				"kfiWeightId" => $kfiWeightId,
			])
			->asArray()
			->one();
		$data = [];
		$status = 204; // no content
		if (isset($kfiWeight) && !empty($kfiWeight)) {
			$status = 200;
			$data = [
				"status" => $status,
				"termId" => $kfiWeight["termId"],
				"firstScore" => $kfiWeight["firstScore"],
				"finalScore" => $kfiWeight["finalScore"],
				"firstComment" => $kfiWeight["firstComment"],
				"finalComment" => $kfiWeight["finalComment"],
				"employeeId" => $kfiWeight["employeeId"],
			];
		} else {
			$data = [
				"status" => $status
			];
		}
		return json_encode($data);
	}
	public function actionIndividualKgiWeight($kgiEmployeeWeightId)
	{
		$kgiEmployeeWeight = KgiEmployeeWeight::find()
			->where([
				"kgiEmployeeWeightId" => $kgiEmployeeWeightId,
			])
			->asArray()
			->one();
		$data = [];
		$status = 204; // no content
		if (isset($kgiEmployeeWeight) && !empty($kgiEmployeeWeight)) {
			$status = 200;
			$data = [
				"status" => $status,
				"termId" => $kgiEmployeeWeight["termId"],
				"firstScore" => $kgiEmployeeWeight["firstScore"],
				"finalScore" => $kgiEmployeeWeight["finalScore"],
				"firstComment" => $kgiEmployeeWeight["firstComment"],
				"finalComment" => $kgiEmployeeWeight["finalComment"],
				"employeeId" => $kgiEmployeeWeight["employeeId"],
			];
		} else {
			$data = [
				"status" => $status
			];
		}
		return json_encode($data);
	}
	public function actionTeamKgiWeight($kgiWeightId)
	{
		$kgiTeamWeight = KgiWeight::find()
			->where([
				"kgiWeightId" => $kgiWeightId,
			])
			->asArray()
			->one();
		$data = [];
		$status = 204; // no content
		if (isset($kgiTeamWeight) && !empty($kgiTeamWeight)) {
			$status = 200;
			$data = [
				"status" => $status,
				"termId" => $kgiTeamWeight["termId"],
				"firstScore" => $kgiTeamWeight["firstScore"],
				"finalScore" => $kgiTeamWeight["finalScore"],
				"firstComment" => $kgiTeamWeight["firstComment"],
				"finalComment" => $kgiTeamWeight["finalComment"],
				"employeeId" => $kgiTeamWeight["employeeId"],
			];
		} else {
			$data = [
				"status" => $status
			];
		}
		return json_encode($data);
	}
	public function actionTeamKpiWeight($kpiTeamWeightId)
	{
		$kpiTeamWeight = KpiTeamWeight::find()
			->where([
				"kpiTeamWeightId" => $kpiTeamWeightId,
			])
			->asArray()
			->one();
		$data = [];
		$status = 204; // no content
		if (isset($kpiTeamWeight) && !empty($kpiTeamWeight)) {
			$status = 200;
			$data = [
				"status" => $status,
				"termId" => $kpiTeamWeight["termId"],
				"firstScore" => $kpiTeamWeight["firstScore"],
				"finalScore" => $kpiTeamWeight["finalScore"],
				"firstComment" => $kpiTeamWeight["firstComment"],
				"finalComment" => $kpiTeamWeight["finalComment"],
				"employeeId" => $kpiTeamWeight["employeeId"],
			];
		} else {
			$data = [
				"status" => $status
			];
		}
		return json_encode($data);
	}
	public function actionEmployeeKpiWeight($kpiEmployeeWeightId)
	{
		$kpiEmployeeWeight = KpiWeight::find()
			->where([
				"kpiWeightId" => $kpiEmployeeWeightId,
			])
			->asArray()
			->one();
		$data = [];
		$status = 204; // no content
		if (isset($kpiEmployeeWeight) && !empty($kpiEmployeeWeight)) {
			$status = 200;
			$data = [
				"status" => $status,
				"termId" => $kpiEmployeeWeight["termId"],
				"firstScore" => $kpiEmployeeWeight["firstScore"],
				"finalScore" => $kpiEmployeeWeight["finalScore"],
				"firstComment" => $kpiEmployeeWeight["firstComment"],
				"finalComment" => $kpiEmployeeWeight["finalComment"],
				"employeeId" => $kpiEmployeeWeight["employeeId"],
			];
		} else {
			$data = [
				"status" => $status
			];
		}
		return json_encode($data);
	}
}
