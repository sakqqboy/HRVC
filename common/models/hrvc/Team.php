<?php

namespace common\models\hrvc;

use Yii;
use \common\models\hrvc\master\TeamMaster;

/**
* This is the model class for table "team".
*
* @property integer $teamId
* @property string $teamName
* @property integer $branchId
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class Team extends \common\models\hrvc\master\TeamMaster{
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
