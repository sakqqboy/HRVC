<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\KfiDepartmentMaster;

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

class KfiDepartment extends \frontend\models\hrvc\master\KfiDepartmentMaster
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
    public static function kfiDepartmentName($kfiId)
    {
        $kfiDepartment = KfiDepartment::find()->select('d.departmentName')
            ->JOIN("LEFT JOIN", "department d", "d.departmentId=kfi_department.departmentId")
            ->where(["kfi_department.kfiId" => $kfiId])
            ->asArray()
            ->orderBy("d.departmentName")
            ->all();
        //throw new Exception(print_r($kfiBranch, true));
        $departmentName = '';
        if (isset($kfiDepartment) && count($kfiDepartment) > 0) {
            foreach ($kfiDepartment as $department) :
                if (count($kfiDepartment) == 1) {
                    $departmentName .= $department["departmentName"];
                } else {
                    $departmentName .= 'All';
                    break;
                }
            endforeach;
        }
        return $departmentName;
    }
}
