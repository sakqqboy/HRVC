<?php

namespace backend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "kfi_department".
*
    * @property integer $kfiDepartmentId
    * @property integer $kfiId
    * @property integer $departmentId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class KfiDepartmentMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'kfi_department';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['kfiId', 'departmentId'], 'required'],
            [['kfiId', 'departmentId'], 'integer'],
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
    'kfiDepartmentId' => 'Kfi Department ID',
    'kfiId' => 'Kfi ID',
    'departmentId' => 'Department ID',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
