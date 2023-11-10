<?php

namespace common\models\hrvc\master;

use Yii;

/**
* This is the model class for table "kpi_employee".
*
    * @property integer $kpiEmployeeId
    * @property integer $employeeId
    * @property integer $kpiId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class KpiEmployeeMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'kpi_employee';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['employeeId', 'kpiId'], 'required'],
            [['employeeId', 'kpiId'], 'integer'],
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
    'kpiEmployeeId' => 'Kpi Employee ID',
    'employeeId' => 'Employee ID',
    'kpiId' => 'Kpi ID',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
