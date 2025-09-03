<?php

namespace frontend\modules\setting\controllers;

use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
use frontend\models\hrvc\Branch;
use frontend\models\hrvc\Company;
use frontend\models\hrvc\Country;
use frontend\models\hrvc\Department;
use frontend\models\hrvc\DepartmentTitle;
use frontend\models\hrvc\Employee;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\Team;
use frontend\models\hrvc\Title;
use frontend\models\hrvc\UserRole;
use Yii;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\Response;
use frontend\components\Api;

/**
 * Default controller for the `setting` module
 */

class DepartmentController extends Controller
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
		if($role <= 3 ){
			return  $this->redirect(Yii::$app->request->referrer);
		}
        return true; //go to origin request
    }

    public function actionEncodeParamsCountry()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $countryId = Yii::$app->request->post('countryId');
        $companyId = Yii::$app->request->post('companyId');
        $branchId = Yii::$app->request->post('branchId');
        $page = Yii::$app->request->post('page');

        $url =  ModelMaster::encodeParams(['countryId' => $countryId, 'companyId' => $companyId, 'branchId' => $branchId,  'nextPage' => 1]);

        if ($page == 'grid') {
            return $this->redirect(Yii::$app->homeUrl . 'setting/department/index-filter/' . $url);
        } else if ($page == 'view') {
            return $this->redirect(Yii::$app->homeUrl . 'setting/department/department-view/' . $url);
        }
    }

    public function actionEncodeParamsPage()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $countryId = Yii::$app->request->post('countryId');
        $companyId = Yii::$app->request->post('companyId');
        $branchId = Yii::$app->request->post('branchId');
        $page = Yii::$app->request->post('page');
        $nextPage = Yii::$app->request->post('nextPage');

        $url =  ModelMaster::encodeParams(['countryId' => $countryId, 'companyId' => $companyId, 'branchId' => $branchId, 'nextPage' => $nextPage]);

        if ($page == 'grid') {
            return $this->redirect(Yii::$app->homeUrl . 'setting/department/index-filter/' . $url);
        } else if ($page == 'view') {
            return $this->redirect(Yii::$app->homeUrl . 'setting/department/departments-view/' . $url);
        }
    }

    public function actionNoDepartment($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $group = Group::find()->select('groupId')->where(["status" => 1])->asArray()->one();
        if (!isset($group) && empty($group)) {
            // return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group/');
            return $this->redirect(Yii::$app->homeUrl . 'setting/group/display-group/');
        }

        $company = Company::find()->select('companyId')->where(["status" => 1])->asArray()->one();
        if (!isset($company) && empty($company)) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/company/display-company/');
        }

        $branch = Branch::find()->select('branchId')->where(["status" => 1])->asArray()->one();
        if (!isset($branch) && empty($branch)) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/branch/no-branch/'. ModelMaster::encodeParams(["companyId" => '']));
        }

        $department = Department::find()->select('departmentId')->where(["status" => 1])->asArray()->one();
        if (isset($department) && !empty($department)) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/department/index/');
        }
        $branchId = $param["branchId"] ?? '';

        return $this->render('no_department', [
            "branchId" => $branchId,
            "group" =>  $group
        ]);
    }

    public function actionIndex()
    {

        $role = UserRole::userRight();
        $data = [];
       // ดึงข้อมูลประเทศ
        $countries = Api::connectApi(
            Path::Api() . 'masterdata/country/company-country'
        );

        // ดึงข้อมูลบริษัท
        $company = Api::connectApi(
            Path::Api() . 'masterdata/company/all-company'
        );

        // ดึงข้อมูล branch ทั้งหมด
        $branch = Api::connectApi(
            Path::Api() . 'masterdata/branch/active-branch?page=1&limit=0'
        );

        // ดึงจำนวนหน้า branch
        $numPage = Api::connectApi(
            Path::Api() . 'masterdata/branch/branch-page?page=1&countryId=&companyId=&limit=6'
        );

        // ข้อมูล branch เป็นหลัก
        $branches = Api::connectApi(
            Path::Api() . 'masterdata/department/index?id=&page=1&limit=6'
        );

        $data = [];

        if (!empty($branches)) {
            foreach ($branches as $row) {
                $branchId = $row['branchId'];

                // ข้อมูลทีม department ของแต่ละ branch
                $departments = Api::connectApi(
                    Path::Api() . 'masterdata/department/branch-department?id=' . $branchId . '&page=1&limit=0'
                );

                // ตั้งค่าข้อมูล branch ครั้งแรก
                if (!isset($data[$branchId])) {
                    $data[$branchId] = [
                        'branchId' => $row['branchId'],
                        'branchName' => $row['branchName'],
                        'companyId' => $row['companyId'],
                        'companyName' => $row['companyName'],
                        "picture" => !empty($row["picture"]) ? $row["picture"] : "image/no-company.svg",
                        'city' => $row['city'],
                        'countryId' => $row['countryId'],
                        'countryName' => $row['countryName'],
                        "flag" => !empty($row["flag"]) ? $row["flag"] : "image/e-world.svg",
                        'departments' => $departments
                    ];
                }
            }
        }

        return $this->render('index', [
            "data" => $data,
            "role" => $role,
            "numPage" => $numPage,
            "countries" => $countries,
            "companies" => $company,
            "branches" => $branch,
            "countryId" => 0,
            "companyId" => 0,
            "branchId" => 0,
            "nextPage" => 1
        ]);
    }

    public function actionIndexFilter($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        // throw new exception(print_r($param, true));
        $countryId = !empty($param["countryId"]) ? $param["countryId"] : 0;
        $companyId = !empty($param["companyId"]) ? $param["companyId"] : 0;
        $branchId = !empty($param["branchId"]) ? $param["branchId"] : 0;
        $nextPage = !empty($param["nextPage"]) ? $param["nextPage"] : 0;

        $role = UserRole::userRight();
        // ดึงข้อมูลประเทศ
        $countries = Api::connectApi(
            Path::Api() . 'masterdata/country/company-country'
        );

        // ดึงข้อมูลบริษัท
        $company = Api::connectApi(
            Path::Api() . 'masterdata/company/all-company'
        );

        // ดึงข้อมูล branch ทั้งหมด
        $branch = Api::connectApi(
            Path::Api() . 'masterdata/branch/active-branch?page=1&limit=0'
        );

        // ดึงจำนวนหน้า branch ที่ filter
        $numPage = Api::connectApi(
            Path::Api() . 'masterdata/branch/branch-page-filter?page=' . $nextPage . '&countryId=' . $countryId . '&companyId=' . $companyId . '&branchId=' . $branchId . '&limit=6'
        );

        // ข้อมูล branch เป็นหลัก (พร้อม filter)
        $branches = Api::connectApi(
            Path::Api() . 'masterdata/department/index-filter?countryId=' . $countryId . '&companyId=' . $companyId . '&branchId=' . $branchId . '&page=' . $nextPage . '&limit=6'
        );

        $data = [];

        if (!empty($branches)) {
            foreach ($branches as $row) {
                $branchesId = $row['branchId'];

                // ข้อมูลทีม department ของแต่ละ branch
                $departments = Api::connectApi(
                    Path::Api() . 'masterdata/department/branch-department?id=' . $branchesId . '&page=1&limit=0'
                );

                // ตั้งค่าข้อมูล branch ครั้งแรก
                if (!isset($data[$branchesId])) {
                    $data[$branchesId] = [
                        'branchId' => $row['branchId'],
                        'branchName' => $row['branchName'],
                        'companyId' => $row['companyId'],
                        'companyName' => $row['companyName'],
                        "picture" => !empty($row["picture"]) ? $row["picture"] : "image/no-company.svg",
                        'city' => $row['city'],
                        'countryId' => $row['countryId'],
                        'countryName' => $row['countryName'],
                        "flag" => !empty($row["flag"]) ? $row["flag"] : "image/e-world.svg",
                        'departments' => $departments
                    ];
                }
            }
        }

        return $this->render('index', [
            "data" => $data,
            "role" => $role,
            "numPage" => $numPage,
            "countries" => $countries,
            "companies" => $company,
            "branches" => $branch,
            "countryId" => $countryId,
            "companyId" => $companyId,
            "branchId" => $branchId,
            "nextPage" => $nextPage
        ]);
    }

    public function actionModalDepartment($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $branchId = $param["branchId"];
        $depId = $param["departmentId"] ?? 0;

        // ดึงข้อมูลประเทศ
        $countries = Api::connectApi(
            Path::Api() . 'masterdata/country/active-country'
        );

        // ดึงรายละเอียด branch
        $branch = Api::connectApi(
            Path::Api() . 'masterdata/branch/branch-detail?id=' . $branchId
        );

        $relativePath = $branch["branchImage"] ?? '';
        $absolutePath = Yii::getAlias('@webroot') . '/' . ltrim($relativePath, '/');

        if (!empty($relativePath) && file_exists($absolutePath)) {
            // ✅ ไฟล์มีอยู่จริงในเครื่องที่รัน (local หรือ server)
            $pictureUrl = $branch["branchImage"];
        } else {
            // ❌ ไม่มีไฟล์ → ใช้รูป default แทน
            $pictureUrl = 'image/no-branch.svg';
        }

        $branch = [
            'branchId' => $branch['branchId'],
            'branchName' => $branch['branchName'],
            'companyId' => $branch['companyId'],
            'description' => $branch['description'],
            'status' => $branch['status'],
            'createDateTime' => $branch['createDateTime'],
            'updateDateTime' => $branch['updateDateTime'],
            'branchImage' => $pictureUrl,
            'currency_default' => $branch['currency_default'],
            'countryName' => $branch['countryName'],
            'companyName' => $branch['companyName'],
            "picture" => !empty($branch["picture"]) ? $branch["picture"] : "image/no-company.svg",
            "flag" => !empty($branch["flag"]) ? $branch["flag"] : "image/e-world.svg",
            'city' => $branch['city'],
        ];

        $departments = Api::connectApi(
            Path::Api() . 'masterdata/department/branch-department?id=' . $branchId . '&page=1&limit=0'
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

        return $this->renderPartial('modal_department', [
            "company" => $company,
            "countries" => $countries,
            "branches" => $branch,
            "departments" => $data,
            "departmentId" => $depId,
            "countryId" => 0
        ]);
    }


    public function actionDepartmentsView($hash)
    {
        $param = ModelMaster::decodeParams($hash);

        $branchId = $param["branchId"];
        $page = $param["nextPage"] ?? 1;

        // ดึงข้อมูลประเทศ
        $countries = Api::connectApi(
            Path::Api() . 'masterdata/country/active-country'
        );

        // ดึงรายละเอียด branch
        $branch = Api::connectApi(
            Path::Api() . 'masterdata/branch/branch-detail?id=' . $branchId
        );

        // ดึงจำนวนหน้า department
        $numPage = Api::connectApi(
            Path::Api() . 'masterdata/department/department-page?id=' . $branchId . '&page=' . $page . '&countryId=0&limit=5'
        );

        // ดึงข้อมูล department ของ branch
        $departments = Api::connectApi(
            Path::Api() . 'masterdata/department/branch-department?id=' . $branchId . '&page=' . $page . '&limit=5'
        );

        // ดึงข้อมูล company ของ branch
        $company = Api::connectApi(
            Path::Api() . 'masterdata/company/company-detail?id=' . $branch["companyId"]
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
        return $this->render('departments_view', [
            "company" => $company,
            "countries" => $countries,
            "branches" => $branch,
            "departments" => $data,
            "numPage" => $numPage,
            "countryId" => 0
        ]);
    }


    public function actionCreate($hash)
    {
        $role = UserRole::userRight();
        $param = ModelMaster::decodeParams($hash);
        $branchId = $param["branchId"] ?? null;
        $companyId = $param["companyId"] ?? null;
        $companyName = '';
        $branchName = '';

        $group = Group::find()->select('groupId')->where(["status" => 1])->asArray()->one();

        // เช็คว่ามี companyId หรือไม่
        if (!empty($companyId)) {
            $companies = Api::connectApi(
                Path::Api() . 'masterdata/company/company-detail?id=' . $companyId
            );
            $companyName = $companies["companyName"];
        } else {
            $companies = Api::connectApi(
                Path::Api() . 'masterdata/company/all-company'
            );
        }

        // เช็คว่ามี branchId หรือไม่
        if (!empty($branchId)) {
            $branches = Api::connectApi(
                Path::Api() . 'masterdata/branch/branch-detail?id=' . $branchId
            );
            $branchName = $branches["branchName"];
        } else {
            $branches = Api::connectApi(
                Path::Api() . 'masterdata/branch/active-branch'
            );
        }

        // ดึงรายละเอียด group
        $group = Api::connectApi(
            Path::Api() . 'masterdata/group/group-detail?id=' . $group["groupId"]
        );

        return $this->render('create', [
            "companies" => $companies,
            "companyId" => $companyId,
            "companyName" => $companyName,
            "branchId" => $branchId,
            "branchName" => $branchName,
            "group" => $group
        ]);
    }



    public function actionSaveCreateDepartment()
    {
        if (isset($_POST["branchId"]) && isset($_POST["departmentName"])) {
            $branchId = $_POST["branchId"];
            $names = $_POST["departmentName"]; // ควรเป็น array เช่นจาก <input name="departmentName[]">

            $errors = [];
            $successCount = 0;

            foreach ($names as $name) {
                $name = trim($name);
                if ($name === '') {
                    continue;
                }

                $existing = Department::find()->where([
                    "branchId" => $branchId,
                    "departmentName" => $name,
                    "status" => 1
                ])->one();

                if (!empty($existing)) {
                    $errors[] = 'Cannot create duplicate department name "' . $name . '"';
                    // continue;
                }

                $department = new Department();
                $department->departmentName = $name;
                $department->branchId = $branchId;
                $department->status = 1;
                $department->createDateTime = new Expression('NOW()');
                $department->updateDateTime = new Expression('NOW()');

                if (!empty($errors)) {
                    Yii::$app->session->setFlash('error', implode('<br>', $errors));
                    // throw new exception(print_r($errors, true));
                    return $this->redirect(Yii::$app->request->referrer);
                } else if ($department->save(false)) {
                    $successCount++;
                }
            }

            if ($successCount > 0) {
                Yii::$app->session->setFlash('success', "$successCount department(s) created successfully.");
            }

            return $this->redirect(Yii::$app->homeUrl . 'setting/department/departments-view/' . ModelMaster::encodeParams(["branchId" => $branchId]));
        }
    }


    public function actionSaveDepartment()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        // $rawData = file_get_contents("php://input");
        // $data = json_decode($rawData, true);

        // throw new exception(print_r($_POST["deptName"], true));

        if (isset($_POST["branchId"]) && isset($_POST["deptName"])) {
            $branchId = $_POST["branchId"];
            $departmentName = $_POST["deptName"];

            $existing = Department::find()->where([
                "branchId" => $branchId,
                "departmentName" => $departmentName,
                "status" => 1
            ])->one();

            // return ['success' => false, 'message' => $existing];

            if (!empty($existing)) {
                $errors[] = 'Cannot create duplicate department name "' . $departmentName . '"';
                // continue;
                return ['errors' => false, 'message' =>  $errors];
            } else {
                $department = new Department();
                $department->departmentName = $departmentName;
                $department->branchId = $branchId;
                $department->status = '1';
                $department->createDateTime = new Expression('NOW()');
                $department->updateDateTime = new Expression('NOW()');

                if ($department->save()) {
                  $departments = Api::connectApi(
                        Path::Api() . 'masterdata/department/branch-department?id=' . $branchId . '&page=1&limit=0'
                    );

                    return [
                        'success' => true,
                        'departments' => $departments // ส่งค่ากลับ
                    ];
                } else {
                    return ['success' => false, 'errors' => $department->getErrors()];
                }
            }
        }

        return ['success' => false, 'message' => 'no branchId'];
    }



    public function actionUpdateDepartment()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if (isset($_POST["departmentId"]) && isset($_POST["departmentName"])) {
            $departmentId = $_POST["departmentId"];
            $departmentName = $_POST["departmentName"];

            $update = Department::find()->where([
                "departmentId" => $departmentId,
                "status" => '1'
            ])->one();

            if ($update) {
                $update->departmentName = $departmentName;
                $update->updateDateTime =  new Expression('NOW()');

                if ($update->save(false)) {
                    $branchId = $update->branchId;

                    $departments = Api::connectApi(
                        Path::Api() . 'masterdata/department/branch-department?id=' . $branchId . '&page=1&limit=0'
                    );

                    return [
                        'success' => true,
                        'departments' => $departments
                    ];
                } else {
                    if (!$update->save()) {
                        $errorText = [];
                        foreach ($update->getErrors() as $field => $errors) {
                            $errorText[] = implode(', ', $errors);
                        }
                        return ['success' => false, 'message' => implode("\n", $errorText)];
                    }
                }

            } else {
                return ['success' => false, 'message' => 'Department not found'];
            }
        }

        return ['success' => false, 'message' => 'Missing required POST parameters'];
    }

    public function actionModalDelete()
    {
        $departmentId = Yii::$app->request->get("departmentId");

        return $this->renderPartial('modal_delete', [
            "departmentId" => $departmentId
        ]);
    }

    public function actionModalTest()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $departmentId = Yii::$app->request->post("departmentId");

        $test = Department::find()->where([
            "departmentId" => $departmentId,
            "status" => '1'
        ])->one();

        if (!$test) {
            return [
                'success' => false,
                'message' => 'Department not found'
            ];
        }

        $branchId = $test->branchId;

        $departments = Api::connectApi(
            Path::Api() . 'masterdata/department/branch-department?id=' . $branchId . '&page=1&limit=0'
        );

        $departments = json_decode($departments, true);

        if (!isset($departments)) {
            return [
                'success' => false,
                'message' => 'Unable to retrieve department list'
            ];
        }

        return [
            'success' => true,
            'departments' => $departments,
        ];
    }


    public function actionDeleteDepartment()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; // ← สำคัญ!

        if (isset($_POST["departmentId"])) {
            $departmentId = $_POST["departmentId"];

            $update = Department::find()->where([
                "departmentId" => $departmentId,
                "status" => '1'
            ])->one();

            if ($update) {
                $update->status = '99';
                $update->updateDateTime = new Expression('NOW()');

                if ($update->save(false)) {
                    $branchId = $update->branchId;
                    $departments = Api::connectApi(
                        Path::Api() . 'masterdata/department/branch-department?id=' . $branchId . '&page=1&limit=0'
                    );

                    return [
                        'success' => true,
                        'departments' => $departments
                    ];
                } else {
                    $errorText = [];
                    foreach ($update->getErrors() as $field => $errors) {
                        $errorText[] = implode(', ', $errors);
                    }
                    return ['success' => false, 'message' => implode("\n", $errorText)];
                }
            } else {
                return ['success' => false, 'message' => 'Department not found'];
            }
        }
        return ['success' => false, 'message' => 'Missing required POST parameters'];
    }

    public function actionSaveUpdateDepartment()
    {
        $departmentId = $_POST["departmentId"] - 543;
        $check = Department::find()
            ->where(["departmentName" => $_POST["departmentName"], "branchId" => $_POST["branchId"]])
            ->andWhere("departmentId!=$departmentId")
            ->one();
        $res = [];
        if (isset($check) && !empty($check)) {
            $res["status"] = false;
        } else {
            $department = Department::find()
                ->where(["departmentId" =>  $departmentId])
                ->one();
            $department->departmentName = $_POST["departmentName"];
            $department->branchId = $_POST["branchId"];
            if ($department->save(false)) {
                $titleDepartments = DepartmentTitle::find()
                    ->select('t.titleName')
                    ->JOIN("LEFT JOIN", "title t", "t.titleId=department_title.titleId")
                    ->where(["department_title.departmentId" => $departmentId])
                    ->asArray()
                    ->orderBy('department_title.titleId')
                    ->all();
                $res["status"] = true;
                $res["updateDepartment"] = $this->renderAjax('update', [
                    "departmentName" => $_POST["departmentName"],
                    "companyName" => Branch::companyName($_POST['branchId']),
                    "branchName" => Branch::BranchName($_POST['branchId']),
                    "flag" => Country::flagBranch($_POST['branchId']),
                    "departmentId" => $departmentId,
                    "titleDepartments" => $titleDepartments
                ]);
            }
        }
        return json_encode($res);
    }
    public function actionTitleList()
    {
        $titleList = Api::connectApi(
            Path::Api() . 'masterdata/title/title-list'
        );

        $dpList = [];
        $departmentTitle = DepartmentTitle::find()
            ->where(["departmentId" => $_POST["departmentId"] - 543])
            ->asArray()
            ->all();
        if (isset($departmentTitle) && count($departmentTitle) > 0) {
            foreach ($departmentTitle as $dpl) :
                $dpList[$dpl['titleId']] = 1;
            endforeach;
        }
        $res["titleList"] = $this->renderAjax('title_list', [
            "departmentId" => $_POST["departmentId"],
            "titleList" => $titleList,
            "dpList" => $dpList
        ]);
        return json_encode($res);
    }
    public function actionSaveDepartmentTitle()
    {
        $departmentId = $_POST["departmentId"] - 543;
        $titleId = $_POST["titleId"];
        $check = $_POST["check"];
        if ($check == 1) {
            $titleDepartment = new DepartmentTitle();
            $titleDepartment->departmentId = $departmentId;
            $titleDepartment->titleId = $titleId;
            $titleDepartment->status = 1;
            $titleDepartment->createDateTime = new Expression('NOW()');
            $titleDepartment->updateDateTime = new Expression('NOW()');
            $titleDepartment->save(false);
        } else {
            DepartmentTitle::deleteAll(["departmentId" => $departmentId, "titleId" => $titleId]);
        }
        $titleDepartments = DepartmentTitle::find()
            ->select('t.titleName')
            ->JOIN("LEFT JOIN", "title t", "t.titleId=department_title.titleId")
            ->where(["department_title.departmentId" => $departmentId])
            ->asArray()
            ->orderBy('department_title.titleId')
            ->all();
        $res["departmentTitle"] = $this->renderAjax('title_department', ["titleDepartments" => $titleDepartments]);
        return json_encode($res);
    }
    public function saveDefaultTitle($departmentId)
    {
        $titleList = Title::find()->where(["status" => 1])->asArray()->all();
        if (isset($titleList) && count($titleList) > 0) {
            foreach ($titleList as $title) :
                $departmentTitle = new DepartmentTitle();
                $departmentTitle->departmentId = $departmentId;
                $departmentTitle->titleId = $title["titleId"];
                $departmentTitle->status = 1;
                $departmentTitle->createDateTime = new Expression('NOW()');
                $departmentTitle->updateDateTime = new Expression('NOW()');
                $departmentTitle->save(false);
            endforeach;
        }
    }
    public function actionFilterDepartment()
    {
        $searchCompanyId = $_POST["companyId"];
        $searchBranchId = $_POST["branchId"];
        if ($searchCompanyId == '' && $searchBranchId == '') {
            return $this->redirect(Yii::$app->homeUrl . 'setting/department/create/' . ModelMaster::encodeParams(["companyId" => '']));
        } else {
            return $this->redirect(Yii::$app->homeUrl . 'setting/department/search-result/' . ModelMaster::encodeParams([
                "branchIdSearch" => $searchBranchId,
                "companyIdSearch" => $searchCompanyId
            ]));
        }
    }
    public function actionSearchResult($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $branchIdSearch = $param["branchIdSearch"];
        $companyIdSearch = $param["companyIdSearch"];

        $branches = [];
        $branch = [];
        $company = [];
        $companies = [];
        $branchId = null;
        $titleList = [];
        $departments = [];
        $branchSearch = [];
        $departmentList = [];
        $totalEmployees = 0;
        $totalBranches = 0;
        $totalTeam = 0;
        $group = Group::find()->select('groupId')->where(["status" => 1])->asArray()->one();
        if (!isset($group) && !empty($group)) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group/');
        }
        if (isset($param["branchId"])) {
            $branchId = $param["branchId"];
        }

        if (!empty($param["companyId"])) {
            $companyId = $param["companyId"];
            $company = Api::connectApi(
                Path::Api() . 'masterdata/company/company-detail?id=' . $companyId
            );
            $departments = Api::connectApi(
                Path::Api() . 'masterdata/department/company-department?id=' . $companyId
            );
        } else {
            $companies = Api::connectApi(
                Path::Api() . 'masterdata/group/company-group?id=' . $group["groupId"]
            );
            $companyId = null;
        }

        $departments = Api::connectApi(
            Path::Api() . 'masterdata/department/branch-department-filter?branchId=' . $branchIdSearch . '&companyId=' . $companyIdSearch . '&page=1&limit=7'
        );


        if (count($departments) > 0) {
            foreach ($departments as $department) :
                $departmentList[$department["departmentId"]] = [
                    "departmentName" => $department["departmentName"],
                    "companyName" => Branch::companyName($department['branchId']),
                    "branchName" => Branch::BranchName($department['branchId']),
                    "flag" => Country::flagBranch($department['branchId']),
                    "titleDepartments" => DepartmentTitle::departmentTitle($department["departmentId"])
                ];
            endforeach;
        }

        $titleList = Api::connectApi(
            Path::Api() . 'masterdata/title/title-list'
        );

        if ($companyId == null) {
            $branches = [];
            $branchess = Branch::find()
                ->where(["status" => 1])
                ->asArray()
                ->all();
        } else {
            $branches = Api::connectApi(
                Path::Api() . 'masterdata/branch/company-branch?id=' . $companyId
            );

            // ข้อมูลจากฐานข้อมูลยังเหมือนเดิม
            $branchess = Branch::find()
                ->where(["status" => 1, "companyId" => $companyId])
                ->asArray()
                ->all();

        }

        if ($branchId == null) {
        } else {
           $branch = Api::connectApi(
                Path::Api() . 'masterdata/branch/branch-detail?id=' . $branchId
            );
        }

        if ($companyIdSearch != '') {
            $branchSearch = Api::connectApi(
                Path::Api() . 'masterdata/branch/company-branch?id=' . $companyIdSearch
            );
        }

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
            endforeach;
        }
        $totalBranches += count($branchess);
        return $this->render('create', [
            "departmentList" => $departmentList,
            "branches" => $branches,
            "branch" => $branch,
            "company" => $company,
            "companies" => $companies,
            "branchId" => $branchId,
            "companyId" => $companyId,
            "titleList" => $titleList,
            "totalEmployees" => $totalEmployees,
            "totalBranches" => $totalBranches,
            "totalTeam" => $totalTeam,
            "companyIdSearch" => $companyIdSearch,
            "branchIdSearch" => $branchIdSearch,
            "branchSearch" => $branchSearch
        ]);
    }
    public function actionBranchDepartment()
    {
        $branchId = $_POST["branchId"];
        $departments = Department::find()->where(["status" => 1, "branchId" => $branchId])->asArray()->all();
        $res["totalDepartments"] = count($departments);
        return json_encode($res);
    }
    public function actionDepartmentTitle()
    {
        $departmentId = $_POST["departmentId"];
        $titles = Api::connectApi(
            Path::Api() . 'masterdata/department/department-title?id=' . $departmentId
        );
        $option = '<option value="">Title</option>';
        $res["status"] = false;
        $res["title"] = '';
        if (isset($titles) && count($titles) > 0) {
            $res["status"] = true;
            foreach ($titles as $title) :
                $option .= '<option value="' . $title["titleId"] . '">' . $title["titleName"] . '</option>';
            endforeach;
            $res["title"] = $option;
        }
        return json_encode($res);
    }
    public function actionDepartmentTeamList()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        // รับ JSON body โดยตรง
        $data = json_decode(file_get_contents("php://input"), true);
        $departmentId = isset($data['departmentId']) ? $data['departmentId'] : null;

        if (!$departmentId) {
            return ['error' => 'Missing departmentId'];
        }
        $teams = Api::connectApi(
            Path::Api() . 'masterdata/department/department-team?id=' . $departmentId . '&page=1&limit=0'
        );

        return $teams;
    }

    public function actionDepartmentTitleList()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $data = json_decode(file_get_contents("php://input"), true);
        $departmentId = isset($data['departmentId']) ? $data['departmentId'] : null;

       $titles = Api::connectApi(
            Path::Api() . 'masterdata/department/department-title?id=' . $departmentId
        );

        $title = json_decode($titles, true); // decode ครั้งเดียวพอ
        return $title;
    }
}