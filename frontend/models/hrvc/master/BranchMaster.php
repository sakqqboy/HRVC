<?php

namespace frontend\models\hrvc\master;

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
            [['companyId'], 'integer'],
            [['description'], 'string'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['branchName'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 10],
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
];
}
}
