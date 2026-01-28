<?php

namespace frontend\components;

use Yii;
use yii\i18n\DbMessageSource;

class DbCaseInsensitiveMessageSource extends DbMessageSource
{
	protected function loadMessages($category, $language)
	{
		$cacheKey = "i18n:{$category}:{$language}";

		return Yii::$app->cache->getOrSet($cacheKey, function () use ($category, $language) {
			$messages = parent::loadMessages($category, $language);

			if (!is_array($messages)) {
				return $messages;
			}

			$lower = [];
			foreach ($messages as $key => $value) {
				$lower[mb_strtolower($key)] = $value;
			}

			return $lower;
		}, 3600); // cache 1 ชั่วโมง
	}
}
