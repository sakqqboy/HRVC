<?php

namespace common\models\hrvc\master;

use Yii;

/**
* This is the model class for table "kgi_employee".
*
    * @property integer $kgiEmployeeId
    * @property integer $employeeId
    * @property integer $kgiId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class KgiEmployeeMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'kgi_employee';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['employeeId', 'kgiId'], 'required'],
            [['employeeId', 'kgiId'], 'integer'],
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
    'kgiEmployeeId' => 'Kgi Employee ID',
    'employeeId' => 'Employee ID',
    'kgiId' => 'Kgi ID',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
