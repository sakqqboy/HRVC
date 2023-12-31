<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\KgiEmployeeMaster;

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
    public static function kgiEmployee($kgiId)
    {
        // $kgiEmployee = Employee::find()
        //     ->select('employee.picture,employee.employeeId,employee.gender')
        //     ->JOIN("LEFT JOIN", "kgi_employee ke", "employee.employeeId=ke.employeeId")
        //     ->where(["ke.kgiId" => $kgiId, "ke.status" => 1])
        //     ->asArray()
        //     ->all();
        $kgiEmployee = KgiEmployee::find()
            ->select('e.picture,e.employeeId,e.gender')
            ->JOIN("LEFT JOIN", "employee e", "e.employeeId=kgi_employee.employeeId")
            ->where(["kgi_employee.status" => [1, 2], "kgi_employee.kgiId" => $kgiId, "e.status" => 1])
            ->andWhere("kgi_employee.employeeId is not null")
            ->asArray()
            ->all();
        $employee = [];
        if (isset($kgiEmployee) && count($kgiEmployee) > 0) {
            foreach ($kgiEmployee as $ke) :
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
}
