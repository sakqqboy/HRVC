<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\KgiBranchMaster;

/**
 * This is the model class for table "kgi_branch".
 *
 * @property integer $kgiBranchId
 * @property integer $kgiId
 * @property integer $branchId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class KgiBranch extends \backend\models\hrvc\master\KgiBranchMaster
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
    public static function kgiBranch($kgiId)
    {
        $kgiBranch = KgiBranch::find()
            ->select('b.branchName,kgi_branch.branchId')
            ->JOIN("LEFT JOIN", "branch b", "b.branchId=kgi_branch.branchId")
            ->where(["b.status" => 1, "kgi_branch.status" => 1, "kgi_branch.kgiId" => $kgiId])
            ->asArray()
            ->all();
        $branchName = '';
        if (count($kgiBranch) > 0) {
            if (count($kgiBranch) == 1) {
                foreach ($kgiBranch as $branch) :
                    $branchName = $branch["branchName"];
                endforeach;
            } else {
                $branchName = count($kgiBranch) . " Branches";
            }
        }
        return $branchName;
    }
    public static function kgiBranches($kgiId)
    {
        $kgiBranches = KgiBranch::find()->select('b.branchName,b.branchId')
            ->JOIN("LEFT JOIN", "branch b", "b.branchId=kgi_branch.branchId")
            ->where(["kgi_branch.kgiId" => $kgiId, "kgi_branch.status" => 1])
            ->asArray()
            ->orderBy("b.branchName")
            ->all();
        $branches = [];
        if (isset($kgiBranches) && count($kgiBranches) > 0) {
            foreach ($kgiBranches as $branch) :
                $branches[$branch["branchId"]] = $branch["branchName"];
            endforeach;
        }
        return $branches;
    }
}
