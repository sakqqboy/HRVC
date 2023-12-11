<?php

namespace common\models\hrvc;

use Yii;
use \common\models\hrvc\master\KgiHasKpiMaster;

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

class KgiHasKpi extends \common\models\hrvc\master\KgiHasKpiMaster{
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
}
