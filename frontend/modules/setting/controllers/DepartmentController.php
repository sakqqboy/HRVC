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
		$page = Yii::$app->request->post('page');

		$url =  ModelMaster::encodeParams(['countryId' => $countryId, 'nextPage' => 1]);
	
		if($page == 'grid') {
			return $this->redirect(Yii::$app->homeUrl . 'setting/department/department-grid-filter/'. $url );
		}else if($page == 'list') {
			return $this->redirect(Yii::$app->homeUrl . 'setting/department/index-filter/'. $url );
		}else{
			return "eror";
		}
	}

	public function actionEncodeParamsPage() {
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
	
		$countryId = Yii::$app->request->post('countryId');
		$page = Yii::$app->request->post('page');
		$nextPage = Yii::$app->request->post('nextPage');

		// throw new exception(print_r($nextPage, true));

		$url =  ModelMaster::encodeParams(['countryId' => $countryId, 'nextPage' => $nextPage]);
	
		if($page == 'grid') {
			return $this->redirect(Yii::$app->homeUrl . 'setting/department/department-grid-filter/'. $url );
		}else if($page == 'list') {
			return $this->redirect(Yii::$app->homeUrl . 'setting/department/index-filter/'. $url );
		}else{
			if($page == 'view'){
				return $this->redirect(Yii::$app->homeUrl . 'setting/department/department-view/'. $url );
			}
			return "eror";
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

        $branch = Department::find()->select('departmentId')->where(["status" => 0])->asArray()->one();
        if (isset($branch) && !empty($branch)) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/department/index/' . ModelMaster::encodeParams(["branchId" => '']));
        }

        return $this->render('no_department', [
            "branchId" => $branchId
        ]);
	}

    public function actionIndex()
    {
        return $this->render('index');
    }
    
    // public function actionCreateOld($hash)
    // {

    //     $param = ModelMaster::decodeParams($hash);

    //     $branches = [];
    //     $branch = [];
    //     $company = [];
    //     $companies = [];
    //     $branchId = null;
    //     $titleList = [];
    //     $departments = [];
    //     $departmentList = [];
    //     $totalEmployees = 0;
    //     $totalBranches = 0;
    //     $totalTeam = 0;
    //     $group = Group::find()->select('groupId')->where(["status" => 1])->asArray()->one();
    //     if (!isset($group) && !empty($group)) {
    //         return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group/');
    //     }
    //     if (isset($param["branchId"])) {
    //         $branchId = $param["branchId"];
    //     }

    //     $api = curl_init();
    //     curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
    //     curl_setopt($api, CURLOPT_RETURNTRANSFER, true);


    //     if (isset($param["companyId"])) {
    //         $companyId = $param["companyId"];
    //         curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/company-detail?id=' . $companyId);
    //         $company = curl_exec($api);
    //         $company = json_decode($company, true);

    //         curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/company-department?id=' . $companyId);
    //         $departments = curl_exec($api);
    //         $departments = json_decode($departments, true);
    //         //throw new Exception(1);
    //     } else {
    //         curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' .  $group["groupId"]);
    //         $companies = curl_exec($api);
    //         $companies = json_decode($companies, true);
    //         $companyId = null;

    //         curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/all-department');
    //         $departments = curl_exec($api);
    //         $departments = json_decode($departments, true);
    //         //throw new Exception(2);
    //     }
    //     //throw new Exception(print_r($departments, true));
        
    //     if (count($departments) > 0) {
    //         foreach ($departments as $department) :
    //             $departmentList[$department["departmentId"]] = [
    //                 "departmentName" => $department["departmentName"],
    //                 "companyName" => Branch::companyName($department['branchId']),
    //                 "branchName" => Branch::BranchName($department['branchId']),
    //                 "flag" => Country::flagBranch($department['branchId']),
    //                 "titleDepartments" => DepartmentTitle::departmentTitle($department["departmentId"])
    //             ];
    //         endforeach;
    //     }
    //     //throw new Exception(print_r($departmentList, true));

    //     curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/title/title-list');
    //     $titleList = curl_exec($api);
    //     $titleList = json_decode($titleList, true);

    //     if ($companyId == null) {
    //         $branches = [];
    //         $branchess = Branch::find()
    //             ->where(["status" => 1])
    //             ->asArray()
    //             ->all();
    //     } else {
    //         curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/company-branch?id=' . $companyId);
    //         $branches = curl_exec($api);
    //         $branches = json_decode($branches, true);
    //         $branchess = Branch::find()
    //             ->where(["status" => 1, "companyId" => $companyId])
    //             ->asArray()
    //             ->all();
    //     }

    //     if ($branchId == null) {
    //     } else {
    //         curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/branch-detail?id=' . $branchId);
    //         $branch = curl_exec($api);
    //         $branch = json_decode($branch, true);
    //     }
    //     curl_close($api);

    //     if (isset($branchess) && count($branchess) > 0) {
    //         foreach ($branchess as $branch) :
    //             $departments = Department::find()
    //                 ->where(["branchId" => $branch["branchId"], "status" => 1])
    //                 ->asArray()
    //                 ->all();
    //             foreach ($departments as $department) :
    //                 $teams = Team::find()
    //                     ->where(["departmentId" => $department["departmentId"], "status" => 1])
    //                     ->asArray()
    //                     ->all();
    //                 if (isset($teams) && count($teams) > 0) {
    //                     foreach ($teams as $team) :
    //                         $employees = Employee::find()
    //                             ->where(["status" => 1, "teamId" => $team["teamId"]])
    //                             ->asArray()
    //                             ->all();
    //                         $totalEmployees += count($employees);
    //                     endforeach;
    //                 }
    //                 $totalTeam += count($teams);
    //             endforeach;
    //         endforeach;
    //     }
    //     $totalBranches += count($branchess);
    //     return $this->render('create', [
    //         "departmentList" => $departmentList,
    //         "branches" => $branches,
    //         "branch" => $branch,
    //         "company" => $company,
    //         "companies" => $companies,
    //         "branchId" => $branchId,
    //         "companyId" => $companyId,
    //         "titleList" => $titleList,
    //         "totalEmployees" => $totalEmployees,
    //         "totalBranches" => $totalBranches,
    //         "totalTeam" => $totalTeam
    //     ]);
    // }

    public function actionCreate($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $branchId = $param["branchId"];
        $companyId = $param["companyId"] ?? null;
        $companyName = '';
        $api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

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
        // throw new exception(print_r($companies, true));

        // curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/active-branch?page=1'. '&limit=6');
        // $branchJson = curl_exec($api);
        // $branches = json_decode($branchJson, true);
		// throw new exception(print_r($branches, true));

		curl_close($api);

        return $this->render('create', [
            // "branchId" => $branchId,
            // "companyId" => '',
            "companies" => $companies,
            "companyName" => $companyName
        ]);

    }
    
    public function actionCompanyBranchList()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $companyId = Yii::$app->request->post('companyId');

        $companies = [];
        $api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/company-branch');
        $companies = curl_exec($api);
        $companies = json_decode($companies, true);

		curl_close($api);

        throw new exception(print_r($companies, true));

        // if ($companyId) {
        //     $branches = Branch::find()
        //         ->where(['companyId' => $companyId])
        //         ->select(['branchId', 'branchName'])
        //         ->asArray()
        //         ->all();

        //     return $branches;
        // }

        return $companies;
    }


    public function actionSaveCreateDepartment()
    {
        $department = Department::find()
            ->where([
                "branchId" => $_POST["branchId"],
                "departmentName" => $_POST["departmentName"],
                "status" => 1
            ])
            ->one();
        if (isset($department) && !empty($department)) {
            $res["status"] = false;
            $res["errorText"] = 'Can not create dupplicate department name "' . $_POST["departmentName"] . '"';
        } else {
            $department = new Department();
            $department->departmentName = $_POST["departmentName"];
            $department->branchId = $_POST["branchId"];
            $department->status = 1;
            $department->createDateTime = new Expression('NOW()');
            $department->updateDateTime = new Expression('NOW()');
            if ($department->save(false)) {
                $departmentId = Yii::$app->db->lastInsertID;
                //$this->saveDefaultTitle($departmentId);
                // $titleDepartments = DepartmentTitle::find()
                //     ->select('t.titleName')
                //     ->JOIN("LEFT JOIN", "title t", "t.titleId=department_title.titleId")
                //     ->where(["department_title.departmentId" => $departmentId])
                //     ->asArray()
                //     ->orderBy('department_title.titleId')
                //     ->all();
                $res["newDepartment"] = $this->renderAjax('new_department', [
                    "departmentName" => $_POST["departmentName"],
                    "companyName" => Branch::companyName($_POST['branchId']),
                    "branchName" => Branch::BranchName($_POST['branchId']),
                    "flag" => Country::flagBranch($_POST['branchId']),
                    "departmentId" => $departmentId,
                    //"titleDepartments" => $titleDepartments
                ]);
                $res["status"] = true;
            }
        }
        return json_encode($res);
    }
    public function actionUpdateDepartment()
    {
        $department = Department::find()
            ->where(["departmentId" => $_POST["departmentId"] - 543])
            ->asArray()
            ->one();
        $branch = Branch::find()->select('companyId')->where(["branchId" => $department["branchId"]])->one();

        $res["branchId"] = $department["branchId"];
        $res["departmentId"] = $department["departmentId"] + 543;
        $res["departmentName"] = $department["departmentName"];
        $res["companyId"] = $branch["companyId"];
        $text = "<option value=''>Select Branch</option>";
        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/company-branch?id=' . $branch["companyId"]);
        $branch = curl_exec($api);
        $branch = json_decode($branch, true);
        curl_close($api);
        $res["status"] = false;
        if (isset($branch) && count($branch) > 0) {
            $res["status"] = true;
            foreach ($branch as $b) :
                $text .= "<option value='" . $b['branchId'] . "'>" . $b['branchName'] . "</option>";
            endforeach;
        }
        $res["branchText"] = $text;
        return json_encode($res);
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