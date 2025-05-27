<?php

namespace common\models\hrvc\master;

use Yii;

/**
* This is the model class for table "employee_salary".
*
    * @property integer $employeeSalaryId
    * @property integer $employeeId
    * @property integer $structureId
    * @property integer $value
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class EmployeeSalaryMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'employee_salary';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['employeeId', 'structureId', 'value'], 'required'],
            [['employeeId', 'structureId', 'value'], 'integer'],
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
    'employeeSalaryId' => 'Employee Salary ID',
    'employeeId' => 'Employee ID',
    'structureId' => 'Structure ID',
    'value' => 'Value',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
