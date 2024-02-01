<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\KgiTeamHistoryMaster;

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

class KgiTeamHistory extends \frontend\models\hrvc\master\KgiTeamHistoryMaster
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
    public static function statusText($status)
    {
        if ($status == 1) {
            return 'Active';
        }
        if ($status == 2) {
            return 'Finished';
        }
        if ($status == 88) {
            return 'Wait for Approve';
        }
        return '';
    }
}
