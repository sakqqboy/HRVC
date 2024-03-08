<?php

namespace frontend\modules\evaluation\controllers;

use common\carlendar\Carlendar;
use common\helpers\Path;
use common\models\ModelMaster;
use frontend\models\hrvc\Environment;
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
		]);
	}
}
