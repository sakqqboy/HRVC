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
    * @property string $salutation
    * @property integer $gender
    * @property string $maritalStatus
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
    * @property integer $teamPositionId
    * @property string $joinDate
    * @property string $hireDate
    * @property integer $probationStatus
    * @property string $probationStart
    * @property string $probationEnd
    * @property integer $countryId
    * @property integer $defaultLanguage
    * @property integer $employeeConditionId
    * @property string $address1
    * @property string $address2
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
    * @property string $skills
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
            [['employeeFirstname', 'employeeSurename', 'gender', 'email', 'telephoneNumber', 'companyId', 'branchId', 'departmentId', 'titleId', 'employeeConditionId'], 'required'],
            [['salutation', 'maritalStatus', 'address1', 'address2', 'spoken', 'socialLink', 'remark', 'skills'], 'string'],
            [['birthDate', 'joinDate', 'hireDate', 'probationStart', 'probationEnd', 'createDateTime', 'updateDateTime'], 'safe'],
            [['companyId', 'branchId', 'departmentId', 'titleId', 'teamId', 'teamPositionId', 'countryId', 'defaultLanguage', 'employeeConditionId', 'nationalityId', 'workingTime'], 'integer'],
            [['employeeNumber', 'employeeFirstname', 'employeeSurename', 'employeeNickname', 'email', 'contact'], 'string', 'max' => 100],
            [['gender', 'probationStatus', 'status'], 'string', 'max' => 10],
            [['companyEmail', 'telephoneNumber', 'emergencyTel', 'picture', 'resume', 'employeeAgreement'], 'string', 'max' => 255],
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
    'salutation' => 'Salutation',
    'gender' => 'Gender',
    'maritalStatus' => 'Marital Status',
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
    'teamPositionId' => 'Team Position ID',
    'joinDate' => 'Join Date',
    'hireDate' => 'Hire Date',
    'probationStatus' => 'Probation Status',
    'probationStart' => 'Probation Start',
    'probationEnd' => 'Probation End',
    'countryId' => 'Country ID',
    'defaultLanguage' => 'Default Language',
    'employeeConditionId' => 'Employee Condition ID',
    'address1' => 'Address1',
    'address2' => 'Address2',
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
    'skills' => 'Skills',
];
}
}
