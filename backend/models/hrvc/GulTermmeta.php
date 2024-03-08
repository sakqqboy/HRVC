<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\GulTermmetaMaster;

/**
* This is the model class for table "gul_termmeta".
*
* @property string $meta_id
* @property string $term_id
* @property string $meta_key
* @property string $meta_value
*/

class GulTermmeta extends \backend\models\hrvc\master\GulTermmetaMaster{
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
