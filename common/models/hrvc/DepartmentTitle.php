<?php

namespace common\models\hrvc;

use Yii;
use \common\models\hrvc\master\DepartmentTitleMaster;

/**
* This is the model class for table "department_title".
*
* @property integer $id
* @property integer $departmentId
* @property integer $titleId
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class DepartmentTitle extends \common\models\hrvc\master\DepartmentTitleMaster{
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
