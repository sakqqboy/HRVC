<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\EmployeeKfiEvaluationMaster;

/**
* This is the model class for table "employee_kfi_evaluation".
*
* @property integer $eKfiId
* @property integer $mKfiId
* @property integer $kfiId
* @property integer $employeeId
* @property integer $weight
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class EmployeeKfiEvaluation extends \frontend\models\hrvc\master\EmployeeKfiEvaluationMaster{
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
