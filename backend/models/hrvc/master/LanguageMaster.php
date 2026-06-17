<?php

namespace backend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "language".
*
    * @property integer $LanguageId
    * @property string $name
    * @property string $symbol
    * @property integer $countryId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class LanguageMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'language';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['name'], 'required'],
            [['countryId'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['symbol'], 'string', 'max' => 3],
            [['status'], 'string', 'max' => 10],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'LanguageId' => 'Language ID',
    'name' => 'Name',
    'symbol' => 'Symbol',
    'countryId' => 'Country ID',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
