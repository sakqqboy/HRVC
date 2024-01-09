<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\BranchMaster;
use Exception;

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

class Branch extends \backend\models\hrvc\master\BranchMaster
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
    public static function branchName($branchId)
    {
        $branch = Branch::find()->select('branchName')->where(["branchId" => $branchId])->one();
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
    public static function companyBranch($companyId)
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
        return $branchId;
        //throw new Exception(print_r($branches, true));
    }
}
