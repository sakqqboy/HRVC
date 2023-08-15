<?php

namespace backend\modules\masterdata\controllers;

use backend\models\hrvc\Company;
use Exception;
use yii\web\Controller;

/**
 * Default controller for the `masterdata` module
 */
class CompanyController extends Controller
{
	/**
	 * Renders the index view for the module
	 * @return string
	 */
	public function actionIndex()
	{
		return $this->render('index');
	}
	public function actionCompanyDetail($id)
	{
		$company = [];
		$company = Company::find()->where(["companyId" => $id])->asArray()->one();
		return json_encode($company);
	}
	public function actionHeader($id)
	{
		$headQuater = Company::find()
			->select('companyId,companyName')
			->where(["groupId" => $id, "headQuaterId" => null])
			->asArray()
			->one();
		return json_encode($headQuater);
	}
}
