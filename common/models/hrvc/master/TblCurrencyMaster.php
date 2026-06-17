<?php

namespace common\models\hrvc\master;

use Yii;

/**
* This is the model class for table "tbl_currency".
*
    * @property string $currencyId
    * @property string $create_datetime
    * @property string $update_datetime
    * @property string $currencyName
    * @property string $currencyCode
    * @property string $currencySymbol
    * @property integer $countryId
    * @property integer $dollarUnit
    * @property double $exchangeRate
    * @property integer $source
    * @property integer $status
    * @property integer $default_status
*/
class TblCurrencyMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'tbl_currency';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['currencyId', 'currencyName', 'currencyCode', 'currencySymbol', 'countryId', 'exchangeRate'], 'required'],
            [['create_datetime', 'update_datetime'], 'safe'],
            [['countryId', 'dollarUnit', 'source', 'status', 'default_status'], 'integer'],
            [['exchangeRate'], 'number'],
            [['currencyId'], 'string', 'max' => 10],
            [['currencyName'], 'string', 'max' => 100],
            [['currencyCode', 'currencySymbol'], 'string', 'max' => 20],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'currencyId' => 'Currency ID',
    'create_datetime' => 'Create Datetime',
    'update_datetime' => 'Update Datetime',
    'currencyName' => 'Currency Name',
    'currencyCode' => 'Currency Code',
    'currencySymbol' => 'Currency Symbol',
    'countryId' => 'Country ID',
    'dollarUnit' => 'Dollar Unit',
    'exchangeRate' => 'Exchange Rate',
    'source' => 'Source',
    'status' => 'Status',
    'default_status' => 'Default Status',
];
}
}
