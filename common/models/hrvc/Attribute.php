<?php

namespace common\models\hrvc;

use Yii;
use \common\models\hrvc\master\AttributeMaster;

/**
* This is the model class for table "attribute".
*
* @property integer $attributeId
* @property string $attributeName
* @property integer $round
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class Attribute extends \common\models\hrvc\master\AttributeMaster{
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
