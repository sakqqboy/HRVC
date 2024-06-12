<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\KgiEmployeeWeightMaster;

/**
* This is the model class for table "kgi_employee_weight".
*
* @property integer $kgiEmployeeWeigth
* @property integer $employeeId
* @property integer $kgiId
* @property integer $kgiEmployeeId
* @property integer $termId
* @property string $level1
* @property string $level1End
* @property string $level2
* @property string $level2End
* @property string $level3
* @property string $level3End
* @property string $level4
* @property string $level4End
* @property string $weight
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class KgiEmployeeWeight extends \backend\models\hrvc\master\KgiEmployeeWeightMaster{
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
