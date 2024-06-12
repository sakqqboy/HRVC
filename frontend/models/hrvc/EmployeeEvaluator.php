<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\EmployeeEvaluatorMaster;

/**
* This is the model class for table "employee_evaluator".
*
* @property integer $employeeEvaluatorId
* @property integer $termId
* @property integer $employeeId
* @property integer $primaryId
* @property integer $finalId
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class EmployeeEvaluator extends \frontend\models\hrvc\master\EmployeeEvaluatorMaster{
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
