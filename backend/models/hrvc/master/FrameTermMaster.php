<?php

namespace backend\models\hrvc\master;

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
    * @property integer $isIncludeBonus
    * @property string $bonusBudget
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
            [['termName', 'frameId'], 'required'],
            [['frameId'], 'integer'],
            [['startDate', 'endDate', 'midDate', 'createDateTime', 'updateDateTime'], 'safe'],
            [['bonusBudget'], 'number'],
            [['termName'], 'string', 'max' => 100],
            [['sort', 'isIncludeBonus', 'status'], 'string', 'max' => 10],
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
    'isIncludeBonus' => 'Is Include Bonus',
    'bonusBudget' => 'Bonus Budget',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
