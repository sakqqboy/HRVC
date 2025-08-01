<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\UserLanguageMaster;

/**
* This is the model class for table "user_language".
*
* @property integer $userLanguageId
* @property integer $userId
* @property integer $languageId
* @property integer $lavel
* @property string $createDateTime
* @property string $updateDateTime
*/

class UserLanguage extends \frontend\models\hrvc\master\UserLanguageMaster{
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
