<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\EmployeeMaster;

/**
 * This is the model class for table "employee".
 *
 * @property integer $employeeId
 * @property string $employeeNumber
 * @property string $employeeFirstname
 * @property string $employeeSurename
 * @property string $employeeNickname
 * @property integer $gender
 * @property string $birthDate
 * @property string $email
 * @property string $telephoneNumber
 * @property integer $branchId
 * @property integer $departmentId
 * @property integer $positionId
 * @property integer $teamId
 * @property string $hireDate
 * @property string $picture
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class Employee extends \backend\models\hrvc\master\EmployeeMaster
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
    public static function EmployeeDetail($employeeId)
    {
        $employee = Employee::find()->where(["employeeId" => $employeeId])->asArray()->one();
        return $employee;
    }
}
