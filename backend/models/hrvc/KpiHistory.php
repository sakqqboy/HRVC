<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\KpiHistoryMaster;

/**
* This is the model class for table "kpi_history".
*
* @property integer $kpiHistoryId
* @property integer $kpiId
* @property string $kpiHistoryName
* @property integer $unitId
* @property string $periodDate
* @property string $nextCheckDate
* @property string $targetAmount
* @property string $month
* @property string $titleProcess
* @property string $description
* @property string $remark
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

class KpiHistory extends \backend\models\hrvc\master\KpiHistoryMaster{
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
