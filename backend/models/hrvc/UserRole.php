<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\UserRoleMaster;

/**
* This is the model class for table "user_role".
*
* @property integer $userRoleId
* @property integer $roleId
* @property integer $userId
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class UserRole extends \backend\models\hrvc\master\UserRoleMaster{
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
