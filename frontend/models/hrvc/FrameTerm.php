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
    public static function currentTermId($companyId)
    {
        $termId = 0;
        $environment = Environment::find()->where(["companyId" => $companyId, "status" => 1])->asArray()->one();
        if (isset($environment) && !empty($environment)) {
            $frame = Frame::find()
                ->where(["status" => 1, "environmentId" => $environment["environmentId"]])
                ->asArray()
                ->orderBy("frameId")
                ->one();
            if (isset($frame) && !empty($frame)) {
                $term = FrameTerm::find()
                    ->where(["status" => 1, "frameId" => $frame["frameId"]])
                    ->asArray()
                    ->orderBy('createDateTime')
                    ->one();
                if (isset($term) && !empty($term)) {
                    $termId = $term["termId"];
                }
            }
        }
        return $termId;
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
    public static function findDepartmentId($termId)
    {
        $term = FrameTerm::find()->where(["termId" => $termId])->one();
        $frame = Frame::find()->where(["frameId" => $term->frameId])->one();
        $environment = Environment::find()->where(["environmentId" => $frame->environmentId])->one();
        return $environment->branchId;
    }
}
