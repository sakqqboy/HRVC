<?php

namespace common/models\hrvc\master;

use Yii;

/**
* This is the model class for table "employee_evaluator".
*
    * @property integer $employeeEvaluatorId
    * @property integer $termId
    * @property integer $employeeId
    * @property integer $primaryId
    * @property integer $finalId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class EmployeeEvaluatorMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'employee_evaluator';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['termId', 'employeeId'], 'required'],
            [['termId', 'employeeId', 'primaryId', 'finalId'], 'integer'],
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
    'employeeEvaluatorId' => 'Employee Evaluator ID',
    'termId' => 'Term ID',
    'employeeId' => 'Employee ID',
    'primaryId' => 'Primary ID',
    'finalId' => 'Final ID',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
