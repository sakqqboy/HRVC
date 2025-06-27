<?php

namespace backend\models\hrvc\master;

use Yii;

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
class UserLanguageMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'user_language';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['userId', 'languageId', 'lavel'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'userLanguageId' => 'User Language ID',
    'userId' => 'User ID',
    'languageId' => 'Language ID',
    'lavel' => 'Lavel',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
