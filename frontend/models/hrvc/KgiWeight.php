<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\KgiWeightMaster;

/**
 * This is the model class for table "kgi_weight".
 *
 * @property integer $kgiWeightId
 * @property integer $kgiId
 * @property string $level1
 * @property string $level2
 * @property string $level3
 * @property string $level4
 * @property string $weight
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class KgiWeight extends \frontend\models\hrvc\master\KgiWeightMaster
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
    public static function kgiTermEmployee($termId)
    {
        $kgiWeight = KgiWeight::find()
            ->select('e.picture,kgi_weight.employeeId')
            ->JOIN("LEFT JOIN", "employee e", "e.employeeId=kgi_weight.employeeId")
            ->where([
                "kgi_weight.termId" => $termId,
                "kgi_weight.status" => 1,
                "e.status" => 1
            ])
            ->asArray()
            ->all();
        $data = [];
        if (isset($kgiWeight) && count($kgiWeight) > 0) {
            $i = 0;
            foreach ($kgiWeight as $kgi) :
                $data[$kgi["employeeId"]] = [
                    "picture" => $kgi["picture"]
                ];
                $i++;
            endforeach;
        }
        return $data;
    }
}
