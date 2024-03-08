<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\GulPostmetaMaster;

/**
* This is the model class for table "gul_postmeta".
*
* @property string $meta_id
* @property string $post_id
* @property string $meta_key
* @property string $meta_value
*/

class GulPostmeta extends \backend\models\hrvc\master\GulPostmetaMaster{
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
