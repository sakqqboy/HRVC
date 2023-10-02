<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\KpiTeamMaster;

/**
 * This is the model class for table "kpi_team".
 *
 * @property integer $kpiTeamId
 * @property integer $kpiId
 * @property integer $teamId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class KpiTeam extends \frontend\models\hrvc\master\KpiTeamMaster
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
    public static function isInThisKpi($teamId, $kpiId)
    {
        $kpiTeam = kpiTeam::find()->where(["teamId" => $teamId, "kpiId" => $kpiId, "status" => 1])->asArray()->one();
        $has = 0;
        if (isset($kpiTeam) && !empty($kpiTeam)) {
            $has = 1;
        }
        return $has;
    }
}
