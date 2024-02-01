<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\KfiBranchMaster;

/**
 * This is the model class for table "kfi_branch".
 *
 * @property integer $kfiBranchId
 * @property integer $kfiId
 * @property integer $branchId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class KfiBranch extends \backend\models\hrvc\master\KfiBranchMaster
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
    public static function kfiBranch($kfiId)
    {
        $kfiBranch = KfiBranch::find()->select('b.branchName,b.branchId')
            ->JOIN("LEFT JOIN", "branch b", "b.branchId=kfi_branch.branchId")
            ->where(["kfi_branch.kfiId" => $kfiId, "kfi_branch.status" => 1])
            ->asArray()
            ->orderBy("b.branchName")
            ->all();
        $branches = [];
        if (isset($kfiBranch) && count($kfiBranch) > 0) {
            foreach ($kfiBranch as $branch) :
                $branches[$branch["branchId"]] = $branch["branchName"];
            endforeach;
        }
        return $branches;
    }
    public static function kfiBranchShort($kfiId)
    {
        $kfiBranch = KfiBranch::find()
            ->select('b.branchName,kfi_branch.branchId')
            ->JOIN("LEFT JOIN", "branch b", "b.branchId=kfi_branch.branchId")
            ->where(["b.status" => 1, "kfi_branch.status" => 1, "kfi_branch.kfiId" => $kfiId])
            ->asArray()
            ->all();
        $branchName = '';
        if (count($kfiBranch) > 0) {
            if (count($kfiBranch) == 1) {
                foreach ($kfiBranch as $branch) :
                    $branchName = $branch["branchName"];
                endforeach;
            } else {
                $branchName = count($kfiBranch) . " Branches";
            }
        }
        return $branchName;
    }
}
