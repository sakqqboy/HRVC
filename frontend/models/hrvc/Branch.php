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
}
