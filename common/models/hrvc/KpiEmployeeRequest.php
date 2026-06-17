<?php

namespace common\models\hrvc;

use Yii;
use \common\models\hrvc\master\KpiEmployeeRequestMaster;

/**
* This is the model class for table "kpi_employee_request".
*
* @property integer $request_id
* @property integer $kpiEmployeeHistoryId
* @property integer $kpiEmployeeId
* @property integer $userId
* @property string $old_target
* @property string $new_target
* @property string $old_result
* @property string $new_result
* @property string $reason
* @property integer $status
* @property integer $approver_id
* @property string $approval_remark
* @property string $created_at
* @property string $updated_at
*/

class KpiEmployeeRequest extends \common\models\hrvc\master\KpiEmployeeRequestMaster{
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
