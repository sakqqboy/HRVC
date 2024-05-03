<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\TblPlMajorDfMaster;

/**
* This is the model class for table "tbl_pl_major_df".
*
* @property integer $pl_major_id
* @property integer $list_order
* @property string $major_name
*/

class TblPlMajorDf extends \backend\models\hrvc\master\TblPlMajorDfMaster{
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
