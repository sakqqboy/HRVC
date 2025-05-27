<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\ModuleMaster;

/**
* This is the model class for table "module".
*
* @property integer $moduleId
* @property string $moduleName
* @property integer $status
* @property string $createDatetime
* @property string $updateDatetime
*/

class Module extends \backend\models\hrvc\master\ModuleMaster{
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
