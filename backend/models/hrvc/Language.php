<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\LanguageMaster;

/**
* This is the model class for table "language".
*
* @property integer $LanguageId
* @property string $name
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class Language extends \backend\models\hrvc\master\LanguageMaster{
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
