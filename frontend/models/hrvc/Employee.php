<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\EmployeeMaster;

/**
 * This is the model class for table "employee".
 *
 * @property integer $employeeId
 * @property string $employeeNumber
 * @property string $employeeFirstname
 * @property string $employeeSurename
 * @property string $employeeNickname
 * @property integer $gender
 * @property string $birthDate
 * @property string $email
 * @property string $telephoneNumber
 * @property integer $branchId
 * @property integer $departmentId
 * @property integer $positionId
 * @property integer $teamId
 * @property string $hireDate
 * @property string $picture
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class Employee extends \frontend\models\hrvc\master\EmployeeMaster
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
    public static function calculateDate($joinDate)
    {
        $today = date("Y-m-d");
        $now = strtotime($today);
        $joinDate = strtotime($joinDate);
        if ($now > $joinDate) {
            $diff = $now - $joinDate;
            $diffDate = floor($diff / 86400); //จำนวนวันที่ต่างกัน
            $years = floor($diffDate / 365);
            $diffYear = $diffDate % 365;
            $month = floor($diffYear / 30);
            $diffMonth = $month % 30;
            return $years . " Years " . $month . " months " . $diffMonth . " days";
        } else {
            return 0;
        }
    }
}
