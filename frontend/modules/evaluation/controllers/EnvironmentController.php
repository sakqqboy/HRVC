<?php

namespace frontend\modules\evaluation\controllers;


use common\carlendar\Carlendar;
use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
use frontend\models\hrvc\Attribute;
use frontend\models\hrvc\Branch;
use frontend\models\hrvc\Company;
use frontend\models\hrvc\EmployeeEvaluation;
use frontend\models\hrvc\Environment;
use frontend\models\hrvc\Frame;
use frontend\models\hrvc\FrameTerm;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\KfiWeight;
use frontend\models\hrvc\KgiWeight;
use frontend\models\hrvc\KpiWeight;
use frontend\models\hrvc\PimWeight;
use frontend\models\hrvc\TermItem;
use frontend\models\hrvc\TermStep;
use Yii;
use yii\db\Expression;
use yii\web\Controller;

class EnvironmentController extends Controller
{
	public function beforeAction($action)
	{
		if (!Yii::$app->user->id) {
			return $this->redirect(Yii::$app->homeUrl . 'site/login');
		}
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		return true; //go to origin request
	}
	public function actionIndex()
	{
		$groupId = Group::currentGroupId();

		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$companies = curl_exec($api);
		$companies = json_decode($companies, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/index');
		$environments = curl_exec($api);
		$environments = json_decode($environments, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/attribute');
		$attribute = curl_exec($api);
		$attribute = json_decode($attribute, true);

		curl_close($api);

		$date = date('Y-m-d');
		$dateValue = Carlendar::currentMonth($date);
		$thisMonth = ModelMaster::monthEng(date('m'), 1);
		$thisYear = date('Y');

		if (isset($_POST["companyId"]) && $_POST["companyId"] != '') {
			$environment = new Environment();
			$environment->companyId = $_POST["companyId"];
			$environment->branchId = $_POST["branchId"];
			$environment->status = 1;
			$environment->isAllEmployee = isset($_POST["allEmployee"]) ? 1 : 0;
			$environment->createDateTime = new Expression('NOW()');
			$environment->updateDateTime = new Expression('NOW()');
			if ($environment->save(false)) {
				return $this->redirect($_POST["previousUrl"]);
			}
		}
		return $this->render('index', [
			"companies" => $companies,
			"environments" => $environments,
			"dateValue" => $dateValue,
			"thisMonth" => $thisMonth,
			"thisYear" => $thisYear,
			"attribute" => $attribute
		]);
	}
	public function actionCreateFrame()
	{
		//throw new Exception(print_r(Yii::$app->request->post(), true));
		$fromDateArr = explode('/', $_POST["fromDate"]);
		$fromDate = $fromDateArr[2] . '-' . $fromDateArr[1] . '-' . $fromDateArr[0];
		$toDateArr = explode('/', $_POST["toDate"]);
		$toDate = $toDateArr[2] . '-' . $toDateArr[1] . '-' . $toDateArr[0];
		$frame = new Frame();
		$frame->frameName = $_POST["frameName"];
		$frame->environmentId = $_POST["environmentId"];
		$frame->startDate = $fromDate;
		$frame->endDate = $toDate;
		$frame->attributeId = $_POST["attribute"];
		$frame->isMid = $_POST["isMid"];
		$frame->status = 1;
		$frame->createDateTime = new Expression('NOW()');
		$frame->updateDateTime = new Expression('NOW()');
		if ($frame->save(false)) {
			$frameId = Yii::$app->db->lastInsertID;
			$attribute = Attribute::find()
				->select('round')
				->where(["attributeId" => $_POST["attribute"]])
				->asArray()
				->one();
			if (isset($attribute) && !empty($attribute)) {
				$round = $attribute["round"];
				for ($i = 1; $i <= $round; $i++) {
					$frameTerm = new FrameTerm();
					$frameTerm->termName = 'E' . $i;
					$frameTerm->frameId = $frameId;
					$frameTerm->sort = $i;
					$frameTerm->startDate =  $fromDate;
					$frameTerm->endDate = $toDate;
					$frameTerm->midDate = null;
					$frameTerm->status = $i == 1 ? 1 : 2;
					$frameTerm->createDateTime = new Expression('NOW()');
					$frameTerm->updateDateTime = new Expression('NOW()');
					$frameTerm->save(false);
					$termId = Yii::$app->db->lastInsertID;
					$pimWeight = new PimWeight();
					$pimWeight->kfiWeight = 0;
					$pimWeight->kgiWeight = 0;
					$pimWeight->kpiWeight = 0;
					$pimWeight->termId = $termId;
					$pimWeight->status = 1;
					$pimWeight->createDateTime = new Expression('NOW()');
					$pimWeight->updateDateTime = new Expression('NOW()');
					$pimWeight->save(false);
					$steps = TermStep::find()->where(["status" => 1])->asArray()->orderBy('sort')->all();
					if (isset($steps) && count($steps) > 0) {
						foreach ($steps as $step) :
							$termItem = new TermItem();
							$termItem->termId = $termId;
							$termItem->stepId = $step["stepId"];
							$termItem->status = 1;
							$termItem->createDateTime = new Expression('NOW()');
							$termItem->updateDateTime = new Expression('NOW()');
							$termItem->save(false);
						endforeach;
					}
				}
			}
		}
		return $this->redirect($_POST["previousUrl"]);
	}
	public function actionEnvironmentFrame()
	{
		$environmentId = $_POST["environmentId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/environment-frame?environmentId=' . $environmentId);
		$frames = curl_exec($api);
		$frames = json_decode($frames, true);
		curl_close($api);
		$data = [];
		if (isset($frames) && count($frames) > 0) {
			foreach ($frames as $frame) :
				$data[$frame["frameId"]] = [
					"frameName" => $frame["frameName"],
					"timeLine" => ModelMaster::dateFullFormat($frame['startDate']) . " - " . ModelMaster::dateFullFormat($frame['endDate']),
					"attribute" => $frame["attributeName"],
					"term" => FrameTerm::currentTerm($frame["frameId"]),
					"mid" => $frame["isMid"],
					"bonus" => FrameTerm::isIncludeBonus($frame["frameId"]),
					"evaluator" => "",
					"progress" => "",
					"status" => $frame["status"]
				];
			endforeach;
		}
		//throw new Exception(print_r($data, true));
		$frameText = $this->renderAjax('environment_frame', [
			"data" => $data
		]);
		$res["frame"] = $frameText;
		$res["status"] = true;
		return json_encode($res);
	}
	public function actionDeleteFrame()
	{
		Frame::deleteAll(["frameId" => $_POST["frameId"]]);
		FrameTerm::deleteAll(["frameId" => $_POST["frameId"]]);
		$res["status"] = true;
		return json_encode($res);
	}
	public function actionFrameSetting($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$frameId = $param["frameId"];

		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/frame-term-with-items?frameId=' . $frameId);
		$terms = curl_exec($api);
		$terms = json_decode($terms, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/frame-detail?frameId=' . $frameId);
		$frame = curl_exec($api);
		$frame = json_decode($frame, true);
		curl_close($api);
		$date = date('Y-m-d');
		$dateValue = Carlendar::currentMonth($date);
		$thisMonth = ModelMaster::monthEng(date('m'), 1);
		$thisYear = date('Y');

		return $this->render('frame_setting', [
			"terms" => $terms,
			"frame" => $frame,
			"dateValue" => $dateValue,
			"thisMonth" => $thisMonth,
			"thisYear" => $thisYear,
		]);
	}
	public function actionSetTermItemDate()
	{
		$termItemId = $_POST["termItemId"];
		$type = $_POST["type2"];
		$date = $_POST["dateText"];
		$dateArr = explode('/', $date);
		$date = $dateArr[2] . '-' . $dateArr[1] . '-' . $dateArr[0];
		$termItem = TermItem::find()->where(["termItemId" => $termItemId])->one();
		if ($type == 1) {
			$termItem->startDate = $date;
		} else {
			$termItem->finishDate = $date;
		}
		$termItem->save(false);
		$termItem = TermItem::find()->where(["termItemId" => $termItemId])->asArray()->one();
		if ($termItem["finishDate"] != '' && $termItem["startDate"] != '') {
			$duration = ModelMaster::dateDuration($termItem["startDate"], $termItem["finishDate"]);
		} else {
			$duration = 0;
		}
		$res["status"] = true;
		$res["duration"] = $duration;
		return json_encode($res);
	}
	public function actionChangeTermBonus()
	{
		$term = FrameTerm::find()->where(["termId" => $_POST["termId"]])->one();
		$term->isIncludeBonus = $_POST["newValue"];
		$term->save(false);
		$res["status"] = true;
		return json_encode($res);
	}
	public function actionTermDetail($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$termId = $param["termId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/term-detail?termId=' . $termId);
		$terms = curl_exec($api);
		$terms = json_decode($terms, true);


		$frameId = $terms["frameId"];
		$frameName = Frame::frameName($frameId);
		$environmentId = Frame::getEnvironmentId($frameId);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/environment-detail?environmentId=' . $environmentId);
		$environmentDetail = curl_exec($api);
		$environmentDetail = json_decode($environmentDetail, true);
		curl_close($api);
		//throw new Exception(print_r($terms, true));
		$date = date('Y-m-d');
		$thisMonth = ModelMaster::monthEng(date('m'), 1);
		$thisYear = date('Y');
		$dateValue = Carlendar::currentMonth($date);
		return $this->render('term_detail', [
			"dateValue" => $dateValue,
			"thisMonth" => $thisMonth,
			"thisYear" => $thisYear,
			"terms" => $terms,
			"environmentDetail" => $environmentDetail,
			"frameName" => $frameName,
			"termId" => $termId
		]);
	}
	public function actionAddTermItem()
	{
		$frameTerms = FrameTerm::find()->where("1")->asArray()->all();
		if (isset($frameTerms) && count($frameTerms) > 0) {
			foreach ($frameTerms as $frameTerm) :
				$steps = TermStep::find()->where(["status" => 1])->asArray()->orderBy('sort')->all();
				if (isset($steps) && count($steps) > 0) {
					foreach ($steps as $step) :
						$termItem = new TermItem();
						$termItem->termId = $frameTerm["termId"];
						$termItem->stepId = $step["stepId"];
						$termItem->status = 1;
						$termItem->createDateTime = new Expression('NOW()');
						$termItem->updateDateTime = new Expression('NOW()');
						$termItem->save(false);
					endforeach;
				}
			endforeach;
		}
	}
	public function actionEvaluatorSetting($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$termId = $param["termId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/term-detail?termId=' . $termId);
		$terms = curl_exec($api);
		$terms = json_decode($terms, true);


		$frameId = $terms["frameId"];
		$frameName = Frame::frameName($frameId);
		$environmentId = Frame::getEnvironmentId($frameId);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/environment-detail?environmentId=' . $environmentId);
		$environmentDetail = curl_exec($api);
		$environmentDetail = json_decode($environmentDetail, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/company-employee-pim?companyId=' . $environmentDetail["companyId"]);
		$employeePim = curl_exec($api);
		$employeePim = json_decode($employeePim, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/pim-count-employee?termId=' . $termId);
		$pimEmployee = curl_exec($api);
		$pimEmployee = json_decode($pimEmployee, true);

		curl_close($api);
		//throw new Exception(print_r($environmentDetail, true));
		$date = date('Y-m-d');
		$thisMonth = ModelMaster::monthEng(date('m'), 1);
		$thisYear = date('Y');
		$dateValue = Carlendar::currentMonth($date);
		return $this->render('evaluator_setting', [
			"dateValue" => $dateValue,
			"thisMonth" => $thisMonth,
			"thisYear" => $thisYear,
			"terms" => $terms,
			"environmentDetail" => $environmentDetail,
			"frameName" => $frameName,
			"termId" => $termId,
			"employeePim" => $employeePim,
			"pimEmployee" => $pimEmployee
		]);
	}
	public function actionWeightAllocate($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$termId = $param["termId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/term-detail?termId=' . $termId);
		$terms = curl_exec($api);
		$terms = json_decode($terms, true);

		$frameId = $terms["frameId"];
		$frameName = Frame::frameName($frameId);
		$environmentId = Frame::getEnvironmentId($frameId);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/environment-detail?environmentId=' . $environmentId);
		$environmentDetail = curl_exec($api);
		$environmentDetail = json_decode($environmentDetail, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/pim-term?termId=' . $termId);
		$pimTerm = curl_exec($api);
		$pimTerm = json_decode($pimTerm, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/master-kfi?termId=' . $termId);
		$masterKfi = curl_exec($api);
		$masterKfi = json_decode($masterKfi, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/master-kgi?termId=' . $termId);
		$masterKgi = curl_exec($api);
		$masterKgi = json_decode($masterKgi, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/master-kpi?termId=' . $termId);
		$masterKpi = curl_exec($api);
		$masterKpi = json_decode($masterKpi, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/pim-count-employee?termId=' . $termId);
		$pimEmployee = curl_exec($api);
		$pimEmployee = json_decode($pimEmployee, true);

		curl_close($api);

		return $this->render('weight_allocate', [
			"terms" => $terms,
			"environmentDetail" => $environmentDetail,
			"frameName" => $frameName,
			"termId" => $termId,
			"pimTerm" => $pimTerm,
			"masterKpi" => $masterKpi,
			"masterKfi" => $masterKfi,
			"masterKgi" => $masterKgi,
			"pimEmployee" => $pimEmployee
		]);
	}
	public function actionWeightAllocateSetting($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$termId = $param["termId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/term-detail?termId=' . $termId);
		$terms = curl_exec($api);
		$terms = json_decode($terms, true);

		$frameId = $terms["frameId"];
		$frameName = Frame::frameName($frameId);
		$environmentId = Frame::getEnvironmentId($frameId);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/environment-detail?environmentId=' . $environmentId);
		$environmentDetail = curl_exec($api);
		$environmentDetail = json_decode($environmentDetail, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/pim-term?termId=' . $termId);
		$pimTerm = curl_exec($api);
		$pimTerm = json_decode($pimTerm, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/master-kfi?termId=' . $termId);
		$masterKfi = curl_exec($api);
		$masterKfi = json_decode($masterKfi, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/master-kgi?termId=' . $termId);
		$masterKgi = curl_exec($api);
		$masterKgi = json_decode($masterKgi, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/master-kpi?termId=' . $termId);
		$masterKpi = curl_exec($api);
		$masterKpi = json_decode($masterKpi, true);

		$branchId = FrameTerm::findDepartmentId($termId);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/employee/employee-title-by-branch?branchId=' . $branchId . '&&pimWeightId=' . $pimTerm["pimWeightId"]);
		$employees = curl_exec($api);
		$employees = json_decode($employees, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/pim-count-employee?termId=' . $termId);
		$pimEmployee = curl_exec($api);
		$pimEmployee = json_decode($pimEmployee, true);
		curl_close($api);
		return $this->render('weight_allocate_setting', [
			"terms" => $terms,
			"environmentDetail" => $environmentDetail,
			"frameName" => $frameName,
			"termId" => $termId,
			"pimTerm" => $pimTerm,
			"masterKpi" => $masterKpi,
			"masterKfi" => $masterKfi,
			"masterKgi" => $masterKgi,
			"employees" => $employees,
			"pimEmployee" => $pimEmployee
		]);
	}
	public function actionSaveEmployeePim()
	{
		$employeeIds = $_POST["employeeIds"];
		$termId = $_POST["termId"];
		$pimWeightId = $_POST["pimWeightId"];
		$oldEmId = EmployeeEvaluation::find()->where(["pimWeightId" => $pimWeightId])->asArray()->all();
		$oldId = [];
		$res = [];
		$save = 0;
		if (isset($oldEmId) && count($oldEmId) > 0) {
			$i = 0;
			foreach ($oldEmId as $old) :
				$oldId[$i] = $old["employeeId"];
				$i++;
			endforeach;
			if (count($oldId) > 0) {
				foreach ($oldId as $old) :
					$flag = 0;
					if (count($employeeIds) > 0) {
						foreach ($employeeIds as $new) :
							if ($old == $new) {
								$flag = 1;
							}
						endforeach;
					}
					if ($flag == 0) {
						EmployeeEvaluation::deleteAll(["employeeId" => $old, "pimWeightId" => $pimWeightId]);
					}
				endforeach;
			}
		}
		foreach ($employeeIds as $employeeId) :
			$evaluation = EmployeeEvaluation::find()->where(["employeeId" => $employeeId])->one();
			if (!isset($evaluation) || empty($evaluation)) {
				$evaluation = new EmployeeEvaluation();
				$evaluation->createDateTime = new Expression('NOW()');
			}
			$evaluation->employeeId = $employeeId;
			$evaluation->pimWeightId = $pimWeightId;
			$evaluation->status = 1;
			$evaluation->updateDateTime = new Expression('NOW()');
			if ($evaluation->save(false)) {
				$save = 1;
			}
		endforeach;
		if ($save == 1) {
			$res["status"] = true;
		} else {
			$res["status"] = false;
		}
		return json_encode($res);
	}
	public function actionSavePimAllocate()
	{
		$type = $_POST["type"];
		$weight = $_POST["weight"];
		$pimWeightId = $_POST["pimWeightId"];
		$res["status"] = false;
		$pimWeight = PimWeight::find()->where(["pimWeightId" => $pimWeightId])->one();
		if ($type == "KFI") {
			$pimWeight->kfiWeight = $weight;
		}
		if ($type == "KGI") {
			$pimWeight->kgiWeight = $weight;
		}
		if ($type == "KPI") {
			$pimWeight->kpiWeight = $weight;
		}
		$pimWeight->status = 1;
		$pimWeight->updateDateTime = new Expression('NOW()');
		if ($pimWeight->save(false)) {
			$res["status"] = true;
		}
		return json_encode($res);
	}
	public function actionKfiWeightAllocate($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$termId = $param["termId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/term-detail?termId=' . $termId);
		$terms = curl_exec($api);
		$terms = json_decode($terms, true);

		$frameId = $terms["frameId"];
		$frameName = Frame::frameName($frameId);
		$environmentId = Frame::getEnvironmentId($frameId);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/environment-detail?environmentId=' . $environmentId);
		$environmentDetail = curl_exec($api);
		$environmentDetail = json_decode($environmentDetail, true);

		$adminId = '';
		$gmId = '';
		$teamLeaderId = '';
		$managerId = '';
		$supervisorId = '';
		$staffId = '';
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kfi/management/index?adminId=' . $adminId . '&&gmId=' . $gmId . '&&managerId=' . $managerId . '&&supervisorId=' . $supervisorId . '&&teamLeaderId=' . $teamLeaderId . '&&staffId=' . $staffId);
		$kfis = curl_exec($api);
		$kfis = json_decode($kfis, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/kfi-weight?termId=' . $termId);
		$kfiWeight = curl_exec($api);
		$kfiWeight = json_decode($kfiWeight, true);
		$totalPercent = 0;

		if (isset($kfiWeight) && count($kfiWeight)) {
			foreach ($kfiWeight as $weight) :
				$totalPercent += $weight["weight"];
			endforeach;
		}
		curl_close($api);
		return $this->render('kfi_weight_allocate', [
			"terms" => $terms,
			"environmentDetail" => $environmentDetail,
			"frameName" => $frameName,
			"termId" => $termId,
			"kfiWeight" => $kfiWeight,
			"totalPercent" => $totalPercent
		]);
	}
	public function actionKgiWeightAllocate($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$termId = $param["termId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/term-detail?termId=' . $termId);
		$terms = curl_exec($api);
		$terms = json_decode($terms, true);

		$frameId = $terms["frameId"];
		$frameName = Frame::frameName($frameId);
		$environmentId = Frame::getEnvironmentId($frameId);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/environment-detail?environmentId=' . $environmentId);
		$environmentDetail = curl_exec($api);
		$environmentDetail = json_decode($environmentDetail, true);

		$adminId = '';
		$gmId = '';
		$teamLeaderId = '';
		$managerId = '';
		$supervisorId = '';
		$staffId = '';
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/index?adminId=' . $adminId . '&&gmId=' . $gmId . '&&managerId=' . $managerId . '&&supervisorId=' . $supervisorId . '&&teamLeaderId=' . $teamLeaderId . '&&staffId=' . $staffId);
		$kgis = curl_exec($api);
		$kgis = json_decode($kgis, true);
		//throw new Exception(print_r($kfis, true));
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/kgi-weight?termId=' . $termId);
		$kgiWeight = curl_exec($api);
		$kgiWeight = json_decode($kgiWeight, true);
		$totalPercent = 0;

		if (isset($kgiWeight) && count($kgiWeight)) {
			foreach ($kgiWeight as $weight) :
				$totalPercent += $weight["weight"];
			endforeach;
		}
		curl_close($api);
		return $this->render('kgi_weight_allocate', [
			"terms" => $terms,
			"environmentDetail" => $environmentDetail,
			"frameName" => $frameName,
			"termId" => $termId,
			"kgiWeight" => $kgiWeight,
			"totalPercent" => $totalPercent
		]);
	}
	public function actionKpiWeightAllocate($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$termId = $param["termId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/term-detail?termId=' . $termId);
		$terms = curl_exec($api);
		$terms = json_decode($terms, true);

		$frameId = $terms["frameId"];
		$frameName = Frame::frameName($frameId);
		$environmentId = Frame::getEnvironmentId($frameId);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/environment-detail?environmentId=' . $environmentId);
		$environmentDetail = curl_exec($api);
		$environmentDetail = json_decode($environmentDetail, true);

		$adminId = '';
		$gmId = '';
		$teamLeaderId = '';
		$managerId = '';
		$supervisorId = '';
		$staffId = '';
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/index?adminId=' . $adminId . '&&gmId=' . $gmId . '&&managerId=' . $managerId . '&&supervisorId=' . $supervisorId . '&&teamLeaderId=' . $teamLeaderId . '&&staffId=' . $staffId);
		$kpis = curl_exec($api);
		$kpis = json_decode($kpis, true);
		//throw new Exception(print_r($kfis, true));
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/kpi-weight?termId=' . $termId);
		$kpiWeight = curl_exec($api);
		$kpiWeight = json_decode($kpiWeight, true);
		$totalPercent = 0;

		if (isset($kpiWeight) && count($kpiWeight)) {
			foreach ($kpiWeight as $weight) :
				$totalPercent += $weight["weight"];
			endforeach;
		}
		curl_close($api);
		return $this->render('kpi_weight_allocate', [
			"terms" => $terms,
			"environmentDetail" => $environmentDetail,
			"frameName" => $frameName,
			"termId" => $termId,
			"kpiWeight" => $kpiWeight,
			"totalPercent" => $totalPercent
		]);
	}
	public function actionSaveKfiWeightAllocate()
	{
		$termId = $_POST["termId"];
		$checkKfi = $_POST["checkKfi"];
		//throw new Exception(print_r($checkKfi, true));
		if (isset($checkKfi) && count($checkKfi) > 0) {
			$i = 0;
			KfiWeight::updateAll(["status" => 99], ["termId" => $termId]);
			foreach ($checkKfi as $kfiId) :
				$kfiWeight = KfiWeight::find()->where(["kfiId" => $kfiId, "termId" => $termId])->one();
				if (!isset($kfiWeight) || empty($kfiWeight)) {
					$kfiWeight = new KfiWeight();
				}
				$kfiWeight->kfiId = $kfiId;
				$kfiWeight->termId = $termId;
				$kfiWeight->level1 = isset($_POST["level1"][$kfiId]) ? $_POST["level1"][$kfiId] : 0;
				$kfiWeight->level2 = isset($_POST["level2"][$kfiId]) ? $_POST["level2"][$kfiId] : 0;
				$kfiWeight->level3 = isset($_POST["level3"][$kfiId]) ? $_POST["level3"][$kfiId] : 0;
				$kfiWeight->level4 = isset($_POST["level4"][$kfiId]) ? $_POST["level4"][$kfiId] : 0;
				$kfiWeight->level5 = isset($_POST["level5"][$kfiId]) ? $_POST["level5"][$kfiId] : 0;
				$kfiWeight->level6 = isset($_POST["level6"][$kfiId]) ? $_POST["level6"][$kfiId] : 0;
				$kfiWeight->weight = isset($_POST["weight-kfi"][$kfiId]) ? $_POST["weight-kfi"][$kfiId] : 0;
				$kfiWeight->status = 1;
				$kfiWeight->createDateTime = new Expression('NOW()');
				$kfiWeight->updateDateTime = new Expression('NOW()');
				$kfiWeight->save(false);
			// $data[$i] = $kfiId;
			// $i++;
			endforeach;
			//throw new Exception(print_r($data, true));
		}
		return $this->redirect(Yii::$app->homeUrl . 'evaluation/environment/weight-allocate/' . ModelMaster::encodeParams(["termId" => $termId]));
	}
	public function actionSaveKgiWeightAllocate()
	{
		$termId = $_POST["termId"];
		$checkKgi = $_POST["checkKgi"];
		if (isset($checkKgi) && count($checkKgi) > 0) {
			$i = 0;
			KgiWeight::updateAll(["status" => 99], ["termId" => $termId]);
			foreach ($checkKgi as $kgiId) :
				$kgiWeight = KgiWeight::find()->where(["kgiId" => $kgiId, "termId" => $termId])->one();
				if (!isset($kgiWeight) || empty($kgiWeight)) {
					$kgiWeight = new KgiWeight();
				}
				$kgiWeight->kgiId = $kgiId;
				$kgiWeight->termId = $termId;
				$kgiWeight->level1 = isset($_POST["level1"][$kgiId]) ? $_POST["level1"][$kgiId] : 0;
				$kgiWeight->level2 = isset($_POST["level2"][$kgiId]) ? $_POST["level2"][$kgiId] : 0;
				$kgiWeight->level3 = isset($_POST["level3"][$kgiId]) ? $_POST["level3"][$kgiId] : 0;
				$kgiWeight->level4 = isset($_POST["level4"][$kgiId]) ? $_POST["level4"][$kgiId] : 0;
				$kgiWeight->weight = isset($_POST["weight-kgi"][$kgiId]) ? $_POST["weight-kgi"][$kgiId] : 0;
				$kgiWeight->status = 1;
				$kgiWeight->createDateTime = new Expression('NOW()');
				$kgiWeight->updateDateTime = new Expression('NOW()');
				$kgiWeight->save(false);
			// $data[$i] = $kfiId;
			// $i++;
			endforeach;
			//throw new Exception(print_r($data, true));
		}
		return $this->redirect(Yii::$app->homeUrl . 'evaluation/environment/weight-allocate/' . ModelMaster::encodeParams(["termId" => $termId]));
	}
	public function actionSaveKpiWeightAllocate()
	{
		$termId = $_POST["termId"];
		$checkKpi = $_POST["checkKpi"];
		if (isset($checkKpi) && count($checkKpi) > 0) {
			$i = 0;
			KpiWeight::updateAll(["status" => 99], ["termId" => $termId]);
			foreach ($checkKpi as $kpiId) :
				$kpiWeight = KpiWeight::find()->where(["kpiId" => $kpiId, "termId" => $termId])->one();
				if (!isset($kpiWeight) || empty($kpiWeight)) {
					$kpiWeight = new KpiWeight();
				}
				$kpiWeight->kpiId = $kpiId;
				$kpiWeight->termId = $termId;
				$kpiWeight->level1 = isset($_POST["level1"][$kpiId]) ? $_POST["level1"][$kpiId] : 0;
				$kpiWeight->level2 = isset($_POST["level2"][$kpiId]) ? $_POST["level2"][$kpiId] : 0;
				$kpiWeight->level3 = isset($_POST["level3"][$kpiId]) ? $_POST["level3"][$kpiId] : 0;
				$kpiWeight->level4 = isset($_POST["level4"][$kpiId]) ? $_POST["level4"][$kpiId] : 0;
				$kpiWeight->weight = isset($_POST["weight-kpi"][$kpiId]) ? $_POST["weight-kpi"][$kpiId] : 0;
				$kpiWeight->status = 1;
				$kpiWeight->createDateTime = new Expression('NOW()');
				$kpiWeight->updateDateTime = new Expression('NOW()');
				$kpiWeight->save(false);
			endforeach;
		}
		return $this->redirect(Yii::$app->homeUrl . 'evaluation/environment/weight-allocate/' . ModelMaster::encodeParams(["termId" => $termId]));
	}

	public function actionCalendar()
	{
		$year = $_POST["year"];
		$month = $_POST["month"];
		$type = $_POST["type"];
		if ($month < 10) {
			$month = "0" . $month;
		}
		$day = date('d');
		$date = $year . "-" . $month . "-" . $day;
		$dateValue = Carlendar::currentMonth($date);
		$thisMonth = ModelMaster::monthEng($month, 1);
		$file = 'calendar' . $type;
		$textCalendar = $this->renderAjax($file, [
			"dateValue" => $dateValue
		]);
		$res["status"] = true;
		$res["newCalendar"] = $textCalendar;
		$res["monthYear"] = $thisMonth . '&nbsp;&nbsp;&nbsp;' . $year;
		return json_encode($res);
	}
	public function actionInputDate()
	{
		$day = $_POST["day"];
		$month = $_POST["month"];
		$year = $_POST["year"];
		$lastDigit = substr($day, -1);
		if ($lastDigit == 1) {
			$day .= '<sup>st</sup>';
		} else if ($lastDigit == 2) {
			$day .= '<sup>nd</sup>';
		} else if ($lastDigit == 3) {
			$day .= '<sup>rd</sup>';
		} else {
			$day .= '<sup>th</sup>';
		}
		$fullMonth = ModelMaster::monthEng($month, 1);
		$fullText = $day . "&nbsp;" . $fullMonth . "&nbsp;" . $year;
		$res["fullDate"] = $fullText;
		$res["status"] = true;
		return json_encode($res);
	}
	public function actionSetPimWeight()
	{
		for ($i = 16; $i <= 25; $i++) {
			$a = new PimWeight();
			$a->kfiWeight = 0;
			$a->kgiWeight = 0;
			$a->kpiWeight = 0;
			$a->termId = $i;
			$a->status = 1;
			$a->save(false);
		}
	}
}
