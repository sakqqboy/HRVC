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
use frontend\models\hrvc\Title;
use Yii;
use yii\db\Expression;
use yii\web\Controller;

/**
 * Default controller for the `setting` module
 */
class DepartmentController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionCreate($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $companyId = $param["companyId"];

        $branches = [];
        $branch = [];
        $branchId = null;
        $titleList = [];
        $departments = [];
        $departmentList = [];
        if (isset($param["branchId"])) {
            $branchId = $param["branchId"];
        }
        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/all-department');
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

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/company-detail?id=' . $companyId);
        $company = curl_exec($api);
        $company = json_decode($company, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/title/title-list');
        $titleList = curl_exec($api);
        $titleList = json_decode($titleList, true);

        if ($branchId == null) {
            curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/company-branch?id=' . $companyId);
            $branches = curl_exec($api);
            $branches = json_decode($branches, true);
        } else {
            curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/branch-detail?id=' . $branchId);
            $branch = curl_exec($api);
            $branch = json_decode($branch, true);
        }
        curl_close($api);
        return $this->render('create', [
            "departmentList" => $departmentList,
            "branches" => $branches,
            "branch" => $branch,
            "company" => $company,
            "branchId" => $branchId,
            "titleList" => $titleList
        ]);
    }
    public function actionSaveCreateDepartment()
    {
        $department = Department::find()
            ->where([
                "branchId" => $_POST["branchId"],
                "departmentName" => $_POST["departmentName"]
            ])
            ->one();
        if (isset($department) && !empty($department)) {
            $res["status"] = false;
            $res["errorText"] = "Can not create dupplicate department name.";
        } else {
            $department = new Department();
            $department->departmentName = $_POST["departmentName"];
            $department->branchId = $_POST["branchId"];
            $department->status = 1;
            $department->createDateTime = new Expression('NOW()');
            $department->updateDateTime = new Expression('NOW()');
            if ($department->save(false)) {
                $departmentId = Yii::$app->db->lastInsertID;
                $this->saveDefaultTitle($departmentId);
                $titleDepartments = DepartmentTitle::find()
                    ->select('t.titleName')
                    ->JOIN("LEFT JOIN", "title t", "t.titleId=department_title.titleId")
                    ->where(["department_title.departmentId" => $departmentId])
                    ->asArray()
                    ->orderBy('department_title.titleId')
                    ->all();
                $res["newDepartment"] = $this->renderAjax('new_department', [
                    "departmentName" => $_POST["departmentName"],
                    "companyName" => Branch::companyName($_POST['branchId']),
                    "branchName" => Branch::BranchName($_POST['branchId']),
                    "flag" => Country::flagBranch($_POST['branchId']),
                    "departmentId" => $departmentId,
                    "titleDepartments" => $titleDepartments
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
        $res["branchId"] = $department["branchId"];
        $res["departmentId"] = $department["departmentId"] + 543;
        $res["departmentName"] = $department["departmentName"];
        return json_encode($res);
    }
    public function actionDeleteDepartment()
    {
        $departmentId = $_POST["departmentId"] - 543;
        $department = Department::find()->where(["departmentId" => $departmentId])->one();
        $department->status = 99;

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
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, false);
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
}
