<?php

namespace frontend\modules\evaluation\controllers;

use Codeception\Stub\StubMarshaler;
use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
use frontend\models\hrvc\Company;
use frontend\models\hrvc\Department;
use frontend\models\hrvc\Employee;
use frontend\models\hrvc\EmployeeSalary;
use frontend\models\hrvc\EmployeeSalaryHistory;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\Salary;
use frontend\models\hrvc\SalaryStructure;
use frontend\models\hrvc\Structure;
use frontend\models\hrvc\Title;
use Yii;
use yii\db\Expression;
use yii\web\Controller;
use frontend\components\Api;

class SalaryController extends Controller
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

		// $api = curl_init();
		// curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		// curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$companies = Api::connectApi(Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		// $companies = curl_exec($api);
		// $companies = json_decode($companies, true);

		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/salary/all-company-salary');
		$salaries = Api::connectApi(Path::Api() . 'evaluation/salary/all-company-salary');
		// $salaries = curl_exec($api);
		// $salaries = json_decode($salaries, true);

		// //throw new Exception(print_r($salaries, true));
		// curl_close($api);
		return $this->render('index', [
			"companies" => $companies,
			"salaries" => $salaries
		]);
	}
	public function actionCreateSalary()
	{
		$groupId = Group::currentGroupId();

		// $api = curl_init();
		// curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		// curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/salary/structure');
		$structures = Api::connectApi(Path::Api() . 'evaluation/salary/structure');
		// $structures = curl_exec($api);
		// $structures = json_decode($structures, true);

		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$companies = Api::connectApi(Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		// $companies = curl_exec($api);
		// $companies = json_decode($companies, true);

		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/country/all-currency');
		$currencies = Api::connectApi(Path::Api() . 'masterdata/country/all-currency');
		// $currencies = curl_exec($api);
		// $currencies = json_decode($currencies, true);

		// curl_close($api);
		if (isset($_POST["title"])) {
			//throw new Exception(print_r(Yii::$app->request->post(), true));
			$salary = new Salary();
			$salary->companyId = $_POST["company"];
			$salary->departmentId = $_POST["department"];
			$salary->titleId = $_POST["title"];
			$salary->currencyId = $_POST["currency"];
			$salary->status = 1;
			$salary->createDateTime = new Expression('NOW()');
			$salary->updateDateTime = new Expression('NOW()');
			if ($salary->save(false)) {
				$salaryId = Yii::$app->db->lastInsertID;
				if (isset($_POST["allowance"]) && count($_POST["allowance"]) > 0) {
					$salaryStructure = new SalaryStructure();
					$salaryStructure->salaryId = $salaryId;
					$salaryStructure->structureId = 1;
					$salaryStructure->defaultValue = $_POST["defaultValue"][1];
					$salaryStructure->status = 1;
					$salaryStructure->createDateTime = new Expression('NOW()');
					$salaryStructure->updateDateTime = new Expression('NOW()');
					$salaryStructure->save(false);
					foreach ($_POST["allowance"] as $structureId) :
						if (isset($_POST["defaultValue"][$structureId]) && $_POST["defaultValue"][$structureId] != '') {
							$salaryStructure = new SalaryStructure();
							$salaryStructure->salaryId = $salaryId;
							$salaryStructure->structureId = $structureId;
							$salaryStructure->defaultValue = $_POST["defaultValue"][$structureId];
							//$salaryStructure->currencyId = $_POST["currency"];
							$salaryStructure->status = 1;
							$salaryStructure->createDateTime = new Expression('NOW()');
							$salaryStructure->updateDateTime = new Expression('NOW()');
							$salaryStructure->save(false);
						}
					endforeach;
				}
			}
			return $this->redirect('index');
		} else {
			return $this->render('create_salary', [
				"structures" => $structures,
				"companies" => $companies,
				"currencies" => $currencies
			]);
		}
	}
	public function actionUpdateCompanySalary($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$salaryId = $param["salaryId"];

		$groupId = Group::currentGroupId();

		// $api = curl_init();
		// curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		// curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/salary/structure');
		$structures = Api::connectApi(Path::Api() . 'evaluation/salary/structure');
		// $structures = curl_exec($api);
		// $structures = json_decode($structures, true);

		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/salary/salary-detail?salaryId=' . $salaryId);
		$salary = Api::connectApi(Path::Api() . 'evaluation/salary/salary-detail?salaryId=' . $salaryId);
		// $salary = curl_exec($api);
		// $salary = json_decode($salary, true);

		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$companies = Api::connectApi(Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		// $companies = curl_exec($api);
		// $companies = json_decode($companies, true);

		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/country/all-currency');
		$currencies = Api::connectApi(Path::Api() . 'masterdata/country/all-currency');
		// $currencies = curl_exec($api);
		// $currencies = json_decode($currencies, true);

		// //throw new Exception(print_r($salary, true));

		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/company-department?id=' . $salary["companyId"]);
		$departments = Api::connectApi(Path::Api() . 'masterdata/department/company-department?id=' . $salary["companyId"]);
		// $departments = curl_exec($api);
		// $departments = json_decode($departments, true);

		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/department-title?id=' . $salary["departmentId"]);
		$titles = Api::connectApi(Path::Api() . 'masterdata/department/department-title?id=' . $salary["departmentId"]);
		// $titles = curl_exec($api);
		// $titles = json_decode($titles, true);

		// curl_close($api);
		if (isset($_POST["title"])) {
			$salary = Salary::find()->where(["salaryId" => $salaryId])->one();
			$salary->companyId = $_POST["company"];
			$salary->departmentId = $_POST["department"];
			$salary->titleId = $_POST["title"];
			$salary->currencyId = $_POST["currency"];
			$salary->status = 1;
			$salary->updateDateTime = new Expression('NOW()');
			if ($salary->save(false)) {
				if (isset($_POST["allowance"]) && count($_POST["allowance"]) > 0) {
					$salaryStructure = SalaryStructure::find()
						->where(["salaryId" => $salaryId, "structureId" => 1])
						->one();
					$salaryStructure->defaultValue = $_POST["defaultValue"][1];
					$salaryStructure->status = 1;
					$salaryStructure->updateDateTime = new Expression('NOW()');
					$salaryStructure->save(false);
					$oldSalaryId = $this->oldSalaryId($salaryId);
					foreach ($_POST["allowance"] as $structureId) :
						if (isset($_POST["defaultValue"][$structureId]) && $_POST["defaultValue"][$structureId] != '') {
							$salaryStructure = SalaryStructure::find()
								->where(["salaryId" => $salaryId, "structureId" => $structureId])
								->one();
							if (!isset($salaryStructure) || empty($salaryStructure)) {
								$salaryStructure = new SalaryStructure();
								$salaryStructure->structureId = $structureId;
								$salaryStructure->salaryId = $salaryId;
								$salaryStructure->createDateTime = new Expression('NOW()');
							}
							$salaryStructure->defaultValue = $_POST["defaultValue"][$structureId];
							$salaryStructure->status = 1;
							$salaryStructure->updateDateTime = new Expression('NOW()');
							$salaryStructure->save(false);
						}
					endforeach;
					if (count($oldSalaryId) > 0) {
						foreach ($oldSalaryId as $structureId) :
							if (!isset($_POST["defaultValue"][$structureId]) || empty($_POST["defaultValue"][$structureId])) {
								SalaryStructure::updateAll(["status" => 99], ["structureId" => $structureId, "salaryId" => $salaryId]);
							}
						endforeach;
					}
				}
				if (isset($_POST["previousUrl"]) && $_POST["previousUrl"] != "") {
					return $this->redirect($_POST["previousUrl"]);
				} else {
					return $this->redirect('index');
				}
			}
		}
		return $this->render('update_salary', [
			"companies" => $companies,
			"salary" => $salary,
			"departments" => $departments,
			"titles" => $titles,
			"departmentId" => $salary['departmentId'],
			"companyId" => $salary['companyId'],
			"titleId" =>  $salary['titleId'],
			"departmentName" => Department::departmentNAme($salary['departmentId']),
			"companyName" => Company::companyName($salary['companyId']),
			"titleName" => Title::titleName($salary['titleId']),
			"structures" => $structures,
			"currencies" => $currencies,
		]);
	}
	public function oldSalaryId($salaryId)
	{
		$structureId = [];
		$salaryStructure = SalaryStructure::find()->where(["salaryId" => $salaryId])->asArray()->all();
		if (isset($salaryStructure) && count($salaryStructure) > 0) {
			foreach ($salaryStructure as $salary) :
				$structureId[$salary["structureId"]] = $salary["structureId"];
			endforeach;
		}
		return $structureId;
	}
	public function actionAllowance()
	{
		if (isset($_POST["allowanceName"]) && $_POST["allowanceName"] != "") {
			$structure = new Structure();
			$structure->structureName = $_POST["allowanceName"];
			$structure->type = 2; //normal allowance
			$structure->status = 1;
			$structure->createDateTime = new Expression('NOW()');
			$structure->updateDateTime = new Expression('NOW()');
			if ($structure->save(false)) {
				return $this->redirect('allowance');
			}
		}
		// $api = curl_init();
		// curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		// curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/salary/allowance');
		$allowances = Api::connectApi(Path::Api() . 'evaluation/salary/allowance');
		// $allowances = curl_exec($api);
		// $allowances = json_decode($allowances, true);

		// curl_close($api);
		return $this->render('allowance', [
			"allowances" => $allowances
		]);
	}
	public function actionEmployeeAllowance()
	{
		$employeeId = $_POST["employeeId"];
		// $api = curl_init();
		// curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		// curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/salary/employee-allowance?employeeId=' . $employeeId);
		$employeeAllowances = Api::connectApi(Path::Api() . 'evaluation/salary/employee-allowance?employeeId=' . $employeeId);
		// $employeeAllowances = curl_exec($api);
		// $employeeAllowances = json_decode($employeeAllowances, true);
		// curl_close($api);
		$allAllowance = [];
		$employeeName = Employee::employeeName($employeeId);
		$res["employeeName"] = $employeeName;
		if (count($employeeAllowances) > 0) {
			$res["status"] = true;
			$res["allowance"] = $employeeAllowances;
			$allAllowance = Structure::find()
				->select('structureId')
				->where(["status" => 1])
				->asArray()
				->all();
			if (isset($allAllowance) && count($allAllowance) > 0) {
				foreach ($allAllowance as $all) :
					$allAllowance[$all["structureId"]] = $all["structureId"];
				endforeach;
				$res["allAllowance"] = $allAllowance;
			}
		} else {
			$res["status"] = false;
			$structure = [];
			$allowance = Structure::find()
				->select('structureId')
				->where(["status" => 1])
				->asArray()
				->all();
			if (isset($allowance) && count($allowance) > 0) {
				foreach ($allowance as $al) :
					$structure[$al["structureId"]] = $al["structureId"];
				endforeach;
			}
			$res["allowance"] = $structure;
		}
		$employee = Employee::find()->select('departmentId,titleId')->where(["employeeId" => $employeeId])->asArray()->one();
		$salary = Salary::find()->where(["departmentId" => $employee["departmentId"], "titleId" => $employee["titleId"]])->asArray()->one();
		if (isset($salary) && !empty($salary)) {
			$res["issetSalary"] = 1;
		} else {
			$res["issetSalary"] = 0;
		}
		return json_encode($res);
	}
	public function actionAllAllowance()
	{
		$allowance = Structure::find()
			->select('structureId')
			->where(["status" => 1])
			->asArray()
			->all();
		$structure = [];
		if (isset($allowance) && count($allowance) > 0) {
			foreach ($allowance as $al) :
				$structure[$al["structureId"]] = $al["structureId"];
			endforeach;
		}
		$res["allowance"] = $structure;
		return json_encode($res);
	}
	public function actionSaveEmployeeSalary()
	{
		$employeeId = $_POST["employeeId"];
		$employeeAllownce = $_POST["employeeAllownce"];
		$save = 0;
		$res = [];
		if (isset($employeeAllownce) && count($employeeAllownce) > 0) {
			foreach ($employeeAllownce as $structureId => $value) :
				if ($value != '') {
					$value = str_replace(",", "", $value);
					$salaryDetail = EmployeeSalary::find()->where(["employeeId" => $employeeId, "structureId" => $structureId])->one();
					if (!isset($salaryDetail)  || empty($salaryDetail)) {
						$salaryDetail = new EmployeeSalary();
						$salaryDetail->createDateTime = new Expression('NOW()');
					}
					$salaryDetail->employeeId = $employeeId;
					$salaryDetail->structureId = $structureId;
					$salaryDetail->value = $value;
					$salaryDetail->status = 1;
					$salaryDetail->updateDateTime = new Expression('NOW()');
					if ($salaryDetail->save(false)) {
						$save = 1;
					}
				}
			endforeach;
			$history = EmployeeSalaryHistory::find()->where(["employeeId" => $employeeId])->orderBy('createDateTime DESC')->asArray()->one();
			if (isset($history) && !empty($history)) {
				$round = $history["round"] + 1;
			} else {
				$round = 1;
			}
			foreach ($employeeAllownce as $structureId => $value) : //save history
				if ($value != '') {
					$value = str_replace(",", "", $value);
					$newHistory = new EmployeeSalaryHistory();
					$newHistory->employeeId = $employeeId;
					$newHistory->structureId = $structureId;
					$newHistory->value = $value;
					$newHistory->round = $round;
					$newHistory->status = 1;
					$newHistory->createDateTime = new Expression('NOW()');
					$newHistory->updateDateTime = new Expression('NOW()');
					$newHistory->save(false);
				}
			endforeach;
		}
		if ($save == 1) {
			$res["status"] = true;
		}
		return json_encode($res);
		//throw new Exception(print_r(Yii::$app->request->post(), true));
	}

	public function actionRegister($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		//throw new exception(print_r($param, true));
		$companyId = $param["companyId"];
		$department = [];
		$employees = [];
		$title = [];
		$company = [];
		$titleEmployees = [];
		$quartileArr = [];
		$totalEmployeeSalary = 0;
		$departmentTitleAllowances = [];
		$titleId = '';
		$departmentId = '';
		$company = Company::find()
			->select('company.*,c.flag,c.countryName')
			->JOIN("LEFT JOIN", "country c", "c.countryId=company.countryId")
			->where(["company.companyId" => $companyId])
			->asArray()
			->one();
		$salary = Salary::find()
			->where(["companyId" => $companyId, "status" => 1])
			->asArray()
			->one();
		// $api = curl_init();
		// curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		// curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/company-department?id=' . $companyId);
		$departments = Api::connectApi(Path::Api() . 'masterdata/department/company-department?id=' . $companyId);
		// $departments = curl_exec($api);
		// $departments = json_decode($departments, true);
		if (isset($salary) && !empty($salary)) {
			$department = Department::find()->where(["departmentId" => $salary["departmentId"]])->asArray()->one();
			$title = Title::find()->where(["titleId" => $salary["titleId"]])->asArray()->one();
		// 	curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/employee/employee-department-title-by-department?departmentId=' . $salary['departmentId']);
		$employees = Api::connectApi(Path::Api() . 'masterdata/employee/employee-department-title-by-department?departmentId=' . $salary['departmentId']);
		// 	$employees = curl_exec($api);
		// 	$employees = json_decode($employees, true);

		// 	curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/salary/department-title-allowance?departmentId=' . $salary['departmentId'] . '&&titleId=' . $salary['titleId']);
		$departmentTitleAllowances = Api::connectApi(Path::Api() . 'evaluation/salary/department-title-allowance?departmentId=' . $salary['departmentId'] . '&&titleId=' . $salary['titleId']);
		// 	$departmentTitleAllowances = curl_exec($api);
		// 	$departmentTitleAllowances = json_decode($departmentTitleAllowances, true);

		// 	curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/salary/title-employee-allowance?departmentId=' . $salary['departmentId'] . '&&titleId=' . $salary['titleId']);
		$titleEmployees = Api::connectApi(Path::Api() . 'evaluation/salary/title-employee-allowance?departmentId=' . $salary['departmentId'] . '&&titleId=' . $salary['titleId']);
		// 	$titleEmployees = curl_exec($api);
		// 	$titleEmployees = json_decode($titleEmployees, true);

		// 	curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/salary/quartile?departmentId=' . $salary['departmentId'] . '&&titleId=' . $salary['titleId']);
		$quartileArr = Api::connectApi(Path::Api() . 'evaluation/salary/quartile?departmentId=' . $salary['departmentId'] . '&&titleId=' . $salary['titleId']);
		// 	$quartileArr = curl_exec($api);
		// 	$quartileArr = json_decode($quartileArr, true);
			$totalEmployeeSalary = EmployeeSalary::totalEmployeeSalary($salary["departmentId"], $salary["titleId"]);
			$titleId = $salary['titleId'];
			$departmentId = $salary['departmentId'];
			if ($departmentId != null) {
		// 		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/department-title?id=' . $departmentId);
		$titles = Api::connectApi(Path::Api() . 'masterdata/department/department-title?id=' . $departmentId);
				// $titles = curl_exec($api);
				// $titles = json_decode($titles, true);
			}
		}
		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/salary/allowance');
		$allowances = Api::connectApi(Path::Api() . 'evaluation/salary/allowance');
		// $allowances = curl_exec($api);
		// $allowances = json_decode($allowances, true);

		// curl_close($api);
		return $this->render('register_salary', [
			"company" => $company,
			"department" => $department,
			"title" => $title,
			"employees" => $employees,
			"allowances" => $allowances,
			"departmentTitleAllowances" => $departmentTitleAllowances,
			"titleEmployees" => $titleEmployees,
			"quartileArr" => $quartileArr,
			"totalEmployeeSalary" => $totalEmployeeSalary,
			"departments" => $departments,
			"departmentId" => $departmentId,
			"titleId" => $titleId,
			"companyId" => $companyId,
			"titles" => $titles,
		]);
	}
	public function actionCheckDupplicate()
	{
		$titleId = $_POST['titleId'];
		$salary = Salary::find()->where(["status" => 1, "titleId" => $titleId])->one();
		if (isset($salary) && !empty($salary)) {
			$res["status"] = true;
		} else {
			$res["status"] = false;
		}
		return json_encode($res);
	}
	public function actionCheckDupplicateAllowance()
	{
		$allowanceName = $_POST['allowanceName'];
		$allowance = Structure::find()->where(["structureName" => $allowanceName, "status" => 1])->one();
		if (isset($allowance) && !empty($allowance)) {
			$res["status"] = true;
		} else {
			$res["status"] = false;
		}
		return json_encode($res);
	}
	public function actionDeleteAllowance()
	{
		Structure::updateAll(["status" => 99], ["structureId" => $_POST["structureId"]]);
		$res["status"] = true;
		return json_encode($res);
	}
	public function actionPrepareUpdateAllowance()
	{
		$allowance = Structure::find()
			->select('structureName')
			->where(["structureId" => $_POST["structureId"]])->asArray()->one();
		$res["status"] = true;
		$res["allowanceName"] = $allowance["structureName"];
		return json_encode($res);
	}
	public function actionUpdateAllowance()
	{
		$allowance = Structure::find()->where(["structureName" => $_POST['newName'], "status" => 1])->one();
		if (isset($allowance) && !empty($allowance)) {
			$res["status"] = false;
		} else {
			$allowance = Structure::find()
				->where(["structureId" => $_POST["structureId"]])
				->one();
			$allowance->updateDateTime = new Expression('NOW()');
			$allowance->structureName = $_POST['newName'];
			$allowance->save(false);
			$res["status"] = true;
		}
		return json_encode($res);
	}
	public function actionFilterSalary()
	{
		return $this->redirect(Yii::$app->homeUrl . 'evaluation/salary/filter-salary-result/' . ModelMaster::encodeParams([
			"companyId" => isset($_POST["companyId"]) ? $_POST["companyId"] : null,
			"departmentId" => isset($_POST["departmentId"]) ? $_POST["departmentId"] : null,
			"titleId" => isset($_POST["titleId"]) ? $_POST["titleId"] : null,
		]));
	}
	public function actionFilterSalaryResult($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$companyId = $param["companyId"];
		$departmentId = $param["departmentId"];
		$titleId = $param["titleId"];

		$departments = [];
		$titles = [];
		$groupId = Group::currentGroupId();
		// $api = curl_init();
		// curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		// curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		$textParam = "companyId=$companyId&&departmentId=$departmentId&&titleId=$titleId";
		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/salary/filter-salary?' . $textParam);
		$salaries = Api::connectApi(Path::Api() . 'evaluation/salary/filter-salary?' . $textParam);
		// $salaries = curl_exec($api);
		// $salaries = json_decode($salaries, true);

		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$companies = Api::connectApi(Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		// $companies = curl_exec($api);
		// $companies = json_decode($companies, true);

		if ($companyId !== null) {
		// 	curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/company-department?id=' . $companyId);
		$departments = Api::connectApi(Path::Api() . 'masterdata/department/company-department?id=' . $companyId);
		// 	$departments = curl_exec($api);
		// 	$departments = json_decode($departments, true);
			if ($departmentId != null) {
		// 		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/department-title?id=' . $departmentId);
		$titles = Api::connectApi(Path::Api() . 'masterdata/department/department-title?id=' . $departmentId);
		// 		$titles = curl_exec($api);
		// 		$titles = json_decode($titles, true);
			}
		}
		// curl_close($api);
		//throw new exception($companyId);
		return $this->render('index', [
			"companies" => $companies,
			"salaries" => $salaries,
			"departments" => $departments,
			"titles" => $titles,
			"departmentId" => $departmentId,
			"companyId" => $companyId,
			"titleId" => $titleId,
			"departmentName" => Department::departmentNAme($departmentId),
			"companyName" => Company::companyName($companyId),
			"titleName" => Title::titleName($titleId),
		]);
	}
	public function actionFilterSalaryRegister()
	{
		return $this->redirect(Yii::$app->homeUrl . 'evaluation/salary/filter-salary-register-result/' . ModelMaster::encodeParams([
			"departmentId" => isset($_POST["departmentId"]) ? $_POST["departmentId"] : null,
			"titleId" => isset($_POST["titleId"]) ? $_POST["titleId"] : "",
			"companyId" => isset($_POST["companyId"]) ? $_POST["companyId"] : null,
		]));
	}
	public function actionFilterSalaryRegisterResult($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$department = [];
		$employees = [];
		$title = [];
		$titleEmployees = [];
		$quartileArr = [];
		$company = [];
		$departments = [];
		$totalEmployeeSalary = 0;
		$departmentTitleAllowances = [];
		//throw new Exception($param["titleId"]);
		$salary = Salary::find()
			->where(["departmentId" => $param["departmentId"], "titleId" => $param["titleId"], "status" => 1])
			->asArray()
			->one();
		if ($param["titleId"] != '') {
			$titles = Title::find()->select('titleId,titleName')
				->where(["departmentId" => $param['departmentId'], "status" => 1])
				->andWhere("titleId!=" . $param["titleId"])
				//->andFilterWhere(["titleId" => $param["titleId"]])
				->asArray()
				->orderBy('titleName')
				->all();
		} else {
			$titles = Title::find()->select('titleId,titleName')
				->where(["departmentId" => $param['departmentId'], "status" => 1])
				->asArray()
				->orderBy('titleName')
				->all();
		}

		$company = Company::find()
			->select('company.*,c.flag,c.countryName')
			->JOIN("LEFT JOIN", "country c", "c.countryId=company.countryId")
			->where(["company.companyId" =>  $param["companyId"]])
			->asArray()
			->one();
		// $api = curl_init();
		// curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		// curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/company-department?id=' . $param["companyId"]);
		$departments = Api::connectApi(Path::Api() . 'masterdata/department/company-department?id=' . $param["companyId"]);
		// $departments = curl_exec($api);
		// $departments = json_decode($departments, true);

		if (isset($salary) && !empty($salary)) {
			$department = Department::find()->where(["departmentId" => $salary["departmentId"]])->asArray()->one();
			$title = Title::find()->where(["titleId" => $salary["titleId"]])->asArray()->one();

		// 	curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/employee/employee-department-title-by-department?departmentId=' . $salary['departmentId']);
		$employees = Api::connectApi(Path::Api() . 'masterdata/employee/employee-department-title-by-department?departmentId=' . $salary['departmentId']);
		// 	$employees = curl_exec($api);
		// 	$employees = json_decode($employees, true);

		// 	curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/salary/department-title-allowance?departmentId=' . $salary['departmentId'] . '&&titleId=' . $salary['titleId']);
		$departmentTitleAllowances = Api::connectApi(Path::Api() . 'evaluation/salary/department-title-allowance?departmentId=' . $salary['departmentId'] . '&&titleId=' . $salary['titleId']);
		// 	$departmentTitleAllowances = curl_exec($api);
		// 	$departmentTitleAllowances = json_decode($departmentTitleAllowances, true);

		// 	curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/salary/title-employee-allowance?departmentId=' . $salary['departmentId'] . '&&titleId=' . $salary['titleId']);
		$titleEmployees = Api::connectApi(Path::Api() . 'evaluation/salary/title-employee-allowance?departmentId=' . $salary['departmentId'] . '&&titleId=' . $salary['titleId']);
		// 	$titleEmployees = curl_exec($api);
		// 	$titleEmployees = json_decode($titleEmployees, true);

		// 	curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/salary/quartile?departmentId=' . $salary['departmentId'] . '&&titleId=' . $salary['titleId']);
		$quartileArr = Api::connectApi(Path::Api() . 'evaluation/salary/quartile?departmentId=' . $salary['departmentId'] . '&&titleId=' . $salary['titleId']);
		// 	$quartileArr = curl_exec($api);
		// 	$quartileArr = json_decode($quartileArr, true);
			$totalEmployeeSalary = EmployeeSalary::totalEmployeeSalary($salary["departmentId"], $salary["titleId"]);
		}
		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/salary/allowance');
		$allowances = Api::connectApi(Path::Api() . 'evaluation/salary/allowance');
		// $allowances = curl_exec($api);
		// $allowances = json_decode($allowances, true);

		// curl_close($api);
		return $this->render('register_salary', [
			"company" => $company,
			"department" => $department,
			"title" => $title,
			"employees" => $employees,
			"allowances" => $allowances,
			"departmentTitleAllowances" => $departmentTitleAllowances,
			"titleEmployees" => $titleEmployees,
			"quartileArr" => $quartileArr,
			"totalEmployeeSalary" => $totalEmployeeSalary,
			"departments" => $departments,
			"departmentId" => $param["departmentId"],
			"titleId" => $param["titleId"],
			"titles" => $titles,
			"companyId" => $param["companyId"]
		]);
	}
	public function actionDeleteCompanySalary()
	{
		$salaryId = $_POST["salaryId"];
		Salary::deleteAll(["salaryId" => $salaryId]);
		SalaryStructure::deleteAll(["salaryId" => $salaryId]);
		$res["status"] = true;
		return json_encode($res);
	}
	public function actionDeleteEmployeeSalary()
	{
		$employeeId = $_POST["employeeId"];
		EmployeeSalary::updateAll(["status" => 99], ["employeeId" => $employeeId]);
		EmployeeSalaryHistory::updateAll(["status" => 99], ["employeeId" => $employeeId]);
		$res["status"] = true;
		return json_encode($res);
	}
}
