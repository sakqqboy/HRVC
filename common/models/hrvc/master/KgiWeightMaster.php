<?php

namespace common/models\hrvc\master;

use Yii;

/**
* This is the model class for table "kgi_weight".
*
    * @property integer $kgiWeightId
    * @property integer $kgiId
    * @property integer $kgiTeamId
    * @property string $level1
    * @property string $level1End
    * @property string $level2
    * @property string $level2End
    * @property string $level3
    * @property string $level3End
    * @property string $level4
    * @property string $level4End
    * @property string $weight
    * @property integer $termId
    * @property integer $employeeId
    * @property string $result
    * @property string $midComment
    * @property string $primaryComment
    * @property string $firstScore
    * @property string $finalScore
    * @property string $firstComment
    * @property string $finalComment
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class KgiWeightMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'kgi_weight';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['kgiId', 'termId'], 'required'],
            [['kgiId', 'kgiTeamId', 'termId', 'employeeId'], 'integer'],
            [['level1', 'level1End', 'level2', 'level2End', 'level3', 'level3End', 'level4', 'level4End', 'weight', 'result', 'firstScore', 'finalScore'], 'number'],
            [['midComment', 'primaryComment', 'firstComment', 'finalComment'], 'string'],
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
    'kgiWeightId' => 'Kgi Weight ID',
    'kgiId' => 'Kgi ID',
    'kgiTeamId' => 'Kgi Team ID',
    'level1' => 'Level1',
    'level1End' => 'Level1end',
    'level2' => 'Level2',
    'level2End' => 'Level2end',
    'level3' => 'Level3',
    'level3End' => 'Level3end',
    'level4' => 'Level4',
    'level4End' => 'Level4end',
    'weight' => 'Weight',
    'termId' => 'Term ID',
    'employeeId' => 'Employee ID',
    'result' => 'Result',
    'midComment' => 'Mid Comment',
    'primaryComment' => 'Primary Comment',
    'firstScore' => 'First Score',
    'finalScore' => 'Final Score',
    'firstComment' => 'First Comment',
    'finalComment' => 'Final Comment',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
