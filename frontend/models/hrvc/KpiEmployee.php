<?php

namespace frontend\models\hrvc;

use common\models\ModelMaster;
use Yii;
use \frontend\models\hrvc\master\KpiEmployeeMaster;

/**
 * This is the model class for table "kpi_employee".
 *
 * @property integer $kpiEmployeeId
 * @property integer $employeeId
 * @property integer $kpiId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class KpiEmployee extends \frontend\models\hrvc\master\KpiEmployeeMaster
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
    public static function isHasEmployee($employeeId, $kpiId)
    {
        $kpiEmployee = KpiEmployee::find()->where(["kpiId" => $kpiId, "employeeId" => $employeeId, "status" => 1])->one();
        if (isset($kpiEmployee) && !empty($kpiEmployee)) {
            return 1;
        } else {
            return 0;
        }
    }
    public static function totalEmployee($kpiId)
    {
        $kpiEmployee = KpiEmployee::find()->where(["kpiId" => $kpiId, "status" => 1])->asArray()->all();
        if (isset($kpiEmployee) && count($kpiEmployee) > 0) {
            return count($kpiEmployee);
        } else {
            return 0;
        }
    }
    public static function canEdit($role, $kpiEmployeeId)
    {
        $canEdit = 0;

        if ($role >= 4) {
            $canEdit = 1;
        } else {
            $employeeId = User::employeeIdFromUserId();
            if ($role == 3) { //Team leader can Edit in their team
                $kpiEmployee = KpiEmployee::find()
                    ->select('e.teamId')
                    ->JOIN("LEFT JOIN", "employee e", "e.employeeId=kpi_employee.employeeId")
                    ->where(["kpi_employee.kpiEmployeeId" => $kpiEmployeeId])
                    ->asArray()
                    ->one();
                $employee = Employee::find()
                    ->select('teamId')
                    ->where(["employeeId" => $employeeId])
                    ->asArray()
                    ->one();
                if (isset($kpiEmployee) && isset($employee) && !empty($employee) && !empty($kpiEmployee)) {
                    if ($kpiEmployee["teamId"] == $employee["teamId"]) {
                        $canEdit = 1;
                    }
                }
            } else { //staff
                $canEdit = 1;
            }
        }
        return $canEdit;
    }

    public static function employeeKpiTeamId($kpiEmployeeId)
    {
        $teamId = KpiEmployee::find()
            ->select('kpi_team.kpiTeamId')
            ->JOIN("LEFT JOIN", "employee", "employee.employeeId = kpi_employee.employeeId")
            ->JOIN("LEFT JOIN", "kpi_team", "kpi_team.teamId = employee.teamId")
            ->where(["kpi_employee.kpiEmployeeId" => $kpiEmployeeId])
            ->asArray()
            ->one();

        return $teamId["kpiTeamId"] ?? 0; // ถ้าไม่มีค่าให้คืนค่า 0
    }



    public static function nextCheckDate($kpiEmployeeId)
    {
        $date = '';
        $kpiHistory = KpiEmployeeHistory::find()
            ->select('nextCheckDate')
            ->where(["kpiEmployeeId" => $kpiEmployeeId, "status" => [1, 4]])
            ->orderBy('kpiEmployeeId DESC')
            ->asArray()
            ->one();
        if (isset($kpiHistory) && !empty($kpiHistory) && $kpiHistory["nextCheckDate"] != '') {
            $date = ModelMaster::engDate($kpiHistory["nextCheckDate"], 2);
        }
        return $date;
    }
    public static function countKpiEmployeeInTeam($teamId, $kpiId, $year, $month)
    {
        $kpiEmployee = KpiEmployee::find()
            ->select('e.picture,e.employeeId,e.gender,kpi_employee.year,kpi_employee.month')
            ->JOIN("LEFT JOIN", "employee e", "e.employeeId=kpi_employee.employeeId")
            ->where("kpi_employee.status!=99 and e.status!=99")
            ->andWhere([
                "kpi_employee.kpiId" => $kpiId,
                "e.teamId" => $teamId,
                "kpi_employee.month" => $month,
                "kpi_employee.year" => $year
            ])
            ->asArray()
            ->all();
        $data = [];
        if (isset($kpiEmployee) && count($kpiEmployee) > 0) {
            $i = 0;
            foreach ($kpiEmployee as $employee):
                if ($employee["picture"] != '') {
                    $img = $employee["picture"];
                } else {
                    if ($employee["gender"] == 1) {
                        $img = "image/user.png";
                    } else {
                        $img = "image/lady.png";
                    }
                }
                $data[$i] = $img;
                $i++;
            endforeach;
        } else {
            return null;
        }
        return $data;
    }

    public static function totalKpiEmployee($adminId, $gmId, $managerId, $supervisorId, $teamLeaderId, $staffId, $employeeId)
    {
        $total = 0;
        if ($adminId != '' || $gmId != '') {
            $kpis = KpiEmployee::find()
                ->where(["status" => [1, 2, 4]])
                ->asArray()
                ->orderBy('updateDateTime DESC')
                ->asArray()
                ->all();
        }
        if ($supervisorId != '' || $managerId != '') {
            if ($supervisorId != '') {
                $userId = $supervisorId;
            }
            if ($managerId != '') {
                $userId = $managerId;
            }
            $employeeId = Employee::employeeId($userId);
            $branchId = Employee::EmployeeDetail($employeeId)["branchId"];
            $kpis = KpiEmployee::find()
                ->JOIN("LEFT JOIN", "employee e", "e.employeeId=kpi_employee.employeeId")
                ->where([
                    "kpi_employee.status" => [1, 2, 4],
                    "e.branchId" => $branchId
                ])
                ->asArray()
                ->orderBy('kpi_employee.updateDateTime DESC')
                ->asArray()
                ->all();
        }
        if ($teamLeaderId != '') {
            $employeeId = Employee::employeeId($teamLeaderId);
            $teamId = Employee::employeeTeam($employeeId);
            if (isset($teamId["teamId"])) {
                $kpis = KpiEmployee::find()
                    ->JOIN("LEFT JOIN", "kpi k", "k.kpiId=kpi_employee.kpiId")
                    ->JOIN("LEFT JOIN", "employee e", "e.employeeId=kpi_employee.employeeId")
                    ->where([
                        "kpi_employee.status" => [1, 2, 4],
                        "k.status" => [1, 2, 4],
                        "e.teamId" => $teamId
                    ])
                    ->asArray()
                    ->orderBy('kpi_employee.updateDateTime DESC')
                    ->asArray()
                    ->all();
            }
        }
        if ($staffId != '') {
            $kpis = KpiEmployee::find()
                ->where([
                    "status" => [1, 2, 4],
                    "employeeId" => $employeeId
                ])
                ->asArray()
                ->orderBy('updateDateTime DESC')
                ->asArray()
                ->all();
        }
        if (isset($kpis) && count($kpis) > 0) {
            $total = count($kpis);
        }
        return $total;
    }
}
