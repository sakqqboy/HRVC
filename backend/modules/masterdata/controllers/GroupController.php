<?php

namespace backend\modules\masterdata\controllers;

use backend\models\hrvc\Company;
use backend\models\hrvc\Country;
use backend\models\hrvc\Employee;
use backend\models\hrvc\Group;
use Exception;
use yii\web\Controller;
use Yii;
use yii\web\Response;

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
    public function beforeAction($action)
    {
        $authHeader = Yii::$app->request->getHeaders()->get('TcgHrvcAuthorization');

        if (!$authHeader || $authHeader !== '9f1b3c4d5e6a7b8c9d0e1f2a3b4c5d6e') {
            Yii::$app->response->format = Response::FORMAT_JSON;
            Yii::$app->response->statusCode = 401;
            Yii::$app->response->data = [
                'status' => 'error',
                'message' => 'Invalid or missing token.'
            ];
            return false;
        }

        return parent::beforeAction($action);
    }
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionGroupDetail($id)
    {
        $group = [];
        $group = Group::find()->where(["groupId" => $id])->asArray()->one();
        if (isset($group) && !empty($group) && $group["director"] != '') {
            $director = Employee::director($group["director"]);
            if (!empty($director)) {
                $group["directorName"] = $director["directorName"];
                $group["directorPicture"] = $director["directorPicture"];
            }
        }
        return json_encode($group);
    }

    public function actionCompanyGroup($id, $page = null, $limit = null)
    {
        // ตั้งค่า default ถ้าไม่ได้ส่งมา
        // $page = isset($page) && is_numeric($page) && $page > 0 ? (int)$page : 1;
        // $limit = isset($limit) && is_numeric($limit) && $limit > 0 ? (int)$limit : 10;

        $offset = ($page - 1) * $limit;

        $companyQuery = Company::find()
            ->select('company.companyName, company.companyId, company.city, c.countryName,
            company.picture, company.headQuaterId, company.industries, g.groupName, c.flag, company.about')
            ->join("LEFT JOIN", "country c", "c.countryId = company.countryId")
            ->join("LEFT JOIN", "`group` g", "g.groupId = company.groupId") // group เป็น reserved word
            ->where(["company.groupId" => $id, "company.status" => 1])
            ->orderBy('company.companyName')
            ->offset($offset)
            ->limit($limit);

        $company = $companyQuery->asArray()->all();

        return json_encode($company);
    }

    public function actionCompanyGroupFilter($id, $countryId, $page, $limit)
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


    public function actionCompanyPage($id, $page, $countryId, $limit)
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
