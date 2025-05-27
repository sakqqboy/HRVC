<?php

namespace common\models\hrvc\master;

use Yii;

/**
* This is the model class for table "employee_pim_weight".
*
    * @property integer $employeePimWeightId
    * @property integer $employeeId
    * @property integer $termId
    * @property string $kfiWeight
    * @property string $kgiWeight
    * @property string $kpiWeight
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class EmployeePimWeightMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'employee_pim_weight';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['employeeId', 'termId'], 'required'],
            [['employeeId', 'termId'], 'integer'],
            [['kfiWeight', 'kgiWeight', 'kpiWeight'], 'number'],
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
    'employeePimWeightId' => 'Employee Pim Weight ID',
    'employeeId' => 'Employee ID',
    'termId' => 'Term ID',
    'kfiWeight' => 'Kfi Weight',
    'kgiWeight' => 'Kgi Weight',
    'kpiWeight' => 'Kpi Weight',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
