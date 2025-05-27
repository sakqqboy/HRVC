<?php

namespace backend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "kgi_has_kpi".
*
    * @property integer $kfiHasKgiId
    * @property integer $kpiId
    * @property integer $kgiId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class KgiHasKpiMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'kgi_has_kpi';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['kpiId', 'kgiId'], 'required'],
            [['kpiId', 'kgiId'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['status'], 'string', 'max' => 20],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'kfiHasKgiId' => 'Kfi Has Kgi ID',
    'kpiId' => 'Kpi ID',
    'kgiId' => 'Kgi ID',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
