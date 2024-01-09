<?php

namespace common\models\hrvc\master;

use Yii;

/**
* This is the model class for table "kpi_employee_history".
*
    * @property integer $kpiEmployeeHistoryId
    * @property integer $kpiEmployeeId
    * @property string $target
    * @property string $result
    * @property string $detail
    * @property string $nextCheckDate
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
            [['kpiEmployeeId', 'target', 'result'], 'required'],
            [['kpiEmployeeId'], 'integer'],
            [['target', 'result'], 'number'],
            [['detail'], 'string'],
            [['nextCheckDate', 'lastCheckDate', 'createDateTime', 'updateDateTime'], 'safe'],
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
    'detail' => 'Detail',
    'nextCheckDate' => 'Next Check Date',
    'lastCheckDate' => 'Last Check Date',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
