<?php

namespace frontend\modules\setting\controllers;

use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
use frontend\models\hrvc\Group;
use Yii;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\UploadedFile;

/**
 * Default controller for the `setting` module
 */
class GroupController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionCreateGroup()
    {
        $group = Group::find()->select('groupId')->where(["status" => 1])->asArray()->one();
        if (isset($group) && !empty($group)) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/group/group-view/' . ModelMaster::encodeParams(["groupId" => $group["groupId"]]));
        }
        if (isset($_POST["groupName"]) && trim($_POST["groupName"]) != '') {
            $group = new Group();
            $group->groupName = $_POST["groupName"];
            $group->tagLine = $_POST["tagLine"];
            $group->headQuaterName = $_POST["headQuaterName"];
            $group->displayName = $_POST["displayName"];
            $group->website = $_POST["website"];
            $group->location = $_POST["location"];
            $group->countryId = $_POST["country"];
            $group->city = $_POST["city"];
            $group->postalCode = $_POST["postalCode"];
            $group->industries = $_POST["industries"];
            $group->email = $_POST["email"];
            $group->contact = $_POST["contact"];
            $group->founded = $_POST["founded"];
            $group->director = $_POST["director"];
            $group->socialTag = $_POST["socialTag"];
            $group->about = $_POST["about"];
            $group->status = 1;
            $group->createDateTime = new Expression('NOW()');
            $group->updateDateTime =  new Expression('NOW()');
            $fileBanner = UploadedFile::getInstanceByName("imageUploadBanner");
            if (isset($fileBanner) && !empty($fileBanner)) {
                $path = Path::getHost() . 'images/group/banner/';
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $file = $fileBanner->name;
                $filenameArray = explode('.', $file);
                $countArrayFile = count($filenameArray);
                $fileName = Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[$countArrayFile - 1];
                $pathSave = $path . $fileName;
                $fileBanner->saveAs($pathSave);
                $group->banner = 'images/group/banner/' . $fileName;
            }
            $fileImage = UploadedFile::getInstanceByName("image");
            if (isset($fileImage) && !empty($fileImage)) {
                $path = Path::getHost() . 'images/group/profile/';
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $file = $fileImage->name;
                $filenameArray = explode('.', $file);
                $countArrayFile = count($filenameArray);
                $fileName = Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[$countArrayFile - 1];
                $pathSave = $path . $fileName;
                $fileImage->saveAs($pathSave);
                $group->picture = 'images/group/profile/' . $fileName;
            }
            if ($group->save(false)) {
                $groupId = Yii::$app->db->lastInsertID;
                return $this->redirect(Yii::$app->homeUrl . 'setting/group/group-view/' . ModelMaster::encodeParams(["groupId" => $groupId]));
            }
        }
        //
        $ch1 = curl_init();
        curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch1, CURLOPT_URL, Path::Api() . 'masterdata/country/active-country');
        $result1 = curl_exec($ch1);
        curl_close($ch1);
        $countries = json_decode($result1, true);
        return $this->render('create', [
            "countries" => $countries
        ]);
    }
    public function actionGroupView($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $groupId = $param["groupId"];
        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/group-detail?id=' . $groupId);
        $groupJson = curl_exec($api);
        curl_close($api);
        $group = json_decode($groupJson, true);

        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
        $companyJson = curl_exec($api);
        curl_close($api);
        $companyGroup = json_decode($companyJson, true);
        //throw new exception(print_r($companyGroup, true));


        return $this->render('group_view', [
            "group" => $group,
            "companyGroup" => $companyGroup
        ]);
    }
    public function actionUpdateGroup($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $groupId = $param["groupId"];

        $apiCountry = curl_init();
        curl_setopt($apiCountry, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($apiCountry, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($apiCountry, CURLOPT_URL, Path::Api() . 'masterdata/country/active-country');
        $resultCountry = curl_exec($apiCountry);
        $countries = json_decode($resultCountry, true);
        curl_close($apiCountry);

        $apiGroup = curl_init();
        curl_setopt($apiGroup, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($apiGroup, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($apiGroup, CURLOPT_URL, Path::Api() . 'masterdata/group/group-detail?id=' . $groupId);
        $groupJson = curl_exec($apiGroup);
        $group = json_decode($groupJson, true);
        curl_close($apiGroup);

        $apiCountry = curl_init();
        curl_setopt($apiCountry, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($apiCountry, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($apiCountry, CURLOPT_URL, Path::Api() . 'masterdata/country/country-detail?id=' . $group["countryId"]);
        $resultCountryDetail = curl_exec($apiCountry);
        $groupCountry = json_decode($resultCountryDetail, true);
        curl_close($apiCountry);
        return $this->render('update_group', [
            "countries" => $countries,
            "group" => $group,
            "groupCountry" => $groupCountry
        ]);
    }
    public function actionSaveUpdateGroup()
    {
        if (isset($_POST["groupName"]) && trim($_POST["groupName"]) != '') {
            $group = Group::find()->where(["groupId" => $_POST["groupId"] - 543])->one();
            $oldBanner = $group->banner;
            $oldImage = $group->picture;
            $group->groupName = $_POST["groupName"];
            $group->tagLine = $_POST["tagLine"];
            $group->headQuaterName = $_POST["headQuaterName"];
            $group->displayName = $_POST["displayName"];
            $group->website = $_POST["website"];
            $group->location = $_POST["location"];
            $group->countryId = $_POST["country"];
            $group->city = $_POST["city"];
            $group->postalCode = $_POST["postalCode"];
            $group->industries = $_POST["industries"];
            $group->email = $_POST["email"];
            $group->contact = $_POST["contact"];
            $group->founded = $_POST["founded"];
            $group->director = $_POST["director"];
            $group->socialTag = $_POST["socialTag"];
            $group->about = $_POST["about"];
            $group->status = 1;
            $group->updateDateTime =  new Expression('NOW()');
            $fileBanner = UploadedFile::getInstanceByName("imageUploadBanner");
            if (isset($fileBanner) && !empty($fileBanner)) {
                $path = Path::getHost() . 'images/group/banner/';
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $oldPathBanner = Path::getHost() . $oldBanner;
                if (file_exists($oldPathBanner)) {
                    unlink($oldPathBanner);
                }
                $file = $fileBanner->name;
                $filenameArray = explode('.', $file);
                $countArrayFile = count($filenameArray);
                $fileName = Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[$countArrayFile - 1];
                $pathSave = $path . $fileName;
                $fileBanner->saveAs($pathSave);
                $group->banner = 'images/group/banner/' . $fileName;
            }
            $fileImage = UploadedFile::getInstanceByName("image");
            if (isset($fileImage) && !empty($fileImage)) {
                $path = Path::getHost() . 'images/group/profile/';
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $oldPathPicture = Path::getHost() . $oldImage;
                if (file_exists($oldPathPicture)) {
                    unlink($oldPathPicture);
                }
                $file = $fileImage->name;
                $filenameArray = explode('.', $file);
                $countArrayFile = count($filenameArray);
                $fileName = Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[$countArrayFile - 1];
                $pathSave = $path . $fileName;
                $fileImage->saveAs($pathSave);
                $group->picture = 'images/group/profile/' . $fileName;
            }
            if ($group->save(false)) {
                $groupId = $_POST["groupId"] - 543;
                return $this->redirect(Yii::$app->homeUrl . 'setting/group/group-view/' . ModelMaster::encodeParams(["groupId" => $groupId]));
            }
        }
    }
    public function actionFontSize()
    {
        $myfile = fopen(Path::urlUpload() . "css/layout/font.css", "w");
        $i = 10;
        $text = '';
        while ($i <= 100) {
            $text .= ".font-size-" . $i . "{font-size:" . $i . "px;}";
            $i++;
        }
        fwrite($myfile, $text);
        fclose($myfile);
    }
    public function actionLayout()
    {
        $myfile = fopen(Path::urlUpload() . "css/layout/layout.css", "w");
        $i = 0;
        $a = 1;
        $text = '';
        while ($a <= 8) {
            if ($i < 6) {
                $important = " !important";
            } else {
                $important = '';
            }
            if ($a == 1) {
                $text .= ".pt-" . $i . "{padding-top:" . $i . "px" . $important . ";}";
            }
            if ($a == 2) {
                $text .= ".pb-" . $i . "{padding-bottom:" . $i . "px" . $important . ";}";
            }
            if ($a == 3) {
                $text .= ".pl-" . $i . "{padding-left:" . $i . "px" . $important . ";}";
            }
            if ($a == 4) {
                $text .= ".pr-" . $i . "{padding-right:" . $i . "px" . $important . ";}";
            }
            if ($a == 5) {
                $text .= ".mt-" . $i . "{margin-top:" . $i . "px" . $important . ";}";
            }
            if ($a == 6) {
                $text .= ".mb-" . $i . "{margin-bottom:" . $i . "px" . $important . ";}";
            }
            if ($a == 7) {
                $text .= ".ml-" . $i . "{margin-left:" . $i . "px" . $important . ";}";
            }
            if ($a == 8) {
                $text .= ".mr-" . $i . "{margin-right:" . $i . "px" . $important . ";}";
            }
            $i++;
            if ($i > 100) {
                $a++;
                $i = 0;
            }
        }
        $text .= ".no-underline {text-decoration: none;}";
        fwrite($myfile, $text);
        fclose($myfile);
    }
}