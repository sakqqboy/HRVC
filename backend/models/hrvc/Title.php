<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\TitleMaster;

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

class Title extends \backend\models\hrvc\master\TitleMaster
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
        $titleName = "";
        if ($titleId != "") {
            $title = Title::find()->select('titleName')->where(["titleId" => $titleId])->asArray()->one();
            $titleName = $title["titleName"];
        }
        return $titleName;
    }
}
