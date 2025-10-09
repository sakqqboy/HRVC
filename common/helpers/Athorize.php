<?php

namespace common\helpers;

use Yii;
use yii\web\Response;

header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
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
