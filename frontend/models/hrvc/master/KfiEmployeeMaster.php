<?php

namespace frontend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "kfi_employee".
*
    * @property integer $kfiEmployeeId
    * @property integer $employeeId
    * @property integer $kfiId
    * @property string $target
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class KfiEmployeeMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'kfi_employee';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['employeeId', 'kfiId'], 'required'],
            [['employeeId', 'kfiId'], 'integer'],
            [['target'], 'number'],
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
    'kfiEmployeeId' => 'Kfi Employee ID',
    'employeeId' => 'Employee ID',
    'kfiId' => 'Kfi ID',
    'target' => 'Target',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
