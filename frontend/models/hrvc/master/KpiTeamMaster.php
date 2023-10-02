<?php

namespace frontend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "kpi_team".
*
    * @property integer $kpiTeamId
    * @property integer $kpiId
    * @property integer $teamId
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
            [['kpiId', 'teamId'], 'integer'],
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
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
