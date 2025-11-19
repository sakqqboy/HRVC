<?php

namespace frontend\modules\setting\controllers;

use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
use frontend\models\hrvc\Branch;
use frontend\models\hrvc\Company;
use frontend\models\hrvc\Department;
use frontend\models\hrvc\Employee;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\Team;
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

class TeamController extends Controller
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
			return $this->redirect(Yii::$app->homeUrl . 'setting/team/index-filter/'. $url );
		}else if($page == 'view') {
            return $this->redirect(Yii::$app->homeUrl . 'setting/team/teams-view/'. $url );
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
			return $this->redirect(Yii::$app->homeUrl . 'setting/team/index-filter/'. $url );
		}else if($page == 'view') {
            return $this->redirect(Yii::$app->homeUrl . 'setting/team/teams-view/'. $url );
        }
	}

	public function actionNoTeam($hash)
	{
        $param = ModelMaster::decodeParams($hash);
        $companyId = $param["companyId"] ?? 0;
        $branchId = $param["branchId"] ?? 0;
        $departmentId = $param["departmentId"] ?? 0;

        $group = Group::find()->select('groupId')->where(["status" => 1])->asArray()->one();
        if (!isset($group) || empty($group)) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/group/display-group/');
        }

        $company = Company::find()->select('companyId')->where(["status" => 1])->asArray()->one();
        if (!isset($company) || empty($company)) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/company/display-company/');
        }

        $branch = Branch::find()->select('branchId')->where(["status" => 1])->asArray()->one();
        if (!isset($branch) || empty($branch)) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/branch/no-branch/'. ModelMaster::encodeParams(["companyId" => '']));
        }

        $department = Department::find()->select('departmentId')->where(["status" => 1])->asArray()->one();
        if (!isset($department) || empty($department)) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/department/no-department/'. ModelMaster::encodeParams(["companyId" => '']));
        }

        $team = Team::find()->select('teamId')->where(["status" => 1])->asArray()->one();
        if (isset($team) && !empty($team)) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/team/index-filter/'. ModelMaster::encodeParams(["companyId" => $companyId,"branchId" => $branchId,"departmentId" => $departmentId]));
        }

        return $this->render('no_team', [
            "departmentId" => $departmentId,
            "group" =>  $group
        ]);
	}
    
    public function actionIndex()
    {
        $role = UserRole::userRight();
        $data =[];
        
        $company     = Api::connectApi(Path::Api() . 'masterdata/company/all-company');
        $branch      = Api::connectApi(Path::Api() . 'masterdata/branch/active-branch?page=1&limit=0');
        $department  = Api::connectApi(Path::Api() . 'masterdata/department/active-department?page=1&limit=0');
        $numPage     = Api::connectApi(Path::Api() . 'masterdata/department/department-page?id=0&page=1&countryId=0&limit=6');

        // ข้อมูลทีม department เป็นหลัก
        $departments = Api::connectApi(Path::Api() . 'masterdata/team/index?id=&page=1&limit=6');

        //หลุปดาต้า
        if (isset($departments) && count($departments) > 0) {
            foreach ($departments as $row) :
                $departmentId = $row['departmentId'];
                //ข้อมูลทีมteamรอง
                $teams = Api::connectApi(Path::Api() . 'masterdata/team/department-team?id=' . $departmentId . '&page=1&limit=0');

            if (!isset($data[$departmentId])) {
                // ตั้งค่าข้อมูล branch ครั้งแรก
                $data[$departmentId] = [
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
                    'teams' => $teams
                ];
            }

            endforeach;
        }

        return $this->render('index',[
            "data" => $data,
            "role" => $role,
            "numPage" => $numPage,
            "companies" => $company,
            "branches" => $branch,
            "departments" => $department,
            "countryId" => 0,
            "companyId" => 0,
            "branchId" => 0,
            "departmentId" => 0,
            "nextPage" => 1
        ]);
    }


    public function actionIndexFilter($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $companyId = !empty($param["companyId"]) ? $param["companyId"] : 0;
        $branchId = !empty($param["branchId"]) ? $param["branchId"] : 0;
        $departmentId = !empty($param["departmentId"]) ? $param["departmentId"] : 0;
        $nextPage = !empty($param["nextPage"]) ? $param["nextPage"] : 0;

        $role = UserRole::userRight();
        $data =[];
        
        $company     = Api::connectApi(Path::Api() . 'masterdata/company/all-company');
        $branch      = Api::connectApi(Path::Api() . 'masterdata/branch/active-branch?page=1&limit=0');
        $department  = Api::connectApi(Path::Api() . 'masterdata/department/active-department?page=1&limit=0');

        $numPage = Api::connectApi(
            Path::Api() . 'masterdata/department/department-page-filter?departmentId=' . $departmentId .
            '&branchId=' . $branchId .
            '&companyId=' . $companyId .
            '&page=' . $nextPage .
            '&limit=6'
        );

        // ข้อมูลทีม department
        $departments = Api::connectApi(
            Path::Api() . 'masterdata/team/index-filter?departmentId=' . $departmentId .
            '&branchId=' . $branchId .
            '&companyId=' . $companyId .
            '&page=' . $nextPage .
            '&limit=6'
        );

        //หลุปดาต้า
        if (isset($departments) && count($departments) > 0) {
            foreach ($departments as $row) :
                $departmentsId = $row['departmentId'];
                //ข้อมูลทีมteamรอง
                $teams = Api::connectApi(
                    Path::Api() . 'masterdata/team/department-team?id=' . $departmentsId . '&page=1&limit=0'
                );

            if (!isset($data[$departmentsId])) {
                // ตั้งค่าข้อมูล branch ครั้งแรก
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
                    'teams' => $teams
                ];
            }

            endforeach;
        }

        return $this->render('index',[
            "data" => $data,
            "role" => $role,
            "numPage" => $numPage,
            "companies" => $company,
            "branches" => $branch,
            "departments" => $department,
            "companyId" => $companyId,
            "branchId" => $branchId,
            "departmentId" => $departmentId,
            "nextPage" => $nextPage
        ]);
    }

    public function actionCreate($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $departmentId = $param["departmentId"]?? null;
        $branchId = $param["branchId"]?? null;
        $companyId = $param["companyId"] ?? null;
        $groupId = Group::currentGroupId();
        $companyName = '';
        $branchName = '';
        $departmentName = '';
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
            "companies" => $companies,
            "companyName" => $companyName,
            "branchName" => $branchName,
            "departmentName" => $departmentName,
            "companyId" => $companyId,
            "branchId" => $branchId,
            "departmentId" => $departmentId,
        ]);
    }

    public function actionModalTeam($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $departmentId = $param["departmentId"];
        $teamId = $param["teamId"] ?? 0;
        $countTeam = 0;
        $role = UserRole::userRight();
        $data =[];

        //ข้อมูลทีมdeparmentเป็นหลัก
        $departments = Api::connectApi(
            Path::Api() . 'masterdata/team/index-filter?departmentId=' . $departmentId . 
            '&branchId=0&companyId=0&page=1&limit=0'
        );

        //หลุปดาต้า
        if (isset($departments) && count($departments) > 0) {
            foreach ($departments as $row) :
                $departmentsId = $row['departmentId'];
                //ข้อมูลทีมteamรอง
                $teams = Api::connectApi(
                    Path::Api() . 'masterdata/team/department-team?id=' . $departmentsId . '&page=1&limit=0'
                );

            if (!isset($data[$departmentsId])) {
                // ตั้งค่าข้อมูล branch ครั้งแรก
                $data = [
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
                    'teams' => $teams
                ];
            }
            $countTeam = count($teams);
            endforeach;
        }
        
        return $this->renderPartial('modal_team', [
            "teams" => $data,
            "role" => $role,
            "countTeam" => $countTeam,
            "teamId" => $teamId,
            "nextPage" => 1
        ]); 

    }
    
    public function actionModalDelete(){
        $teamId = Yii::$app->request->get("teamId");

        return $this -> renderPartial('modal_delete', [
            "teamId" => $teamId
        ]);
    }  
    
    public function actionCompanyBranch()
    {
        $companyId = $_POST["companyId"];
        $branch = Api::connectApi(
            Path::Api() . 'masterdata/branch/company-branch?id=' . $companyId
        );

        $res = [];
        $textSelect = '<option value="">Select Branch</option>';
        if (count($branch) > 0) {
            foreach ($branch as $b) :
                $textSelect .= "<option value='" . $b['branchId'] . "'>" . $b['branchName'] . "</option>";
            endforeach;
        }
        $res["textSelect"] = $textSelect;
        return json_encode($res);
    }
    public function actionBranchDepartment()
    {
        $branchId = $_POST["branchId"];
        $department = Api::connectApi(
            Path::Api() . 'masterdata/department/branch-department?id=' . $branchId
        );

        $res = [];
        $textSelect = '<option value="">Select Department</option>';
        if (count($department) > 0) {
            foreach ($department as $b) :
                $textSelect .= "<option value='" . $b['departmentId'] . "'>" . $b['departmentName'] . "</option>";
            endforeach;
        }
        $res["textSelect"] = $textSelect;
        return json_encode($res);
    }

    public function actionTeamsView($hash){
        
        $param = ModelMaster::decodeParams($hash);

        $companyId = $param["companyId"] ?? 0;
        $branchId = $param["branchId"] ?? 0;
        $departmentId = $param["departmentId"] ?? 0;
        $nextPage = $param["nextPage"] ?? 1;

        $countTeam = 0;
        $role = UserRole::userRight();
        $data =[];
    
        // ข้อมูล department
        $department = Api::connectApi(Path::Api() . 'masterdata/department/department-detail?id=' . $departmentId);

        // ข้อมูล branch
        $branch = Api::connectApi(Path::Api() . 'masterdata/branch/branch-detail?id=' . $department['branchId']);

        // ข้อมูล company
        $company = Api::connectApi(Path::Api() . 'masterdata/company/company-detail?id=' . $branch['companyId']);

        // ข้อมูล country
        $country = Api::connectApi(Path::Api() . 'masterdata/country/country-detail?id=' . $company['countryId']);

        // ข้อมูล pagination ของ team
        $numPage = Api::connectApi(Path::Api() . 'masterdata/team/team-page?id=' . $departmentId . '&page=' . $nextPage . '&limit=5');

        // ข้อมูล team ของ department
        $teams = Api::connectApi(Path::Api() . 'masterdata/team/department-team?id=' . $departmentId . '&page=' . $nextPage . '&limit=5');

        //หลุปดาต้า
        $dataTeam = [];
		if (!empty($teams)) {
            foreach ($teams as $team) :

				$employees = Employee::find()
				->where(["teamId" => $team['teamId']])
				->asArray()
				->all();

				// กรองเฉพาะที่มี picture
				$filteredEmployees = array_filter($employees, function($employee) {
					return !empty($employee['picture']);
				});

				// รีเซ็ต index และเลือกแค่ 3 คนแรก
				$filteredEmployees = array_slice(array_values($filteredEmployees), 0, 3);
				$totalEmployee = Employee::find()->where(["teamId" => $team['teamId'], "status" => 1])->count();
				$dataTeam[] = [
                    "teamId" => $team['teamId'],
                    "teamName" => $team['teamName'],
					"totalEmployee" => $totalEmployee,
					"employees" => $filteredEmployees
				];
                $countTeam++;
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
                    "flag" => !empty($company["flag"]) ? $company["flag"] : "image/e-world.svg",
				];
                
        return $this->render('teams_view', [
            "data" => $data,
            "teams" => $dataTeam,
            "role" => $role,
            "countTeam" => $countTeam,
            "numPage" => $numPage,
            "nextPage" => 1,
            "countryId" => 0
        ]); 
    }
    
    public function actionDepartmentTeam()
    {
        $departmentId = $_POST["departmentId"];
        $team = Api::connectApi(Path::Api() . 'masterdata/team/department-team?id=' . $departmentId);

        $res = [];
        $textSelect = '<option value="">Select Team</option>';
        if (count($team) > 0) {
            foreach ($team as $t) :
                $textSelect .= "<option value='" . $t['teamId'] . "'>" . $t['teamName'] . "</option>";
            endforeach;
        }
        $textSelectTitle = '<option value="">Select Title</option>';
        $titles = Api::connectApi(Path::Api() . 'masterdata/title/title-department?departmentId=' . $departmentId);
        if (count($titles) > 0) {
            foreach ($titles as $title) :
                $textSelectTitle .= "<option value='" . $title['titleId'] . "'>" . $title['titleName'] . "</option>";
            endforeach;
        }

        $res["textSelect"] = $textSelect;
        $res["textSelectTitle"] = $textSelectTitle;
        return json_encode($res);
    }
    public function actionSaveCreateTeam()
    {
        if (isset($_POST["departmentId"]) && isset($_POST["teamName"])) {

            $departmentId = $_POST["departmentId"];
            $names = $_POST["teamName"]; // ควรเป็น array เช่นจาก <input name="teamName[]">

            $errors = [];
            $successCount = 0;

            foreach ($names as $name) {
                $name = trim($name);
                if ($name === '') {
                    continue;
                }
                
                $existing = Team::find()->where([
                    "departmentId" => $departmentId,
                    "teamName" => $name,
                    "status" => 1
                ])->one();

                if (!empty($existing)) {
                    $errors[] = 'Cannot create duplicate team name "' . $name . '"';
                    // continue;
                }

                $team = new Team();
                $team->departmentId = $departmentId;
                $team->teamName = $name;
                $team->status = 1;
                $team->createDateTime = new Expression('NOW()');
                $team->updateDateTime = new Expression('NOW()');
                
                if (!empty($errors)) {
                    Yii::$app->session->setFlash('error', implode('<br>', $errors));
                   
                    return $this->redirect(Yii::$app->request->referrer);
                } else if ($team->save(false)) {
                    $successCount++;
                }
            }

             if ($successCount > 0) {
                Yii::$app->session->setFlash('success', "$successCount team(s) created successfully.");
            }
        
        }
            return $this->redirect(Yii::$app->homeUrl . 'setting/team/teams-view/' . ModelMaster::encodeParams(["departmentId" => $departmentId]));
    }
    public function actionSaveTeam()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;    
        if (isset($_POST["departmentId"]) && isset($_POST["teamName"])) {
            $departmentId = $_POST["departmentId"];
            $teamName = $_POST["teamName"];

            $existing = Team::find()->where([
                "departmentId" => $departmentId,
                "teamName" => $teamName,
                "status" => 1
            ])->one();
            
            if (!empty($existing)) {
                $errors[] = 'Cannot create duplicate department name "' . $teamName . '"';
                // continue;
                return ['errors' => false, 'message' =>  $errors];
            }else{
                $team = new Team();
                $team->teamName = $teamName;
                $team->departmentId = $departmentId;
                $team->status = '1';
                $team->createDateTime = new Expression('NOW()');
                $team->updateDateTime = new Expression('NOW()');
    
                if ($team->save()) {
                    $teams = Api::connectApi(
                        Path::Api() . 'masterdata/team/department-team?id=' . $departmentId . '&page=1&limit=0'
                    );

                    return [
                        'success' => true,
                        'teams' => $teams // ส่งค่ากลับ
                    ];
                } else {
                    return ['success' => false, 'errors' => $team->getErrors()];
                }
            }            
        }
    
        return ['success' => false, 'message' => 'no branchId'];
    }

    public function actionUpdateTeam()
    {
         Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            if (isset( $_POST["teamName"], $_POST["teamId"])) {
                $teamName = $_POST["teamName"];
                $teamId = $_POST["teamId"];

                $team = Team::find()->where(['teamId' => $teamId, 'status' => 1])->one();

                if (!$team) {
                    return ['success' => false, 'message' => 'Team not found'];
                }

                // เช็กชื่อซ้ำ (ยกเว้นทีมตัวเอง)
                $duplicate = Team::find()
                    ->where(['teamName' => $teamName, 'status' => '1'])
                    ->andWhere(['<>', 'teamId', $teamId])
                    ->one();

                if ($duplicate) {
                    return ['success' => false, 'message' => 'Team name "' . $teamName . '" already exists in this department'];
                }

                // อัปเดตข้อมูล
                $team->teamName = $teamName;
                $team->updateDateTime = new \yii\db\Expression('NOW()');
                $departmentId = $team->departmentId;

                if ($team->save(false)) {
                    // ดึงข้อมูล teams ล่าสุดกลับมา
                    $teams = Api::connectApi(
                        Path::Api() . 'masterdata/team/department-team?id=' . $departmentId . '&page=1&limit=0'
                    );

                    return [
                        'success' => true,
                        'teams' => $teams
                    ];
                } else {
                    return ['success' => false, 'errors' => $team->getErrors()];
                }
            }

            return ['success' => false, 'message' => 'Missing teamId, departmentId, or teamName'];
            
    }
    public function actionSaveUpdateTeam()
    {
        $departmentId = $_POST["departmentId"];
        $teamName = $_POST["teamName"];
        $teamId = $_POST["teamId"] - 543;
        $check = Team::find()
            ->where([
                "teamName" => $teamName,
                "departmentId" => $departmentId,
            ])
            ->andWhere("teamId!=$teamId")
            ->one();
        if (isset($check) && !empty($check)) {
            $res["status"] = false;
        } else {
            $team = Team::find()->where(["teamId" => $teamId])->one();
            $team->departmentId = $departmentId;
            $team->teamName = $teamName;
            $team->status = 1;
            $team->updateDateTime = new Expression('NOW()');
            if ($team->save(false)) {
                 $teamDetail = Api::connectApi(
                    Path::Api() . 'masterdata/team/team-detail?id=' . $teamId
                );

                $textUpdateTeam = $this->renderAjax('update_team', [
                    "teamId" => $teamId,
                    "team" => $teamDetail
                ]);
                $res["textUpdateTeam"] = $textUpdateTeam;
                $res["status"] = true;
            }
        }
        return json_encode($res);
    }
    public function actionDeleteTeam()
    {
         Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; // ← สำคัญ!

        if (isset($_POST["teamId"])) {
            $teamId = $_POST["teamId"];

            $update = Team::find()->where([
                "teamId" => $teamId,
                "status" => '1'
            ])->one();

            if ($update) {
                $update->status = '99';
                $update->updateDateTime = new Expression('NOW()');

                if ($update->save(false)) {
                    $departmentId = $update->departmentId;
                    $teams = Api::connectApi(
                        Path::Api() . 'masterdata/team/department-team?id=' . $departmentId . '&page=1&limit=0'
                    );

                    return [
                        'success' => true,
                        'departments' => $teams
                    ];
                } else {
                    $errorText = [];
                    foreach ($update->getErrors() as $field => $errors) {
                        $errorText[] = implode(', ', $errors);
                    }
                    return ['success' => false, 'message' => implode("\n", $errorText)];
                }
            } else {
                return ['success' => false, 'message' => 'Team not found'];
            }
        }
        return ['success' => false, 'message' => 'Missing required POST parameters'];
    }
    public function actionFilterTeam()
    {
        // $companyId = $_POST["companyId"] != '' ? $_POST["companyId"] : null;
        // $branchId = $_POST["branchId"] != '' ? $_POST["branchId"] : null;
        // $departmentId = $_POST["departmentId"] != '' ? $_POST["departmentId"] : null;
        // if ($companyId == "" && $branchId == "" && $departmentId == "") {
        //     return $this->redirect(Yii::$app->homeUrl . 'setting/team/create/' . ModelMaster::encodeParams([
        //         "companyId" => '',
        //     ]));
        // }
        // return $this->redirect(Yii::$app->homeUrl . 'setting/team/team-result/' . ModelMaster::encodeParams([
        //     "companyId" => $companyId,
        //     "branchId" => $branchId,
        //     "departmentId" => $departmentId
        // ]));
    }
    public function actionTeamResult($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $companyId = $param["companyId"];
        $branchId = $param["branchId"];
        $departmentId = $param["departmentId"];
        $groupId = Group::currentGroupId();
        $totalEmployee = 0;
        $totalDepartment = 0;
        $totalBranch = 0;

        if (!empty($companyId)) {
            // ดึงข้อมูลบริษัท
            $company = Api::connectApi(Path::Api() . 'masterdata/company/company-detail?id=' . $companyId);

            // ดึงข้อมูลสาขาของบริษัท
            $branches = Api::connectApi(Path::Api() . 'masterdata/branch/company-branch?id=' . $companyId);

            $branchess = Branch::find()
                ->where(["status" => 1, "companyId" => $companyId])
                ->asArray()
                ->all();
        } else {
            // ถ้าไม่มี companyId
            $branches = [];
            Api::connectApi(Path::Api() . 'masterdata/team/all-teams-detail'); // เรียก API แต่ไม่ได้ใช้ผลลัพธ์

            $branchess = Branch::find()
                ->where(["status" => 1])
                ->asArray()
                ->all();
        }
        if (!empty($branchId)) {
            $departments = Department::find()
                ->select('departmentId,departmentName')
                ->where(["branchId" => $branchId, "status" => 1])
                ->asArray()
                ->orderBy('departmentName')
                ->all();
        } else {
            $departments = [];
        }

        // ดึงข้อมูล Group → Company
        $companies = Api::connectApi(Path::Api() . 'masterdata/group/company-group?id=' . $groupId);

        $teams = Team::find()->select('team.*,d.departmentName,c.companyName,b.branchName,co.flag,co.countryName')
            ->JOIN("LEFT JOIN", "department d", "d.departmentId=team.departmentId")
            ->JOIN("LEFT JOIN", "branch b", "b.branchId=d.branchId")
            ->JOIN("LEFT JOIN", "company c", "c.companyId=b.companyId")
            ->JOIN("LEFT JOIN", "country co", "co.countryId=c.countryId")
            ->where([
                "c.groupId" => $groupId,
                "d.status" => 1,
                "b.status" => 1,
                "c.status" => 1,
                "team.status" => 1
            ])
            ->andFilterWhere([
                "c.companyId" => $companyId,
                "b.branchId" => $branchId,
                "d.departmentId" => $departmentId,
            ])
            ->asArray()
            ->orderBy('team.teamName')
            ->all();
        
        if (isset($branchess) && count($branchess) > 0) {
            foreach ($branchess as $branch) :
                $departments = Department::find()
                    ->where(["branchId" => $branch["branchId"], "status" => 1])
                    ->asArray()
                    ->all();
                foreach ($departments as $department) :
                    $teamss = Team::find()
                        ->where(["departmentId" => $department["departmentId"], "status" => 1])
                        ->asArray()
                        ->all();
                    if (isset($teamss) && count($teams) > 0) {
                        foreach ($teamss as $team) :
                            $employees = Employee::find()
                                ->where(["status" => 1, "teamId" => $team["teamId"]])
                                ->asArray()
                                ->all();
                            $totalEmployee += count($employees);
                        endforeach;
                    }
                endforeach;
                $totalDepartment += count($departments);
            endforeach;
        }
        $totalBranch = count($branchess);
        
        return $this->render('search_result', [
            "companies" => $companies,
            "allTeams" => $teams,
            "companyIdSearch" => $companyId,
            "branches" => $branches,
            "branchId" => $branchId,
            "departmentId" => $departmentId,
            "departments" => $departments,
            "totalBranch" => $totalBranch,
            "totalDepartment" => $totalDepartment,
            "totalEmployee" => $totalEmployee,
        ]);
    }
}