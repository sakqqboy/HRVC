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
        return count($kgiTeam);
    }
    public static function employeeTeam($kgiId)
    {
        $kgiTeam = KgiTeam::find()->select('teamId')->where(["kgiId" => $kgiId])->asArray()->all();
        $data = [];
        if (isset($kgiTeam) && count($kgiTeam) > 0) {
            foreach ($kgiTeam as $team) :
                $employee = Employee::find()->select('picture,employeeId,gender')
                    ->where(["teamId" => $team["teamId"]])
                    ->asArray()->all();
                if (isset($employee) && count($employee) > 0) {
                    foreach ($employee as $emp) :
                        if ($emp['picture'] == "") {
                            if ($emp['gender'] == 1) {
                                $picture = 'image/user.png';
                            } else {
                                $picture = 'image/lady.jpg';
                            }
                        } else {
                            $picture = $emp['picture'];
                        }
                        $data[$emp["employeeId"]] = $picture;
                    endforeach;
                }
            endforeach;
        }
        return $data;
    }
}
