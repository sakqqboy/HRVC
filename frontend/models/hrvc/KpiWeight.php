<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\KpiWeightMaster;

/**
 * This is the model class for table "kpi_weight".
 *
 * @property integer $kpiWeightId
 * @property integer $kpiId
 * @property string $level1
 * @property string $level2
 * @property string $level3
 * @property string $level4
 * @property string $weight
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class KpiWeight extends \frontend\models\hrvc\master\KpiWeightMaster
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
    public static function kpiTermEmployee($termId)
    {
        $kpiWeight = KpiWeight::find()
            ->select('e.picture,kpi_weight.employeeId')
            ->JOIN("LEFT JOIN", "employee e", "e.employeeId=kpi_weight.employeeId")
            ->where([
                "kpi_weight.termId" => $termId,
                "kpi_weight.status" => 1,
                "e.status" => 1
            ])
            ->asArray()
            ->all();
        $data = [];
        if (isset($kpiWeight) && count($kpiWeight) > 0) {
            $i = 0;
            foreach ($kpiWeight as $kpi) :
                $data[$kpi["employeeId"]] = [
                    "picture" => $kpi["picture"]
                ];
                $i++;
            endforeach;
        }
        return $data;
    }
}
