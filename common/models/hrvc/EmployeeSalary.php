<?php

namespace common\models\hrvc;

use Yii;
use \common\models\hrvc\master\EmployeeSalaryMaster;

/**
* This is the model class for table "employee_salary".
*
* @property integer $employeeSalaryId
* @property integer $employeeId
* @property integer $structureId
* @property integer $value
* @property integer $currencyId
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class EmployeeSalary extends \common\models\hrvc\master\EmployeeSalaryMaster{
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
