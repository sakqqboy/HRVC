<?php

namespace frontend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "kgi_team_history".
*
    * @property integer $kgiTeamHistoryId
    * @property integer $kgiTeamId
    * @property string $target
    * @property string $result
    * @property string $detail
    * @property string $fromDate
    * @property string $toDate
    * @property string $nextCheckDate
    * @property string $month
    * @property string $year
    * @property integer $createrId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class KgiTeamHistoryMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'kgi_team_history';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['kgiTeamId'], 'required'],
            [['kgiTeamId', 'createrId'], 'integer'],
            [['target', 'result'], 'number'],
            [['detail'], 'string'],
            [['fromDate', 'toDate', 'nextCheckDate', 'createDateTime', 'updateDateTime'], 'safe'],
            [['month', 'year'], 'string', 'max' => 45],
            [['status'], 'string', 'max' => 10],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'kgiTeamHistoryId' => 'Kgi Team History ID',
    'kgiTeamId' => 'Kgi Team ID',
    'target' => 'Target',
    'result' => 'Result',
    'detail' => 'Detail',
    'fromDate' => 'From Date',
    'toDate' => 'To Date',
    'nextCheckDate' => 'Next Check Date',
    'month' => 'Month',
    'year' => 'Year',
    'createrId' => 'Creater ID',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
