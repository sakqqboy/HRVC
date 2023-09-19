<?php

namespace common\models\hrvc;

use Yii;
use \common\models\hrvc\master\KgiTeamMaster;

/**
* This is the model class for table "kgi_team".
*
* @property integer $kgiTeamId
* @property integer $kgiId
* @property integer $teamId
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class KgiTeam extends \common\models\hrvc\master\KgiTeamMaster{
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
