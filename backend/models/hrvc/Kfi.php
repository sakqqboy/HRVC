<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\KfiMaster;
use common\models\ModelMaster;
use Exception;

/**
 * This is the model class for table "kfi".
 *
 * @property integer $kfiId
 * @property string $kfiName
 * @property integer $companyId
 * @property integer $branchId
 * @property integer $unitId
 * @property integer $targetAmount
 * @property string $month
 * @property integer $createrId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class Kfi extends \backend\models\hrvc\master\KfiMaster
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
    public static function nextCheckDate($kfiId)
    {
        $date = '';
        $kfiHistory = KfiHistory::find()
            ->select('nextCheckDate')
            ->where(["kfiId" => $kfiId, "status" => [1, 2, 4]])
            ->orderBy('year DESC,month DESC,status DESC,createDateTime DESC')
            ->asArray()
            ->one();
        if (isset($kfiHistory) && !empty($kfiHistory) && $kfiHistory["nextCheckDate"] != '') {
            $date = ModelMaster::engDate($kfiHistory["nextCheckDate"], 2);
        }
        return $date;
    }
    public static function nextCheckDateSimply($kfiId)
    {
        $date = '';
        $kfiHistory = KfiHistory::find()
            ->select('nextCheckDate')
            ->where(["kfiId" => $kfiId, "status" => [1, 2, 4]])
            ->orderBy('year DESC,month DESC,status DESC,createDateTime DESC')
            ->asArray()
            ->one();
        if (isset($kfiHistory) && !empty($kfiHistory) && $kfiHistory["nextCheckDate"] != '') {
            $date = $kfiHistory["nextCheckDate"];
        }
        return $date;
    }
    public static function checkComplete($kfiId, $month, $year, $currentMonth, $currentYear)
    {
        if ($month != '' && $year != '') {
            $kfiHistory = KfiHistory::find()
                ->where([
                    "kfiId" => $kfiId,
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
            $kfiHistory = KfiHistory::find()
                ->where([
                    "kfiId" => $kfiId,
                    "status" => 2,
                    "month" => $month,
                    "year" => $currentYear
                ])
                ->one();
        }
        if ($month == '' && $year == '') {
            return 0;
        }

        if (isset($kfiHistory) && !empty($kfiHistory)) {
            return 1;
        } else {
            return 0;
        }
    }
}
