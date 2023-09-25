<?php

namespace common\models\hrvc\master;

use Yii;

/**
* This is the model class for table "kpi_solution".
*
    * @property integer $kpiSolutionId
    * @property integer $kpiIssueId
    * @property string $solution
    * @property integer $parentId
    * @property integer $employeeId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class KpiSolutionMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'kpi_solution';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['kpiIssueId', 'solution', 'employeeId'], 'required'],
            [['kpiIssueId', 'parentId', 'employeeId'], 'integer'],
            [['solution'], 'string'],
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
    'kpiSolutionId' => 'Kpi Solution ID',
    'kpiIssueId' => 'Kpi Issue ID',
    'solution' => 'Solution',
    'parentId' => 'Parent ID',
    'employeeId' => 'Employee ID',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
