<?php

namespace frontend/models\hrvc\master;

use Yii;

/**
* This is the model class for table "team_position".
*
    * @property integer $teamPositionId
    * @property string $teamPositionName
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class TeamPositionMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'team_position';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['teamPositionName'], 'required'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['teamPositionName'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 10],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'teamPositionId' => 'Team Position ID',
    'teamPositionName' => 'Team Position Name',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
