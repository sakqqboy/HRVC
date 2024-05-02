<?php

namespace common\models\hrvc;

use Yii;
use \common\models\hrvc\master\TblBranchPlDataMaster;

/**
* This is the model class for table "tbl_branch_pl_data".
*
* @property string $account_id
* @property integer $month
* @property integer $year
* @property string $actual_amount
* @property string $target_amount
* @property string $next_target_amount
*/

class TblBranchPlData extends \common\models\hrvc\master\TblBranchPlDataMaster{
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
}
