<?php

namespace common/models\hrvc\master;

use Yii;

/**
* This is the model class for table "salary_structure_history".
*
    * @property integer $salaryStructureHistoryId
    * @property integer $salaryStructureId
    * @property integer $defaultValue
    * @property integer $currencyId
    * @property integer $round
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class SalaryStructureHistoryMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'salary_structure_history';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['salaryStructureId', 'defaultValue', 'currencyId', 'round'], 'required'],
            [['salaryStructureId', 'defaultValue', 'currencyId'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['round', 'status'], 'string', 'max' => 10],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'salaryStructureHistoryId' => 'Salary Structure History ID',
    'salaryStructureId' => 'Salary Structure ID',
    'defaultValue' => 'Default Value',
    'currencyId' => 'Currency ID',
    'round' => 'Round',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
