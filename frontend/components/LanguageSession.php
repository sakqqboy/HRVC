<?php

namespace common\helpers;

use Exception;
use Yii;

class LanguageSession
{

	public static function setLanguageSelect($type)
	{
		$session = Yii::$app->session;
		$session->open();
		if (isset(Yii::$app->user->id)) {
			$session->set('currentType', [
				"value" => $type,
			]);
		}
	}
}
