<?php

namespace frontend\models\hrvc;

use common\models\ModelMaster;
use Yii;
use \frontend\models\hrvc\master\KpiTeamMaster;

/**
 * This is the model class for table "kpi_team".
 *
 * @property integer $kpiTeamId
 * @property integer $kpiId
 * @property integer $teamId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class KpiTeam extends \frontend\models\hrvc\master\KpiTeamMaster
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
    public static function isInThisKpi($teamId, $kpiId)
    {
        $kpiTeam = kpiTeam::find()->where(["teamId" => $teamId, "kpiId" => $kpiId, "status" => [1, 2, 4]])->asArray()->one();
        $has = 0;
        if (isset($kpiTeam) && !empty($kpiTeam)) {
            $has = 1;
        }
        return $has;
    }
    public static function teamTarget($teamId, $kpiId)
    {
        $kpiTeam = KpiTeam::find()
            ->where(["teamId" => $teamId, "kpiId" => $kpiId])->asArray()->one();
        if (isset($kpiTeam) && !empty($kpiTeam)) {
            return $kpiTeam["target"];
        } else {
            return 0;
        }
    }
    public static function checkPermission($role, $kpiTeamId, $userId)
    {
        $show = 0;
        if ($role == 7) {
            $show = 1;
        }
        $kpiTeam = KpiTeam::find()->where(["kpiTeamId" => $kpiTeamId])->asArray()->one();
        $kpiId = $kpiTeam["kpiTeamId"];
        if ($role == 6) { //GM edit their company kpi
            $companyId = Company::userCompany($userId); //userId
            $branchId = Branch::checkCompanyBranch($companyId);
            $kpiBranch = KpiBranch::find()
                ->select('kpiBranchId')
                ->where(["kpiId" => $kpiId, "branchId" => $branchId, "status" => [1, 4]])
                ->asArray()
                ->one();
            if (isset($kpiBranch) && !empty($kpiBranch)) {
                $show = 1;
            }
        }
        if ($role == 5) { //Manager edit their company kpi
            $companyId = Company::userCompany($userId); //userId
            $branchId = Branch::checkCompanyBranch($companyId);
            $kpiBranch = KpiBranch::find()
                ->select('kpiBranchId')
                ->where(["kpiId" => $kpiId, "branchId" => $branchId, "status" => [1, 4]])
                ->asArray()
                ->one();
            if (isset($kpiBranch) && !empty($kpiBranch)) {
                $show = 1;
            }
        }
        if ($role == 4) { //Supervisor edit their department kpi
            $departmentId = Department::userDepartmentId($userId);
            $kpiDepartment = KpiDepartment::find()
                ->where(["kpiId" => $kpiId, "status" => [1, 4], "departmentId" => $departmentId])
                ->asArray()
                ->one();
            if (isset($kpiDepartment) && !empty($kpiDepartment)) {
                $show = 1;
            }
        }
        if ($role == 3) { //Team Leader edit their Team
            //$teamId = Team::userTeam($userId);
            $kpiTeam = KpiTeam::find()
                ->where(["kpiTeamId" => $kpiTeamId, "status" => [1, 4]])
                ->asArray()
                ->one();
            if (isset($kpiTeam) && !empty($kpiTeam)) {
                $show = 1;
            }
        }
        if ($role == 2 || $role == 1) {
            $show = 0;
        }
        return $show;
    }
    public static function kpiTeam($kpiId)
    {
        $kpiTeam = KpiTeam::find()
            ->select('t.teamName,t.teamId')
            //->JOIN("LEFT JOIN", "kpi", "kpi.kpiId=kpi_branch.kpiId")
            ->JOIN("LEFT JOIN", "team t", "t.teamId=kpi_team.teamId")
            ->where(["kpi_team.kpiId" => $kpiId, "kpi_team.status" => 1])
            ->orderBy('t.teamName')
            ->asArray()
            ->all();
        return $kpiTeam;
    }
    public static function isHasTeam($teamId, $kpiId)
    {
        $kpiTeam = KpiTeam::find()->where(["kpiId" => $kpiId, "teamId" => $teamId, "status" => [1, 2, 4]])->one();
        if (isset($kpiTeam) && !empty($kpiTeam)) {
            return 1;
        } else {
            return 0;
        }
    }
    public static function nextCheckDate($kpiTeamId)
    {
        $date = '';
        $kpiHistory = KpiTeamHistory::find()
            ->select('nextCheckDate')
            ->where(["kpiTeamId" => $kpiTeamId, "status" => [1, 4]])
            ->orderBy('kpiTeamHistoryId DESC')
            ->asArray()
            ->one();
        if (isset($kpiHistory) && !empty($kpiHistory) && $kpiHistory["nextCheckDate"] != '') {
            $date = ModelMaster::engDate($kpiHistory["nextCheckDate"], 2);
        }
        return $date;
    }

    public static function totalKpiTeam($adminId, $gmId, $managerId, $supervisorId, $teamLeaderId, $staffId)
    {
        $total = 0;
        if ($adminId != '' || $gmId != '') {
            $kpis = KpiTeam::find()
                ->where(["status" => [1, 2, 4]])
                ->orderBy('updateDateTime DESC')
                ->asArray()
                ->all();
        }
        if ($supervisorId != '' || $managerId != '') {
            $employeeId = Employee::employeeId($supervisorId == '' ? $managerId : $supervisorId);
            $branchId = Employee::EmployeeDetail($employeeId)["branchId"];
            $kpis = KpiTeam::find()
                ->JOIN("LEFT JOIN", "team t", "t.teamId=kpi_team.teamId")
                ->JOIN("LEFT JOIN", "employee e", "e.teamId=t.teamId")
                ->where([
                    "kpi_team.status" => [1, 2, 4],
                    "e.branchId" => $branchId
                ])
                ->orderBy('kpi_team.updateDateTime DESC')
                ->asArray()
                ->all();
        }
        if ($teamLeaderId != '') {
            $employeeId = Employee::employeeId($teamLeaderId);
            $teamId = Employee::employeeTeam($employeeId);
            if (isset($teamId["teamId"])) {
                $kpis = KpiTeam::find()
                    ->where([
                        "status" => [1, 2, 4],
                        "teamId" => $teamId
                    ])
                    ->orderBy('updateDateTime DESC')
                    ->asArray()
                    ->all();
            }
        }
        if ($staffId != '') {
            $employeeId = Employee::employeeId($staffId);
            $teamId = Employee::employeeTeam($employeeId);
            $kpis = KpiTeam::find()
                ->where([
                    "status" => [1, 2, 4],
                    "teamId" => $teamId
                ])
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
