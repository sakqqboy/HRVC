<?php

namespace frontend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "kgi_employee_history".
*
    * @property integer $kgiEmployeeHistoryId
    * @property integer $kgiEmployeeId
    * @property string $target
    * @property string $result
    * @property string $fromDate
    * @property string $toDate
    * @property string $detail
    * @property string $nextCheckDate
    * @property string $month
    * @property string $year
    * @property string $lastCheckDate
    * @property integer $createrId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class KgiEmployeeHistoryMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'kgi_employee_history';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['kgiEmployeeId'], 'required'],
            [['kgiEmployeeId', 'createrId'], 'integer'],
            [['target', 'result'], 'number'],
            [['fromDate', 'toDate', 'nextCheckDate', 'lastCheckDate', 'createDateTime', 'updateDateTime'], 'safe'],
            [['detail'], 'string'],
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
    'kgiEmployeeHistoryId' => 'Kgi Employee History ID',
    'kgiEmployeeId' => 'Kgi Employee ID',
    'target' => 'Target',
    'result' => 'Result',
    'fromDate' => 'From Date',
    'toDate' => 'To Date',
    'detail' => 'Detail',
    'nextCheckDate' => 'Next Check Date',
    'month' => 'Month',
    'year' => 'Year',
    'lastCheckDate' => 'Last Check Date',
    'createrId' => 'Creater ID',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
