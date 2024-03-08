<?php

namespace common\models\hrvc\master;

use Yii;

/**
* This is the model class for table "gul_sgs_log_visitors".
*
    * @property integer $id
    * @property string $ip
    * @property integer $user_id
    * @property integer $block
    * @property integer $blocked_on
*/
class GulSgsLogVisitorsMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'gul_sgs_log_visitors';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['user_id', 'block', 'blocked_on'], 'integer'],
            [['ip'], 'string', 'max' => 55],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'id' => 'ID',
    'ip' => 'Ip',
    'user_id' => 'User ID',
    'block' => 'Block',
    'blocked_on' => 'Blocked On',
];
}
}
