<?php

namespace frontend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "kpi_department".
*
    * @property integer $kpiDepartmentId
    * @property integer $kpiId
    * @property integer $departmentId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class KpiDepartmentMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'kpi_department';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['kpiId', 'departmentId'], 'required'],
            [['kpiId', 'departmentId'], 'integer'],
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
    'kpiDepartmentId' => 'Kpi Department ID',
    'kpiId' => 'Kpi ID',
    'departmentId' => 'Department ID',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
