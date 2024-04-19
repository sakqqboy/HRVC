<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\EmployeeKgiEvaluationMaster;

/**
* This is the model class for table "employee_kgi_evaluation".
*
* @property integer $eKgiId
* @property integer $mKgiId
* @property integer $kgiId
* @property integer $employeeId
* @property integer $weight
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class EmployeeKgiEvaluation extends \frontend\models\hrvc\master\EmployeeKgiEvaluationMaster{
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
