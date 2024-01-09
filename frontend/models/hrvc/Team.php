<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\TeamMaster;

/**
 * This is the model class for table "team".
 *
 * @property integer $teamId
 * @property string $teamName
 * @property integer $branchId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class Team extends \frontend\models\hrvc\master\TeamMaster
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
    public static function teamName($teamId)
    {
        $team = Team::find()->select('teamName')->where(["teamId" => $teamId])->asArray()->one();
        if (isset($team) && !empty($team)) {
            return $team["teamName"];
        } else {
            return '';
        }
    }
    public static function  employeeInTeam($teamId)
    {
        $employee = Employee::find()->where(["teamId" => $teamId])->asArray()->all();
        return count($employee);
    }
    public static function  teamLeader($teamId, $position)
    {
        $text = "";
        $employee = Employee::find()->select('employeeFirstname,employeeSurename')
            ->JOIN("LEFT JOIN", "team t", "t.teamId=employee.teamId")
            ->where(["employee.teamId" => $teamId, "employee.teamPositionId" => $position])
            ->orderBy('employee.employeeFirstname')
            ->asArray()
            ->all();
        if (isset($employee) && count($employee) > 0) {
            $i = 1;
            foreach ($employee as $em) :
                $text .= $em["employeeFirstname"] . " " . $em["employeeSurename"];
                if (count($employee) > 1 && $i != count($employee)) {
                    $text .= "<br>";
                }
                $i++;
            endforeach;
        } else {
            $text = "Not set";
        }
        return $text;
    }
    public static function departmentTeam($departmentId, $teamName)
    {
        $team = Team::find()
            ->where(["departmentId" => $departmentId, "teamName" => $teamName, "status" => 1])
            ->asArray()
            ->one();
        if (isset($team) && !empty($team)) {
            return $team["teamId"];
        } else {
            return '';
        }
    }
    public static function userTeam($userId)
    {
        $user = User::find()
            ->select('employeeId')
            ->where(["userId" => $userId])
            ->asArray()
            ->one();
        $employee = Employee::find()->select('teamId')
            ->where(["employeeId" => $user["employeeId"]])
            ->asArray()
            ->one();
        return $employee["teamId"];
    }
}
