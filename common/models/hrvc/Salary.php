<?php

namespace common\models\hrvc;

use Yii;
use \common\models\hrvc\master\SalaryMaster;

/**
* This is the model class for table "salary".
*
* @property integer $salaryId
* @property integer $companyId
* @property integer $departmentId
* @property integer $titleId
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class Salary extends \common\models\hrvc\master\SalaryMaster{
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
