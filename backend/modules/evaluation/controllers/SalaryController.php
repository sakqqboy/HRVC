<?php

namespace backend\modules\evaluation\controllers;

use backend\models\hrvc\Currency;
use backend\models\hrvc\Department;
use backend\models\hrvc\Employee;
use backend\models\hrvc\EmployeeSalary;
use backend\models\hrvc\EmployeeSalaryHistory;
use backend\models\hrvc\Group;
use backend\models\hrvc\Salary;
use backend\models\hrvc\SalaryStructure;
use backend\models\hrvc\Structure;
use backend\models\hrvc\Title;
use Yii;
use yii\web\Controller;

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
class SalaryController extends Controller
{

	public function actionIndex()
	{
		return $this->render('index');
	}
	public function actionStructure()
	{
		$structure = Structure::find()
			->select('structureId,structureName')
			->where(["status" => 1, "type" => 2])
			->orderBy('structureName')
			->asArray()
			->all();
		return json_encode($structure);
	}
	public function actionAllCompanySalary()
	{
		$salaryies = Salary::find()
			->where(["status" => 1])
			->orderBy('companyId,departmentId,titleId')
			->asArray()
			->all();
		$data = [];
		if (isset($salaryies) && count($salaryies) > 0) {
			foreach ($salaryies as $salary) :
				$data[$salary["companyId"]][$salary["departmentId"]][$salary["titleId"]] = [
					"departmentName" => Department::departmentName($salary["departmentId"]),
					"titleName" => Title::titleName($salary["titleId"]),
					"salaryAllowances" => SalaryStructure::salaryStructure($salary["salaryId"]),
					"salaryId" => $salary["salaryId"],
					"currency" => Currency::currencyName($salary["currencyId"])
				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionSalaryDetail($salaryId)
	{
		$salary = Salary::find()
			->where(["salaryId" => $salaryId])
			->asArray()
			->one();
		$data = [];
		if (isset($salary) && !empty($salary)) {
			$data = [
				"departmentName" => Department::departmentName($salary["departmentId"]),
				"titleName" => Title::titleName($salary["titleId"]),
				"salaryAllowances" => SalaryStructure::salaryStructureUpdate($salary["salaryId"]),
				"companyId" => $salary["companyId"],
				"departmentId" => $salary["departmentId"],
				"titleId" => $salary["titleId"],
				"currency" => Currency::currencyName($salary["currencyId"]),
				"currencyId" => $salary["currencyId"]
			];
		}
		return json_encode($data);
	}
	public function actionAllowance()
	{
		$allowance = Structure::find()
			->where(["type" => 2, "status" => 1])
			->asArray()
			->orderBy('structureName')
			->all();
		return json_encode($allowance);
	}
	public function actionFilterSalary($companyId, $departmentId, $titleId)
	{
		$salaryies = Salary::find()
			->where(["status" => 1])
			->andFilterWhere([
				"companyId" => $companyId,
				"departmentId" => $departmentId,
				"titleId" => $titleId
			])
			->orderBy('companyId,departmentId,titleId')
			->asArray()
			->all();
		$data = [];
		if (isset($salaryies) && count($salaryies) > 0) {
			foreach ($salaryies as $salary) :
				$data[$salary["companyId"]][$salary["departmentId"]][$salary["titleId"]] = [
					"departmentName" => Department::departmentName($salary["departmentId"]),
					"titleName" => Title::titleName($salary["titleId"]),
					"salaryId" => $salary["salaryId"],
					"salaryAllowances" => SalaryStructure::salaryStructure($salary["salaryId"]),
					"currency" => Currency::currencyName($salary["currencyId"]),
					"currencyId" => $salary["currencyId"]
				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionEmployeeAllowance($employeeId)
	{
		$employeeAllowance = EmployeeSalary::find()
			->where(["employeeId" => $employeeId, "status" => 1])
			->orderBy('structureId DESC')
			->asArray()
			->all();
		$data = [];
		if (isset($employeeAllowance) && count($employeeAllowance) > 0) {
			$findRound = EmployeeSalaryHistory::find()
				->where(["employeeId" => $employeeId, "status" => 1])
				->orderBy('createDateTime DESC')
				->asArray()
				->one();
			if (isset($employeeAllowanceHistory) && !empty($employeeAllowanceHistory)) {
				$round = $findRound["round"];
			} else {
				$round = 0;
			}
			$employeeAllowanceHistory = EmployeeSalaryHistory::find()
				->where(["employeeId" => $employeeId, "status" => 1, "round" => $round])
				->asArray()
				->all();
			if (isset($employeeAllowanceHistory) && count($employeeAllowanceHistory) > 0) {
				foreach ($employeeAllowanceHistory as $allowanceHistory) :
					$data[$allowanceHistory["structureId"]] = [
						"value" => number_format($allowanceHistory["value"])
					];
				endforeach;
			} else {
				foreach ($employeeAllowance as $allowance) :
					$data[$allowance["structureId"]] = [
						"value" => number_format($allowance["value"])
					];
				endforeach;
			}
			$data["hasSalary"] = 1;
		} else {
			$employee = Employee::find()
				->select('companyId,departmentId,titleId')
				->where(["employeeId" => $employeeId])
				->asArray()
				->one();
			$salary = Salary::find()
				->where([
					"companyId" => $employee["companyId"],
					"departmentId" => $employee["departmentId"],
					"titleId" => $employee["titleId"],
				])
				->asArray()
				->one();
			if (isset($salary) && !empty($salary)) {
				$employeeAllowance = SalaryStructure::find()
					->where([
						"salaryId" => $salary["salaryId"],
						"status" => 1
					])
					->all();
				if (isset($employeeAllowance) && count($employeeAllowance) > 0) {
					foreach ($employeeAllowance as $allowance) :
						$data[$allowance["structureId"]] = [
							"value" => number_format($allowance["defaultValue"])
						];
					endforeach;
				}
			}
			$data["hasSalary"] = 0;
		}
		return json_encode($data);
	}
	public function actionDepartmentTitleAllowance($departmentId, $titleId)
	{
		$salary = Salary::find()
			->where(["departmentId" => $departmentId, "titleId" => $titleId, "status" => 1])
			->asArray()->one();
		$data = [];
		if (isset($salary)  && !empty($salary)) {
			$salaryStructure = SalaryStructure::find()
				->select('s.structureName,salary_structure.defaultValue,salary_structure.salaryStructureId,salary_structure.structureId')
				->JOIN("LEFT JOIN", "structure s", "s.structureId=salary_structure.structureId")
				->where(["salary_structure.salaryId" => $salary["salaryId"], "salary_structure.status" => 1])
				->orderBy('salary_structure.structureId')
				->asArray()
				->all();
			if (isset($salaryStructure) && count($salaryStructure) > 0) {
				foreach ($salaryStructure as $ss) :
					$data[$ss["structureId"]] = [
						"defaultValue" => $ss["defaultValue"],
						"structureName" => $ss["structureName"]
					];
				endforeach;
			}
		}
		return json_encode($data);
	}
	public function actionTitleEmployeeAllowance($departmentId, $titleId)
	{
		$employees = Employee::find()
			->where(["status" => 1, "titleId" => $titleId, "departmentId" => $departmentId])
			->orderBy('employeeFirstname')
			->asArray()
			->all();
		$data = [];
		if (isset($employees) && count($employees) > 0) {
			foreach ($employees as $employee) :
				$data[$employee["employeeId"]] = [
					"firstname" => $employee["employeeFirstname"],
					"surename" => $employee["employeeSurename"],
					"picture" => $employee["picture"],
					"department" => Department::departmentName($employee["departmentId"]),
					"title" => Title::titleName($employee["titleId"]),
					"allowances" => EmployeeSalary::employeeAllowance($employee["employeeId"], $departmentId, $titleId)
				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionQuartile($departmentId, $titleId)
	{
		$employeeSalary = EmployeeSalary::find()
			->select('employee_salary.value,employee_salary.employeeId')
			->JOIN("LEFT JOIN", "employee e", "e.employeeId=employee_salary.employeeId")
			->where([
				"employee_salary.status" => 1,
				"e.status" => 1,
				"e.departmentId" => $departmentId,
				"e.titleId" => $titleId
			])
			->all();
		$salary = [];
		$data["q1"] = 0;
		$data["q2"] = 0;
		$data["q3"] = 0;
		$data["min"] = 0;
		$data["max"] = 0;
		if (isset($employeeSalary) && count($employeeSalary) > 0) {
			foreach ($employeeSalary as $es) :
				if (isset($salary[$es["employeeId"]])) {
					$salary[$es["employeeId"]] += $es["value"];
				} else {
					$salary[$es["employeeId"]] = $es["value"];
				}
			endforeach;
		}
		//$salary = [14, 15, 16, 17, 18, 19, 19, 20, 21, 22, 23, 24, 25, 25, 26, 27, 28, 29, 30, 31];
		//$salary = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11];
		//$salary = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21];
		if (count($salary) > 0) {
			$a = count($salary);
			sort($salary);
			$data["min"] = $salary[0];
			$data["max"] = $salary[$a - 1];
			if (count($salary) % 2 == 0) { //even number คู่
				$useIndexQ21 = floor((count($salary) + 1) / 2) - 1;
				$useIndexQ22 = $useIndexQ21 + 1;
				$q2 = ($salary[$useIndexQ21] + $salary[$useIndexQ22]) / 2;
				if (($useIndexQ21 + 1) % 2 == 0) {
					$indexQ11 = floor(($useIndexQ21 + 1) / 2) - 1;
					$indexQ12 = $indexQ11 + 1;
					$q1 = ($salary[$indexQ11] + $salary[$indexQ12]) / 2;
				} else {
					$indexQ1 = $useIndexQ21 / 2;
					$q1 = $salary[$indexQ1];
				}
				if (($useIndexQ22 + 1) % 2 == 0) {
					$indexQ3 = $useIndexQ22 + ((count($salary) - ($useIndexQ22 + 1)) / 2);
					$q3 = $salary[$indexQ3];
				} else {
					$indexQ31 = ($useIndexQ22 + floor(((count($salary) - $useIndexQ22) + 1) / 2)) - 1;
					$indexQ32 = $indexQ31 + 1;
					$q3 = ($salary[$indexQ31] + $salary[$indexQ32]) / 2;
				}
			} else { //odd number คี่
				$useIndexQ21 = floor((count($salary) + 1) / 2) - 1;
				$q2 = $salary[$useIndexQ21];
				if (($useIndexQ21 + 1) % 2 == 0) {
					$indexQ11 = (($useIndexQ21 + 1) / 2) - 1;
					$q1 = $salary[$indexQ11];
					$indexQ31 = $useIndexQ21 + ((count($salary) - ($useIndexQ21)) / 2);
					$q3 = $salary[$indexQ31];
				} else {
					$indexQ11 = floor(($useIndexQ21 + 1) / 2) - 1;
					$indexQ12 = $indexQ11 + 1;
					$q1 = ($salary[$indexQ11] + $salary[$indexQ12]) / 2;

					$indexQ31 = floor((count($salary) - $useIndexQ21) / 2) + $useIndexQ21;
					$indexQ32 = $indexQ31 + 1;
					$q3 = ($salary[$indexQ31] + $salary[$indexQ32]) / 2;
				}
			}
			$data["q1"] = $q1;
			$data["q2"] = $q2;
			$data["q3"] = $q3;
		}
		return json_encode($data);
	}
}
