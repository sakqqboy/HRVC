<?php

namespace backend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "status".
*
    * @property integer $statusId
    * @property string $statusName
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class StatusMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'status';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['statusName'], 'required'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['statusName'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 4],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'statusId' => 'Status ID',
    'statusName' => 'Status Name',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
