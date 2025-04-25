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
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
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
    public function actionCompanyGroup($id,$page,$limit)
    {
            
        // $company = Company::find()
        //     ->select('company.companyName,company.companyId,company.city,c.countryName,
        //     company.picture,company.headQuaterId,company.industries,g.groupName,c.flag,company.about')
        //     ->JOIN("LEFT JOIN", "country c", "c.countryId=company.countryId")
        //     ->JOIN("LEFT JOIN", "group g", "g.groupId=company.groupId")
        //     ->where(["company.groupId" => $id, "company.status" => 1])
        //     ->offset($offset)
        //     ->limit($limit)
        //     ->orderBy('company.companyName')
        //     ->asArray()
        //     ->all();

        $offset = ($page - 1) * $limit;
        $companyQuery = Company::find()
            ->select('company.companyName,company.companyId,company.city,c.countryName,
                company.picture,company.headQuaterId,company.industries,g.groupName,c.flag,company.about')
            ->join("LEFT JOIN", "country c", "c.countryId=company.countryId")
            ->join("LEFT JOIN", "`group` g", "g.groupId=company.groupId") // escape 'group' because it's a reserved word
            ->where(["company.groupId" => $id, "company.status" => 1])
            ->orderBy('company.companyName');
        
        if ($limit > 0) {
            $companyQuery->offset($offset)->limit($limit);
        }
        
        $company = $companyQuery->asArray()->all();
        
        return json_encode($company);
    }

    public function actionCompanyGroupFilter($id, $countryId, $page,$limit)
{

    $offset = ($page - 1) * $limit;

    $query = Company::find()
        ->select('company.companyName, company.companyId, company.city, c.countryName,
                  company.picture, company.headQuaterId, company.industries, g.groupName, 
                  c.flag, company.about')
        ->join("LEFT JOIN", "country c", "c.countryId = company.countryId")
        ->join("LEFT JOIN", "`group` g", "g.groupId = company.groupId")
        ->where(["company.groupId" => $id, "company.status" => 1]);

    if (!empty($countryId)) {
        $query->andWhere(["company.countryId" => $countryId]);
    }

    $company = $query
        ->offset($offset)
        ->limit($limit)
        ->orderBy('company.companyName')
        ->asArray()
        ->all();

    return json_encode($company);
}

    
    public function actionCompanyPage($id,$page,$countryId ,$limit)
    {
        // $limit = 6;

        // if($page == 'list'){
        //     $limit = 7;
        // }else{
        //     $limit = 6;
        // }    
        
        $query = Company::find()
            ->where(["company.groupId" => $id, "company.status" => 1]);
    
        if (!empty($countryId)) {
            $query->andWhere(["company.countryId" => $countryId]);
        }
    
        $totalRows = $query->count(); // นับหลังจากใส่เงื่อนไขทั้งหมดแล้ว
    
        $totalPages = ceil($totalRows / $limit);
    
        return json_encode([
            'totalPages' => $totalPages,
            'totalRows' => $totalRows,
            'perPage' => $limit,
            'nowPage' => $page
        ]);
    }
    public function actionCurrentGroup()
    {
        $group = Group::find()->where(["status" => 1])->asArray()->one();
        return json_encode($group);
    }
}