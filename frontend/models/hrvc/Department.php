<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\DepartmentMaster;

/**
 * This is the model class for table "department".
 *
 * @property integer $departmentId
 * @property string $departmentName
 * @property integer $branchId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class Department extends \frontend\models\hrvc\master\DepartmentMaster
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
    public static function departmentNAme($departmentId)
    {
        $departmentName = "";
        if ($departmentId != '') {
            $department = Department::find()->select('departmentName')->where(["departmentId" => $departmentId])->asArray()->one();
            $departmentName = $department["departmentName"];
        }
        return   $departmentName;
    }
    public static function branchDepartment($branchId, $departmentName)
    {
        $department = Department::find()
            ->where(["branchId" => $branchId, "departmentName" => $departmentName, "status" => 1])
            ->asArray()
            ->one();
        if (isset($department) && !empty($department)) {
            return $department['departmentId'];
        } else {
            return "";
        }
    }
    public static function branchNameWithDepartmentName($text)
    {
        $textArr = explode('(Branch::', $text);
        $departmentName = $textArr[0];
        $branchName = substr($textArr[1], 0, -1);
        $department = Department::find()
            ->select('department.departmentId')
            ->JOIN("LEFT JOIN", "branch b", "b.branchId=department.branchId")
            ->where([
                "department.departmentName" => $departmentName,
                "b.branchName" => $branchName
            ])
            ->asArray()
            ->one();
        if (isset($department) && !empty($department)) {
            return $department["departmentId"];
        } else {
            return "";
        }
    }
    public static function userDepartmentId($userId)
    {
        $user = User::find()
            ->select('employeeId')
            ->where(["userId" => $userId])
            ->asArray()
            ->one();
        $employee = Employee::find()->select('departmentId')
            ->where(["employeeId" => $user["employeeId"]])
            ->asArray()
            ->one();
        return $employee["departmentId"];
    }
    public static function haveTeam($departmentId)
    {
        $teams = Team::find()->where(["departmentId" => $departmentId, "status" => 1])->all();
        if (isset($teams) && count($teams) > 0) {
            return 1;
        } else {
            return 0;
        }
    }
}
