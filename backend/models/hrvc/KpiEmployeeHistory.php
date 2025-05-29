<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\KpiEmployeeHistoryMaster;
use common\models\ModelMaster;

/**
 * This is the model class for table "kpi_employee_history".
 *
 * @property integer $kpiEmployeeHistoryId
 * @property integer $kpiEmployeeId
 * @property string $target
 * @property string $result
 * @property string $detail
 * @property string $nextCheckDate
 * @property string $lastCheckDate
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class KpiEmployeeHistory extends \backend\models\hrvc\master\KpiEmployeeHistoryMaster
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
    public static function allHistory($kpiEmployeeId, $month, $year)
    {
        $data = [];
        $kpiEmployeeHistory = KpiEmployeeHistory::find()
            ->where(["kpiEmployeeId" => $kpiEmployeeId, "status" => [1, 2, 3, 4, 5], "month" => $month, "year" => $year])
            ->orderBy('updateDateTime DESC')
            ->asArray()
            ->all();
        if (isset($kpiEmployeeHistory) && count($kpiEmployeeHistory) > 0) {
            foreach ($kpiEmployeeHistory as $keh):
                $data[$keh["kpiEmployeeHistoryId"]] = [
                    "detail" => $keh["detail"],
                    "result" => ModelMaster::pimNumberFormat($keh["result"]),
                    "dueBehide" => ModelMaster::pimNumberFormat($keh["target"] - $keh["result"]),
                    "fromDate" => $keh["fromDate"],
                    "toDate" => $keh["toDate"],
                ];
            endforeach;
        }
        return $data;
    }
}
