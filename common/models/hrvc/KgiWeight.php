<?php

namespace common\models\hrvc;

use Yii;
use \common\models\hrvc\master\KgiWeightMaster;

/**
* This is the model class for table "kgi_weight".
*
* @property integer $kgiWeightId
* @property integer $kgiId
* @property string $level1
* @property string $level2
* @property string $level3
* @property string $level4
* @property string $weight
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class KgiWeight extends \common\models\hrvc\master\KgiWeightMaster{
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
