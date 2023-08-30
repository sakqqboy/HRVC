<?php

namespace backend\modules\masterdata\controllers;

use backend\models\hrvc\Company;
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
    public function actionCompanyGroup($id)
    {
        $company = [];
        $company = Company::find()
            ->select('company.companyName,company.companyId,company.city,c.countryName,
            company.picture,company.headQuaterId,company.industries,g.groupName,c.flag,company.about')
            ->JOIN("LEFT JOIN", "country c", "c.countryId=company.countryId")
            ->JOIN("LEFT JOIN", "group g", "g.groupId=company.groupId")
            ->where(["company.groupId" => $id, "company.status" => 1])
            ->orderBy('company.companyName')
            ->asArray()
            ->all();
        return json_encode($company);
    }
}
