<?php

namespace common/models\hrvc\master;

use Yii;

/**
* This is the model class for table "kfi".
*
    * @property integer $kfiId
    * @property string $kfiName
    * @property integer $companyId
    * @property integer $unitId
    * @property string $targetAmount
    * @property string $month
    * @property string $year
    * @property string $kfiDetail
    * @property integer $createrId
    * @property string $periodDate
    * @property string $fromDate
    * @property string $toDate
    * @property integer $active
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class KfiMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'kfi';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['kfiName', 'companyId', 'unitId', 'createrId'], 'required'],
            [['companyId', 'unitId', 'createrId'], 'integer'],
            [['targetAmount'], 'number'],
            [['kfiDetail'], 'string'],
            [['periodDate', 'fromDate', 'toDate', 'createDateTime', 'updateDateTime'], 'safe'],
            [['kfiName', 'month', 'year'], 'string', 'max' => 45],
            [['active', 'status'], 'string', 'max' => 10],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'kfiId' => 'Kfi ID',
    'kfiName' => 'Kfi Name',
    'companyId' => 'Company ID',
    'unitId' => 'Unit ID',
    'targetAmount' => 'Target Amount',
    'month' => 'Month',
    'year' => 'Year',
    'kfiDetail' => 'Kfi Detail',
    'createrId' => 'Creater ID',
    'periodDate' => 'Period Date',
    'fromDate' => 'From Date',
    'toDate' => 'To Date',
    'active' => 'Active',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
