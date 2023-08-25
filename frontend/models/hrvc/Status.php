<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\StatusMaster;

/**
* This is the model class for table "status".
*
* @property integer $statusId
* @property string $statusName
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class Status extends \frontend\models\hrvc\master\StatusMaster{
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
