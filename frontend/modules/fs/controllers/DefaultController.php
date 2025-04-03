<?php

namespace frontend\modules\fs\controllers;

use common\models\ModelMaster;
use Yii;
use yii\web\Controller;
use yii\web\Response;

/**
 * Default controller for the `fs` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    // public function actionCompanyId()
    // {
    //     Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    
    //     // รับค่า companyId จาก POST
    //     $companyId = Yii::$app->request->post("companyId", Yii::$app->request->get("companyId"));
    
    //     if (!$companyId) {
    //         return ["error" => "Missing companyId"];
    //     }
    
    //     return [
    //         "companyId" => ModelMaster::encodeParams(["companyId" => $companyId])
    //     ];
    // }
    public function actionCompanyId($companyId)
{
    Yii::$app->response->format = Response::FORMAT_JSON; // ✅ กำหนด Format เป็น JSON

    if (!$companyId) {
        return $this->asJson(["error" => "Missing companyId"]); // ✅ ใช้ `asJson()` เพื่อป้องกัน Error
    }
    // return $this->asJson(["companyId" => ModelMaster::encodeParams(["companyId" => $companyId])]); // ✅ ส่ง JSON response ที่ถูกต้อง

    return $this->asJson(["companyId" => $companyId]); // ✅ ส่ง JSON response ที่ถูกต้อง
}

    

}