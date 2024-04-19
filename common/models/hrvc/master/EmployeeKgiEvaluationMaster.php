<?php

namespace common\models\hrvc\master;

use Yii;

/**
* This is the model class for table "employee_kgi_evaluation".
*
    * @property integer $eKgiId
    * @property integer $mKgiId
    * @property integer $kgiId
    * @property integer $employeeId
    * @property integer $weight
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class EmployeeKgiEvaluationMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'employee_kgi_evaluation';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['mKgiId', 'kgiId', 'employeeId'], 'required'],
            [['mKgiId', 'kgiId', 'employeeId', 'weight'], 'integer'],
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
    'eKgiId' => 'E Kgi ID',
    'mKgiId' => 'M Kgi ID',
    'kgiId' => 'Kgi ID',
    'employeeId' => 'Employee ID',
    'weight' => 'Weight',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
