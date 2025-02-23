<?php

namespace common\models\hrvc\master;

use Yii;

/**
* This is the model class for table "gul_users".
*
    * @property string $ID
    * @property string $user_login
    * @property string $user_pass
    * @property string $user_nicename
    * @property string $user_email
    * @property string $user_url
    * @property string $user_registered
    * @property string $user_activation_key
    * @property integer $user_status
    * @property string $display_name
*/
class GulUsersMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'gul_users';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['user_registered'], 'safe'],
            [['user_status'], 'integer'],
            [['user_login'], 'string', 'max' => 60],
            [['user_pass', 'user_activation_key'], 'string', 'max' => 255],
            [['user_nicename'], 'string', 'max' => 50],
            [['user_email', 'user_url'], 'string', 'max' => 100],
            [['display_name'], 'string', 'max' => 250],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'ID' => 'ID',
    'user_login' => 'User Login',
    'user_pass' => 'User Pass',
    'user_nicename' => 'User Nicename',
    'user_email' => 'User Email',
    'user_url' => 'User Url',
    'user_registered' => 'User Registered',
    'user_activation_key' => 'User Activation Key',
    'user_status' => 'User Status',
    'display_name' => 'Display Name',
];
}
}
