<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\StructureMaster;

/**
* This is the model class for table "structure".
*
* @property integer $structureId
* @property string $structureName
* @property integer $type
* @property integer $defaultValue
* @property integer $status
* @property string $createDateTime
* @property string $updateDatetime
*/

class Structure extends \backend\models\hrvc\master\StructureMaster{
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
