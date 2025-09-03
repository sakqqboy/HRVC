<?php

namespace frontend\modules\setting\controllers;

use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
use frontend\models\hrvc\Branch;
use frontend\models\hrvc\Employee;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\Team;
use Yii;
use yii\db\Expression;
use yii\web\Controller;
use frontend\components\Api;

/**
 * Default controller for the `setting` module
 */
class FilterController extends Controller
{
	public function actionCompanyBranch()
	{
		$branches = [];
		$res = [];
		$text = "<option value=''>Branch</option>";
		$branches = Api::connectApi(Path::Api() . 'masterdata/branch/company-branch?id=' . $_POST["companyId"]);

		if (isset($branches) && count($branches) > 0) {
			foreach ($branches as $branch) :
				$text .= '<option value="' . $branch["branchId"] . '">' . $branch["branchName"] . '</opotion>';
			endforeach;
		}
		$res["status"] = true;
		$res["text"] = $text;
		return json_encode($res);
	}
	public function actionBranchTeam()
	{
		$teams = [];
		$res = [];
		$text = "<option value=''>Team</option>";
		$teams = Api::connectApi(Path::Api() . 'masterdata/branch/branch-team?id=' . $_POST["branchId"]);
		if (isset($teams) && count($teams) > 0) {
			foreach ($teams as $team) :
				$text .= '<option value="' . $team["teamId"] . '">' . $team["teamName"] . '</opotion>';
			endforeach;
		}
		$res["status"] = true;
		$res["text"] = $text;
		return json_encode($res);
	}
	public function actionBranchDepartment()
	{
		$teams = [];
		$res = [];
		$text = "<option value=''>Department</option>";
		$departments = Api::connectApi(Path::Api() . 'masterdata/branch/branch-department?id=' . $_POST["branchId"]);
		if (isset($departments) && count($departments) > 0) {
			foreach ($departments as $department) :
				$text .= '<option value="' . $department["departmentId"] . '">' . $department["departmentName"] . '</opotion>';
			endforeach;
		}
		$res["status"] = true;
		$res["text"] = $text;
		return json_encode($res);
	}
	public function actionEmployeeTeam()
	{
		$res = [];
		$text = "<option value=''>Employee</option>";
		$employee = Team::employeeInTeamDetail($_POST["teamId"]);
		if (isset($employee) && count($employee) > 0) {
			foreach ($employee as $e) :
				$text .= '<option value="' . $e["employeeId"] . '">' . $e["employeeFirstname"] . ' ' . $e["employeeSurename"] . '</opotion>';
			endforeach;
		}

		$res["status"] = true;
		$res["text"] = $text;
		return json_encode($res);
	}
}