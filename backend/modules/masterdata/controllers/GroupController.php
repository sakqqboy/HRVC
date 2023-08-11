<?php

namespace backend\modules\masterdata\controllers;

use backend\models\hrvc\Country;
use backend\models\hrvc\Group;
use Exception;
use yii\web\Controller;

/**
 * Default controller for the `masterdata` module
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
    public function actionGroupDetail($id)
    {
        $group = [];
        $group = Group::find()->where(["groupId" => $id])->asArray()->one();
        return json_encode($group);
    }
}
