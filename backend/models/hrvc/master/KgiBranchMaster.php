<?php

namespace backend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "kgi_branch".
*
    * @property integer $kgiBranchId
    * @property integer $kgiId
    * @property integer $branchId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class KgiBranchMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'kgi_branch';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['kgiId', 'branchId'], 'required'],
            [['kgiId', 'branchId'], 'integer'],
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
    'kgiBranchId' => 'Kgi Branch ID',
    'kgiId' => 'Kgi ID',
    'branchId' => 'Branch ID',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
