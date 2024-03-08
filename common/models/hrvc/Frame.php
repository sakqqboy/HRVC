<?php

namespace common\models\hrvc;

use Yii;
use \common\models\hrvc\master\FrameMaster;

/**
* This is the model class for table "frame".
*
* @property integer $frameId
* @property string $frameName
* @property string $startDate
* @property string $endDate
* @property integer $attributeId
* @property integer $isMid
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class Frame extends \common\models\hrvc\master\FrameMaster{
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
