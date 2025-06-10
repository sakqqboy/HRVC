<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\StatusMaster;

/**
 * This is the model class for table "status".
 *
 * @property integer $statusId
 * @property string $statusName
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class Status extends \frontend\models\hrvc\master\StatusMaster
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
    public static function allStatusText()
    {
        $status = Status::find()->where(["status" => 1])->asArray()->all();
        $statusArr = [];

        if (count($status) > 0) {
            foreach ($status as $s):
                $bgColor = "";
                $textColor = "";
                if ($s["statusName"] == "Full-Time") {
                    $bgColor = "#2580D3";
                    $textColor = "#FFFFFF";
                }
                if ($s["statusName"] == "Probationary") {
                    $bgColor = "#20598D";
                    $textColor = "#FFFFFF";
                }
                if ($s["statusName"] == "Part-Time") {
                    $bgColor = "#20598D";
                    $textColor = "#FFFFFF";
                }
                if ($s["statusName"] == "Intern") {
                    $bgColor = "#FFE100";
                    $textColor = "#000000";
                }
                if ($s["statusName"] == "Temporary") {
                    $bgColor = "#FF9D00";
                    $textColor = "#000000";
                }
                if ($s["statusName"] == "Freelance") {
                    $bgColor = "#FF9D00";
                    $textColor = "#000000";
                }
                if ($s["statusName"] == "Suspended") {
                    $bgColor = "#E05757";
                    $textColor = "#FFFFFF";
                }
                if ($s["statusName"] == "Resigned") {
                    $bgColor = "#EC1D42";
                    $textColor = "#FFFFFF";
                }
                if ($s["statusName"] == "Lay off") {
                    $bgColor = "#FF9D00";
                    $textColor = "#FFFFFF";
                }
                $statusArr[$s["statusId"]] = [
                    "statusName" => $s["statusName"],
                    "bgColor" => $bgColor,
                    "textColor" => $textColor
                ];
            endforeach;
        }
        return $statusArr;
    }
}
