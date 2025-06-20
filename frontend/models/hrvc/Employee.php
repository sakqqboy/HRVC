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
    public static function employeeName($employeeId)
    {
        if ($employeeId != '') {
            $employee = Employee::find()
                ->select('employeeFirstname,employeeSurename')
                ->where(["employeeId" => $employeeId])
                ->asArray()
                ->one();
            return $employee["employeeFirstname"] . " " . $employee["employeeSurename"];
        } else {
            return '';
        }
    }
    public static function employeeDetailByUserId($userId)
    {
        $employee = [];
        if ($userId != '') {
            $user = User::find()->where(["userId" => $userId])->asArray()->one();
            if (isset($user) && !empty($user)) {
                $employee = Employee::find()->select('branchId,companyId')
                    ->where(["employeeId" => $user["employeeId"]])->asArray()->one();
            }
        }
        return $employee;
    }
    public static function employeeTitle($employeeId)
    {
        if ($employeeId != '') {
            $employee = Employee::find()
                ->select('t.titleName')
                ->JOIN("LEFT JOIN", "title t", "t.titleId=employee.titleId")
                ->where(["employee.employeeId" => $employeeId])
                ->asArray()
                ->one();
            return $employee["titleName"];
        } else {
            return '';
        }
    }
    public static function employeeBranch($employeeId)
    {
        if ($employeeId != '') {
            $employee = Employee::find()
                ->select('b.branchName')
                ->JOIN("LEFT JOIN", "branch b", "b.branchId=employee.branchId")
                ->where(["employee.employeeId" => $employeeId])
                ->asArray()
                ->one();
            return $employee["branchName"];
        } else {
            return '';
        }
    }
    public static function employeeTeam($employeeId)
    {
        $data = [];
        if ($employeeId != '') {
            $employee = Employee::find()
                ->select('t.teamName,t.teamId')
                ->JOIN("LEFT JOIN", "team t", "t.teamId=employee.teamId")
                ->where(["employee.employeeId" => $employeeId])
                ->asArray()
                ->one();

            $data = [
                "teamName" => $employee["teamName"],
                "teamId" => $employee["teamId"]
            ];
        }
        return $data;
    }
    public static function totalEmployee($companyId)
    {
        $count = Employee::find()
            ->where("status!=99")
            ->andFilterWhere(["companyId" => $companyId])
            ->count();
        return $count;
    }
    public static function totalDraft($companyId)
    {
        $count = Employee::find()
            ->where(["status" => 100])
            ->andFilterWhere(["companyId" => $companyId])
            ->count();
        return $count;
    }
    public static function totalEmployeeWithFilter($companyId, $branchId, $departmentId, $teamId, $employeeConditionId)
    {
        $employee = Employee::find()
            ->where(["status" => [1, 2, 3, 4, 5, 6, 7]])
            ->andFilterWhere([
                "companyId" => $companyId,
                "branchId" => $branchId,
                "departmentId" => $departmentId,
                "teamId" => $teamId,
                "employeeConditionId" => $employeeConditionId,
            ])
            ->count();
        return $employee;
    }
}
