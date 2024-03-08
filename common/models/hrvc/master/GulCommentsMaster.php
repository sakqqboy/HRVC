<?php

namespace common\models\hrvc\master;

use Yii;

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
class GulCommentsMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'gul_comments';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['comment_post_ID', 'comment_karma', 'comment_parent', 'user_id'], 'integer'],
            [['comment_author', 'comment_content'], 'required'],
            [['comment_author', 'comment_content'], 'string'],
            [['comment_date', 'comment_date_gmt'], 'safe'],
            [['comment_author_email', 'comment_author_IP'], 'string', 'max' => 100],
            [['comment_author_url'], 'string', 'max' => 200],
            [['comment_approved', 'comment_type'], 'string', 'max' => 20],
            [['comment_agent'], 'string', 'max' => 255],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'comment_ID' => 'Comment ID',
    'comment_post_ID' => 'Comment Post ID',
    'comment_author' => 'Comment Author',
    'comment_author_email' => 'Comment Author Email',
    'comment_author_url' => 'Comment Author Url',
    'comment_author_IP' => 'Comment Author Ip',
    'comment_date' => 'Comment Date',
    'comment_date_gmt' => 'Comment Date Gmt',
    'comment_content' => 'Comment Content',
    'comment_karma' => 'Comment Karma',
    'comment_approved' => 'Comment Approved',
    'comment_agent' => 'Comment Agent',
    'comment_type' => 'Comment Type',
    'comment_parent' => 'Comment Parent',
    'user_id' => 'User ID',
];
}
}
