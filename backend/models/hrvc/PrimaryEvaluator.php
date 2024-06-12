<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\PrimaryEvaluatorMaster;

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

class PrimaryEvaluator extends \backend\models\hrvc\master\PrimaryEvaluatorMaster{
    /**
    * @inheritdoc
    */
    public function rules()
    {
        return array_merge(parent::rules(), []);
    }

    /**
    * @inheritdoc
    */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), []);
    }
}
