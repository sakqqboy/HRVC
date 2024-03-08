<?php

namespace frontend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "kgi_history".
*
    * @property integer $kgiHistoryId
    * @property integer $kgiId
    * @property string $kgiHistoryName
    * @property integer $unitId
    * @property string $periodDate
    * @property string $fromDate
    * @property string $toDate
    * @property string $nextCheckDate
    * @property string $targetAmount
    * @property string $month
    * @property string $year
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
class KgiHistoryMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'kgi_history';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['kgiId', 'unitId', 'nextCheckDate', 'targetAmount', 'month', 'quantRatio', 'priority', 'amountType', 'code', 'result', 'createrId'], 'required'],
            [['kgiId', 'unitId', 'createrId'], 'integer'],
            [['periodDate', 'fromDate', 'toDate', 'nextCheckDate', 'createDateTime', 'updateDateTime'], 'safe'],
            [['targetAmount', 'result'], 'number'],
            [['description', 'remark'], 'string'],
            [['kgiHistoryName', 'titleProcess'], 'string', 'max' => 255],
            [['month', 'year', 'priority', 'code'], 'string', 'max' => 45],
            [['quantRatio', 'amountType', 'status'], 'string', 'max' => 10],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'kgiHistoryId' => 'Kgi History ID',
    'kgiId' => 'Kgi ID',
    'kgiHistoryName' => 'Kgi History Name',
    'unitId' => 'Unit ID',
    'periodDate' => 'Period Date',
    'fromDate' => 'From Date',
    'toDate' => 'To Date',
    'nextCheckDate' => 'Next Check Date',
    'targetAmount' => 'Target Amount',
    'month' => 'Month',
    'year' => 'Year',
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
