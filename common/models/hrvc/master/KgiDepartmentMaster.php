<?php

namespace common/models\hrvc\master;

use Yii;

/**
* This is the model class for table "kgi_department".
*
    * @property integer $kgiDepartmentId
    * @property integer $kgiId
    * @property integer $departmentId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class KgiDepartmentMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'kgi_department';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['kgiId', 'departmentId'], 'required'],
            [['kgiId', 'departmentId'], 'integer'],
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
    'kgiDepartmentId' => 'Kgi Department ID',
    'kgiId' => 'Kgi ID',
    'departmentId' => 'Department ID',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
