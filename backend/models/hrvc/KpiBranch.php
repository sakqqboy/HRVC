<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\KpiBranchMaster;

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

class KpiBranch extends \backend\models\hrvc\master\KpiBranchMaster
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
    public static function kpiBranch($kpiId)
    {
        $kpiBranch = KpiBranch::find()
            ->select('b.branchName,kpi_branch.branchId')
            ->JOIN("LEFT JOIN", "branch b", "b.branchId=kpi_branch.branchId")
            ->where(["b.status" => 1, "kpi_branch.status" => 1, "kpi_branch.kpiId" => $kpiId])
            ->asArray()
            ->all();
        $branchName = '';
        if (count($kpiBranch) > 0) {
            if (count($kpiBranch) == 1) {
                foreach ($kpiBranch as $branch) :
                    $branchName = $branch["branchName"];
                endforeach;
            } else {
                $branchName = count($kpiBranch) . " Branches";
            }
        }
        return $branchName;
    }
}
