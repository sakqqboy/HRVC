<?php

namespace backend\modules\masterdata\controllers;

use backend\models\hrvc\Role;
use backend\models\hrvc\User;
use backend\models\hrvc\UserRole;
use Exception;
use yii\web\Controller;

/**
 * Default controller for the `masterdata` module
 */
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
class RoleController extends Controller
{
	public function actionActiveRole()
	{
		$role = Role::find()->where(["status" => 1])->orderBy('roleId')->asArray()->all();
		return json_encode($role);
	}

	public function actionEmployeeRole($id)
	{
		$user = User::find()->select('userId')->where(["employeeId" => $id])->asArray()->one();
		$userRole = UserRole::find()
			->select('r.roleName,r.roleId')
			->JOIN("LEFT JOIN", "role r", "r.roleId=user_role.roleId")
			->where(["user_role.userId" => $user["userId"]])
			->asArray()
			->all();
		$userRoles = [];
		if (isset($userRole) && count($userRole) > 0) {
			foreach ($userRole as $us) :
				$userRoles[$us["roleId"]] = $us["roleName"];
			endforeach;
		}
		return json_encode($userRoles);
	}
}
