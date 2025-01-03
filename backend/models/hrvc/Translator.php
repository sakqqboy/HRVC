<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\TranslatorMaster;

/**
* This is the model class for table "translator".
*
* @property integer $translatorId
* @property string $english
* @property string $thai
* @property string $japanese
* @property string $chinese
* @property string $vietnam
* @property string $spanish
* @property integer $status
*/

class Translator extends \backend\models\hrvc\master\TranslatorMaster{
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
