<?php

namespace common\models\hrvc;

use Yii;
use \common\models\hrvc\master\KgiHistoryMaster;

/**
* This is the model class for table "kgi_history".
*
* @property integer $kgiHistoryId
* @property integer $kgiId
* @property string $kgiHistoryName
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

class KgiHistory extends \common\models\hrvc\master\KgiHistoryMaster{
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
