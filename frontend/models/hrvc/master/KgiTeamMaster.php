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
    'kgiTeamId' => 'Kgi Team ID',
    'kgiId' => 'Kgi ID',
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
