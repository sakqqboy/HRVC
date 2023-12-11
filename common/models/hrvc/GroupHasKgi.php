<?php

namespace common\models\hrvc;

use Yii;
use \common\models\hrvc\master\GroupHasKgiMaster;

/**
* This is the model class for table "group_has_kgi".
*
* @property integer $groupHasKgiId
* @property integer $kgiGroupId
* @property integer $kgiId
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class GroupHasKgi extends \common\models\hrvc\master\GroupHasKgiMaster{
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
