<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\RoleMaster;

/**
 * This is the model class for table "role".
 *
 * @property integer $roleId
 * @property string $roleName
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class Role extends \frontend\models\hrvc\master\RoleMaster
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
    public static function roleId($roleName)
    {
        $role = Role::find()->where(["roleName" => $roleName, "status" => 1])->asArray()->one();
        if (isset($role) && !empty($role)) {
            return $role["roleId"];
        } else {
            return '';
        }
    }
}
