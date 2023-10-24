<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\DepartmentTitleMaster;

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
        $titleDepartments = DepartmentTitle::find()
            ->select('t.titleName')
            ->JOIN("LEFT JOIN", "title t", "t.titleId=department_title.titleId")
            ->JOIN("LEFT JOIN", "department d", "d.departmentId=department_title.departmentId")
            ->where(["department_title.departmentId" => $departmentId, "t.status" => 1, "d.status" => 1])
            ->orderBy('department_title.titleId')
            ->asArray()
            ->all();
        return  $titleDepartments;
    }
}
