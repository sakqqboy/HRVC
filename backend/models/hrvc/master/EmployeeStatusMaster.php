<?php

namespace backend/models\hrvc\master;

use Yii;

/**
* This is the model class for table "employee_status".
*
    * @property integer $employeeStatusId
    * @property integer $employeeId
    * @property integer $statusId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class EmployeeStatusMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'employee_status';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['employeeId', 'statusId'], 'required'],
            [['employeeId', 'statusId'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['status'], 'string', 'max' => 10],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'employeeStatusId' => 'Employee Status ID',
    'employeeId' => 'Employee ID',
    'statusId' => 'Status ID',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
