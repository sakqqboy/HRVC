<?php

namespace frontend\models\hrvc\master;

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
    * @property string $companyEmail
    * @property string $telephoneNumber
    * @property string $emergencyTel
    * @property integer $companyId
    * @property integer $branchId
    * @property integer $departmentId
    * @property integer $titleId
    * @property integer $teamId
    * @property string $hireDate
    * @property integer $employeeConditionId
    * @property string $picture
    * @property integer $nationalityId
    * @property string $contact
    * @property integer $workingTime
    * @property string $resume
    * @property string $employeeAgreement
    * @property string $spoken
    * @property string $socialLink
    * @property string $remark
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
            [['employeeNumber', 'employeeFirstname', 'employeeSurename', 'gender', 'birthDate', 'email', 'telephoneNumber', 'companyId', 'branchId', 'departmentId', 'titleId', 'employeeConditionId'], 'required'],
            [['birthDate', 'hireDate', 'createDateTime', 'updateDateTime'], 'safe'],
            [['companyId', 'branchId', 'departmentId', 'titleId', 'teamId', 'employeeConditionId', 'nationalityId', 'workingTime'], 'integer'],
            [['spoken', 'socialLink', 'remark'], 'string'],
            [['employeeNumber', 'employeeFirstname', 'employeeSurename', 'employeeNickname', 'email', 'telephoneNumber', 'emergencyTel', 'contact'], 'string', 'max' => 100],
            [['gender', 'status'], 'string', 'max' => 10],
            [['companyEmail', 'picture', 'resume', 'employeeAgreement'], 'string', 'max' => 255],
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
    'companyEmail' => 'Company Email',
    'telephoneNumber' => 'Telephone Number',
    'emergencyTel' => 'Emergency Tel',
    'companyId' => 'Company ID',
    'branchId' => 'Branch ID',
    'departmentId' => 'Department ID',
    'titleId' => 'Title ID',
    'teamId' => 'Team ID',
    'hireDate' => 'Hire Date',
    'employeeConditionId' => 'Employee Condition ID',
    'picture' => 'Picture',
    'nationalityId' => 'Nationality ID',
    'contact' => 'Contact',
    'workingTime' => 'Working Time',
    'resume' => 'Resume',
    'employeeAgreement' => 'Employee Agreement',
    'spoken' => 'Spoken',
    'socialLink' => 'Social Link',
    'remark' => 'Remark',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
