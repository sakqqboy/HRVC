<?php

namespace common\models\hrvc\master;

use Yii;

/**
* This is the model class for table "gul_commentmeta".
*
    * @property string $meta_id
    * @property string $comment_id
    * @property string $meta_key
    * @property string $meta_value
*/
class GulCommentmetaMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'gul_commentmeta';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['comment_id'], 'integer'],
            [['meta_value'], 'string'],
            [['meta_key'], 'string', 'max' => 255],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'meta_id' => 'Meta ID',
    'comment_id' => 'Comment ID',
    'meta_key' => 'Meta Key',
    'meta_value' => 'Meta Value',
];
}
}
