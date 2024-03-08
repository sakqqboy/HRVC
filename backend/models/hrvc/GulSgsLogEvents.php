<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\GulSgsLogEventsMaster;

/**
* This is the model class for table "gul_sgs_log_events".
*
* @property integer $id
* @property integer $visitor_id
* @property integer $ts
* @property string $activity
* @property string $description
* @property string $ip
* @property string $hostname
* @property string $code
* @property string $object_id
* @property string $type
* @property string $action
* @property string $visitor_type
*/

class GulSgsLogEvents extends \backend\models\hrvc\master\GulSgsLogEventsMaster{
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
