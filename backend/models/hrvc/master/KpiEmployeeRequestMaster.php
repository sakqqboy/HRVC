<?php

namespace backend\models\hrvc\master;

use Yii;

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
class KpiEmployeeRequestMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'kpi_employee_request';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['kpiEmployeeHistoryId', 'kpiEmployeeId', 'userId', 'created_at'], 'required'],
            [['kpiEmployeeHistoryId', 'kpiEmployeeId', 'userId', 'approver_id'], 'integer'],
            [['old_target', 'new_target', 'old_result', 'new_result'], 'number'],
            [['reason', 'approval_remark'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['status'], 'string', 'max' => 1],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'request_id' => 'Request ID',
    'kpiEmployeeHistoryId' => 'Kpi Employee History ID',
    'kpiEmployeeId' => 'Kpi Employee ID',
    'userId' => 'User ID',
    'old_target' => 'Old Target',
    'new_target' => 'New Target',
    'old_result' => 'Old Result',
    'new_result' => 'New Result',
    'reason' => 'Reason',
    'status' => 'Status',
    'approver_id' => 'Approver ID',
    'approval_remark' => 'Approval Remark',
    'created_at' => 'Created At',
    'updated_at' => 'Updated At',
];
}
}
