<?php

namespace frontend\modules\evaluation\controllers;

use common\carlendar\Carlendar;
use common\helpers\Path;
use common\models\ModelMaster;
use frontend\models\hrvc\Environment;
use frontend\models\hrvc\Frame;
use frontend\models\hrvc\Group;
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
		$frame = new Frame();
		$frame->frameName = $_POST["frameName"];
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
		//$selectMonth = $month;
		//$selectDate = ModelMaster::engDate($date, 1);
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
