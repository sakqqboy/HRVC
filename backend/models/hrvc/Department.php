<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\DepartmentMaster;

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

class Department extends \backend\models\hrvc\master\DepartmentMaster
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
    public static function userDepartmentId($userId)
    {
        $user = User::find()
            ->select('employeeId')
            ->where(["userId" => $userId])
            ->asArray()
            ->one();
        $employee = Employee::find()->select('departmentId')->where(["employeeId" => $user["employeeId"]])->asArray()->one();
        return $employee["departmentId"];
    }
    public static function departmentName($departmentId)
    {
        $department = Department::find()->select('departmentName')->where(["departmentId" => $departmentId])->asArray()->one();
        return $department["departmentName"];
    }
    public static function teamDepartment($teamId)
    {
        $team = Team::find()->where(["teamId" => $teamId])->asArray()->one();
        $departmentName = '';
        if (isset($team) && $team["departmentId"] != '') {
            $department = Department::find()
                ->select('departmentName')
                ->where(["departmentId" => $team["departmentId"]])
                ->asArray()
                ->one();
            if (isset($department)) {
                $departmentName = $department["departmentName"];
            }
        }
        return $departmentName;
    }
}
