<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\KfiEmployeeMaster;

/**
* This is the model class for table "kfi_employee".
*
* @property integer $kfiEmployeeId
* @property integer $employeeId
* @property integer $kfiId
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class KfiEmployee extends \backend\models\hrvc\master\KfiEmployeeMaster{
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
