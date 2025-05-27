<?php

namespace common/models\hrvc\master;

use Yii;

/**
* This is the model class for table "final_evaluator".
*
    * @property integer $finalId
    * @property integer $employeeId
    * @property integer $finalEvaluatorId
    * @property integer $termId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class FinalEvaluatorMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'final_evaluator';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['employeeId', 'finalEvaluatorId', 'termId'], 'required'],
            [['employeeId', 'finalEvaluatorId', 'termId'], 'integer'],
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
    'finalId' => 'Final ID',
    'employeeId' => 'Employee ID',
    'finalEvaluatorId' => 'Final Evaluator ID',
    'termId' => 'Term ID',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
