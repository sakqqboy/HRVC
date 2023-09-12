<?php

namespace common\models\hrvc;

use Yii;
use \common\models\hrvc\master\UnitMaster;

/**
* This is the model class for table "unit".
*
* @property integer $unitId
* @property string $unitName
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class Unit extends \common\models\hrvc\master\UnitMaster{
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
