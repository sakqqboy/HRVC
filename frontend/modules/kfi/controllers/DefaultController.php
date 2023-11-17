<?php

namespace frontend\modules\kfi\controllers;

use yii\web\Controller;

/**
 * Default controller for the `kfi` module
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
}
if ($trainTypeId == 1) {
    $trainName = "รถจักร";
}
if ($trainTypeId == 2) {
    $trainName = "รถดีเซลราง";
}
if ($trainTypeId == 3) {
    $trainName = "รถโดยสาร";
}
if ($trainTypeId == 4) {
    $trainName = "รถสินค้า";
}
