<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\GulTermTaxonomyMaster;

/**
* This is the model class for table "gul_term_taxonomy".
*
* @property string $term_taxonomy_id
* @property string $term_id
* @property string $taxonomy
* @property string $description
* @property string $parent
* @property integer $count
*/

class GulTermTaxonomy extends \backend\models\hrvc\master\GulTermTaxonomyMaster{
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
