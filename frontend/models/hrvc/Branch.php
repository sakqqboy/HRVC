<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\BranchMaster;

/**
 * This is the model class for table "branch".
 *
 * @property integer $branchId
 * @property string $branchName
 * @property integer $countryId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class Branch extends \frontend\models\hrvc\master\BranchMaster
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
    public static function companyName($branchId)
    {
        $branch = Branch::find()->select('companyId')->where(["branchId" => $branchId])->asArray()->one();
        $company = Company::find()->where(["companyId" => $branch["companyId"]])->asArray()->one();
        return $company["companyName"];
    }
    public static function branchName($branchId)
    {
        $branch = Branch::find()->select('branchName')->where(["branchId" => $branchId])->asArray()->one();
        return $branch["branchName"];
    }
    public static function kfiBranchName($kfiId)
    {
        $kfiBranch = KfiBranch::find()->select('b.branchName')
            ->JOIN("LEFT JOIN", "branch b", "b.branchId=kfi_branch.branchId")
            ->where(["kfi_branch.kfiId" => $kfiId])
            ->asArray()
            ->orderBy("b.branchName")
            ->all();
        //throw new Exception(print_r($kfiBranch, true));
        $branchName = '';
        if (isset($kfiBranch) && count($kfiBranch) > 0) {
            foreach ($kfiBranch as $branch) :
                if (count($kfiBranch) == 1) {
                    $branchName .= $branch["branchName"];
                } else {
                    $branchName .= 'All';
                    break;
                }
            endforeach;
        }
        return $branchName;
    }
    public static function branchFlag($branchId)
    {
        $branch = Branch::find()
            ->select('companyId')
            ->where(["branchId" => $branchId])
            ->asArray()
            ->one();
        $company = Company::find()
            ->select('countryId')
            ->where(["companyId" => $branch["companyId"]])
            ->asArray()
            ->one();
        $country = Country::find()
            ->select('flag')
            ->where(["countryId" => $company["countryId"]])
            ->asArray()
            ->one();
        if ($country["flag"] != '') {
            return $country["flag"];
        } else {
            return "";
        }
    }
    public static function companyBranch($companyId, $branchName)
    {
        $branch = Branch::find()
            ->where(["companyId" => $companyId, "branchName" => $branchName, "status" => 1])
            ->asArray()
            ->one();
        if (isset($branch) && !empty($branch)) {
            return $branch["branchId"];
        } else {
            return '';
        }
    }
    public static function checkCompanyBranch($companyId)
    {
        $branches = Branch::find()->select('branchId')
            ->where(["companyId" => $companyId])
            ->asArray()
            ->orderBy('branchId')
            ->all();
        $branchId = [];
        if (isset($branches) && count($branches) > 0) {
            $i = 0;
            foreach ($branches as $branch) :
                $branchId[$i] = $branch["branchId"];
                $i++;
            endforeach;
        } else {
            $branchId[0] = 0;
        }
    }
    public static function userBranchId($userId)
    {
        $user = User::find()
            ->select('employeeId')
            ->where(["userId" => $userId])
            ->asArray()
            ->one();
        $employee = Employee::find()
            ->select('branchId')
            ->where(["employeeId" => $user["employeeId"]])
            ->asArray()
            ->one();
        return $employee["branchId"];
    }
    public static function haveDepartment($branchId)
    {
        $department = Department::find()->where(["branchId" => $branchId, "status" => 1])->all();
        if (isset($department) && count($department) > 0) {
            return 1;
        } else {
            return 0;
        }
    }
}
