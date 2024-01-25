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

class EmployeeStatus extends \frontend\models\hrvc\master\EmployeeStatusMaster
{
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
    public static function employeeStatus($employeeId)
    {
        $status = EmployeeStatus::find()->select('s.statusName,s.statusId')
            ->JOIN("LEFT JOIN", "status s", "s.statusId=employee_status.statusId")
            ->where(["employee_status.employeeId" => $employeeId])
            ->orderBy('employee_status.employeeStatusId DESC')
            ->asArray()
            ->one();
        $statusArr = [];
        if (isset($status) && !empty($status)) {
            $statusArr["id"] = $status["statusId"];
            $statusArr["name"] = $status["statusName"];
        } else {
            $statusArr["id"] = null;
            $statusArr["name"] = null;
        }
        return $statusArr;
    }
}
