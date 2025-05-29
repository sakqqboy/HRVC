<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\KgiEmployeeHistoryMaster;
use common\models\ModelMaster;

/**
 * This is the model class for table "kgi_employee_history".
 *
 * @property integer $kgiEmployeeHistoryId
 * @property integer $kgiEmployeeId
 * @property string $target
 * @property string $result
 * @property string $detail
 * @property string $nextCheckDate
 * @property string $lastCheckDate
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class KgiEmployeeHistory extends \backend\models\hrvc\master\KgiEmployeeHistoryMaster
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
    public static function nextCheckDate($kgiEmployeeHistoryId)
    {
        $date = '';
        $kgiHistory = KgiEmployeeHistory::find()
            ->select('nextCheckDate')
            ->where(["kgiEmployeeHistoryId" => $kgiEmployeeHistoryId, "status" => [1, 2, 4]])
            ->asArray()
            ->one();
        if (isset($kgiHistory) && !empty($kgiHistory) && $kgiHistory["nextCheckDate"] != '') {
            $date = ModelMaster::engDate($kgiHistory["nextCheckDate"], 2);
        }
        return $date;
    }
    public static function allHistory($kgiEmployeeId, $month, $year)
    {
        $data = [];
        $kgiEmployeeHistory = KgiEmployeeHistory::find()
            ->where(["kgiEmployeeId" => $kgiEmployeeId, "status" => [1, 2, 3, 4, 5]])
            ->orderBy('updateDateTime DESC')
            ->asArray()
            ->all();
        if (isset($kgiEmployeeHistory) && count($kgiEmployeeHistory) > 0) {
            foreach ($kgiEmployeeHistory as $keh):
                $data[$keh["kgiEmployeeHistoryId"]] = [
                    "detail" => $keh["detail"],
                    "target" => ModelMaster::pimNumberFormat($keh["target"]),
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
