<?php

namespace frontend\models\hrvc;

use Exception;
use Yii;
use \frontend\models\hrvc\master\UserRoleMaster;

/**
 * This is the model class for table "user_role".
 *
 * @property integer $userRoleId
 * @property integer $roleId
 * @property integer $userId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class UserRole extends \frontend\models\hrvc\master\UserRoleMaster
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
    public static function isManager()
    {
        $userId = Yii::$app->user->id;
        $userRole = UserRole::find()
            ->JOIN("LEFT JOIN", "role r", "r.roleId=user_role.roleId")
            ->where([
                "user_role.userId" => $userId,
                "user_role.roleId" => [1, 2, 3]
            ])
            ->asArray()
            ->all();
        if (count($userRole) > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    public static function isAdmin()
    {
        $userId = Yii::$app->user->id;
        $userRole = UserRole::find()
            ->where([
                "userId" => $userId,
                "roleId" => 1
            ])
            ->asArray()
            ->one();
        if (isset($userRole) && !empty($userRole)) {
            return 1;
        } else {
            return 0;
        }
    }
    public static function userRight()
    {
        if (isset(Yii::$app->user->id)) {
            $userRole = UserRole::find()
                ->select('roleId')
                ->where(["userId" => Yii::$app->user->id])
                ->orderBy("roleId ASC")
                ->asArray()
                ->one();
            if (isset($userRole) && !empty($userRole)) {
                if ($userRole["roleId"] == 1) { //admin
                    return 7;
                }
                if ($userRole["roleId"] == 2) { //gm
                    return 6;
                }
                if ($userRole["roleId"] == 3) { //manager
                    return 5;
                }
                if ($userRole["roleId"] == 4) { //supervisor  ass manager
                    return 4;
                }
                if ($userRole["roleId"] == 5) { //team leader
                    return 3;
                }
                if ($userRole["roleId"] == 6) { //hr
                    return 2;
                }
                if ($userRole["roleId"] == 7) { //staff
                    return 1;
                }
            }
        } else {
            return 0;
        }
    }
    public static function isHr()
    {
        if (isset(Yii::$app->user->id)) {
            $userRole = UserRole::find()->where(["roleId" => 6, "userId" => Yii::$app->user->id])->one();
            if (isset($userRole) && !empty($userRole)) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }
}