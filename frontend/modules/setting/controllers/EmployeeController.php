<?php

namespace frontend\modules\setting\controllers;

use common\helpers\Path;
use common\models\ModelMaster;
use DateTime;
use Dompdf\Dompdf;
use Dompdf\Options;
use Exception;
use frontend\models\hrvc\Branch;
use frontend\models\hrvc\Certificate;
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
use frontend\models\hrvc\UserAccess;
use frontend\models\hrvc\UserLanguage;
use frontend\models\hrvc\UserRole;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Html;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Yii;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\UploadedFile;

/**
 * Default controller for the `setting` module
 */
// header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
// header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
// header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
// header("Cache-Control: post-check=0, pre-check=0", false);
// header("Pragma: no-cache");
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

    public function actionNoEmployee($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $departmentId = $param["departmentId"] ?? 0;
        // throw new exception(print_r($branchId, true));

        $group = Group::find()->select('groupId')->where(["status" => 1])->asArray()->one();
        if (!isset($group) && !empty($group)) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group/');
        }

        $company = Company::find()->select('companyId')->where(["status" => 1])->asArray()->one();
        if (!isset($company) && !empty($company)) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/company/create-company/' . ModelMaster::encodeParams(["groupId" => $group["groupId"]]));
        }

        $branch = Branch::find()->select('branchId')->where(["status" => 1])->asArray()->one();
        if (!isset($branch) && !empty($branch)) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/branch/create-branch/' . ModelMaster::encodeParams(["companyId" => '']));
        }

        $department = Department::find()->select('departmentId')->where(["status" => 1])->asArray()->one();
        if (!isset($department) && !empty($department)) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/department/create-department/');
        }

        $team = Team::find()->select('teamId')->where(["status" => 1])->asArray()->one();
        if (!isset($team) && !empty($team)) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/department/create-team/');
        }

        $employee = Employee::find()->select('employeeId')->where(["status" => 0])->asArray()->one();
        if (isset($employee) && !empty($employee)) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/team/index-grid/');
        }

        return $this->render('no_employee', [
            "departmentId" => $departmentId,
            "group" =>  $group
        ]);
    }

    public function actionIndex($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $companyId = !empty($param["companyId"]) ? $param["companyId"] : null;

        $groupId = Group::currentGroupId();
        if ($groupId == null) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
        }
        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
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
    public function actionEmployeeList()
    {

        $groupId = Group::currentGroupId();
        if ($groupId == null) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
        }
        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/employee/all-employee-detail?companyId=');
        $employees = curl_exec($api);
        $employees = json_decode($employees, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
        $companies = curl_exec($api);
        $companies = json_decode($companies, true);
        curl_close($api);
        return $this->render('index_list', [
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
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/country/active-country');
        $countries = curl_exec($api);
        $countries = json_decode($countries, true);
        // throw new Exception(print_r($countries, true));

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
        $companies = curl_exec($api);
        $companies = json_decode($companies, true);
        // throw new Exception(print_r($companies, true));

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/title/title-list');
        $titles = curl_exec($api);
        $titles = json_decode($titles, true);
        // throw new Exception(print_r($titles, true));

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/status/active-status');
        $status = curl_exec($api);
        $status = json_decode($status, true);
        // throw new Exception(print_r($status, true));

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/employee-condition/active-condition');
        $conditions = curl_exec($api);
        $conditions = json_decode($conditions, true);
        // throw new Exception(print_r($conditions, true));

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/role/active-role');
        $roles = curl_exec($api);
        $roles = json_decode($roles, true);
        // throw new Exception(print_r($roles, true));

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/team-position/index');
        $teamPosition = curl_exec($api);
        $teamPosition = json_decode($teamPosition, true);
        // throw new Exception(print_r($teamPosition, true));

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/country/all-country');
        $nationalities = curl_exec($api);
        $nationalities = json_decode($nationalities, true);
        // throw new Exception(print_r($nationalities, true));

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/employee/default-language');
        $language = curl_exec($api);
        $language = json_decode($language, true);
        // curl_close($api);
        // throw new Exception(print_r($language, true));\

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/employee/main-language');
        $mainLanguage = curl_exec($api);
        $mainLanguage = json_decode($mainLanguage, true);
        // curl_close($api);
        // throw new Exception(print_r($mainLanguage, true));

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/employee/module-role');
        $module = curl_exec($api);
        $module = json_decode($module, true);
        curl_close($api);
        // throw new Exception(print_r($module, true));


        return $this->render('create', [
            "groupId" => $groupId,
            "countries" => $countries,
            "companies" => $companies,
            "titles" => $titles,
            "status" => $status,
            "conditions" => $conditions,
            "roles" => $roles,
            "teamPosition" => $teamPosition,
            "nationalities" => $nationalities,
            "languages" => $language,
            "mainLanguage" => $mainLanguage,
            "modules" => $module,
            "statusfrom" => 'Create'
        ]);
    }
    public function actionSaveCreateEmployee()
    {

        if (isset($_POST["employeeFirstname"]) && trim($_POST["employeeFirstname"]) !== '') {
            $employee = new Employee();
            $employee->employeeConditionId = $_POST["status"];
            $employee->employeeNumber = $_POST["employeeId"];
            $employee->defaultLanguage = $_POST["defaultLanguage"];
            $employee->salutation = $_POST["salutation"];
            $employee->gender = $_POST["gender"];
            $employee->employeeFirstname = $_POST["employeeFirstname"];
            $employee->employeeSurename = $_POST["employeeSurename"];
            $employee->nationalityId = $_POST["nationalityId"];
            $employee->telephoneNumber = $_POST["telephoneNumber"];
            $employee->emergencyTel = $_POST["emergencyTel"];
            $employee->address1 = $_POST["address1"];
            $employee->email = $_POST["email"];
            $employee->maritalStatus = $_POST["maritalStatus"];
            $employee->birthDate = date("Y-m-d", strtotime($_POST["birthDate"]));
            $employee->companyId = $_POST["companyId"];
            $employee->branchId = $_POST["branchId"];
            $employee->departmentId = $_POST["departmentId"];
            $employee->teamId = $_POST["teamId"];
            $employee->companyEmail = $_POST["companyEmail"];
            $employee->hireDate = date("Y-m-d", strtotime($_POST["hiringDate"]));
            $employee->probationStatus = $_POST["overrideProbationEmployee"];
            $employee->probationStart = date("Y-m-d", strtotime($_POST["fromDate"]));
            $employee->probationEnd = date("Y-m-d", strtotime($_POST["toDate"]));
            $employee->titleId = $_POST["titleId"];
            $employee->remark = $_POST["remark"];
            $employee->skills = $_POST["skills"];
            $employee->contact = $_POST["linkedin"];
            if ($_POST["darf"] == 1) {
                $employee->status = 2;
            } else {
                $employee->status = 100;
            }
            $employee->createDateTime = new Expression('NOW()');
            $employee->updateDateTime = new Expression('NOW()');

            // Upload Profile Image
            $pictureProfile = UploadedFile::getInstanceByName("image");
            if ($pictureProfile) {
                $path = Path::getHost() . 'images/employee/profile/';
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $fileName = Yii::$app->security->generateRandomString(10) . '.' . $pictureProfile->extension;
                $pathSave = $path . $fileName;
                $pictureProfile->saveAs($pathSave);
                $employee->picture = 'images/employee/profile/' . $fileName;
            } else {
                $employee->picture = 'image/user.png';
            }

            // Upload Resume
            $fileResume = UploadedFile::getInstanceByName("resume");
            if ($fileResume) {
                $path = Path::getHost() . 'files/resume/';
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $fileName = Yii::$app->security->generateRandomString(10) . '.' . $fileResume->extension;
                $pathSave = $path . $fileName;
                $fileResume->saveAs($pathSave);
                $employee->resume = 'files/resume/' . $fileName;
            }

            // Upload Agreement
            $fileAgreement = UploadedFile::getInstanceByName("agreement");
            if ($fileAgreement) {
                $path = Path::getHost() . 'files/agreement/';
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $fileName = Yii::$app->security->generateRandomString(10) . '.' . $fileAgreement->extension;
                $pathSave = $path . $fileName;
                $fileAgreement->saveAs($pathSave);
                $employee->employeeAgreement = 'files/agreement/' . $fileName;
            }

            if ($employee->save(false)) {

                $user = new User();
                $user->employeeId = $employee->employeeId;
                $user->username =  $_POST["mailId"];    // หรือใช้ companyEmail แทน
                $user->password_hash = Yii::$app->security->generatePasswordHash($_POST["password"]); // เข้ารหัสแบบ secure
                $user->createDateTime = new Expression('NOW()');
                $user->updateDateTime = new Expression('NOW()');
                if ($user->save(false)) {
                    // UserRole
                    $role = new UserRole();
                    $role->userId = $user->userId;
                    $role->roleId = $_POST["role"];
                    $role->status = 1;
                    $role->createDateTime = new Expression('NOW()');
                    $role->updateDateTime = new Expression('NOW()');
                    $role->save(false); // ✅ สำคัญ!

                    // UserAccess
                    if (!empty($_POST["moduleId"]) && is_array($_POST["moduleId"])) {
                        foreach ($_POST["moduleId"] as $moduleId) {
                            $access = new UserAccess();
                            $access->userId = $user->userId;
                            $access->moduleId = $moduleId;
                            $access->status = 1;
                            $access->createDateTime = new Expression('NOW()');
                            $access->updateDateTime = new Expression('NOW()');
                            $access->save(false); // ✅ สำคัญ!
                        }
                    }

                    // certificateData
                    $certificates = json_decode($_POST['certificateData'], true);
                    if ($certificates && is_array($certificates)) {
                        foreach ($certificates as $cert) {
                            $tmpId = $cert['id']; // เช่น 1749180178186
                            $cerName = $cert['cerName'] ?? null;
                            $issuing = $cert['issuingName'] ?? null;
                            $fromDate = ($cert['fromCerDate'] == 'No expiry date') ? null : date('Y-m-d', strtotime($cert['fromCerDate']));
                            $toDate = ($cert['toCerDate']) ? date('Y-m-d', strtotime($cert['toCerDate'])) : null;
                            $credential = $cert['credential'] ?? null;
                            $noExpiry = !empty($cert['noExpiry']) ? 1 : 0;

                            $certificatePath = null;
                            $cerImagePath = null;

                            // 📎 อัปโหลด certificate file
                            $fileKey = "certificateHidden_{$tmpId}_0";
                            if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] === 0) {
                                $file = $_FILES[$fileKey];
                                $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                                $fileName = Yii::$app->security->generateRandomString(12) . '.' . $ext;
                                $path = Path::getHost() . 'files/certificate/';
                                if (!file_exists($path)) {
                                    mkdir($path, 0777, true);
                                }
                                move_uploaded_file($file['tmp_name'], $path . $fileName);
                                $certificatePath = 'files/certificate/' . $fileName;
                            }

                            // 🖼️ อัปโหลด cerImage
                            $imageKey = "cerImageHidden_{$tmpId}";
                            if (isset($_FILES[$imageKey]) && $_FILES[$imageKey]['error'] === 0) {
                                $img = $_FILES[$imageKey];
                                $ext = pathinfo($img['name'], PATHINFO_EXTENSION);
                                $imgName = Yii::$app->security->generateRandomString(12) . '.' . $ext;
                                $path = Path::getHost() . 'images/certificate/';
                                if (!file_exists($path)) {
                                    mkdir($path, 0777, true);
                                }
                                move_uploaded_file($img['tmp_name'], $path . $imgName);
                                $cerImagePath = 'images/certificate/' . $imgName;
                            }

                            // 🔁 บันทึกข้อมูล (Insert ใหม่ หรือ Update ก็ได้)
                            $certificate = new Certificate();
                            $certificate->cerId = $tmpId;
                            $certificate->cerName = $cerName;
                            $certificate->issuing = $issuing;
                            $certificate->fromCerDate = $fromDate;
                            $certificate->toCerDate = $toDate;
                            $certificate->credential = $credential;
                            $certificate->noExpiry = $noExpiry;
                            $certificate->userId = $user->userId; // <-- ใส่ userId ให้ตรง
                            if ($certificatePath) {
                                $certificate->certificate = $certificatePath;
                            }
                            if ($cerImagePath) {
                                $certificate->cerImage = $cerImagePath;
                            }
                            $certificate->createDateTime = new \yii\db\Expression('NOW()');
                            $certificate->updateDateTime = new \yii\db\Expression('NOW()');
                            $certificate->save(false);
                        }
                    }

                    // UserLanguage
                    // 1. เตรียมภาษาและระดับที่จับคู่กัน
                    $languages = [
                        ['language' => $_POST['mainLanguage'], 'level' => $_POST['lavelLanguage']],
                    ];
                    // 2. เพิ่มข้อมูลภาษาและระดับอื่น ๆ ถ้ามี
                    for ($i = 1; $i <= 3; $i++) {
                        if (!empty($_POST["mainLanguage$i"]) && !empty($_POST["lavelLanguage$i"])) {
                            $languages[] = [
                                'language' => $_POST["mainLanguage$i"],
                                'level' => $_POST["lavelLanguage$i"]
                            ];
                        }
                    }
                    // 3. วนลูปบันทึก
                    foreach ($languages as $lang) {
                        $userLang = new UserLanguage();
                        $userLang->userId = $user->userId;
                        $userLang->languageId = $lang['language'];
                        $userLang->lavel = $lang['level'];
                        $userLang->createDateTime = new \yii\db\Expression('NOW()');
                        $userLang->updateDateTime = new \yii\db\Expression('NOW()');
                        $userLang->save(false);
                    }
                }
            }
            return $this->redirect(Yii::$app->homeUrl . 'setting/employee/index/' . ModelMaster::encodeParams(["companyId" => '']));
        }
    }

    public function actionEmployeeProfile($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $employeeId = $param["employeeId"];
        // throw new Exception(print_r($employeeId, true));
        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
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
        //$employee["status"] = EmployeeStatus::employeeStatus($employee['employeeId']);
        //    $status = $employee["status"];
        $employee["status"] = $employee['statusName'];
        //    $employee["statusId"] = $status;
        // throw new Exception(print_r($employee, true));
        return $this->render('employee_profile', [
            "employee" => $employee,
            "employeeId" => $employeeId
        ]);
    }

    public function saveEmployeeStatus($employeeId, $statusId)
    {
        $employeeStatus = EmployeeStatus::find()
            ->where(["employeeId" => $employeeId])->orderBy('createDateTime DESC')
            ->one();
        if (isset($employeeStatus) && !empty($employeeStatus)) {
            if ($employeeStatus["statusId"] != $statusId) {
                $status = new EmployeeStatus();
                $status->employeeId = $employeeId;
                $status->statusId = $statusId;
                $status->status = 1;
                $status->createDateTime = new Expression('NOW()');
                $status->updateDateTime = new Expression('NOW()');
                $status->save(false);
            }
        } else {
            $status = new EmployeeStatus();
            $status->employeeId = $employeeId;
            $status->statusId = $statusId;
            $status->status = 1;
            $status->createDateTime = new Expression('NOW()');
            $status->updateDateTime = new Expression('NOW()');
            $status->save(false);
        }
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
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

        // throw new Exception(print_r($employeeId, true));

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/employee/employee-update?id=' . $employeeId);
        $employee = curl_exec($api);
        $employee = json_decode($employee, true);
        // throw new Exception(print_r($employee, true));

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/employee/user-employee?id=' . $employeeId);
        $userEmployee = curl_exec($api);
        $userEmployee = json_decode($userEmployee, true);
        // throw new Exception(print_r($userEmployee, true));

        $userId = $userEmployee['userId'] ?? '';
        // throw new Exception(print_r($userId, true));

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/employee/user-role?id=' . $userId);
        $userRole = curl_exec($api);
        $userRole = json_decode($userRole, true);
        // throw new Exception(print_r($userRole, true));

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/employee/user-access?id=' . $userId);
        $userAccess = curl_exec($api);
        $userAccess = json_decode($userAccess, true);
        // throw new Exception(print_r($userAccess, true));

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/employee/user-certificate?id=' . $userId);
        $UserCertificate = curl_exec($api);
        $UserCertificate = json_decode($UserCertificate, true);
        // throw new Exception(print_r($UserCertificate, true));

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/employee/user-language?id=' . $userId);
        $UserLanguage = curl_exec($api);
        $UserLanguage = json_decode($UserLanguage, true);
        // throw new Exception(print_r($UserLanguage, true));

        // curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/country/active-country');
        $countries = curl_exec($api);
        $countries = json_decode($countries, true);
        // throw new Exception(print_r($countries, true));

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
        $companies = curl_exec($api);
        $companies = json_decode($companies, true);
        // throw new Exception(print_r($companies, true));

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/title/title-list');
        $titles = curl_exec($api);
        $titles = json_decode($titles, true);
        // throw new Exception(print_r($titles, true));

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/status/active-status');
        $status = curl_exec($api);
        $status = json_decode($status, true);
        // throw new Exception(print_r($status, true));

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/employee-condition/active-condition');
        $conditions = curl_exec($api);
        $conditions = json_decode($conditions, true);
        // throw new Exception(print_r($conditions, true));

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/role/active-role');
        $roles = curl_exec($api);
        $roles = json_decode($roles, true);
        // throw new Exception(print_r($roles, true));

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/team-position/index');
        $teamPosition = curl_exec($api);
        $teamPosition = json_decode($teamPosition, true);
        // throw new Exception(print_r($teamPosition, true));

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/country/all-country');
        $nationalities = curl_exec($api);
        $nationalities = json_decode($nationalities, true);
        // throw new Exception(print_r($nationalities, true));

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/employee/default-language');
        $language = curl_exec($api);
        $language = json_decode($language, true);
        // curl_close($api);
        // throw new Exception(print_r($language, true));\

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/employee/main-language');
        $mainLanguage = curl_exec($api);
        $mainLanguage = json_decode($mainLanguage, true);
        // curl_close($api);
        // throw new Exception(print_r($mainLanguage, true));

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/employee/module-role');
        $module = curl_exec($api);
        $module = json_decode($module, true);
        curl_close($api);
        // throw new Exception(print_r($module, true));


        return $this->render('create', [
            "groupId" => $groupId,
            "employeeId" => $employeeId,
            "countries" => $countries,
            "companies" => $companies,
            "titles" => $titles,
            "status" => $status,
            "conditions" => $conditions,
            "roles" => $roles,
            "teamPosition" => $teamPosition,
            "nationalities" => $nationalities,
            "languages" => $language,
            "mainLanguage" => $mainLanguage,
            "modules" => $module,
            "employee" => $employee,
            "userEmployee" => $userEmployee,
            "userId" => $userId,
            "userRole" => $userRole,
            "userAccess" => $userAccess,
            "userCertificate" => $UserCertificate,
            "userLanguage" => $UserLanguage,
            "statusfrom" => 'Update'
        ]);
    }
    public function actionSaveUpdateEmployee()
    {

        // throw new exception(print_r(Yii::$app->request->post(), true));

        if (isset($_POST["employeeFirstname"]) && trim($_POST["employeeSurename"] != '')) {
            $userId =  $_POST["userId"];
            $employee = Employee::find()->where(["employeeId" => $_POST["emId"]])->one();
            if ($employee) {
                $oldPicture = $employee->picture;
                $oldResume = $employee->resume;
                $oldAgreement = $employee->employeeAgreement;
                $employee->employeeConditionId = $_POST["status"];
                $employee->employeeNumber = $_POST["employeeId"];
                $employee->defaultLanguage = $_POST["defaultLanguage"];
                $employee->salutation = $_POST["salutation"];
                $employee->gender = $_POST["gender"];
                $employee->employeeFirstname = $_POST["employeeFirstname"];
                $employee->employeeSurename = $_POST["employeeSurename"];
                $employee->nationalityId = $_POST["nationalityId"];
                $employee->telephoneNumber = $_POST["telephoneNumber"];
                $employee->emergencyTel = $_POST["emergencyTel"];
                $employee->address1 = $_POST["address1"];
                $employee->email = $_POST["email"];
                $employee->maritalStatus = $_POST["maritalStatus"];
                $employee->birthDate = date("Y-m-d", strtotime($_POST["birthDate"]));
                $employee->companyId = $_POST["companyId"];
                $employee->branchId = $_POST["branchId"];
                $employee->departmentId = $_POST["departmentId"];
                $employee->teamId = $_POST["teamId"];
                $employee->companyEmail = $_POST["companyEmail"];
                $employee->hireDate = date("Y-m-d", strtotime($_POST["hiringDate"]));
                $employee->probationStatus = $_POST["overrideProbationEmployee"];
                $employee->probationStart = date("Y-m-d", strtotime($_POST["fromDate"]));
                $employee->probationEnd = date("Y-m-d", strtotime($_POST["toDate"]));
                $employee->titleId = $_POST["titleId"];
                $employee->remark = $_POST["remark"];
                $employee->skills = $_POST["skills"];
                $employee->contact = $_POST["linkedin"];
                $employee->status = ($_POST["darf"] == 1) ? 2 : 100;
                $employee->updateDateTime = new Expression('NOW()');

                $pictureProfile = UploadedFile::getInstanceByName("image");
                if (isset($pictureProfile) && !empty($pictureProfile)) {

                    $path = Path::getHost() . 'images/employee/profile/';
                    if (!file_exists($path)) {
                        mkdir($path, 0777, true);
                    }
                    $oldProfilePic = Path::getHost() . $oldPicture;
                    if (file_exists($oldProfilePic) && $oldProfilePic != '' && $oldPicture != '') {
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
                // throw new exception(print_r($file, true));

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
                    $employee->employeeAgreement = 'files/agreement/' . $file;
                    // throw new exception(print_r($employee->employeeAgreement, true));
                }

                if ($employee->save(false)) {
                    $user = User::find()->where(["employeeId" => $_POST["emId"]])->one();
                    if (!$user) {
                        $user = new User();
                        $user->employeeId = $employee->employeeId;
                        $user->createDateTime = new Expression('NOW()'); // แค่ตอนสร้างใหม่
                    }
                    $user->username = $_POST["mailId"];
                    if (!Yii::$app->security->validatePassword($_POST["password"], $user->password_hash)) {
                        if ($_POST["password"] != $user->password_hash) {
                            $user->password_hash = Yii::$app->security->generatePasswordHash($_POST["password"]);
                        }
                    }
                    $user->updateDateTime = new Expression('NOW()');
                    if ($user->save(false)) {
                        // UserRole
                        $role = UserRole::find()->where(['userId' => $_POST["userId"]])->one();
                        if (!$role) {
                            $role = new UserRole();
                            $role->userId = $user->userId;
                            $role->createDateTime = new Expression('NOW()'); // เฉพาะตอนสร้าง
                        }
                        // อัปเดตค่าที่จำเป็น
                        $role->roleId = $_POST["role"];
                        $role->updateDateTime = new Expression('NOW()');
                        $role->save(false); // ✅ บันทึกโดยไม่เช็ค validation

                        // ลบ access เดิมทั้งหมดของ user
                        UserAccess::deleteAll(['userId' => $user->userId]);
                        // UserAccess::updateAll(["status" => 99],["userId" => $userId]);
                        if (!empty($_POST["moduleId"]) && is_array($_POST["moduleId"])) {
                            foreach ($_POST["moduleId"] as $moduleId) {
                                $access = new UserAccess();
                                $access->userId = $user->userId;
                                $access->moduleId = $moduleId;
                                $access->status = 1;
                                $access->createDateTime = new Expression('NOW()');
                                $access->updateDateTime = new Expression('NOW()');
                                $access->save(false); // ✅
                            }
                        }

                        // certificateData
                        $certificates = json_decode($_POST['certificateData'], true);
                        if ($certificates && is_array($certificates)) {

                            foreach ($certificates as $cert) {
                                $tmpId = $cert['id']; // เช่น 1749180178186
                                $cerName = $cert['cerName'] ?? null;
                                $issuing = $cert['issuingName'] ?? null;
                                $fromDate = ($cert['fromCerDate'] == 'No expiry date') ? null : date('Y-m-d', strtotime($cert['fromCerDate']));
                                $toDate = ($cert['toCerDate']) ? date('Y-m-d', strtotime($cert['toCerDate'])) : null;
                                $credential = $cert['credential'] ?? null;
                                $noExpiry = !empty($cert['noExpiry']) ? 1 : 0;

                                $certificatePath = null;
                                $cerImagePath = null;

                                // 📎 อัปโหลด certificate file
                                $fileKey = "certificateHidden_{$tmpId}_0";
                                if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] === 0) {
                                    $file = $_FILES[$fileKey];
                                    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                                    $fileName = Yii::$app->security->generateRandomString(12) . '.' . $ext;
                                    $path = Path::getHost() . 'files/certificate/';
                                    if (!file_exists($path)) {
                                        mkdir($path, 0777, true);
                                    }
                                    move_uploaded_file($file['tmp_name'], $path . $fileName);
                                    $certificatePath = 'files/certificate/' . $fileName;
                                }

                                // 🖼️ อัปโหลด cerImage
                                $imageKey = "cerImageHidden_{$tmpId}";
                                if (isset($_FILES[$imageKey]) && $_FILES[$imageKey]['error'] === 0) {
                                    $img = $_FILES[$imageKey];
                                    $ext = pathinfo($img['name'], PATHINFO_EXTENSION);
                                    $imgName = Yii::$app->security->generateRandomString(12) . '.' . $ext;
                                    $path = Path::getHost() . 'images/certificate/';
                                    if (!file_exists($path)) {
                                        mkdir($path, 0777, true);
                                    }
                                    move_uploaded_file($img['tmp_name'], $path . $imgName);
                                    $cerImagePath = 'images/certificate/' . $imgName;
                                }
                                // 🔁 บันทึกข้อมูล (Insert ใหม่ หรือ Update ก็ได้)
                                $certificate = Certificate::findOne(['cerId' => $tmpId]);
                                if (!$certificate) {
                                    $certificate = new Certificate();
                                    $certificate->cerId = $tmpId; // กำหนดเฉพาะตอน insert ใหม่
                                    $certificate->createDateTime = new \yii\db\Expression('NOW()');
                                }

                                // กำหนดค่าทั่วไป
                                $certificate->cerName = $cerName;
                                $certificate->issuing = $issuing;
                                $certificate->fromCerDate = $fromDate;
                                $certificate->toCerDate = $toDate;
                                $certificate->credential = $credential;
                                $certificate->noExpiry = $noExpiry;
                                $certificate->userId = $userId;
                                if ($certificatePath) {
                                    $certificate->certificate = $certificatePath;
                                }
                                if ($cerImagePath) {
                                    $certificate->cerImage = $cerImagePath;
                                }
                                $certificate->updateDateTime = new \yii\db\Expression('NOW()');
                                // throw new exception(print_r( $certificate->cerName, true));

                                $certificate->save(false); // ✅ บันทึก

                            }
                        }

                        // UserLanguage
                        // 1. เตรียมภาษาและระดับที่จับคู่กัน
                        $languages = [
                            ['language' => $_POST['mainLanguage'], 'level' => $_POST['lavelLanguage']],
                        ];
                        // 2. เพิ่มข้อมูลภาษาและระดับอื่น ๆ ถ้ามี
                        for ($i = 1; $i <= 3; $i++) {
                            if (!empty($_POST["mainLanguage$i"]) && !empty($_POST["lavelLanguage$i"])) {
                                $languages[] = [
                                    'language' => $_POST["mainLanguage$i"],
                                    'level' => $_POST["lavelLanguage$i"]
                                ];
                            }
                        }
                        // 3. วนลูปบันทึก
                        UserLanguage::deleteAll(['userId' => $userId]);

                        foreach ($languages as $lang) {
                            $userLang = new UserLanguage();
                            $userLang->userId = $userId;
                            $userLang->languageId = $lang['language'];
                            $userLang->lavel = $lang['level'];
                            $userLang->createDateTime = new \yii\db\Expression('NOW()');
                            $userLang->updateDateTime = new \yii\db\Expression('NOW()');
                            $userLang->save(false);
                        }
                    }
                }
            }
        }
        return $this->redirect(Yii::$app->homeUrl . 'setting/employee/employee-profile/' . ModelMaster::encodeParams([
            "employeeId" => $_POST["emId"]
        ]));
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
        // $employees = Employee::find()->where(["status" => [1, 0]])
        //     ->andFilterWhere([
        //         "companyId" => $companyId,
        //         "branchId" => $branchId,
        //         "departmentId" => $departmentId,
        //         "status" => $status,
        //         "teamId" => $teamId,
        //     ])
        //     ->asArray()
        //     ->orderBy("employeeFirstname")
        //     ->all();
        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/employee/employee-filter?companyId=' . $companyId . '&&branchId=' . $branchId . '&&departmentId=' . $departmentId . '&&teamId=' . $teamId . '&&status=' . $status);
        $employees = curl_exec($api);
        $employees = json_decode($employees, true);

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
        return $this->render('index', [
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

    public function actionModalCertificate()
    {
        $mode = Yii::$app->request->post('mode'); // create หรือ edit
        $certData = Yii::$app->request->post('cert'); // JSON string ของ certificate
        $certificate = null;

        $cert = $certData ? json_decode($certData, true) : [];
        // throw new Exception(print_r($cert['id'], true));

        if (is_array($cert) && isset($cert['id']) && !empty($cert['id'])) {
            $api = curl_init();
            curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/employee/certificate-detail?id=' . $cert['id']);

            $certificate = curl_exec($api);
            $certificate = json_decode($certificate, true);
            curl_close($api);
        } else {
            // คุณอาจจะต้อง log หรือแจ้งว่าไม่มี cert['id']
            Yii::error('Invalid cert data: ' . print_r($cert, true));
        }

        return $this->renderPartial('modal_certificate', [
            'mode' => $mode,
            'cert' => $cert,
            'certificate' => $certificate
        ]);
    }

    public function actionDeleteCertificate()
    {
        $certId = $_POST['id'] ?? '';

        if (empty($certId)) {
            echo json_encode(['status' => 'error', 'message' => 'Missing certificate ID']);
            return;
        }

        // ตรวจสอบว่ามี Certificate นี้อยู่ก่อน
        $exists = Certificate::find()->where(['cerId' => $certId])->exists();

        if (!$exists) {
            echo json_encode(['status' => 'error', 'message' => 'Certificate not found']);
            return;
        }

        // ลบ certificate
        $deleted = Certificate::deleteAll(['cerId' => $certId]);

        if ($deleted > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Certificate deleted']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Delete failed']);
        }
    }


    public function actionDeleteEmployee($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $employeeId = $param["employeeId"];;
        $userId = $param["userId"];
        // throw new Exception(print_r($userId, true));

        Employee::updateAll(["status" => 99], ["employeeId" => $employeeId]);
        User::updateAll(["status" => 99], ["employeeId" => $employeeId]);
        UserRole::updateAll(["status" => 99], ["userId" => $userId]);
        UserAccess::updateAll(["status" => 99], ["userId" => $userId]);

        return $this->redirect(Yii::$app->homeUrl . 'setting/employee/index/' . ModelMaster::encodeParams(["companyId" => '']));

        // $res["status"] = true;
        // return json_encode($res);
    }
    public function actionMultiDeleteEmployee()
    {

        $employeeIds = $_POST["selectedEmployees"];
        Employee::updateAll(["status" => 99], ["in", "employeeId", $employeeIds]);
        $res["status"] = true;
        return json_encode($res);
    }

    public function actionImport()
    {
        $error = [];
        $isError = 0;
        $correct = [];
        $update = [];
        $success = 0;
        $countUpdate = 0;
        $totalError = 0;
        //throw new Exception(print_r(Yii::$app->request->post(), true));
        // if (isset($_POST["employeeFile"])) {

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
                $pathSave = $urlFolder . '/' . $fileName;
                if ($imageObj->saveAs($pathSave)) {

                    $reader = new Xlsx();
                    $spreadsheet = $reader->load($pathSave);
                    $sheetData = $spreadsheet->getActiveSheet()->toArray();
                    // unset($sheetData[0]);
                    $i = 0;
                    $transaction = Yii::$app->db->beginTransaction();
                    foreach ($sheetData as $data) :
                        $line = $i;

                        $companyId = '';
                        $branchId = '';
                        $departmentId = '';
                        $teamId = '';
                        $teamPositionId = '';
                        $isError = 0;
                        $error[$i] = "";
                        if ($i >= 1 && trim($data[0]) != "" && trim($data[1]) != "" && trim($data[2]) != "") {

                            // throw new exception('2222');
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
                                $error[$i] .= '- Department<br>';
                            } else {
                                if ($branchId != '') {
                                    $departmentId = Department::branchDepartment($branchId, $data[11]);
                                    if ($departmentId == '') {
                                        $isError = 1;
                                        $error[$i] .= '- Department name "' . $data[11] . '" not found in branch "' . $data[10] . '"<br>';
                                    }
                                }
                            }
                            if (trim($data[14]) != '') {
                                if ($departmentId != '') {
                                    $titleName = explode(':', $data[14]);
                                    $titleId = Title::titleId($departmentId, $titleName[0]);
                                } else {
                                    $isError = 1;
                                    $error[$i] .= "- Title and deparment did't match.<br>";
                                }
                            } else {
                                $titleId = null;
                            }

                            if (trim($data[12]) == "") {
                                $isError = 1;
                                $error[$i] .= '- Team<br>';
                            } else {
                                if ($departmentId != '') {
                                    $teamId = Team::departmentTeam($departmentId, $data[12]);
                                    if ($teamId == '') {
                                        $isError = 1;
                                        $error[$i] .= '- Team name "' . $data[12] . '" not found in department "' . $data[11] . '."<br>';
                                    }
                                }
                            }
                            if (trim($data[13]) == "") {
                                $isError = 1;
                                $error[$i] .= '- Team Position<br>';
                            } else {
                                $teamPositionId = TeamPosition::teamPositionId($data[13]);
                                if ($teamPositionId == '') {
                                    $isError = 1;
                                    $error[$i] .= '- Team Position name "' . $data[13] . '" not found in database. <br>';
                                }
                            }
                            if (trim($data[17]) == "") {
                                $isError = 1;
                                $error[$i] .= '- Right<br>';
                            } else {
                                $right = Role::roleId($data[17]);
                                if ($right == '') {
                                    $isError = 1;
                                    $error[$i] .= '- Right name "' . $data[17] . '" not found in database. <br>';
                                }
                            }
                            if (trim($data[6]) == '') {
                                $isError = 1;
                                $error[$i] .= '- Gender can not be null.<br>';
                            } else {
                                if ($data[6] == 'Male') {
                                    $gender = 1;
                                } else {
                                    $gender = 2;
                                }
                            }

                            if ($isError == 0) {
                                $isExisting = $this->checkDupplicate($data[0], $data[1], $data[2], $companyId);
                                if ($isExisting == 0) {
                                    $employee = new Employee();
                                    $employee->createDateTime = new Expression('NOW()');
                                } else {
                                    $employee = Employee::find()
                                        ->where([
                                            "employeeFirstname" => $data[0],
                                            "employeeSurename" => $data[1],
                                            "employeeNumber" =>  $data[2],
                                            "companyId" => $companyId,
                                        ])
                                        ->one();
                                }
                                $employee->employeeFirstname = $data[0];
                                $employee->employeeSurename = $data[1];
                                $employee->employeeNumber =  $data[2];
                                if (trim($data[4]) != '') {
                                    $joinDateArr = explode('/', $data[4]);
                                    //throw new exception(print_r($joinDateArr, true));
                                    if (count($joinDateArr) == 3) {
                                        $employee->joinDate = $joinDateArr[2] . '-' . $joinDateArr[1] . '-' . $joinDateArr[0];
                                    }
                                }
                                if (trim($data[5]) != '') {
                                    $birthDateArr = explode('/', $data[5]);
                                    if (count($birthDateArr) == 3) {
                                        $employee->birthDate = $birthDateArr[2] . '-' . $birthDateArr[1] . '-' . $birthDateArr[0];
                                    }
                                }
                                // $employee->joinDate = $data[4];
                                // $employee->birthDate = $data[5];
                                // $employee->nationalityId = $_POST["nationality"];
                                // $employee->address1 = $_POST["address1"];
                                // $employee->countryId = $_POST["country"];
                                $employee->gender = $gender;
                                $employee->telephoneNumber = $data[7];
                                $employee->emergencyTel = $data[8];
                                $employee->companyEmail = $data[3];
                                $employee->email = $data[3];
                                $employee->companyId = $companyId;
                                $employee->branchId = $branchId;
                                $employee->departmentId = $departmentId;
                                $employee->teamId = $teamId;
                                $employee->teamPositionId = $teamPositionId;
                                $employee->titleId = $titleId;

                                //$employee->workingTime = $_POST["workTime"];
                                $employee->employeeConditionId = EmployeeCondition::employeeConditionId($data[15]);
                                $employee->spoken = $data[16];
                                $employee->status = 1;

                                $employee->updateDateTime = new Expression('NOW()');
                                if ($employee->save(false)) {
                                    $success++;
                                    if ($isExisting == 0) {
                                        $employeeId = Yii::$app->db->lastInsertID;
                                    } else {
                                        $employeeId = $employee->employeeId;
                                    }
                                    $userId = $this->createUser($employeeId, $data[3]);
                                    $this->saveUserRole($userId, $data[17]);
                                    $titleName = explode(':', $data[14]);
                                    if ($isExisting == 0) {
                                        $correct[$i] = [
                                            "name" => $data[0] . ' ' . $data[1],
                                            "email" => $data[3],
                                            "company" => $data[9],
                                            "branch" => $data[10],
                                            "department" => $data[11],
                                            "title" => $titleName[0],
                                        ];
                                    }
                                    if ($isExisting == 1) {
                                        $countUpdate++;
                                        $update[$i] = [
                                            "name" => $data[0] . ' ' . $data[1],
                                            "email" => $data[3],
                                            "company" => $data[9],
                                            "branch" => $data[10],
                                            "department" => $data[11],
                                            "title" => $titleName[0],
                                        ];
                                    }
                                }
                            }
                        }
                        if ($isError == 0) {
                            $totalError++;
                            unset($error[$i]); // if there is no error delete this index
                        }
                        $i++;
                    endforeach;
                    if (count($error) == 0) {
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
        // }
        return $this->render('import', [
            "errors" => $error,
            "success" => $success,
            "countUpdate" => $countUpdate,
            "corrects" => $correct,
            "update" => $update
        ]);
    }
    public function checkDupplicate($firstName, $sureName, $code, $companyId)
    {
        $isExisting = 0;
        if ($code != "") {
            $employee = Employee::find()
                ->where([
                    "employeeFirstname" => $firstName,
                    "employeeSurename" => $sureName,
                    "employeeNumber" => $code,
                    "companyId" => $companyId,
                ])
                ->one();
            if (isset($employee) && !empty($employee)) {
                $isExisting = 1;
            }
        }
        return $isExisting;
    }
    // public function actionExport()
    // {
    //     $companies = Company::find()
    //         ->select('companyName')
    //         ->where(["status" => 1])
    //         ->asArray()
    //         ->groupBy('companyName')
    //         ->orderBy('companyName')
    //         ->all();
    //     $branches = Branch::find()
    //         ->select('branchName')
    //         ->where(["status" => 1])
    //         ->asArray()
    //         ->groupBy('branchName')
    //         ->orderBy('branchName')
    //         ->all();
    //     $departments = Department::find()
    //         ->select('departmentName')
    //         ->where(["status" => 1])
    //         ->asArray()
    //         ->groupBy('departmentName')
    //         ->orderBy('departmentName')
    //         ->all();
    //     $teams = Team::find()
    //         ->select('teamName')
    //         ->where(["status" => 1])
    //         ->asArray()
    //         ->groupBy('teamName')
    //         ->orderBy('teamName')
    //         ->all();
    //     $teamPositions = TeamPosition::find()
    //         ->select('teamPositionName')
    //         ->where(["status" => 1])
    //         ->asArray()
    //         ->groupBy('teamPositionName')
    //         ->orderBy('teamPositionName')
    //         ->all();
    //     $titles = Title::find()
    //         ->select('title.titleName,d.departmentName')
    //         ->JOIN("LEFT JOIN", "department d", "d.departmentId=title.departmentId")
    //         ->where(["d.status" => 1, "title.status" => 1])
    //         ->asArray()
    //         // ->groupBy('titleName')
    //         ->orderBy('title.titleName')
    //         ->all();
    //     $employeeCondition = EmployeeCondition::find()
    //         ->select('employeeConditionName')
    //         ->where(["status" => 1])
    //         ->asArray()
    //         ->orderBy('employeeConditionName')
    //         ->all();
    //     $rights = Role::find()
    //         ->select('roleName')
    //         ->where(["status" => 1])
    //         ->asArray()
    //         ->orderBy('roleName')
    //         ->all();
    //     $gender[0] = "Male";
    //     $gender[1] = "Female";
    //     //throw new exception(print_r($titles, true));
    //     $htmlExcel = $this->renderPartial('export', [
    //         "companies" => $companies,
    //         "branches" => $branches,
    //         "departments" => $departments,
    //         "teams" => $teams,
    //         "titles" => $titles,
    //         "employeeCondition" => $employeeCondition,
    //         "rights" => $rights,
    //         "teamPositions" => $teamPositions,
    //         "gender" => $gender
    //     ]);
    //     //throw new exception($htmlExcel);
    //     $urlFolder = Path::getHost() . 'file/import/employee/';
    //     $fileName = 'employee.xlsx';
    //     $filePath = $urlFolder . $fileName;
    //     $reader = new Xlsx();


    //     $spreadsheet = new Spreadsheet;
    //     $reader2 = new Html();

    //     $spreadsheet->createSheet();

    //     $reader2->setSheetIndex(1);
    //     $spreadsheet = $reader2->loadFromString($htmlExcel);
    //     $spreadsheet->getActiveSheet(1)->setTitle('data');

    //     $spreadsheet1 = $reader->load($filePath);
    //     $reader2->setSheetIndex(0);
    //     $clonedWorksheet = clone $spreadsheet1->getSheetByName('employee');
    //     $clonedWorksheet->setTitle('employee');
    //     $spreadsheet->addExternalSheet($clonedWorksheet);

    //     $fileName = 'Import Employee format' . date('Y-m-d');

    //     $spreadsheet->removeSheetByIndex(
    //         $spreadsheet->getIndex(
    //             $spreadsheet->getSheetByName('Worksheet')
    //         )
    //     );
    //     //  $spreadsheet->getActiveSheet()->setTitle('employee');

    //     $spreadsheet->setActiveSheetIndex(1);
    //     $folderName = "export";
    //     $urlFolder = Path::getHost() . 'file/' . $folderName . "/" . $fileName;
    //     $folder_path = Path::getHost() . 'file/' . $folderName;
    //     $files = glob($folder_path . '/*');
    //     foreach ($files as $file) {
    //         if (is_file($file)) {
    //             unlink($file);
    //         }
    //     }

    //     $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    //     $writer->save($urlFolder);
    //     return Yii::$app->response->sendFile($urlFolder, $fileName . '.xlsx');
    // }
    // public function actionExportEmployee($hash)
    // {
    //     $param = ModelMaster::decodeParams($hash);
    //     $employeeId = $param["employeeId"];
    //     $api = curl_init();
    //     curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
    //     curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/employee/employee-detail?id=' . $employeeId);
    //     $employee = curl_exec($api);
    //     $employee = json_decode($employee, true);
    //     curl_close($api);
    //     if ($employee["birthDate"] != '') {
    //         $year = date('Y');
    //         $birthDateArr = explode('-', $employee["birthDate"]);
    //         $birthYear = (int)$birthDateArr[0];
    //         $employee["age"] = (int)$year - (int)$birthYear;
    //     } else {
    //         $employee["age"] = '-';
    //     }
    //     $employee["branchName"] = Branch::branchName($employee['branchId']);
    //     $employee["departmentName"] =  Department::departmentName($employee['departmentId']);
    //     $employee["teamName"] =  Team::teamName($employee['teamId']);
    //     $employee["titleName"] = Title::titleName($employee['titleId']);
    //     $employee["conditionName"] = EmployeeCondition::conditionName($employee['employeeConditionId']);
    //     $employee["status"] = EmployeeStatus::employeeStatus($employee['employeeId']);
    //     //throw new exception(print_r($employee, true));
    //     $content = $this->renderPartial('export_employee', ["employee" => $employee]);
    //     $options = new Options();

    //     //$options->set('defaultFont', 'sans-serif');
    //     //$options->set('Sofia', 'sans-serif');
    //     $options->set('isRemoteEnabled', true);
    //     $dompdf = new Dompdf($options);
    //     $dompdf->loadHtml($content);
    //     $dompdf->setPaper('A4', 'vertical');
    //     $dompdf->render();
    //     $dompdf->stream("1234", array("Attachment" => false));
    //     exit(0);
    // }
    public function actionAddUser()
    {
        $employees = Employee::find()->select('employeeId,companyEmail')->where(["status" => 1])->asArray()->all();
        if (isset($employees) && count($employees) > 0) {
            foreach ($employees as $employee) :
                $user = User::find()->where(["employeeId" => $employee["employeeId"]])->one();
                if (!isset($user) || empty($user)) {
                    $emailArr = explode('@', $employee["companyEmail"]);
                    $email = $emailArr[0];
                    $newUser = new User();
                    $newUser->username = $employee["companyEmail"];
                    $newUser->password_hash = md5($email);
                    $newUser->employeeId = $employee["employeeId"];
                    $newUser->status = 1;
                    $newUser->createDateTime = new Expression('NOW()');
                    $newUser->updateDateTime = new Expression('NOW()');
                    $newUser->save(false);
                }
            endforeach;
        }
    }
    public function actionUpdateUserRole()
    {
        $users = User::find()->where(["status" => 1])->asArray()->all();
        if (isset($users) && count($users) > 0) {
            foreach ($users as $user) :
                $userRole = UserRole::find()->where(["userId" => $user["userId"]])->one();
                if (!isset($userRole) || empty($userRole)) {
                    $ur = new UserRole();
                    $ur->userId = $user["userId"];
                    $ur->roleId = 6;
                    $ur->status = 1;
                    $ur->createDateTime = new Expression('NOW()');
                    $ur->updateDateTime = new Expression('NOW()');
                    $ur->save(false);
                }
            endforeach;
        }
    }
    public function actionReviseEmployee()
    {
        $employee = Employee::find()->where("employeeId>=216")->all();
        if (isset($employee) && count($employee) > 0) {
            foreach ($employee as $em) :
                $firstname = $em->employeeSurename;
                $surename = $em->employeeNumber;
                $number = $em->employeeFirstname;
                $em->employeeFirstname = $firstname;
                $em->employeeSurename = $surename;
                $em->employeeNumber = $number;
                $em->save(false);
            endforeach;
        }
    }
    public function actionReviseEmployee2()
    {
        $employee = Employee::find()->where("status=1")->all();
        foreach ($employee as $em) :
            $user = User::find()->where(["employeeId" => $em->employeeId])->one();
            if (isset($user) && !empty($user)) {
                $userRole = UserRole::find()->where(["userId" => $user->userId])->one();
                if (!isset($userRole) || empty($userRole)) {
                    $user->delete();
                    $em->delete();
                }
            } else {
                $em->delete();
            }
        endforeach;
    }
    public function saveUserRole($userId, $roleName)
    {
        UserRole::deleteAll(["userId" => $userId]);
        $role = Role::find()->select('roleId')->where(["roleName" => $roleName])->asArray()->one();
        if (isset($role) && !empty($role)) {
            $userRole = new UserRole();
            $userRole->userId = $userId;
            $userRole->roleId = $role["roleId"];
            $userRole->status = 1;
            $userRole->createDateTime = new Expression('NOW()');
            $userRole->updateDateTime = new Expression('NOW()');
            $userRole->save(false);
        }
    }
    public function actionResetPassword()
    {
        $employee = Employee::find()->where(["status" => 1])->asArray()->all();
        if (isset($employee) && count($employee) > 0) {
            foreach ($employee as $em) :
                $user = User::find()->where(["status" => 1, "username" => $em["companyEmail"]])->one();
                if (isset($user) && !empty($user)) {
                    $passwordArr = explode('@', $user->username);
                    $user->password_hash = md5($passwordArr[0]);
                    $user->save(false);
                }
            endforeach;
        }
        User::deleteAll(["status" => 99]);
    }
    public function actionEmployeeTitleName()
    {
        $titleName = $_POST["titleName"];

        $titles = Title::find()
            ->select('titleId')
            ->where(["titleName" => $titleName, "status" => 1])
            ->asArray()
            ->all();
        //throw new Exception(print_r($titles, true));
        $titleIds = [];
        $res = [];
        $employeeId = [];
        if (isset($titles) && count($titles) > 0) {
            $i = 0;
            foreach ($titles as $title) :
                $titleIds[$i] = $title["titleId"];
                $i++;
            endforeach;
        }
        if (count($title) > 0) {
            $employee = Employee::find()->where(["titleId" => $titleIds])->asArray()->all();
            if (isset($employee) && count($employee) > 0) {
                $j = 0;
                foreach ($employee as $em) :
                    $employeeId[$j] = $em["employeeId"];
                    $j++;
                endforeach;
            }
        }
        if (count($employeeId) > 0) {
            $res["status"] = true;
            $res["employeeId"] = $employeeId;
            //throw new Exception(print_r($employeeId, true));
        } else {
            $res["status"] = false;
        }
        return json_encode($res);
    }
    public function actionEmployeeDepartmentName()
    {
        $departmentName = $_POST["departmentName"];

        $departments = Department::find()
            ->select('departmentId')
            ->where(["departmentName" => $departmentName, "status" => 1])
            ->asArray()
            ->all();
        //throw new Exception(print_r($titles, true));
        $departmentIds = [];
        $res = [];
        $employeeIds = [];
        if (isset($departments) && count($departments) > 0) {
            $i = 0;
            foreach ($departments as $department) :
                $departmentIds[$i] = $department["departmentId"];
                $i++;
            endforeach;
        }
        if (count($departments) > 0) {
            $employee = Employee::find()
                ->select('employee.employeeId,t.layerId')
                ->JOIN("LEFT JOIN", "title t", "t.titleId=employee.titleId")
                ->where([
                    "employee.departmentId" => $departmentIds,
                    "t.layerId" => 1,
                    "t.status" => 1,
                    "employee.status" => 1
                ])
                ->asArray()
                ->all();
            if (isset($employee) && count($employee) > 0) {
                $j = 0;
                foreach ($employee as $em) :
                    $employeeIds[$j] = $em["employeeId"];
                    $j++;
                endforeach;
            }
        }
        if (count($employeeIds) > 0) {
            $res["status"] = true;
            $res["employeeIds"] = $employeeIds;
            //throw new Exception(print_r($employeeId, true));
        } else {
            $res["status"] = false;
        }
        return json_encode($res);
    }
    public function actionEmployeeDetail2()
    {
        $employeeId = $_POST["employeeId"];
        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/employee/employee-detail?id=' . $employeeId);
        $employee = curl_exec($api);
        $employee = json_decode($employee, true);
        curl_close($api);
        return json_encode($employee);
    }
    public function actionUpdateEmployeeStatus()
    {
        $employee = Employee::find()->where(1)->all();
        if (isset($employee) && count($employee) > 0) {
            foreach ($employee as $em):
                $employeeStatus = EmployeeStatus::find()->where(["employeeId" => $em->employeeId])->orderBy("employeeStatusId DESC")->one();
                if (isset($employeeStatus) && !empty($employeeStatus)) {
                    $em->status = $employeeStatus->statusId;
                    $em->save(false);
                }
            endforeach;
        }
    }

    public function actionTest()
    {
        return $this->render('test', []);
    }

    public function actionContactDetail($hash)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_HTML;
        $param = ModelMaster::decodeParams($hash);
        $employeeId = $param["employeeId"];
        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/employee/employee-detail?id=' . $employeeId);
        $employee = curl_exec($api);
        $employee = json_decode($employee, true);
        curl_close($api);
        // throw new Exception(print_r($employee, true));

        return $this->renderPartial('contact_detail', [
            'employee' => $employee
        ]);
    }

    public function actionWorkDetail()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_HTML;
        return $this->renderPartial('work_detail');
    }

    public function actionAttachments()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_HTML;
        return $this->renderPartial('attachments');
    }

    public function actionCertificates()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_HTML;
        return $this->renderPartial('certificates');
    }

    public function actionPerformance()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_HTML;
        return $this->renderPartial('performance');
    }

    public function actionEvaluation()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_HTML;
        return $this->renderPartial('evaluation');
    }

    public function actionSalary()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_HTML;
        return $this->renderPartial('salary');
    }

    public function actionRole()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_HTML;
        return $this->renderPartial('role');
    }
}
