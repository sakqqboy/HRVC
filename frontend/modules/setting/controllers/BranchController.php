<?php

namespace frontend\modules\setting\controllers;

use common\helpers\Path;
use common\models\hrvc\Company;
use common\models\ModelMaster;
use Exception;
use frontend\components\Api;
use frontend\models\hrvc\Branch;
use frontend\models\hrvc\Department;
use frontend\models\hrvc\DepartmentTitle;
use frontend\models\hrvc\Employee;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\Team;
use frontend\models\hrvc\UserRole;
use Yii;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\UploadedFile;

use function PHPUnit\Framework\throwException;

/**
 * Default controller for the `setting` module
 */
// header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
// header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
// header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
// header("Cache-Control: post-check=0, pre-check=0", false);
// header("Pragma: no-cache");
class BranchController extends Controller
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
        $role = UserRole::userRight();
        if ($role <= 3) {
            return  $this->redirect(Yii::$app->request->referrer);
        }
        return true; //go to origin request
    }

    public function actionEncodeParamsCountry()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $countryId = Yii::$app->request->post('countryId');
        $companyId = Yii::$app->request->post('companyId');
        $page = Yii::$app->request->post('page');

        $url =  ModelMaster::encodeParams(['countryId' => $countryId, 'companyId' => $companyId, 'nextPage' => 1]);

        if ($page == 'grid') {
            return $this->redirect(Yii::$app->homeUrl . 'setting/branch/branch-grid-filter/' . $url);
        } else if ($page == 'list') {
            return $this->redirect(Yii::$app->homeUrl . 'setting/branch/index-filter/' . $url);
        } else {
            return "error";
        }
    }

    public function actionEncodeParamsPage()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $countryId = Yii::$app->request->post('countryId');
        $companyId = Yii::$app->request->post('companyId');
        $page = Yii::$app->request->post('page');
        $nextPage = Yii::$app->request->post('nextPage');

        // throw new exception(print_r($nextPage, true));

        $url =  ModelMaster::encodeParams(['countryId' => $countryId, 'nextPage' => $nextPage, 'companyId' => $companyId]);

        if ($page == 'grid') {
            return $this->redirect(Yii::$app->homeUrl . 'setting/branch/branch-grid-filter/' . $url);
        } else if ($page == 'list') {
            return $this->redirect(Yii::$app->homeUrl . 'setting/branch/index-filter/' . $url);
        } else {
            if ($page == 'view') {
                return $this->redirect(Yii::$app->homeUrl . 'setting/branch/branch-view-filter/' . $url);
            }
            return "eror";
        }
    }

    function actionNoBranch($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $companyId = $param["companyId"] ?? 0;

        // throw new exception($companyId);
        $group = Group::find()->select('groupId')->where(["status" => 1])->asArray()->one();
       if (!isset($group) || empty($group)) {
            // return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group/'); ยังไม่มีและเป็นค่าว่าง
            return $this->redirect(Yii::$app->homeUrl . 'setting/group/display-group/');
        }

        $company = Company::find()->select('companyId')->where(["status" => 1])->asArray()->one();
        if (!isset($company) || empty($company)) {
            // ยังไม่มีและเป็นค่าว่าง
            return $this->redirect(Yii::$app->homeUrl . 'setting/company/display-company/');
        }
        if (isset($companyId) && $companyId != '') {
            //  มีและไม่เป็นค่าว่าง
            $branch = Branch::find()->select('branchId')->where(["companyId" => $companyId, "status" => 1])->asArray()->one();
            if (isset($branch) && !empty($branch)) {
                return $this->redirect(Yii::$app->homeUrl . 'setting/branch/branch-grid-filter/' . ModelMaster::encodeParams(["companyId" => $companyId]));
            }
        } else {
            $branch = Branch::find()->select('branchId')->where(["status" => 1])->asArray()->one();
            if (isset($branch) && !empty($branch)) {
                return $this->redirect(Yii::$app->homeUrl . 'setting/branch/branch-grid/' . ModelMaster::encodeParams(["companyId" => '']));
            }
        }
        return $this->render('no_branch', [
            "companyId" => $companyId,

        ]);
    }


    public function actionIndex()
    {
        $role = UserRole::userRight();

        $totalEmployees = 0;
        $totalDepartment = 0;
        $totalTeam = 0;

        $branches = Api::connectApi(Path::Api() . 'masterdata/branch/active-branch?page=1' . '&limit=7');
        $countries = Api::connectApi(Path::Api() . 'masterdata/country/company-country');
        $company = Api::connectApi(Path::Api() . 'masterdata/company/all-company');
        $numPage = Api::connectApi(Path::Api() . 'masterdata/branch/branch-page?page=1' . '&countryId=0' . '&companyId=0' . '&limit=7');
        $branches = Api::connectApi(Path::Api() . 'masterdata/branch/active-branch?page=1' . '&limit=7');

        $data = [];
        if (isset($branches) && count($branches) > 0) {
            foreach ($branches as $branch) :

                $branchId = $branch['branchId'];
                $employees = Employee::find()
                    ->where(["branchId" => $branchId, "status" => 1])
                    ->asArray()
                    ->all();

                // ✅ กรองเฉพาะที่มี picture และไฟล์มีอยู่จริง
                $filteredEmployees = array_filter($employees, function ($employee) {
                    $relativePath = $employee["picture"] ?? '';
                    $absolutePath = Yii::getAlias('@webroot') . '/' . ltrim($relativePath, '/');

                    return !empty($relativePath) && file_exists($absolutePath);
                });

                // ✅ รีเซ็ต index และเลือกแค่ 3 คนแรก
                $filteredEmployees = array_slice(array_values($filteredEmployees), 0, 3);

                // ✅ เซ็ต default ถ้าไม่มีใครมีรูป
                foreach ($filteredEmployees as &$employee) {
                    $relativePath = $employee["picture"] ?? '';
                    $absolutePath = Yii::getAlias('@webroot') . '/' . ltrim($relativePath, '/');

                    if (!empty($relativePath) && file_exists($absolutePath)) {
                        $employee['pictureUrl'] = $employee["picture"];
                    } else {
                        $employee['pictureUrl'] = 'image/no-employee.svg';
                    }
                }
                // unset($employee); // Good practice after foreach reference


                // นับจำนวน
                $departments = Department::find()
                    ->where(["branchId" => $branch["branchId"], "status" => 1])
                    ->asArray()
                    ->all();
                foreach ($departments as $department) :
                    $teams = Team::find()
                        ->where(["departmentId" => $department["departmentId"], "status" => 1])
                        ->asArray()
                        ->all();
                    if (isset($teams) && count($teams) > 0) {
                        foreach ($teams as $team) :
                            $employees = Employee::find()
                                ->where(["status" => 1, "teamId" => $team["teamId"]])
                                ->asArray()
                                ->all();
                            $totalEmployees += count($employees);
                        endforeach;
                    }
                    $totalTeam += count($teams);
                endforeach;

                $relativePath = $branch["branchImage"] ?? '';
                $absolutePath = Yii::getAlias('@webroot') . '/' . ltrim($relativePath, '/');

                if (!empty($relativePath) && file_exists($absolutePath)) {
                    // ✅ ไฟล์มีอยู่จริงในเครื่องที่รัน (local หรือ server)
                    $pictureUrl = $branch["branchImage"];
                } else {
                    // ❌ ไม่มีไฟล์ → ใช้รูป default แทน
                    $pictureUrl = 'image/no-branch.svg';
                }

                // ✅ เช็คไฟล์รูปของ branch
                $branchPicRelative = $branch["picture"] ?? '';
                $branchPicAbsolute = Yii::getAlias('@webroot') . '/' . ltrim($branchPicRelative, '/');

                if (!empty($branchPicRelative) && file_exists($branchPicAbsolute)) {
                    $branchPictureUrl = $branchPicRelative;
                } else {
                    $branchPictureUrl = "image/no-company.svg";
                }



                //เก็บค่า
                $data[$branch["branchId"]] = [
                    "branchId" => $branch["branchId"],
                    "branchName" => $branch["branchName"],
                    "companyId" => $branch["companyId"],
                    "description" => $branch["description"],
                    "status" => $branch["status"],
                    "createDateTime" => $branch["createDateTime"],
                    "updateDateTime" => $branch["updateDateTime"],
                    "financial_start_month" => $branch["financial_start_month"],
                    "branchImage" => $pictureUrl,
                    "currency_default" => $branch["currency_default"],
                    "companyName" => $branch["companyName"],
                    "countryName" => $branch["countryName"],
                    "picture" => !empty($branchPictureUrl) ? $branchPictureUrl : "image/no-company.svg",
                    "flag" => !empty($branch["flag"]) ? $branch["flag"] : "image/e-world.svg",
                    "city" => $branch["city"],
                    "totalDepartment" => count($departments),
                    "totalTeam" => $totalTeam,
                    "totalEmployee" => $totalEmployees,
                    "employees" => $filteredEmployees,
                ];
            endforeach;
        }

        if (count($branches) > 0) {
            return $this->render('index', [
                "branches" => $data,
                "role" => $role,
                "countries" => $countries,
                "company" => $company,
                "countryId" => 0,
                "companyId" => 0,
                "numPage" => $numPage
            ]);
        }
    }


    public function actionIndexFilter($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $companyId = $param["companyId"];
        $countryId = $param["countryId"];
        $nextPage = $param["nextPage"];

        $role = UserRole::userRight();

        $totalEmployees = 0;
        $totalDepartment = 0;
        $totalTeam = 0;
        $countries = Api::connectApi(
            Path::Api() . 'masterdata/country/company-country'
        );

        $company = Api::connectApi(
            Path::Api() . 'masterdata/company/all-company'
        );

        $numPage = Api::connectApi(
            Path::Api() . 'masterdata/branch/branch-page?page=' . $nextPage
                . '&countryId=' . $countryId
                . '&companyId=' . $companyId
                . '&limit=7'
        );

        $branches = Api::connectApi(
            Path::Api() . 'masterdata/branch/active-branch-filter?id=1'
                . '&page=' . $nextPage
                . '&countryId=' . $countryId
                . '&companyId=' . $companyId
                . '&limit=6'
        );

        $data = [];
        if (isset($branches) && count($branches) > 0) {
            foreach ($branches as $branch) :

                $branchId = $branch['branchId'];
                $employees = Employee::find()
                    ->where(["branchId" => $branchId, "status" => 1])
                    ->asArray()
                    ->all();
                // กรองเฉพาะที่มี picture
                $filteredEmployees = array_filter($employees, function ($employee) {
                    return !empty($employee['picture']);
                });
                // รีเซ็ต index และเลือกแค่ 3 คนแรก
                $filteredEmployees = array_slice(array_values($filteredEmployees), 0, 3);

                // นับจำนวน
                $departments = Department::find()
                    ->where(["branchId" => $branch["branchId"], "status" => 1])
                    ->asArray()
                    ->all();
                foreach ($departments as $department) :
                    $teams = Team::find()
                        ->where(["departmentId" => $department["departmentId"], "status" => 1])
                        ->asArray()
                        ->all();
                    if (isset($teams) && count($teams) > 0) {
                        foreach ($teams as $team) :
                            $employees = Employee::find()
                                ->where(["status" => 1, "teamId" => $team["teamId"]])
                                ->asArray()
                                ->all();
                            $totalEmployees += count($employees);
                        endforeach;
                    }
                    $totalTeam += count($teams);
                endforeach;

                $relativePath = $branch["branchImage"] ?? '';
                $absolutePath = Yii::getAlias('@webroot') . '/' . ltrim($relativePath, '/');

                if (!empty($relativePath) && file_exists($absolutePath)) {
                    // ✅ ไฟล์มีอยู่จริงในเครื่องที่รัน (local หรือ server)
                    $pictureUrl = $branch["branchImage"];
                } else {
                    // ❌ ไม่มีไฟล์ → ใช้รูป default แทน
                    $pictureUrl = 'image/no-branch.svg';
                }
                //เก็บค่า
                $data[$branch["branchId"]] = [
                    "branchId" => $branch["branchId"],
                    "branchName" => $branch["branchName"],
                    "companyId" => $branch["companyId"],
                    "description" => $branch["description"],
                    "status" => $branch["status"],
                    "createDateTime" => $branch["createDateTime"],
                    "updateDateTime" => $branch["updateDateTime"],
                    "financial_start_month" => $branch["financial_start_month"],
                    "branchImage" => $pictureUrl,
                    "currency_default" => $branch["currency_default"],
                    "companyName" => $branch["companyName"],
                    "countryName" => $branch["countryName"],
                    "picture" => !empty($branch["picture"]) ? $branch["picture"] : "image/no-company.svg",
                    "flag" => !empty($branch["flag"]) ? $branch["flag"] : "image/e-world.svg",
                    "city" => $branch["city"],
                    "totalDepartment" => count($departments),
                    "totalTeam" => $totalTeam,
                    "totalEmployee" => $totalEmployees,
                    "employees" => $filteredEmployees,
                ];
            endforeach;
        }

        return $this->render('index', [
            "branches" => $data,
            "role" => $role,
            "countries" => $countries,
            "countryId" => $countryId,
            "company" => $company,
            "companyId" => $companyId,
            "numPage" => $numPage
        ]);
    }

    function actionBranchGrid($hash)
    {
        $totalEmployees = 0;
        $totalDepartment = 0;
        $totalTeam = 0;
        $param = ModelMaster::decodeParams($hash);
        $companyId = $param["companyId"];
        $role = UserRole::userRight();

        $countries = Api::connectApi(
            Path::Api() . 'masterdata/country/company-country'
        );

        $company = Api::connectApi(
            Path::Api() . 'masterdata/company/all-company'
        );

        $numPage = Api::connectApi(
            Path::Api() . 'masterdata/branch/branch-page?page=1&countryId=0&companyId=' . $companyId . '&limit=6'
        );
        if ($companyId == '') {
            $branches = Api::connectApi(
                Path::Api() . 'masterdata/branch/active-branch?page=1&limit=6'
            );
        } else {
            $branches = Api::connectApi(
                Path::Api() . 'masterdata/branch/company-branch?id=' . $companyId . '&&page=1&limit=6'
            );
        }

        $data = [];
        if (isset($branches) && count($branches) > 0) {
            foreach ($branches as $branch) :

                $branchId = $branch['branchId'];
                $employees = Employee::find()
                    ->where(["branchId" => $branchId])
                    ->andWhere("status!=99")
                    ->asArray()
                    ->all();


                // $filteredEmployees = array_filter($employees, function ($employee) {
                //     return !empty($employee['picture']);
                // });
                // $filteredEmployees = array_slice(array_values($filteredEmployees), 0, 3);
                $img = [];
                $img = Employee::employeeThreeImage($employees);
                //throw new exception(print_r($img, true));
                $departments = Department::find()
                    ->where(["branchId" => $branch["branchId"], "status" => 1])
                    ->asArray()
                    ->all();
                foreach ($departments as $department) :
                    $teams = Team::find()
                        ->where(["departmentId" => $department["departmentId"], "status" => 1])
                        ->asArray()
                        ->all();
                    if (isset($teams) && count($teams) > 0) {
                        foreach ($teams as $team) :
                            $employees = Employee::find()
                                ->where(["status" => 1, "teamId" => $team["teamId"]])
                                ->asArray()
                                ->all();
                            $totalEmployees += count($employees);
                        endforeach;
                    }
                    $totalTeam += count($teams);
                endforeach;
                $relativePath = $branch["branchImage"] ?? '';
                $absolutePath = Yii::getAlias('@webroot') . '/' . ltrim($relativePath, '/');

                if (!empty($relativePath) && file_exists($absolutePath)) {
                    // ✅ ไฟล์มีอยู่จริงในเครื่องที่รัน (local หรือ server)
                    $pictureUrl = $branch["branchImage"];
                } else {
                    // ❌ ไม่มีไฟล์ → ใช้รูป default แทน
                    $pictureUrl = 'image/no-branch.svg';
                }

                $data[$branch["branchId"]] = [
                    "branchId" => $branch["branchId"],
                    "branchName" => $branch["branchName"],
                    "companyId" => $branch["companyId"],
                    "description" => $branch["description"],
                    "status" => $branch["status"],
                    "createDateTime" => $branch["createDateTime"],
                    "updateDateTime" => $branch["updateDateTime"],
                    "financial_start_month" => $branch["financial_start_month"],
                    "branchImage" => $pictureUrl,
                    "currency_default" => $branch["currency_default"],
                    "companyName" => $branch["companyName"],
                    "countryName" => $branch["countryName"],
                    "picture" => !empty($branch["picture"]) ? $branch["picture"] : "image/no-company.svg",
                    "flag" => !empty($branch["flag"]) ? $branch["flag"] : "image/e-world.svg",
                    "city" => $branch["city"],
                    "totalDepartment" => count($departments),
                    "totalTeam" => $totalTeam,
                    "totalEmployee" => $totalEmployees,
                    "employees" => $img,
                ];
            endforeach;
        }

        return $this->render('branch_grid', [
            "branches" => $data,
            "role" => $role,
            "countries" => $countries,
            "company" => $company,
            "countryId" => 0,
            "companyId" => $companyId,
            "numPage" => $numPage

        ]);
    }


    function actionBranchGridFilter($hash)
    {
        $param = ModelMaster::decodeParams($hash);
         
        $companyId = $param["companyId"] ?? '';
        $countryId = $param["countryId"] ?? '';
        $nextPage  = $param["nextPage"] ?? 1;
        // throw new exception(print_r($param, true));
        $totalEmployees = 0;
        $totalTeam = 0;
        $role = UserRole::userRight();

        $countries = Api::connectApi(
            Path::Api() . 'masterdata/country/company-country'
        );

        $company = Api::connectApi(
            Path::Api() . 'masterdata/company/all-company'
        );

        $numPage = Api::connectApi(
            Path::Api() . 'masterdata/branch/branch-page?page=' . $nextPage
                . '&countryId=' . $countryId
                . '&companyId=' . $companyId
                . '&limit=7'
        );

        $branches = Api::connectApi(
            Path::Api() . 'masterdata/branch/active-branch-filter?id='
                . '&page=' . $nextPage
                . '&countryId=' . $countryId
                . '&companyId=' . $companyId
                . '&limit=6'
        );

        $data = [];
        if (isset($branches) && count($branches) > 0) {
            foreach ($branches as $branch) :

                $branchId = $branch['branchId'];
                $employees = Employee::find()
                    ->where(["branchId" => $branchId, "status" => 1])
                    ->asArray()
                    ->all();
                // กรองเฉพาะที่มี picture
                $img = [];
                $img = Employee::employeeThreeImage($employees);
                $departments = Department::find()
                    ->where(["branchId" => $branch["branchId"], "status" => 1])
                    ->asArray()
                    ->all();
                foreach ($departments as $department) :
                    $teams = Team::find()
                        ->where(["departmentId" => $department["departmentId"], "status" => 1])
                        ->asArray()
                        ->all();
                    if (isset($teams) && count($teams) > 0) {
                        foreach ($teams as $team) :
                            $employees = Employee::find()
                                ->where(["status" => 1, "teamId" => $team["teamId"]])
                                ->asArray()
                                ->all();
                            $totalEmployees += count($employees);
                        endforeach;
                    }
                    $totalTeam += count($teams);
                endforeach;

                $relativePath = $branch["branchImage"] ?? '';
                $absolutePath = Yii::getAlias('@webroot') . '/' . ltrim($relativePath, '/');

                if (!empty($relativePath) && file_exists($absolutePath)) {
                    // ✅ ไฟล์มีอยู่จริงในเครื่องที่รัน (local หรือ server)
                    $pictureUrl = $branch["branchImage"];
                } else {
                    // ❌ ไม่มีไฟล์ → ใช้รูป default แทน
                    $pictureUrl = 'image/no-branch.svg';
                }

                //เก็บค่า
                $data[$branch["branchId"]] = [
                    "branchId" => $branch["branchId"],
                    "branchName" => $branch["branchName"],
                    "companyId" => $branch["companyId"],
                    "description" => $branch["description"],
                    "status" => $branch["status"],
                    "createDateTime" => $branch["createDateTime"],
                    "updateDateTime" => $branch["updateDateTime"],
                    "financial_start_month" => $branch["financial_start_month"],
                    "branchImage" => $pictureUrl,
                    "currency_default" => $branch["currency_default"],
                    "companyName" => $branch["companyName"],
                    "countryName" => $branch["countryName"],
                    "picture" => !empty($branch["picture"]) ? $branch["picture"] : "image/no-company.svg",
                    "flag" => !empty($branch["flag"]) ? $branch["flag"] : "image/e-world.svg",
                    "city" => $branch["city"],
                    "totalDepartment" => count($departments),
                    "totalTeam" => $totalTeam,
                    "totalEmployee" => $totalEmployees,
                    "employees" => $img,
                ];
            endforeach;
        }

        return $this->render('branch_grid', [
            "companyId" => $companyId,
            "branches" => $data,
            "role" => $role,
            "countries" => $countries,
            "company" => $company,
            "countryId" => $countryId,
            "numPage" => $numPage

        ]);
    }

    public function actionCreate($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $companyId = $param["companyId"];
        $group = Group::find()->select('groupId')->where(["status" => 1])->asArray()->one();
        if (!isset($group) && !empty($group)) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group/');
        }
        $company = [];
        $totalEmployees = 0;
        $totalDepartment = 0;
        $totalTeam = 0;
        if ($companyId != '') {
            $company = Api::connectApi(
                Path::Api() . 'masterdata/company/company-detail?id=' . $companyId
            );

            $branches = Api::connectApi(
                Path::Api() . 'masterdata/branch/company-branch?id=' . $companyId
            );

            $branchess = Branch::find()
                ->where(["status" => 1, "companyId" => $companyId])
                ->asArray()
                ->all();
        } else {
            $branches = Api::connectApi(
                Path::Api() . 'masterdata/branch/active-branch?page=1&limit=0'
            );

            $branchess = Branch::find()
                ->where(["status" => 1])
                ->asArray()
                ->all();
        }

        $companyGroup = Api::connectApi(
            Path::Api() . 'masterdata/group/company-group?id=' . $group["groupId"]
        );

        if (isset($branchess) && count($branchess) > 0) {
            foreach ($branchess as $branch) :
                $departments = Department::find()
                    ->where(["branchId" => $branch["branchId"], "status" => 1])
                    ->asArray()
                    ->all();
                foreach ($departments as $department) :
                    $teams = Team::find()
                        ->where(["departmentId" => $department["departmentId"], "status" => 1])
                        ->asArray()
                        ->all();
                    if (isset($teams) && count($teams) > 0) {
                        foreach ($teams as $team) :
                            $employees = Employee::find()
                                ->where(["status" => 1, "teamId" => $team["teamId"]])
                                ->asArray()
                                ->all();
                            $totalEmployees += count($employees);
                        endforeach;
                    }
                    $totalTeam += count($teams);
                endforeach;
                $totalDepartment += count($departments);
            endforeach;
        }

        return $this->render('create', [
            "company" => $company,
            "companies" => $companyGroup,
            "companyId" => $companyId,

        ]);
    }
    public function actionSaveCreateBranch()
    {
        $check = Branch::find()->where(["branchName" => $_POST["branchName"], "companyId" => $_POST["companyId"]])->one();
        if (isset($check) && !empty($check)) {
            $res["status"] = false;
        } else {

            $branch = new Branch();
            $branch->branchName = $_POST["branchName"];
            $branch->companyId = $_POST["companyId"];
            $branch->description = $_POST["description"];
            $branch->status = 1;
            $branch->createDateTime = new Expression('NOW()');
            $branch->updateDateTime = new Expression('NOW()');
            if ($branch->save(false)) {
                $branchId = Yii::$app->db->lastInsertID;
                $branch = Branch::find()->where(["branchId" => $branchId])->one();

                $fileImage = UploadedFile::getInstanceByName("image");
                if (isset($fileImage) && !empty($fileImage)) {
                    $path = Path::getHost() . 'images/branch/profile/';
                    if (!file_exists($path)) {
                        mkdir($path, 0777, true);
                    }

                    // สร้างชื่อไฟล์ใหม่
                    $file = $fileImage->name;
                    $filenameArray = explode('.', $file);
                    $extension = strtolower(end($filenameArray));
                    $fileName = Yii::$app->security->generateRandomString(10) . '.' . $extension;
                    $pathSave = $path . $fileName;

                    // โหลดรูปจาก temp
                    $tempPath = $fileImage->tempName;
                    list($width, $height) = getimagesize($tempPath);
                    $srcImg = null;

                    // สร้างภาพต้นฉบับจากประเภทไฟล์
                    if (in_array($extension, ['jpg', 'jpeg'])) {
                        $srcImg = imagecreatefromjpeg($tempPath);
                    } elseif ($extension === 'png') {
                        $srcImg = imagecreatefrompng($tempPath);
                    } elseif ($extension === 'gif') {
                        $srcImg = imagecreatefromgif($tempPath);
                    }

                    if ($srcImg) {
                        $cropSize = 100;
                        $dstImg = imagecreatetruecolor($cropSize, $cropSize);

                        // คำนวณ crop ตรงกลางของรูป
                        $minSize = min($width, $height);
                        $srcX = round(($width - $minSize) / 2);
                        $srcY = round(($height - $minSize) / 2);

                        // ครอบและย่อขนาด
                        imagecopyresampled($dstImg, $srcImg, 0, 0, $srcX, $srcY, $cropSize, $cropSize, $minSize, $minSize);

                        // บันทึกภาพ
                        if (in_array($extension, ['jpg', 'jpeg'])) {
                            imagejpeg($dstImg, $pathSave, 90);
                        } elseif ($extension === 'png') {
                            imagepng($dstImg, $pathSave);
                        } elseif ($extension === 'gif') {
                            imagegif($dstImg, $pathSave);
                        }

                        imagedestroy($srcImg);
                        imagedestroy($dstImg);

                        // อัปเดต path รูปในโมเดล
                        $branch->branchImage = 'images/branch/profile/' . $fileName;
                        $branch->save(false);
                    }
                }


                return $this->redirect(Yii::$app->homeUrl . 'setting/branch/branch-view/' . ModelMaster::encodeParams(['branchId' => $branchId]));
            }
        }
    }

    public function actionBranchView($hash)
    {

        $param = ModelMaster::decodeParams($hash);
        $branchId = $param["branchId"];
        $companyId = $param["companyId"] ?? '';


        $countries = Api::connectApi(
            Path::Api() . 'masterdata/country/active-country'
        );

        $branchData = Api::connectApi(
            Path::Api() . 'masterdata/branch/branch-detail?id=' . $branchId
        );

        if (!empty($branchData)) {
            // สมมติว่า API คืนข้อมูลแบบเป็น associative array ของ branch เดียว
            $relativePath = $branchData["branchImage"] ?? '';
            $absolutePath = Yii::getAlias('@webroot') . '/' . ltrim($relativePath, '/');

            if (!empty($relativePath) && file_exists($absolutePath)) {
                // ✅ ไฟล์มีอยู่จริง
                $pictureUrl = $relativePath;
            } else {
                // ❌ ไม่มีไฟล์ → ใช้รูป default
                $pictureUrl = 'image/no-branch.svg';
            }

            // เตรียมข้อมูล branch ที่พร้อมใช้งาน
            $branch = [
                'branchId' => $branchData['branchId'],
                'branchName' => $branchData['branchName'],
                'companyId' => $branchData['companyId'],
                'description' => $branchData['description'],
                'status' => $branchData['status'],
                'createDateTime' => $branchData['createDateTime'],
                'updateDateTime' => $branchData['updateDateTime'],
                'financial_start_month' => $branchData['financial_start_month'],
                'financial_description' => $branchData['financial_description'],
                'branchImage' => $pictureUrl,
                'currency_default' => $branchData['currency_default'],
                'countryName' => $branchData['countryName'],
                'companyName' => $branchData['companyName'],
                "picture" => !empty($branchData["picture"]) ? $branchData["picture"] : "image/no-company.svg",
                "flag" => !empty($branchData["flag"]) ? $branchData["flag"] : "image/e-world.svg",
                'city' => $branchData['city'],
            ];
        }

        $numPage = Api::connectApi(
            Path::Api() . 'masterdata/department/department-page?id=' . $branchId
                . '&page=1&countryId=0&limit=5'
        );

        $departments = Api::connectApi(
            Path::Api() . 'masterdata/department/branch-department?id=' . $branchId
                . '&page=1&limit=5'
        );

        $data = [];
        if (!empty($departments)) {
            foreach ($departments as $department) :
                $departmentId = $department['departmentId'];

                $employees = Employee::find()
                    ->where(["departmentId" => $departmentId])
                    ->asArray()
                    ->all();

                // กรองเฉพาะที่มี picture
                $filteredEmployees = array_filter($employees, function ($employee) {
                    return !empty($employee['picture']);
                });

                // รีเซ็ต index และเลือกแค่ 3 คนแรก
                $filteredEmployees = array_slice(array_values($filteredEmployees), 0, 3);

                $totalEmployee = Employee::find()->where(["departmentId" => $departmentId, "status" => 1])->count();
                $teams = [];
                if (!empty($department)) {
                    $teams = Team::find()->select('teamId')
                        ->where(["status" => 1])
                        ->andWhere(['IN', 'departmentId', $department['departmentId']])
                        ->asArray()->column();
                }

                $data[] = [
                    "departmentId" => $department['departmentId'],
                    "departmentName" => $department["departmentName"],
                    "branchId" => $department['branchId'],
                    "status" => $department['status'],
                    "createDateTime" => $department['createDateTime'],
                    "updateDateTime" => $department['updateDateTime'],
                    "totalTeam" => count($teams),
                    "totalEmployee" => $totalEmployee,
                    "employees" => $filteredEmployees
                ];
            endforeach;
        }

        $company = Api::connectApi(
            Path::Api() . 'masterdata/company/company-detail?id=' . $branch["companyId"]
        );

        return $this->render('branch_view', [
            "company" => $company,
            "countries" => $countries,
            "branches" => $branch,
            "departments" => $data,
            "numPage" => $numPage,
            "companyId" => $companyId
        ]);
    }

    public function actionBranchViewFilter($hash)
    {

        $param = ModelMaster::decodeParams($hash);

        if (!empty($param['branchId'])) {
            $branchId = $param['branchId'];
        } else {
            $branchId = $param['countryId'];
            $nextPage = $param['nextPage'];
        }

        // ดึงข้อมูลประเทศ
        $countries = Api::connectApi(
            Path::Api() . 'masterdata/country/active-country'
        );

        // ดึงข้อมูลสาขา
        $branch = Api::connectApi(
            Path::Api() . 'masterdata/branch/branch-detail?id=' . $branchId
        );

        // ดึงข้อมูลจำนวนหน้าแผนก
        $numPage = Api::connectApi(
            Path::Api() . 'masterdata/department/department-page?id=' . $branchId
                . '&page=' . $nextPage
                . '&countryId=0&limit=5'
        );

        // ดึงข้อมูลแผนกในสาขา
        $departments = Api::connectApi(
            Path::Api() . 'masterdata/department/branch-department-filter?id=' . $branchId
                . '&companyId=' . $branch["companyId"]
                . '&page=' . $nextPage
                . '&limit=5'
        );

        $data = [];
        if (!empty($departments)) {
            foreach ($departments as $department) :
                $departmentId = $department['departmentId'];

                $employees = Employee::find()
                    ->where(["departmentId" => $departmentId])
                    ->asArray()
                    ->all();

                // กรองเฉพาะที่มี picture
                $filteredEmployees = array_filter($employees, function ($employee) {
                    return !empty($employee['picture']);
                });

                // รีเซ็ต index และเลือกแค่ 3 คนแรก
                $filteredEmployees = array_slice(array_values($filteredEmployees), 0, 3);

                $totalEmployee = Employee::find()->where(["departmentId" => $departmentId, "status" => 1])->count();
                $teams = [];
                if (!empty($department)) {
                    $teams = Team::find()->select('teamId')
                        ->where(["status" => 1])
                        ->andWhere(['IN', 'departmentId', $department['departmentId']])
                        ->asArray()->column();
                }

                $data[] = [
                    "departmentId" => $department['departmentId'],
                    "departmentName" => $department["departmentName"],
                    "branchId" => $department['branchId'],
                    "status" => $department['status'],
                    "createDateTime" => $department['createDateTime'],
                    "updateDateTime" => $department['updateDateTime'],
                    "totalTeam" => count($teams),
                    "totalEmployee" => $totalEmployee,
                    "employees" => $filteredEmployees
                ];
            endforeach;
        }

        // ดึงข้อมูลบริษัทของสาขา
        $company = Api::connectApi(
            Path::Api() . 'masterdata/company/company-detail?id=' . $branch["companyId"]
        );

        return $this->render('branch_view', [
            "company" => $company,
            "countries" => $countries,
            "branches" => $branch,
            "departments" => $data,
            "numPage" => $numPage,
            "countryId" => 0
        ]);
    }

    public function actionDeleteBranch()
    {
        $branchId = $_POST["branchId"] - 543;
        $branch = Branch::find()->where(["branchId" => $branchId])->one();
        $branch->status = 99;
        $branch->save(false);
        $department = Department::find()->where(["branchId" => $branchId])->all();
        if (isset($department) && count($department) > 0) {
            foreach ($department as $dp) :
                DepartmentTitle::deleteAll(["departmentId" => $dp->departmentId]);
                $dp->status = 99;
                $dp->save(false);
                $teams = Team::find()->where(["departmentId" => $dp->departmentId])->all();
                if (isset($teams) && count($teams) > 0) {
                    foreach ($teams as $t) :
                        $t->status = 99;
                        $t->save(false);
                    endforeach;
                }
            endforeach;
        }
        $res["status"] = true;
        return json_encode($res);
    }
    public function actionUpdateBranch($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $branchId = $param["branchId"] - 543;

        // ดึงข้อมูลประเทศ
        $countries = Api::connectApi(
            Path::Api() . 'masterdata/country/active-country'
        );

        // ดึงข้อมูลสาขา
        $branchData = Api::connectApi(
            Path::Api() . 'masterdata/branch/branch-detail?id=' . $branchId
        );

        if (!empty($branchData)) {
            // สมมติว่า API คืนข้อมูลแบบเป็น associative array ของ branch เดียว
            $relativePath = $branchData["branchImage"] ?? '';
            $absolutePath = Yii::getAlias('@webroot') . '/' . ltrim($relativePath, '/');

            if (!empty($relativePath) && file_exists($absolutePath)) {
                // ✅ ไฟล์มีอยู่จริง
                $pictureUrl = $relativePath;
            } else {
                // ❌ ไม่มีไฟล์ → ใช้รูป default
                // $pictureUrl = 'image/no-branch.svg';
                $pictureUrl = '';
            }

            // เตรียมข้อมูล branch ที่พร้อมใช้งาน
            $branch = [
                'branchId' => $branchData['branchId'],
                'branchName' => $branchData['branchName'],
                'companyId' => $branchData['companyId'],
                'description' => $branchData['description'],
                'status' => $branchData['status'],
                'createDateTime' => $branchData['createDateTime'],
                'updateDateTime' => $branchData['updateDateTime'],
                'financial_start_month' => $branchData['financial_start_month'],
                'financial_description' => $branchData['financial_description'],
                'branchImage' => $pictureUrl,
                'currency_default' => $branchData['currency_default'],
                'countryName' => $branchData['countryName'],
                'companyName' => $branchData['companyName'],
                "picture" => !empty($branchData["picture"]) ? $branchData["picture"] : "image/no-company.svg",
                "flag" => !empty($branchData["flag"]) ? $branchData["flag"] : "image/e-world.svg",
                'city' => $branchData['city'],
            ];
        }

        // ดึงข้อมูลบริษัทของสาขา
        $company = Api::connectApi(
            Path::Api() . 'masterdata/company/company-detail?id=' . $branch["companyId"]
        );

        return $this->render('update_branch', [
            "company" => $company,
            "countries" => $countries,
            "branches" => $branch
        ]);
    }
    public function actionSaveUpdateBranch()
    {
        $branchId = $_POST["branchId"] - 543;
        $companyId = $_POST["companyId"];
        $branch = Branch::find()->where([
            "companyId" => $_POST["companyId"],
            "branchId" => $branchId
        ])->one();

        if (!$branch) {
            $branch = new Branch();
            $branch->createDateTime = new Expression('NOW()');
        }

        $branch->branchName = $_POST["branchName"];
        $branch->companyId = $_POST["companyId"];
        $branch->description = $_POST["description"];
        $branch->status = 1;
        $branch->updateDateTime = new Expression('NOW()');

        if ($branch->save(false)) {
            if ($branch->isNewRecord) {
                $branchId = Yii::$app->db->lastInsertID;
            } else {
                $branchId = $branch->branchId;
            }

            $fileImage = UploadedFile::getInstanceByName("image");
            if (isset($fileImage) && !empty($fileImage)) {
                $path = Path::getHost() . 'images/branch/profile/';
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }

                $filenameArray = explode('.', $fileImage->name);
                $ext = strtolower(end($filenameArray));
                $fileName = Yii::$app->security->generateRandomString(10) . '.' . $ext;
                $pathSave = $path . $fileName;

                // โหลดภาพจาก temp
                $tempPath = $fileImage->tempName;
                list($width, $height) = getimagesize($tempPath);
                $srcImg = null;

                if (in_array($ext, ['jpg', 'jpeg'])) {
                    $srcImg = imagecreatefromjpeg($tempPath);
                } elseif ($ext === 'png') {
                    $srcImg = imagecreatefrompng($tempPath);
                } elseif ($ext === 'gif') {
                    $srcImg = imagecreatefromgif($tempPath);
                }

                if ($srcImg) {
                    $cropSize = 100;
                    $dstImg = imagecreatetruecolor($cropSize, $cropSize);

                    // คำนวณจุด crop ตรงกลาง
                    $minSize = min($width, $height);
                    $srcX = round(($width - $minSize) / 2);
                    $srcY = round(($height - $minSize) / 2);

                    // Crop + Resize
                    imagecopyresampled($dstImg, $srcImg, 0, 0, $srcX, $srcY, $cropSize, $cropSize, $minSize, $minSize);

                    // บันทึกภาพ
                    if (in_array($ext, ['jpg', 'jpeg'])) {
                        imagejpeg($dstImg, $pathSave, 90);
                    } elseif ($ext === 'png') {
                        imagepng($dstImg, $pathSave);
                    } elseif ($ext === 'gif') {
                        imagegif($dstImg, $pathSave);
                    }

                    imagedestroy($srcImg);
                    imagedestroy($dstImg);

                    // เซฟ path รูปลง DB
                    $branch->branchImage = 'images/branch/profile/' . $fileName;
                    $branch->save(false);
                }
            }

            return $this->redirect(Yii::$app->homeUrl . 'setting/branch/branch-view/' . ModelMaster::encodeParams(['branchId' =>  $branchId, 'companyId' => $companyId]));
        }
    }

    public function actionSearchBranch()
    {
        $companyId = $_POST["companyId"];
        return $this->redirect(Yii::$app->homeUrl . 'setting/branch/create/' . ModelMaster::encodeParams(["companyId" => $companyId]));
    }
    public function actionCompanyBranchFilter()
    {
        $companyId = $_POST["companyId"];
        $text = '<option value="">Branch</option>';
        $branches = Branch::find()
            ->select('branchId,branchName')
            ->where(["companyId" => $companyId, "status" => 1])
            ->orderBy('branchName')
            ->asArray()
            ->all();
        if (isset($branches) && count($branches) > 0) {
            foreach ($branches as $branch) :
                $text .= '<option value="' . $branch["branchId"] . '">' . $branch["branchName"] . '</option>';
            endforeach;
        }
        $res["branch"] = $text;
        return json_encode($res);
    }

    public function actionBranchDepartmentList()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        // รับ JSON body โดยตรง
        $data = json_decode(file_get_contents("php://input"), true);
        $branchId = isset($data['branchId']) ? $data['branchId'] : null;
        // return ['error' => 'test'];
        if (!$branchId) {
            return ['error' => 'Missing branchId'];
        }

        $branches = Api::connectApi(
            Path::Api() . 'masterdata/department/branch-department?id=' . $branchId
                . '&page=1&limit=0'
        );
        return $branches;
    }
}
