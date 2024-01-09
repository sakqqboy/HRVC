<?php

namespace backend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "kpi_employee".
*
    * @property integer $kpiEmployeeId
    * @property integer $employeeId
    * @property integer $kpiId
    * @property string $target
    * @property string $result
    * @property integer $createrId
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
            [['employeeId', 'kpiId', 'createrId'], 'integer'],
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
    'kpiEmployeeId' => 'Kpi Employee ID',
    'employeeId' => 'Employee ID',
    'kpiId' => 'Kpi ID',
    'target' => 'Target',
    'result' => 'Result',
    'createrId' => 'Creater ID',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
