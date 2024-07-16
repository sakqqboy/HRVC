<?php

namespace frontend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "bonus_term".
*
    * @property integer $bonusTermId
    * @property integer $termId
    * @property string $budget
    * @property string $totalBonus
    * @property string $totalAdjust
    * @property string $totalPayable
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class BonusTermMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'bonus_term';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['termId'], 'required'],
            [['termId'], 'integer'],
            [['budget', 'totalBonus', 'totalAdjust', 'totalPayable'], 'number'],
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
    'bonusTermId' => 'Bonus Term ID',
    'termId' => 'Term ID',
    'budget' => 'Budget',
    'totalBonus' => 'Total Bonus',
    'totalAdjust' => 'Total Adjust',
    'totalPayable' => 'Total Payable',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
