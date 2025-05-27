<?php

namespace common/models\hrvc\master;

use Yii;

/**
* This is the model class for table "tbl_client_pl_data".
*
    * @property string $pl_code_id
    * @property string $month
    * @property string $year
    * @property double $amount
*/
class TblClientPlDataMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'tbl_client_pl_data';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['pl_code_id', 'month', 'year', 'amount'], 'required'],
            [['amount'], 'number'],
            [['pl_code_id'], 'string', 'max' => 10],
            [['month'], 'string', 'max' => 2],
            [['year'], 'string', 'max' => 4],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'pl_code_id' => 'Pl Code ID',
    'month' => 'Month',
    'year' => 'Year',
    'amount' => 'Amount',
];
}
}
