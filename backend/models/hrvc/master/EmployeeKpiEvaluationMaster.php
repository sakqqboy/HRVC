<?php

namespace backend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "employee_kpi_evaluation".
*
    * @property integer $eKpiId
    * @property integer $kpiWeightId
    * @property integer $employeeId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class EmployeeKpiEvaluationMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'employee_kpi_evaluation';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['kpiWeightId', 'employeeId'], 'required'],
            [['kpiWeightId', 'employeeId'], 'integer'],
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
    'eKpiId' => 'E Kpi ID',
    'kpiWeightId' => 'Kpi Weight ID',
    'employeeId' => 'Employee ID',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
