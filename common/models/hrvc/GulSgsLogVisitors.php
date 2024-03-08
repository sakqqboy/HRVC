<?php

namespace common\models\hrvc;

use Yii;
use \common\models\hrvc\master\GulSgsLogVisitorsMaster;

/**
* This is the model class for table "gul_sgs_log_visitors".
*
* @property integer $id
* @property string $ip
* @property integer $user_id
* @property integer $block
* @property integer $blocked_on
*/

class GulSgsLogVisitors extends \common\models\hrvc\master\GulSgsLogVisitorsMaster{
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
