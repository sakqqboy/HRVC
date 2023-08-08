<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\CountryMaster;

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

class Country extends \backend\models\hrvc\master\CountryMaster{
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
