<?php

namespace backend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "kpi".
*
    * @property integer $kpiId
    * @property string $kpiName
    * @property integer $companyId
    * @property integer $unitId
    * @property string $periodDate
    * @property string $targetAmount
    * @property string $month
    * @property string $kpiDetail
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
class KpiMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'kpi';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['kpiName', 'companyId', 'unitId', 'periodDate', 'targetAmount', 'month', 'quantRatio', 'priority', 'amountType', 'code', 'result', 'createrId'], 'required'],
            [['companyId', 'unitId', 'createrId'], 'integer'],
            [['periodDate', 'createDateTime', 'updateDateTime'], 'safe'],
            [['targetAmount', 'result'], 'number'],
            [['kpiDetail'], 'string'],
            [['kpiName'], 'string', 'max' => 255],
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
    'kpiId' => 'Kpi ID',
    'kpiName' => 'Kpi Name',
    'companyId' => 'Company ID',
    'unitId' => 'Unit ID',
    'periodDate' => 'Period Date',
    'targetAmount' => 'Target Amount',
    'month' => 'Month',
    'kpiDetail' => 'Kpi Detail',
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
