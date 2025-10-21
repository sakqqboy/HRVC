<?php

namespace common\helpers;

use Exception;
use Yii;

class LanguageSession
{
	public static function userDefaultLanguage()
	{
		$cookie = Yii::$app->request->cookies;
		if (!$cookie->has('language')) {
			$language = $cookie->getValue('language');
		} else {
			$language = "en-US";
		}
	}
}
