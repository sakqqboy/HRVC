<?php

namespace common\models\hrvc;

use Yii;
use \common\models\hrvc\master\UserMaster;

/**
* This is the model class for table "user".
*
* @property integer $userId
* @property string $userName
* @property string $password_hash
* @property integer $employeeId
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class User extends \common\models\hrvc\master\UserMaster{
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
