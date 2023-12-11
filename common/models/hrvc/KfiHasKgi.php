<?php

namespace common\models\hrvc;

use Yii;
use \common\models\hrvc\master\KfiHasKgiMaster;

/**
* This is the model class for table "kfi_has_kgi".
*
* @property integer $kfiHasKgiId
* @property integer $kfiId
* @property integer $kgiId
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class KfiHasKgi extends \common\models\hrvc\master\KfiHasKgiMaster{
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
