<?php

namespace common\models\hrvc;

use Yii;
use \common\models\hrvc\master\TermStepMaster;

/**
* This is the model class for table "term_step".
*
* @property integer $stepId
* @property string $stepName
* @property integer $sort
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class TermStep extends \common\models\hrvc\master\TermStepMaster{
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
