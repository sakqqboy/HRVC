<?php

namespace frontend\modules\setting\controllers;

use common\helpers\Path;
use common\models\hrvc\Company;
use common\models\ModelMaster;
use Exception;
use frontend\models\hrvc\Branch;
use frontend\models\hrvc\Department;
use frontend\models\hrvc\DepartmentTitle;
use frontend\models\hrvc\Employee;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\Layer;
use frontend\models\hrvc\Team;
use frontend\models\hrvc\Title;
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
class TitleController extends Controller
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

    public function actionEncodeParamsFilter() {
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
	
        $companyId = Yii::$app->request->post('companyId');
        $branchId = Yii::$app->request->post('branchId');
        $departmentId = Yii::$app->request->post('departmentId');
		$page = Yii::$app->request->post('page');

		$url =  ModelMaster::encodeParams(['companyId' => $companyId, 'branchId' => $branchId, 'departmentId' => $departmentId,  'nextPage' => 1]);
	
		if($page == 'grid') {
			return $this->redirect(Yii::$app->homeUrl . 'setting/title/index-filter/'. $url );
		}else if($page == 'view') {
            return $this->redirect(Yii::$app->homeUrl . 'setting/title/titles-view/'. $url );
		}
	}

	public function actionEncodeParamsPage() {
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
	
        // $countryId = Yii::$app->request->post('countryId');
        $companyId = Yii::$app->request->post('companyId');
        $branchId = Yii::$app->request->post('branchId');
        $departmentId = Yii::$app->request->post('departmentId');
        
        $page = Yii::$app->request->post('page');
		$nextPage = Yii::$app->request->post('nextPage');

		// throw new exception(print_r($nextPage, true));

		$url =  ModelMaster::encodeParams([ 'companyId' => $companyId, 'branchId' => $branchId ,'departmentId' => $departmentId, 'nextPage' => $nextPage]);
	
		if($page == 'grid') {
			return $this->redirect(Yii::$app->homeUrl . 'setting/title/index-filter/'. $url );
		}else if($page == 'view') {
            return $this->redirect(Yii::$app->homeUrl . 'setting/title/titles-view/'. $url );
        }
	}

    public function actionNoTitle($hash)
	{
        $param = ModelMaster::decodeParams($hash);
        $departmentId = $param["departmentId"]??0;
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

        $title = Title::find()->select('titleId')->where(["status" => 1])->asArray()->one();
        if (isset($title) && !empty($title)) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/title/index/');
        }

        return $this->render('no_title', [
            "departmentId" => $departmentId,
            "group" =>  $group
        ]);
	}
    
    public function actionIndex()
    {
        $group = Group::find()->select('groupId')->where(["status" => 1])->asArray()->one();
        if (!isset($group) && !empty($group)) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group/');
        }
        $groupId = $group["groupId"];
        $data =[];
        // $companyId = 0;
        // $branchId = 0;
        // $departmentId = 0;

        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/all-company');
		$company = curl_exec($api);
		$company = json_decode($company, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/active-branch?page=1'. '&limit=0');
        $branch = curl_exec($api);
        $branch = json_decode($branch, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/active-department?page=1'. '&limit=0');
        $department = curl_exec($api);
        $department = json_decode($department, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/team/index?id=' . '&&page=1' . '&limit=6');
        $departments = curl_exec($api);
        $departments = json_decode($departments, true);
        // throw new exception(print_r($departments, true));

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/department-page-filter?departmentId=' . '&branchId=' . '&companyId=' . '&page=1' . '&limit=6');
		$numPage = curl_exec($api);
		$numPage = json_decode($numPage, true);

        //หลุปดาต้า
        if (isset($departments) && count($departments) > 0) {
            foreach ($departments as $row) :
                $departmentId = $row['departmentId'];
                // $departmentId = "24";

                        //ข้อมูลทีมteamรอง
                curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/title/title-department?departmentId=' . '&page=1' . '&limit=0');
                $titles = curl_exec($api);
                $titles = json_decode($titles, true);

                // throw new Exception("teams: " . print_r($titles, true));

            if (!isset($data[$departmentId])) {
                // ตั้งค่าข้อมูล branch ครั้งแรก
                $data[$departmentId] = [
                    'departmentId' => $row['departmentId'],
                    'departmentName' => $row['departmentName'],
                    'branchId' => $row['branchId'],
                    'branchName' => $row['branchName'],
                    'companyId' => $row['companyId'],
                    'companyName' => $row['companyName'],
                    'picture' => $row['picture'],
                    'city' => $row['city'],
                    'countryId' => $row['countryId'],
                    'countryName' => $row['countryName'],
                    'flag' => $row['flag'],
                    'titles' => $titles
                ];
            }

            endforeach;
        }
        curl_close($api);
        // throw new exception(print_r($data, true));

        return $this->render('index', [
            // "title" => $title,
            "companies" => $company,
            "branches" => $branch,
            "departments" => $department,
            "countryId" => 0,
            "companyId" => 0,
            "branchId" => 0,
            "departmentId" => 0,
            "nextPage" => 1,
            "numPage" => $numPage,
            "data" => $data,

        ]);
    }


    public function actionIndexFilter($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $companyId = !empty($param["companyId"]) ? $param["companyId"] : 0;
        $branchId = !empty($param["branchId"]) ? $param["branchId"] : 0;
        $departmentId = !empty($param["departmentId"]) ? $param["departmentId"] : 0;
        $nextPage = !empty($param["nextPage"]) ? $param["nextPage"] : 0;
        //  throw new Exception("teams: " . print_r($param, true));
        $data =[];

        $group = Group::find()->select('groupId')->where(["status" => 1])->asArray()->one();
        if (!isset($group) && !empty($group)) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group/');
        }
        $groupId = $group["groupId"];

        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/all-company');
		$company = curl_exec($api);
		$company = json_decode($company, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/active-branch?page=' . $nextPage . '&limit=0');
        $branch = curl_exec($api);
        $branch = json_decode($branch, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/active-department?page=' . $nextPage . '&limit=0');
        $department = curl_exec($api);
        $department = json_decode($department, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/team/index-filter?departmentId=' . $departmentId . '&&branchId='. $branchId . '&&companyId='. $companyId .   '&&page=' . $nextPage  . '&limit=6');
        $departments = curl_exec($api);
        $departments = json_decode($departments, true);
        // throw new exception(print_r($departments, true));
        
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/department-page-filter?departmentId=' . $departmentId . '&branchId=' . $branchId . '&companyId=' . $companyId . '&page=' . $nextPage . '&limit=6');
		$numPage = curl_exec($api);
		$numPage = json_decode($numPage, true);
        // throw new exception(print_r($numPage, true));

        //หลุปดาต้า
        if (isset($departments) && count($departments) > 0) {
            foreach ($departments as $row) :
                $departmenstId = $row['departmentId'];
                // $departmentId = "24";

                        //ข้อมูลทีมteamรอง
                curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/title/title-department?departmentId=' .  $departmenstId . '&page=1' . '&limit=0');
                $titles = curl_exec($api);
                $titles = json_decode($titles, true);

                // throw new Exception("teams: " . print_r($titles, true));

            if (!isset($data[$departmenstId])) {
                // ตั้งค่าข้อมูล branch ครั้งแรก
                $data[$departmenstId] = [
                    'departmentId' => $row['departmentId'],
                    'departmentName' => $row['departmentName'],
                    'branchId' => $row['branchId'],
                    'branchName' => $row['branchName'],
                    'companyId' => $row['companyId'],
                    'companyName' => $row['companyName'],
                    'picture' => $row['picture'],
                    'city' => $row['city'],
                    'countryId' => $row['countryId'],
                    'countryName' => $row['countryName'],
                    'flag' => $row['flag'],
                    'titles' => $titles
                ];
            }

            endforeach;
        }
        curl_close($api);
        // throw new exception(print_r($companyId, true));

        return $this->render('index', [
            // "title" => $title,
            "companies" => $company,
            "branches" => $branch,
            "departments" => $department,
            "companyId" => $companyId,
            "branchId" => $branchId,
            "departmentId" => $departmentId,
            "nextPage" => $nextPage,
            "numPage" => $numPage,
            "data" => $data,

        ]);
    }

    public function actionTitlesView($hash){
        
        $param = ModelMaster::decodeParams($hash);

        $companyId = $param["companyId"] ?? 0;
        $branchId = $param["branchId"] ?? 0;
        $departmentId = $param["departmentId"] ?? 0;
        $nextPage = $param["nextPage"] ?? 1;

        // throw new Exception("param: " . print_r($param, true));

        $countTitle = 0;
        $role = UserRole::userRight();
        $data =[];
        $api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        // api

        //ข้อมูลทีมdeparmentเป็นหลัก
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/department-detail?id=' . $departmentId);
        $department = curl_exec($api);
        $department = json_decode($department, true);
        // throw new Exception("departments: " . print_r($department, true));

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/branch-detail?id=' . $department['branchId']);
        $branch = curl_exec($api);
        $branch = json_decode($branch, true);
        // throw new Exception("branch: " . print_r($branch, true));

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/company-detail?id=' . $branch['companyId']);
        $company = curl_exec($api);
        $company = json_decode($company, true);
        // throw new Exception("company: " . print_r($company, true));

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/country/country-detail?id=' . $company['countryId']);
        $country = curl_exec($api);
        $country = json_decode($country, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/title/title-page?id=' . $departmentId . '&page='. $nextPage . '&limit=5');
		$numPage = curl_exec($api);
		$numPage = json_decode($numPage, true);
        // throw new Exception("teams: " . print_r($numPage, true));

       
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/title/title-department-filter?departmentId=' .  $departmentId . '&page=' . $nextPage . '&limit=5');
        $titles = curl_exec($api);
        $titles = json_decode($titles, true);
        // throw new Exception("departments: " . print_r($titles, true));

        //หลุปดาต้า
        $dataTitle = [];
		if (!empty($titles)) {
            foreach ($titles as $title) :

				$employees = Employee::find()
				->where(["titleId" => $title['titleId']])
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

				$totalEmployee = Employee::find()->where(["titleId" => $title['titleId'], "status" => 1])->count();

				$dataTitle[] = [
                    "titleId" => $title['titleId'],
                    "titleName" => $title['titleName'],
					// "status" => $team['status'],
					// "createDateTime" => $team['createDateTime'],    
					// "updateDateTime" => $team['updateDateTime'],
					"totalEmployee" => $totalEmployee,
					"employees" => $filteredEmployees
				];
                $countTitle++;
			endforeach;
		}

        curl_close($api);

        $data = [
                    "departmentId" => $department['departmentId'],
                    "departmentName" => $department["departmentName"],
                    "branchId" => $branch['branchId'],
                    "branchName" => $branch['branchName'],  
                    "description" => $branch['description'],
                    "companyId" => $company['companyId'],
                    "companyName" => $company['companyName'],
                    "picture" => $company['picture'],
                    "city" => $company['city'],
                    "countryId" => $company['countryId'],
                    "countryName" => $country['countryName'],
                    "flag" => $country['flag'],
                    // "teams" => $dataTeam
				];
        
        // throw new Exception("department: " . print_r($data, true));
        
        return $this->render('titles_view', [
            "data" => $data,
            "titles" => $dataTitle,
            "role" => $role,
            "countTitle" => $countTitle,
            "numPage" => $numPage,
            "nextPage" => 1,
            "countryId" => 0
        ]); 
    }

    public function actionCreate($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $departmentId = $param["departmentId"];
        $branchId = $param["branchId"]?? null;
        $companyId = $param["companyId"] ?? null;
        $titleId = $param["titleId"] ?? null;
        $groupId = Group::currentGroupId();        // throw new exception(print_r($branchId, true));
        $typePage ='';
        $companyName = '';
        $branchName = '';
        $departmentName = '';
        $title = '';
        $group = Group::find()->select('groupId')->where(["status" => 1])->asArray()->one();
        if (!isset($group) && !empty($group)) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group/');
        }
        $groupId = $group["groupId"];

        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

        // curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
        // $companies = curl_exec($api);
        // $companies = json_decode($companies, true);
        if (!empty($titleId)) {
            // curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/branch-detail?id=' . $branchId);
            // $branchJson = curl_exec($api);
            // $branches = json_decode($branchJson, true);
            curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/title/title-detail?id=' . $titleId);
            $title = curl_exec($api);
            $title = json_decode($title, true);
            $typePage = 'Edit';
            $departmentId = $title["departmentId"];
            // throw new Exception(print_r($title, true)); // Debug: ดูข้อมูลทั้งหมด
        } 
        
         if (!empty($departmentId)) {
            curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/department-detail?id=' . $departmentId);
            $departmenJson = curl_exec($api);
            $departmentes = json_decode($departmenJson, true);
            // throw new Exception(print_r($departmentes, true));
            $departmentName = $departmentes["departmentName"];
            $branchId = $departmentes["branchId"];
        }

        if (!empty($branchId)) {
            curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/branch-detail?id=' . $branchId);
            $branchJson = curl_exec($api);
            $branches = json_decode($branchJson, true);
            $branchName = $branches["branchName"];
            $companyId = $branches["companyId"];
        } 

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
        
 

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/group-detail?id=' . $groupId);
        $group = curl_exec($api);
        $group = json_decode($group, true);

        // curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/layer/all-layer');
        // $layer = curl_exec($api);
        // $layer = json_decode($layer, true);

        curl_close($api);
        return $this->render('create', [
            "group" => $group,
            "departmentId" => $departmentId,
            "branchId" => $branchId,
            "companyId" => $companyId,
            "companyName" => $companyName,
            "branchName" => $branchName,
            "departmentName" => $departmentName,
            // "departments" => $departments,
            // "branches" => $branches,
            "companies" => $companies,
            "title" => $title,
            "typePage" => $typePage,
            // "layer" => $layer,
        ]);
    }
    public function actionCheckDupplicateTitle()
    {
        $title = Title::find()
            ->where([
                "titleName" => $_POST["titleName"],
                "departmentId" => $_POST["departmentId"],
                "status" => 1
            ])
            ->one();
        if (isset($title) && !empty($title)) {
            $res["status"] = false;
            $res["errorText"] = 'Existing Title name "' . $_POST["titleName"] . '"';
        } else {
            $res["status"] = true;
        }
        return json_encode($res);
    }
    public function actionCheckDupplicateTitleUpdate()
    {
        $title = Title::find()
            ->where([
                "titleName" => $_POST["titleName"],
                "departmentId" => $_POST["departmentId"],
                "status" => 1
            ])
            ->andWhere("titleId!=" . $_POST['titleId'])
            ->one();
        if (isset($title) && !empty($title)) {
            $res["status"] = false;
            $res["errorText"] = 'Existing Title name "' . $_POST["titleName"] . '"';
        } else {
            $res["status"] = true;
        }
        return json_encode($res);
    }
    public function actionSaveCreateTitle()
    {
        // throw new exception(print_r($_POST, true));

        $title = new Title();
        $title->titleName = $_POST["titleName"];
        // $title->layerId = $_POST["layer"];
        $title->departmentId = $_POST["departmentId"];
        $title->jobDescription = $_POST["jobDescription"];
        $title->purpose = $_POST["purpose"];
        $title->keyResponsibility = $_POST["keyResponsibility"];
        // $title->shortTag = $_POST["shortTag"];
        $title->status = 1;
        $title->createDateTime = new Expression('NOW()');
        $title->updateDateTime = new Expression('NOW()');
        // if (isset($_POST["tags"]) && count($_POST["tags"]) > 0) {
        //     $tags = '';
        //     foreach ($_POST["tags"] as $tag) :
        //         $tags .= $tag . ',';
        //     endforeach;
        //     if ($tags != '') {
        //         $tags = substr($tags, 0, -1);
        //         $title->requireSkill = $tags;
        //     }
        // }
        if ($title->save(false)) {
            // $titleId = Yii::$app->db->lastInsertID;
            // $departmentTitle = new DepartmentTitle();
            // $departmentTitle->titleId = $titleId;
            // $departmentTitle->departmentId = $_POST["departmentId"];
            // $departmentTitle->status = 1;
            // $departmentTitle->createDateTime = new Expression('NOW()');
            // $departmentTitle->updateDateTime = new Expression('NOW()');
            // $departmentTitle->save(false);
            // $api = curl_init();
            // curl_setopt($api, CURLOPT_SSL_VERIFYPEER, false);
            // curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
            // curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/department-detail?id=' . $_POST["departmentId"]);
            // $department = curl_exec($api);
            // $department = json_decode($department, true);
            // curl_close($api);
            // $res["status"] = true;
            // $res["newTitle"] = $this->renderAjax('new_title', [
            //     "titleName" => $_POST["titleName"],
            //     "layerName" => Layer::layerName($_POST['layer']),
            //     "tShort" => Title::shortName($titleId),
            //     "lShort" => Layer::shortName($_POST['layer']),
            //     "titleId" => $titleId,
            //     "branchName" => Branch::branchName($department["branchId"]),
            //     "departmentName" => Department::departmentNAme($_POST["departmentId"])
            // ]);
        }

        return $this->redirect(Yii::$app->homeUrl . 'setting/title/index');
    }

    public function actionSaveTitle()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if (isset($_POST["titleName"], $_POST["departmentId"])) {
            $titleName = $_POST["titleName"];
            $departmentId = $_POST["departmentId"];

            // ตรวจสอบชื่อซ้ำภายใน department เดียวกัน
            $duplicate = Title::find()
                ->where([
                    'titleName' => $titleName,
                    'departmentId' => $departmentId,
                    'status' => 1
                ])
                ->one();

            if ($duplicate) {
                return [
                    'success' => false,
                    'message' => 'Title name "' . $titleName . '" already exists in this department'
                ];
            }

            // สร้าง Title ใหม่
            $newTitle = new Title();
            $newTitle->titleName = $titleName;
            $newTitle->departmentId = $departmentId;
            $newTitle->status = 1;
            $newTitle->createDateTime = new \yii\db\Expression('NOW()');
            $newTitle->updateDateTime = new \yii\db\Expression('NOW()');

            if ($newTitle->save(false)) {
                // ดึงข้อมูล titles ล่าสุดกลับมา
                $api = curl_init();
                curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
                curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/title/title-department?departmentId=' . $departmentId . '&page=1&limit=0');
                $titles = curl_exec($api);
                $titles = json_decode($titles, true);
                curl_close($api);

                return [
                    'success' => true,
                    'titles' => $titles
                ];
            } else {
                return [
                    'success' => false,
                    'errors' => $newTitle->getErrors()
                ];
            }
        }

        return ['success' => false, 'message' => 'Missing titleName or departmentId'];

    }


    public function actionUpdateTitle()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            if (isset( $_POST["titleName"], $_POST["titleId"])) {
                $titleName = $_POST["titleName"];
                $titleId = $_POST["titleId"];
                // throw new Exception(json_encode($_POST));

                $title = Title::find()->where(['titleId' => $titleId, 'status' => 1])->one();

                if (!$title) {
                    return ['success' => false, 'message' => 'title not found'];
                }

                // เช็กชื่อซ้ำ (ยกเว้นทีมตัวเอง)
                $duplicate = Title::find()
                    ->where(['titleName' => $titleName, 'status' => '1'])
                    ->andWhere(['<>', 'titleId', $titleId])
                    ->one();

                if ($duplicate) {
                    return ['success' => false, 'message' => 'Title name "' . $titleName . '" already exists in this department'];
                }

                // อัปเดตข้อมูล
                $title->titleName = $titleName;
                $title->updateDateTime = new \yii\db\Expression('NOW()');
                $departmentId = $title->departmentId;

                if ($title->save(false)) {
                    // ดึงข้อมูล titles ล่าสุดกลับมา
                    $api = curl_init();
                    curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
                    curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/title/title-department?departmentId=' .  $departmentId . '&page=1' . '&limit=0');
                    $titles = curl_exec($api);
                    $titles = json_decode($titles, true);
                    curl_close($api);

                    return [
                        'success' => true,
                        'titles' => $titles
                    ];
                } else {
                    return ['success' => false, 'errors' => $title->getErrors()];
                }
            }

            return ['success' => false, 'message' => 'Missing titleId, departmentId, or titleName'];
            
        // $param = ModelMaster::decodeParams($hash);
        // $titleId = $param["titleId"];
        // $groupId = Group::currentGroupId();
        // if ($groupId == '') {
        //     return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group/');
        // }

        // $titleId = $param["titleId"];
        // $api = curl_init();
        // curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
        // curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/title/title-detail?id=' . $titleId);
        // $title = curl_exec($api);
        // $title = json_decode($title, true);

        // curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/department-detail?id=' . $title["departmentId"]);
        // $department = curl_exec($api);
        // $department = json_decode($department, true);

        // $departments = Department::find()
        //     ->select('departmentId,departmentName')
        //     ->where(["branchId" => $department["branchId"]])
        //     ->andWhere("departmentId!=" . $department['departmentId'])
        //     ->asArray()
        //     ->orderBy("departmentName")
        //     ->all();

        // curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/branch-detail?id=' . $department["branchId"]);
        // $branch = curl_exec($api);
        // $branch = json_decode($branch, true);

        // $branches = Branch::find()
        //     ->where(["status" => 1, "companyId" => $branch["companyId"]])
        //     ->andWhere("branchId!=" . $branch['branchId'])
        //     ->asArray()
        //     ->orderBy("branchName")
        //     ->all();


        // curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/company-detail?id=' . $branch["companyId"]);
        // $company = curl_exec($api);
        // $company = json_decode($company, true);

        // curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
        // $companies = curl_exec($api);
        // $companies = json_decode($companies, true);

        // curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/layer/all-layer');
        // $layer = curl_exec($api);
        // $layer = json_decode($layer, true);

        // curl_close($api);
        // $skillArr = [];
        // if ($title["requireSkill"] != '') {
        //     $skillArr = explode(',', $title["requireSkill"]);
        // }
        // return $this->render('update', [
        //     "departments" => $departments,
        //     "branches" => $branches,
        //     "companies" => $companies,
        //     "departmentId" => $title["departmentId"],
        //     "branchId" => $department["branchId"],
        //     "companyId" => $branch["companyId"],
        //     "layer" => $layer,
        //     "title" => $title,
        //     "skillArr" => $skillArr,
        //     "preUrl" => Yii::$app->request->referrer
        // ]);
    }
    public function actionSaveUpdateTitle()
    {
        $titleId = $_POST["titleId"];
        $title = Title::find()->where(["titleId" => $titleId])->one();
        // throw new Exception(json_encode($_POST));

        /* $oldDepartmentId = $title->departmentId;
        if ($oldDepartmentId != $_POST["departmentId"]) {
            DepartmentTitle::deleteAll(["titleId" => $titleId, "departmentId" => $oldDepartmentId]);
            $departmentTitle = new DepartmentTitle();
            $departmentTitle->titleId = $titleId;
            $departmentTitle->departmentId = $_POST["departmentId"];
            $departmentTitle->status = 1;
            $departmentTitle->createDateTime = new Expression('NOW()');
            $departmentTitle->updateDateTime = new Expression('NOW()');
            $departmentTitle->save(false);
        }*/
        $title->titleName = $_POST["titleName"];
        // $title->layerId = $_POST["layer"];
        // $title->shortTag = $_POST["shortTag"];
        // $title->departmentId = $_POST["departmentId"];
        $title->jobDescription = $_POST["jobDescription"];
        $title->purpose = $_POST["purpose"];
        $title->keyResponsibility = $_POST["keyResponsibility"];
        $title->status = 1;
        $title->updateDateTime = new Expression('NOW()');
        // if (isset($_POST["tags"]) && count($_POST["tags"]) > 0) {
        //     $tags = '';
        //     foreach ($_POST["tags"] as $tag) :
        //         $tags .= $tag . ',';
        //     endforeach;
        //     if ($tags != '') {
        //         $tags = substr($tags, 0, -1);
        //         $title->requireSkill = $tags;
        //     } else {
        //         $title->requireSkill = null;
        //     }
        // } else {
        //     $title->requireSkill = null;
        // }
        $title->save(false);

        return $this->redirect($_POST["preUrl"]);
    }
    public function actionTitleDetail($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/title/title-detail?id=' . $param["titleId"]);
        $title = curl_exec($api);
        $title = json_decode($title, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/department-detail?id=' . $title["departmentId"]);
        $department = curl_exec($api);
        $department = json_decode($department, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/branch-detail?id=' . $department["branchId"]);
        $branch = curl_exec($api);
        $branch = json_decode($branch, true);

        $flag = Branch::branchFlag($department['branchId']);

        curl_close($api);

        $skillArr = [];
        if ($title["requireSkill"] != '') {
            $skillArr = explode(',', $title["requireSkill"]);
        }
        return $this->render('view', [
            "title" => $title,
            "departmentId" => $title["departmentId"],
            "branchId" => $department["branchId"],
            "companyId" => $branch["companyId"],
            "flag" => $flag,
            "skillArr" => $skillArr,
            "preUrl" => Yii::$app->request->referrer
        ]);
    }
    public function actionGetTitleDetail()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $request = Yii::$app->request;
        $body = json_decode($request->getRawBody(), true);
        $titleId = $body['titleId'] ?? null;
		$paramId =  ModelMaster::encodeParams(['departmentId' => '', 'titleId' => $titleId]);

        if (!$titleId) {
            return ['error' => 'Missing titleId'];
        }

        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/title/title-detail?id=' . $titleId);
        $titleResponse = curl_exec($api);
        curl_close($api);

        $title = json_decode($titleResponse, true);
            return [
                'titleName' => $title['titleName'] ?? '',
                'purpose' => $title['purpose'] ?? '',
                'jobDescription' => $title['jobDescription'] ?? '',
                'keyResponsibility' => $title['keyResponsibility'] ?? '',
                'paramId' => $paramId ?? '',
            ];
        // if (isset($title['data'])) {
        //     return [
        //         'titleName' => $title['data']['titleName'] ?? '',
        //         'purpose' => $title['data']['purpose'] ?? '',
        //         'jobDescription' => $title['data']['jobDescription'] ?? '',
        //         'keyResponsibility' => $title['data']['keyResponsibility'] ?? '',
        //     ];
        // } else {
        //     return ['error' => 'Title not found or API error'];
        // }
    }


    public function actionModalTitle($hash)
    {
        $param = ModelMaster::decodeParams($hash);

        $departmentId = $param["departmentId"];
        $titleId = $param["titleId"] ?? 0;
        $countTeam = 0;
        $role = UserRole::userRight();
        $data =[];
        $api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        // api
        

        //ข้อมูลทีมdeparmentเป็นหลัก
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/team/index-filter?departmentId=' . $departmentId . '&&branchId=0' . '&&companyId=0' .   '&&page=1'  . '&limit=0');
        $departments = curl_exec($api);
        $departments = json_decode($departments, true);

        //หลุปดาต้า
        if (isset($departments) && count($departments) > 0) {
            foreach ($departments as $row) :
                $departmentsId = $row['departmentId'];
                //ข้อมูลทีมteamรอง
                // curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/team/department-team?id=' .  $departmentsId . '&page=1' . '&limit=0');
                // $teams = curl_exec($api);
                // $teams = json_decode($teams, true);
                curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/title/title-department?departmentId=' .  $departmentsId . '&page=1' . '&limit=0');
                $titles = curl_exec($api);
                $titles = json_decode($titles, true);

                // throw new Exception("teams: " . print_r($teams, true));

            if (!isset($data[$departmentsId])) {
                // ตั้งค่าข้อมูล branch ครั้งแรก
                $data = [
                    'departmentId' => $row['departmentId'],
                    'departmentName' => $row['departmentName'],
                    'branchId' => $row['branchId'],
                    'branchName' => $row['branchName'],
                    'companyId' => $row['companyId'],
                    'companyName' => $row['companyName'],
                    'picture' => $row['picture'],
                    'city' => $row['city'],
                    'countryId' => $row['countryId'],
                    'countryName' => $row['countryName'],
                    'flag' => $row['flag'],
                    'titles' => $titles
                ];
            }
            $countTitle = count($titles);
            endforeach;
        }


        curl_close($api);
        
        // throw new Exception("department: " . print_r($data['titles'], true));
        return $this->renderPartial('modal_title', [
            "title" => $data,
            "role" => $role,
            "countTitle" => $countTitle,
            "titleId" => $titleId,
            "nextPage" => 1
        ]); 

        // return $this->renderPartial('modal_team');
    }
    public function actionModalDelete(){
        $titleId = Yii::$app->request->get("titleId");
        // throw new exception(print_r($teamId, true));

        return $this -> renderPartial('modal_delete', [
            "titleId" => $titleId
        ]);
    }  
    
    public function actionDeleteTitle()
    {
        // $titleId = $_POST["titleId"];
        // $title = Title::find()->where(["titleId" => $titleId])->one();
        // $title->status = 99;
        // $res["status"] = false;
        // if ($title->save(false)) {
        //     $res["status"] = true;
        // }
        // if ($_POST["redirect"] == 1) {
        //     // return $this->redirect($_POST["preUrl"]);
        //     return $this->redirect(Yii::$app->homeUrl . 'setting/title/index');
        // }
        // return json_encode($res);
         Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; // ← สำคัญ!

        if (isset($_POST["titleId"])) {
            $titleId = $_POST["titleId"];

            $update = Title::find()->where([
                "titleId" => $titleId,
                "status" => '1'
            ])->one();

            if ($update) {
                $update->status = '99';
                $update->updateDateTime = new Expression('NOW()');

                if ($update->save(false)) {
                    $departmentId = $update->departmentId;
                    $api = curl_init();
                    curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
                    curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/title/title-department?departmentId=' .  $departmentId . '&page=1' . '&limit=0');
                    $titles = curl_exec($api);
                    $titles = json_decode($titles, true);
                    curl_close($api);

                    if($_POST["preUrl"]){
                                return $this->redirect($_POST["preUrl"]);
                    }else{
                        return [
                            'success' => true,
                            'departments' => $titles
                        ];
                    }

                   
                } else {
                    $errorText = [];
                    foreach ($update->getErrors() as $field => $errors) {
                        $errorText[] = implode(', ', $errors);
                    }
                    return ['success' => false, 'message' => implode("\n", $errorText)];
                }
            } else {
                return ['success' => false, 'message' => 'Title not found' . $update ];
            }
        }
        return ['success' => false, 'message' => 'Missing required POST parameters'];
    }

    public function actionUploadImage()
    {
        if (isset($_FILES['upload']['name'])) {
            $path = Path::urlUpload() . 'images/upload/title/';
            $url = Yii::$app->homeUrl . 'images/upload/title/';
            $imagePath = $path . time() . "_" . $_FILES['upload']['name']; // กำหนดชื่อไฟล์
            $imageUrl = $url . time() . "_" . $_FILES['upload']['name']; // กำหนดชื่อไฟล์
            if (($_FILES['upload'] == "none") or (empty($_FILES['upload']['name']))) { // ตรวจสอบว่ามีข้อมูลถูกส่งมาหรือป่าว
                $error = "No file uploaded.";
            } else {
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                if (!move_uploaded_file($_FILES['upload']['tmp_name'], $imagePath)) {
                    $error = "Granted Read/Write/Modify permissions.";  // ตรวจสอบว่าโฟลเด้อที่จะบันทึกรูปสามารถเขียนได้หรือป่าว
                } else {
                    $error = null;
                }
            }
            if (isset($_GET["type"])) {
                $res = [
                    'uploaded' => '1',
                    'url' => $imageUrl
                ];
                return json_encode($res);
            } else {
                $callBack = $_GET['CKEditorFuncNum']; // ใช้งาน javascript callback function
                echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($callBack, '$imageUrl', '$error');</script>";
            }
        }
    }
    public function actionFilterTitle()
    {
        $departmentId = $_POST["departmentId"];
        $branchId = $_POST["branchId"];
        $companyId = $_POST["companyId"];
        if ($departmentId == "" && $branchId == "" && $companyId == "") {
            return $this->redirect(Yii::$app->homeUrl . 'setting/title/index');
        } else {
            return $this->redirect(Yii::$app->homeUrl . 'setting/title/search-result/' . ModelMaster::encodeParams([
                "departmentId" => $departmentId,
                "branchId" => $branchId,
                "companyId" => $companyId
            ]));
        }
    }
    public function actionSearchResult($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $departmentId = $param["departmentId"] == "" ? null : $param["departmentId"];
        $branchId = $param["branchId"] == "" ? null : $param["branchId"];
        $companyId = $param["companyId"] == "" ? null : $param["companyId"];
        $group = Group::find()->select('groupId')->where(["status" => 1])->asArray()->one();
        if (!isset($group) && !empty($group)) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group/');
        }
        $groupId = $group["groupId"];
        $departments = [];
        $branches = [];

        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/company-branch?id=' . $companyId);
        $branches = curl_exec($api);
        $branches = json_decode($branches, true);

        if ($branchId != null) {
            curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/branch-department?id=' . $branchId);
            $departments = curl_exec($api);
            $departments = json_decode($departments, true);
        }


        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
        $companies = curl_exec($api);
        $companies = json_decode($companies, true);


        curl_close($api);

        $title = Title::find()
            ->select('title.titleId,title.titleName,title.layerId,title.jobDescription,l.layerName,l.shortTag as lShort,
			title.shortTag as tShort,d.departmentName,title.departmentId,b.branchName,b.branchId')
            ->JOIN("LEFT JOIN", "department d", "d.departmentId=title.departmentId")
            ->JOIN("LEFT JOIN", "layer l", "l.layerId=title.layerId")
            ->JOIN("LEFT JOIN", "branch b", "b.branchId=d.branchId")
            ->JOIN("LEFT JOIN", "company c", "c.companyId=b.companyId")
            ->where(["title.status" => 1])
            ->andFilterWhere([
                "title.departmentId" => $departmentId,
                "d.branchId" => $branchId,
                "b.companyId" => $companyId
            ])
            ->asArray()
            ->orderBy("title.titleName")
            ->all();


        return $this->render('index', [
            "title" => $title,
            "companies" => $companies,
            "departments" => $departments,
            "branches" => $branches,
            "departmentId" => $departmentId,
            "branchId" => $branchId,
            "companyId" => $companyId
        ]);
    }
    
    // public function actionImport()
    // {
    //     $error = [];
    //     $isError = 0;
    //     $correct = [];
    //     $success = 0;
    //     $totalError = 0;
    //     //throw new Exception(print_r(Yii::$app->request->post(), true));
    //     // if (isset($_POST["employeeFile"])) {

    //     $imageObj = UploadedFile::getInstanceByName("titleFile");
    //     if (isset($imageObj) && !empty($imageObj)) {
    //         $urlFolder = Path::getHost() . 'file/import/title';
    //         if (!file_exists($urlFolder)) {
    //             mkdir($urlFolder, 0777, true);
    //         }
    //         $file = $imageObj->name;
    //         $filenameArray = explode('.', $file);
    //         $countArrayFile = count($filenameArray);
    //         $fileType = $filenameArray[$countArrayFile - 1];
    //         if ($fileType == 'xlsx' || $fileType == 'xls') {

    //             $fileName = Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[$countArrayFile - 1];
    //             $pathSave = $urlFolder . '/' . $fileName;
    //             if ($imageObj->saveAs($pathSave)) {

    //                 $reader = new Xlsx();
    //                 $spreadsheet = $reader->load($pathSave);
    //                 $sheetData = $spreadsheet->getActiveSheet()->toArray();
    //                 // unset($sheetData[0]);
    //                 $i = 0;
    //                 $transaction = Yii::$app->db->beginTransaction();
    //                 foreach ($sheetData as $data) :
    //                     $layerId = '';
    //                     $departmentId = '';
    //                     $isError = 0;
    //                     $error[$i] = "";
    //                     if ($i >= 1) {

    //                         // throw new exception('2222');
    //                         if (trim($data[0]) == "") {
    //                             $isError = 1;
    //                             $error[$i] .= '- Title name<br>';
    //                         }
    //                         if (trim($data[1]) == "") {
    //                             $isError = 1;
    //                             $error[$i] .= '- Please select layer <br>';
    //                         } else {
    //                             $layerId = Layer::layerId($data[1]);
    //                             if ($layerId == "") {
    //                                 $isError = 1;
    //                                 $error[$i] .= '- Layer not found, need to contact administrator<br>';
    //                             }
    //                         }
    //                         if (trim($data[2]) == "") {
    //                             $isError = 1;
    //                             $error[$i] .= '- Please select department<br>';
    //                         } else {
    //                             $departmentId = Department::branchNameWithDepartmentName($data[2]);
    //                             if ($departmentId == "") {
    //                                 $isError = 1;
    //                                 $error[$i] .= '- Department not found, need to contact administrator<br>';
    //                             }
    //                         }
    //                         if ($isError == 0) {
    //                             $title = new Title();
    //                             $title->titleName = $data[0];
    //                             $title->layerId = $layerId;
    //                             $title->departmentId =  $departmentId;
    //                             $title->jobDescription = $data[3];
    //                             $title->status = 1;
    //                             $title->createDateTime = new Expression('NOW()');
    //                             $title->updateDateTime = new Expression('NOW()');
    //                             if ($title->save(false)) {
    //                                 $success++;
    //                                 $correct[$i] = [
    //                                     "name" => $data[0],
    //                                     "department" => $data[2],
    //                                 ];
    //                             }
    //                         }
    //                     }
    //                     if ($isError == 0) {
    //                         $totalError++;
    //                         unset($error[$i]); // if there is no error delete this index
    //                     }
    //                     $i++;
    //                 endforeach;
    //                 if (count($error) == 0) {
    //                     $transaction->commit();
    //                 } else {
    //                     $transaction->rollBack();
    //                 }
    //             }
    //         } else {
    //             $error[0] = "Please select .xlsx or .xls file";
    //         }

    //         unlink($pathSave);
    //     }
    //     return $this->render('import', [
    //         "errors" => $error,
    //         "success" => $success,
    //         "corrects" => $correct
    //     ]);
    // }
    // public function actionExport()
    // {
    //     $layers = Layer::find()
    //         ->select('layerName')
    //         ->where(["status" => 1])
    //         ->asArray()
    //         ->groupBy('layerName')
    //         ->orderBy('layerName')
    //         ->all();
    //     $departments = Department::find()
    //         ->select('departmentName,branchId')
    //         ->where(["status" => 1])
    //         ->asArray()
    //         ->orderBy('departmentName')
    //         ->all();
    //     $de = [];
    //     if (isset($departments) && count($departments) > 0) {
    //         $i = 0;
    //         foreach ($departments as $d) :
    //             $de[$i] = $d["departmentName"] . "(Branch::" . Branch::branchName($d["branchId"]) . ")";
    //             $i++;
    //         endforeach;
    //     }

    //     $htmlExcel = $this->renderPartial('export', [
    //         "layers" => $layers,
    //         "departments" => $de,

    //     ]);
    //     //throw new exception($htmlExcel);
    //     $urlFolder = Path::getHost() . 'file/import/title/';
    //     $fileName = 'title.xlsx';
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
    //     $clonedWorksheet = clone $spreadsheet1->getSheetByName('title');
    //     $clonedWorksheet->setTitle('title');
    //     $spreadsheet->addExternalSheet($clonedWorksheet);

    //     $fileName = 'Import Title format' . date('Y-m-d');

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
}