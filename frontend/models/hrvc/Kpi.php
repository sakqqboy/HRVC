<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\KpiMaster;

/**
* This is the model class for table "kpi".
*
* @property integer $kpiId
* @property string $kpiName
* @property integer $companyId
* @property integer $unitId
* @property string $periodDate
* @property string $targetAmount
* @property string $month
* @property string $kpiDetail
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

class Kpi extends \frontend\models\hrvc\master\KpiMaster{
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
