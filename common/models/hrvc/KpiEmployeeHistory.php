<?php

namespace common\models\hrvc;

use Yii;
use \common\models\hrvc\master\KpiEmployeeHistoryMaster;

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

class KpiEmployeeHistory extends \common\models\hrvc\master\KpiEmployeeHistoryMaster{
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
