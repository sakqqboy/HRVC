<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\BranchMaster;

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
}
