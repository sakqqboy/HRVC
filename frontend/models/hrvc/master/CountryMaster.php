<?php

namespace frontend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "country".
*
    * @property integer $countryId
    * @property string $countryName
    * @property string $flag
    * @property string $lat
    * @property string $lng
    * @property integer $hasBranch
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class CountryMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'country';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['countryName'], 'required'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['countryName', 'flag'], 'string', 'max' => 255],
            [['lat', 'lng'], 'string', 'max' => 100],
            [['hasBranch', 'status'], 'string', 'max' => 6],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'countryId' => 'Country ID',
    'countryName' => 'Country Name',
    'flag' => 'Flag',
    'lat' => 'Lat',
    'lng' => 'Lng',
    'hasBranch' => 'Has Branch',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
