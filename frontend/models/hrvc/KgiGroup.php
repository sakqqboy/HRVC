<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\KgiGroupMaster;

/**
* This is the model class for table "kgi_group".
*
* @property integer $kgiGroupId
* @property string $kgiGroupName
* @property string $kgiGroupDetail
* @property string $target
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class KgiGroup extends \frontend\models\hrvc\master\KgiGroupMaster{
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
