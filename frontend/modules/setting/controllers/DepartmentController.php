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

/**
 * Default controller for the `setting` module
 */
// header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
// header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
// header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
// header("Cache-Control: post-check=0, pre-check=0", false);
// header("Pragma: no-cache");
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
        return true; //go to origin request
    }

    public function actionEncodeParamsCountry() {
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
	
		$countryId = Yii::$app->request->post('countryId');
        $companyId = Yii::$app->request->post('companyId');
        $branchId = Yii::$app->request->post('branchId');
		$page = Yii::$app->request->post('page');

		$url =  ModelMaster::encodeParams(['countryId' => $countryId,'companyId' => $companyId, 'branchId' => $branchId,  'nextPage' => 1]);
	
		if($page == 'grid') {
			return $this->redirect(Yii::$app->homeUrl . 'setting/department/index-filter/'. $url );
		}else if($page == 'view') {
            return $this->redirect(Yii::$app->homeUrl . 'setting/department/department-view/'. $url );
		}
	}

	public function actionEncodeParamsPage() {
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
	
        $countryId = Yii::$app->request->post('countryId');
        $companyId = Yii::$app->request->post('companyId');
        $branchId = Yii::$app->request->post('branchId');
        $page = Yii::$app->request->post('page');
		$nextPage = Yii::$app->request->post('nextPage');

		// throw new exception(print_r($nextPage, true));

		$url =  ModelMaster::encodeParams(['countryId' => $countryId, 'companyId' => $companyId, 'branchId' => $branchId , 'nextPage' => $nextPage]);
	
		if($page == 'grid') {
			return $this->redirect(Yii::$app->homeUrl . 'setting/department/index-filter/'. $url );
		}else if($page == 'view') {
            return $this->redirect(Yii::$app->homeUrl . 'setting/department/department-view/'. $url );
        }
	}

	public function actionNoDepartment($hash)
	{
        $param = ModelMaster::decodeParams($hash);
        $branchId = $param["branchId"];
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

        $branch = Department::find()->select('departmentId')->where(["status" => 1])->asArray()->one();
        if (isset($branch) && !empty($branch)) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/department/index/');
        }

        return $this->render('no_department', [
            "branchId" => $branchId,
            "group" =>  $group
        ]);
	}

    public function actionIndex()
    {
        //ทำวันจันทร์
        $role = UserRole::userRight();
        $data =[];
        $api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/country/company-country');
		$countries = curl_exec($api);
		$countries = json_decode($countries, true);
        
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/all-company');
		$company = curl_exec($api);
		$company = json_decode($company, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/active-branch?page=1'. '&limit=0');
        $branch = curl_exec($api);
        $branch = json_decode($branch, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/branch-page?page=1' . '&countryId='. '&companyId=' . '&limit=6');
		$numPage = curl_exec($api);
		$numPage = json_decode($numPage, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/index?id=' . '&&page=1' . '&limit=6');
        $branches = curl_exec($api);
        $branches = json_decode($branches, true);

        // throw new Exception("branch: " . print_r($branch, true));

        if (isset($branches) && count($branches) > 0) {
            foreach ($branches as $row) :
                $branchId = $row['branchId'];

                curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/branch-department?id=' .  $branchId . '&page=1' . '&limit=0');
                $departments = curl_exec($api);
                $departments = json_decode($departments, true);

                // throw new Exception("departments: " . print_r($branchId, true));

            if (!isset($data[$branchId])) {
                // ตั้งค่าข้อมูล branch ครั้งแรก
                $data[$branchId] = [
                    'branchId' => $row['branchId'],
                    'branchName' => $row['branchName'],
                    'companyId' => $row['companyId'],
                    'companyName' => $row['companyName'],
                    'picture' => $row['picture'],
                    'city' => $row['city'],
                    'countryId' => $row['countryId'],
                    'countryName' => $row['countryName'],
                    'flag' => $row['flag'],
                    'departments' => $departments
                ];
            }

            endforeach;
        }

        curl_close($api);

        // throw new exception(print_r($data, true));

        return $this->render('index',[
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
        $data =[];
        $api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/country/company-country');
		$countries = curl_exec($api);
		$countries = json_decode($countries, true);
        
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/all-company');
		$company = curl_exec($api);
		$company = json_decode($company, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/active-branch?page=1'. '&limit=0');
        $branch = curl_exec($api);
        $branch = json_decode($branch, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/branch-page-filter?page='. $nextPage . '&countryId='. $countryId . '&companyId='. $companyId . '&branchId='. $branchId . '&limit=6');
		$numPage = curl_exec($api);
		$numPage = json_decode($numPage, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/index-filter?countryId='. $countryId . '&&companyId='. $companyId . '&&branchId='. $branchId . '&&page=' . $nextPage . '&limit=6');
        $branches = curl_exec($api);
        $branches = json_decode($branches, true);

        // throw new Exception("branch: " . print_r($branch, true));

        if (isset($branches) && count($branches) > 0) {
            foreach ($branches as $row) :
                $branchesId = $row['branchId'];

                curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/branch-department?id=' .  $branchesId . '&page=1' . '&limit=0');
                $departments = curl_exec($api);
                $departments = json_decode($departments, true);

                // throw new Exception("departments: " . print_r($branchId, true));

            if (!isset($data[$branchesId])) {
                // ตั้งค่าข้อมูล branch ครั้งแรก
                $data[$branchesId] = [
                    'branchId' => $row['branchId'],
                    'branchName' => $row['branchName'],
                    'companyId' => $row['companyId'],
                    'companyName' => $row['companyName'],
                    'picture' => $row['picture'],
                    'city' => $row['city'],
                    'countryId' => $row['countryId'],
                    'countryName' => $row['countryName'],
                    'flag' => $row['flag'],
                    'departments' => $departments
                ];
            }

            endforeach;
        }

        curl_close($api);

        // throw new exception(print_r($data, true));

        return $this->render('index',[
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
        
		// throw new Exception(print_r($param, true)); // Debug: ดูข้อมูลทั้งหมด

        $api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);


		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/country/active-country');
		$resultCountry = curl_exec($api);
		$countries = json_decode($resultCountry, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/branch-detail?id=' .  $branchId );
		$branch = curl_exec($api);
		$branch = json_decode($branch, true);
        // throw new Exception("branch: " . print_r($branch, true));

        // curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/department-page?id=' . $branchId .'&page=1' . '&countryId=0' . '&limit=0');
		// $numPage = curl_exec($api);
		// $numPage = json_decode($numPage, true);
        // // throw new Exception("numPage: " . print_r($numPage, true));

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/branch-department?id=' .  $branchId . '&page=1' . '&limit=0');
		$departments = curl_exec($api);
		$departments = json_decode($departments, true);
        // throw new Exception("department: " . print_r($departments, true));

        $data = [];
		if (!empty($departments)) {
            foreach ($departments as $department) :
				$departmentId = $department['departmentId'];

				$employees = Employee::find()
				->where(["departmentId" => $departmentId])
				->asArray()
				->all();


				// กรองเฉพาะที่มี picture
				$filteredEmployees = array_filter($employees, function($employee) {
					return !empty($employee['picture']);
				});

				// รีเซ็ต index และเลือกแค่ 3 คนแรก
				$filteredEmployees = array_slice(array_values($filteredEmployees), 0, 3);

				// throw new Exception(print_r($filteredEmployees, true)); // Debug: ดูเฉพาะ 3 คนที่มี picture

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

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/company-detail?id=' . $branch["companyId"]);
        $company = curl_exec($api);
        $company = json_decode($company, true);
        
		curl_close($api);

        // throw new Exception("department: " . print_r($data, true));

        return $this->renderPartial('modal_department', [
            "company" => $company,
			"countries" => $countries,
            "branches" => $branch,
            "departments" => $data,
            // "numPage" => $numPage,
            "countryId" => 0
        ]); 
        // ไฟล์ `views/setting/model_department.php`

        // return $this->render('modal_department', [
		// ]);
    }

    
    public function actionDepartmentsView($hash){
        
        $param = ModelMaster::decodeParams($hash);

        $branchId = $param["branchId"];
        
		// throw new Exception(print_r($param, true)); // Debug: ดูข้อมูลทั้งหมด

        $api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);


		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/country/active-country');
		$resultCountry = curl_exec($api);
		$countries = json_decode($resultCountry, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/branch-detail?id=' .  $branchId );
		$branch = curl_exec($api);
		$branch = json_decode($branch, true);
        // throw new Exception("branch: " . print_r($branch, true));

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/department-page?id=' . $branchId .'&page=1' . '&countryId=0' . '&limit=5');
		$numPage = curl_exec($api);
		$numPage = json_decode($numPage, true);
        // throw new Exception("numPage: " . print_r($numPage, true));

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/branch-department?id=' .  $branchId . '&page=1' . '&limit=5');
		$departments = curl_exec($api);
		$departments = json_decode($departments, true);
        // throw new Exception("department: " . print_r($departments, true));

        $data = [];
		if (!empty($departments)) {
            foreach ($departments as $department) :
				$departmentId = $department['departmentId'];

				$employees = Employee::find()
				->where(["departmentId" => $departmentId])
				->asArray()
				->all();

				// throw new Exception(print_r($employees, true)); // Debug: ดูข้อมูลทั้งหมด

				// กรองเฉพาะที่มี picture
				$filteredEmployees = array_filter($employees, function($employee) {
					return !empty($employee['picture']);
				});

				// รีเซ็ต index และเลือกแค่ 3 คนแรก
				$filteredEmployees = array_slice(array_values($filteredEmployees), 0, 3);

				// throw new Exception(print_r($filteredEmployees, true)); // Debug: ดูเฉพาะ 3 คนที่มี picture

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

        // throw new Exception("data: " . print_r($data, true));

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/company-detail?id=' . $branch["companyId"]);
        $company = curl_exec($api);
        $company = json_decode($company, true);

		curl_close($api);
		 
		// throw new Exception("company: " . print_r($company, true));

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
        $branchId = $param["branchId"];
        $companyId = $param["companyId"] ?? null;
        $companyName = '';
        $branchName = '';

        $group = Group::find()->select('groupId')->where(["status" => 1])->asArray()->one();

        $api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

        //เช็คว่ามีคอมปานีรึยัง
        if (!empty($companyId)) {
            curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/company-detail?id=' . $companyId );
            $companies = curl_exec($api);
            $companies = json_decode($companies, true);
            $companyName = $companies["companyName"];
        } else {
            curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/all-company');
            $companies = curl_exec($api);
            $companies = json_decode($companies, true);
        }

        if (!empty($branchId)) {
            curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/branch-detail?id=' . $branchId);
            $branchJson = curl_exec($api);
            $branches = json_decode($branchJson, true);
            $branchName = $branches["branchName"];
        } else {
            
        }

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/group-detail?id=' . $group["groupId"]);
        $group = curl_exec($api);
        $group = json_decode($group, true);

        // throw new exception(print_r($group, true));

        // curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/active-branch?page=1'. '&limit=6');
        // $branchJson = curl_exec($api);
        // $branches = json_decode($branchJson, true);
		// throw new exception(print_r($branches, true));

		curl_close($api);

        return $this->render('create', [
            // "branchId" => $branchId,
            // "companyId" => '',
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
        if (isset($_POST["branchId"]) && isset($_POST["branchName"])) {
            $branchId = $_POST["branchId"];
            $names = $_POST["branchName"]; // ควรเป็น array เช่นจาก <input name="branchName[]">
        
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
        
            return $this->redirect(Yii::$app->homeUrl . 'setting/department/no-department/' . ModelMaster::encodeParams(["branchId" => '']));
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
            }else{
                $department = new Department();
                $department->departmentName = $departmentName;
                $department->branchId = $branchId;
                $department->status = '1';
                $department->createDateTime = new Expression('NOW()');
                $department->updateDateTime = new Expression('NOW()');
    
                if ($department->save()) {
                    $api = curl_init();
                    curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
                    curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/branch-department?id=' .  $branchId . '&page=1&limit=0');
                    $departments = curl_exec($api);
                    $departments = json_decode($departments, true);
                    curl_close($api);

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

        // return ['success' => false, 'message' => $update];

        if ($update) {
            $update->departmentName = $departmentName;
            $update->updateDateTime =  new Expression('NOW()');

			if ($update->save(false)) {
                // ดึง branchId จาก model (ถ้ามี)
                // return ['success' => false, 'message' =>  ' 2 '];

                $branchId = $update->branchId;

                $api = curl_init();
                curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
                curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/branch-department?id=' . $branchId . '&page=1&limit=0');
                $departments = curl_exec($api);
                $departments = json_decode($departments, true);
                curl_close($api);

                return [
                    'success' => true,
                    'departments' => $departments
                ];
            } else {
                // return ['success' => false, 'message' =>  ' 1 '];
                // return ['success' => false, 'errors' => $update->getErrors()];
                if (!$update->save()) {
                    $errorText = [];
                    foreach ($update->getErrors() as $field => $errors) {
                        $errorText[] = implode(', ', $errors);
                    }
                    return ['success' => false, 'message' => implode("\n", $errorText)];
                }                
            }

            // return ['success' => false, 'message' => $departmentName . ' '. $departmentId];


        } else {
            return ['success' => false, 'message' => 'Department not found'];
        }
    }

    return ['success' => false, 'message' => 'Missing required POST parameters'];
}

    
    public function actionDeleteDepartment()
    {
        $departmentId = $_POST["departmentId"] - 543;
        $department = Department::find()->where(["departmentId" => $departmentId])->one();
        $department->status = 99;
        Team::updateAll(["status" => 99], ["departmentId" => $departmentId]);
        if ($department->save(false)) {
            $res["status"] = true;
        } else {
            $res["status"] = false;
        }
        return json_encode($res);
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
        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/title/title-list');
        $titleList = curl_exec($api);
        $titleList = json_decode($titleList, true);
        curl_close($api);
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

        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);


        if (isset($param["companyId"]) && $param["companyId"] != '') {
            $companyId = $param["companyId"];
            curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/company-detail?id=' . $companyId);
            $company = curl_exec($api);
            $company = json_decode($company, true);

            curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/company-department?id=' . $companyId);
            $departments = curl_exec($api);
            $departments = json_decode($departments, true);
            //throw new Exception(1);
        } else {
            curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' .  $group["groupId"]);
            $companies = curl_exec($api);
            $companies = json_decode($companies, true);
            $companyId = null;
            //throw new Exception(2);
        }
        //throw new Exception($branchId . '==' . $companyId);
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/branch-department-filter?branchId=' . $branchIdSearch . '&&companyId=' . $companyIdSearch . '&&page=1' . '&limit=7' );
        $departments = curl_exec($api);
        $departments = json_decode($departments, true);

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
        //throw new Exception(print_r($departmentList, true));



        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/title/title-list');
        $titleList = curl_exec($api);
        $titleList = json_decode($titleList, true);

        if ($companyId == null) {
            $branches = [];
            $branchess = Branch::find()
                ->where(["status" => 1])
                ->asArray()
                ->all();
        } else {
            curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/company-branch?id=' . $companyId);
            $branches = curl_exec($api);
            $branches = json_decode($branches, true);
            $branchess = Branch::find()
                ->where(["status" => 1, "companyId" => $companyId])
                ->asArray()
                ->all();
        }

        if ($branchId == null) {
        } else {
            curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/branch-detail?id=' . $branchId);
            $branch = curl_exec($api);
            $branch = json_decode($branch, true);
        }


        if ($companyIdSearch != '') {
            curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/company-branch?id=' . $companyIdSearch);
            $branchSearch = curl_exec($api);
            $branchSearch = json_decode($branchSearch, true);
        }
        curl_close($api);
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
        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/department-title?id=' . $departmentId);
        $titles = curl_exec($api);
        $titles = json_decode($titles, true);
        curl_close($api);
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
}