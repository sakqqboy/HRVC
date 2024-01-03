<?php

namespace backend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "kpi_group".
*
    * @property integer $kpiGroupId
    * @property string $kpiGroupName
    * @property integer $companyId
    * @property integer $createrId
    * @property string $kpiGroupDetail
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
class KpiGroupMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'kpi_group';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['kpiGroupName', 'companyId', 'createrId'], 'required'],
            [['companyId', 'createrId'], 'integer'],
            [['kpiGroupDetail', 'remark'], 'string'],
            [['target'], 'number'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['kpiGroupName'], 'string', 'max' => 255],
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
    'kpiGroupId' => 'Kpi Group ID',
    'kpiGroupName' => 'Kpi Group Name',
    'companyId' => 'Company ID',
    'createrId' => 'Creater ID',
    'kpiGroupDetail' => 'Kpi Group Detail',
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
