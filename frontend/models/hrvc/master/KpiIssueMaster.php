<?php

namespace frontend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "kpi_issue".
*
    * @property integer $kpiIssueId
    * @property string $issue
    * @property string $description
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
            [['issue', 'description'], 'string'],
            [['kpiId', 'employeeId'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['file'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 4],
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
    'description' => 'Description',
    'kpiId' => 'Kpi ID',
    'employeeId' => 'Employee ID',
    'file' => 'File',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
