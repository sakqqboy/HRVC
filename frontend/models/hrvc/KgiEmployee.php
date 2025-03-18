<?php

namespace frontend\models\hrvc;

use common\models\ModelMaster;
use Yii;
use \frontend\models\hrvc\master\KgiEmployeeMaster;

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

class KgiEmployee extends \frontend\models\hrvc\master\KgiEmployeeMaster
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
    public static function isHasEmployee($employeeId, $kgiId)
    {
        $kgiEmployee = KgiEmployee::find()->where(["kgiId" => $kgiId, "employeeId" => $employeeId, "status" => 1])->one();
        if (isset($kgiEmployee) && !empty($kgiEmployee)) {
            return 1;
        } else {
            return 0;
        }
    }
    public static function totalEmployee($kgiId)
    {
        $kgiEmployee = KgiEmployee::find()->where(["kgiId" => $kgiId, "status" => 1])->asArray()->all();
        if (isset($kgiEmployee) && count($kgiEmployee) > 0) {
            return count($kgiEmployee);
        } else {
            return 0;
        }
    }
    public static function canEdit($role, $kgiEmployeeId)
    {
        $canEdit = 0;

        if ($role >= 4) {
            $canEdit = 1;
        } else {
            $employeeId = User::employeeIdFromUserId();
            if ($role == 3) { //Team leader can Edit in their team
                $kgiEmployee = KgiEmployee::find()
                    ->select('e.teamId')
                    ->JOIN("LEFT JOIN", "employee e", "e.employeeId=kgi_employee.employeeId")
                    ->where(["kgi_employee.kgiEmployeeId" => $kgiEmployeeId])
                    ->asArray()
                    ->one();
                $employee = Employee::find()
                    ->select('teamId')
                    ->where(["employeeId" => $employeeId])
                    ->asArray()
                    ->one();
                if (isset($kgiEmployee) && isset($employee) && !empty($employee) && !empty($kgiEmployee)) {
                    if ($kgiEmployee["teamId"] == $employee["teamId"]) {
                        $canEdit = 1;
                    }
                }
            } else { //staff
                $canEdit = 1; //see only their kgi
            }
        }
        return $canEdit;
    }
    public static function nextCheckDate($kgiEmployeeId)
    {
        $date = '';
        $kgiHistory = KgiEmployeeHistory::find()
            ->select('nextCheckDate')
            ->where(["kgiEmployeeId" => $kgiEmployeeId, "status" => [1, 4]])
            ->orderBy('kgiEmployeeId DESC')
            ->asArray()
            ->one();
        if (isset($kgiHistory) && !empty($kgiHistory) && $kgiHistory["nextCheckDate"] != '') {
            $date = ModelMaster::engDate($kgiHistory["nextCheckDate"], 2);
        }
        return $date;
    }
    public static function countKgiEmployeeInTeam($teamId,$kgiId,$month,$year){
        $kgiEmployee = kgiEmployee::find()
        ->select('e.picture,e.employeeId,e.gender,kgi_employee.year,kgi_employee.month')
        ->JOIN("LEFT JOIN", "employee e", "e.employeeId=kgi_employee.employeeId")
        ->where("kgi_employee.status!=99 and e.status!=99")
        ->andWhere([
            "kgi_employee.kgiId" => $kgiId,
            "e.teamId" => $teamId,
            "kgi_employee.month" => $month,
            "kgi_employee.year" => $year
        ])
        ->asArray()
        ->all();
        $data=[];
        if(isset($kgiEmployee) && count( $kgiEmployee)>0){
            $i=0;
            foreach($kgiEmployee as $employee):
                if ($employee["picture"] != '') {
                    $img = $employee["picture"];
                } else {
                    if ($employee["gender"] == 1) {
                        $img = "image/user.png";
                    } else {
                        $img = "image/lady.png";
                    }
                }
            $data[$i]=$img;
            $i++;
            endforeach;
        }else{
            return null;
        }
            return $data;
    }
}