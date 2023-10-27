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

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
        $companies = curl_exec($api);
        $companies = json_decode($companies, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/all-department');
        $departments = curl_exec($api);
        $departments = json_decode($departments, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
        $companies = curl_exec($api);
        $companies = json_decode($companies, true);


        curl_close($api);
        return $this->render('index', [
            "title" => $title,
            "companies" => $companies,
            "departments" => $departments,
        ]);
    }
    public function actionCreate()
    {
        $group = Group::find()->select('groupId')->where(["status" => 1])->asArray()->one();
        if (!isset($group) && !empty($group)) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group/');
        }
        $groupId = $group["groupId"];

        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
        $companies = curl_exec($api);
        $companies = json_decode($companies, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/layer/all-layer');
        $layer = curl_exec($api);
        $layer = json_decode($layer, true);

        curl_close($api);
        return $this->render('create', [
            "companies" => $companies,
            "layer" => $layer,
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
        $title->layerId = $_POST["layer"];
        $title->departmentId = $_POST["departmentId"];
        $title->jobDescription = $_POST["jobDescription"];
        $title->purpose = $_POST["purpose"];
        $title->keyResponsibility = $_POST["keyResponsibility"];
        $title->shortTag = $_POST["shortTag"];
        $title->status = 1;
        $title->createDateTime = new Expression('NOW()');
        $title->updateDateTime = new Expression('NOW()');
        if (isset($_POST["tags"]) && count($_POST["tags"]) > 0) {
            $tags = '';
            foreach ($_POST["tags"] as $tag) :
                $tags .= $tag . ',';
            endforeach;
            if ($tags != '') {
                $tags = substr($tags, 0, -1);
                $title->requireSkill = $tags;
            }
        }
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
    public function actionUpdateTitle($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $titleId = $param["titleId"];
        $groupId = Group::currentGroupId();
        if ($groupId == '') {
            return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group/');
        }

        $titleId = $param["titleId"];
        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/title/title-detail?id=' . $titleId);
        $title = curl_exec($api);
        $title = json_decode($title, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/department-detail?id=' . $title["departmentId"]);
        $department = curl_exec($api);
        $department = json_decode($department, true);

        $departments = Department::find()
            ->select('departmentId,departmentName')
            ->where(["branchId" => $department["branchId"]])
            ->andWhere("departmentId!=" . $department['departmentId'])
            ->asArray()
            ->orderBy("departmentName")
            ->all();

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/branch-detail?id=' . $department["branchId"]);
        $branch = curl_exec($api);
        $branch = json_decode($branch, true);

        $branches = Branch::find()
            ->where(["status" => 1, "companyId" => $branch["companyId"]])
            ->andWhere("branchId!=" . $branch['branchId'])
            ->asArray()
            ->orderBy("branchName")
            ->all();


        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/company-detail?id=' . $branch["companyId"]);
        $company = curl_exec($api);
        $company = json_decode($company, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
        $companies = curl_exec($api);
        $companies = json_decode($companies, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/layer/all-layer');
        $layer = curl_exec($api);
        $layer = json_decode($layer, true);

        curl_close($api);
        $skillArr = [];
        if ($title["requireSkill"] != '') {
            $skillArr = explode(',', $title["requireSkill"]);
        }
        return $this->render('update', [
            "departments" => $departments,
            "branches" => $branches,
            "companies" => $companies,
            "departmentId" => $title["departmentId"],
            "branchId" => $department["branchId"],
            "companyId" => $branch["companyId"],
            "layer" => $layer,
            "title" => $title,
            "skillArr" => $skillArr,
            "preUrl" => Yii::$app->request->referrer
        ]);
    }
    public function actionSaveUpdateTitle()
    {
        $titleId = $_POST["titleId"];
        $title = Title::find()->where(["titleId" => $titleId])->one();
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
        $title->layerId = $_POST["layer"];
        $title->shortTag = $_POST["shortTag"];
        $title->departmentId = $_POST["departmentId"];
        $title->jobDescription = $_POST["jobDescription"];
        $title->purpose = $_POST["purpose"];
        $title->keyResponsibility = $_POST["keyResponsibility"];
        $title->jobDescription = $_POST["jobDescription"];
        $title->status = 1;
        $title->updateDateTime = new Expression('NOW()');
        if (isset($_POST["tags"]) && count($_POST["tags"]) > 0) {
            $tags = '';
            foreach ($_POST["tags"] as $tag) :
                $tags .= $tag . ',';
            endforeach;
            if ($tags != '') {
                $tags = substr($tags, 0, -1);
                $title->requireSkill = $tags;
            } else {
                $title->requireSkill = null;
            }
        } else {
            $title->requireSkill = null;
        }
        $title->save(false);

        return $this->redirect($_POST["preUrl"]);
    }
    public function actionTitleDetail($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, false);
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
    public function actionDeleteTitle()
    {
        $titleId = $_POST["titleId"];
        $title = Title::find()->where(["titleId" => $titleId])->one();
        $title->status = 99;
        $res["status"] = false;
        if ($title->save(false)) {
            $res["status"] = true;
        }
        if ($_POST["redirect"] == 1) {
            // return $this->redirect($_POST["preUrl"]);
            return $this->redirect(Yii::$app->homeUrl . 'setting/title/index');
        }
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
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, false);
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
}
