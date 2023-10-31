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
use frontend\models\hrvc\Nationality;
use frontend\models\hrvc\Role;
use frontend\models\hrvc\Status;
use frontend\models\hrvc\Team;
use frontend\models\hrvc\TeamPosition;
use frontend\models\hrvc\Title;
use frontend\models\hrvc\User;
use frontend\models\hrvc\UserRole;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
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
        $groupId = Group::currentGroupId();
        if ($groupId == null) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
        }
        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/employee/all-employee-detail?companyId=' . $companyId);
        $employees = curl_exec($api);
        $employees = json_decode($employees, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
        $companies = curl_exec($api);
        $companies = json_decode($companies, true);
        curl_close($api);

        return $this->render('index', [
            "employees" => $employees,
            "companies" => $companies
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

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/team-position/index');
        $teamPosition = curl_exec($api);
        $teamPosition = json_decode($teamPosition, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/country/nationality');
        $nationalities = curl_exec($api);
        $nationalities = json_decode($nationalities, true);

        curl_close($api);

        return $this->render('create', [
            "countries" => $countries,
            "companies" => $companies,
            "titles" => $titles,
            "status" => $status,
            "conditions" => $conditions,
            "roles" => $roles,
            "teamPosition" => $teamPosition,
            "nationalities" => $nationalities
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
            $employee->countryId = $_POST["country"];
            $employee->gender = $_POST["gender"];
            $employee->telephoneNumber = $_POST["telephoneNumber"];
            $employee->emergencyTel = $_POST["emergencyTel"];
            $employee->companyEmail = $_POST["companyEmail"];
            $employee->email = $_POST["companyEmail"];
            $employee->companyId = $_POST["company"];
            $employee->branchId = $_POST["branch"];
            $employee->departmentId = $_POST["department"];
            $employee->teamId = $_POST["team"];
            $employee->teamPositionId = $_POST["teamPosition"];
            $employee->titleId = $_POST["title"];
            //$employee->workingTime = $_POST["workTime"];
            $employee->employeeConditionId = $_POST["condition"];
            $employee->spoken = $_POST["language"];
            //$employee->socialLink = $_POST["socialLink"];
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
            } else {
                $employee->picture = 'image/user.png';
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
        //throw new Exception(print_r($employee, true));
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

        $user->username = $userName;
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

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/title/title-department');
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

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/company-branch?id=' . $employee['companyId']);
        $branches = curl_exec($api);
        $branches = json_decode($branches, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/branch-department?id=' . $employee['branchId']);
        $departments = curl_exec($api);
        $departments = json_decode($departments, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/team/department-team?id=' . $employee['departmentId']);
        $teams = curl_exec($api);
        $teams = json_decode($teams, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/team-position/index');
        $teamPosition = curl_exec($api);
        $teamPosition = json_decode($teamPosition, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/country/nationality');
        $nationalities = curl_exec($api);
        $nationalities = json_decode($nationalities, true);

        curl_close($api);

        $oldData["company"] = [
            "id" => $employee['companyId'],
            "name" => Company::companyName($employee['companyId'])
        ];
        $oldData["nationality"] = [
            "id" => $employee['nationalityId'],
            "name" => Nationality::nationalityName($employee['nationalityId'])
        ];
        $oldData["country"] = [
            "id" => $employee['countryId'],
            "name" => Country::countryName($employee['countryId'])
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
        $oldData["teamPosition"] = [
            "id" => $employee['teamPositionId'],
            "name" => TeamPosition::teamPositionName($employee['teamPositionId'])
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
            "userRoles" => $userRoles,
            "branches" => $branches,
            "departments" => $departments,
            "teams" => $teams,
            "teamPosition" => $teamPosition,
            "nationalities" => $nationalities

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
            $employee->countryId = $_POST["country"];
            $employee->gender = $_POST["gender"];
            $employee->telephoneNumber = $_POST["telephoneNumber"];
            $employee->emergencyTel = $_POST["emergencyTel"];
            $employee->companyEmail = $_POST["companyEmail"];
            $employee->email = $_POST["companyEmail"];
            $employee->companyId = $_POST["company"];
            $employee->branchId = $_POST["branch"];
            $employee->departmentId = $_POST["department"];
            $employee->teamId = $_POST["team"];
            $employee->teamPositionId = $_POST["teamPosition"];
            $employee->titleId = $_POST["title"];
            //$employee->workingTime = $_POST["workTime"];
            $employee->employeeConditionId = $_POST["condition"];
            $employee->spoken = $_POST["language"];
            //$employee->socialLink = $_POST["socialLink"];
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
    public function actionFilterEmployee()
    {
        $companyId = $_POST["companyId"] != '' ? $_POST["companyId"] : null;
        $branchId = $_POST["branchId"] != '' ? $_POST["branchId"] : null;
        $departmentId = $_POST["departmentId"] != '' ? $_POST["departmentId"] : null;
        $teamId = $_POST["teamId"] != '' ? $_POST["teamId"] : null;
        $status = $_POST["status"];

        return $this->redirect(Yii::$app->homeUrl . 'setting/employee/employee-result/' . ModelMaster::encodeParams([
            "companyId" => $companyId,
            "branchId" => $branchId,
            "departmentId" => $departmentId,
            "teamId" => $teamId,
            "status" => $status
        ]));
    }
    public function actionEmployeeResult($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $companyId = $param["companyId"];
        $branchId = $param["branchId"];
        $departmentId = $param["departmentId"];
        $teamId = $param["teamId"];
        $status = $param["status"];
        if ($status == 0) {
            $status = null;
        }
        $branches = [];
        $departments = [];
        $teams = [];
        $groupId = Group::currentGroupId();
        $employees = Employee::find()->where(["status" => [1, 0, 2]])
            ->andFilterWhere([
                "companyId" => $companyId,
                "branchId" => $branchId,
                "departmentId" => $departmentId,
                "status" => $status,
                "teamId" => $teamId,
            ])
            ->asArray()
            ->orderBy("employeeFirstname")
            ->all();
        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);


        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
        $companies = curl_exec($api);
        $companies = json_decode($companies, true);

        if ($companyId != '') {
            curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/company-branch?id=' . $companyId);
            $branches = curl_exec($api);
            $branches = json_decode($branches, true);
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
        //throw new Exception(print_r($param, true));
        return $this->render('search_result', [
            "employees" => $employees,
            "companies" => $companies,
            "companyId" => $companyId,
            "branchId" => $branchId,
            "teamId" => $teamId,
            "departmentId" => $departmentId,
            "status" => $status == null ? 0 : $status,
            "branches" => $branches,
            "departments" => $departments,
            "teams" => $teams
        ]);
    }
    public function actionDeleteEmployee()
    {
        User::updateAll(["status" => 99], ["employeeId" => $_POST["employeeId"]]);
        Employee::updateAll(["status" => 99], ["employeeId" => $_POST["employeeId"]]);
        $res["status"] = true;
        return json_encode($res);
    }
    public function actionImport()
    {
        $error = [];
        $isError = 0;
        $success = 0;
        if (isset($_POST["employeeFile"])) {
            $imageObj = UploadedFile::getInstanceByName("employeeFile");
            if (isset($imageObj) && !empty($imageObj)) {
                $urlFolder = Path::getHost() . 'file/import/employee';
                if (!file_exists($urlFolder)) {
                    mkdir($urlFolder, 0777, true);
                }
                $file = $imageObj->name;
                $filenameArray = explode('.', $file);
                $countArrayFile = count($filenameArray);
                $fileType = $filenameArray[$countArrayFile - 1];
                if ($fileType == 'xlsx' || $fileType == 'xls') {
                    $fileName = Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[$countArrayFile - 1];
                    $pathSave = $urlFolder . $fileName;
                    if ($imageObj->saveAs($pathSave)) {
                        $reader = new Xlsx();
                        $spreadsheet = $reader->load($pathSave);
                        $sheetData = $spreadsheet->getActiveSheet()->toArray();
                        unset($sheetData[0]);
                        $i = 0;
                        $transaction = Yii::$app->db->beginTransaction();
                        foreach ($sheetData as $data) :
                            $line = $i;
                            $error[$i] = "";
                            $companyId = '';
                            $companyName = '';
                            $branchId = '';
                            $branchName = '';
                            $departmentId = '';
                            $departmentName = '';
                            $teamId = '';
                            $teamName = '';
                            $teamPositionId = '';
                            $teamPositionName = '';
                            if ($i >= 1) {
                                if (trim($data[0]) == "") {
                                    $isError = 1;
                                    $error[$i] .= '- firstname<br>';
                                }
                                if (trim($data[1]) == "") {
                                    $isError = 1;
                                    $error[$i] .= '- Surename<br>';
                                }
                                if (trim($data[3]) == "") {
                                    $isError = 1;
                                    $error[$i] .= '- Email<br>';
                                }
                                if (trim($data[7]) == "") {
                                    $isError = 1;
                                    $error[$i] .= '- Telephone<br>';
                                }
                                if (trim($data[9]) == "") {
                                    $isError = 1;
                                    $error[$i] .= '- Company<br>';
                                } else {
                                    $companyId = Company::companyId($data[9]);
                                    if ($companyId == '') {
                                        $isError = 1;
                                        $error[$i] .= '- Company name "' . $data[9] . '" not found in database<br>';
                                    }
                                }
                                if (trim($data[10]) == "") {
                                    $isError = 1;
                                    $error[$i] .= '- Branch<br>';
                                } else {
                                    if ($companyId != '') {
                                        $branchId = Branch::companyBranch($companyId, $data[10]);
                                        if ($branchId == '') {
                                            $isError = 1;
                                            $error[$i] .= '- branch name "' . $data[10] . '" not found in company "' . $data[9] . '"<br>';
                                        }
                                    }
                                }

                                if (trim($data[11]) == "") {
                                    $isError = 1;
                                    $error[$i] .= '- Department, ';
                                } else {
                                    if ($branchId != '') {
                                        $departmentId = Department::branchDepartment($branchId, $data[11]);
                                        if ($departmentId == '') {
                                            $isError = 1;
                                            $error[$i] .= '- Department name "' . $data[11] . '" not found in branch "' . $data[10] . '"<br>';
                                        }
                                    }
                                }
                                if (trim($data[12]) == "") {
                                    $isError = 1;
                                    $error[$i] .= '- Team, ';
                                } else {
                                    if ($departmentId != '') {
                                        $teamId = Team::departmentTeam($departmentId, $data[12]);
                                        if ($teamId == '') {
                                            $isError = 1;
                                            $error[$i] .= '- Team name "' . $data[12] . '" not found in department "' . $data[11] . '"<br>';
                                        }
                                    }
                                }
                                if (trim($data[13]) == "") {
                                    $isError = 1;
                                    $error[$i] .= '- Team Position';
                                } else {
                                    $teamPositionId = TeamPosition::teamPositionId($data[13]);
                                    if ($teamPositionId == '') {
                                        $isError = 1;
                                        $error[$i] .= '- Team Position name "' . $data[13] . '" not found in database <br>';
                                    }
                                }
                                if (trim($data[17]) == "") {
                                    $isError = 1;
                                    $error[$i] .= '- Right';
                                } else {
                                    $right = Role::roleId($data[17]);
                                    if ($right == '') {
                                        $isError = 1;
                                        $error[$i] .= '- Right name "' . $data[17] . '" not found in database <br>';
                                    }
                                }
                                if ($error == 0) {
                                    $employee = new Employee();
                                    $employee->employeeFirstname = $data[0];
                                    $employee->employeeSurename = $data[1];
                                    $employee->employeeNumber =  $data[2];
                                    $employee->joinDate = $_POST["joinDate"] . " 00:00:00";
                                    $employee->birthDate = $_POST["birthDate"];
                                    $employee->hireDate = $_POST["joinDate"];
                                    $employee->nationalityId = $_POST["nationality"];
                                    $employee->address1 = $_POST["address1"];
                                    $employee->countryId = $_POST["country"];
                                    $employee->gender = $_POST["gender"];
                                    $employee->telephoneNumber = $_POST["telephoneNumber"];
                                    $employee->emergencyTel = $_POST["emergencyTel"];
                                    $employee->companyEmail = $_POST["companyEmail"];
                                    $employee->email = $_POST["companyEmail"];
                                    $employee->companyId = $_POST["company"];
                                    $employee->branchId = $_POST["branch"];
                                    $employee->departmentId = $_POST["department"];
                                    $employee->teamId = $_POST["team"];
                                    $employee->teamPositionId = $_POST["teamPosition"];
                                    $employee->titleId = $_POST["title"];
                                    //$employee->workingTime = $_POST["workTime"];
                                    $employee->employeeConditionId = $_POST["condition"];
                                    $employee->spoken = $_POST["language"];
                                    if ($employee->save(false)) {
                                        $success++;
                                    }
                                }
                            }
                            $i++;
                        endforeach;
                        if ($isError = 0) {
                            $transaction->commit();
                        } else {
                            $transaction->rollBack();
                        }
                    }
                } else {
                    $error[0] = "Please select .xlsx or .xls file";
                }

                unlink($pathSave);
            }
        }
        return $this->render('import', [
            "error" => $error,
            "success" => $success
        ]);
    }
}
