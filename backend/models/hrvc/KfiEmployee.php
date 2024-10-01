<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\KfiEmployeeMaster;

/**
 * This is the model class for table "kfi_employee".
 *
 * @property integer $kfiEmployeeId
 * @property integer $employeeId
 * @property integer $kfiId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class KfiEmployee extends \backend\models\hrvc\master\KfiEmployeeMaster
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
    public static function kfiEmployee($kfiId)
    {
        $kfiEmployee = Employee::find()
            ->select('employee.picture,employee.employeeId,employee.gender')
            ->JOIN("LEFT JOIN", "kfi_employee ke", "employee.employeeId=ke.employeeId")
            ->where(["ke.kfiId" => $kfiId, "ke.status" => 1])
            ->asArray()
            ->all();
        $employee = [];
        if (isset($kfiEmployee) && count($kfiEmployee) > 0) {
            foreach ($kfiEmployee as $ke) :
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
    public static function countKfiFromEmployee($employeeId)
    {
        $kfiEmployee = KfiEmployee::find()
            ->where(["employeeId" => $employeeId, "status" => [1, 2, 4]])
            ->asArray()
            ->all();
        return count($kfiEmployee);
    }
    public static function employeeKfiRatio($employeeId)
    {
        $kfiEmployee = KfiEmployee::find()
            ->where(["employeeId" => $employeeId, "status" => [1, 2, 4]])
            ->asArray()
            ->all();
        $totalRatio = 0;
        $totalKfi = 0;
        if (isset($kfiEmployee) && count($kfiEmployee) > 0) {
            $totalKfi = count($kfiEmployee);
            foreach ($kfiEmployee as $ke) :
                $ratio = 0;
                $kfi = Kfi::find()
                    ->where(["status" => [1, 2, 4], "kfiId" => $ke["kfiId"]])
                    ->asArray()
                    ->one();
                $kfiHistory = KfiHistory::find()
                    ->where(["kfiId" => $ke["kfiId"], "status" => [1, 2, 4]])
                    ->asArray()
                    ->orderBy("createDateTime DESC")
                    ->one();
                if (isset($kfiHistory) && !empty($kfiHistory)) {
                    if ($kfi["targetAmount"] == null || $kfi["targetAmount"] == '' || $kfi["targetAmount"] == 0) {
                        $ratio = 0;
                    } else {
                        if ($kfiHistory["code"] == '<' || $kfiHistory["code"] == '=') {
                            $ratio = ((int)$kfiHistory['result'] / (int)$kfi["targetAmount"]) * 100;
                        } else {
                            if ($kfiHistory["result"] != '' && $kfiHistory["result"] != 0) {
                                $ratio = ((int)$kfi["targetAmount"] / (int)$kfiHistory["result"]) * 100;
                            } else {
                                $ratio = 0;
                            }
                        }
                    }
                    $totalRatio += $ratio;
                }
            endforeach;
        }
        if ($totalKfi > 0) {
            $percent = $totalRatio / $totalKfi;
        } else {
            $percent = 0;
        }
        return $percent;
    }
    public static function kfiEmployeeDetail($kfiId)
    {
        $kfiEmployee = KfiEmployee::find()
            ->select('e.picture,e.employeeId,e.gender,t.titleName,e.employeeFirstname,e.employeeSurename')
            ->JOIN("LEFT JOIN", "employee e", "e.employeeId=kfi_employee.employeeId")
            ->JOIN("LEFT JOIN", "title t", "t.titleId=e.titleId")
            ->where(["kfi_employee.status" => [1, 2, 4], "kfi_employee.kfiId" => $kfiId, "e.status" => 1])
            ->andWhere("kfi_employee.employeeId is not null")
            ->asArray()
            ->all();
        $employee = [];
        if (isset($kfiEmployee) && count($kfiEmployee) > 0) {
            foreach ($kfiEmployee as $ke) :
                if ($ke["picture"] != "") {
                    $employee[$ke["employeeId"]]["picture"] = $ke["picture"];
                } else {
                    if ($ke["gender"] == 1) {
                        $employee[$ke["employeeId"]]["picture"] = 'image/user.png';
                    } else {

                        $employee[$ke["employeeId"]]["picture"] = 'image/lady.jpg';
                    }
                }
                $employee[$ke["employeeId"]]["name"] = $ke["employeeFirstname"] . ' ' . $ke["employeeSurename"];
                $employee[$ke["employeeId"]]["title"] = $ke["titleName"];
            endforeach;
        }
        return $employee;
    }
}
