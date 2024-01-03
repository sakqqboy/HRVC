<?php

namespace common\models\hrvc\master;

use Yii;

/**
* This is the model class for table "kgi_group".
*
    * @property integer $kgiGroupId
    * @property string $kgiGroupName
    * @property integer $companyId
    * @property integer $createrId
    * @property string $kgiGroupDetail
    * @property string $target
    * @property integer $quantRatio
    * @property string $priority
    * @property integer $amountType
    * @property string $month
    * @property string $remark
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class KgiGroupMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'kgi_group';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['kgiGroupName', 'companyId', 'createrId'], 'required'],
            [['companyId', 'createrId'], 'integer'],
            [['kgiGroupDetail', 'remark'], 'string'],
            [['target'], 'number'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['kgiGroupName'], 'string', 'max' => 255],
            [['quantRatio', 'amountType', 'status'], 'string', 'max' => 10],
            [['priority', 'month'], 'string', 'max' => 45],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'kgiGroupId' => 'Kgi Group ID',
    'kgiGroupName' => 'Kgi Group Name',
    'companyId' => 'Company ID',
    'createrId' => 'Creater ID',
    'kgiGroupDetail' => 'Kgi Group Detail',
    'target' => 'Target',
    'quantRatio' => 'Quant Ratio',
    'priority' => 'Priority',
    'amountType' => 'Amount Type',
    'month' => 'Month',
    'remark' => 'Remark',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
