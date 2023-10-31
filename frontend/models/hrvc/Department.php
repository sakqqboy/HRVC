<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\DepartmentMaster;

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

class Department extends \frontend\models\hrvc\master\DepartmentMaster
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
    public static function departmentNAme($departmentId)
    {
        $departmentName = "";
        if ($departmentId != '') {
            $department = Department::find()->select('departmentName')->where(["departmentId" => $departmentId])->asArray()->one();
            $departmentName = $department["departmentName"];
        }
        return   $departmentName;
    }
    public static function branchDepartment($branchId, $departmentName)
    {
        $department = Department::find()
            ->where(["branchId" => $branchId, "departmentName" => $departmentName, "status" => 1])
            ->asArray()
            ->one();
        if (isset($department) && !empty($department)) {
            return $department['departmentId'];
        } else {
            return "";
        }
    }
}
