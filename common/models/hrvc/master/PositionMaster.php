<?php

namespace common\models\hrvc\master;

use Yii;

/**
* This is the model class for table "position".
*
    * @property integer $positionId
    * @property string $positionName
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class PositionMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'position';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['positionName'], 'required'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['positionName'], 'string', 'max' => 200],
            [['status'], 'string', 'max' => 10],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'positionId' => 'Position ID',
    'positionName' => 'Position Name',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
