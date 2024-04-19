<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\EmployeeKpiEvaluationMaster;

/**
* This is the model class for table "employee_kpi_evaluation".
*
* @property integer $eKpiId
* @property integer $mKpiId
* @property integer $kpiId
* @property integer $employeeId
* @property integer $weight
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class EmployeeKpiEvaluation extends \frontend\models\hrvc\master\EmployeeKpiEvaluationMaster{
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
