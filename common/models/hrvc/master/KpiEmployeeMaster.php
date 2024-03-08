<?php

namespace common\models\hrvc\master;

use Yii;

/**
* This is the model class for table "kpi_employee".
*
    * @property integer $kpiEmployeeId
    * @property integer $employeeId
    * @property integer $kpiId
    * @property string $target
    * @property string $result
    * @property string $fromDate
    * @property string $toDate
    * @property string $nextCheckDate
    * @property string $month
    * @property string $year
    * @property integer $createrId
    * @property string $remark
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class KpiEmployeeMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'kpi_employee';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['employeeId', 'kpiId'], 'required'],
            [['employeeId', 'kpiId', 'createrId'], 'integer'],
            [['target', 'result'], 'number'],
            [['fromDate', 'toDate', 'nextCheckDate', 'createDateTime', 'updateDateTime'], 'safe'],
            [['remark'], 'string'],
            [['month', 'year'], 'string', 'max' => 45],
            [['status'], 'string', 'max' => 10],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'kpiEmployeeId' => 'Kpi Employee ID',
    'employeeId' => 'Employee ID',
    'kpiId' => 'Kpi ID',
    'target' => 'Target',
    'result' => 'Result',
    'fromDate' => 'From Date',
    'toDate' => 'To Date',
    'nextCheckDate' => 'Next Check Date',
    'month' => 'Month',
    'year' => 'Year',
    'createrId' => 'Creater ID',
    'remark' => 'Remark',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
