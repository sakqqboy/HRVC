<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\KgiHasKpiMaster;

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

class KgiHasKpi extends \frontend\models\hrvc\master\KgiHasKpiMaster
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
    public static function isInthisKgi($kpiId, $kgiId)
    {
        $kgiKpi = KgiHasKpi::find()->where(["kgiId" => $kgiId, "kpiId" => $kpiId, "status" => 1])->one();
        if (isset($kgiKpi)) {
            return 1;
        } else {
            return 0;
        }
    }
}
