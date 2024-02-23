<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\KpiEmployeeMaster;
use common\models\ModelMaster;

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
    public static function kpiEmployeeTarget($kpiId, $employeeId)
    {
        $kpiEmployee = KpiEmployee::find()
            ->where(["kpiId" => $kpiId, "employeeId" => $employeeId, "status" => [1, 2, 4]])
            ->asArray()
            ->one();
        if (isset($kpiEmployee) && !empty($kpiEmployee)) {
            return $kpiEmployee["target"];
        } else {
            return 0;
        }
    }
    public static function lastestCheckDate($kpiEmployeeId)
    {
        $kpiEmployeeHistory = KpiEmployeeHistory::find()
            ->select('kpiEmployeeId,nextCheckDate,kpiEmployeeHistoryId')
            ->where(["kpiEmployeeId" => $kpiEmployeeId])
            ->orderBy("kpiEmployeeHistoryId DESC")
            ->asArray()
            ->one();
        if (isset($kpiEmployeeHistory) && !empty($kpiEmployeeHistory) && $kpiEmployeeHistory["nextCheckDate"] != '') {
            //throw new Exception(print_r($kpiTeamHistory, true));
            $lastCheckDate = KpiEmployeeHistory::find()
                ->select('nextCheckDate,kpiEmployeeHistoryId')
                ->where(["kpiEmployeeId" => $kpiEmployeeId, "status" => [1, 2]])
                ->andWhere("kpiEmployeeHistoryId<" . $kpiEmployeeHistory["kpiEmployeeHistoryId"] . " and nextCheckDate!='" . $kpiEmployeeHistory["nextCheckDate"] . "'")
                ->orderBy("kpiEmployeeHistoryId DESC")
                ->asArray()
                ->one();
            if (isset($lastCheckDate) && !empty($lastCheckDate)) {
                return $lastCheckDate["nextCheckDate"];
            }
        } else {
            return '';
        }
    }
    public static function nextCheckDate($kpiEmployeeId)
    {
        $date = '';
        $kpiHistory = KpiEmployeeHistory::find()
            ->select('nextCheckDate')
            ->where(["kpiEmployeeId" => $kpiEmployeeId, "status" => [1, 4]])
            ->orderBy('kpiEmployeeHistoryId DESC')
            ->asArray()
            ->one();
        if (isset($kpiHistory) && !empty($kpiHistory) && $kpiHistory["nextCheckDate"] != '') {
            $date = ModelMaster::engDate($kpiHistory["nextCheckDate"], 2);
        }
        return $date;
    }
}
