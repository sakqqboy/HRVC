<?php

namespace frontend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "kgi_team".
*
    * @property integer $kgiTeamId
    * @property integer $kgiId
    * @property integer $teamId
    * @property string $target
    * @property string $result
    * @property string $fromDate
    * @property string $toDate
    * @property string $nextCheckDate
    * @property string $month
    * @property string $year
    * @property string $remark
    * @property integer $createrId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class KgiTeamMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'kgi_team';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['kgiId', 'teamId'], 'required'],
            [['kgiId', 'teamId', 'createrId'], 'integer'],
            [['target', 'result'], 'number'],
            [['fromDate', 'toDate', 'nextCheckDate', 'createDateTime', 'updateDateTime'], 'safe'],
            [['remark'], 'string'],
            [['month', 'year'], 'string', 'max' => 45],
            [['status'], 'string', 'max' => 20],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'kgiTeamId' => 'Kgi Team ID',
    'kgiId' => 'Kgi ID',
    'teamId' => 'Team ID',
    'target' => 'Target',
    'result' => 'Result',
    'fromDate' => 'From Date',
    'toDate' => 'To Date',
    'nextCheckDate' => 'Next Check Date',
    'month' => 'Month',
    'year' => 'Year',
    'remark' => 'Remark',
    'createrId' => 'Creater ID',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
