<?php

namespace frontend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "kgi_solution".
*
    * @property integer $kgiSolutionId
    * @property integer $kgiIssueId
    * @property string $solution
    * @property integer $parentId
    * @property integer $employeeId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class KgiSolutionMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'kgi_solution';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['kgiIssueId', 'solution', 'employeeId'], 'required'],
            [['kgiIssueId', 'parentId', 'employeeId'], 'integer'],
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
    'kgiSolutionId' => 'Kgi Solution ID',
    'kgiIssueId' => 'Kgi Issue ID',
    'solution' => 'Solution',
    'parentId' => 'Parent ID',
    'employeeId' => 'Employee ID',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
