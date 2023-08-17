<?php

namespace frontend\modules\setting\controllers;

use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
use frontend\models\hrvc\Branch;
use Yii;
use yii\db\Expression;
use yii\web\Controller;

/**
 * Default controller for the `setting` module
 */
class BranchController extends Controller
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
        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/company-detail?id=' . $companyId);
        $company = curl_exec($api);
        $company = json_decode($company, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $company["groupId"]);
        $companyJson = curl_exec($api);
        $companyGroup = json_decode($companyJson, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/company-branch?id=' . $companyId);
        $branchJson = curl_exec($api);
        $branches = json_decode($branchJson, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/country/country-detail?id=' . $company["countryId"]);
        $resultCountryDetail = curl_exec($api);
        $companyCountry = json_decode($resultCountryDetail, true);
        // throw new Exception(print_r($companyCountry, true));
        curl_close($api);

        return $this->render('create', [
            "company" => $company,
            "companies" => $companyGroup,
            "branches" => $branches,
            "country" => $companyCountry
        ]);
    }
    public function actionSaveCreateBranch()
    {
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
                $branchId = Yii::$app->db->lastInsertID + 543;
                $api = curl_init();
                curl_setopt($api, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/company-detail?id=' . $_POST["companyId"]);
                $company = curl_exec($api);
                $company = json_decode($company, true);

                curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/country/country-detail?id=' . $company["countryId"]);
                $resultCountryDetail = curl_exec($api);
                $companyCountry = json_decode($resultCountryDetail, true);
                curl_close($api);

                $newBranch = $this->renderAjax('new_branch', [
                    "branchName" => $_POST["branchName"],
                    "company" => $company,
                    "description" => $_POST["description"],
                    "country" => $companyCountry,
                    "branchId" => $branchId
                ]);
                $res["status"] = true;
                $res["newBranch"] = $newBranch;
            }
        }
        return json_encode($res);
    }
    public function actionDeleteBranch()
    {
        $branchId = $_POST["branchId"] - 543;
        $branch = Branch::find()->where(["branchId" => $branchId])->one();
        $branch->status = 99;

        if ($branch->save(false)) {
            $res["status"] = true;
        } else {
            $res["status"] = false;
        }
        return json_encode($res);
    }
    public function actionUpdateBranch()
    {
        $branchId = $_POST["branchId"] - 543;
        $branch = Branch::find()->where(["branchId" => $branchId])->asArray()->one();
        $res["branchId"] = $branch["branchId"];
        $res["branchName"] = $branch["branchName"];
        $res["description"] = $branch["description"];

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
                curl_setopt($api, CURLOPT_SSL_VERIFYPEER, false);
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
}
