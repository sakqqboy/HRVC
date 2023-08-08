<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\PositionMaster;

/**
* This is the model class for table "position".
*
* @property integer $positionId
* @property string $positionName
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class Position extends \frontend\models\hrvc\master\PositionMaster{
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
