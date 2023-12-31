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
    public static function  shortName($titleId)
    {
        $title = Title::find()->where(["titleId" => $titleId])->asArray()->one();
        return $title["shortTag"];
    }
    public static function titleId($departmentId, $titleName)
    {
        $title = Title::find()
            ->where(["departmentId" => $departmentId, "titleName" => $titleName, "status" => 1])
            ->asArray()
            ->one();
        if (isset($title) && !empty($title)) {
            return $title["titleId"];
        } else {
            return '';
        }
    }
}
