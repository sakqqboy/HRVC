<?php



namespace frontend\modules\setting\controllers;

use common\helpers\Path;
use common\models\ModelMaster;
use frontend\models\hrvc\Department;
use frontend\models\hrvc\Employee;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\Team;
use yii\web\Controller;
use Yii;

class TempConController extends Controller
{
	/**
	 * Renders the index view for the module
	 * @return string
	 */
	public function beforeAction($action)
	{
		if (!Yii::$app->user->id) {
			return $this->redirect(Yii::$app->homeUrl . 'site/login');
		}
		return true; //go to origin request
	}
	public function actionFilterDraft()
	{
		$companyId = isset($_POST["companyId"]) && $_POST["companyId"] != null ? $_POST["companyId"] : null;
		$branchId = isset($_POST["branchId"]) && $_POST["branchId"] != null ? $_POST["branchId"] : null;
		$departmentId = isset($_POST["departmentId"]) && $_POST["departmentId"] != null ? $_POST["departmentId"] : null;
		$teamId = isset($_POST["teamId"]) && $_POST["teamId"] != null ? $_POST["teamId"] : null;
		$status = isset($_POST["status"]) && $_POST["status"] != null ? $_POST["status"] : null;
		$pageType = $_POST["pageType"];


		return $this->redirect(Yii::$app->homeUrl . 'setting/employee/draft-result/' . ModelMaster::encodeParams([
			"companyId" => $companyId,
			"branchId" => $branchId,
			"departmentId" => $departmentId,
			"teamId" => $teamId,
			"status" => $status,
			"pageType" => $pageType,

		]));
	}
	public function actionDraftResult($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$companyId = $param["companyId"];
		$branchId = $param["branchId"];
		$departmentId = $param["departmentId"];
		$teamId = $param["teamId"];
		$status = $param["status"];
		$pageType = $param["pageType"];
		if ($pageType == 'grid') {
			$file = 'index';
			$action = 'index/';
		} else {
			$file = 'index_list';
			$action = 'employee-list/';
		}
		if ($status == 0) {
			$status = null;
		}
		if ($companyId == "" && $branchId == "" && $teamId == "" && $departmentId == "" && $status == "" && $status == "") {

			return $this->redirect(Yii::$app->homeUrl . 'setting/employee/' . $action . ModelMaster::encodeParams([
				"companyId" => ''
			]));
		}
		$isFromImport = isset($param["import"]) ? $param["import"] : 0;
		$currentPage = 1;
		$limit = 15;
		if (isset($param["currentPage"])) {
			$currentPage = $param["currentPage"];
		}
		$branches = [];
		$departments = [];
		$teams = [];
		$groupId = Group::currentGroupId();
		$employeeFilter = 'companyId=' . $companyId . '&&branchId=' . $branchId . '&&departmentId=' . $departmentId . '&&teamId=' . $teamId . '&&status=' . $status . '&&currentPage=' . $currentPage . '&&limit=' . $limit;
		//throw new exception($employeeFilter);
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/employee/employee-filter?' . $employeeFilter);
		$employees = curl_exec($api);
		$employees = json_decode($employees, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$companies = curl_exec($api);
		$companies = json_decode($companies, true);
		//throw new exception($companyId);
		if ($companyId != '') {
			curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/company-branch?id=' . $companyId);
			$branches = curl_exec($api);
			$branches = json_decode($branches, true);
			// throw new exception(print_r($branches, true));
		}
		if ($branchId != '') {
			$departments = Department::find()->select('departmentId,departmentName')
				->where(["branchId" => $branchId, "status" => 1])->asArray()->orderBy('departmentName')->all();
		}
		if ($departmentId != '') {
			$teams = Team::find()->select('teamId,teamName')
				->where(["departmentId" => $departmentId, "status" => 1])->asArray()->orderBy('teamName')->all();
		}
		curl_close($api);

		$totalEmployee = Employee::totalEmployeeWithFilter($companyId, $branchId, $departmentId, $teamId, $status);
		$totalDraft = Employee::totalDraft($companyId);
		$totalPage = ceil($totalEmployee / 15);
		$pagination = ModelMaster::getPagination($currentPage, $totalPage);
		$filter = [
			"companyId" => $companyId,
			"branchId" => $branchId,
			"teamId" => $teamId,
			"departmentId" => $departmentId,
			"status" => $status == null ? 0 : $status,
			"branches" => $branches,
			"departments" => $departments,
			"teams" => $teams,
		];

		return $this->render($file, [
			"employees" => $employees,
			"companies" => $companies,
			"companyId" => $companyId,
			"branchId" => $branchId,
			"teamId" => $teamId,
			"departmentId" => $departmentId,
			"status" => $status == null ? 0 : $status,
			"branches" => $branches,
			"departments" => $departments,
			"teams" => $teams,
			"isFromImport" => $isFromImport,
			"totalEmployee" => $totalEmployee,
			"totalPage" => $totalPage,
			"currentPage" => $currentPage,
			"pagination" => $pagination,
			"filter" => $filter,
			"totalDraft" => $totalDraft
		]);
	}
}
