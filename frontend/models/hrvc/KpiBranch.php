<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\KpiBranchMaster;

/**
 * This is the model class for table "kpi_branch".
 *
 * @property integer $kpiBranchId
 * @property integer $kpiId
 * @property integer $branchId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class KpiBranch extends \frontend\models\hrvc\master\KpiBranchMaster
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
    public static function isInThisKpi($branchId, $kpiId)
    {
        $kpiBranch = KpiBranch::find()->where(["branchId" => $branchId, "kpiId" => $kpiId, "status" => 1])->asArray()->one();
        $has = 0;
        if (isset($kpiBranch) && !empty($kpiBranch)) {
            $has = 1;
        }
        return $has;
    }
    public static function kpiBranch($kpiId)
    {
        $kpiBranch = KpiBranch::find()
            ->select('b.branchId,b.branchName')
            ->JOIN("LEFT JOIN", "kpi", "kpi.kpiId=kpi_branch.kpiId")
            ->JOIN("LEFT JOIN", "branch b", "b.branchId=kpi_branch.branchId")
            ->where(["kpi_branch.kpiId" => $kpiId, "kpi.status" => 1, "kpi_branch.status" => 1, "b.status" => 1])
            ->asArray()
            ->all();
        return $kpiBranch;
    }
}
