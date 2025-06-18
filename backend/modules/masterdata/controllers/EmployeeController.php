<?php

namespace backend\modules\masterdata\controllers;

use backend\models\hrvc\Certificate;
use backend\models\hrvc\Company;
use backend\models\hrvc\DefaultLanguage;
use backend\models\hrvc\Department;
use backend\models\hrvc\Employee;
use backend\models\hrvc\EmployeeCondition;
use backend\models\hrvc\EmployeeSalary;
use backend\models\hrvc\Language;
use backend\models\hrvc\Module;
use backend\models\hrvc\PimWeight;
use backend\models\hrvc\Status;
use backend\models\hrvc\Title;
use backend\models\hrvc\UserAccess;
use backend\models\hrvc\UserLanguage;
use backend\models\hrvc\UserRole;
use common\models\ModelMaster;
use Exception;
use frontend\models\hrvc\User;
use yii\web\Controller;

/**
 * Default controller for the `masterdata` module
 */
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
class EmployeeController extends Controller
{
	public function actionEmployeeDetail($id)
	{
		$employee = Employee::find()
			->select('employee.*,c.companyName,co.countryName,co.flag,t.titleName,b.branchName,
			condition.employeeConditionName,s.statusName,na.nationalityName,c.city,t.shortTag')
			->JOIN("LEFT JOIN", "company c", "c.companyId=employee.companyId")
			->JOIN("LEFT JOIN", "branch b", "b.branchId=employee.branchId")
			->JOIN("LEFT JOIN", "title t", "t.titleId=employee.titleId")
			->JOIN("LEFT JOIN", "country co", "co.countryId=c.countryId")
			->JOIN("LEFT JOIN", "nationality na", "na.numCode=employee.nationalityId")
			//->JOIN("LEFT JOIN", "employee_status es", "es.employeeId=employee.employeeId")
			->JOIN("LEFT JOIN", "status s", "s.statusId=employee.status")
			->JOIN("LEFT JOIN", "employee_condition condition", "condition.employeeConditionId=employee.employeeConditionId")
			->where(["employee.employeeId" => $id])
			->asArray()
			->one();
		return json_encode($employee);
	}
	public function actionAllEmployeeDetail($companyId, $currentPage, $limit)
	{
		$startAt = (($currentPage - 1) * $limit);
		$employee = Employee::find()
			->select('employee.*,c.companyName,co.countryName,co.flag,t.titleName,c.city,b.branchName,
			condition.employeeConditionName,s.statusName,na.nationalityName,d.departmentName,d.departmentId,te.teamId,te.teamName,c.picture as cPicture')
			->JOIN("LEFT JOIN", "company c", "c.companyId=employee.companyId")
			->JOIN("LEFT JOIN", "title t", "t.titleId=employee.titleId")
			->JOIN("LEFT JOIN", "branch b", "b.branchId=employee.branchId")
			->JOIN("LEFT JOIN", "department d", "d.departmentId=employee.departmentId")
			->JOIN("LEFT JOIN", "team te", "te.teamId=employee.teamId")
			->JOIN("LEFT JOIN", "country co", "co.countryId=c.countryId")
			->JOIN("LEFT JOIN", "nationality na", "na.numCode=employee.nationalityId")
			->JOIN("LEFT JOIN", "status s", "s.statusId=employee.status")
			->JOIN("LEFT JOIN", "employee_condition condition", "condition.employeeConditionId=employee.employeeConditionId")
			->where([
				"employee.status" => [1, 2, 3, 4, 5, 6, 7]
			])
			->andFilterWhere([
				"employee.companyId" => $companyId,
			])
			->orderBy('employee.employeeFirstname ASC')
			->asArray()
			->offset($startAt)
			->limit($limit)
			->all();
		$data = [];
		if (isset($employee) && count($employee) > 0) {
			foreach ($employee as $em):
				$isNew = 0;
				$isNew = ModelMaster::isOverthanMonth($em["joinDate"], 1);
				$data[$em["employeeId"]] = [
					"employeeName" => $em["employeeFirstname"] . ' ' . $em["employeeSurename"],
					"picture" => Employee::employeeImage($em["employeeId"]),
					"titleName" =>  $em["titleName"],
					"departmentName" =>  $em["departmentName"],
					"departmentId" =>  $em["departmentId"],
					"teamId" => $em["teamId"],
					"teamName" => $em["teamName"],
					"status" => $em["statusName"] == null ? 'not set' : $em["statusName"],
					"isNew" => $isNew,
					"email" => $em["companyEmail"],
					"employeeNumber" => $em["employeeNumber"],
					"telephoneNumber" => $em["telephoneNumber"],
					"joinDate" => ModelMaster::dateFullFormat($em["joinDate"]),
					"companyName" => $em["companyName"],
					"companyPicture" => Company::companyPicture($em["cPicture"]),
					"city" => $em["city"],
					"countryName" => $em["countryName"],
					"branchName" => $em["branchName"]
				];
			endforeach;
		}
		//throw new Exception(print_r($data, true));
		return json_encode($data);
	}
	public function actionEmployeeFilter($companyId, $branchId, $departmentId, $teamId, $status)
	{
		$employee = Employee::find()
			->select('employee.*,c.companyName,co.countryName,co.flag,t.titleName,c.city,b.branchName,
			condition.employeeConditionName,s.statusName,na.nationalityName,d.departmentName,d.departmentId,te.teamId,te.teamName,c.picture as cPicture')
			->JOIN("LEFT JOIN", "company c", "c.companyId=employee.companyId")
			->JOIN("LEFT JOIN", "title t", "t.titleId=employee.titleId")
			->JOIN("LEFT JOIN", "branch b", "b.branchId=employee.branchId")
			->JOIN("LEFT JOIN", "department d", "d.departmentId=employee.departmentId")
			->JOIN("LEFT JOIN", "team te", "te.teamId=employee.teamId")
			->JOIN("LEFT JOIN", "country co", "co.countryId=c.countryId")
			->JOIN("LEFT JOIN", "nationality na", "na.numCode=employee.nationalityId")
			->JOIN("LEFT JOIN", "status s", "s.statusId=employee.status")
			->JOIN("LEFT JOIN", "employee_condition condition", "condition.employeeConditionId=employee.employeeConditionId")
			->where(["employee.status" => [1, 2, 3, 4, 5, 6, 7]])
			->andFilterWhere([
				"employee.companyId" => $companyId,
				"employee.branchId" => $branchId,
				"employee.departmentId" => $departmentId,
				"employee.teamId" => $teamId,
				"employee.status" => $status,
			])
			->orderBy('employee.employeeFirstname ASC')
			->asArray()
			->limit(15)
			->all();
		$data = [];
		if (isset($employee) && count($employee) > 0) {
			foreach ($employee as $em):
				$isNew = 0;
				$isNew = ModelMaster::isOverthanMonth($em["joinDate"], 1);
				$data[$em["employeeId"]] = [
					"employeeName" => $em["employeeFirstname"] . ' ' . $em["employeeSurename"],
					"picture" => Employee::employeeImage($em["employeeId"]),
					"titleName" =>  $em["titleName"],
					"departmentName" =>  $em["departmentName"],
					"departmentId" =>  $em["departmentId"],
					"teamId" => $em["teamId"],
					"teamName" => $em["teamName"],
					"status" => $em["statusName"] == null ? 'not set' : $em["statusName"],
					"isNew" => $isNew,
					"email" => $em["companyEmail"],
					"employeeNumber" => $em["employeeNumber"],
					"telephoneNumber" => $em["telephoneNumber"],
					"joinDate" => ModelMaster::dateFullFormat($em["joinDate"]),
					"companyName" => $em["companyName"],
					"companyPicture" => Company::companyPicture($em["cPicture"]),
					"city" => $em["city"],
					"countryName" => $em["countryName"],
					"branchName" => $em["branchName"]

				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionEmployeeDepartmentTitleByDepartment($departmentId)
	{
		$department = Department::find()
			->select('departmentId,departmentName')
			->where(["departmentId" => $departmentId])
			->asArray()
			->one();
		$data = [];
		if (isset($department) && !empty($department) > 0) {
			$titles = Title::find()
				->where(["departmentId" => $department["departmentId"]])
				->asArray()
				->orderBy('layerId')
				->all();
			if (isset($titles) && count($titles) > 0) {
				foreach ($titles as $title) :
					$employees = Employee::find()
						->select('employeeFirstname,employeeSurename,employeeId,picture')
						->where(["titleId" => $title["titleId"], "status" => 1])
						->asArray()
						->orderBy('employeeFirstname')
						->all();
					if (isset($employees) && count($employees) > 0) {
						foreach ($employees as $em) :
							$data[$title["titleId"]][$em["employeeId"]] = [
								"firstName" => $em["employeeFirstname"],
								"sureName" => $em["employeeSurename"],
								"picture" => $em["picture"],
								"setSalary" => EmployeeSalary::isSetSalary($em["employeeId"])
							];
						endforeach;
					}
				endforeach;
			}
		}
		return json_encode($data);
	}
	public function actionEmployeeTitleByBranch($branchId, $pimWeightId)
	{
		$employees = Employee::find()
			->select('employee.employeeFirstname,employee.employeeSurename,employee.employeeId,employee.picture,t.titleName,t.layerId')
			->JOIN("LEFT JOIN", "department d", "d.departmentId=employee.departmentId")
			->JOIN("LEFT JOIN", "title t", "t.titleId=employee.titleId")
			->where(["employee.branchId" => $branchId, "employee.status" => 1])
			->asArray()
			->orderBy('t.layerId,employee.employeeFirstname')
			->all();
		$data = [];
		if (isset($employees) && count($employees) > 0) {
			foreach ($employees as $em) :
				$data[$em["titleName"]][$em["employeeId"]] = [
					"firstName" => $em["employeeFirstname"],
					"sureName" => $em["employeeSurename"],
					"picture" => $em["picture"],
					"isInPim" => PimWeight::hasEmployee($em["employeeId"], $pimWeightId)
				];
			endforeach;
		}
		return json_encode($data);
	}
	public function actionAllEmployee()
	{
		$employees = Employee::find()
			->select('employee.employeeFirstname,employee.employeeSurename,employee.employeeId,employee.picture,t.titleName,t.layerId,d.departmentName')
			->JOIN("LEFT JOIN", "department d", "d.departmentId=employee.departmentId")
			->JOIN("LEFT JOIN", "title t", "t.titleId=employee.titleId")
			->where(["d.status" => 1, "employee.status" => 1, 't.layerId' => [1], "t.status" => 1])
			->asArray()
			->orderBy('d.departmentId,t.layerId,employee.employeeFirstname')
			->all();
		$data = [];
		if (isset($employees) && count($employees) > 0) {
			foreach ($employees as $em) :
				$data[$em["departmentName"]][$em["employeeId"]] = [
					"firstName" => $em["employeeFirstname"],
					"sureName" => $em["employeeSurename"],
					"picture" => $em["picture"],
					//"isInPim" => PimWeight::hasEmployee($em["employeeId"], $pimWeightId)
				];
			endforeach;
		}
		return json_encode($data);
	}

	public function actionEmployeeUpdate($id)
	{

		$employee = Employee::find()
			->select([
				'employee.employeeId AS id',
				'employee.employeeConditionId',
				'employee.status',
				'employee.employeeNumber AS employeeId',
				'employee.defaultLanguage',
				'employee.salutation',
				'employee.gender',
				'employee.employeeFirstname',
				'employee.employeeSurename',
				'employee.nationalityId',
				'employee.telephoneNumber',
				'employee.emergencyTel',
				'employee.address1',
				'employee.email',
				'employee.maritalStatus',
				'employee.birthDate',
				'employee.companyId',
				'employee.branchId',
				'employee.departmentId',
				'employee.teamId',
				'employee.companyEmail',
				'employee.hireDate AS hiringDate',
				'employee.probationStatus AS overrideProbationEmployee',
				'employee.probationStart AS fromDate',
				'employee.probationEnd AS toDate',
				'employee.titleId',
				'employee.remark',
				'employee.skills',
				'employee.contact AS linkedin',
				'employee.resume',
				'employee.employeeAgreement AS agreement',
				'employee.picture AS image'
			])
			->from('employee')
			->where(['employee.employeeId' => $id])
			->asArray()
			->one();

		// $employee = Employee::find()
		// 	->select('employee.*,c.companyName,co.countryName,co.flag,t.titleName,b.branchName,
		// 	condition.employeeConditionName,s.statusName,na.nationalityName,c.city,t.shortTag')
		// 	->JOIN("LEFT JOIN", "company c", "c.companyId=employee.companyId")
		// 	->JOIN("LEFT JOIN", "branch b", "b.branchId=employee.branchId")
		// 	->JOIN("LEFT JOIN", "title t", "t.titleId=employee.titleId")
		// 	->JOIN("LEFT JOIN", "country co", "co.countryId=c.countryId")
		// 	->JOIN("LEFT JOIN", "nationality na", "na.numCode=employee.nationalityId")
		// 	//->JOIN("LEFT JOIN", "employee_status es", "es.employeeId=employee.employeeId")
		// 	->JOIN("LEFT JOIN", "status s", "s.statusId=employee.status")
		// 	->JOIN("LEFT JOIN", "employee_condition condition", "condition.employeeConditionId=employee.employeeConditionId")
		// 	->where(["employee.employeeId" => $id])
		// 	->asArray()
		// 	->one();

		return json_encode($employee);
	}

	public function actionUserEmployee($id)
	{
		$users = User::find()
			->select([
				'userId',
				'employeeId',
				'username AS mailId',
				'password_hash AS password'
			])
			->where(['employeeId' => $id])
			->asArray() // สำคัญ! เพื่อให้ผลลัพธ์เป็น array สำหรับ json_encode
			->one(); // หรือ ->one(); ถ้ามีแค่ 1 user ต่อ 1 employee

		return json_encode($users); // ← ตรงนี้ต้องเป็น $users ไม่ใช่ $id
	}


	public function actionUserRole($id)
	{
		$userRole = UserRole::find()
			->select(['userRoleId', 'roleid', 'userId AS role'])
			->where(['userId' => $id])
			->asArray()
			->one();

		return json_encode($userRole);
	}


	public function actionUserAccess($id)
	{
		$userAccess = UserAccess::find()
			->select(['acessId', 'moduleId', 'userId'])
			->where(['userId' => $id])
			->asArray()
			->all();

		return json_encode($userAccess);
	}

	public function actionUserCertificate($id)
	{
		$certificates = Certificate::find()
			->select([
				'cerId',
				'cerName',
				'userId',
				'issuing',
				'fromCerDate',
				'toCerDate',
				'credential',
				'noExpiry',
				'certificate',
				'cerImage'
			])
			->where(['userId' => $id])
			->asArray()
			->all();

		return json_encode($certificates);
	}

	public function actionCertificateDetail($id)
	{
		$Certificate = Certificate::find()
			->where(['cerId' => $id])
			->asArray()
			->one();

		return json_encode($Certificate);
	}

	public function actionUserLanguage($id)
	{
		$Languages = UserLanguage::find()
			->alias('u') // alias สำหรับ user_language
			->select([
				'u.userLanguageId',
				'u.userId',
				'u.languageId',
				'u.lavel',
				'l.name',
				'l.countryId',
				'c.flag'
			])
			->leftJoin('language l', 'l.languageId = u.languageId') // JOIN กับ default_language ก่อน
			->leftJoin('country c', 'c.countryId = l.countryId') // แล้วค่อย JOIN กับ country
			->where(['u.userId' => $id])
			->asArray()
			->all();

		return json_encode($Languages);
	}


	public function actionDefaultLanguage()
	{
		$language = DefaultLanguage::find()
			->alias('d') // ตั้ง alias ให้ DefaultLanguage
			->select(['d.languageId', 'd.language', 'd.languageName', 'd.countryId', 'c.flag'])
			->leftJoin('country c', 'c.countryId = d.countryId') // ✅ ใช้ alias 'c'
			->where(['d.status' => 1])
			->asArray()
			->all();


		return json_encode($language);
	}

	public function actionMainLanguage()
	{
		$language = Language::find()
			->alias('l')  // ตั้ง alias สำหรับ language
			->select(['l.LanguageId', 'l.name', 'l.symbol', 'l.countryId', 'c.flag'])
			->leftJoin('country c', 'c.countryId = l.countryId')
			->where(['l.status' => 1])
			->asArray()
			->all();
		// ส่ง response แบบ JSON ของ Yii
		return json_encode($language);
	}



	public function actionModuleRole()
	{
		$module = Module::find()
			->where(["status" => 1])
			->asArray()
			->all();
		return json_encode($module);
	}
}
