<?php

namespace frontend\modules\design\controllers;

use yii\web\Controller;

/**
 * Default controller for the `designfront` module
 */
class EmployeeKgiGridController extends Controller
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