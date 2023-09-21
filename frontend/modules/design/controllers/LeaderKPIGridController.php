<?php

namespace frontend\modules\design\controllers;

use yii\web\Controller;

/**
 * Default KpiGridController for the `designfront` module
 */
class LeaderkpiGridController extends Controller
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
