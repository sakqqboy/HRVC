<?php

namespace backend\modules\masterdata\controllers;

use backend\models\hrvc\Branch;
use Exception;
use yii\web\Controller;

/**
 * Default controller for the `masterdata` module
 */
class BranchController extends Controller
{

	public function actionIndex()
	{
		// return $this->render('index');
	}
	public function actionCompanyBranch($id)
	{
		$branch = [];
		$branch = Branch::find()
			->where(["companyId" => $id, "status" => 1])
			->orderBy('branchName')
			->asArray()->all();
		return json_encode($branch);
	}
}
