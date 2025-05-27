<?php

namespace frontend\models\hrvc\master;

use Yii;

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
class GulLinksMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'gul_links';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['link_owner', 'link_rating'], 'integer'],
            [['link_updated'], 'safe'],
            [['link_notes'], 'required'],
            [['link_notes'], 'string'],
            [['link_url', 'link_name', 'link_image', 'link_description', 'link_rel', 'link_rss'], 'string', 'max' => 255],
            [['link_target'], 'string', 'max' => 25],
            [['link_visible'], 'string', 'max' => 20],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'link_id' => 'Link ID',
    'link_url' => 'Link Url',
    'link_name' => 'Link Name',
    'link_image' => 'Link Image',
    'link_target' => 'Link Target',
    'link_description' => 'Link Description',
    'link_visible' => 'Link Visible',
    'link_owner' => 'Link Owner',
    'link_rating' => 'Link Rating',
    'link_updated' => 'Link Updated',
    'link_rel' => 'Link Rel',
    'link_notes' => 'Link Notes',
    'link_rss' => 'Link Rss',
];
}
}
