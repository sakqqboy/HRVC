<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\KfiWeightMaster;

/**
* This is the model class for table "kfi_weight".
*
* @property integer $kfiWeightId
* @property integer $kfiId
* @property string $level1
* @property string $level2
* @property string $level3
* @property string $level4
* @property string $level5
* @property string $level6
* @property string $weight
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class KfiWeight extends \frontend\models\hrvc\master\KfiWeightMaster{
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
