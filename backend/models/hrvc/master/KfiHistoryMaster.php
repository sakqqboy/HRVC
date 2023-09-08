<?php

namespace backend\models\hrvc\master;

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
    * @property string $quantRatio
    * @property integer $amountType
    * @property string $code
    * @property integer $historyStatus
    * @property string $result
    * @property string $formula
    * @property string $description
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
            [['checkPeriodDate', 'nextCheckDate', 'createDateTime', 'updateDateTime'], 'safe'],
            [['result'], 'number'],
            [['description'], 'string'],
            [['kfiHistoryName', 'formula'], 'string', 'max' => 255],
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
    'quantRatio' => 'Quant Ratio',
    'amountType' => 'Amount Type',
    'code' => 'Code',
    'historyStatus' => 'History Status',
    'result' => 'Result',
    'formula' => 'Formula',
    'description' => 'Description',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
