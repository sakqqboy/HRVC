<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\KgiBranchMaster;

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

class KgiBranch extends \frontend\models\hrvc\master\KgiBranchMaster
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
    public static function isInThisKgi($branchId, $kgiId)
    {
        $kgiBranch = KgiBranch::find()->where(["branchId" => $branchId, "kgiId" => $kgiId, "status" => 1])->asArray()->one();
        $has = 0;
        if (isset($kgiBranch) && !empty($kgiBranch)) {
            $has = 1;
        }
        return $has;
    }
    public static function kgiBranch($kgiId)
    {
        $kgiBranch = KgiBranch::find()
            ->select('b.branchId,b.branchName')
            ->JOIN("LEFT JOIN", "kgi", "kgi.kgiId=kgi_branch.kgiId")
            ->JOIN("LEFT JOIN", "branch b", "b.branchId=kgi_branch.branchId")
            ->where(["kgi_branch.kgiId" => $kgiId, "kgi.status" => 1, "kgi_branch.status" => 1])
            ->asArray()
            ->all();
        return $kgiBranch;
    }
}
