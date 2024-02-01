<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\KgiTeamMaster;

/**
 * This is the model class for table "kgi_team".
 *
 * @property integer $kgiTeamId
 * @property integer $kgiId
 * @property integer $teamId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class KgiTeam extends \frontend\models\hrvc\master\KgiTeamMaster
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
    public static function isInThisKgi($teamId, $kgiId)
    {
        $kgiTeam = KgiTeam::find()->where(["teamId" => $teamId, "kgiId" => $kgiId, "status" => 1])->asArray()->one();
        $has = 0;
        if (isset($kgiTeam) && !empty($kgiTeam)) {
            $has = 1;
        }
        return $has;
    }
    public static function teamTarget($teamId)
    {
        $kgiTeam = KgiTeam::find()
            ->where(["teamId" => $teamId])->asArray()->one();
        if (isset($kgiTeam) && !empty($kgiTeam)) {
            return $kgiTeam["target"];
        } else {
            return 0;
        }
    }
    public static function checkPermission($role, $kgiTeamId, $userId)
    {
        $show = 0;
        if ($role == 7) {
            $show = 1;
        }
        $kgiTeam = KgiTeam::find()->where(["kgiTeamId" => $kgiTeamId])->asArray()->one();
        $kgiId = $kgiTeam["kgiTeamId"];
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
            //$teamId = Team::userTeam($userId);
            $kgiTeam = KgiTeam::find()
                ->where(["kgiTeamId" => $kgiTeamId, "status" => [1, 4]])
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
}
