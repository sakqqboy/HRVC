<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\KfiBranchMaster;

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

class KfiBranch extends \frontend\models\hrvc\master\KfiBranchMaster
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
    public static function isInThisKfi($branchId, $kfiId)
    {
        $kfiBranch = kfiBranch::find()->where(["branchId" => $branchId, "kfiId" => $kfiId, "status" => 1])->asArray()->one();
        $has = 0;
        if (isset($kfiBranch) && !empty($kfiBranch)) {
            $has = 1;
        }
        return $has;
    }
    public static function kfiBranch($kfiId)
    {
        $kfiBranch = KfiBranch::find()
            ->select('b.branchId,b.branchName')
            ->JOIN("LEFT JOIN", "kfi", "kfi.kfiId=kfi_branch.kfiId")
            ->JOIN("LEFT JOIN", "branch b", "b.branchId=kfi_branch.branchId")
            ->where(["kfi_branch.kfiId" => $kfiId, "kfi.status" => 1, "kfi_branch.status" => 1])
            ->asArray()
            ->all();
        return $kfiBranch;
    }
}
