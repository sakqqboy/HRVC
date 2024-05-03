<?php

namespace common\models\hrvc\master;

use Yii;

/**
* This is the model class for table "kpi_weight".
*
    * @property integer $kpiWeightId
    * @property integer $kpiId
    * @property string $level1
    * @property string $level2
    * @property string $level3
    * @property string $level4
    * @property string $weight
    * @property integer $termId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class KpiWeightMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'kpi_weight';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['kpiId', 'termId'], 'required'],
            [['kpiId', 'termId'], 'integer'],
            [['level1', 'level2', 'level3', 'level4', 'weight'], 'number'],
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
    'kpiWeightId' => 'Kpi Weight ID',
    'kpiId' => 'Kpi ID',
    'level1' => 'Level1',
    'level2' => 'Level2',
    'level3' => 'Level3',
    'level4' => 'Level4',
    'weight' => 'Weight',
    'termId' => 'Term ID',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
