<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\KgiEmployeeRequestMaster;

/**
* This is the model class for table "kgi_employee_request".
*
* @property integer $request_id
* @property integer $kgiEmployeeHistoryId
* @property integer $kgiEmployeeId
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

class KgiEmployeeRequest extends \frontend\models\hrvc\master\KgiEmployeeRequestMaster{
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
