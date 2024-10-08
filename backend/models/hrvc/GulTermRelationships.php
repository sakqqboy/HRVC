<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\GulTermRelationshipsMaster;

/**
* This is the model class for table "gul_term_relationships".
*
* @property string $object_id
* @property string $term_taxonomy_id
* @property integer $term_order
*/

class GulTermRelationships extends \backend\models\hrvc\master\GulTermRelationshipsMaster{
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
