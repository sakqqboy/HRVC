<?php


namespace frontend\components;

use yii\i18n\PhpMessageSource;

class CaseInsensitivePhpMessageSource extends PhpMessageSource
{
	protected function loadMessages($category, $language)
	{
		$messages = parent::loadMessages($category, $language);

		if (is_array($messages)) {
			$lower = [];
			foreach ($messages as $key => $value) {
				$lower[mb_strtolower($key)] = $value;
			}
			return $lower;
		}

		return $messages;
	}
}
