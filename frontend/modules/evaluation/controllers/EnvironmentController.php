<?php

namespace frontend\modules\evaluation\controllers;

use Yii;
use yii\web\Controller;

class EnvironmentController extends Controller
{
	public function beforeAction($action)
	{
		if (!Yii::$app->user->id) {
			return $this->redirect(Yii::$app->homeUrl . 'site/login');
		}
		return true; //go to origin request
	}
	public function actionIndex()
	{
		return $this->render('index');
	}
}
