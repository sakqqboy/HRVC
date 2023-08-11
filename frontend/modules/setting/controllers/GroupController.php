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
        // $countries = json_decode(Path::Api() . 'masterdata/country/active-country');
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
        return $this->render('group_view');
    }
    public function actionUpdateGroup($hash)
    {
    }
}
