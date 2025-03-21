<?php

namespace common\models\hrvc\master;

use Yii;

/**
* This is the model class for table "kgi".
*
    * @property integer $kgiId
    * @property string $kgiName
    * @property integer $companyId
    * @property integer $unitId
    * @property string $periodDate
    * @property string $fromDate
    * @property string $toDate
    * @property integer $active
    * @property string $targetAmount
    * @property string $month
    * @property string $year
    * @property string $kgiDetail
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
class KgiMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'kgi';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['kgiName', 'companyId', 'unitId', 'targetAmount', 'month', 'quantRatio', 'priority', 'amountType', 'code', 'createrId'], 'required'],
            [['companyId', 'unitId', 'createrId'], 'integer'],
            [['periodDate', 'fromDate', 'toDate', 'createDateTime', 'updateDateTime'], 'safe'],
            [['targetAmount', 'result'], 'number'],
            [['kgiDetail'], 'string'],
            [['kgiName'], 'string', 'max' => 255],
            [['active', 'quantRatio', 'amountType', 'status'], 'string', 'max' => 4],
            [['month', 'year', 'priority', 'code'], 'string', 'max' => 45],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'kgiId' => 'Kgi ID',
    'kgiName' => 'Kgi Name',
    'companyId' => 'Company ID',
    'unitId' => 'Unit ID',
    'periodDate' => 'Period Date',
    'fromDate' => 'From Date',
    'toDate' => 'To Date',
    'active' => 'Active',
    'targetAmount' => 'Target Amount',
    'month' => 'Month',
    'year' => 'Year',
    'kgiDetail' => 'Kgi Detail',
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
