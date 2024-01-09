<?php

namespace frontend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "kgi_employee".
*
    * @property integer $kgiEmployeeId
    * @property integer $employeeId
    * @property integer $kgiId
    * @property string $target
    * @property string $result
    * @property integer $createrId
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
            [['employeeId', 'kgiId', 'createrId'], 'integer'],
            [['target', 'result'], 'number'],
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
    'target' => 'Target',
    'result' => 'Result',
    'createrId' => 'Creater ID',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
