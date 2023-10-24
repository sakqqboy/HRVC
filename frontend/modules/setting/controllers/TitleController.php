<?php

namespace frontend\modules\setting\controllers;

use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
use frontend\models\hrvc\Branch;
use frontend\models\hrvc\Department;
use frontend\models\hrvc\DepartmentTitle;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\Layer;
use frontend\models\hrvc\Title;
use Yii;
use yii\db\Expression;
use yii\web\Controller;

/**
 * Default controller for the `setting` module
 */
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
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
    public function actionIndex()
    {
        $group = Group::find()->select('groupId')->where(["status" => 1])->asArray()->one();
        if (!isset($group) && !empty($group)) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group/');
        }
        $groupId = $group["groupId"];

        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/title/title-list');
        $title = curl_exec($api);
        $title = json_decode($title, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/layer/all-layer');
        $layer = curl_exec($api);
        $layer = json_decode($layer, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
        $companies = curl_exec($api);
        $companies = json_decode($companies, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/all-department');
        $departments = curl_exec($api);
        $departments = json_decode($departments, true);

        curl_close($api);
        return $this->render('index', [
            "title" => $title,
            "layer" => $layer,
            "companies" => $companies,
            "departments" => $departments
        ]);
    }
    public function actionSaveCreateTitle()
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
            $res["errorText"] = 'Can not create dupplicate Title name "' . $_POST["titleName"] . '"';
        } else {
            $title = new Title();
            $title->titleName = $_POST["titleName"];
            $title->layerId = $_POST["layer"];
            $title->departmentId = $_POST["departmentId"];
            $title->jobDescription = $_POST["jobDescription"];
            $title->shortTag = $_POST["shortTag"];
            $title->status = 1;
            $title->createDateTime = new Expression('NOW()');
            $title->updateDateTime = new Expression('NOW()');
            if ($title->save(false)) {
                $titleId = Yii::$app->db->lastInsertID;
                $departmentTitle = new DepartmentTitle();
                $departmentTitle->titleId = $titleId;
                $departmentTitle->departmentId = $_POST["departmentId"];
                $departmentTitle->status = 1;
                $departmentTitle->createDateTime = new Expression('NOW()');
                $departmentTitle->updateDateTime = new Expression('NOW()');
                $departmentTitle->save(false);
                $api = curl_init();
                curl_setopt($api, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/department-detail?id=' . $_POST["departmentId"]);
                $department = curl_exec($api);
                $department = json_decode($department, true);
                curl_close($api);
                $res["status"] = true;
                $res["newTitle"] = $this->renderAjax('new_title', [
                    "titleName" => $_POST["titleName"],
                    "layerName" => Layer::layerName($_POST['layer']),
                    "tShort" => Title::shortName($titleId),
                    "lShort" => Layer::shortName($_POST['layer']),
                    "titleId" => $titleId,
                    "branchName" => Branch::branchName($department["branchId"]),
                    "departmentName" => Department::departmentNAme($_POST["departmentId"])
                ]);
            }
        }
        return json_encode($res);
    }
    public function actionUpdateTitle()
    {
        $groupId = Group::currentGroupId();
        if ($groupId == '') {
            return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group/');
        }

        $titleId = $_POST["titleId"];
        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/title/title-detail?id=' . $titleId);
        $title = curl_exec($api);
        $title = json_decode($title, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/department-detail?id=' . $title["departmentId"]);
        $department = curl_exec($api);
        $department = json_decode($department, true);
        $textDepartment = '<option value="' . $department["departmentId"] . '">' . $department["departmentName"] . '</option>';
        $textDepartment .= '<option value="">Select Department</option>';
        $departments = Department::find()
            ->select('departmentId,departmentName')
            ->where(["branchId" => $department["branchId"]])
            ->andWhere("departmentId!=" . $department['departmentId'])
            ->asArray()
            ->orderBy("departmentName")
            ->all();
        if (isset($departments) && count($departments) > 0) {
            foreach ($departments as $dep) :
                $textDepartment .= '<option value="' . $dep["departmentId"] . '">' . $dep["departmentName"] . '</option>';
            endforeach;
        }


        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/branch-detail?id=' . $department["branchId"]);
        $branch = curl_exec($api);
        $branch = json_decode($branch, true);
        $textBranch = '<option value="' . $branch["branchId"] . '">' . $branch["branchName"] . '</option>';
        $textBranch .= '<option value="">Select Branch</option>';
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/company-branch?id=' . $branch["companyId"]);
        $branches = Branch::find()
            ->where(["status" => 1, "companyId" => $branch["companyId"]])
            ->andWhere("branchId!=" . $branch['branchId'])
            ->asArray()
            ->orderBy("branchName")
            ->all();
        if (isset($branches) && count($branches) > 0) {
            foreach ($branches as $b) :
                $textBranch .= '<option value="' . $b["branchId"] . '">' . $b["branchName"] . '</option>';
            endforeach;
        }

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/company-detail?id=' . $branch["companyId"]);
        $company = curl_exec($api);
        $company = json_decode($company, true);

        curl_close($api);
        $res["title"] = $title;
        $res["department"] = $textDepartment;
        $res["branch"] = $textBranch;
        $res["companyId"] = $company["companyId"];
        return json_encode($res);
    }
    public function actionDeleteTitle()
    {
        $titleId = $_POST["titleId"];
        $title = Title::find()->where(["titleId" => $titleId])->one();
        $title->status = 99;
        $res["status"] = false;
        if ($title->save(false)) {
            $res["status"] = true;
        }
        return json_encode($res);
    }
    public function actionSaveUpdateTitle()
    {
        $titleId = $_POST["titleId"];
        $title = Title::find()->where(["titleId" => $titleId])->one();
        $oldDepartmentId = $title->departmentId;
        if ($oldDepartmentId != $_POST["departmentId"]) {
            DepartmentTitle::deleteAll(["titleId" => $titleId, "departmentId" => $oldDepartmentId]);
            $departmentTitle = new DepartmentTitle();
            $departmentTitle->titleId = $titleId;
            $departmentTitle->departmentId = $_POST["departmentId"];
            $departmentTitle->status = 1;
            $departmentTitle->createDateTime = new Expression('NOW()');
            $departmentTitle->updateDateTime = new Expression('NOW()');
            $departmentTitle->save(false);
        }
        $title->titleName = $_POST["titleName"];
        $title->layerId = $_POST["layer"];
        $title->shortTag = $_POST["shortTag"];
        $title->departmentId = $_POST["departmentId"];
        $title->jobDescription = $_POST["jobDescription"];
        $title->status = 1;
        $title->updateDateTime = new Expression('NOW()');
        $title->save(false);
        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/department-detail?id=' . $_POST["departmentId"]);
        $department = curl_exec($api);
        $department = json_decode($department, true);
        curl_close($api);
        $res["textUpdate"] = $this->renderAjax('update_title', [
            "titleName" => $_POST["titleName"],
            "layerName" => Layer::layerName($_POST['layer']),
            "tShort" => $_POST['shortTag'],
            "lShort" => Layer::shortName($_POST['layer']),
            "titleId" => $titleId,
            "departmentName" => Department::departmentNAme($_POST["departmentId"]),
            "branchName" => Branch::branchName($department["branchId"])
        ]);
        return json_encode($res);
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
        if ($departmentId == "") {
            return $this->redirect(Yii::$app->homeUrl . 'setting/title/index');
        } else {
            return $this->redirect(Yii::$app->homeUrl . 'setting/title/search-result/' . ModelMaster::encodeParams([
                "departmentId" => $departmentId
            ]));
        }
    }
    public function actionSearchResult($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $departmentId = $param["departmentId"];
        $group = Group::find()->select('groupId')->where(["status" => 1])->asArray()->one();
        if (!isset($group) && !empty($group)) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group/');
        }
        $groupId = $group["groupId"];

        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/title/search-title-list?departmentId=' . $departmentId);
        $title = curl_exec($api);
        $title = json_decode($title, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/layer/all-layer');
        $layer = curl_exec($api);
        $layer = json_decode($layer, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
        $companies = curl_exec($api);
        $companies = json_decode($companies, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/all-department');
        $departments = curl_exec($api);
        $departments = json_decode($departments, true);

        curl_close($api);
        return $this->render('index', [
            "title" => $title,
            "layer" => $layer,
            "companies" => $companies,
            "departments" => $departments,
            "departmentId" => $departmentId
        ]);
    }
}
