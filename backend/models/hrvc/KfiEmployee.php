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
}
