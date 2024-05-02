<?php

namespace common\models\hrvc\master;

use Yii;

/**
* This is the model class for table "tbl_pl_breakdown_df".
*
    * @property integer $breakdown_id
    * @property integer $list_order
    * @property string $breakdown_name
*/
class TblPlBreakdownDfMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'tbl_pl_breakdown_df';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['list_order', 'breakdown_name'], 'required'],
            [['list_order'], 'integer'],
            [['breakdown_name'], 'string', 'max' => 100],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'breakdown_id' => 'Breakdown ID',
    'list_order' => 'List Order',
    'breakdown_name' => 'Breakdown Name',
];
}
}
