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
            [['kgiTeamId', 'target', 'result'], 'required'],
            [['kgiTeamId'], 'integer'],
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
    'kgiTeamHistoryId' => 'Kgi Team History ID',
    'kgiTeamId' => 'Kgi Team ID',
    'target' => 'Target',
    'result' => 'Result',
    'detail' => 'Detail',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
