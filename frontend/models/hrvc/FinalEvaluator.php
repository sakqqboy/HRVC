<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\FinalEvaluatorMaster;

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

class FinalEvaluator extends \frontend\models\hrvc\master\FinalEvaluatorMaster{
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
