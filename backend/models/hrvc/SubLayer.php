<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\SubLayerMaster;

/**
* This is the model class for table "sub_layer".
*
* @property integer $subLayerId
* @property string $subLayerName
* @property integer $layerId
* @property string $shortTag
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class SubLayer extends \backend\models\hrvc\master\SubLayerMaster{
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
