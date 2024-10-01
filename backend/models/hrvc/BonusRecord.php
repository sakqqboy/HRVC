<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\BonusRecordMaster;

/**
* This is the model class for table "bonus_record".
*
* @property integer $bonusRecordId
* @property integer $termId
* @property integer $employeeId
* @property integer $rankId
* @property string $rankName
* @property string $salary
* @property string $bonusRate
* @property string $finalAdjustment
* @property integer $creator
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class BonusRecord extends \backend\models\hrvc\master\BonusRecordMaster{
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
