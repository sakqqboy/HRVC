<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\KgiEmployeeMaster;
use common\helpers\Path;
use common\models\ModelMaster;
use Exception;

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

class KgiEmployee extends \backend\models\hrvc\master\KgiEmployeeMaster
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
    public static function kgiEmployee($kgiId, $month, $year)
    {
        $kgiEmployee = KgiEmployee::find()
            ->select('e.picture,e.employeeId,e.gender,kgi_employee.month,kgi_employee.year')
            ->JOIN("LEFT JOIN", "employee e", "e.employeeId=kgi_employee.employeeId")
            ->where(["kgi_employee.status" => [1, 2, 4, 5], "kgi_employee.kgiId" => $kgiId, "kgi_employee.month" => $month, "kgi_employee.year" => $year])
            ->andWhere("kgi_employee.employeeId is not null")
            ->asArray()
            ->all();
        $employee = [];
        $img = "images/employee/status/employee-nopic.svg";
        if (isset($kgiEmployee) && count($kgiEmployee) > 0) {
            foreach ($kgiEmployee as $ke) :
                if ($ke["picture"] != "") {
                    //$url = Path::frontendUrl() . $ke["picture"];
                    //$headers = @get_headers($url);
                    //if ($headers && strpos($headers[0], '200') !== false) {
                    $employee[$ke["employeeId"]] = $ke["picture"];
                } else {
                    $employee[$ke["employeeId"]] = $img;
                }
            //} else {
            //$employee[$ke["employeeId"]] = $img;
            //}
            endforeach;
        }
        return $employee;
    }
    public static function kgiEmployee2($kgiId, $month, $year)
    {
        /*    $kgiEmployee = KgiEmployee::find()
            ->select('e.picture,e.employeeId,e.gender,kgi_employee.month,kgi_employee.year')
            ->JOIN("LEFT JOIN", "employee e", "e.employeeId=kgi_employee.employeeId")
            ->where(["kgi_employee.status" => [1, 2, 4, 5], "kgi_employee.kgiId" => $kgiId, "e.status" => 1, "kgi_employee.month" => $month, "kgi_employee.year" => $year])
            ->andWhere("kgi_employee.employeeId is not null")
            ->asArray()
            ->all();*/
        $kgiEmployee = KgiEmployeeHistory::find()
            ->select('e.picture,e.employeeId,e.gender,kgi_employee_history.month,kgi_employee_history.year,kgi_employee_history.kgiEmployeeId')
            ->JOIN("LEFT JOIN", "kgi_employee ke", "ke.kgiEmployeeId=kgi_employee_history.kgiEmployeeId")
            ->JOIN("LEFT JOIN", "employee e", "e.employeeId=ke.employeeId")
            ->where(["ke.kgiId" => $kgiId, "kgi_employee_history.month" => $month, "kgi_employee_history.year" => $year])
            ->andWhere("kgi_employee_history.status!=99")
            ->asArray()
            ->all();
        if (!isset($kgiEmployee) || count($kgiEmployee) == 0) {
            $kgiEmployee = KgiEmployee::find()
                ->select('e.picture,e.employeeId,e.gender,kgi_employee.month,kgi_employee.year')
                ->JOIN("LEFT JOIN", "employee e", "e.employeeId=kgi_employee.employeeId")
                ->where(["kgi_employee.status" => [1, 2, 4, 5], "kgi_employee.kgiId" => $kgiId, "kgi_employee.month" => $month, "kgi_employee.year" => $year])
                ->andWhere("kgi_employee.employeeId is not null")
                ->asArray()
                ->all();
        }
        $employee = [];
        $img = "images/employee/status/employee-nopic.svg";
        if (isset($kgiEmployee) && count($kgiEmployee) > 0) {
            foreach ($kgiEmployee as $ke) :
                if ($ke["picture"] != "") {
                    //    $url = Path::frontendUrl() . $ke["picture"];
                    //    $headers = @get_headers($url);
                    //    if ($headers && strpos($headers[0], '200') !== false) {
                    $employee[$ke["employeeId"]] = $ke["picture"];
                    //    } else {
                    //        $employee[$ke["employeeId"]] = $img;
                    //    }
                } else {
                    $employee[$ke["employeeId"]] = $img;
                }
            endforeach;
        }
        return $employee;
    }
    public static function kgiEmployeeDetail($kgiId, $month, $year)
    {
        $kgiEmployee = KgiEmployee::find()
            ->select('e.picture,e.employeeId,e.gender,t.titleName,e.employeeFirstname,e.employeeSurename')
            ->JOIN("LEFT JOIN", "employee e", "e.employeeId=kgi_employee.employeeId")
            ->JOIN("LEFT JOIN", "title t", "t.titleId=e.titleId")
            ->where([
                "kgi_employee.status" => [1, 2, 4],
                "kgi_employee.kgiId" => $kgiId,
                "e.status" => 1,
                "kgi_employee.month" => $month,
                "kgi_employee.year" => $year
            ])
            ->andWhere("kgi_employee.employeeId is not null")
            ->asArray()
            ->all();
        $employee = [];
        if (isset($kgiEmployee) && count($kgiEmployee) > 0) {
            foreach ($kgiEmployee as $ke) :
                if ($ke["picture"] != "") {
                    $employee[$ke["employeeId"]]["picture"] = $ke["picture"];
                } else {
                    $employee[$ke["employeeId"]]["picture"] = 'images/icons/Settings/personblack.svg';
                }
                $employee[$ke["employeeId"]]["name"] = $ke["employeeFirstname"] . ' ' . $ke["employeeSurename"];
                $employee[$ke["employeeId"]]["title"] = $ke["titleName"];
            endforeach;
        }
        return $employee;
    }
    public static function kgiEmployeeTarget($kgiId, $employeeId)
    {
        $kgiEmployee = KgiEmployee::find()
            ->where(["kgiId" => $kgiId, "employeeId" => $employeeId, "status" => [1, 2, 4]])
            ->asArray()
            ->one();
        if (isset($kgiEmployee) && !empty($kgiEmployee)) {
            return $kgiEmployee["target"];
        } else {
            return 0;
        }
    }
    public static function lastestCheckDate($kgiEmployeeId)
    {
        $kgiEmployeeHistory = KgiEmployeeHistory::find()
            ->select('kgiEmployeeId,nextCheckDate,kgiEmployeeHistoryId')
            ->where(["kgiEmployeeId" => $kgiEmployeeId])
            ->orderBy("kgiEmployeeHistoryId DESC")
            ->asArray()
            ->one();
        if (isset($kgiEmployeeHistory) && !empty($kgiEmployeeHistory) && $kgiEmployeeHistory["nextCheckDate"] != '') {
            //throw new Exception(print_r($kgiTeamHistory, true));
            $lastCheckDate = KgiEmployeeHistory::find()
                ->select('nextCheckDate,kgiEmployeeHistoryId')
                ->where(["kgiEmployeeId" => $kgiEmployeeId, "status" => [1, 2]])
                ->andWhere("kgiEmployeeHistoryId<" . $kgiEmployeeHistory["kgiEmployeeHistoryId"] . " and nextCheckDate!='" . $kgiEmployeeHistory["nextCheckDate"] . "'")
                ->orderBy("kgiEmployeeHistoryId DESC")
                ->asArray()
                ->one();
            if (isset($lastCheckDate) && !empty($lastCheckDate)) {
                return $lastCheckDate["nextCheckDate"];
            }
        } else {
            return '';
        }
    }
    public static function nextCheckDate($kgiEmployeeId)
    {
        $date = '';
        $kgiHistory = KgiEmployeeHistory::find()
            ->select('nextCheckDate')
            ->where(["kgiEmployeeId" => $kgiEmployeeId, "status" => [1, 2, 4]])
            ->orderBy('year DESC,month DESC,status DESC,createDateTime DESC')
            ->asArray()
            ->one();
        if (isset($kgiHistory) && !empty($kgiHistory) && $kgiHistory["nextCheckDate"] != '') {
            $date = ModelMaster::engDate($kgiHistory["nextCheckDate"], 2);
        }
        return $date;
    }
    public static function countKgiFromEmployee($employeeId)
    {
        $kgiEmployee = KgiEmployee::find()
            ->where(["employeeId" => $employeeId, "status" => [1, 2, 4]])
            ->asArray()
            ->all();
        return count($kgiEmployee);
    }
    public static function employeeKgiRatio($employeeId)
    {
        $kgiEmployee = KgiEmployee::find()
            ->select('k.kgiName,k.priority,k.quantRatio,k.amountType,k.code,kgi_employee.target,kgi_employee.result,
        kgi_employee.status,k.unitId,kgi_employee.month,kgi_employee.year,k.kgiId,k.companyId,
        kgi_employee.kgiEmployeeId,e.employeeFirstname,e.employeeSurename')
            ->JOIN("LEFT JOIN", "kgi k", "kgi_employee.kgiId=k.kgiId")
            ->JOIN("LEFT JOIN", "employee e", "e.employeeId=kgi_employee.employeeId")
            ->where(["kgi_employee.status" => [1, 2, 4], "k.status" => [1, 2, 4], "kgi_employee.employeeId" => $employeeId])
            ->orderby('k.createDateTime')
            ->asArray()
            ->all();
        $totalRatio = 0;
        $totalKgi = 0;
        if (isset($kgiEmployee) && count($kgiEmployee) > 0) {
            $totalKgi = count($kgiEmployee);
            foreach ($kgiEmployee as $kgi) :
                $ratio = 0;
                $kgiEmployeeHistory = KgiEmployeeHistory::find()
                    ->where(["kgiEmployeeId" => $kgi["kgiEmployeeId"], "status" => [1, 2, 4]])
                    ->asArray()
                    ->orderBy('createDateTime DESC')
                    ->one();
                if (!isset($kgiEmployeeHistory) || empty($kgiEmployeeHistory)) {
                    $kgiEmployeeHistory = KgiEmployee::find()
                        ->where(["kgiEmployeeId" => $kgi["kgiEmployeeId"], "status" => [1, 2, 4]])
                        ->asArray()
                        ->orderBy('createDateTime DESC')
                        ->one();
                }
                if ($kgi["target"] != '' && $kgi["target"] != 0) {
                    if ($kgi["code"] == '<' || $kgi["code"] == '=') {
                        $ratio = ($kgi["result"] / $kgi["target"]) * 100;
                    } else {
                        if ($kgi["result"] != '' && $kgi["result"] != 0) {
                            $ratio = ($kgi["target"] / $kgi["result"]) * 100;
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
        if ($totalKgi > 0) {
            $percent = $totalRatio / $totalKgi;
        } else {
            $percent = 0;
        }
        return $percent;
    }
    public static function countKgiFromTeam($kgiId, $teamId, $month, $year)
    {
        // $kgiEmployee = KgiEmployee::find()
        //     ->select('e.picture,e.employeeId,e.gender')
        //     ->JOIN("LEFT JOIN", "employee e", "e.employeeId=kgi_employee.employeeId")
        //     ->where("kgi_employee.status!=99 and e.status!=99")
        //     ->andWhere([
        //         "kgi_employee.kgiId" => $kgiId,
        //         "e.teamId" => $teamId,
        //         "kgi_employee.month" => $month,
        //         "kgi_employee.year" => $year
        //     ])
        //     ->asArray()
        //     ->all();
        $kgiEmployee = KgiEmployee::find()
        ->alias('ke')
        ->select([
            'e.picture',
            'e.employeeId',
            'e.gender'
        ])
        ->leftJoin('employee e', 'e.employeeId = ke.employeeId')
        ->where(['IN', 'ke.status', [1, 2, 4, 5]])
        ->andWhere(['!=', 'e.status', 99])
        ->andWhere([
            'ke.kgiId' => $kgiId,
            'ke.month' => $month,
            'ke.year'  => $year,
            'e.teamId' => $teamId
        ])
        ->asArray()
        ->all();

        $employee = [];
        $img = "images/employee/status/employee-nopic.svg";
        if (isset($kgiEmployee) && count($kgiEmployee) > 0) {
            foreach ($kgiEmployee as $ke) :
                if ($ke["picture"] != "") {
                    //    $url = Path::frontendUrl() . $ke["picture"];
                    //        $headers = @get_headers($url);
                    //    if ($headers && strpos($headers[0], '200') !== false) {
                    $employee[$ke["employeeId"]] = $ke["picture"];
                    //    }
                } else {
                    $employee[$ke["employeeId"]] = $img;
                }
            endforeach;
        }
        return $employee;
    }
    public static function totolEmployeeInTeam($kgiId, $teamId)
    {
        $kgiEmployee = KgiEmployee::find()
            ->select('e.employeeId')
            ->JOIN("LEFT JOIN", "employee e", "e.employeeId=kgi_employee.employeeId")
            ->JOIN("LEFT JOIN", "team t", "t.teamId=e.teamId")
            ->where("kgi_employee.status!=99 and e.status!=99")
            ->andWhere([
                "kgi_employee.kgiId" => $kgiId,
                "e.teamId" => $teamId
            ])
            ->asArray()
            ->all();
        return count($kgiEmployee);
    }
    public static function checkComplete($kgiEmployeeId, $month, $year, $currentYear)
    {
        if ($month != '' && $year != '') {
            $kgiEmployeeHistory = KgiEmployeeHistory::find()
                ->where([
                    "kgiEmployeeId" => $kgiEmployeeId,
                    "status" => 2,
                    "month" => $month,
                    "year" => $year
                ])
                ->one();
        }
        if ($month == '' && $year != '') {
            if ($year != $currentYear) {
                return 1;
            } else {

                return 0;
            }
        }
        if ($month != '' && $year == '') {
            $kgiEmployeeHistory = KgiTeamHistory::find()
                ->where([
                    "kgiEmployeeId" => $kgiEmployeeId,
                    "status" => 2,
                    "month" => $month,
                    "year" => $currentYear
                ])
                ->one();
        }
        if ($month == '' && $year == '') {
            return 0;
        }

        if (isset($kgiEmployeeHistory) && !empty($kgiEmployeeHistory)) {
            return 1;
        } else {
            return 0;
        }
    }
}
