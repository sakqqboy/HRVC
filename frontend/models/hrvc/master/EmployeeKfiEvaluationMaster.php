<?php

namespace frontend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "employee_kfi_evaluation".
*
    * @property integer $eKfiId
    * @property integer $mKfiId
    * @property integer $kfiId
    * @property integer $employeeId
    * @property integer $weight
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class EmployeeKfiEvaluationMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'employee_kfi_evaluation';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['mKfiId', 'kfiId', 'employeeId'], 'required'],
            [['mKfiId', 'kfiId', 'employeeId', 'weight'], 'integer'],
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
    'eKfiId' => 'E Kfi ID',
    'mKfiId' => 'M Kfi ID',
    'kfiId' => 'Kfi ID',
    'employeeId' => 'Employee ID',
    'weight' => 'Weight',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
