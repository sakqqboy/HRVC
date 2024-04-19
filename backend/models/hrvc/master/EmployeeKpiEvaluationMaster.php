<?php

namespace backend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "employee_kpi_evaluation".
*
    * @property integer $eKpiId
    * @property integer $mKpiId
    * @property integer $kpiId
    * @property integer $employeeId
    * @property integer $weight
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
            [['mKpiId', 'kpiId', 'employeeId'], 'required'],
            [['mKpiId', 'kpiId', 'employeeId', 'weight'], 'integer'],
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
    'eKpiId' => 'E Kpi ID',
    'mKpiId' => 'M Kpi ID',
    'kpiId' => 'Kpi ID',
    'employeeId' => 'Employee ID',
    'weight' => 'Weight',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
