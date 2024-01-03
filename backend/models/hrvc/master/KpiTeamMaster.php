<?php

namespace backend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "kpi_team".
*
    * @property integer $kpiTeamId
    * @property integer $kpiId
    * @property integer $teamId
    * @property string $target
    * @property string $result
    * @property integer $createrId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class KpiTeamMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'kpi_team';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['kpiId', 'teamId'], 'required'],
            [['kpiId', 'teamId', 'createrId'], 'integer'],
            [['target', 'result'], 'number'],
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
    'kpiTeamId' => 'Kpi Team ID',
    'kpiId' => 'Kpi ID',
    'teamId' => 'Team ID',
    'target' => 'Target',
    'result' => 'Result',
    'createrId' => 'Creater ID',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
