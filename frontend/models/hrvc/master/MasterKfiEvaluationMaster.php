<?php

namespace frontend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "master_kfi_evaluation".
*
    * @property integer $mKfiId
    * @property integer $pimWeightId
    * @property integer $kfiId
    * @property integer $weight
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class MasterKfiEvaluationMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'master_kfi_evaluation';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['pimWeightId', 'kfiId'], 'required'],
            [['pimWeightId', 'kfiId', 'weight'], 'integer'],
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
    'mKfiId' => 'M Kfi ID',
    'pimWeightId' => 'Pim Weight ID',
    'kfiId' => 'Kfi ID',
    'weight' => 'Weight',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
