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
        return true; //go to origin request
    }

    public function actionEncodeParamsCountry() {
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
	
		$countryId = Yii::$app->request->post('countryId');
		$page = Yii::$app->request->post('page');

		$url =  ModelMaster::encodeParams(['countryId' => $countryId, 'nextPage' => 1]);
	
		if($page == 'grid') {
			return $this->redirect(Yii::$app->homeUrl . 'setting/branch/branch-grid-filter/'. $url );
		}else if($page == 'list') {
			return $this->redirect(Yii::$app->homeUrl . 'setting/branch/index-filter/'. $url );
		}else{
			return "eror";
		}
	}

    public function actionEncodeParamsPage() {
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
	
        $page = Yii::$app->request->post('page');
		$countryId = Yii::$app->request->post('countryId');
		$nextPage = Yii::$app->request->post('nextPage');

		// throw new exception(print_r($nextPage, true));

		$url =  ModelMaster::encodeParams(['countryId' => $countryId, 'nextPage' => $nextPage]);
	
		if($page == 'grid') {
			return $this->redirect(Yii::$app->homeUrl . 'setting/branch/branch-grid-filter/'. $url );
		}else if($page == 'list') {
			return $this->redirect(Yii::$app->homeUrl . 'setting/branch/index-filter/'. $url );
		}else{
            if($page == 'view'){
				return $this->redirect(Yii::$app->homeUrl . 'setting/branch/branch-view-filter/'. $url );
			}
			return "eror";
		}
	}


    
    function actionNoBranch($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $companyId = $param["companyId"];

        $group = Group::find()->select('groupId')->where(["status" => 1])->asArray()->one();
        if (!isset($group) && !empty($group)) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group/');
        }

        $company = Company::find()->select('companyId')->where(["status" => 1])->asArray()->one();
        if (!isset($company) && !empty($company)) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/company/create-company/' . ModelMaster::encodeParams(["groupId" => $group["groupId"]]));
        }

        $branch = Branch::find()->select('branchId')->where(["status" => 1])->asArray()->one();
        if (isset($branch) && !empty($branch)) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/branch/branch-grid/' . ModelMaster::encodeParams(["companyId" => '']));
        }
        

        $role = UserRole::userRight();
        if ($role == 7) {
            $adminId = Yii::$app->user->id;
        }
        if ($role == 6) {
            $gmId = Yii::$app->user->id;
        }
        if ($role == 5) {
            $managerId = Yii::$app->user->id;
        }
        if ($role == 4) {
            $supervisorId = Yii::$app->user->id;
        }
        if ($role == 3) {
            $teamLeaderId = Yii::$app->user->id;
        }
        if ($role == 1 || $role == 2) {
            $staffId = Yii::$app->user->id;
            //return $this->redirect(Yii::$app->homeUrl . 'kpi/kpi-personal/individual-kpi');
        }

        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/country/company-country');
		$result1 = curl_exec($api);
		$countries = json_decode($result1, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/branch-page?id='  . '&page=1' . '&countryId=' . '&limit=6');
		$numPage = curl_exec($api);
		$numPage = json_decode($numPage, true);
        
        curl_close($api);

        return $this->render('no_branch', [
            "companyId" => $companyId,
            "role" => $role,
            "countries" => $countries,
            "countryId" => 0
            // "numPage" => $numPage

        ]);
    }

    
    public function actionIndex()
    {
        // $param = ModelMaster::decodeParams($hash);
        // $companyId = $param["companyId"];
        $role = UserRole::userRight();
   
        // $company = [];
        $totalEmployees = 0;
        $totalDepartment = 0;
        $totalTeam = 0;
        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/country/company-country');
		$result1 = curl_exec($api);
		$countries = json_decode($result1, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/branch-page?page=1' . '&countryId=0' . '&limit=7');
		$numPage = curl_exec($api);
		$numPage = json_decode($numPage, true);
        //throw new Exception(print_r($numPage, true));
        // if ($companyId != '') {
        //     curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/company-detail?id=' . $companyId);
        //     $company = curl_exec($api);
        //     $company = json_decode($company, true);

        //     curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/company-branch?id=' . $companyId);
        //     $branchJson = curl_exec($api);
        //     $branches = json_decode($branchJson, true);

        //     $branchess = Branch::find()
        //         ->where(["status" => 1, "companyId" => $companyId])
        //         ->asArray()
        //         ->all();

        //     // curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/country/country-detail?id=' . $company["countryId"]);
        //     // $resultCountryDetail = curl_exec($api);
        //     // $companyCountry = json_decode($resultCountryDetail, true);
        // } else {
            curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/active-branch?page=1'. '&limit=7');
            $branchJson = curl_exec($api);
            $branches = json_decode($branchJson, true);

            // $branchess = Branch::find()
            //     ->where(["status" => 1])
            //     ->asArray()
            //     ->all();
        // }
        //  throw new Exception(print_r($companies, true));

        // curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $group["groupId"] . '&page=1' . '&limit=0');
        // $companyJson = curl_exec($api);
        // $companyGroup = json_decode($companyJson, true);

        curl_close($api);

        $data = [];
        if (isset($branches) && count($branches) > 0) {
            foreach ($branches as $branch) :

                $branchId = $branch['branchId'];
				$employees = Employee::find()
				->where(["branchId" => $branchId , "status" => 1])
				->asArray()
				->all();
				// กรองเฉพาะที่มี picture
				$filteredEmployees = array_filter($employees, function($employee) {
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
                // $totalDepartment += count($departments);

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
                "branchImage" => $branch["branchImage"],
                "currency_default" => $branch["currency_default"],
                "companyName" => $branch["companyName"],
                "countryName" => $branch["countryName"],
                "picture" => $branch["picture"],
                "flag" => $branch["flag"],
                "city" => $branch["city"],
                "totalDepartment" => count($departments),
                "totalTeam" => $totalTeam,
                "totalEmployee" => $totalEmployees,
                "employees" => $filteredEmployees,
                ];
            endforeach;
        }

        //  throw new Exception(print_r($data, true));

        if (count($branches) > 0) {
            return $this->render('index', [
                // "company" => $company,
                // "companies" => $companyGroup,
                "branches" => $data,
                // "country" => $companyCountry,
                // "companyId" => $companyId,
                // "totalDepartment" => count($departments),
                // "totalTeam" => $totalTeam,
                // "totalEmployees" => $totalEmployees,
                "role" => $role,
                "countries" => $countries,
                "countryId" => 0,
                "numPage" => $numPage
            ]);
        }
    }

     
    public function actionIndexFilter($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $countryId = $param["countryId"];
        $nextPage = $param["nextPage"];

        $role = UserRole::userRight();
   
        $totalEmployees = 0;
        $totalDepartment = 0;
        $totalTeam = 0;
        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/country/company-country');
		$result1 = curl_exec($api);
		$countries = json_decode($result1, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/branch-page?page=' . $nextPage . '&countryId=' . $countryId . '&limit=7');
		$numPage = curl_exec($api);
		$numPage = json_decode($numPage, true);
        //throw new Exception(print_r($numPage, true));
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/active-branch-filter?id=1' . '&page=' . $nextPage . '&countryId='. $countryId . '&limit=6');
        $branchJson = curl_exec($api);
        $branches = json_decode($branchJson, true);
        
        //  throw new Exception(print_r($branches, true));

        // $branchess = Branch::find()
        //         ->where(["status" => 1])
        //         ->asArray()
        //         ->all();

        curl_close($api);

        $data = [];
        if (isset($branches) && count($branches) > 0) {
            foreach ($branches as $branch) :

                $branchId = $branch['branchId'];
				$employees = Employee::find()
				->where(["branchId" => $branchId , "status" => 1])
				->asArray()
				->all();
				// กรองเฉพาะที่มี picture
				$filteredEmployees = array_filter($employees, function($employee) {
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
                // $totalDepartment += count($departments);

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
                "branchImage" => $branch["branchImage"],
                "currency_default" => $branch["currency_default"],
                "companyName" => $branch["companyName"],
                "countryName" => $branch["countryName"],
                "picture" => $branch["picture"],
                "flag" => $branch["flag"],
                "city" => $branch["city"],
                "totalDepartment" => count($departments),
                "totalTeam" => $totalTeam,
                "totalEmployee" => $totalEmployees,
                "employees" => $filteredEmployees,
                ];
            endforeach;
        }

        //  throw new Exception(print_r($branches, true));

        // if (count($branches) > 0) {
            return $this->render('index', [
                // "company" => $company,
                // "companies" => $companyGroup,
                "branches" => $data,
                // "country" => $companyCountry,
                // "companyId" => $companyId,
                // "totalEmployees" => $totalEmployees,
                // "totalDepartment" => count($departments),
                // "totalTeam" => $totalTeam,
                "role" => $role,
                "countries" => $countries,
                "countryId" => 0,
                "numPage" => $numPage
            ]);
        // }
    }

    function actionBranchGrid()
    {
        // $param = ModelMaster::decodeParams($hash);
        // $companyId = $param["companyId"];
        $totalEmployees = 0;
        $totalDepartment = 0;
        $totalTeam = 0;
        $role = UserRole::userRight();

        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/country/company-country');
		$result1 = curl_exec($api);
		$countries = json_decode($result1, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/branch-page?page=1' . '&countryId=0' . '&limit=6');
		$numPage = curl_exec($api);
		$numPage = json_decode($numPage, true);
        //throw new Exception(print_r($numPage, true));
        
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/active-branch?page=1'. '&limit=6');
        $branchJson = curl_exec($api);
        $branches = json_decode($branchJson, true);

        // $branchess = Branch::find()
        //     ->where(["status" => 1])
        //     ->asArray()
        //     ->all();
        
        curl_close($api);

		$data = [];
        if (isset($branches) && count($branches) > 0) {
            foreach ($branches as $branch) :

                $branchId = $branch['branchId'];
				$employees = Employee::find()
				->where(["branchId" => $branchId , "status" => 1])
				->asArray()
				->all();
				// กรองเฉพาะที่มี picture
				$filteredEmployees = array_filter($employees, function($employee) {
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
                // $totalDepartment += count($departments);

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
                "branchImage" => $branch["branchImage"],
                "currency_default" => $branch["currency_default"],
                "companyName" => $branch["companyName"],
                "countryName" => $branch["countryName"],
                "picture" => $branch["picture"],
                "flag" => $branch["flag"],
                "city" => $branch["city"],
                "totalDepartment" => count($departments),
                "totalTeam" => $totalTeam,
                "totalEmployee" => $totalEmployees,
                "employees" => $filteredEmployees,
                ];
            endforeach;
        }

        // throw new Exception(print_r($data, true)); // Debug: ดูข้อมูลทั้งหมด

        return $this->render('branch_grid', [
            // "companyId" => $companyId,
            "branches" => $data,
            // "totalDepartment" => count($departments),
			// "totalTeam" => count($teams),
			// "totalEmployee" => $totalEmployee,
            // "employees" => $filteredEmployees,
            "role" => $role,
            "countries" => $countries,
            "countryId" => 0,
            "numPage" => $numPage

        ]);
    }

    
    function actionBranchGridFilter($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $countryId = $param["countryId"];
        $nextPage = $param["nextPage"];

        // throw new Exception(print_r($countryId, true));


        $totalEmployees = 0;
        $totalDepartment = 0;
        $totalTeam = 0;
        $role = UserRole::userRight();


        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/country/company-country');
		$result1 = curl_exec($api);
		$countries = json_decode($result1, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/branch-page?page='. $nextPage  . '&countryId=' . $countryId . '&limit=7');
		$numPage = curl_exec($api);
		$numPage = json_decode($numPage, true);
        // throw new Exception(print_r($numPage, true));

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/active-branch-filter?id=1' . '&page=' . $nextPage . '&countryId='. $countryId . '&limit=6');
        $branchJson = curl_exec($api);
        $branches = json_decode($branchJson, true);


        // throw new Exception(print_r($branches, true));

        curl_close($api);

		$data = [];
        if (isset($branches) && count($branches) > 0) {
            foreach ($branches as $branch) :

                $branchId = $branch['branchId'];
				$employees = Employee::find()
				->where(["branchId" => $branchId , "status" => 1])
				->asArray()
				->all();
				// กรองเฉพาะที่มี picture
				$filteredEmployees = array_filter($employees, function($employee) {
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
                // $totalDepartment += count($departments);

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
                "branchImage" => $branch["branchImage"],
                "currency_default" => $branch["currency_default"],
                "companyName" => $branch["companyName"],
                "countryName" => $branch["countryName"],
                "picture" => $branch["picture"],
                "flag" => $branch["flag"],
                "city" => $branch["city"],
                "totalDepartment" => count($departments),
                "totalTeam" => $totalTeam,
                "totalEmployee" => $totalEmployees,
                "employees" => $filteredEmployees,
                ];
            endforeach;
        }

        // throw new Exception(print_r($data, true)); // Debug: ดูข้อมูลทั้งหมด

        return $this->render('branch_grid', [
            // "companyId" => $companyId,
            "branches" => $data,
            // "totalDepartment" => count($departments),
			// "totalTeam" => count($teams),
			// "totalEmployee" => $totalEmployee,
            // "employees" => $filteredEmployees,
            "role" => $role,
            "countries" => $countries,
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
        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

        if ($companyId != '') {
            curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/company-detail?id=' . $companyId);
            $company = curl_exec($api);
            $company = json_decode($company, true);

            curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/company-branch?id=' . $companyId);
            $branchJson = curl_exec($api);
            $branches = json_decode($branchJson, true);

            $branchess = Branch::find()
                ->where(["status" => 1, "companyId" => $companyId])
                ->asArray()
                ->all();

            // curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/country/country-detail?id=' . $company["countryId"]);
            // $resultCountryDetail = curl_exec($api);
            // $companyCountry = json_decode($resultCountryDetail, true);
        } else {
            curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/active-branch?page=1' . '&limit=0');
            $branchJson = curl_exec($api);
            $branches = json_decode($branchJson, true);

            $branchess = Branch::find()
                ->where(["status" => 1])
                ->asArray()
                ->all();
        }
        //  throw new Exception(print_r($companies, true));

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $group["groupId"]. '&page=1' . '&limit=0');
        $companyJson = curl_exec($api);
        $companyGroup = json_decode($companyJson, true);

        

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
                $totalDepartment += count($departments);
            endforeach;
        }

        //  throw new Exception(print_r($branches, true));


        return $this->render('create', [
            "company" => $company,
            "companies" => $companyGroup,
            "companyId" => $companyId,

        ]);
    }
    public function actionSaveCreateBranch()
    {
        // throw new Exception('POST DATA: ' . print_r($_POST, true));

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
                    // $oldPathPicture = Path::getHost() . $oldImage;
                    // if (file_exists($oldPathPicture)) {
                    //     unlink($oldPathPicture);
                    // }
                    $file = $fileImage->name;
                    $filenameArray = explode('.', $file);
                    $countArrayFile = count($filenameArray);
                    $fileName = Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[$countArrayFile - 1];
                    $pathSave = $path . $fileName;
                    $fileImage->saveAs($pathSave);
                    $branch->branchImage = 'images/branch/profile/' . $fileName;
                    $branch->save(false);
                    // $group->picture = 'images/group/profile/' . $fileName;
                }
                
                return $this->redirect(Yii::$app->homeUrl . 'setting/branch/index/' . ModelMaster::encodeParams(['companyId' => '']));
                
                // $branchId = Yii::$app->db->lastInsertID + 543;
                // $api = curl_init();
                // curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
                // curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
                // curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/company-detail?id=' . $_POST["companyId"]);
                // $company = curl_exec($api);
                // $company = json_decode($company, true);

                // curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/country/country-detail?id=' . $company["countryId"]);
                // $resultCountryDetail = curl_exec($api);
                // $companyCountry = json_decode($resultCountryDetail, true);
                // curl_close($api);

                // $group = Branch::find()->where(["branchId" => $_POST["branchId"]])->one();
                // $oldBanner = $group->banner;
                // $oldImage = $group->picture;

                // $newBranch = $this->renderAjax('new_branch', [
                //     "branchName" => $_POST["branchName"],
                //     "company" => $company,
                //     "description" => $_POST["description"],
                //     "country" => $companyCountry,
                //     "branchId" => $branchId
                // ]);
                // $res["status"] = true;
                // $res["newBranch"] = $newBranch;
            }
        }

        // 

        // return json_encode($res);
    }

    public function actionBranchView($hash){

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



		return $this->render('branch_view', [
            "company" => $company,
			"countries" => $countries,
            "branches" => $branch,
            "departments" => $data,
            "numPage" => $numPage,
            "countryId" => 0
		]);
        
    }

    public function actionBranchViewFilter($hash){

        $param = ModelMaster::decodeParams($hash);

        if (!empty($param['branchId'])) {
            $branchId = $param['branchId'];
        } else {
            $branchId = $param['countryId'];
            $nextPage = $param['nextPage'];
        }
        
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

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/department-page?id=' . $branchId .'&page=' . $nextPage . '&countryId=0' . '&limit=5');
		$numPage = curl_exec($api);
		$numPage = json_decode($numPage, true);
        // throw new Exception("numPage: " . print_r($numPage, true));

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/branch-department-filter?id=' .  $branchId . '&companyId=' . $branch["companyId"] . '&page=' . $nextPage  . '&limit=5');
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
        // return json_encode($branchId);

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
        // if ($branch->save(false)) {
        $res["status"] = true;
        // } else {
        //     $res["status"] = false;
        // }
        return json_encode($res);
    }
    public function actionUpdateBranch($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $branchId = $param["branchId"] - 543;

        // $branchId = $_POST["branchId"] - 543;
        // $branch = Branch::find()->where(["branchId" => $branchId])->asArray()->one();
        // $res["branchId"] = $branch["branchId"];
        // $res["branchName"] = $branch["branchName"];
        // $res["description"] = $branch["description"];
        // $res["companyId"] = $branch["companyId"];
        // throw new Exception("branch: " . print_r($branchId, true));

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


        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/company-detail?id=' . $branch["companyId"]);
        $company = curl_exec($api);
        $company = json_decode($company, true);

		curl_close($api);
		 
		// throw new Exception("branch: " . print_r($branch, true));

		return $this->render('update_branch', [
            "company" => $company,
			"countries" => $countries,
            "branches" => $branch
		]);

        // return json_encode($res);
    }
    public function actionSaveUpdateBranch()
    {
        // $companyId = $_POST["companyId"] - 543;

        // $check = Branch::find()
        //     ->where(["branchName" => $_POST["branchName"], "companyId" => $_POST["companyId"]])
        //     ->andWhere("branchId!=$branchId")
        //     ->one();
        // if (isset($check) && !empty($check)) {
        //     $res["status"] = false;
        // } else {
        //     $branch = Branch::find()->where(["branchId" => $branchId])->one();
        //     $branch->branchName = $_POST["branchName"];
        //     $branch->description = $_POST["description"];
        //     $branch->status = 1;
        //     $branch->updateDateTime = new Expression('NOW()');
        //     $companyId = $branch->companyId;
        //     if ($branch->save(false)) {
        //         $api = curl_init();
        //         curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
        //         curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

        //         curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/company-detail?id=' . $companyId);
        //         $company = curl_exec($api);
        //         $company = json_decode($company, true);

        //         curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/country/country-detail?id=' . $company["countryId"]);
        //         $resultCountryDetail = curl_exec($api);
        //         $companyCountry = json_decode($resultCountryDetail, true);
        //         curl_close($api);

        //         $newBranch = $this->renderAjax('update', [
        //             "branchName" => $_POST["branchName"],
        //             "company" => $company,
        //             "description" => $_POST["description"],
        //             "country" => $companyCountry,
        //             "branchId" => $_POST["branchId"]
        //         ]);
        //         $res["status"] = true;
        //         $res["updateBranch"] = $newBranch;
        //     }
        // }
        // return json_encode($res);
        $branchId = $_POST["branchId"] - 543;

        $branch = Branch::find()->where([
            "companyId" => $_POST["companyId"],
            "branchId" => $branchId
        ])->one();
        
        		// throw new Exception("branch: " . print_r($branchId, true));

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
        
            // อัปโหลดรูป
            $fileImage = UploadedFile::getInstanceByName("image");
            if (isset($fileImage) && !empty($fileImage)) {
                $path = Path::getHost() . 'images/branch/profile/';
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
        
                $filenameArray = explode('.', $fileImage->name);
                $ext = end($filenameArray);
                $fileName = Yii::$app->security->generateRandomString(10) . '.' . $ext;
                $pathSave = $path . $fileName;
                $fileImage->saveAs($pathSave);
        
                // เซฟ path รูป
                $branch->branchImage = 'images/branch/profile/' . $fileName;
                $branch->save(false);
            }
        
            return $this->redirect(Yii::$app->homeUrl . 'setting/branch/index/' . ModelMaster::encodeParams(['companyId' => '']));
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
}