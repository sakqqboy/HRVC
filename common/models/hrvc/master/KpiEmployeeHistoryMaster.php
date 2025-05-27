<?php

namespace common/models\hrvc\master;

use Yii;

/**
* This is the model class for table "kpi_employee_history".
*
    * @property integer $kpiEmployeeHistoryId
    * @property integer $kpiEmployeeId
    * @property string $target
    * @property string $result
    * @property string $fromDate
    * @property string $toDate
    * @property string $detail
    * @property integer $createrId
    * @property string $nextCheckDate
    * @property string $month
    * @property string $year
    * @property string $lastCheckDate
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class KpiEmployeeHistoryMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'kpi_employee_history';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['kpiEmployeeId'], 'required'],
            [['kpiEmployeeId', 'createrId'], 'integer'],
            [['target', 'result'], 'number'],
            [['fromDate', 'toDate', 'nextCheckDate', 'lastCheckDate', 'createDateTime', 'updateDateTime'], 'safe'],
            [['detail'], 'string'],
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
    'kpiEmployeeHistoryId' => 'Kpi Employee History ID',
    'kpiEmployeeId' => 'Kpi Employee ID',
    'target' => 'Target',
    'result' => 'Result',
    'fromDate' => 'From Date',
    'toDate' => 'To Date',
    'detail' => 'Detail',
    'createrId' => 'Creater ID',
    'nextCheckDate' => 'Next Check Date',
    'month' => 'Month',
    'year' => 'Year',
    'lastCheckDate' => 'Last Check Date',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
