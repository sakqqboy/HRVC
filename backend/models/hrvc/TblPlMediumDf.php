<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\TblPlMediumDfMaster;

/**
* This is the model class for table "tbl_pl_medium_df".
*
* @property integer $pl_medium_id
* @property integer $list_order
* @property string $medium_name
* @property string $pl_major_id
*/

class TblPlMediumDf extends \backend\models\hrvc\master\TblPlMediumDfMaster{
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
