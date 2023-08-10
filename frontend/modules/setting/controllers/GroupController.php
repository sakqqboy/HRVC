<?php

namespace frontend\modules\setting\controllers;

use common\models\ModelMaster;
use frontend\models\hrvc\Group;
use Yii;
use yii\web\Controller;

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
            $group->website = $_POST["website"];
            $group->location = $_POST["location"];
            $group->countryId = $_POST["countryId"];
            $group->city = $_POST["city"];
            $group->postalCode = $_POST["postalCode"];
            $group->industries = $_POST["industries"];
            $group->email = $_POST["email"];
            $group->contact = $_POST["contact"];
            $group->founded = $_POST["founded"];
            $group->director = $_POST["director"];
            $group->socialTag = $_POST["socialTag"];
            $group->about = $_POST["about"];
            $group->status = $_POST["status"];
            $group->createDateTime = $_POST["createDateTime"];
            $group->updateDateTime = $_POST["updateDateTime"];
            if ($group->save(false)) {
                $groupId = Yii::$app->db->lastInsertID;
                return $this->redirect(Yii::$app->homeUrl . 'setting/group/group-view/' . ModelMaster::encodeParams(["groupId" => $groupId]));
            }
        }
        return $this->render('create');
    }
    public function actionUploadBanner()
    {
    }
    public function actionUploadImage()
    {
    }
}
