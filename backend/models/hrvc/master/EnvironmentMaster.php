<?php

namespace backend/models\hrvc\master;

use Yii;

/**
* This is the model class for table "environment".
*
    * @property integer $environmentId
    * @property integer $companyId
    * @property integer $branchId
    * @property integer $isAllEmployee
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class EnvironmentMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'environment';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['companyId', 'branchId'], 'required'],
            [['companyId', 'branchId'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['isAllEmployee', 'status'], 'string', 'max' => 10],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'environmentId' => 'Environment ID',
    'companyId' => 'Company ID',
    'branchId' => 'Branch ID',
    'isAllEmployee' => 'Is All Employee',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
