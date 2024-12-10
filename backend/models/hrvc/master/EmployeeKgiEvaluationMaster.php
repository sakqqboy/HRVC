<?php

namespace backend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "employee_kgi_evaluation".
*
    * @property integer $eKgiId
    * @property integer $kgiWeighId
    * @property integer $employeeId
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
            [['kgiWeighId', 'employeeId'], 'required'],
            [['kgiWeighId', 'employeeId'], 'integer'],
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
    'eKgiId' => 'E Kgi ID',
    'kgiWeighId' => 'Kgi Weigh ID',
    'employeeId' => 'Employee ID',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
