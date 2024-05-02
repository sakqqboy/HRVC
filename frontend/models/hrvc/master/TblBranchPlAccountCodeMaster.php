<?php

namespace frontend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "tbl_branch_pl_account_code".
*
    * @property string $account_id
    * @property string $create_datetime
    * @property integer $branchId
    * @property string $acc_code
    * @property string $acc_name
    * @property integer $pl_medium_id
    * @property integer $breakdown_id
    * @property integer $cash_flow_id
    * @property string $cash_flow_type
    * @property integer $list_order
    * @property string $note
*/
class TblBranchPlAccountCodeMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'tbl_branch_pl_account_code';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['account_id', 'branchId', 'pl_medium_id', 'breakdown_id', 'cash_flow_id', 'list_order'], 'required'],
            [['create_datetime'], 'safe'],
            [['branchId', 'pl_medium_id', 'breakdown_id', 'cash_flow_id', 'list_order'], 'integer'],
            [['account_id', 'acc_code'], 'string', 'max' => 10],
            [['acc_name'], 'string', 'max' => 100],
            [['cash_flow_type'], 'string', 'max' => 1],
            [['note'], 'string', 'max' => 150],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'account_id' => 'Account ID',
    'create_datetime' => 'Create Datetime',
    'branchId' => 'Branch ID',
    'acc_code' => 'Acc Code',
    'acc_name' => 'Acc Name',
    'pl_medium_id' => 'Pl Medium ID',
    'breakdown_id' => 'Breakdown ID',
    'cash_flow_id' => 'Cash Flow ID',
    'cash_flow_type' => 'Cash Flow Type',
    'list_order' => 'List Order',
    'note' => 'Note',
];
}
}
