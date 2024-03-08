<?php

namespace common\models\hrvc\master;

use Yii;

/**
* This is the model class for table "frame_term".
*
    * @property integer $termId
    * @property string $termName
    * @property integer $frameId
    * @property integer $sort
    * @property string $startDate
    * @property string $endDate
    * @property string $midDate
    * @property integer $isIncludeBous
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class FrameTermMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'frame_term';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['termName', 'frameId', 'startDate', 'endDate'], 'required'],
            [['frameId'], 'integer'],
            [['startDate', 'endDate', 'midDate', 'createDateTime', 'updateDateTime'], 'safe'],
            [['termName'], 'string', 'max' => 100],
            [['sort', 'isIncludeBous', 'status'], 'string', 'max' => 10],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'termId' => 'Term ID',
    'termName' => 'Term Name',
    'frameId' => 'Frame ID',
    'sort' => 'Sort',
    'startDate' => 'Start Date',
    'endDate' => 'End Date',
    'midDate' => 'Mid Date',
    'isIncludeBous' => 'Is Include Bous',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
