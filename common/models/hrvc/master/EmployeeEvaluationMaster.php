<?php

namespace common\models\hrvc\master;

use Yii;

/**
* This is the model class for table "employee_evaluation".
*
    * @property integer $employeeEvaluationId
    * @property integer $employeeId
    * @property integer $pimWeightId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class EmployeeEvaluationMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'employee_evaluation';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['employeeId', 'pimWeightId'], 'required'],
            [['employeeId', 'pimWeightId'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['status'], 'string', 'max' => 4],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'employeeEvaluationId' => 'Employee Evaluation ID',
    'employeeId' => 'Employee ID',
    'pimWeightId' => 'Pim Weight ID',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
