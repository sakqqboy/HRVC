<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\UserMaster;

/**
 * This is the model class for table "user".
 *
 * @property integer $userId
 * @property string $userName
 * @property string $password_hash
 * @property integer $employeeId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class User extends \backend\models\hrvc\master\UserMaster
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
    public static function employeeNameByuserId($userId)
    {

        if ($userId != '') {
            $user = User::find()->where(["userId" => $userId])->asArray()->one();
            if (isset($user) && !empty($user)) {
                $employee = Employee::find()->where(["employeeId" => $user["employeeId"]])->asArray()->one();
                if (isset($employee) && !empty($employee)) {
                    return $employee["employeeFirstname"] . " " . $employee["employeeSurename"];
                }
            }
        }
        return '';
    }
}
