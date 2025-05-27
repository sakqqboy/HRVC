<?php

namespace common\models\hrvc;

use Yii;
use \common\models\hrvc\master\DefaultLanguageMaster;

/**
* This is the model class for table "default_language".
*
* @property integer $languageId
* @property string $language
* @property string $languageName
* @property integer $countryId
* @property string $createDate
*/

class DefaultLanguage extends \common\models\hrvc\master\DefaultLanguageMaster{
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
