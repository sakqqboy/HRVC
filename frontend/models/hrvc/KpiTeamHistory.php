<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\KpiTeamHistoryMaster;

/**
 * This is the model class for table "kpi_team_history".
 *
 * @property integer $kpiTeamHistoryId
 * @property integer $kpiTeamId
 * @property string $target
 * @property string $result
 * @property string $detail
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class KpiTeamHistory extends \frontend\models\hrvc\master\KpiTeamHistoryMaster
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
    public static function checkFinished($kpiTeamHistoryId, $kpiTeamId)
    {
        $kpiTeamHistory = KpiTeamHistory::find()->where(["kpiTeamId" => $kpiTeamId, "status" => 2])
            ->andWhere("kpiTeamHistoryId>$kpiTeamHistoryId")
            ->one();
        if (isset($kpiTeamHistory) && !empty($kpiTeamHistory)) {
            return 0;
        } else {
            return 1;
        }
    }
}
