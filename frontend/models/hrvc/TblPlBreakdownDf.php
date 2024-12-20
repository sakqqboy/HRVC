<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\TblPlBreakdownDfMaster;

/**
* This is the model class for table "tbl_pl_breakdown_df".
*
* @property integer $breakdown_id
* @property integer $list_order
* @property string $breakdown_name
*/

class TblPlBreakdownDf extends \frontend\models\hrvc\master\TblPlBreakdownDfMaster{
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
