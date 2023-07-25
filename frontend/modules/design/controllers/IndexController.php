<?php

namespace frontend\modules\design\controllers;

use yii\web\Controller;

/**
 * Default controller for the `designfront` module
 */
class IndexController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionHome()
    {
        return $this->render('home');
    }
}
