<?php

namespace frontend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "kfi_history".
*
    * @property integer $kfiHistoryId
    * @property integer $kfiId
    * @property string $kfiHistoryName
    * @property integer $unitId
    * @property string $checkPeriodDate
    * @property string $nextCheckDate
    * @property string $fromDate
    * @property string $toDate
    * @property string $quantRatio
    * @property integer $amountType
    * @property string $code
    * @property integer $historyStatus
    * @property string $result
    * @property string $formular
    * @property string $titleProgress
    * @property string $description
    * @property string $remark
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class KfiHistoryMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'kfi_history';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['kfiId', 'unitId', 'checkPeriodDate', 'nextCheckDate', 'quantRatio', 'amountType', 'code', 'historyStatus'], 'required'],
            [['kfiId'], 'integer'],
            [['checkPeriodDate', 'nextCheckDate', 'fromDate', 'toDate', 'createDateTime', 'updateDateTime'], 'safe'],
            [['result'], 'number'],
            [['description', 'remark'], 'string'],
            [['kfiHistoryName', 'formular', 'titleProgress'], 'string', 'max' => 255],
            [['unitId', 'amountType', 'historyStatus', 'status'], 'string', 'max' => 10],
            [['quantRatio', 'code'], 'string', 'max' => 45],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'kfiHistoryId' => 'Kfi History ID',
    'kfiId' => 'Kfi ID',
    'kfiHistoryName' => 'Kfi History Name',
    'unitId' => 'Unit ID',
    'checkPeriodDate' => 'Check Period Date',
    'nextCheckDate' => 'Next Check Date',
    'fromDate' => 'From Date',
    'toDate' => 'To Date',
    'quantRatio' => 'Quant Ratio',
    'amountType' => 'Amount Type',
    'code' => 'Code',
    'historyStatus' => 'History Status',
    'result' => 'Result',
    'formular' => 'Formular',
    'titleProgress' => 'Title Progress',
    'description' => 'Description',
    'remark' => 'Remark',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
