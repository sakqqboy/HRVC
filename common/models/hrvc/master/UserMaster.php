<?php

namespace common/models\hrvc\master;

use Yii;

/**
* This is the model class for table "user".
*
    * @property integer $userId
    * @property string $username
    * @property string $password_hash
    * @property integer $employeeId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class UserMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'user';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['username', 'password_hash', 'employeeId'], 'required'],
            [['employeeId'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['username'], 'string', 'max' => 100],
            [['password_hash'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 10],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'userId' => 'User ID',
    'username' => 'Username',
    'password_hash' => 'Password Hash',
    'employeeId' => 'Employee ID',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
