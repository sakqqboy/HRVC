<?php

namespace frontend\modules\kgi\controllers;

use yii\web\Controller;

/**
 * Default controller for the `kgi` module
 */
class ManagementController extends Controller
{
	public function actionIndex()
	{
		return $this->render('index');
	}
	public function actionGrid()
	{
		return $this->render('kgi_grid');
	}
}
