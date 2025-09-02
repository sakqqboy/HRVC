<?php

namespace frontend\modules\kfi\controllers;

use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
use frontend\components\Api;
use frontend\models\hrvc\Branch;
use frontend\models\hrvc\Company;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\UserRole;
use Yii;
use yii\db\Expression;
use yii\web\Controller;

/**
 * Default controller for the `kgi` module
 */
class AssignController extends Controller
{
	public function beforeAction($action)
	{
		if (Yii::$app->user->id == '') {
			Yii::$app->response->redirect(Yii::$app->homeUrl . 'site/login');
			return false;
		}
		$isManager = UserRole::isManager();
		if ($isManager == 0) {
			Yii::$app->response->redirect(Yii::$app->homeUrl . 'kfi/management/index');
			return false;
		}
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			Yii::$app->response->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
			return false;
		}
		$role = UserRole::userRight();
		if ($role < 3) {
			Yii::$app->response->redirect(Yii::$app->homeUrl . 'kfi/management/index');
			return false;
		}
		return parent::beforeAction($action);
	}
	public function actionAssign($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$role = UserRole::userRight();

		$kfiId = $param["kfiId"];
		//throw new Exception($kfiId);
		$companyId = $param["companyId"];
		$url = $param["url"] ?? Yii::$app->request->referrer;
		$role = UserRole::userRight();
		if ($role < 3) {
			return $this->redirect(Yii::$app->homeUrl . 'kfi/management/index');
		}

		$teams = Api::connectApi(Path::Api() . 'masterdata/team/company-team?id=' . $companyId);
		$kfiDetail = Api::connectApi(Path::Api() . 'kfi/management/kfi-detail?kfiId=' . $kfiId . "&&kfiHistoryId=0");
		$text = '';
		$kfiTeamEmployee = Api::connectApi(Path::Api() . 'kfi/management/kfi-team-employee?kfiId=' . $kfiId . '&&companyId=' . $companyId);;
		$allCompany = Api::connectApi(Path::Api() . 'masterdata/company/all-company');

		$countAllCompany = 0;
		if (count($allCompany) > 0) {
			$countAllCompany = count($allCompany);
			$companyPic = Company::randomPic($allCompany, 3);
		}
		$totalBranch = Branch::totalBranch();
		return $this->render('assign', [
			"role" => $role,
			"kfiDetail" => $kfiDetail,
			"kfiId" => $kfiId,
			"teams" => $teams,
			"text" => $text,
			"kfiTeamEmployee" => $kfiTeamEmployee,
			"companyId" => $companyId,
			"url" => $url,
			"allCompany" => $countAllCompany,
			"companyPic" => $companyPic,
			"totalBranch" => $totalBranch,
		]);
	}
}
