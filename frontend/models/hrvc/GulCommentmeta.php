<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\GulCommentmetaMaster;

/**
* This is the model class for table "gul_commentmeta".
*
* @property string $meta_id
* @property string $comment_id
* @property string $meta_key
* @property string $meta_value
*/

class GulCommentmeta extends \frontend\models\hrvc\master\GulCommentmetaMaster{
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