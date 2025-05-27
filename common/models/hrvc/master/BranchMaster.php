<?php

namespace common/models\hrvc\master;

use Yii;

/**
* This is the model class for table "branch".
*
    * @property integer $branchId
    * @property string $branchName
    * @property integer $companyId
    * @property string $description
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    * @property integer $financial_start_month
    * @property string $financial_description
    * @property string $branchImage
    * @property string $currency_default
*/
class BranchMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'branch';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['branchName', 'companyId'], 'required'],
            [['companyId', 'financial_start_month'], 'integer'],
            [['description', 'financial_description'], 'string'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['branchName'], 'string', 'max' => 255],
            [['status', 'currency_default'], 'string', 'max' => 10],
            [['branchImage'], 'string', 'max' => 250],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'branchId' => 'Branch ID',
    'branchName' => 'Branch Name',
    'companyId' => 'Company ID',
    'description' => 'Description',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
    'financial_start_month' => 'Financial Start Month',
    'financial_description' => 'Financial Description',
    'branchImage' => 'Branch Image',
    'currency_default' => 'Currency Default',
];
}
}
