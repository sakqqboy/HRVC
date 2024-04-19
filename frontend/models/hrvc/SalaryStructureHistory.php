<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\SalaryStructureHistoryMaster;

/**
* This is the model class for table "salary_structure_history".
*
* @property integer $salaryStructureHistoryId
* @property integer $salaryStructureId
* @property integer $defaultValue
* @property integer $currencyId
* @property integer $round
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class SalaryStructureHistory extends \frontend\models\hrvc\master\SalaryStructureHistoryMaster{
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
