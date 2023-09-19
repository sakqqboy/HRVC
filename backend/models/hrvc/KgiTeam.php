<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\KgiTeamMaster;

/**
 * This is the model class for table "kgi_team".
 *
 * @property integer $kgiTeamId
 * @property integer $kgiId
 * @property integer $teamId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class KgiTeam extends \backend\models\hrvc\master\KgiTeamMaster
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
    public static function kgiTeam($kgiId)
    {
        $kgiTeam = KgiTeam::find()
            ->select('t.teamName,kgi_team.teamId')
            ->JOIN("LEFT JOIN", "team t", "t.teamId=kgi_team.teamId")
            ->where(["t.status" => 1, "kgi_team.status" => 1, "kgi_team.kgiId" => $kgiId])
            ->asArray()
            ->all();
        /*$teamName = '';
        if (count($kgiTeam) > 0) {
            if (count($kgiTeam) == 1) {
                foreach ($kgiTeam as $team) :
                    $teamName = $team["team"];
                endforeach;
            } else {
                $teamName = count($kgiTeam);
            }
        }*/
        return count($kgiTeam);
    }
}
