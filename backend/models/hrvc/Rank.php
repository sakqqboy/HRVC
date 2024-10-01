<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\RankMaster;
use Exception;

/**
 * This is the model class for table "rank".
 *
 * @property integer $rankId
 * @property string $rankName
 * @property integer $termId
 * @property string $max
 * @property string $min
 * @property string $increasement
 * @property string $bonusRate
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateaTime
 */

class Rank extends \backend\models\hrvc\master\RankMaster
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
    public static function calculateEmployeeRank($termId, $employeeId)
    {
        $pimWeight = EmployeePimWeight::find()
            ->where(["termId" => $termId, "employeeId" => $employeeId])
            ->asArray()
            ->one();
        $kfiWeight = 0;
        $kgiWeight = 0;
        $kpiWeight = 0;
        $totalKfi = 0;
        $totalKgi = 0;
        $totalKpi = 0;
        $kfiPoint = 0;
        $kgiPoint = 0;
        $kpiPoint = 0;
        $rank = [];
        if (isset($pimWeight) && !empty($pimWeight)) {
            $kfiWeight = $pimWeight["kfiWeight"];
            $kgiWeight = $pimWeight["kgiWeight"];
            $kpiWeight = $pimWeight["kpiWeight"];
            $kfiWeights = KfiWeight::find()
                ->where(["employeeId" => $employeeId, "termId" => $termId, "status" => 1])
                ->asArray()
                ->orderBy('createDateTime')
                ->all();
            if (isset($kfiWeights) && count($kfiWeights) > 0) {
                $i = 0;
                $totalKfi = 0;
                $pointKfi = [];
                foreach ($kfiWeights as $kfi) :
                    $kfiFinalScore = $kfi["finalScore"];
                    $pointKfi[$i] = (($kfi["weight"] / 100) * 6) * count($kfiWeights) / 6 * $kfiFinalScore;
                    $totalKfi += $pointKfi[$i];
                    $i++;
                endforeach;
                if ($totalKfi >= 0) {
                    $kfiPoint = $totalKfi * 100 / (6 * count($kfiWeights)) * ($kfiWeight / 100);
                }
            } else {
                $kfiPoint = 0;
            }
            if ($kfiWeight > 0) {
                $kfiPercent = $kfiPoint / ($kfiWeight / 100);
            } else {
                $kfiPercent = 0;
            }

            //====================================================  KGI ==============================================================
            $kgiTeamWeights = KgiWeight::find()
                ->where(["employeeId" => $employeeId, "termId" => $termId, "status" => 1])
                ->asArray()
                ->orderBy('createDateTime')
                ->all();
            $kgiEmployeeWeights = KgiEmployeeWeight::find()
                ->where(["employeeId" => $employeeId, "termId" => $termId, "status" => 1])
                ->asArray()
                ->orderBy('createDateTime')
                ->all();
            $i = 0;
            $totalKgi = 0;
            $pointKgi = [];
            if (isset($kgiTeamWeights) && count($kgiTeamWeights) > 0) {
                foreach ($kgiTeamWeights as $kgiTeam) :
                    $kgiTeamFinalScore = $kgiTeam["finalScore"];
                    $pointKgi[$i] = (($kgiTeam["weight"] / 100) * 4) * (count($kgiTeamWeights) + count($kgiEmployeeWeights)) / 4 * $kgiTeamFinalScore;
                    $totalKgi += $pointKgi[$i];
                    $i++;
                endforeach;
            }
            if (isset($kgiEmployeeWeights) && count($kgiEmployeeWeights) > 0) {
                $j = $i;
                foreach ($kgiEmployeeWeights as $kgiEmployee) :
                    $kgiEmployeeFinalScore = $kgiTeam["finalScore"];
                    $pointKgi[$j] = (($kgiEmployee["weight"] / 100) * 4) * (count($kgiTeamWeights) + count($kgiEmployeeWeights)) / 4 * $kgiEmployeeFinalScore;
                    $totalKgi += $pointKgi[$j];
                    $j++;
                endforeach;
            }
            if ($totalKgi > 0) {
                $kgiPoint = $totalKgi * 100 / (4 * (count($kgiTeamWeights) + count($kgiEmployeeWeights))) * ($kgiWeight / 100);
            }
            if ($kgiWeight > 0) {
                $kgiPercent = $kgiPoint / ($kgiWeight / 100);
            } else {
                $kgiPercent = 0;
            }
            //throw new Exception($kgiPercent);

            // ==================================================== KPI ====================================================================

            $kpiTeamWeights = KpiTeamWeight::find()
                ->where(["employeeId" => $employeeId, "termId" => $termId, "status" => 1])
                ->asArray()
                ->orderBy('createDateTime')
                ->all();
            $kpiEmployeeWeights = KpiWeight::find()
                ->where(["employeeId" => $employeeId, "termId" => $termId, "status" => 1])
                ->asArray()
                ->orderBy('createDateTime')
                ->all();
            $i = 0;
            $totalKpi = 0;
            $pointKpi = [];
            if (isset($kpiTeamWeights) && count($kpiTeamWeights) > 0) {
                foreach ($kpiTeamWeights as $kpiTeam) :
                    $kpiTeamFinalScore = $kpiTeam["finalScore"];
                    $pointKpi[$i] = (($kpiTeam["weight"] / 100) * 4) * (count($kpiTeamWeights) + count($kpiEmployeeWeights)) / 4 * $kpiTeamFinalScore;
                    $totalKpi += $pointKpi[$i];
                    $i++;
                endforeach;
            }
            if (isset($kpiEmployeeWeights) && count($kpiEmployeeWeights) > 0) {
                $j = $i;
                foreach ($kpiEmployeeWeights as $kpiEmployee) :
                    $kpiEmployeeFinalScore = $kpiEmployee["finalScore"];
                    $pointKpi[$j] = (($kpiEmployee["weight"] / 100) * 4) * (count($kpiTeamWeights) + count($kpiEmployeeWeights)) / 4 * $kpiEmployeeFinalScore;
                    $totalKpi += $pointKpi[$j];
                    $j++;
                endforeach;
            }
            if ($totalKpi > 0) {
                $kpiPoint = $totalKpi * 100 / (4 * (count($kpiTeamWeights) + count($kpiEmployeeWeights))) * ($kpiWeight / 100);
            }
            if ($kpiWeight > 0) {
                $kpiPercent = $kpiPoint / ($kpiWeight / 100);
            } else {
                $kpiPercent = 0;
            }
            $totalScore = $totalKfi + $totalKgi + $totalKpi;
            $rank = Rank::find()
                ->where(["status" => 1, "termId" => $termId])
                ->andWhere("min<=$totalScore and max>=$totalScore")
                ->asArray()
                ->one();
        }
        return $rank;
    }
}
