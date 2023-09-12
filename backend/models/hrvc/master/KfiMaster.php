<?php

namespace backend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "kfi".
*
    * @property integer $kfiId
    * @property string $kfiName
    * @property integer $companyId
    * @property integer $branchId
    * @property integer $unitId
    * @property integer $targetAmount
    * @property string $month
    * @property string $kfiDetail
    * @property integer $createrId
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
            [['kfiName', 'companyId', 'branchId', 'unitId', 'createrId'], 'required'],
            [['companyId', 'branchId', 'unitId', 'targetAmount', 'createrId'], 'integer'],
            [['kfiDetail'], 'string'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['kfiName', 'month'], 'string', 'max' => 45],
            [['status'], 'string', 'max' => 10],
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
    'branchId' => 'Branch ID',
    'unitId' => 'Unit ID',
    'targetAmount' => 'Target Amount',
    'month' => 'Month',
    'kfiDetail' => 'Kfi Detail',
    'createrId' => 'Creater ID',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
