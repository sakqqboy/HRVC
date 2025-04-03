<?php

namespace frontend\modules\fs\controllers;

use common\helpers\Path;
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
    public function actionFsMenu($id, $menu)
    {
        // Yii::$app->response->format = Response::FORMAT_JSON; // ✅ กำหนด Format เป็น JSON


        // return $this->asJson(["companyId" => ModelMaster::encodeParams(["companyId" => $companyId])]); // ✅ ส่ง JSON response ที่ถูกต้อง
        if ($menu == 'branch') {
            return $this->redirect(Path::frontendUrl() . 'setting/branch/create/' . ModelMaster::encodeParams(["companyId" => '']));
        }
        if ($menu == 'company') {
            //return $this->asJson(["error" => "Missing companyId"]); // ✅ ใช้ `asJson()` เพื่อป้องกัน Error
        }
    }
}
