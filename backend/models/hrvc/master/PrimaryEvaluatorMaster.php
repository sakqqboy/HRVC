<?php

namespace backend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "primary_evaluator".
*
    * @property integer $primaryId
    * @property integer $employeeId
    * @property integer $primaryEvaluatorId
    * @property integer $termId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class PrimaryEvaluatorMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'primary_evaluator';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['employeeId', 'primaryEvaluatorId', 'termId'], 'required'],
            [['employeeId', 'primaryEvaluatorId', 'termId'], 'integer'],
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
    'primaryId' => 'Primary ID',
    'employeeId' => 'Employee ID',
    'primaryEvaluatorId' => 'Primary Evaluator ID',
    'termId' => 'Term ID',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
