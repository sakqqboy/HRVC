<?php

namespace backend/models\hrvc\master;

use Yii;

/**
* This is the model class for table "tbl_pl_medium_df".
*
    * @property integer $pl_medium_id
    * @property integer $list_order
    * @property string $medium_name
    * @property string $pl_major_id
*/
class TblPlMediumDfMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'tbl_pl_medium_df';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['list_order', 'medium_name', 'pl_major_id'], 'required'],
            [['list_order'], 'integer'],
            [['medium_name'], 'string', 'max' => 200],
            [['pl_major_id'], 'string', 'max' => 10],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'pl_medium_id' => 'Pl Medium ID',
    'list_order' => 'List Order',
    'medium_name' => 'Medium Name',
    'pl_major_id' => 'Pl Major ID',
];
}
}
