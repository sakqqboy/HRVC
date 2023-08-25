<?php

namespace frontend\modules\setting\controllers;

use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
use frontend\models\hrvc\Employee;
use frontend\models\hrvc\EmployeeStatus;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\Status;
use frontend\models\hrvc\User;
use frontend\models\hrvc\UserRole;
use Yii;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\UploadedFile;

/**
 * Default controller for the `setting` module
 */
class EmployeeController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
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
            $employee->telephoneNumber = $_POST["gender"];
            $employee->emergencyTel = $_POST["gender"];
            $employee->companyEmail = $_POST["companyEmail"];
            $employee->email = $_POST["personalEmail"];
            $employee->companyId = $_POST["company"];
            $employee->branchId = $_POST["branch"];
            $employee->departmentId = $_POST["department"];
            $employee->teamId = $_POST["team"];
            $employee->titleId = $_POST["title"];
            $employee->workingTime = $_POST["workTime"];
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
                $employee->resume = 'file/resume/' . $fileName;
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
                $employee->employeeAgreement = 'file/resume/' . $fileName;
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
        return $this->render('employee_profile');
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
        $user = new User();
        $userId = null;
        $user->userName = $userName;
        $user->password_hash = md5($email);
        $user->employeeId = $employeeId;
        $user->createDateTime = new Expression('NOW()');
        $user->updateDateTime = new Expression('NOW()');
        if ($user->save(false)) {
            $userId = Yii::$app->db->lastInsertID;
        }
        return $userId;
    }
}
