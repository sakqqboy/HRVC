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

class KpiWeight extends \frontend\models\hrvc\master\KpiWeightMaster{
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
