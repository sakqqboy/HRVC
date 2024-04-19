<?php

namespace common\models\hrvc;

use Yii;
use \common\models\hrvc\master\SalaryStructureMaster;

/**
* This is the model class for table "salary_structure".
*
* @property integer $salaryStructureId
* @property integer $salaryId
* @property integer $structureId
* @property integer $defaultValue
* @property integer $currencyId
* @property integer $status
* @property string $createDateTime
* @property string $updateTime
*/

class SalaryStructure extends \common\models\hrvc\master\SalaryStructureMaster{
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
