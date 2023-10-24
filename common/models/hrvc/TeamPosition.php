<?php

namespace common\models\hrvc;

use Yii;
use \common\models\hrvc\master\TeamPositionMaster;

/**
* This is the model class for table "team_position".
*
* @property integer $teamPositionId
* @property string $teamPositionName
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class TeamPosition extends \common\models\hrvc\master\TeamPositionMaster{
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
