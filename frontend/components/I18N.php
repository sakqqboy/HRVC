<?php

namespace frontend\components;

use Yii;
use yii\i18n\I18N as BaseI18N;

class I18N extends BaseI18N
{
	/**
	 * Override translate() เพื่อทำให้ message key
	 * ไม่สนใจพิมพ์เล็กพิมพ์ใหญ่ (case-insensitive)
	 */
	public function translate($category, $message, $params, $language)
	{
		if (!is_string($message)) {
			return parent::translate($category, $message, $params, $language);
		}

		// resolve ภาษาที่ใช้งานจริง
		$language = $language ?: Yii::$app->language;

		// ภาษาอังกฤษ → ไม่แปลง case
		if (stripos($language, 'en') === 0) {
			return parent::translate($category, $message, $params, $language);
		}

		// ภาษาอื่น → case-insensitive
		return parent::translate(
			$category,
			mb_strtolower($message),
			$params,
			$language
		);
	}
}
