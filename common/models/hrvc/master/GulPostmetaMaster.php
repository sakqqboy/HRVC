<?php

namespace common/models\hrvc\master;

use Yii;

/**
* This is the model class for table "gul_postmeta".
*
    * @property string $meta_id
    * @property string $post_id
    * @property string $meta_key
    * @property string $meta_value
*/
class GulPostmetaMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'gul_postmeta';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['post_id'], 'integer'],
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
    'post_id' => 'Post ID',
    'meta_key' => 'Meta Key',
    'meta_value' => 'Meta Value',
];
}
}
