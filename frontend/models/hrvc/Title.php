<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\TitleMaster;

/**
 * This is the model class for table "title".
 *
 * @property integer $titleId
 * @property string $titleName
 * @property integer $layerId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class Title extends \frontend\models\hrvc\master\TitleMaster
{
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
    public static function titleName($titleId)
    {
        $title = Title::find()->select('titleName')->where(["titleId" => $titleId])->asArray()->one();
        if (isset($title) && !empty($title)) {
            return $title["titleName"];
        } else {
            return '';
        }
    }
}
