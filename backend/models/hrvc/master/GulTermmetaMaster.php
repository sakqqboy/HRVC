<?php

namespace backend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "gul_termmeta".
*
    * @property string $meta_id
    * @property string $term_id
    * @property string $meta_key
    * @property string $meta_value
*/
class GulTermmetaMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'gul_termmeta';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['term_id'], 'integer'],
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
    'term_id' => 'Term ID',
    'meta_key' => 'Meta Key',
    'meta_value' => 'Meta Value',
];
}
}
