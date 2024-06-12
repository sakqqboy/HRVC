<?php

namespace backend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "kfi_weight".
*
    * @property integer $kfiWeightId
    * @property integer $kfiId
    * @property string $level1
    * @property string $level1End
    * @property string $level2
    * @property string $level2End
    * @property string $level3
    * @property string $level3End
    * @property string $level4
    * @property string $level4End
    * @property string $level5
    * @property string $level5End
    * @property string $level6
    * @property integer $level6End
    * @property string $weight
    * @property integer $termId
    * @property integer $employeeId
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
            [['kfiId', 'level6End', 'termId', 'employeeId'], 'integer'],
            [['level1', 'level1End', 'level2', 'level2End', 'level3', 'level3End', 'level4', 'level4End', 'level5', 'level5End', 'level6', 'weight'], 'number'],
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
    'level1End' => 'Level1end',
    'level2' => 'Level2',
    'level2End' => 'Level2end',
    'level3' => 'Level3',
    'level3End' => 'Level3end',
    'level4' => 'Level4',
    'level4End' => 'Level4end',
    'level5' => 'Level5',
    'level5End' => 'Level5end',
    'level6' => 'Level6',
    'level6End' => 'Level6end',
    'weight' => 'Weight',
    'termId' => 'Term ID',
    'employeeId' => 'Employee ID',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
