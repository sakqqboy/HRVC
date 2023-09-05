<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\LayerMaster;

/**
* This is the model class for table "layer".
*
* @property integer $layerId
* @property string $layerName
* @property integer $priority
* @property string $shortTag
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class Layer extends \frontend\models\hrvc\master\LayerMaster{
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
