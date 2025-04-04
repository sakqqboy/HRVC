<?php

namespace common\models\hrvc\master;

use Yii;

/**
* This is the model class for table "gul_terms".
*
    * @property string $term_id
    * @property string $name
    * @property string $slug
    * @property integer $term_group
*/
class GulTermsMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'gul_terms';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['term_group'], 'integer'],
            [['name', 'slug'], 'string', 'max' => 200],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'term_id' => 'Term ID',
    'name' => 'Name',
    'slug' => 'Slug',
    'term_group' => 'Term Group',
];
}
}
