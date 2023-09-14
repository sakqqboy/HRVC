<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\KfiDepartmentMaster;

/**
* This is the model class for table "kfi_department".
*
* @property integer $kfiDepartmentId
* @property integer $kfiId
* @property integer $departmentId
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class KfiDepartment extends \backend\models\hrvc\master\KfiDepartmentMaster{
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
