<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\KgiDepartmentMaster;

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

class KgiDepartment extends \frontend\models\hrvc\master\KgiDepartmentMaster
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
    public static function isInThisKgi($departmentId, $kgiId)
    {
        $kgiDepartment = KgiDepartment::find()->where(["departmentId" => $departmentId, "kgiId" => $kgiId, "status" => 1])->asArray()->one();
        $has = 0;
        if (isset($kgiDepartment) && !empty($kgiDepartment)) {
            $has = 1;
        }
        return $has;
    }
    public static function kgiDepartment($kgiId)
    {
        $kgiDepartment = KgiDepartment::find()
            ->select('d.departmentId,d.departmentName')
            ->JOIN("LEFT JOIN", "kgi", "kgi.kgiId=kgi_department.kgiId")
            ->JOIN("LEFT JOIN", "department d", "d.departmentId=kgi_department.departmentId")
            ->where(["kgi_department.kgiId" => $kgiId, "kgi.status" => 1, "kgi_department.status" => 1])
            ->asArray()
            ->all();
        return $kgiDepartment;
    }
}
