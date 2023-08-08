<?php

namespace common\models\hrvc\master;

use Yii;

/**
* This is the model class for table "role".
*
    * @property integer $roleId
    * @property string $roleName
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class RoleMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'role';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['roleName'], 'required'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['roleName'], 'string', 'max' => 100],
            [['status'], 'string', 'max' => 10],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'roleId' => 'Role ID',
    'roleName' => 'Role Name',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
