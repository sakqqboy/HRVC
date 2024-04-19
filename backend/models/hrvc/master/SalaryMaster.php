<?php

namespace backend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "salary".
*
    * @property integer $salaryId
    * @property integer $companyId
    * @property integer $departmentId
    * @property integer $titleId
    * @property integer $currencyId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class SalaryMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'salary';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['companyId', 'departmentId', 'titleId', 'currencyId'], 'required'],
            [['companyId', 'departmentId', 'titleId', 'currencyId'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['status'], 'string', 'max' => 10],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'salaryId' => 'Salary ID',
    'companyId' => 'Company ID',
    'departmentId' => 'Department ID',
    'titleId' => 'Title ID',
    'currencyId' => 'Currency ID',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
