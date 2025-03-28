<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\TblPlCashFlowDfMaster;

/**
* This is the model class for table "tbl_pl_cash_flow_df".
*
* @property integer $cash_flow_id
* @property integer $list_order
* @property string $cash_flow_name
*/

class TblPlCashFlowDf extends \backend\models\hrvc\master\TblPlCashFlowDfMaster{
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
