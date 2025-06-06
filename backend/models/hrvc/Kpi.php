<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\KpiMaster;
use common\models\ModelMaster;

/**
 * This is the model class for table "kpi".
 *
 * @property integer $kpiId
 * @property string $kpiName
 * @property integer $companyId
 * @property integer $unitId
 * @property string $periodDate
 * @property string $targetAmount
 * @property string $month
 * @property string $kpiDetail
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

class Kpi extends \backend\models\hrvc\master\KpiMaster
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
    public static function nextCheckDate($kpiId)
    {
        $date = '';
        $kpiHistory = KpiHistory::find()
            ->select('nextCheckDate')
            ->where(["kpiId" => $kpiId, "status" => [1, 2, 4]])
            ->orderBy('year DESC,month DESC,status DESC,createDateTime DESC')
            ->asArray()
            ->one();
        if (isset($kpiHistory) && !empty($kpiHistory) && $kpiHistory["nextCheckDate"] != '') {
            $date = ModelMaster::engDate($kpiHistory["nextCheckDate"], 2);
        }
        return $date;
    }
    public static function kpiName($kpiId)
    {
        $kpi = Kpi::find()->select('kpiName')->where(["kpiId" => $kpiId])->asArray()->one();
        return $kpi["kgiName"];
    }
    public static function checkComplete($kpiId, $month, $year, $currentYear)
    {
        if ($month != '' && $year != '') {
            $kpiHistory = KpiHistory::find()
                ->where([
                    "kpiId" => $kpiId,
                    "status" => 2,
                    "month" => $month,
                    "year" => $year
                ])
                ->one();
        }
        if ($month == '' && $year != '') {
            if ($year != $currentYear) {
                return 1;
            } else {
                return 0;
            }
        }
        if ($month != '' && $year == '') {
            $kpiHistory = KpiHistory::find()
                ->where([
                    "kpiId" => $kpiId,
                    "status" => 2,
                    "month" => $month,
                    "year" => $currentYear
                ])
                ->one();
        }
        if ($month == '' && $year == '') {
            return 0;
        }

        if (isset($kpiHistory) && !empty($kpiHistory)) {
            return 1;
        } else {
            return 0;
        }
    }
}
