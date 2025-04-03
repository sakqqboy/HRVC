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

    public function actionCompanyId($companyId)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        // รองรับทั้ง GET และ POST
        // $companyId = Yii::$app->request->post("companyId", Yii::$app->request->get("companyId"));

        if (!$companyId) {
            return ["error" => "Missing companyId"];
        }

        return [
            "companyId" => ModelMaster::encodeParams(["companyId" => $companyId])
        ];
    }

}