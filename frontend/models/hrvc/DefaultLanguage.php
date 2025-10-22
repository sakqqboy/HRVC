<?php

namespace frontend\models\hrvc;

use Exception;
use Yii;
use \frontend\models\hrvc\master\DefaultLanguageMaster;

/**
 * This is the model class for table "default_language".
 *
 * @property integer $languageId
 * @property string $language
 * @property string $languageName
 * @property integer $countryId
 * @property string $createDate
 */

class DefaultLanguage extends \frontend\models\hrvc\master\DefaultLanguageMaster
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
    public static function userDefaultLanguage()
    {
        $defaultLanguage = '';
        if (Yii::$app->user->id && Yii::$app->user->id !== '') {
            $user = User::find()
                ->select('employeeId')
                ->where(["userId" => Yii::$app->user->id])
                ->asArray()
                ->one();

            $userDefaultLanguage = Employee::find()
                ->select('defaultLanguage')
                ->where(["employeeId" => $user["employeeId"]])
                ->asArray()
                ->one();

            if (isset($userDefaultLanguage) && !empty($userDefaultLanguage)) {
                if ($userDefaultLanguage["defaultLanguage"] != '') {
                    $systemLanguage = DefaultLanguage::find()->where(["languageId" => $userDefaultLanguage["defaultLanguage"]])->asArray()->one();
                    if (isset($systemLanguage) && !empty($systemLanguage)) {
                        $defaultLanguage = $systemLanguage["language"];
                    }
                }
            }
        }
        return $defaultLanguage;
    }
}
