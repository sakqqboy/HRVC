<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\EmployeeStatusMaster;

/**
* This is the model class for table "employee_status".
*
* @property integer $employeeStatusId
* @property integer $employeeId
* @property integer $statusId
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class EmployeeStatus extends \frontend\models\hrvc\master\EmployeeStatusMaster{
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
