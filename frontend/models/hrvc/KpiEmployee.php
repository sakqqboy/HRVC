<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\KpiEmployeeMaster;

/**
* This is the model class for table "kpi_employee".
*
* @property integer $kpiEmployeeId
* @property integer $employeeId
* @property integer $kpiId
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class KpiEmployee extends \frontend\models\hrvc\master\KpiEmployeeMaster{
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