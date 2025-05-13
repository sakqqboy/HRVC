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
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Html;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Yii;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\UploadedFile;

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
	
        // $countryId = Yii::$app->request->post('countryId');
        $companyId = Yii::$app->request->post('companyId');
        $branchId = Yii::$app->request->post('branchId');
        $departmentId = Yii::$app->request->post('departmentId');
        
        $page = Yii::$app->request->post('page');
		$nextPage = Yii::$app->request->post('nextPage');

		// throw new exception(print_r($nextPage, true));

		$url =  ModelMaster::encodeParams([ 'companyId' => $companyId, 'branchId' => $branchId ,'departmentId' => $departmentId, 'nextPage' => $nextPage]);
	
		if($page == 'grid') {
			return $this->redirect(Yii::$app->homeUrl . 'setting/team/index-filter/'. $url );
		}else if($page == 'view') {
            return $this->redirect(Yii::$app->homeUrl . 'setting/team/team-view/'. $url );
        }
	}

	public function actionNoTeam($hash)
	{
        $param = ModelMaster::decodeParams($hash);
        $departmentId = $param["departmentId"];
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
        if (isset($team) && !empty($team)) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/team/index/');
        }

        return $this->render('no_team', [
            "departmentId" => $departmentId,
            "group" =>  $group
        ]);
	}
    
    public function actionIndex()
    {
        return $this->render('index',[
        ]);
    }

    public function actionCreate($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $departmentId = $param["departmentId"];
        $branchId = $param["branchId"]?? null;
        $companyId = $param["companyId"] ?? null;
        $groupId = Group::currentGroupId();
        // $allTeams = [];
        $companyName = '';
        $branchName = '';
        $departmenName = '';
        // $branches = [];
        // $totalEmployee = 0;
        // $totalDepartment = 0;
        // $totalBranch = 0;

        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

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

        // throw new Exception(print_r($param, true));
        // if ($companyId != "") {
        //     curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/company-detail?id=' . $companyId);
        //     $company = curl_exec($api);
        //     $company = json_decode($company, true);
        //     $companyName = $company["companyName"];

        //     curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/company-branch?id=' . $companyId);
        //     $branches = curl_exec($api);
        //     $branches = json_decode($branches, true);

        //     curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/team/company-team?id=' . $companyId);
        //     $allTeams = curl_exec($api);
        //     $allTeams = json_decode($allTeams, true);

        //     $branchess = Branch::find()
        //         ->where(["status" => 1, "companyId" => $companyId])
        //         ->asArray()
        //         ->all();

        //     //  throw new Exception(1);
        // } else {
            // curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/team/all-teams-detail');
            // $allTeams = curl_exec($api);
            // $allTeams = json_decode($allTeams, true);


            // $branchess = Branch::find()
            //     ->where(["status" => 1])
            //     ->asArray()
            //     ->all();

            //  throw new Exception(2);
        // }
        

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/group-detail?id=' . $groupId);
        $group = curl_exec($api);
        $group = json_decode($group, true);

        curl_close($api);
        
        // if (isset($branchess) && count($branchess) > 0) {
        //     foreach ($branchess as $branch) :
        //         $departments = Department::find()
        //             ->where(["branchId" => $branch["branchId"], "status" => 1])
        //             ->asArray()
        //             ->all();
        //         foreach ($departments as $department) :
        //             $teams = Team::find()
        //                 ->where(["departmentId" => $department["departmentId"], "status" => 1])
        //                 ->asArray()
        //                 ->all();
        //             if (isset($teams) && count($teams) > 0) {
        //                 foreach ($teams as $team) :
        //                     $employees = Employee::find()
        //                         ->where(["status" => 1, "teamId" => $team["teamId"]])
        //                         ->asArray()
        //                         ->all();
        //                     $totalEmployee += count($employees);
        //                 endforeach;
        //             }
        //         endforeach;
        //         $totalDepartment += count($departments);
        //     endforeach;
        // }
        // $totalBranch = count($branchess);
        return $this->render('create', [
            "group" => $group,
            "companies" => $companies,
            "companyName" => $companyName,
            "branchName" => $branchName,
            "departmentName" => $departmentName,
            "companyId" => $companyId,
            "branchId" => $branchId,
            "departmentId" => $departmentId,
            // "allTeams" => $allTeams,
            // "branches" => $branches,
            // "totalBranch" => $totalBranch,
            // "totalDepartment" => $totalDepartment,
            // "totalEmployee" => $totalEmployee,
        ]);
    }
    
    public function actionCompanyBranch()
    {
        $companyId = $_POST["companyId"];
        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/company-branch?id=' . $companyId);
        $branch = curl_exec($api);
        $branch = json_decode($branch, true);
        curl_close($api);
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
        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/branch-department?id=' . $branchId);
        $department = curl_exec($api);
        $department = json_decode($department, true);
        curl_close($api);
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
    public function actionDepartmentTeam()
    {
        $departmentId = $_POST["departmentId"];
        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/team/department-team?id=' . $departmentId);
        $team = curl_exec($api);
        $team = json_decode($team, true);

        $res = [];
        $textSelect = '<option value="">Select Team</option>';
        if (count($team) > 0) {
            foreach ($team as $t) :
                $textSelect .= "<option value='" . $t['teamId'] . "'>" . $t['teamName'] . "</option>";
            endforeach;
        }
        $textSelectTitle = '<option value="">Select Title</option>';
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/title/title-department?departmentId=' . $departmentId);
        $titles = curl_exec($api);
        $titles = json_decode($titles, true);
        if (count($titles) > 0) {
            foreach ($titles as $title) :
                $textSelectTitle .= "<option value='" . $title['titleId'] . "'>" . $title['titleName'] . "</option>";
            endforeach;
        }

        curl_close($api);
        $res["textSelect"] = $textSelect;
        $res["textSelectTitle"] = $textSelectTitle;
        return json_encode($res);
    }
    public function actionSaveCreateTeam()
    {
        if (isset($_POST["departmentId"]) && isset($_POST["teamName"])) {

            // throw new Exception(json_encode($_POST));

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
        
            return $this->redirect(Yii::$app->homeUrl . 'setting/team/no-team/' . ModelMaster::encodeParams(["departmentId" => '']));
        }

    }
    public function actionUpdateTeam()
    {
        $groupId = Group::currentGroupId();
        $teamId = $_POST["teamId"] - 543;
        $team = Team::find()->where(["teamId" => $teamId])->asArray()->one();

        $department = Department::find()
            ->select('departmentId,departmentName,branchId')
            ->where(["departmentId" => $team["departmentId"]])
            ->asArray()
            ->one();
        $branch = Branch::find()
            ->select('branchId,branchName,companyId')
            ->where(["branchId" => $department["branchId"]])
            ->asArray()
            ->one();
        $company = Company::find()
            ->select('companyId,companyName')
            ->where(["companyId" => $branch["companyId"]])
            ->asArray()
            ->one();
        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
        $companies = curl_exec($api);
        $companies = json_decode($companies, true);
        curl_close($api);

        $textAllCompany = "<option value='" . $company['companyId'] . "'>" . $company['companyName'] . "</option>";
        $textAllCompany .= "<option value=''>Select Company</option>";
        if (count($companies) > 0) {
            foreach ($companies as $com) :
                $textAllCompany .= "<option value='" . $com['companyId'] . "'>" . $com['companyName'] . "</option>";
            endforeach;
        }

        $branches = Branch::find()
            ->select('branchId,branchName')
            ->where(["companyId" => $company["companyId"], "status" => 1])
            ->asArray()
            ->orderBy('branchName')
            ->all();
        $textAllBranch = "<option value='" . $branch['branchId'] . "'>" . $branch['branchName'] . "</option>";
        $textAllBranch .= "<option value=''>Select Branch</option>";
        if (count($branches) > 0) {
            foreach ($branches as $br) :
                $textAllBranch .= "<option value='" . $br['branchId'] . "'>" . $br['branchName'] . "</option>";
            endforeach;
        }

        $departments = Department::find()
            ->select('departmentId,departmentName')
            ->where(["branchId" => $branch["branchId"], "status" => 1])
            ->asArray()
            ->orderBy('departmentName')
            ->all();
        $textAllDepartment = "<option value='" . $department['departmentId'] . "'>" . $department['departmentName'] . "</option>";
        $textAllDepartment .= "<option value=''>Select Department</option>";
        if (count($departments) > 0) {
            foreach ($departments as $de) :
                $textAllDepartment .= "<option value='" . $de['departmentId'] . "'>" . $de['departmentName'] . "</option>";
            endforeach;
        }
        $res["textAllCompany"] = $textAllCompany;
        $res["textAllBranch"] = $textAllBranch;
        $res["textAllDepartment"] = $textAllDepartment;
        $res["teamName"] = $team["teamName"];
        return json_encode($res);
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
                $api = curl_init();
                curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
                curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/team/team-detail?id=' . $teamId);
                $teamDetail = curl_exec($api);
                $teamDetail = json_decode($teamDetail, true);
                curl_close($api);
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
        $teamId = $_POST["teamId"] - 543;
        $team = Team::find()->where(["teamId" => $teamId])->one();
        $team->status = 99;

        if ($team->save(false)) {
            $res["status"] = true;
        } else {
            $res["status"] = false;
        }
        return json_encode($res);
    }
    public function actionFilterTeam()
    {
        $companyId = $_POST["companyId"] != '' ? $_POST["companyId"] : null;
        $branchId = $_POST["branchId"] != '' ? $_POST["branchId"] : null;
        $departmentId = $_POST["departmentId"] != '' ? $_POST["departmentId"] : null;
        if ($companyId == "" && $branchId == "" && $departmentId == "") {
            return $this->redirect(Yii::$app->homeUrl . 'setting/team/create/' . ModelMaster::encodeParams([
                "companyId" => '',
            ]));
        }
        return $this->redirect(Yii::$app->homeUrl . 'setting/team/team-result/' . ModelMaster::encodeParams([
            "companyId" => $companyId,
            "branchId" => $branchId,
            "departmentId" => $departmentId
        ]));
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

        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);



        if ($companyId != '') {
            curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/company-detail?id=' . $companyId);
            $company = curl_exec($api);
            $company = json_decode($company, true);

            curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/company-branch?id=' . $companyId);
            $branches = curl_exec($api);
            $branches = json_decode($branches, true);
            $branchess = Branch::find()
                ->where(["status" => 1, "companyId" => $companyId])
                ->asArray()
                ->all();
        } else {
            curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/team/all-teams-detail');
            $branches = [];
            $branchess = Branch::find()
                ->where(["status" => 1])
                ->asArray()
                ->all();
        }
        if ($branchId != '') {
            $departments = Department::find()->select('departmentId,departmentName')
                ->where(["branchId" => $branchId, "status" => 1])->asArray()->orderBy('departmentName')->all();
        } else {
            $departments = [];
        }

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
        $companies = curl_exec($api);
        $companies = json_decode($companies, true);

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
        curl_close($api);
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
        // throw new Exception(print_r($teams, true));
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
    public function actionImport()
    {
        $error = [];
        $isError = 0;
        $correct = [];
        $success = 0;
        $totalError = 0;
        //throw new Exception(print_r(Yii::$app->request->post(), true));
        // if (isset($_POST["employeeFile"])) {

        $imageObj = UploadedFile::getInstanceByName("teamFile");
        if (isset($imageObj) && !empty($imageObj)) {
            $urlFolder = Path::getHost() . 'file/import/team';
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
                        $layerId = '';
                        $departmentId = '';
                        $isError = 0;
                        $error[$i] = "";
                        if ($i >= 1) {

                            // throw new exception('2222');
                            if (trim($data[0]) == "") {
                                $isError = 1;
                                $error[$i] .= '- Team name<br>';
                            }
                            if (trim($data[1]) == "") {
                                $isError = 1;
                                $error[$i] .= '- Please select department<br>';
                            } else {
                                $departmentId = Department::branchNameWithDepartmentName($data[1]);
                                if ($departmentId == "") {
                                    $isError = 1;
                                    $error[$i] .= '- Department not found, need to contact administrator<br>';
                                }
                            }
                            if ($isError == 0) {
                                $team = new Team();
                                $team->teamName = $data[0];
                                $team->departmentId =  $departmentId;
                                $team->status = 1;
                                $team->createDateTime = new Expression('NOW()');
                                $team->updateDateTime = new Expression('NOW()');
                                if ($team->save(false)) {
                                    $success++;
                                    $correct[$i] = [
                                        "name" => $data[0],
                                        "department" => $data[1],
                                    ];
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
        return $this->render('import', [
            "errors" => $error,
            "success" => $success,
            "corrects" => $correct
        ]);
    }
    public function actionExport()
    {
        $departments = Department::find()
            ->select('departmentName,branchId')
            ->where(["status" => 1])
            ->asArray()
            ->orderBy('departmentName')
            ->all();
        $de = [];
        if (isset($departments) && count($departments) > 0) {
            $i = 0;
            foreach ($departments as $d) :
                $de[$i] = $d["departmentName"] . "(Branch::" . Branch::branchName($d["branchId"]) . ")";
                $i++;
            endforeach;
        }

        $htmlExcel = $this->renderPartial('export', [
            "departments" => $de,

        ]);
        $urlFolder = Path::getHost() . 'file/import/team/';
        $fileName = 'team.xlsx';
        $filePath = $urlFolder . $fileName;
        $reader = new Xlsx();


        $spreadsheet = new Spreadsheet;
        $reader2 = new Html();

        $spreadsheet->createSheet();

        $reader2->setSheetIndex(1);
        $spreadsheet = $reader2->loadFromString($htmlExcel);
        $spreadsheet->getActiveSheet(1)->setTitle('data');

        $spreadsheet1 = $reader->load($filePath);
        $reader2->setSheetIndex(0);
        $clonedWorksheet = clone $spreadsheet1->getSheetByName('team');
        $clonedWorksheet->setTitle('team');
        $spreadsheet->addExternalSheet($clonedWorksheet);
        $fileName = 'Import Team format' . date('Y-m-d');
        $spreadsheet->removeSheetByIndex(
            $spreadsheet->getIndex(
                $spreadsheet->getSheetByName('Worksheet')
            )
        );
        //  $spreadsheet->getActiveSheet()->setTitle('employee');

        $spreadsheet->setActiveSheetIndex(1);
        $folderName = "export";
        $urlFolder = Path::getHost() . 'file/' . $folderName . "/" . $fileName;
        $folder_path = Path::getHost() . 'file/' . $folderName;
        $files = glob($folder_path . '/*');
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($urlFolder);
        return Yii::$app->response->sendFile($urlFolder, $fileName . '.xlsx');
    }
}