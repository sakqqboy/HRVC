<?php

namespace common\models\hrvc\master;

use Yii;

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
    * @property string $indonesian
    * @property integer $status
*/
class TranslatorMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'translator';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['english', 'thai', 'japanese', 'chinese', 'vietnam', 'spanish', 'indonesian'], 'string'],
            [['status'], 'string', 'max' => 4],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'translatorId' => 'Translator ID',
    'english' => 'English',
    'thai' => 'Thai',
    'japanese' => 'Japanese',
    'chinese' => 'Chinese',
    'vietnam' => 'Vietnam',
    'spanish' => 'Spanish',
    'indonesian' => 'Indonesian',
    'status' => 'Status',
];
}
}
