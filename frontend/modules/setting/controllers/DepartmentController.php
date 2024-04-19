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
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionCreate($hash)
    {

        $param = ModelMaster::decodeParams($hash);

        $branches = [];
        $branch = [];
        $company = [];
        $companies = [];
        $branchId = null;
        $titleList = [];
        $departments = [];
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


        if ($param["companyId"] != '') {
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

            curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/all-department');
            $departments = curl_exec($api);
            $departments = json_decode($departments, true);
            //throw new Exception(2);
        }

        //throw new Exception(print_r($departments, true));
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
            "totalTeam" => $totalTeam
        ]);
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
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/branch-department-filter?branchId=' . $branchIdSearch . '&&companyId=' . $companyIdSearch);
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
