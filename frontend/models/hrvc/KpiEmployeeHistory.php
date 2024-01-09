<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\KpiEmployeeHistoryMaster;

/**
* This is the model class for table "kpi_employee_history".
*
* @property integer $kpiEmployeeHistoryId
* @property integer $kpiEmployeeId
* @property string $target
* @property string $result
* @property string $detail
* @property string $nextCheckDate
* @property string $lastCheckDate
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class KpiEmployeeHistory extends \frontend\models\hrvc\master\KpiEmployeeHistoryMaster{
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
