<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\KpiHistoryMaster;

/**
 * This is the model class for table "kpi_history".
 *
 * @property integer $kpiHistoryId
 * @property integer $kpiId
 * @property string $kpiHistoryName
 * @property integer $unitId
 * @property string $periodDate
 * @property string $nextCheckDate
 * @property string $targetAmount
 * @property string $month
 * @property string $titleProcess
 * @property string $description
 * @property string $remark
 * @property integer $quantRatio
 * @property string $priority
 * @property integer $amountType
 * @property string $code
 * @property string $result
 * @property integer $createrId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class KpiHistory extends \frontend\models\hrvc\master\KpiHistoryMaster
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
    public static function findKpiHistoryFromTeam($kpiTeamHistoryId)
    {
        $kpiTeamHistory = KpiTeamHistory::find()->where(["kpiTeamHistoryId" => $kpiTeamHistoryId])->asArray()->one();
        $kpiHistory = KpiHistory::find()
            ->select('kpi_history.kpiHistoryId')
            ->JOIN("LEFT JOIN", "kpi_team kt", "kt.kpiId=kpi_history.kpiId")
            ->JOIN("LEFT JOIN", "kpi_team_history kth", "kth.kpiTeamId=kt.kpiTeamId")
            ->where([
                "kth.kpiTeamHistoryId" => $kpiTeamHistoryId,
                "kpi_history.status" => [1, 2, 4],
                "kpi_history.month" => $kpiTeamHistory["month"],
                "kpi_history.year" => $kpiTeamHistory["year"],
            ])
            ->orderBy("kpi_history.status DESC,kpi_history.updateDateTime DESC")
            ->asArray()
            ->one();
        return $kpiHistory["kpiHistoryId"];
    }
}
