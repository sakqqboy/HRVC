<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\GulLinksMaster;

/**
* This is the model class for table "gul_links".
*
* @property string $link_id
* @property string $link_url
* @property string $link_name
* @property string $link_image
* @property string $link_target
* @property string $link_description
* @property string $link_visible
* @property string $link_owner
* @property integer $link_rating
* @property string $link_updated
* @property string $link_rel
* @property string $link_notes
* @property string $link_rss
*/

class GulLinks extends \frontend\models\hrvc\master\GulLinksMaster{
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
