<?php

namespace frontend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "tbl_pl_cash_flow_df".
*
    * @property integer $cash_flow_id
    * @property integer $list_order
    * @property string $cash_flow_name
*/
class TblPlCashFlowDfMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'tbl_pl_cash_flow_df';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['list_order', 'cash_flow_name'], 'required'],
            [['list_order'], 'integer'],
            [['cash_flow_name'], 'string', 'max' => 200],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'cash_flow_id' => 'Cash Flow ID',
    'list_order' => 'List Order',
    'cash_flow_name' => 'Cash Flow Name',
];
}
}
