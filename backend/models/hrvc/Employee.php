<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\EmployeeMaster;
use common\helpers\Path;
use Exception;

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

class Employee extends \backend\models\hrvc\master\EmployeeMaster
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
    public static function EmployeeDetail($employeeId)
    {
        $employee = Employee::find()->where(["employeeId" => $employeeId])->asArray()->one();
        return $employee;
    }
    public static function employeeId($userId)
    {
        $user = User::find()
            ->select('employeeId')
            ->where(["userId" => $userId])
            ->asArray()
            ->one();
        if (isset($user) && !empty($user)) {
            return $user["employeeId"];
        } else {
            return null;
        }
    }
    public static function employeeId2($userId)
    {
        if ($userId == null) {
            return null;
        }
        $user = User::find()
            ->select('employeeId')
            ->where(["userId" => $userId])
            ->asArray()
            ->one();
        if (isset($user) && !empty($user)) {
            return $user["employeeId"];
        } else {
            return 0;
        }
    }
    public static function employeeImage($employeeId)
    {
        $employee = Employee::find()
            ->select('picture')
            ->where(["employeeId" => $employeeId])
            ->asArray()
            ->one();
        $img = "images/employee/status/employee-nopic.svg";
        if (!empty($employee) && !empty($employee["picture"])) {
            $url = Path::frontendUrl() . $employee["picture"];

            // ดึง headers
            $headers = @get_headers($url);

            if ($headers !== false && strpos($headers[0], '200') !== false) {
                $img = $employee["picture"];
            }
        }
        return $img;
    }
}