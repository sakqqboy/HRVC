<?php

namespace common/models\hrvc\master;

use Yii;

/**
* This is the model class for table "kgi_employee".
*
    * @property integer $kgiEmployeeId
    * @property integer $employeeId
    * @property integer $kgiId
    * @property string $target
    * @property string $result
    * @property string $fromDate
    * @property string $toDate
    * @property string $nextCheckDate
    * @property string $month
    * @property string $year
    * @property integer $createrId
    * @property string $remark
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
            [['fromDate', 'toDate', 'nextCheckDate', 'createDateTime', 'updateDateTime'], 'safe'],
            [['remark'], 'string'],
            [['month', 'year'], 'string', 'max' => 45],
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
    'fromDate' => 'From Date',
    'toDate' => 'To Date',
    'nextCheckDate' => 'Next Check Date',
    'month' => 'Month',
    'year' => 'Year',
    'createrId' => 'Creater ID',
    'remark' => 'Remark',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
