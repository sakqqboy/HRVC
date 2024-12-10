<?php

namespace backend\models\hrvc\master;

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
            [['english', 'thai', 'japanese', 'chinese', 'vietnam', 'spanish'], 'string', 'max' => 100],
            [['status'], 'string', 'max' => 10],
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
    'status' => 'Status',
];
}
}
