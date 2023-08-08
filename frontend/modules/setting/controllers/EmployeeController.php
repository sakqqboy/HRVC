<?php

namespace frontend\modules\setting\controllers;

use yii\web\Controller;

/**
 * Default controller for the `setting` module
 */
class EmployeeController extends Controller
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
