<?php

namespace backend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "frame".
*
    * @property integer $frameId
    * @property string $frameName
    * @property integer $environmentId
    * @property string $startDate
    * @property string $endDate
    * @property integer $attributeId
    * @property integer $isMid
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class FrameMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'frame';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['frameName', 'environmentId', 'attributeId'], 'required'],
            [['environmentId', 'attributeId'], 'integer'],
            [['startDate', 'endDate', 'createDateTime', 'updateDateTime'], 'safe'],
            [['frameName'], 'string', 'max' => 255],
            [['isMid', 'status'], 'string', 'max' => 4],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'frameId' => 'Frame ID',
    'frameName' => 'Frame Name',
    'environmentId' => 'Environment ID',
    'startDate' => 'Start Date',
    'endDate' => 'End Date',
    'attributeId' => 'Attribute ID',
    'isMid' => 'Is Mid',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
