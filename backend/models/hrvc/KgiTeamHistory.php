<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\KgiTeamHistoryMaster;

/**
* This is the model class for table "kgi_team_history".
*
* @property integer $kgiTeamHistoryId
* @property integer $kgiTeamId
* @property string $target
* @property string $result
* @property string $detail
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class KgiTeamHistory extends \backend\models\hrvc\master\KgiTeamHistoryMaster{
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
