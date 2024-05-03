<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\TblBranchPlAccountCodeMaster;

/**
* This is the model class for table "tbl_branch_pl_account_code".
*
* @property string $account_id
* @property string $create_datetime
* @property integer $branchId
* @property string $acc_code
* @property string $acc_name
* @property integer $pl_medium_id
* @property integer $breakdown_id
* @property integer $cash_flow_id
* @property string $cash_flow_type
* @property integer $list_order
* @property string $note
*/

class TblBranchPlAccountCode extends \backend\models\hrvc\master\TblBranchPlAccountCodeMaster{
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
