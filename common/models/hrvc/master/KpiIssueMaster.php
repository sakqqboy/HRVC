<?php

namespace common\models\hrvc\master;

use Yii;

/**
* This is the model class for table "kpi_issue".
*
    * @property integer $kpiIssueId
    * @property string $issue
    * @property integer $kpiId
    * @property integer $employeeId
    * @property string $file
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class KpiIssueMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'kpi_issue';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['issue', 'kpiId', 'employeeId'], 'required'],
            [['issue'], 'string'],
            [['kpiId', 'employeeId'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['file'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 10],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'kpiIssueId' => 'Kpi Issue ID',
    'issue' => 'Issue',
    'kpiId' => 'Kpi ID',
    'employeeId' => 'Employee ID',
    'file' => 'File',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
