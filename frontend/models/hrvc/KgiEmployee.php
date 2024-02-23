<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\KgiEmployeeMaster;

/**
 * This is the model class for table "kgi_employee".
 *
 * @property integer $kgiEmployeeId
 * @property integer $employeeId
 * @property integer $kgiId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class KgiEmployee extends \frontend\models\hrvc\master\KgiEmployeeMaster
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
    public static function isHasEmployee($employeeId, $kgiId)
    {
        $kgiEmployee = KgiEmployee::find()->where(["kgiId" => $kgiId, "employeeId" => $employeeId, "status" => 1])->one();
        if (isset($kgiEmployee) && !empty($kgiEmployee)) {
            return 1;
        } else {
            return 0;
        }
    }
    public static function totalEmployee($kgiId)
    {
        $kgiEmployee = KgiEmployee::find()->where(["kgiId" => $kgiId, "status" => 1])->asArray()->all();
        if (isset($kgiEmployee) && count($kgiEmployee) > 0) {
            return count($kgiEmployee);
        } else {
            return 0;
        }
    }
    public static function canEdit($role, $kgiEmployeeId)
    {
        $canEdit = 0;

        if ($role >= 4) {
            $canEdit = 1;
        } else {
            $employeeId = User::employeeIdFromUserId();
            if ($role == 3) { //Team leader can Edit in their team
                $kgiEmployee = KgiEmployee::find()
                    ->select('e.teamId')
                    ->JOIN("LEFT JOIN", "employee e", "e.employeeId=kgi_employee.employeeId")
                    ->where(["kgi_employee.kgiEmployeeId" => $kgiEmployeeId])
                    ->asArray()
                    ->one();
                $employee = Employee::find()
                    ->select('teamId')
                    ->where(["employeeId" => $employeeId])
                    ->asArray()
                    ->one();
                if (isset($kgiEmployee) && isset($employee) && !empty($employee) && !empty($kgiEmployee)) {
                    if ($kgiEmployee["teamId"] == $employee["teamId"]) {
                        $canEdit = 1;
                    }
                }
            } else { //staff
                $canEdit = 1; //see only their kgi
            }
        }
        return $canEdit;
    }
}
