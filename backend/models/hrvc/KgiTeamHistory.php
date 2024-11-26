<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\KgiTeamHistoryMaster;
use common\models\ModelMaster;

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

class KgiTeamHistory extends \backend\models\hrvc\master\KgiTeamHistoryMaster
{
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
    public static function nextCheckDate($kgiTeamHistoryId)
    {
        $date = '';
        $kgiHistory = KgiTeamHistory::find()
            ->select('nextCheckDate')
            ->where(["kgiTeamHistoryId" => $kgiTeamHistoryId, "status" => [1, 2, 4]])
            ->asArray()
            ->one();
        if (isset($kgiHistory) && !empty($kgiHistory) && $kgiHistory["nextCheckDate"] != '') {
            $date = ModelMaster::engDate($kgiHistory["nextCheckDate"], 2);
        }
        return $date;
    }
}
