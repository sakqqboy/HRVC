<?php

namespace common\models\hrvc;

use Yii;
use \common\models\hrvc\master\GulOptionsMaster;

/**
* This is the model class for table "gul_options".
*
* @property string $option_id
* @property string $option_name
* @property string $option_value
* @property string $autoload
*/

class GulOptions extends \common\models\hrvc\master\GulOptionsMaster{
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