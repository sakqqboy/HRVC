<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\EnvironmentMaster;

/**
* This is the model class for table "environment".
*
* @property integer $environmentId
* @property integer $companyId
* @property integer $branchId
* @property integer $status
* @property string $createDateTime
* @property string $udpateDateTime
*/

class Environment extends \frontend\models\hrvc\master\EnvironmentMaster{
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
