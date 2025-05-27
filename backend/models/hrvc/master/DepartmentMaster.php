<?php

namespace backend/models\hrvc\master;

use Yii;

/**
* This is the model class for table "department".
*
    * @property integer $departmentId
    * @property string $departmentName
    * @property integer $branchId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class DepartmentMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'department';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['departmentName', 'branchId'], 'required'],
            [['branchId'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['departmentName'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 10],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'departmentId' => 'Department ID',
    'departmentName' => 'Department Name',
    'branchId' => 'Branch ID',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
