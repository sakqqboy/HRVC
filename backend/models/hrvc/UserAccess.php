<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\UserAccessMaster;

/**
* This is the model class for table "user_access".
*
* @property integer $acessId
* @property integer $userId
* @property integer $moduleId
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class UserAccess extends \backend\models\hrvc\master\UserAccessMaster{
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
