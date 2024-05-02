<?php

namespace common\models\hrvc;

use Yii;
use \common\models\hrvc\master\EmployeeEvaluationMaster;

/**
* This is the model class for table "employee_evaluation".
*
* @property integer $employeeEvaluationId
* @property integer $employeeId
* @property integer $pimWeightId
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class EmployeeEvaluation extends \common\models\hrvc\master\EmployeeEvaluationMaster{
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
