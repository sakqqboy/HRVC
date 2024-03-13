<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\FrameTermMaster;

/**
 * This is the model class for table "frame_term".
 *
 * @property integer $termId
 * @property string $termName
 * @property integer $frameId
 * @property integer $sort
 * @property string $startDate
 * @property string $endDate
 * @property string $midDate
 * @property integer $isIncludeBous
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class FrameTerm extends \frontend\models\hrvc\master\FrameTermMaster
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
    public static function currentTerm($frameId)
    {
        $term = FrameTerm::find()
            ->select('termName')
            ->where(["status" => 1, "frameId" => $frameId])
            ->asArray()
            ->one();
        if (isset($term) && !empty($term)) {
            return $term["termName"];
        } else {
            return null;
        }
    }
    public static function isIncludeBonus($frameId)
    {
        $term = FrameTerm::find()
            ->select('isIncludeBonus')
            ->where(["status" => 1, "frameId" => $frameId])
            ->asArray()
            ->one();
        if (isset($term) && !empty($term)) {
            if ($term["isIncludeBonus"] == 1) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }
}
