<?php

namespace frontend\modules\setting\controllers;

use common\helpers\Path;
use common\models\hrvc\Company;
use common\models\ModelMaster;
use Exception;
use frontend\models\hrvc\Branch;
use frontend\models\hrvc\Department;
use frontend\models\hrvc\DepartmentTitle;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\Layer;
use frontend\models\hrvc\Team;
use frontend\models\hrvc\Title;
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

        $team = Title::find()->select('titleId')->where(["status" => 0])->asArray()->one();
        if (isset($team) && !empty($team)) {
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

        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
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
    public function actionCreate($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $departmentId = $param["departmentId"];
        $branchId = $param["branchId"]?? null;
        $companyId = $param["companyId"] ?? null;
        $groupId = Group::currentGroupId();        // throw new exception(print_r($branchId, true));

        $companyName = '';
        $branchName = '';
        $departmentName = '';

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
            // "companies" => $companies,
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
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
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
    public function actionImport()
    {
        $error = [];
        $isError = 0;
        $correct = [];
        $success = 0;
        $totalError = 0;
        //throw new Exception(print_r(Yii::$app->request->post(), true));
        // if (isset($_POST["employeeFile"])) {

        $imageObj = UploadedFile::getInstanceByName("titleFile");
        if (isset($imageObj) && !empty($imageObj)) {
            $urlFolder = Path::getHost() . 'file/import/title';
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
                                $error[$i] .= '- Title name<br>';
                            }
                            if (trim($data[1]) == "") {
                                $isError = 1;
                                $error[$i] .= '- Please select layer <br>';
                            } else {
                                $layerId = Layer::layerId($data[1]);
                                if ($layerId == "") {
                                    $isError = 1;
                                    $error[$i] .= '- Layer not found, need to contact administrator<br>';
                                }
                            }
                            if (trim($data[2]) == "") {
                                $isError = 1;
                                $error[$i] .= '- Please select department<br>';
                            } else {
                                $departmentId = Department::branchNameWithDepartmentName($data[2]);
                                if ($departmentId == "") {
                                    $isError = 1;
                                    $error[$i] .= '- Department not found, need to contact administrator<br>';
                                }
                            }
                            if ($isError == 0) {
                                $title = new Title();
                                $title->titleName = $data[0];
                                $title->layerId = $layerId;
                                $title->departmentId =  $departmentId;
                                $title->jobDescription = $data[3];
                                $title->status = 1;
                                $title->createDateTime = new Expression('NOW()');
                                $title->updateDateTime = new Expression('NOW()');
                                if ($title->save(false)) {
                                    $success++;
                                    $correct[$i] = [
                                        "name" => $data[0],
                                        "department" => $data[2],
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
        $layers = Layer::find()
            ->select('layerName')
            ->where(["status" => 1])
            ->asArray()
            ->groupBy('layerName')
            ->orderBy('layerName')
            ->all();
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
            "layers" => $layers,
            "departments" => $de,

        ]);
        //throw new exception($htmlExcel);
        $urlFolder = Path::getHost() . 'file/import/title/';
        $fileName = 'title.xlsx';
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
        $clonedWorksheet = clone $spreadsheet1->getSheetByName('title');
        $clonedWorksheet->setTitle('title');
        $spreadsheet->addExternalSheet($clonedWorksheet);

        $fileName = 'Import Title format' . date('Y-m-d');

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