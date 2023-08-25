<?php

namespace backend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "employee_condition".
*
    * @property integer $employeeConditionId
    * @property string $employeeConditionName
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class EmployeeConditionMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'employee_condition';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['employeeConditionName'], 'required'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['employeeConditionName'], 'string', 'max' => 45],
            [['status'], 'string', 'max' => 10],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'employeeConditionId' => 'Employee Condition ID',
    'employeeConditionName' => 'Employee Condition Name',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
