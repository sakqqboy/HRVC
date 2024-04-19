<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\EmployeeSalaryHistoryMaster;

/**
* This is the model class for table "employee_salary_history".
*
* @property integer $employeeSalaryHistoryId
* @property integer $employeeSalaryId
* @property integer $value
* @property integer $currencyId
* @property integer $round
* @property integer $status
* @property string $createDateTime
* @property string $udateDateTime
*/

class EmployeeSalaryHistory extends \backend\models\hrvc\master\EmployeeSalaryHistoryMaster{
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
