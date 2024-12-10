<?php

namespace frontend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "term_step".
*
    * @property integer $stepId
    * @property string $stepName
    * @property integer $sort
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class TermStepMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'term_step';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['stepName', 'sort'], 'required'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['stepName'], 'string', 'max' => 255],
            [['sort', 'status'], 'string', 'max' => 4],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'stepId' => 'Step ID',
    'stepName' => 'Step Name',
    'sort' => 'Sort',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
