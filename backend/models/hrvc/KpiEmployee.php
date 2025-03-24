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
    public static function kpiEmployee($kpiId,$month,$year)
    {
        $kpiEmployee = Employee::find()
            ->select('employee.picture,employee.employeeId,employee.gender,ke.`month`, ke.`year`')
            ->JOIN("LEFT JOIN", "kpi_employee ke", "employee.employeeId=ke.employeeId")
            ->where(["ke.kpiId" => $kpiId, "ke.status" => [1,2,4],"ke.month" => $month,"ke.year" => $year])
            ->asArray()
            ->all();
        // $employee = ["ke.kpiId" => $kpiId, "ke.status" => 1,"ke.month" => $month,"ke.year" => $year];
        $employee = [];
        if (isset($kpiEmployee) && count($kpiEmployee) > 0) {
            foreach ($kpiEmployee as $ke) :
                if ($ke["picture"] != "") {
                    $employee[$ke["employeeId"]] = $ke["picture"];
                } else {
                    $employee[$ke["employeeId"]] = 'image/user.svg';
                    // if ($ke["gender"] == 1) {
                    //     $employee[$ke["employeeId"]] = 'image/user.png';
                    // } else {
                    //     $employee[$ke["employeeId"]] = 'image/lady.jpg';
                    // }
                }
            endforeach;
        }
        return $employee;
    }
    public static function kpiEmployeeDetail($kpiId)
    {
        $kpiEmployee = KpiEmployee::find()
            ->select('e.picture,e.employeeId,e.gender,t.titleName,e.employeeFirstname,e.employeeSurename')
            ->JOIN("LEFT JOIN", "employee e", "e.employeeId=kpi_employee.employeeId")
            ->JOIN("LEFT JOIN", "title t", "t.titleId=e.titleId")
            ->where(["kpi_employee.status" => [1, 2, 4], "kpi_employee.kpiId" => $kpiId, "e.status" => 1])
            ->andWhere("kpi_employee.employeeId is not null")
            ->asArray()
            ->all();
        $employee = [];
        if (isset($kpiEmployee) && count($kpiEmployee) > 0) {
            foreach ($kpiEmployee as $ke) :
                if ($ke["picture"] != "") {
                    $employee[$ke["employeeId"]]["picture"] = $ke["picture"];
                } else {
                    $employee[$ke["employeeId"]]["picture"] = 'image/user.svg';
                    // if ($ke["gender"] == 1) {
                    //     $employee[$ke["employeeId"]]["picture"] = 'image/user.png';
                    // } else {

                    //     $employee[$ke["employeeId"]]["picture"] = 'image/lady.jpg';
                    // }
                }
                $employee[$ke["employeeId"]]["name"] = $ke["employeeFirstname"] . ' ' . $ke["employeeSurename"];
                $employee[$ke["employeeId"]]["title"] = $ke["titleName"];
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
    public static function countKpiFromEmployee($employeeId)
    {
        $kpiEmployee = KpiEmployee::find()
            ->where(["employeeId" => $employeeId, "status" => [1, 2, 4]])
            ->asArray()
            ->all();
        return count($kpiEmployee);
    }
    public static function employeeKpiRatio($employeeId)
    {
        $kpiEmployee = KpiEmployee::find()
            ->select('k.kpiName,k.priority,k.quantRatio,k.amountType,k.code,kpi_employee.target,kpi_employee.result,
        kpi_employee.status,k.unitId,kpi_employee.month,kpi_employee.year,k.kpiId,k.companyId,
        kpi_employee.kpiEmployeeId,e.employeeFirstname,e.employeeSurename')
            ->JOIN("LEFT JOIN", "kpi k", "kpi_employee.kpiId=k.kpiId")
            ->JOIN("LEFT JOIN", "employee e", "e.employeeId=kpi_employee.employeeId")
            ->where(["kpi_employee.status" => [1, 2, 4], "k.status" => [1, 2, 4], "kpi_employee.employeeId" => $employeeId])
            ->orderby('k.createDateTime')
            ->asArray()
            ->all();
        $totalRatio = 0;
        $totalKpi = 0;
        if (isset($kpiEmployee) && count($kpiEmployee) > 0) {
            $totalKpi = count($kpiEmployee);
            foreach ($kpiEmployee as $kpi) :
                $ratio = 0;
                $kpiEmployeeHistory = KpiEmployeeHistory::find()
                    ->where(["kpiEmployeeId" => $kpi["kpiEmployeeId"], "status" => [1, 2, 4]])
                    ->asArray()
                    ->orderBy('createDateTime DESC')
                    ->one();
                if (!isset($kpiEmployeeHistory) || empty($kpiEmployeeHistory)) {
                    $kpiEmployeeHistory = KpiEmployee::find()
                        ->where(["kpiEmployeeId" => $kpi["kpiEmployeeId"], "status" => [1, 2, 4]])
                        ->asArray()
                        ->orderBy('createDateTime DESC')
                        ->one();
                }
                if ($kpi["target"] != '' && $kpi["target"] != 0) {
                    if ($kpi["code"] == '<' || $kpi["code"] == '=') {
                        $ratio = ($kpi["result"] / $kpi["target"]) * 100;
                    } else {
                        if ($kpi["result"] != '' && $kpi["result"] != 0) {
                            $ratio = ($kpi["target"] / $kpi["result"]) * 100;
                        } else {
                            $ratio = 0;
                        }
                    }
                } else {
                    $ratio = 0;
                }
                $totalRatio += $ratio;
            endforeach;
        }
        if ($totalKpi > 0) {
            $percent = $totalRatio / $totalKpi;
        } else {
            $percent = 0;
        }
        return $percent;
    }
    public static function countKpiFromTeam($kpiId, $teamId,$month,$year)
    {
        $kpiEmployee = KpiEmployee::find()
            ->select('e.picture,e.employeeId,e.gender,kpi_employee.year,kpi_employee.month')
            ->JOIN("LEFT JOIN", "employee e", "e.employeeId=kpi_employee.employeeId")
            ->where("kpi_employee.status!=99 and e.status!=99")
            ->andWhere([
                "kpi_employee.kpiId" => $kpiId,
                "e.teamId" => $teamId,
                "kpi_employee.month" => $month,
                "kpi_employee.year" => $year
            ])
            ->asArray()
            ->all();
        $employee = [];
        if (isset($kpiEmployee) && count($kpiEmployee) > 0) {
            foreach ($kpiEmployee as $ke) :
                if ($ke["picture"] != "") {
                    $employee[$ke["employeeId"]] = $ke["picture"];
                } else {
                    $employee[$ke["employeeId"]] = 'image/user.svg';
                    // if ($ke["gender"] == 1) {
                    //     $employee[$ke["employeeId"]] = 'image/user.png';
                    // } else {

                    //     $employee[$ke["employeeId"]] = 'image/lady.jpg';
                    // }
                }
            endforeach;
        }
        return $employee;
    }
    public static function totolEmployeeInTeam($kpiId, $teamId)
    {
        $kpiEmployee = KpiEmployee::find()
            ->select('e.employeeId')
            ->JOIN("LEFT JOIN", "employee e", "e.employeeId=kpi_employee.employeeId")
            ->JOIN("LEFT JOIN", "team t", "t.teamId=e.teamId")
            ->where("kpi_employee.status!=99 and e.status!=99")
            ->andWhere([
                "kpi_employee.kpiId" => $kpiId,
                "e.teamId" => $teamId
            ])
            ->asArray()
            ->all();
        return count($kpiEmployee);
    }

    public static function autoSummalys($kpiId, $month, $year, $kpiTeamId)
    {
        // ดึง teamId จาก kpiTeamId
        $teamId = KpiTeam::find()
            ->select('teamId')
            ->where(['kpiTeamId' => $kpiTeamId])
            ->scalar(); // ดึงค่าเดียวแทนที่จะเป็น query object
    
        if (!$teamId) {
            return 0; // หากไม่มีทีมให้คืนค่า 0 ทันที
        }
    
        // คำนวณผลรวมของ result
        $sumResult = KpiEmployee::find()
            ->join("LEFT JOIN", "employee e", "e.employeeId = kpi_employee.employeeId")
            ->where([
                'kpi_employee.kpiId' => $kpiId,
                'kpi_employee.month' => $month,
                'kpi_employee.year' => $year,
                'kpi_employee.status' => [1, 2, 4],
                'e.status' => 1,
                'e.teamId' => $teamId
            ])
            ->sum('result');
    
        return $sumResult ?? 0;
    }
    
}