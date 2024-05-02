<?php

namespace backend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "kfi_weight".
*
    * @property integer $kfiWeightId
    * @property integer $kfiId
    * @property string $level1
    * @property string $level2
    * @property string $level3
    * @property string $level4
    * @property string $level5
    * @property string $level6
    * @property string $weight
    * @property integer $termId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class KfiWeightMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'kfi_weight';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['kfiId', 'termId'], 'required'],
            [['kfiId', 'termId'], 'integer'],
            [['level1', 'level2', 'level3', 'level4', 'level5', 'level6', 'weight'], 'number'],
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
    'kfiWeightId' => 'Kfi Weight ID',
    'kfiId' => 'Kfi ID',
    'level1' => 'Level1',
    'level2' => 'Level2',
    'level3' => 'Level3',
    'level4' => 'Level4',
    'level5' => 'Level5',
    'level6' => 'Level6',
    'weight' => 'Weight',
    'termId' => 'Term ID',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
