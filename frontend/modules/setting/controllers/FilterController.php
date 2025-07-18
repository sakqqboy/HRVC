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

/**
 * Default controller for the `setting` module
 */
// header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
// header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
// header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
// header("Cache-Control: post-check=0, pre-check=0", false);
// header("Pragma: no-cache");
class FilterController extends Controller
{
	public function actionCompanyBranch()
	{
		$branches = [];
		$res = [];
		$text = "<option value=''>Branch</option>";
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/company-branch?id=' . $_POST["companyId"]);
		$branchJson = curl_exec($api);
		$branches = json_decode($branchJson, true);
		curl_close($api);
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
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/branch-team?id=' . $_POST["branchId"]);
		$teams = curl_exec($api);
		$teams = json_decode($teams, true);
		curl_close($api);
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
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/branch-department?id=' . $_POST["branchId"]);
		$departments = curl_exec($api);
		$departments = json_decode($departments, true);
		curl_close($api);
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