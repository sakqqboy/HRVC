<?php

namespace backend/models\hrvc\master;

use Yii;

/**
* This is the model class for table "kfi_solution".
*
    * @property integer $kfiSolutionId
    * @property integer $kfiIssueId
    * @property string $solution
    * @property integer $parentId
    * @property integer $employeeId
    * @property string $file
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class KfiSolutionMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'kfi_solution';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['kfiIssueId', 'solution', 'employeeId'], 'required'],
            [['kfiIssueId', 'parentId', 'employeeId'], 'integer'],
            [['solution'], 'string'],
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
    'kfiSolutionId' => 'Kfi Solution ID',
    'kfiIssueId' => 'Kfi Issue ID',
    'solution' => 'Solution',
    'parentId' => 'Parent ID',
    'employeeId' => 'Employee ID',
    'file' => 'File',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
