<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\KpiMaster;

/**
 * This is the model class for table "kpi".
 *
 * @property integer $kpiId
 * @property string $kpiName
 * @property integer $companyId
 * @property integer $unitId
 * @property string $periodDate
 * @property string $targetAmount
 * @property string $month
 * @property string $kpiDetail
 * @property integer $quantRatio
 * @property string $priority
 * @property integer $amountType
 * @property string $code
 * @property string $result
 * @property integer $createrId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class Kpi extends \frontend\models\hrvc\master\KpiMaster
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
    public static function checkPermission($role, $kpiId, $userId)
    {
        $show = 0;
        if ($role == 7) {
            $show = 1;
        }
        if ($role == 6) { //GM edit their company KPI
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
        if ($role == 5) { //Manager edit their company KPI
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
        if ($role == 4) { //Supervisor edit their department KPI
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
            $teamId = Team::userTeam($userId);
            $kpiTeam = KpiTeam::find()
                ->where(["kpiId" => $kpiId, "status" => [1, 4], "teamId" => $teamId])
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
    public static function kpiName($kpiId)
    {
        $kpi = Kpi::find()->select('kpiName')->where(["kpiId" => $kpiId])->asArray()->one();
        return $kpi["kpiName"];
    }

     public static function totalKpi($adminId, $gmId, $managerId, $supervisorId, $teamLeaderId, $staffId)
    {
        $total = 0;
        if (!empty($adminId) || !empty($gmId) || !empty($managerId)) {
            $kpis = Kpi::find()
                ->where(["status" => [1, 2, 4]])
                ->asArray()
                ->orderBy('createDateTime DESC')
                ->asArray()
                ->all();
        }
        if (!empty($supervisorId) || !empty($teamLeaderId) || !empty($staffId)) {
            if ($supervisorId != '') {
                $userId = $supervisorId;
            }
            if ($teamLeaderId != '') {
                $userId = $teamLeaderId;
            }
            if ($staffId != '') {
                $userId = $staffId;
            }
            $employeeId = Employee::employeeId($userId);
            $companyId = Employee::EmployeeDetail($employeeId)["companyId"];
            $kpis = Kpi::find()
                ->where([
                    "status" => [1, 2, 4],
                    "companyId" => $companyId
                ])
                ->asArray()
                ->orderBy('createDateTime DESC')
                ->asArray()
                ->all();
        }
        if (count($kpis) > 0) {
            $total = count($kpis);
        }
        return $total;
    }
}