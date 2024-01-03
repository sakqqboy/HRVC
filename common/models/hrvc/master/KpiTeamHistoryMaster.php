<?php

namespace common\models\hrvc\master;

use Yii;

/**
* This is the model class for table "kpi_team_history".
*
    * @property integer $kpiTeamHistoryId
    * @property integer $kpiTeamId
    * @property string $target
    * @property string $result
    * @property string $detail
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class KpiTeamHistoryMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'kpi_team_history';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['kpiTeamId', 'target', 'result'], 'required'],
            [['kpiTeamId'], 'integer'],
            [['target', 'result'], 'number'],
            [['detail'], 'string'],
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
    'kpiTeamHistoryId' => 'Kpi Team History ID',
    'kpiTeamId' => 'Kpi Team ID',
    'target' => 'Target',
    'result' => 'Result',
    'detail' => 'Detail',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
