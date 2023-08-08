<?php

namespace common\models\hrvc\master;

use Yii;

/**
* This is the model class for table "user_role".
*
    * @property integer $userRoleId
    * @property integer $roleId
    * @property integer $userId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class UserRoleMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'user_role';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['roleId', 'userId'], 'required'],
            [['roleId', 'userId'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['status'], 'string', 'max' => 20],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'userRoleId' => 'User Role ID',
    'roleId' => 'Role ID',
    'userId' => 'User ID',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
