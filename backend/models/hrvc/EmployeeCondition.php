<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\EmployeeConditionMaster;

/**
* This is the model class for table "employee_condition".
*
* @property integer $employeeConditionId
* @property string $employeeConditionName
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class EmployeeCondition extends \backend\models\hrvc\master\EmployeeConditionMaster{
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
