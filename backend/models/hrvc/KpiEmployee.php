<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\KpiEmployeeMaster;

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

class KpiEmployee extends \backend\models\hrvc\master\KpiEmployeeMaster
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
    public static function kpiEmployee($kpiId)
    {
        $kpiEmployee = Employee::find()
            ->select('employee.picture,employee.employeeId,employee.gender')
            ->JOIN("LEFT JOIN", "kpi_employee ke", "employee.employeeId=ke.employeeId")
            ->where(["ke.kpiId" => $kpiId, "ke.status" => 1])
            ->asArray()
            ->all();
        $employee = [];
        if (isset($kpiEmployee) && count($kpiEmployee) > 0) {
            foreach ($kpiEmployee as $ke) :
                if ($ke["picture"] != "") {
                    $employee[$ke["employeeId"]] = $ke["picture"];
                } else {
                    if ($ke["gender"] == 1) {
                        $employee[$ke["employeeId"]] = 'image/user.png';
                    } else {
                        $employee[$ke["employeeId"]] = 'image/lady.jpg';
                    }
                }
            endforeach;
        }
        return $employee;
    }
}
