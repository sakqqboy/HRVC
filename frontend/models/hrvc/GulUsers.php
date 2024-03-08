<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\GulUsersMaster;

/**
* This is the model class for table "gul_users".
*
* @property string $ID
* @property string $user_login
* @property string $user_pass
* @property string $user_nicename
* @property string $user_email
* @property string $user_url
* @property string $user_registered
* @property string $user_activation_key
* @property integer $user_status
* @property string $display_name
*/

class GulUsers extends \frontend\models\hrvc\master\GulUsersMaster{
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
