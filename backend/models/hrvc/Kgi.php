<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\KgiMaster;
use common\models\ModelMaster;

/**
 * This is the model class for table "kgi".
 *
 * @property integer $kgiId
 * @property string $kgiName
 * @property integer $companyId
 * @property integer $unitId
 * @property string $periodDate
 * @property string $targetAmount
 * @property string $month
 * @property string $kgiDetail
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

class Kgi extends \backend\models\hrvc\master\KgiMaster
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
    public static function nextCheckDate($kgiId)
    {
        $date = '';
        $kgiHistory = KgiHistory::find()
            ->select('nextCheckDate')
            ->where(["kgiId" => $kgiId, "status" => [1, 2, 4]])
            ->orderBy('year DESC,month DESC,status DESC,createDateTime DESC')
            ->asArray()
            ->one();
        if (isset($kgiHistory) && !empty($kgiHistory) && $kgiHistory["nextCheckDate"] != '') {
            $date = ModelMaster::engDate($kgiHistory["nextCheckDate"], 2);
        }
        return $date;
    }
    public static function nextCheckDateSimply($kgiId)
    {
        $date = '';
        $kgiHistory = KgiHistory::find()
            ->select('nextCheckDate')
            ->where(["kgiId" => $kgiId, "status" => [1, 2, 4]])
            ->orderBy('year DESC,month DESC,status DESC,createDateTime DESC')
            ->asArray()
            ->one();
        if (isset($kgiHistory) && !empty($kgiHistory) && $kgiHistory["nextCheckDate"] != '') {
            $date = $kgiHistory["nextCheckDate"];
        }
        return $date;
    }
    public static function codeDetail($code)
    {
        $detail = '';
        if ($code == '<') {
            $detail = 'Result should be more than target';
        }
        if ($code == '>') {
            $detail = 'Result should be less than target';
        }
        if ($code == '=') {
            $detail = 'Result should be equal target';
        }
        return $detail;
    }
    public static function kgiName($kgiId)
    {
        $kgi = Kgi::find()->select('kgiName')->where(["kgiId" => $kgiId])->asArray()->one();
        return $kgi["kgiName"];
    }
    public static function checkComplete($kgiId, $month, $year, $currentYear)
    {
        if ($month != '' && $year != '') {
            $kgiHistory = KgiHistory::find()
                ->where([
                    "kgiId" => $kgiId,
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
            $kgiHistory = KgiHistory::find()
                ->where([
                    "kgiId" => $kgiId,
                    "status" => 2,
                    "month" => $month,
                    "year" => $currentYear
                ])
                ->one();
        }
        if ($month == '' && $year == '') {
            return 0;
        }

        if (isset($kgiHistory) && !empty($kgiHistory)) {
            return 1;
        } else {
            return 0;
        }
    }
}
