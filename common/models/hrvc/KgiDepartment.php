<?php

namespace common\models\hrvc;

use Yii;
use \common\models\hrvc\master\KgiDepartmentMaster;

/**
* This is the model class for table "kgi_department".
*
* @property integer $kgiDepartmentId
* @property integer $kgiId
* @property integer $departmentId
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class KgiDepartment extends \common\models\hrvc\master\KgiDepartmentMaster{
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
