<?php

namespace backend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "kfi_issue".
*
    * @property integer $kfiIssueId
    * @property string $issue
    * @property integer $kfiId
    * @property integer $employeeId
    * @property string $file
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class KfiIssueMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'kfi_issue';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['issue', 'kfiId', 'employeeId'], 'required'],
            [['issue'], 'string'],
            [['kfiId', 'employeeId'], 'integer'],
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
    'kfiIssueId' => 'Kfi Issue ID',
    'issue' => 'Issue',
    'kfiId' => 'Kfi ID',
    'employeeId' => 'Employee ID',
    'file' => 'File',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
