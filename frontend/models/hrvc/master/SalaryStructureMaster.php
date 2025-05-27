<?php

namespace frontend/models\hrvc\master;

use Yii;

/**
* This is the model class for table "salary_structure".
*
    * @property integer $salaryStructureId
    * @property integer $salaryId
    * @property integer $structureId
    * @property integer $defaultValue
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class SalaryStructureMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'salary_structure';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['salaryId', 'structureId', 'defaultValue'], 'required'],
            [['salaryId', 'structureId', 'defaultValue'], 'integer'],
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
    'salaryStructureId' => 'Salary Structure ID',
    'salaryId' => 'Salary ID',
    'structureId' => 'Structure ID',
    'defaultValue' => 'Default Value',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
