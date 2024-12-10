<?php

namespace backend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "pim_weight".
*
    * @property integer $pimWeightId
    * @property integer $kfiWeight
    * @property integer $kgiWeight
    * @property integer $kpiWeight
    * @property integer $termId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class PimWeightMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'pim_weight';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['kfiWeight', 'kgiWeight', 'kpiWeight', 'termId'], 'integer'],
            [['termId'], 'required'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['status'], 'string', 'max' => 4],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'pimWeightId' => 'Pim Weight ID',
    'kfiWeight' => 'Kfi Weight',
    'kgiWeight' => 'Kgi Weight',
    'kpiWeight' => 'Kpi Weight',
    'termId' => 'Term ID',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
