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
use frontend\components\Api;

/**
 * Default controller for the `setting` module
 */
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
        $role = UserRole::userRight();
		if($role <= 3 ){
			return  $this->redirect(Yii::$app->request->referrer);
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
	
        $companyId = Yii::$app->request->post('companyId');
        $branchId = Yii::$app->request->post('branchId');
        $departmentId = Yii::$app->request->post('departmentId');
        
        $page = Yii::$app->request->post('page');
		$nextPage = Yii::$app->request->post('nextPage');

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

        $group = Group::find()->select('groupId')->where(["status" => 1])->asArray()->one();
        if (!isset($group) && empty($group)) {
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
        if (!isset($department) && empty($department)) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/department/no-department/'. ModelMaster::encodeParams(["companyId" => '']));
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

        $company     = Api::connectApi(Path::Api() . 'masterdata/company/all-company');
        $branch      = Api::connectApi(Path::Api() . 'masterdata/branch/active-branch?page=1&limit=0');
        $department  = Api::connectApi(Path::Api() . 'masterdata/department/active-department?page=1&limit=0');
        $departments = Api::connectApi(Path::Api() . 'masterdata/team/index?id=&page=1&limit=6');
        $numPage     = Api::connectApi(Path::Api() . 'masterdata/department/department-page-filter?departmentId=&branchId=&companyId=&page=1&limit=6');

        $data = [];
        if (!empty($departments)) {
            foreach ($departments as $row) {
                $departmentId = $row['departmentId'];

                // ดึง title ของ department นั้น
                $titles = Api::connectApi(
                    Path::Api() . 'masterdata/title/title-department?departmentId=' . $departmentId . '&page=1&limit=0'
                );

                if (!isset($data[$departmentId])) {
                    $data[$departmentId] = [
                        'departmentId'   => $row['departmentId'],
                        'departmentName' => $row['departmentName'],
                        'branchId'       => $row['branchId'],
                        'branchName'     => $row['branchName'],
                        'companyId'      => $row['companyId'],
                        'companyName'    => $row['companyName'],
                        "picture"        => !empty($row["picture"]) ? $row["picture"] : "image/no-company.svg",
                        'city'           => $row['city'],
                        'countryId'      => $row['countryId'],
                        'countryName'    => $row['countryName'],
                        "flag"           => !empty($row["flag"]) ? $row["flag"] : "image/e-world.svg",
                        'titles'         => $titles
                    ];
                }
            }
        }

        return $this->render('index', [
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
        $data =[];

        $group = Group::find()->select('groupId')->where(["status" => 1])->asArray()->one();
        if (!isset($group) && !empty($group)) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group/');
        }
        $groupId = $group["groupId"];

        $company = Api::connectApi(Path::Api() . 'masterdata/company/all-company');

        $branch = Api::connectApi(
            Path::Api() . 'masterdata/branch/active-branch?page=' . $nextPage . '&limit=0'
        );

        $department = Api::connectApi(
            Path::Api() . 'masterdata/department/active-department?page=' . $nextPage . '&limit=0'
        );

        $departments = Api::connectApi(
            Path::Api() . 'masterdata/team/index-filter?departmentId=' . $departmentId .
            '&branchId=' . $branchId .
            '&companyId=' . $companyId .
            '&page=' . $nextPage . '&limit=6'
        );

        $numPage = Api::connectApi(
            Path::Api() . 'masterdata/department/department-page-filter?departmentId=' . $departmentId .
            '&branchId=' . $branchId .
            '&companyId=' . $companyId .
            '&page=' . $nextPage . '&limit=6'
        );

        //หลุปดาต้า
        if (isset($departments) && count($departments) > 0) {
            foreach ($departments as $row) :
                $departmenstId = $row['departmentId'];

                //ข้อมูลทีมteamรอง
                $titles = Api::connectApi(
                    Path::Api() . 'masterdata/title/title-department?departmentId=' . $departmenstId .
                    '&page=1&limit=0'
                );

            if (!isset($data[$departmenstId])) {
                // ตั้งค่าข้อมูล branch ครั้งแรก
                $data[$departmenstId] = [
                    'departmentId' => $row['departmentId'],
                    'departmentName' => $row['departmentName'],
                    'branchId' => $row['branchId'],
                    'branchName' => $row['branchName'],
                    'companyId' => $row['companyId'],
                    'companyName' => $row['companyName'],
                    "picture" => !empty($row["picture"]) ? $row["picture"] : "image/no-company.svg",
                    'city' => $row['city'],
                    'countryId' => $row['countryId'],
                    'countryName' => $row['countryName'],
                    "flag" => !empty($row["flag"]) ? $row["flag"] : "image/e-world.svg",
                    'titles' => $titles
                ];
            }

            endforeach;
        }

        return $this->render('index', [
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

        $countTitle = 0;
        $role = UserRole::userRight();
        $data =[];
        // ข้อมูลทีม department เป็นหลัก
        $department = Api::connectApi(
            Path::Api() . 'masterdata/department/department-detail?id=' . $departmentId
        );

        $branch = Api::connectApi(
            Path::Api() . 'masterdata/branch/branch-detail?id=' . $department['branchId']
        );

        $company = Api::connectApi(
            Path::Api() . 'masterdata/company/company-detail?id=' . $branch['companyId']
        );

        $country = Api::connectApi(
            Path::Api() . 'masterdata/country/country-detail?id=' . $company['countryId']
        );

        $numPage = Api::connectApi(
            Path::Api() . 'masterdata/title/title-page?id=' . $departmentId . '&page=' . $nextPage . '&limit=5'
        );

        $titles = Api::connectApi(
            Path::Api() . 'masterdata/title/title-department-filter?departmentId=' . $departmentId . '&page=' . $nextPage . '&limit=5'
        );

        //หลุปดาต้า
        $dataTitle = [];
		if (!empty($titles)) {
            foreach ($titles as $title) :

				$employees = Employee::find()
				->where(["titleId" => $title['titleId']])
				->asArray()
				->all();

				// กรองเฉพาะที่มี picture
				$filteredEmployees = array_filter($employees, function($employee) {
					return !empty($employee['picture']);
				});

				// รีเซ็ต index และเลือกแค่ 3 คนแรก
				$filteredEmployees = array_slice(array_values($filteredEmployees), 0, 3);
				$totalEmployee = Employee::find()->where(["titleId" => $title['titleId'], "status" => 1])->count();

				$dataTitle[] = [
                    "titleId" => $title['titleId'],
                    "titleName" => $title['titleName'],
					"totalEmployee" => $totalEmployee,
					"employees" => $filteredEmployees
				];
                $countTitle++;
			endforeach;
		}

        $data = [
                    "departmentId" => $department['departmentId'],
                    "departmentName" => $department["departmentName"],
                    "branchId" => $branch['branchId'],
                    "branchName" => $branch['branchName'],  
                    "description" => $branch['description'],
                    "companyId" => $company['companyId'],
                    "companyName" => $company['companyName'],
                    "picture" => !empty($company["picture"]) ? $company["picture"] : "image/no-company.svg",
                    "city" => $company['city'],
                    "countryId" => $company['countryId'],
                    "countryName" => $country['countryName'],
                    "flag" => !empty($country["flag"]) ? $country["flag"] : "image/e-world.svg",
				];
        
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
        $groupId = Group::currentGroupId();        
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

        if (!empty($titleId)) {
            $title = Api::connectApi(Path::Api() . 'masterdata/title/title-detail?id=' . $titleId);
            $typePage = 'Edit';
            $departmentId = $title["departmentId"];
        }

        if (!empty($departmentId)) {
            $departmentes = Api::connectApi(Path::Api() . 'masterdata/department/department-detail?id=' . $departmentId);
            $departmentName = $departmentes["departmentName"];
            $branchId = $departmentes["branchId"];
        }

        if (!empty($branchId)) {
            $branches = Api::connectApi(Path::Api() . 'masterdata/branch/branch-detail?id=' . $branchId);
            $branchName = $branches["branchName"];
            $companyId = $branches["companyId"];
        }

        if (!empty($companyId)) {
            $companies = Api::connectApi(Path::Api() . 'masterdata/company/company-detail?id=' . $companyId);
            $companyName = $companies["companyName"];
        } else {
            $companies = Api::connectApi(Path::Api() . 'masterdata/company/all-company');
        }

        $group = Api::connectApi(Path::Api() . 'masterdata/group/group-detail?id=' . $groupId);
        
        return $this->render('create', [
            "group" => $group,
            "departmentId" => $departmentId,
            "branchId" => $branchId,
            "companyId" => $companyId,
            "companyName" => $companyName,
            "branchName" => $branchName,
            "departmentName" => $departmentName,
            "companies" => $companies,
            "title" => $title,
            "typePage" => $typePage
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
        $title = new Title();
        $title->titleName = $_POST["titleName"];
        $title->departmentId = $_POST["departmentId"];
        $title->jobDescription = $_POST["jobDescription"];
        $title->purpose = $_POST["purpose"];
        $title->keyResponsibility = $_POST["keyResponsibility"];
        $title->status = 1;
        $title->createDateTime = new Expression('NOW()');
        $title->updateDateTime = new Expression('NOW()');
        if ($title->save(false)) {
            $titleId = Yii::$app->db->lastInsertID;
        }

        return $this->redirect(Yii::$app->homeUrl . 'setting/title/titles-view/' . ModelMaster::encodeParams(['departmentId' =>  $_POST["departmentId"]]));
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
                $titles = Api::connectApi(
                    Path::Api() . 'masterdata/title/title-department?departmentId=' . $departmentId . '&page=1&limit=0'
                );

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
                    $titles = Api::connectApi(
                        Path::Api() . 'masterdata/title/title-department?departmentId=' . $departmentId . '&page=1&limit=0'
                    );

                    return [
                        'success' => true,
                        'titles' => $titles
                    ];
                } else {
                    return ['success' => false, 'errors' => $title->getErrors()];
                }
            }

            return ['success' => false, 'message' => 'Missing titleId, departmentId, or titleName'];
            
    }
    public function actionSaveUpdateTitle()
    {
        $titleId = $_POST["titleId"];
        $title = Title::find()->where(["titleId" => $titleId])->one();

        $title->titleName = $_POST["titleName"];
        $title->jobDescription = $_POST["jobDescription"];
        $title->purpose = $_POST["purpose"];
        $title->keyResponsibility = $_POST["keyResponsibility"];
        $title->status = 1;
        $title->updateDateTime = new Expression('NOW()');
        $title->save(false);

        return $this->redirect($_POST["preUrl"]);
    }
    public function actionTitleDetail($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $title = Api::connectApi(Path::Api() . 'masterdata/title/title-detail?id=' . $param["titleId"]);

        $department = Api::connectApi(Path::Api() . 'masterdata/department/department-detail?id=' . $title["departmentId"]);

        $branch = Api::connectApi(Path::Api() . 'masterdata/branch/branch-detail?id=' . $department["branchId"]);

        $flag = Branch::branchFlag($department['branchId']);

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

        $paramId = ModelMaster::encodeParams([
            'departmentId' => '',
            'titleId' => $titleId
        ]);

        if (!$titleId) {
            return ['error' => 'Missing titleId'];
        }

        $title = Api::connectApi(Path::Api() . 'masterdata/title/title-detail?id=' . $titleId);

        // ไม่ต้อง json_decode อีก เพราะ $title เป็น array แล้ว
        return [
            'titleName' => $title['titleName'] ?? '',
            'purpose' => $title['purpose'] ?? '',
            'jobDescription' => $title['jobDescription'] ?? '',
            'keyResponsibility' => $title['keyResponsibility'] ?? '',
            'paramId' => $paramId ?? '',
        ];
    }
    public function actionModalTitle($hash)
    {
        $param = ModelMaster::decodeParams($hash);

        $departmentId = $param["departmentId"];
        $titleId = $param["titleId"] ?? 0;
        $countTeam = 0;
        $role = UserRole::userRight();
        $data =[];
        $departments = Api::connectApi(
            Path::Api() . 'masterdata/team/index-filter?departmentId=' . $departmentId . '&branchId=0&companyId=0&page=1&limit=0'
        );

        $data = [];

        if (!empty($departments) && count($departments) > 0) {
            foreach ($departments as $row) {
                $departmentsId = $row['departmentId'];

                // ดึงข้อมูล titles ของแต่ละ department
                $titles = Api::connectApi(
                    Path::Api() . 'masterdata/title/title-department?departmentId=' . $departmentsId . '&page=1&limit=0'
                );

                // เก็บข้อมูลแต่ละ department ลงใน array
                if (!isset($data[$departmentsId])) {
                    $data[$departmentsId] = [
                        'departmentId' => $row['departmentId'],
                        'departmentName' => $row['departmentName'],
                        'branchId' => $row['branchId'],
                        'branchName' => $row['branchName'],
                        'companyId' => $row['companyId'],
                        'companyName' => $row['companyName'],
                        "picture" => !empty($row["picture"]) ? $row["picture"] : "image/no-company.svg",
                        'city' => $row['city'],
                        'countryId' => $row['countryId'],
                        'countryName' => $row['countryName'],
                        "flag" => !empty($row["flag"]) ? $row["flag"] : "image/e-world.svg",
                        'titles' => $titles
                    ];
                }

                $countTitle = count($titles);
            }
        }
        //  return $this->renderPartial('modal_title', [
        //     "departmentId" => $departmentId
        // ]);
        // throw new Exception(json_encode($data));
        
        return $this->renderPartial('modal_title', [
            "title" => $data[$departmentsId], // ส่ง array ของ department โดยตรง
            "role" => $role,
            "countTitle" => $countTitle,
            "titleId" => $titleId,
            "nextPage" => 1
        ]);

    }
    public function actionModalDelete(){
        $titleId = Yii::$app->request->get("titleId");
        $preUrl = Yii::$app->request->get("preUrl");

        return $this -> renderPartial('modal_delete', [
            "titleId" => $titleId,
            "preUrl" =>  $preUrl
        ]);
    }  
    
    public function actionDeleteTitle()
    {
         Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; // ← สำคัญ!

        if (isset($_POST["titleId"])) {
            $titleId = $_POST["titleId"];
            // $titleId = $_POST["preUrl"];

            $update = Title::find()->where([
                "titleId" => $titleId,
                "status" => '1'
            ])->one();

            if ($update) {
                $update->status = '99';
                $update->updateDateTime = new Expression('NOW()');

                if ($update->save(false)) {

                    $departmentId = $update->departmentId;
                    $titles = Api::connectApi(
                        Path::Api() . 'masterdata/title/title-department?departmentId=' . $departmentId . '&page=1&limit=0'
                    );

                    if($_POST["preUrl"]){
                            return [
                            'success' => true,
                            'titles' => $titles,
                            'redirect' => $_POST["preUrl"]
                        ];
                    }else{
                        return [
                            'success' => true,
                            'titles' => $titles
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

        $branches = Api::connectApi(
            Path::Api() . 'masterdata/branch/company-branch?id=' . $companyId
        );

        if ($branchId != null) {
            $departments = Api::connectApi(
                Path::Api() . 'masterdata/department/branch-department?id=' . $branchId
            );
        }

        $companies = Api::connectApi(
            Path::Api() . 'masterdata/group/company-group?id=' . $groupId
        );


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

}