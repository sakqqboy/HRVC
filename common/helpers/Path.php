<?php

namespace common\helpers;

use Yii;

class Path
{
	public static function getHost()
	{
		if ($_SERVER['HTTP_HOST'] == "localhost") {
			$folderImage = Yii::$app->getBasePath() . '/' . 'web/';
		} else {
			$folderImage = '';
		}
		return $folderImage;
	}

	public static function urlUpload()
	{
		if ($_SERVER['HTTP_HOST'] == "localhost") {
			$url = Yii::$app->getBasePath() . '/' . 'web/';
		} else {
			$url = '';
		}
		return $url;
	}
	public static function frontendUrl()
	{
		if ($_SERVER['HTTP_HOST'] == "localhost") {
			$url = 'http://localhost/HEVC/frontend/web/';
		} else {
			$url = 'https://tcg-management-system.com/';
		}
		return $url;
	}
	public static function Api()
	{
		if ($_SERVER['HTTP_HOST'] == "localhost") {
			$url = 'http://localhost/HRVC/backend/web/';
		} else {
			$url = 'https://api.tcg-hrvc-system.com/';
		}
		return $url;
	}
}
