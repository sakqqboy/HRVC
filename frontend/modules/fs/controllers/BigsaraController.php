<?php

namespace frontend\modules\fs\controllers;

use yii\web\Controller;

/**
 * Default controller for the `fs` module
 */
class BigsaraController extends Controller
{
	/**
	 * Renders the index view for the module
	 * @return string
	 */
	public function actionIndex()
	{
		return $this->render('index2');
	}
}
