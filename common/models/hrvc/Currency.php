<?php

namespace common\models\hrvc;

use Yii;
use \common\models\hrvc\master\CurrencyMaster;

/**
* This is the model class for table "currency".
*
* @property integer $currencyId
* @property string $name
* @property string $code
* @property string $symbol
* @property integer $status
*/

class Currency extends \common\models\hrvc\master\CurrencyMaster{
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
}
