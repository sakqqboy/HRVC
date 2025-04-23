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
    public function actionIndex($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $companyId = $param["companyId"];
        $group = Group::find()->select('groupId')->where(["status" => 1])->asArray()->one();
        if (!isset($group) && !empty($group)) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group/');
        }

        $company = Company::find()->select('companyId')->where(["status" => 1])->asArray()->one();
        if (!isset($company) && !empty($company)) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/company/company-grid/' . ModelMaster::encodeParams(["groupId" => $group["groupId"]]));
        }

        $branch = Branch::find()->select('branchId')->where(["status" => 1])->asArray()->one();
        if (isset($company) && !empty($company)) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/branch/branch-grid/' . ModelMaster::encodeParams(["companyId" => $company["companyId"]]));
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
            curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/active-branch');
            $branchJson = curl_exec($api);
            $branches = json_decode($branchJson, true);

            $branchess = Branch::find()
                ->where(["status" => 1])
                ->asArray()
                ->all();
        }
        //  throw new Exception(print_r($companies, true));

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $group["groupId"] . '&page=1' . '&limit=0');
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

        if (count($branches) > 0) {
            return $this->render('index', [
                "company" => $company,
                "companies" => $companyGroup,
                "branches" => $branches,
                // "country" => $companyCountry,
                "companyId" => $companyId,
                "totalEmployees" => $totalEmployees,
                "totalDepartment" => $totalDepartment,
                "totalTeam" => $totalTeam,

            ]);
        } else {
            return $this->render('no_branch', [
                "companyId" => $companyId
            ]);
        }
    }

    function actionBranchGrid($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $companyId = $param["companyId"];

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
        
        return $this->render('branch_grid', [
            "companyId" => $companyId,
            "role" => $role
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
            curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/active-branch');
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
    public function actionDeleteBranch()
    {
        $branchId = $_POST["branchId"] - 543;
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
    public function actionUpdateBranch()
    {
        $branchId = $_POST["branchId"] - 543;
        $branch = Branch::find()->where(["branchId" => $branchId])->asArray()->one();
        $res["branchId"] = $branch["branchId"];
        $res["branchName"] = $branch["branchName"];
        $res["description"] = $branch["description"];
        $res["companyId"] = $branch["companyId"];

        return json_encode($res);
    }
    public function actionSaveUpdateBranch()
    {
        $branchId = $_POST["branchId"] - 543;
        $check = Branch::find()
            ->where(["branchName" => $_POST["branchName"], "companyId" => $_POST["companyId"]])
            ->andWhere("branchId!=$branchId")
            ->one();
        if (isset($check) && !empty($check)) {
            $res["status"] = false;
        } else {
            $branch = Branch::find()->where(["branchId" => $branchId])->one();
            $branch->branchName = $_POST["branchName"];
            $branch->description = $_POST["description"];
            $branch->status = 1;
            $branch->updateDateTime = new Expression('NOW()');
            $companyId = $branch->companyId;
            if ($branch->save(false)) {
                $api = curl_init();
                curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
                curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

                curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/company-detail?id=' . $companyId);
                $company = curl_exec($api);
                $company = json_decode($company, true);

                curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/country/country-detail?id=' . $company["countryId"]);
                $resultCountryDetail = curl_exec($api);
                $companyCountry = json_decode($resultCountryDetail, true);
                curl_close($api);

                $newBranch = $this->renderAjax('update', [
                    "branchName" => $_POST["branchName"],
                    "company" => $company,
                    "description" => $_POST["description"],
                    "country" => $companyCountry,
                    "branchId" => $_POST["branchId"]
                ]);
                $res["status"] = true;
                $res["updateBranch"] = $newBranch;
            }
        }
        return json_encode($res);
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