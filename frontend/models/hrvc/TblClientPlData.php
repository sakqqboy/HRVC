<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\TblClientPlDataMaster;

/**
* This is the model class for table "tbl_client_pl_data".
*
* @property string $pl_code_id
* @property string $month
* @property string $year
* @property double $amount
*/

class TblClientPlData extends \frontend\models\hrvc\master\TblClientPlDataMaster{
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
