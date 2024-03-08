<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\GulCommentsMaster;

/**
* This is the model class for table "gul_comments".
*
* @property string $comment_ID
* @property string $comment_post_ID
* @property string $comment_author
* @property string $comment_author_email
* @property string $comment_author_url
* @property string $comment_author_IP
* @property string $comment_date
* @property string $comment_date_gmt
* @property string $comment_content
* @property integer $comment_karma
* @property string $comment_approved
* @property string $comment_agent
* @property string $comment_type
* @property string $comment_parent
* @property string $user_id
*/

class GulComments extends \frontend\models\hrvc\master\GulCommentsMaster{
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
