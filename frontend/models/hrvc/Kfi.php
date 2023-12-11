<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\KfiMaster;

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

class Kfi extends \frontend\models\hrvc\master\KfiMaster
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
    public static function kfiName($kfiId)
    {
        $kfi = Kfi::find()->where(["kfiId" => $kfiId])->asArray()->one();
        return $kfi["kfiName"];
    }
}
