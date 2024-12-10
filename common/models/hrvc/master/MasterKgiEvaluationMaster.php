<?php

namespace common\models\hrvc\master;

use Yii;

/**
* This is the model class for table "master_kgi_evaluation".
*
    * @property integer $mKgiId
    * @property integer $pimWeightId
    * @property integer $kgiId
    * @property integer $weight
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class MasterKgiEvaluationMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'master_kgi_evaluation';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['pimWeightId', 'kgiId'], 'required'],
            [['pimWeightId', 'kgiId', 'weight'], 'integer'],
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
    'mKgiId' => 'M Kgi ID',
    'pimWeightId' => 'Pim Weight ID',
    'kgiId' => 'Kgi ID',
    'weight' => 'Weight',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
