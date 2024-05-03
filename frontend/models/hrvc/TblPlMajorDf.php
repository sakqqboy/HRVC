<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\TblPlMajorDfMaster;

/**
* This is the model class for table "tbl_pl_major_df".
*
* @property integer $pl_major_id
* @property integer $list_order
* @property string $major_name
*/

class TblPlMajorDf extends \frontend\models\hrvc\master\TblPlMajorDfMaster{
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
