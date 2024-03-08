<?php

namespace common\models\hrvc;

use Yii;
use \common\models\hrvc\master\GulUsermetaMaster;

/**
* This is the model class for table "gul_usermeta".
*
* @property string $umeta_id
* @property string $user_id
* @property string $meta_key
* @property string $meta_value
*/

class GulUsermeta extends \common\models\hrvc\master\GulUsermetaMaster{
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
