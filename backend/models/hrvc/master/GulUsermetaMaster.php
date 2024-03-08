<?php

namespace backend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "gul_usermeta".
*
    * @property string $umeta_id
    * @property string $user_id
    * @property string $meta_key
    * @property string $meta_value
*/
class GulUsermetaMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'gul_usermeta';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['user_id'], 'integer'],
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
    'umeta_id' => 'Umeta ID',
    'user_id' => 'User ID',
    'meta_key' => 'Meta Key',
    'meta_value' => 'Meta Value',
];
}
}
