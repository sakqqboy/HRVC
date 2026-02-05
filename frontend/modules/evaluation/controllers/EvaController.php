<?php

namespace frontend\modules\evaluation\controllers;

use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
use frontend\models\hrvc\Employee;
use frontend\models\hrvc\EmployeeEvaluator;
use frontend\models\hrvc\Frame;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\Kfi;
use frontend\models\hrvc\KfiWeight;
use frontend\models\hrvc\Kgi;
use frontend\models\hrvc\KgiEmployeeWeight;
use frontend\models\hrvc\KgiWeight;
use frontend\models\hrvc\Kpi;
use frontend\models\hrvc\KpiTeam;
use frontend\models\hrvc\KpiTeamWeight;
use frontend\models\hrvc\KpiWeight;
use frontend\models\hrvc\User;
use Yii;
use yii\web\Controller;
use frontend\components\Api;

class EvaController extends Controller
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
	public function actionDashboard()
	{
	}
	public function actionEvaluate($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$termId = $param["termId"];
		$employeeId = $param["employeeId"];
		// $api = curl_init();
		// curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		// curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/term-detail?termId=' . $termId);
		$terms = Api::connectApi(Path::Api() . 'evaluation/environment/term-detail?termId=' . $termId);
		// $terms = curl_exec($api);
		// $terms = json_decode($terms, true);

		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/employee/employee-detail?id=' . $employeeId);
		$employee = Api::connectApi(Path::Api() . 'masterdata/employee/employee-detail?id=' . $employeeId);
		// $employee = curl_exec($api);
		// $employee = json_decode($employee, true);

		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/employee-evaluator?employeeId=' . $employeeId . '&&termId=' . $termId);
		$evaluator = Api::connectApi(Path::Api() . 'evaluation/environment/employee-evaluator?employeeId=' . $employeeId . '&&termId=' . $termId);
		// $evaluator = curl_exec($api);
		// $evaluator = json_decode($evaluator, true);

		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/employee-term-weight?employeeId=' . $employeeId . '&&termId=' . $termId);
		$employeeTermWeight = Api::connectApi(Path::Api() . 'evaluation/environment/employee-term-weight?employeeId=' . $employeeId . '&&termId=' . $termId);
		// $employeeTermWeight = curl_exec($api);
		// $employeeTermWeight = json_decode($employeeTermWeight, true);

		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/employee-term-kfi?employeeId=' . $employeeId . '&&termId=' . $termId);
		$employeeTermKfi = Api::connectApi(Path::Api() . 'evaluation/environment/employee-term-kfi?employeeId=' . $employeeId . '&&termId=' . $termId);
		// $employeeTermKfi = curl_exec($api);
		// $employeeTermKfi = json_decode($employeeTermKfi, true);

		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/master-kgi?termId=' . $termId . '&&employeeId=' . $employeeId);
		$masterKgiTeam = Api::connectApi(Path::Api() . 'evaluation/environment/master-kgi?termId=' . $termId . '&&employeeId=' . $employeeId);
		// $masterKgiTeam = curl_exec($api);
		// $masterKgiTeam = json_decode($masterKgiTeam, true);

		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/master-kgi-employee?termId=' . $termId . '&&employeeId=' . $employeeId);
		$masterKgiEmployee = Api::connectApi(Path::Api() . 'evaluation/environment/master-kgi-employee?termId=' . $termId . '&&employeeId=' . $employeeId);
		// $masterKgiEmployee = curl_exec($api);
		// $masterKgiEmployee = json_decode($masterKgiEmployee, true);

		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/master-kpi?termId=' . $termId . '&&employeeId=' . $employeeId);
		$masterKpiEmployee = Api::connectApi(Path::Api() . 'evaluation/environment/master-kpi?termId=' . $termId . '&&employeeId=' . $employeeId);
		// $masterKpiEmployee = curl_exec($api);
		// $masterKpiEmployee = json_decode($masterKpiEmployee, true);

		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/master-kpi-team?termId=' . $termId . '&&employeeId=' . $employeeId);
		$masterKpiTeam = Api::connectApi(Path::Api() . 'evaluation/environment/master-kpi-team?termId=' . $termId . '&&employeeId=' . $employeeId);
		// $masterKpiTeam = curl_exec($api);
		// $masterKpiTeam = json_decode($masterKpiTeam, true);

		$frameId = $terms["frameId"];
		$frameName = Frame::frameName($frameId);
		$environmentId = Frame::getEnvironmentId($frameId);

		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/term-in-frame?frameId=' . $frameId);
		$allTerms = Api::connectApi(Path::Api() . 'evaluation/environment/term-in-frame?frameId=' . $frameId);
		// $allTerms = curl_exec($api);
		// $allTerms = json_decode($allTerms, true);

		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/kfi-weight?termId=' . $termId . '&&employeeId=' . $employeeId);
		$kfiWeight = Api::connectApi(Path::Api() . 'evaluation/environment/kfi-weight?termId=' . $termId . '&&employeeId=' . $employeeId);
		// $kfiWeight = curl_exec($api);
		// $kfiWeight = json_decode($kfiWeight, true);

		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/kgi-weight?termId=' . $termId . '&&employeeId=' . $employeeId);
		$kgiTeamWeight = Api::connectApi(Path::Api() . 'evaluation/environment/kgi-weight?termId=' . $termId . '&&employeeId=' . $employeeId);
		// $kgiTeamWeight = curl_exec($api);
		// $kgiTeamWeight = json_decode($kgiTeamWeight, true);

		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/kgi-individual-weight?termId=' . $termId . '&&employeeId=' . $employeeId);
		$kgiEmployeeWeight = Api::connectApi(Path::Api() . 'evaluation/environment/kgi-individual-weight?termId=' . $termId . '&&employeeId=' . $employeeId);
		// $kgiEmployeeWeight = curl_exec($api);
		// $kgiEmployeeWeight = json_decode($kgiEmployeeWeight, true);

		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/kpi-team-weight?termId=' . $termId . '&&employeeId=' . $employeeId);
		$kpiTeamWeight = Api::connectApi(Path::Api() . 'evaluation/environment/kpi-team-weight?termId=' . $termId . '&&employeeId=' . $employeeId);
		// $kpiTeamWeight = curl_exec($api);
		// $kpiTeamWeight = json_decode($kpiTeamWeight, true);
		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/kpi-weight?termId=' . $termId . '&&employeeId=' . $employeeId);
		$kpiEmployeeWeight = Api::connectApi(Path::Api() . 'evaluation/environment/kpi-weight?termId=' . $termId . '&&employeeId=' . $employeeId);
		// $kpiEmployeeWeight = curl_exec($api);
		// $kpiEmployeeWeight = json_decode($kpiEmployeeWeight, true);

		// curl_close($api);
		$totalKgi = count($masterKgiTeam) + count($masterKgiEmployee);
		$totalKpi = count($masterKpiTeam) + count($masterKpiEmployee);

		//throw new Exception(print_r($masterKpiEmployee, true));

		return $this->render('individual_evaluate', [
			"terms" => $terms,
			"employee" => $employee,
			"frameName" => $frameName,
			"evaluator" => $evaluator,
			"employeeTermWeight" => $employeeTermWeight,
			"employeeTermKfi" => $employeeTermKfi,
			"allTerms" => $allTerms,
			"masterKgiTeam" => $masterKgiTeam,
			"masterKgiEmployee" => $masterKgiEmployee,
			"masterKpiTeam" => $masterKpiTeam,
			"masterKpiEmployee" => $masterKpiEmployee,
			"totalKpi" => $totalKpi,
			"totalKgi" => $totalKgi,
			"kfiWeight" => $kfiWeight,
			"kgiTeamWeight" => $kgiTeamWeight,
			"kgiEmployeeWeight" => $kgiEmployeeWeight,
			"kpiTeamWeight" => $kpiTeamWeight,
			"kpiEmployeeWeight" => $kpiEmployeeWeight
		]);
	}
	public function actionPrepareKfiEva()
	{
		$kfiId = $_POST["kfiId"];
		$kfiWeightId = $_POST["kfiWeightId"];
		$evaluatorId = User::employeeIdFromUserId();
		// $api = curl_init();
		// curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		// curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/individual-kfi-weight?kfiWeightId=' . $kfiWeightId);
		$kfiWeight = Api::connectApi(Path::Api() .  'evaluation/environment/individual-kfi-weight?kfiWeightId=' . $kfiWeightId);
		// $kfiWeight = curl_exec($api);
		// $kfiWeight = json_decode($kfiWeight, true);
		// curl_close($api);
		$res = [];
		//throw new exception(print_r($kfiWeight, true));
		$kfi = Kfi::find()->select('kfiName')
			->where(["kfiId" => $kfiId])
			->asArray()
			->one();


		$res["status"] = true;
		$res["kfiName"] = $kfi["kfiName"];
		$res["enableFirst"] = 0;
		$res["enableFinal"] = 0;
		$res["firstScore"] = '';
		$res["finalScore"] = '';
		$res["firstComment"] = '';
		$res["finalComment"] = '';
		if (isset($kfiWeight) && $kfiWeight["status"] = 200) {
			$evaluator = EmployeeEvaluator::find()
				->where(["employeeId" => $kfiWeight["employeeId"], "termId" => $kfiWeight["termId"]])
				->asArray()
				->one();
			if (isset($evaluator) && !empty($evaluator)) {
				if ($evaluator["primaryId"] == $evaluatorId) {
					$res["enableFirst"] = 1;
				}
				if ($evaluator["finalId"] == $evaluatorId) {
					$res["enableFinal"] = 1;
				}
			}
			$res["firstScore"] = $kfiWeight["firstScore"];
			$res["finalScore"] = $kfiWeight["finalScore"];
			$res["firstComment"] = $kfiWeight["firstComment"];
			$res["finalComment"] = $kfiWeight["finalComment"];
			$res["employeeId"] = $kfiWeight["employeeId"];
			$res["evaluatorId"] = $evaluatorId;
		}
		return json_encode($res);
	}
	public function actionSaveEvaluatorPoint()
	{
		$kfiWeightId = $_POST["kfiWeightId"];
		$evaluateeScore = $_POST["evaluateeResult"];
		$kfiWeight = KfiWeight::find()->where(["kfiWeightId" => $kfiWeightId])->one();
		$res = [];
		$res["point"] = 0;
		$everage = 0;
		if (isset($kfiWeight) && !empty($kfiWeight)) {
			$kfiWeight->firstScore = $_POST["firstScore"];
			$kfiWeight->finalScore = $_POST["finalScore"];
			$kfiWeight->firstComment = $_POST["firstComment"];
			$kfiWeight->finalComment = $_POST["finalComment"];
			if ($kfiWeight->save(false)) {
				$res["status"] = true;
				$kfiWeight = KfiWeight::find()->where(["kfiWeightId" => $kfiWeightId])->one();
				$everage = ((int)$kfiWeight->firstScore + (int)$kfiWeight->finalScore + (int)$evaluateeScore) / 3;
				$res["point"] = number_format($everage, 1);
			} else {
				$res["status"] = false;
			}
		} else {
			$res["status"] = false;
		}
		return json_encode($res);
	}
	public function actionSaveKfiEvaluateePoint()
	{
		$kfiWeightId = $_POST["kfiWeightId"];
		$score = $_POST["score"];
		$midComment = $_POST["midComment"];
		$primaryComment = $_POST["primaryComment"];
		$kfiWeight = KfiWeight::find()->where(["kfiWeightId" => $kfiWeightId])->one();
		$kfiWeight->result = $score;
		$kfiWeight->primaryComment = $primaryComment;
		$kfiWeight->midComment = $midComment;
		$everage = 0;
		$res["status"] = false;
		if ($kfiWeight->save(false)) {
			$res["status"] = true;
			$everage = ((int)$kfiWeight->firstScore + (int)$kfiWeight->finalScore + (int)$score) / 3;
			$res["point"] = number_format($everage, 1);
		}
		return json_encode($res);
	}
	public function actionPrepareKgiEmployee()
	{
		$kgiId = $_POST["kgiId"];
		$evaluatorId = User::employeeIdFromUserId();
		$kgiEmployeeWeigthId = $_POST["kgiEmployeeWeigthId"];

		// $api = curl_init();
		// curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		// curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/individual-kgi-weight?kgiEmployeeWeightId=' . $kgiEmployeeWeigthId);
		$kgiEmployeeWeight = Api::connectApi(Path::Api() .  'evaluation/environment/individual-kgi-weight?kgiEmployeeWeightId=' . $kgiEmployeeWeigthId);
		// $kgiEmployeeWeight = curl_exec($api);
		// $kgiEmployeeWeight = json_decode($kgiEmployeeWeight, true);
		// curl_close($api);

		$kgi = Kgi::find()->select('kgiName')
			->where(["kgiId" => $kgiId])
			->asArray()
			->one();
		$res["status"] = true;
		$res["kgiName"] = $kgi["kgiName"];
		$res["enableFirst"] = 0;
		$res["enableFinal"] = 0;
		$res["firstScore"] = '';
		$res["finalScore"] = '';
		$res["firstComment"] = '';
		$res["finalComment"] = '';
		if (isset($kgiEmployeeWeight) && $kgiEmployeeWeight["status"] = 200) {
			$evaluator = EmployeeEvaluator::find()
				->where(["employeeId" => $kgiEmployeeWeight["employeeId"], "termId" => $kgiEmployeeWeight["termId"]])
				->asArray()
				->one();
			if (isset($evaluator) && !empty($evaluator)) {
				if ($evaluator["primaryId"] == $evaluatorId) {
					$res["enableFirst"] = 1;
				}
				if ($evaluator["finalId"] == $evaluatorId) {
					$res["enableFinal"] = 1;
				}
			}
			$res["firstScore"] = $kgiEmployeeWeight["firstScore"];
			$res["finalScore"] = $kgiEmployeeWeight["finalScore"];
			$res["firstComment"] = $kgiEmployeeWeight["firstComment"];
			$res["finalComment"] = $kgiEmployeeWeight["finalComment"];
		}
		return json_encode($res);
	}
	public function actionSaveKgiEmployeeEvaluatorPoint()
	{
		$kgiEmployeeWeightId = $_POST["kgiEmployeeWeightId"];
		$evaluateeScore = $_POST["evaluateeResult"];
		$kgiEmployeeWeigth = KgiEmployeeWeight::find()->where(["kgiEmployeeWeightId" => $kgiEmployeeWeightId])->one();
		$res = [];
		$res["point"] = 0;
		$everage = 0;
		if (isset($kgiEmployeeWeigth) && !empty($kgiEmployeeWeigth)) {
			$kgiEmployeeWeigth->firstScore = $_POST["firstScore"];
			$kgiEmployeeWeigth->finalScore = $_POST["finalScore"];
			$kgiEmployeeWeigth->firstComment = $_POST["firstComment"];
			$kgiEmployeeWeigth->finalComment = $_POST["finalComment"];
			if ($kgiEmployeeWeigth->save(false)) {
				$res["status"] = true;
				$kgiEmployeeWeigth = kgiEmployeeWeight::find()->where(["kgiEmployeeWeightId" => $kgiEmployeeWeightId])->one();
				$everage = ((int)$kgiEmployeeWeigth->firstScore + (int)$kgiEmployeeWeigth->finalScore + (int)$evaluateeScore) / 3;
				$res["point"] = number_format($everage, 1);
			} else {
				$res["status"] = false;
			}
		} else {
			$res["status"] = false;
		}
		return json_encode($res);
	}
	public function actionSaveKgiEmployeeEvaluateePoint()
	{
		$kgiEmployeeWeightId = $_POST["kgiEmployeeWeightId"];
		$score = $_POST["score"];
		$midComment = $_POST["midComment"];
		$primaryComment = $_POST["primaryComment"];
		$kgiEmployeeWeight = kgiEmployeeWeight::find()->where(["kgiEmployeeWeightId" => $kgiEmployeeWeightId])->one();
		$kgiEmployeeWeight->result = $score;
		$kgiEmployeeWeight->primaryComment = $primaryComment;
		$kgiEmployeeWeight->midComment = $midComment;
		$everage = 0;
		$res["status"] = false;
		if ($kgiEmployeeWeight->save(false)) {
			$res["status"] = true;
			$everage = ((int)$kgiEmployeeWeight->firstScore + (int)$kgiEmployeeWeight->finalScore + (int)$score) / 3;
			$res["point"] = number_format($everage, 1);
		}
		return json_encode($res);
	}
	public function actionPrepareKgiTeam()
	{
		$kgiId = $_POST["kgiId"];
		$evaluatorId = User::employeeIdFromUserId();
		$kgiTeamWeigthId = $_POST["kgiTeamWeigthId"];

		// $api = curl_init();
		// curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		// curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/team-kgi-weight?kgiWeightId=' . $kgiTeamWeigthId);
		$kgiTeamWeight = Api::connectApi(Path::Api() .  'evaluation/environment/team-kgi-weight?kgiWeightId=' . $kgiTeamWeigthId);
		// $kgiTeamWeight = curl_exec($api);
		// $kgiTeamWeight = json_decode($kgiTeamWeight, true);
		// curl_close($api);

		$kgi = Kgi::find()->select('kgiName')
			->where(["kgiId" => $kgiId])
			->asArray()
			->one();
		$res["status"] = true;
		$res["kgiName"] = $kgi["kgiName"];
		$res["enableFirst"] = 0;
		$res["enableFinal"] = 0;
		$res["firstScore"] = '';
		$res["finalScore"] = '';
		$res["firstComment"] = '';
		$res["finalComment"] = '';
		if (isset($kgiTeamWeight) && $kgiTeamWeight["status"] = 200) {
			$evaluator = EmployeeEvaluator::find()
				->where(["employeeId" => $kgiTeamWeight["employeeId"], "termId" => $kgiTeamWeight["termId"]])
				->asArray()
				->one();
			if (isset($evaluator) && !empty($evaluator)) {
				if ($evaluator["primaryId"] == $evaluatorId) {
					$res["enableFirst"] = 1;
				}
				if ($evaluator["finalId"] == $evaluatorId) {
					$res["enableFinal"] = 1;
				}
			}
			$res["firstScore"] = $kgiTeamWeight["firstScore"];
			$res["finalScore"] = $kgiTeamWeight["finalScore"];
			$res["firstComment"] = $kgiTeamWeight["firstComment"];
			$res["finalComment"] = $kgiTeamWeight["finalComment"];
		}
		return json_encode($res);
	}
	public function actionSaveKgiTeamEvaluatorPoint()
	{
		$kgiTeamWeightId = $_POST["kgiTeamWeightId"];
		$evaluateeScore = $_POST["evaluateeResult"];
		$kgiTeamWeight = KgiWeight::find()->where(["kgiWeightId" => $kgiTeamWeightId])->one();
		$res = [];
		$res["point"] = 0;
		$everage = 0;
		if (isset($kgiTeamWeight) && !empty($kgiTeamWeight)) {
			$kgiTeamWeight->firstScore = $_POST["firstScore"];
			$kgiTeamWeight->finalScore = $_POST["finalScore"];
			$kgiTeamWeight->firstComment = $_POST["firstComment"];
			$kgiTeamWeight->finalComment = $_POST["finalComment"];
			if ($kgiTeamWeight->save(false)) {
				$res["status"] = true;
				$kgiTeamWeigth = kgiWeight::find()->where(["kgiWeightId" => $kgiTeamWeightId])->one();
				$everage = ((int)$kgiTeamWeigth->firstScore + (int)$kgiTeamWeigth->finalScore + (int)$evaluateeScore) / 3;
				$res["point"] = number_format($everage, 1);
			} else {
				$res["status"] = false;
			}
		} else {
			$res["status"] = false;
		}
		return json_encode($res);
	}
	public function actionSaveKgiTeamEvaluateePoint()
	{
		$kgiTeamWeightId = $_POST["kgiTeamWeightId"];
		$score = $_POST["score"];
		$midComment = $_POST["midComment"];
		$primaryComment = $_POST["primaryComment"];
		$kgiTeamWeight = kgiWeight::find()->where(["kgiWeightId" => $kgiTeamWeightId])->one();
		$kgiTeamWeight->result = $score;
		$kgiTeamWeight->primaryComment = $primaryComment;
		$kgiTeamWeight->midComment = $midComment;
		$everage = 0;
		$res["status"] = false;
		if ($kgiTeamWeight->save(false)) {
			$res["status"] = true;
			$everage = ((int)$kgiTeamWeight->firstScore + (int)$kgiTeamWeight->finalScore + (int)$score) / 3;
			$res["point"] = number_format($everage, 1);
		}
		return json_encode($res);
	}
	public function actionPrepareKpiTeam()
	{
		$kpiId = $_POST["kpiId"];
		$evaluatorId = User::employeeIdFromUserId();
		$kpiTeamWeigthId = $_POST["kpiTeamWeigthId"];

		// $api = curl_init();
		// curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		// curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/team-kpi-weight?kpiTeamWeightId=' . $kpiTeamWeigthId);
		$kpiTeamWeight = Api::connectApi(Path::Api() . 'evaluation/environment/team-kpi-weight?kpiTeamWeightId=' . $kpiTeamWeigthId);
		// $kpiTeamWeight = curl_exec($api);
		// $kpiTeamWeight = json_decode($kpiTeamWeight, true);
		// curl_close($api);

		$kpi = Kpi::find()->select('kpiName')
			->where(["kpiId" => $kpiId])
			->asArray()
			->one();
		$res["status"] = true;
		$res["kpiName"] = $kpi["kpiName"];
		$res["enableFirst"] = 0;
		$res["enableFinal"] = 0;
		$res["firstScore"] = '';
		$res["finalScore"] = '';
		$res["firstComment"] = '';
		$res["finalComment"] = '';
		if (isset($kpiTeamWeight) && $kpiTeamWeight["status"] = 200) {
			$evaluator = EmployeeEvaluator::find()
				->where(["employeeId" => $kpiTeamWeight["employeeId"], "termId" => $kpiTeamWeight["termId"]])
				->asArray()
				->one();
			if (isset($evaluator) && !empty($evaluator)) {
				if ($evaluator["primaryId"] == $evaluatorId) {
					$res["enableFirst"] = 1;
				}
				if ($evaluator["finalId"] == $evaluatorId) {
					$res["enableFinal"] = 1;
				}
			}
			$res["firstScore"] = $kpiTeamWeight["firstScore"];
			$res["finalScore"] = $kpiTeamWeight["finalScore"];
			$res["firstComment"] = $kpiTeamWeight["firstComment"];
			$res["finalComment"] = $kpiTeamWeight["finalComment"];
		}
		return json_encode($res);
	}
	public function actionSaveKpiTeamEvaluatorPoint()
	{
		$kpiTeamWeightId = $_POST["kpiTeamWeightId"];
		$evaluateeScore = $_POST["evaluateeResult"];
		$kpiTeamWeight = KpiTeamWeight::find()->where(["kpiTeamWeightId" => $kpiTeamWeightId])->one();
		$res = [];
		$res["point"] = 0;
		$everage = 0;
		if (isset($kpiTeamWeight) && !empty($kpiTeamWeight)) {
			$kpiTeamWeight->firstScore = $_POST["firstScore"];
			$kpiTeamWeight->finalScore = $_POST["finalScore"];
			$kpiTeamWeight->firstComment = $_POST["firstComment"];
			$kpiTeamWeight->finalComment = $_POST["finalComment"];
			if ($kpiTeamWeight->save(false)) {
				$res["status"] = true;
				$kpiTeamWeigth = KpiTeamWeight::find()->where(["kpiTeamWeightId" => $kpiTeamWeightId])->one();
				$everage = ((int)$kpiTeamWeigth->firstScore + (int)$kpiTeamWeigth->finalScore + (int)$evaluateeScore) / 3;
				$res["point"] = number_format($everage, 1);
			} else {
				$res["status"] = false;
			}
		} else {
			$res["status"] = false;
		}
		return json_encode($res);
	}
	public function actionSaveKpiTeamEvaluateePoint()
	{
		$kpiTeamWeightId = $_POST["kpiTeamWeightId"];
		$score = $_POST["score"];
		$midComment = $_POST["midComment"];
		$primaryComment = $_POST["primaryComment"];
		$kpiTeamWeight = KpiTeamWeight::find()->where(["kpiTeamWeightId" => $kpiTeamWeightId])->one();
		$kpiTeamWeight->result = $score;
		$kpiTeamWeight->primaryComment = $primaryComment;
		$kpiTeamWeight->midComment = $midComment;
		$everage = 0;
		$res["status"] = false;
		if ($kpiTeamWeight->save(false)) {
			$res["status"] = true;
			$everage = ((int)$kpiTeamWeight->firstScore + (int)$kpiTeamWeight->finalScore + (int)$score) / 3;
			$res["point"] = number_format($everage, 1);
		}
		return json_encode($res);
	}
	public function actionPrepareKpiEmployee()
	{
		$kpiId = $_POST["kpiId"];
		$evaluatorId = User::employeeIdFromUserId();
		$kpiEmployeeWeigthId = $_POST["kpiEmployeeWeigthId"];

		// $api = curl_init();
		// curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		// curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/employee-kpi-weight?kpiEmployeeWeightId=' . $kpiEmployeeWeigthId);
		$kpiEmployeeWeight = Api::connectApi(Path::Api() . 'evaluation/environment/employee-kpi-weight?kpiEmployeeWeightId=' . $kpiEmployeeWeigthId);
		// $kpiEmployeeWeight = curl_exec($api);
		// $kpiEmployeeWeight = json_decode($kpiEmployeeWeight, true);
		// curl_close($api);

		$kpi = Kpi::find()->select('kpiName')
			->where(["kpiId" => $kpiId])
			->asArray()
			->one();
		$res["status"] = true;
		$res["kpiName"] = $kpi["kpiName"];
		$res["enableFirst"] = 0;
		$res["enableFinal"] = 0;
		$res["firstScore"] = '';
		$res["finalScore"] = '';
		$res["firstComment"] = '';
		$res["finalComment"] = '';
		if (isset($kpiEmployeeWeight) && $kpiEmployeeWeight["status"] = 200) {
			$evaluator = EmployeeEvaluator::find()
				->where(["employeeId" => $kpiEmployeeWeight["employeeId"], "termId" => $kpiEmployeeWeight["termId"]])
				->asArray()
				->one();
			if (isset($evaluator) && !empty($evaluator)) {
				if ($evaluator["primaryId"] == $evaluatorId) {
					$res["enableFirst"] = 1;
				}
				if ($evaluator["finalId"] == $evaluatorId) {
					$res["enableFinal"] = 1;
				}
			}
			$res["firstScore"] = $kpiEmployeeWeight["firstScore"];
			$res["finalScore"] = $kpiEmployeeWeight["finalScore"];
			$res["firstComment"] = $kpiEmployeeWeight["firstComment"];
			$res["finalComment"] = $kpiEmployeeWeight["finalComment"];
		}
		return json_encode($res);
	}
	public function actionSaveKpiEmployeeEvaluatorPoint()
	{
		$kpiEmployeeWeightId = $_POST["kpiEmployeeWeightId"];
		$evaluateeScore = $_POST["evaluateeResult"];
		$kpiEmployeeWeight = KpiWeight::find()->where(["kpiWeightId" => $kpiEmployeeWeightId])->one();
		$res = [];
		$res["point"] = 0;
		$everage = 0;
		if (isset($kpiEmployeeWeight) && !empty($kpiEmployeeWeight)) {
			$kpiEmployeeWeight->firstScore = $_POST["firstScore"];
			$kpiEmployeeWeight->finalScore = $_POST["finalScore"];
			$kpiEmployeeWeight->firstComment = $_POST["firstComment"];
			$kpiEmployeeWeight->finalComment = $_POST["finalComment"];
			if ($kpiEmployeeWeight->save(false)) {
				$res["status"] = true;
				$kpiEmployeeWeigth = KpiWeight::find()->where(["kpiWeightId" => $kpiEmployeeWeightId])->one();
				$everage = ((int)$kpiEmployeeWeigth->firstScore + (int)$kpiEmployeeWeigth->finalScore + (int)$evaluateeScore) / 3;
				$res["point"] = number_format($everage, 1);
			} else {
				$res["status"] = false;
			}
		} else {
			$res["status"] = false;
		}
		return json_encode($res);
	}
	public function actionSaveKpiEmployeeEvaluateePoint()
	{
		$kpiEmployeeWeightId = $_POST["kpiEmployeeWeightId"];
		$score = $_POST["score"];
		$midComment = $_POST["midComment"];
		$primaryComment = $_POST["primaryComment"];
		$kpiEmployeeWeight = KpiWeight::find()->where(["kpiWeightId" => $kpiEmployeeWeightId])->one();
		$kpiEmployeeWeight->result = $score;
		$kpiEmployeeWeight->primaryComment = $primaryComment;
		$kpiEmployeeWeight->midComment = $midComment;
		$everage = 0;
		$res["status"] = false;
		if ($kpiEmployeeWeight->save(false)) {
			$res["status"] = true;
			$everage = ((int)$kpiEmployeeWeight->firstScore + (int)$kpiEmployeeWeight->finalScore + (int)$score) / 3;
			$res["point"] = number_format($everage, 1);
		}
		return json_encode($res);
	}
}
