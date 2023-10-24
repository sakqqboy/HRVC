<?php

namespace common\models\hrvc;

use Yii;
use \common\models\hrvc\master\NationalityMaster;

/**
* This is the model class for table "nationality".
*
* @property integer $numCode
* @property string $alpha2code
* @property string $alpha3code
* @property string $shortName
* @property string $nationalityName
*/

class Nationality extends \common\models\hrvc\master\NationalityMaster{
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
