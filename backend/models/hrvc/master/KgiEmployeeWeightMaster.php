<?php

namespace backend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "kgi_employee_weight".
*
    * @property integer $kgiEmployeeWeigth
    * @property integer $employeeId
    * @property integer $kgiId
    * @property integer $kgiEmployeeId
    * @property integer $termId
    * @property string $level1
    * @property string $level1End
    * @property string $level2
    * @property string $level2End
    * @property string $level3
    * @property string $level3End
    * @property string $level4
    * @property string $level4End
    * @property string $weight
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class KgiEmployeeWeightMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'kgi_employee_weight';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['employeeId'], 'required'],
            [['employeeId', 'kgiId', 'kgiEmployeeId', 'termId'], 'integer'],
            [['level1', 'level1End', 'level2', 'level2End', 'level3', 'level3End', 'level4', 'level4End', 'weight'], 'number'],
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
    'kgiEmployeeWeigth' => 'Kgi Employee Weigth',
    'employeeId' => 'Employee ID',
    'kgiId' => 'Kgi ID',
    'kgiEmployeeId' => 'Kgi Employee ID',
    'termId' => 'Term ID',
    'level1' => 'Level1',
    'level1End' => 'Level1end',
    'level2' => 'Level2',
    'level2End' => 'Level2end',
    'level3' => 'Level3',
    'level3End' => 'Level3end',
    'level4' => 'Level4',
    'level4End' => 'Level4end',
    'weight' => 'Weight',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
