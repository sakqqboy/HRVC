<?php

namespace common\helpers;

use Yii;
use yii\web\Response;

class Athorize
{
	public static function CheckRequest($authHeader)
	{
		if (!$authHeader || $authHeader !== '9f1b3c4d5e6a7b8c9d0e1f2a3b4c5d6e') {
			return 0;
		} else {
			return 1;
		}
	}
}
