<?php

namespace backend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "kgi_has_kpi".
*
    * @property integer $kgiHasKpiId
    * @property integer $kgiId
    * @property integer $kpiId
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
            [['kgiId', 'kpiId'], 'required'],
            [['kgiId', 'kpiId'], 'integer'],
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
    'kgiHasKpiId' => 'Kgi Has Kpi ID',
    'kgiId' => 'Kgi ID',
    'kpiId' => 'Kpi ID',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
