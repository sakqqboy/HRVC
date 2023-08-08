<?php

namespace backend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "user".
*
    * @property integer $userId
    * @property string $userName
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
            [['userName', 'password_hash', 'employeeId'], 'required'],
            [['employeeId'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['userName'], 'string', 'max' => 100],
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
    'userName' => 'User Name',
    'password_hash' => 'Password Hash',
    'employeeId' => 'Employee ID',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
