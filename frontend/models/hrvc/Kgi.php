<?php

namespace frontend\models\hrvc;

use Exception;
use Yii;
use \frontend\models\hrvc\master\KgiMaster;

/**
 * This is the model class for table "kgi".
 *
 * @property integer $kgiId
 * @property string $kgiName
 * @property integer $companyId
 * @property integer $unitId
 * @property string $periodDate
 * @property string $targetAmount
 * @property string $month
 * @property string $kgiDetail
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

class Kgi extends \frontend\models\hrvc\master\KgiMaster
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
    public static function kgiName($kgiId)
    {
        $kgi = Kgi::find()->select('kgiName')->where(["kgiId" => $kgiId])->asArray()->one();
        return $kgi["kgiName"];
    }
    public static function checkPermission($role, $kgiId, $userId)
    {
        $show = 0;
        if ($role == 7) {
            $show = 1;
        }
        if ($role == 6) { //GM edit their company KGI
            $companyId = Company::userCompany($userId); //userId
            $branchId = Branch::checkCompanyBranch($companyId);
            $kgiBranch = KgiBranch::find()
                ->select('kgiBranchId')
                ->where(["kgiId" => $kgiId, "branchId" => $branchId, "status" => [1, 4]])
                ->asArray()
                ->one();
            if (isset($kgiBranch) && !empty($kgiBranch)) {
                $show = 1;
            }
        }
        if ($role == 5) { //Manager edit their company KGI
            $companyId = Company::userCompany($userId); //userId
            $branchId = Branch::checkCompanyBranch($companyId);
            $kgiBranch = KgiBranch::find()
                ->select('kgiBranchId')
                ->where(["kgiId" => $kgiId, "branchId" => $branchId, "status" => [1, 4]])
                ->asArray()
                ->one();
            if (isset($kgiBranch) && !empty($kgiBranch)) {
                $show = 1;
            }
        }
        if ($role == 4) { //Supervisor edit their department KGI
            $departmentId = Department::userDepartmentId($userId);
            $kgiDepartment = KgiDepartment::find()
                ->where(["kgiId" => $kgiId, "status" => [1, 4], "departmentId" => $departmentId])
                ->asArray()
                ->one();
            if (isset($kgiDepartment) && !empty($kgiDepartment)) {
                $show = 1;
            }
        }
        if ($role == 3) { //Team Leader edit their Team
            $teamId = Team::userTeam($userId);
            $kgiTeam = KgiTeam::find()
                ->where(["kgiId" => $kgiId, "status" => [1, 4], "teamId" => $teamId])
                ->asArray()
                ->one();
            if (isset($kgiTeam) && !empty($kgiTeam)) {
                $show = 1;
            }
        }
        if ($role == 2 || $role == 1) {
            $show = 0;
        }
        return $show;
    }
    public static function totalKgi($adminId, $gmId, $managerId, $supervisorId, $teamLeaderId, $staffId)
    {
        $total = 0;
        if (!empty($adminId) || !empty($gmId) || !empty($managerId)) {
            $kgis = Kgi::find()
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
            $kgis = Kgi::find()
                ->where([
                    "status" => [1, 2, 4],
                    "companyId" => $companyId
                ])
                ->asArray()
                ->orderBy('createDateTime DESC')
                ->asArray()
                ->all();
        }
        if (count($kgis) > 0) {
            $total = count($kgis);
        }
        return $total;
    }
    public static function totalKgiWithFilter($companyId, $branchId, $teamId, $month, $status, $year, $adminId, $gmId, $managerId, $supervisorId, $teamLeaderId, $staffId)
    {
        $total = 0;
        if (!empty($adminId) || !empty($gmId) || !empty($managerId)) {
            $kgis = Kgi::find()
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
            $kgis = Kgi::find()
                ->where([
                    "status" => [1, 2, 4],
                    "companyId" => $companyId
                ])
                ->asArray()
                ->orderBy('createDateTime DESC')
                ->asArray()
                ->all();
        }
        if (count($kgis) > 0) {
            $total = count($kgis);
        }
        return $total;
    }
}
