<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\KgiHasKpiMaster;

/**
 * This is the model class for table "kgi_has_kpi".
 *
 * @property integer $kgiHasKpiId
 * @property integer $kgiId
 * @property integer $kpiId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class KgiHasKpi extends \backend\models\hrvc\master\KgiHasKpiMaster
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
    public static function countKgiHasKpi($kgiId)
    {
        $kgiHasKpi = KgiHasKpi::find()
            ->JOIN("LEFT JOIN", "kgi", "kgi.kgiId=kgi_has_kpi.kgiId")
            ->JOIN("LEFT JOIN", "kpi", "kpi.kpiId=kgi_has_kpi.kpiId")
            ->where(["kgi_has_kpi.kgiId" => $kgiId, "kpi.status" => 1, "kgi.status" => 1, "kgi_has_kpi.status" => 1])
            ->all();
        return count($kgiHasKpi);
    }
    public static function countKgiWithKpi($kpiId)
    {
        $kgiHasKpi = KgiHasKpi::find()
            ->JOIN("LEFT JOIN", "kgi", "kgi.kgiId=kgi_has_kpi.kgiId")
            ->JOIN("LEFT JOIN", "kpi", "kpi.kpiId=kgi_has_kpi.kpiId")
            ->where(["kgi_has_kpi.kpiId" => $kpiId, "kpi.status" => 1, "kgi.status" => 1, "kgi_has_kpi.status" => 1])
            ->all();
        return count($kgiHasKpi);
    }
}
