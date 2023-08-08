<?php

namespace common\models\hrvc\master;

use Yii;

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
class EmployeeMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'employee';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['employeeFirstname', 'gender', 'email', 'branchId', 'departmentId'], 'required'],
            [['birthDate', 'hireDate', 'createDateTime', 'updateDateTime'], 'safe'],
            [['branchId', 'departmentId', 'positionId', 'teamId'], 'integer'],
            [['employeeNumber', 'employeeFirstname', 'employeeSurename', 'employeeNickname', 'email', 'telephoneNumber'], 'string', 'max' => 100],
            [['gender', 'status'], 'string', 'max' => 10],
            [['picture'], 'string', 'max' => 255],
            [['positionId'], 'unique'],
            [['teamId'], 'unique'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'employeeId' => 'Employee ID',
    'employeeNumber' => 'Employee Number',
    'employeeFirstname' => 'Employee Firstname',
    'employeeSurename' => 'Employee Surename',
    'employeeNickname' => 'Employee Nickname',
    'gender' => 'Gender',
    'birthDate' => 'Birth Date',
    'email' => 'Email',
    'telephoneNumber' => 'Telephone Number',
    'branchId' => 'Branch ID',
    'departmentId' => 'Department ID',
    'positionId' => 'Position ID',
    'teamId' => 'Team ID',
    'hireDate' => 'Hire Date',
    'picture' => 'Picture',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
