<?php

namespace common\models\hrvc\master;

use Yii;

/**
* This is the model class for table "kpi_history".
*
    * @property integer $kpiHistoryId
    * @property integer $kpiId
    * @property string $kpiHistoryName
    * @property integer $unitId
    * @property string $periodDate
    * @property string $fromDate
    * @property string $toDate
    * @property string $nextCheckDate
    * @property string $targetAmount
    * @property string $month
    * @property string $titleProcess
    * @property string $description
    * @property string $remark
    * @property integer $quantRatio
    * @property string $priority
    * @property integer $amountType
    * @property string $code
    * @property string $result
    * @property integer $createrId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class KpiHistoryMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'kpi_history';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['kpiId', 'kpiHistoryName', 'unitId', 'periodDate', 'nextCheckDate', 'targetAmount', 'month', 'titleProcess', 'quantRatio', 'priority', 'amountType', 'code', 'result', 'createrId'], 'required'],
            [['kpiId', 'unitId', 'createrId'], 'integer'],
            [['periodDate', 'fromDate', 'toDate', 'nextCheckDate', 'createDateTime', 'updateDateTime'], 'safe'],
            [['targetAmount', 'result'], 'number'],
            [['description', 'remark'], 'string'],
            [['kpiHistoryName', 'titleProcess'], 'string', 'max' => 255],
            [['month', 'priority', 'code'], 'string', 'max' => 45],
            [['quantRatio', 'amountType', 'status'], 'string', 'max' => 10],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'kpiHistoryId' => 'Kpi History ID',
    'kpiId' => 'Kpi ID',
    'kpiHistoryName' => 'Kpi History Name',
    'unitId' => 'Unit ID',
    'periodDate' => 'Period Date',
    'fromDate' => 'From Date',
    'toDate' => 'To Date',
    'nextCheckDate' => 'Next Check Date',
    'targetAmount' => 'Target Amount',
    'month' => 'Month',
    'titleProcess' => 'Title Process',
    'description' => 'Description',
    'remark' => 'Remark',
    'quantRatio' => 'Quant Ratio',
    'priority' => 'Priority',
    'amountType' => 'Amount Type',
    'code' => 'Code',
    'result' => 'Result',
    'createrId' => 'Creater ID',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
