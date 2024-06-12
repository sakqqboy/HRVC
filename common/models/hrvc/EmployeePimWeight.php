<?php

namespace common\models\hrvc;

use Yii;
use \common\models\hrvc\master\EmployeePimWeightMaster;

/**
* This is the model class for table "employee_pim_weight".
*
* @property integer $employeePimWeightId
* @property integer $employeeId
* @property integer $termId
* @property string $kfiWeight
* @property string $kgiWeight
* @property string $kpiWeight
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class EmployeePimWeight extends \common\models\hrvc\master\EmployeePimWeightMaster{
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
