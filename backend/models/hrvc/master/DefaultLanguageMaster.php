<?php

namespace backend/models\hrvc\master;

use Yii;

/**
* This is the model class for table "default_language".
*
    * @property integer $languageId
    * @property string $language
    * @property string $languageName
    * @property integer $countryId
    * @property integer $status
    * @property string $createDatetime
    * @property string $updateDatetime
*/
class DefaultLanguageMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'default_language';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['countryId', 'status'], 'integer'],
            [['createDatetime', 'updateDatetime'], 'safe'],
            [['language'], 'string', 'max' => 5],
            [['languageName'], 'string', 'max' => 255],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'languageId' => 'Language ID',
    'language' => 'Language',
    'languageName' => 'Language Name',
    'countryId' => 'Country ID',
    'status' => 'Status',
    'createDatetime' => 'Create Datetime',
    'updateDatetime' => 'Update Datetime',
];
}
}
