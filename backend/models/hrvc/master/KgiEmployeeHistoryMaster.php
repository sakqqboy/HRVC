<?php

namespace backend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "kgi_employee_history".
*
    * @property integer $kgiEmployeeHistoryId
    * @property integer $kgiEmployeeId
    * @property string $target
    * @property string $result
    * @property string $detail
    * @property string $nextCheckDate
    * @property string $lastCheckDate
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
            [['kgiEmployeeId', 'target', 'result'], 'required'],
            [['kgiEmployeeId'], 'integer'],
            [['target', 'result'], 'number'],
            [['detail'], 'string'],
            [['nextCheckDate', 'lastCheckDate', 'createDateTime', 'updateDateTime'], 'safe'],
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
    'detail' => 'Detail',
    'nextCheckDate' => 'Next Check Date',
    'lastCheckDate' => 'Last Check Date',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
