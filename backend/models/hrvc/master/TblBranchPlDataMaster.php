<?php

namespace backend/models\hrvc\master;

use Yii;

/**
* This is the model class for table "tbl_branch_pl_data".
*
    * @property string $account_id
    * @property integer $month
    * @property integer $year
    * @property string $actual_amount
    * @property string $target_amount
    * @property string $next_target_amount
*/
class TblBranchPlDataMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'tbl_branch_pl_data';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['account_id', 'month', 'year'], 'required'],
            [['month', 'year'], 'integer'],
            [['actual_amount', 'target_amount', 'next_target_amount'], 'number'],
            [['account_id'], 'string', 'max' => 10],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'account_id' => 'Account ID',
    'month' => 'Month',
    'year' => 'Year',
    'actual_amount' => 'Actual Amount',
    'target_amount' => 'Target Amount',
    'next_target_amount' => 'Next Target Amount',
];
}
}
