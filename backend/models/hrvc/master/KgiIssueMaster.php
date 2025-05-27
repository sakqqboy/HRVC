<?php

namespace backend/models\hrvc\master;

use Yii;

/**
* This is the model class for table "kgi_issue".
*
    * @property integer $kgiIssueId
    * @property string $issue
    * @property string $description
    * @property integer $kgiId
    * @property integer $employeeId
    * @property string $file
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class KgiIssueMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'kgi_issue';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['issue', 'kgiId', 'employeeId'], 'required'],
            [['issue', 'description'], 'string'],
            [['kgiId', 'employeeId'], 'integer'],
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
    'kgiIssueId' => 'Kgi Issue ID',
    'issue' => 'Issue',
    'description' => 'Description',
    'kgiId' => 'Kgi ID',
    'employeeId' => 'Employee ID',
    'file' => 'File',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
