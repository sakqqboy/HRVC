<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\GulTermsMaster;

/**
* This is the model class for table "gul_terms".
*
* @property string $term_id
* @property string $name
* @property string $slug
* @property integer $term_group
*/

class GulTerms extends \backend\models\hrvc\master\GulTermsMaster{
    /**
    * @inheritdoc
    */
    public function rules()
    {
        return array_merge(parent::rules(), []);
    }

    /**
    * @inheritdoc
    */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), []);
    }
}