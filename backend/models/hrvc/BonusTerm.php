<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\BonusTermMaster;

/**
 * This is the model class for table "bonus_term".
 *
 * @property integer $bonusTermId
 * @property integer $termId
 * @property string $budget
 * @property string $totalBonus
 * @property string $totalAdjust
 * @property string $totalPayable
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class BonusTerm extends \backend\models\hrvc\master\BonusTermMaster
{
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
