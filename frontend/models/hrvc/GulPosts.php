<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\GulPostsMaster;

/**
* This is the model class for table "gul_posts".
*
* @property string $ID
* @property string $post_author
* @property string $post_date
* @property string $post_date_gmt
* @property string $post_content
* @property string $post_title
* @property string $post_excerpt
* @property string $post_status
* @property string $comment_status
* @property string $ping_status
* @property string $post_password
* @property string $post_name
* @property string $to_ping
* @property string $pinged
* @property string $post_modified
* @property string $post_modified_gmt
* @property string $post_content_filtered
* @property string $post_parent
* @property string $guid
* @property integer $menu_order
* @property string $post_type
* @property string $post_mime_type
* @property integer $comment_count
*/

class GulPosts extends \frontend\models\hrvc\master\GulPostsMaster{
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
