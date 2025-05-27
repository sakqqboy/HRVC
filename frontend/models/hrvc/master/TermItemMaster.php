<?php

namespace frontend/models\hrvc\master;

use Yii;

/**
* This is the model class for table "term_item".
*
    * @property integer $termItemId
    * @property integer $termId
    * @property integer $stepId
    * @property string $startDate
    * @property string $finishDate
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class TermItemMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'term_item';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['termId', 'stepId'], 'required'],
            [['termId', 'stepId'], 'integer'],
            [['startDate', 'finishDate', 'createDateTime', 'updateDateTime'], 'safe'],
            [['status'], 'string', 'max' => 10],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'termItemId' => 'Term Item ID',
    'termId' => 'Term ID',
    'stepId' => 'Step ID',
    'startDate' => 'Start Date',
    'finishDate' => 'Finish Date',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
