<?php

namespace common/models\hrvc\master;

use Yii;

/**
* This is the model class for table "kpi_team".
*
    * @property integer $kpiTeamId
    * @property integer $kpiId
    * @property integer $teamId
    * @property integer $status
    * @property string $target
    * @property string $result
    * @property string $fromDate
    * @property string $toDate
    * @property string $nextCheckDate
    * @property string $month
    * @property string $year
    * @property string $remark
    * @property integer $createrId
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
            [['fromDate', 'toDate', 'nextCheckDate', 'createDateTime', 'updateDateTime'], 'safe'],
            [['remark'], 'string'],
            [['status'], 'string', 'max' => 20],
            [['month', 'year'], 'string', 'max' => 45],
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
    'status' => 'Status',
    'target' => 'Target',
    'result' => 'Result',
    'fromDate' => 'From Date',
    'toDate' => 'To Date',
    'nextCheckDate' => 'Next Check Date',
    'month' => 'Month',
    'year' => 'Year',
    'remark' => 'Remark',
    'createrId' => 'Creater ID',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
