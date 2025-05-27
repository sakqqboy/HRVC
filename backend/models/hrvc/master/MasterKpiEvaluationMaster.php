<?php

namespace backend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "master_kpi_evaluation".
*
    * @property integer $mKpiId
    * @property integer $pimWeight
    * @property integer $kpiId
    * @property integer $weight
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class MasterKpiEvaluationMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'master_kpi_evaluation';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['pimWeight', 'kpiId'], 'required'],
            [['pimWeight', 'kpiId', 'weight'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['status'], 'string', 'max' => 10],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'mKpiId' => 'M Kpi ID',
    'pimWeight' => 'Pim Weight',
    'kpiId' => 'Kpi ID',
    'weight' => 'Weight',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
