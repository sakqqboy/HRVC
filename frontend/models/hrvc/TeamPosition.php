<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\TeamPositionMaster;

/**
 * This is the model class for table "team_position".
 *
 * @property integer $teamPositionId
 * @property string $teamPositionName
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class TeamPosition extends \frontend\models\hrvc\master\TeamPositionMaster
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
    public static function teamPositionName($teamPositionId)
    {
        $teampositionName = "";
        if ($teamPositionId != '') {
            $teamPosition = TeamPosition::find()->where(["teamPositionId" => $teamPositionId])->asArray()->one();
            $teampositionName = $teamPosition["teamPositionName"];
        }
        return  $teampositionName;
    }
    public static function teamPositionId($teamPositionName)
    {
        $teamPosition = TeamPosition::find()
            ->where(["teamPositionName" => $teamPositionName, "status" => 1])
            ->asArray()
            ->one();
        if (isset($teamPosition) && !empty($teamPosition)) {
            return $teamPosition["teamPositionId"];
        } else {
            return '';
        }
    }
}
