<?php

namespace common\models\hrvc\master;

use Yii;

/**
* This is the model class for table "kfi_branch".
*
    * @property integer $kfiBranchId
    * @property integer $kfiId
    * @property integer $branchId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class KfiBranchMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'kfi_branch';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['kfiId', 'branchId'], 'required'],
            [['kfiId', 'branchId'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['status'], 'string', 'max' => 4],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'kfiBranchId' => 'Kfi Branch ID',
    'kfiId' => 'Kfi ID',
    'branchId' => 'Branch ID',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
