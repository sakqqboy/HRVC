<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\StatusMaster;

/**
 * This is the model class for table "status".
 *
 * @property integer $statusId
 * @property string $statusName
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class Status extends \backend\models\hrvc\master\StatusMaster
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
    public static function employeeStatus($status)
    {
        $statusText = "-";
        if ($status != '') {
            $status = Status::find()->select('statusName')->where(["statusId" => $status])->asArray()->one();
            if (isset($status) && !empty($status)) {
                $statusText = $status["statusName"];
            }
        }
        return $statusText;
    }
}
