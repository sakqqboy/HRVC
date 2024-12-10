<?php

namespace frontend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "department_title".
*
    * @property integer $id
    * @property integer $departmentId
    * @property integer $titleId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class DepartmentTitleMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'department_title';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['departmentId', 'titleId'], 'required'],
            [['departmentId', 'titleId'], 'integer'],
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
    'id' => 'ID',
    'departmentId' => 'Department ID',
    'titleId' => 'Title ID',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
