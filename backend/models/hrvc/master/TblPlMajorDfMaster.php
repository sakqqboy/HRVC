<?php

namespace backend/models\hrvc\master;

use Yii;

/**
* This is the model class for table "tbl_pl_major_df".
*
    * @property integer $pl_major_id
    * @property integer $list_order
    * @property string $major_name
*/
class TblPlMajorDfMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'tbl_pl_major_df';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['list_order', 'major_name'], 'required'],
            [['list_order'], 'integer'],
            [['major_name'], 'string', 'max' => 200],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'pl_major_id' => 'Pl Major ID',
    'list_order' => 'List Order',
    'major_name' => 'Major Name',
];
}
}
