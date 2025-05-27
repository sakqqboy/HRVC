<?php

namespace backend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "user_access".
*
    * @property integer $acessId
    * @property integer $userId
    * @property integer $moduleId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class UserAccessMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'user_access';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['userId', 'moduleId'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['status'], 'string', 'max' => 255],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'acessId' => 'Acess ID',
    'userId' => 'User ID',
    'moduleId' => 'Module ID',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
