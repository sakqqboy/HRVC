<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\KgiEmployeeMaster;

/**
* This is the model class for table "kgi_employee".
*
* @property integer $kgiEmployeeId
* @property integer $employeeId
* @property integer $kgiId
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class KgiEmployee extends \backend\models\hrvc\master\KgiEmployeeMaster{
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
