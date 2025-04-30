<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\KgiHistoryMaster;

/**
 * This is the model class for table "kgi_history".
 *
 * @property integer $kgiHistoryId
 * @property integer $kgiId
 * @property string $kgiHistoryName
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

class KgiHistory extends \frontend\models\hrvc\master\KgiHistoryMaster
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
    public static function findKgiHistoryFromTeam($kgiTeamHistoryId)
    {
        $kgiTeamHistory = KgiTeamHistory::find()->where(["kgiTeamHistoryId" => $kgiTeamHistoryId])->asArray()->one();
        $kgiHistory = KgiHistory::find()
            ->select('kgi_history.kgiHistoryId')
            ->JOIN("LEFT JOIN", "kgi_team kt", "kt.kgiId=kgi_history.kgiId")
            ->JOIN("LEFT JOIN", "kgi_team_history kth", "kth.kgiTeamId=kt.kgiTeamId")
            ->where([
                "kth.kgiTeamHistoryId" => $kgiTeamHistoryId,
                "kgi_history.status" => [1, 2, 4],
                "kgi_history.month" => $kgiTeamHistory["month"],
                "kgi_history.year" => $kgiTeamHistory["year"],
            ])
            ->orderBy("kgi_history.status DESC,kgi_history.updateDateTime DESC")
            ->asArray()
            ->one();
        return $kgiHistory["kgiHistoryId"];
    }
}
