<?php

namespace frontend\modules\setting\controllers;

use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
use frontend\models\hrvc\Branch;
use frontend\models\hrvc\Company;
use frontend\models\hrvc\Country;
use frontend\models\hrvc\Department;
use frontend\models\hrvc\Employee;
use frontend\models\hrvc\EmployeeCondition;
use frontend\models\hrvc\EmployeeStatus;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\Status;
use frontend\models\hrvc\Team;
use frontend\models\hrvc\Title;
use frontend\models\hrvc\User;
use frontend\models\hrvc\UserRole;
use Yii;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\UploadedFile;

/**
 * Default controller for the `setting` module
 */
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
class EmployeeController extends Controller
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
    public function actionIndex($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $companyId = $param["companyId"];
        if ($companyId == '') {
            $companyId = null;
        }
        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/employee/all-employee-detail?companyId=' . $companyId);
        $employees = curl_exec($api);
        $employees = json_decode($employees, true);
        curl_close($api);
        return $this->render('index', [
            "employees" => $employees
        ]);
    }
    public function actionCreate()
    {
        $group = Group::find()->select('groupId')->where(["status" => 1])->asArray()->one();
        if (!isset($group) || empty($group)) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
        }
        $groupId = $group["groupId"];
        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/country/active-country');
        $countries = curl_exec($api);
        $countries = json_decode($countries, true);
        //throw new Exception(print_r($countries, true));
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
        $companies = curl_exec($api);
        $companies = json_decode($companies, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/title/title-list');
        $titles = curl_exec($api);
        $titles = json_decode($titles, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/status/active-status');
        $status = curl_exec($api);
        $status = json_decode($status, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/employee-condition/active-condition');
        $conditions = curl_exec($api);
        $conditions = json_decode($conditions, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/role/active-role');
        $roles = curl_exec($api);
        $roles = json_decode($roles, true);
        curl_close($api);

        return $this->render('create', [
            "countries" => $countries,
            "companies" => $companies,
            "titles" => $titles,
            "status" => $status,
            "conditions" => $conditions,
            "roles" => $roles
        ]);
    }
    public function actionSaveCreateEmployee()
    {
        // throw new Exception(print_r(Yii::$app->request->post(), true));
        if (isset($_POST["firstName"]) && trim($_POST["firstName"] != '')) {
            $employee = new Employee();
            $employee->employeeFirstname = $_POST["firstName"];
            $employee->employeeSurename = $_POST["lastName"];
            $employee->employeeNumber = $_POST["employeeNumber"];
            $employee->joinDate = $_POST["joinDate"] . " 00:00:00";
            $employee->birthDate = $_POST["birthDate"];
            $employee->hireDate = $_POST["joinDate"];
            $employee->nationalityId = $_POST["nationality"];
            $employee->address1 = $_POST["address1"];
            $employee->address2 = $_POST["address2"];
            $employee->gender = $_POST["gender"];
            $employee->telephoneNumber = $_POST["telephoneNumber"];
            $employee->emergencyTel = $_POST["emergencyTel"];
            $employee->companyEmail = $_POST["companyEmail"];
            $employee->email = $_POST["personalEmail"];
            $employee->companyId = $_POST["company"];
            $employee->branchId = $_POST["branch"];
            $employee->departmentId = $_POST["department"];
            $employee->teamId = $_POST["team"];
            $employee->titleId = $_POST["title"];
            //$employee->workingTime = $_POST["workTime"];
            $employee->employeeConditionId = $_POST["condition"];
            $employee->spoken = $_POST["language"];
            $employee->socialLink = $_POST["socialLink"];
            $pictureProfile = UploadedFile::getInstanceByName("picture");
            if (isset($pictureProfile) && !empty($pictureProfile)) {
                $path = Path::getHost() . 'images/employee/profile/';
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $file = $pictureProfile->name;
                $filenameArray = explode('.', $file);
                $countArrayFile = count($filenameArray);
                $fileName = Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[$countArrayFile - 1];
                $pathSave = $path . $fileName;
                $pictureProfile->saveAs($pathSave);
                $employee->picture = 'images/employee/profile/' . $fileName;
            }
            $fileResume = UploadedFile::getInstanceByName("resume");
            if (isset($fileResume) && !empty($fileResume)) {
                $path = Path::getHost() . 'files/resume/';
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $file = $fileResume->name;
                $filenameArray = explode('.', $file);
                $countArrayFile = count($filenameArray);
                $fileName = Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[$countArrayFile - 1];
                $pathSave = $path . $fileName;
                $fileResume->saveAs($pathSave);
                $employee->resume = 'files/resume/' . $fileName;
            }
            $fileAgreement = UploadedFile::getInstanceByName("agreement");
            if (isset($fileAgreement) && !empty($fileAgreement)) {
                $path = Path::getHost() . 'files/agreement/';
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $file = $fileAgreement->name;
                $filenameArray = explode('.', $file);
                $countArrayFile = count($filenameArray);
                $fileName = Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[$countArrayFile - 1];
                $pathSave = $path . $fileName;
                $fileAgreement->saveAs($pathSave);
                $employee->employeeAgreement = 'files/agreement/' . $fileName;
            }
            $employee->remark = $_POST["remark"];
            $employee->status = 1;
            $employee->createDateTime = new Expression('NOW()');
            $employee->updateDateTime = new Expression('NOW()');
            if ($employee->save(false)) {
                $employeeId = Yii::$app->db->lastInsertID;
                $this->saveEmployeeStatus($employeeId, $_POST["status"]);
                $userId = $this->createUser($employeeId, $_POST["companyEmail"]);
                if (isset($_POST["role"]) && count($_POST["role"]) > 0) {
                    $this->saveRole($_POST["role"], $userId);
                }
                return $this->redirect(Yii::$app->homeUrl . 'setting/employee/employee-profile/' . ModelMaster::encodeParams(["employeeId" => $employeeId]));
            }
        }
    }
    public function actionEmployeeProfile($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $employeeId = $param["employeeId"];
        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/employee/employee-detail?id=' . $employeeId);
        $employee = curl_exec($api);
        $employee = json_decode($employee, true);
        curl_close($api);
        if ($employee["birthDate"] != '') {
            $year = date('Y');
            $birthDateArr = explode('-', $employee["birthDate"]);
            $birthYear = (int)$birthDateArr[0];
            $employee["age"] = (int)$year - (int)$birthYear;
        } else {
            $employee["age"] = '-';
        }
        $employee["branchName"] = Branch::branchName($employee['branchId']);
        $employee["departmentName"] =  Department::departmentName($employee['departmentId']);
        $employee["teamName"] =  Team::teamName($employee['teamId']);
        $employee["titleName"] = Title::titleName($employee['titleId']);
        $employee["conditionName"] = EmployeeCondition::conditionName($employee['employeeConditionId']);
        $employee["status"] = EmployeeStatus::employeeStatus($employee['employeeId']);
        // throw new Exception(print_r($employee, true));
        return $this->render('employee_profile', [
            "employee" => $employee
        ]);
    }
    public function saveEmployeeStatus($employeeId, $statusId)
    {
        $status = new EmployeeStatus();
        $status->employeeId = $employeeId;
        $status->statusId = $statusId;
        $status->status = 1;
        $status->createDateTime = new Expression('NOW()');
        $status->updateDateTime = new Expression('NOW()');
        $status->save(false);
    }
    public function saveRole($roles, $userId)
    {
        // throw new Exception(print_r($roles, true));
        UserRole::deleteAll(["userId" => $userId]);
        foreach ($roles as $role) :
            $userRole = new UserRole();
            $userRole->roleId = $role;
            $userRole->userId = $userId;
            $userRole->status = 1;
            $userRole->createDateTime = new Expression('NOW()');
            $userRole->updateDateTime = new Expression('NOW()');
            $userRole->save(false);

        endforeach;
    }
    public function createUser($employeeId, $userName)
    {
        $emailArr = explode('@', $userName);
        $email = $emailArr[0];
        $user = User::find()->where(["employeeId" => $employeeId])->one();
        if (!isset($user) || empty($user)) {
            $user = new User();
            $userId = null;
            $user->createDateTime = new Expression('NOW()');
        } else {
            $userId = $user->userId;
        }

        $user->userName = $userName;
        $user->password_hash = md5($email);
        $user->employeeId = $employeeId;
        $user->updateDateTime = new Expression('NOW()');
        if ($user->save(false)) {
            if ($userId == null) {
                $userId = Yii::$app->db->lastInsertID;
            }
        }
        return $userId;
    }
    public function actionUpdate($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $employeeId = $param["employeeId"];
        $group = Group::find()->select('groupId')->where(["status" => 1])->asArray()->one();
        if (!isset($group) || empty($group)) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
        }
        $groupId = $group["groupId"];
        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/country/active-country');
        $countries = curl_exec($api);
        $countries = json_decode($countries, true);
        //throw new Exception(print_r($countries, true));
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
        $companies = curl_exec($api);
        $companies = json_decode($companies, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/title/title-list');
        $titles = curl_exec($api);
        $titles = json_decode($titles, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/status/active-status');
        $status = curl_exec($api);
        $status = json_decode($status, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/employee-condition/active-condition');
        $conditions = curl_exec($api);
        $conditions = json_decode($conditions, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/role/active-role');
        $roles = curl_exec($api);
        $roles = json_decode($roles, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/employee/employee-detail?id=' . $employeeId);
        $employee = curl_exec($api);
        $employee = json_decode($employee, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/role/employee-role?id=' . $employeeId);
        $userRoles = curl_exec($api);
        $userRoles = json_decode($userRoles, true);

        curl_close($api);

        $oldData["company"] = [
            "id" => $employee['companyId'],
            "name" => Company::companyName($employee['companyId'])
        ];
        $oldData["nationality"] = [
            "id" => $employee['nationalityId'],
            "name" => Country::countryName($employee['nationalityId'])
        ];
        $oldData["branch"] = [
            "id" => $employee['branchId'],
            "name" => Branch::branchName($employee['branchId'])
        ];
        $oldData["department"] = [
            "id" => $employee['departmentId'],
            "name" => Department::departmentName($employee['departmentId'])
        ];
        $oldData["team"] = [
            "id" => $employee['teamId'],
            "name" => Team::teamName($employee['teamId'])
        ];
        $oldData["title"] = [
            "id" => $employee['titleId'],
            "name" => Title::titleName($employee['titleId'])
        ];
        $oldData["condition"] = [
            "id" => $employee['employeeConditionId'],
            "name" => EmployeeCondition::conditionName($employee['employeeConditionId'])
        ];
        $oldData["status"] = EmployeeStatus::employeeStatus($employee['employeeId']);
        // throw new Exception(print_r($userRoles, true));
        return $this->render('update', [
            "countries" => $countries,
            "companies" => $companies,
            "titles" => $titles,
            "status" => $status,
            "conditions" => $conditions,
            "roles" => $roles,
            "employee" => $employee,
            "oldData" => $oldData,
            "userRoles" => $userRoles

        ]);
    }
    public function actionSaveUpdateEmployee()
    {
        if (isset($_POST["firstName"]) && trim($_POST["firstName"] != '')) {
            //throw new exception(print_r(Yii::$app->request->post(), true));
            $employee = Employee::find()->where(["employeeId" => $_POST['eId']])->one();
            $oldPicture = $employee->picture;
            $oldResume = $employee->resume;
            $oldAgreement = $employee->employeeAgreement;
            $employee->employeeFirstname = $_POST["firstName"];
            $employee->employeeSurename = $_POST["lastName"];
            $employee->employeeNumber = $_POST["employeeNumber"];
            $employee->joinDate = $_POST["joinDate"];
            $employee->birthDate = $_POST["birthDate"];
            $employee->hireDate = $_POST["joinDate"];
            $employee->nationalityId = $_POST["nationality"];
            $employee->address1 = $_POST["address1"];
            $employee->address2 = $_POST["address2"];
            $employee->gender = $_POST["gender"];
            $employee->telephoneNumber = $_POST["telephoneNumber"];
            $employee->emergencyTel = $_POST["emergencyTel"];
            $employee->companyEmail = $_POST["companyEmail"];
            $employee->email = $_POST["personalEmail"];
            $employee->companyId = $_POST["company"];
            $employee->branchId = $_POST["branch"];
            $employee->departmentId = $_POST["department"];
            $employee->teamId = $_POST["team"];
            $employee->titleId = $_POST["title"];
            //$employee->workingTime = $_POST["workTime"];
            $employee->employeeConditionId = $_POST["condition"];
            $employee->spoken = $_POST["language"];
            $employee->socialLink = $_POST["socialLink"];
            $pictureProfile = UploadedFile::getInstanceByName("picture");
            if (isset($pictureProfile) && !empty($pictureProfile)) {

                $path = Path::getHost() . 'images/employee/profile/';
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $oldProfilePic = Path::getHost() . $oldPicture;
                if (file_exists($oldProfilePic) && $oldProfilePic != '') {
                    unlink($oldProfilePic);
                }
                $file = $pictureProfile->name;
                $filenameArray = explode('.', $file);
                $countArrayFile = count($filenameArray);
                $fileName = Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[$countArrayFile - 1];
                $pathSave = $path . $fileName;
                $pictureProfile->saveAs($pathSave);
                $employee->picture = 'images/employee/profile/' . $fileName;
            }
            $fileResume = UploadedFile::getInstanceByName("resume");
            if (isset($fileResume) && !empty($fileResume)) {
                $path = Path::getHost() . 'files/resume/';
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $oldResu = Path::getHost() . $oldResume;
                if (file_exists($oldResu) && $oldResume != '') {
                    unlink($oldResu);
                }
                $file = $fileResume->name;
                $filenameArray = explode('.', $file);
                $countArrayFile = count($filenameArray);
                $fileName = Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[$countArrayFile - 1];
                $pathSave = $path . $fileName;
                $fileResume->saveAs($pathSave);
                $employee->resume = 'files/resume/' . $fileName;
            }
            $fileAgreement = UploadedFile::getInstanceByName("agreement");
            if (isset($fileAgreement) && !empty($fileAgreement)) {
                //throw new exception("1111");
                $path = Path::getHost() . 'files/agreement/';
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $oldAgree = Path::getHost() . $oldAgreement;
                if (file_exists($oldAgree)) {
                    unlink($oldAgree);
                }
                $file = $fileAgreement->name;
                $filenameArray = explode('.', $file);
                $countArrayFile = count($filenameArray);
                $fileName = Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[$countArrayFile - 1];
                $pathSave = $path . $fileName;
                $fileAgreement->saveAs($pathSave);
                $employee->employeeAgreement = 'files/agreement/' . $fileName;
            }

            $employee->remark = $_POST["remark"];
            $employee->status = 1;
            $employee->updateDateTime = new Expression('NOW()');
            if ($employee->save(false)) {
                $employeeId = $_POST["eId"];
                $this->saveEmployeeStatus($employeeId, $_POST["status"]);
                $userId = $this->createUser($employeeId, $_POST["companyEmail"]);
                if (isset($_POST["role"]) && count($_POST["role"]) > 0) {
                    $this->saveRole($_POST["role"], $userId);
                }
                return $this->redirect(Yii::$app->homeUrl . 'setting/employee/employee-profile/' . ModelMaster::encodeParams(["employeeId" => $employeeId]));
            }
        }
    }
}
