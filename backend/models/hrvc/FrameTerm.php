<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\FrameTermMaster;

/**
* This is the model class for table "frame_term".
*
* @property integer $termId
* @property string $termName
* @property integer $frameId
* @property integer $sort
* @property string $startDate
* @property string $endDate
* @property string $midDate
* @property integer $isIncludeBous
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class FrameTerm extends \backend\models\hrvc\master\FrameTermMaster{
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
