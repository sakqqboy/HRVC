<?php

namespace frontend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "nationality".
*
    * @property integer $numCode
    * @property string $alpha2code
    * @property string $alpha3code
    * @property string $shortName
    * @property string $nationalityName
*/
class NationalityMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'nationality';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['numCode'], 'required'],
            [['numCode'], 'integer'],
            [['alpha2code'], 'string', 'max' => 2],
            [['alpha3code'], 'string', 'max' => 3],
            [['shortName'], 'string', 'max' => 52],
            [['nationalityName'], 'string', 'max' => 39],
            [['alpha2code'], 'unique'],
            [['alpha3code'], 'unique'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'numCode' => 'Num Code',
    'alpha2code' => 'Alpha2code',
    'alpha3code' => 'Alpha3code',
    'shortName' => 'Short Name',
    'nationalityName' => 'Nationality Name',
];
}
}
