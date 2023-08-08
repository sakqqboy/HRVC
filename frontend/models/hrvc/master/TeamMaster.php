<?php

namespace frontend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "team".
*
    * @property integer $teamId
    * @property string $teamName
    * @property integer $branchId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class TeamMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'team';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['teamName', 'branchId'], 'required'],
            [['branchId'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['teamName'], 'string', 'max' => 100],
            [['status'], 'string', 'max' => 10],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'teamId' => 'Team ID',
    'teamName' => 'Team Name',
    'branchId' => 'Branch ID',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
