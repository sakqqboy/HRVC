<?php

namespace frontend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "bonus_record".
*
    * @property integer $bonusRecordId
    * @property integer $termId
    * @property integer $employeeId
    * @property integer $rankId
    * @property string $rankName
    * @property string $salary
    * @property string $bonusRate
    * @property string $finalAdjustment
    * @property integer $creator
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class BonusRecordMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'bonus_record';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['bonusRecordId', 'termId', 'employeeId'], 'required'],
            [['bonusRecordId', 'termId', 'employeeId', 'rankId', 'creator'], 'integer'],
            [['salary', 'bonusRate', 'finalAdjustment'], 'number'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['rankName'], 'string', 'max' => 200],
            [['status'], 'string', 'max' => 10],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'bonusRecordId' => 'Bonus Record ID',
    'termId' => 'Term ID',
    'employeeId' => 'Employee ID',
    'rankId' => 'Rank ID',
    'rankName' => 'Rank Name',
    'salary' => 'Salary',
    'bonusRate' => 'Bonus Rate',
    'finalAdjustment' => 'Final Adjustment',
    'creator' => 'Creator',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
