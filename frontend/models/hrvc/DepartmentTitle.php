<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\DepartmentTitleMaster;
use frontend\models\hrvc\Title;

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

class DepartmentTitle extends \frontend\models\hrvc\master\DepartmentTitleMaster
{
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
    public static function departmentTitle($departmentId)
    {
        $titleDepartments = Title::find()
            ->select('titleName')
            ->where(["departmentId" => $departmentId, "status" => 1])
            ->orderBy('titleId')
            ->asArray()
            ->all();
        return $titleDepartments;
    }
}
