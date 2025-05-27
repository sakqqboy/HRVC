<?php

namespace common/models\hrvc\master;

use Yii;

/**
* This is the model class for table "employee_salary_history".
*
    * @property integer $employeeSalaryHistoryId
    * @property integer $structureId
    * @property integer $employeeId
    * @property integer $value
    * @property integer $round
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class EmployeeSalaryHistoryMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'employee_salary_history';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['structureId', 'value', 'round'], 'required'],
            [['structureId', 'employeeId', 'value'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['round', 'status'], 'string', 'max' => 10],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'employeeSalaryHistoryId' => 'Employee Salary History ID',
    'structureId' => 'Structure ID',
    'employeeId' => 'Employee ID',
    'value' => 'Value',
    'round' => 'Round',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
