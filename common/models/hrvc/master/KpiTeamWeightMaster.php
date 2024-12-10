<?php

namespace common\models\hrvc\master;

use Yii;

/**
* This is the model class for table "kpi_team_weight".
*
    * @property integer $kpiTeamWeightId
    * @property integer $kpiTeamId
    * @property integer $kpiId
    * @property integer $termId
    * @property integer $employeeId
    * @property string $result
    * @property string $midComment
    * @property string $primaryComment
    * @property string $firstScore
    * @property string $finalScore
    * @property string $firstComment
    * @property string $finalComment
    * @property string $level1
    * @property string $level1End
    * @property string $level2
    * @property string $level2End
    * @property string $level3
    * @property string $level3End
    * @property string $level4
    * @property string $level4End
    * @property string $weight
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class KpiTeamWeightMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'kpi_team_weight';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['kpiTeamId', 'kpiId', 'termId'], 'required'],
            [['kpiTeamId', 'kpiId', 'termId', 'employeeId'], 'integer'],
            [['result', 'firstScore', 'finalScore', 'level1', 'level1End', 'level2', 'level2End', 'level3', 'level3End', 'level4', 'level4End', 'weight'], 'number'],
            [['midComment', 'primaryComment', 'firstComment', 'finalComment'], 'string'],
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
    'kpiTeamWeightId' => 'Kpi Team Weight ID',
    'kpiTeamId' => 'Kpi Team ID',
    'kpiId' => 'Kpi ID',
    'termId' => 'Term ID',
    'employeeId' => 'Employee ID',
    'result' => 'Result',
    'midComment' => 'Mid Comment',
    'primaryComment' => 'Primary Comment',
    'firstScore' => 'First Score',
    'finalScore' => 'Final Score',
    'firstComment' => 'First Comment',
    'finalComment' => 'Final Comment',
    'level1' => 'Level1',
    'level1End' => 'Level1end',
    'level2' => 'Level2',
    'level2End' => 'Level2end',
    'level3' => 'Level3',
    'level3End' => 'Level3end',
    'level4' => 'Level4',
    'level4End' => 'Level4end',
    'weight' => 'Weight',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
