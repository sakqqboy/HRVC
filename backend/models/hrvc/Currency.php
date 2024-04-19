<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\CurrencyMaster;

/**
 * This is the model class for table "currency".
 *
 * @property integer $currencyId
 * @property string $name
 * @property string $code
 * @property string $symbol
 * @property integer $status
 */

class Currency extends \backend\models\hrvc\master\CurrencyMaster
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), []);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), []);
    }
    public static function currencyName($currencyId)
    {
        $currency = Currency::find()
            ->select('symbol,code')
            ->where(["currencyId" => $currencyId])->asArray()->one();
        $name = [];
        if (isset($currency) && !empty($currency)) {
            $name = [
                "symbol" => $currency["symbol"],
                "code" => $currency["code"]
            ];
        }
        return $name;
    }
}
