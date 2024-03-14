<?php

namespace frontend\modules\evaluation\controllers;


use common\carlendar\Carlendar;
use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
use frontend\models\hrvc\Attribute;
use frontend\models\hrvc\Environment;
use frontend\models\hrvc\Frame;
use frontend\models\hrvc\FrameTerm;
use frontend\models\hrvc\Group;
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
		$date = date('Y-m-d');
		$thisMonth = ModelMaster::monthEng(date('m'), 1);
		$thisYear = date('Y');
		$dateValue = Carlendar::currentMonth($date);
		return $this->render('term_detail', [
			"dateValue" => $dateValue,
			"thisMonth" => $thisMonth,
			"thisYear" => $thisYear,
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
}
