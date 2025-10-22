<?php

namespace frontend\components;

use common\helpers\LanguageSession;
use frontend\models\hrvc\DefaultLanguage;
use Yii;
use yii\base\BootstrapInterface;
use yii\web\Cookie;
use yii\base\Exception;

class LanguageSelector implements BootstrapInterface
{

    public $supportedLanguages = [];

    public function bootstrap($app)
    {
        $cookies = $app->response->cookies; //กำหนด cookie
        $selectChangeLanguage = $app->request->get('language'); //ตรวจสอบว่ามีการ request language หรือเปล่า
        // $session = Yii::$app->session;
        // if ($session->has('currentType')) {
        //     $filter = $session->get('currentType');
        // }
        if ($selectChangeLanguage !== null) {
            $language = $selectChangeLanguage;
        } else {
            $oldCookies = Yii::$app->request->cookies;
            if ($oldCookies->has('language')) {
                $language = $oldCookies->getValue('language');
            } else {
                $defaultLanguage = DefaultLanguage::userDefaultLanguage();
                if ($defaultLanguage !== '') {
                    $language = $defaultLanguage;
                    // $userLanguage = LanguageSession::setLanguageSelect(0);
                }
            }
        }
        if (isset($language) && $language !== null) {
            if (!in_array($language, $this->supportedLanguages)) { //ตรวจสอบว่า language ที่ส่งมาตรงกับที่ตั้งค่าไว้หรือเปล่า
                throw new Exception('Invalid your selected language.'); //ถ้าไม่มี language ในรายการก็ exception
            }
            $cookies->add(new Cookie([
                'name' => 'language',
                'value' => $language,
                //'expire' => time() + 60 * 60 * 24 * 30, // 30 days
            ])); //สร้าง cookie language ใหม่ให้มีระยะเวลา 30 วัน ตรงนี้ตั้งค่าได้ตามต้องการ
            $app->language = $language; //กำหนดค่าภาษาให้กับ app หลัก
            \Yii::$app->params["lang"] = $language;
        } else {
            $preferedLanguage = isset($app->request->cookies['language']) ? (string) $app->request->cookies['language'] : 'en-US'; //หากยังไม่ได้เลือกภาษาให้เป็นภาษาไทยก่อน
            if (empty($preferedLanguage)) {
                $preferedLanguage = $app->request->getPreferedLanguage($this->supportedLanguages); //หากยังไม่เลือกภาษา ให้ตรวจสอบว่าอยู่ในรายการหรือเปล่า
            }
            $app->language = $preferedLanguage; //กำหนดภาษาเริ่มต้นให้ app ในที่นี้คือ th-TH
        }
    }
}
