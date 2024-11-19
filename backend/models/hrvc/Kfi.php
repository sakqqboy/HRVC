<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\KfiMaster;
use common\models\ModelMaster;

/**
 * This is the model class for table "kfi".
 *
 * @property integer $kfiId
 * @property string $kfiName
 * @property integer $companyId
 * @property integer $branchId
 * @property integer $unitId
 * @property integer $targetAmount
 * @property string $month
 * @property integer $createrId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class Kfi extends \backend\models\hrvc\master\KfiMaster
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
    public static function nextCheckDate($kfiId)
    {
        $date = '';
        $kfiHistory = KfiHistory::find()
            ->select('nextCheckDate')
            ->where(["kfiId" => $kfiId, "status" => [1, 2, 4]])->orderBy('kfiHistoryId DESC')->asArray()->one();
        if (isset($kfiHistory) && !empty($kfiHistory) && $kfiHistory["nextCheckDate"] != '') {
            $date = ModelMaster::engDate($kfiHistory["nextCheckDate"], 2);
        }
        return $date;
    }
}
