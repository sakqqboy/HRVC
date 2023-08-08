<?php

namespace common\models\hrvc;

use Yii;
use \common\models\hrvc\master\DepartmentMaster;

/**
* This is the model class for table "department".
*
* @property integer $departmentId
* @property string $departmentName
* @property integer $branchId
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class Department extends \common\models\hrvc\master\DepartmentMaster{
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
