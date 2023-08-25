<?php

namespace backend\modules\masterdata\controllers;

use backend\models\hrvc\Role;
use Exception;
use yii\web\Controller;

/**
 * Default controller for the `masterdata` module
 */
class RoleController extends Controller
{
	public function actionActiveRole()
	{
		$role = Role::find()->where(["status" => 1])->orderBy('roleId')->asArray()->all();
		return json_encode($role);
	}
}
