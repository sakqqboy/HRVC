<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\KfiHistoryMaster;

/**
* This is the model class for table "kfi_history".
*
* @property integer $kfiHistoryId
* @property integer $kfiId
* @property string $kfiHistoryName
* @property integer $unitId
* @property string $checkPeriodDate
* @property string $nextCheckDate
* @property string $quantRatio
* @property integer $amountType
* @property string $code
* @property integer $historyStatus
* @property string $result
* @property string $formula
* @property string $description
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class KfiHistory extends \frontend\models\hrvc\master\KfiHistoryMaster{
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
