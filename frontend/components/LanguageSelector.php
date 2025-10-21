<?php

namespace frontend\components;

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
        $languageNew = $app->request->get('language'); //ตรวจสอบว่ามีการ request language หรือเปล่า


        if ($languageNew !== null) {
            if (!in_array($languageNew, $this->supportedLanguages)) { //ตรวจสอบว่า language ที่ส่งมาตรงกับที่ตั้งค่าไว้หรือเปล่า
                throw new Exception('Invalid your selected language.'); //ถ้าไม่มี language ในรายการก็ exception
            }

            $cookies->add(new Cookie([
                'name' => 'language',
                'value' => $languageNew,
                'client' => isset(Yii::$app->user->id) ? Yii::$app->user->id : null,
                'expire' => time() + 60 * 60 * 24 * 30, // 30 days
            ])); //สร้าง cookie language ใหม่ให้มีระยะเวลา 30 วัน ตรงนี้ตั้งค่าได้ตามต้องการ
            $app->language = $languageNew; //กำหนดค่าภาษาให้กับ app หลัก
            \Yii::$app->params["lang"] = $languageNew;
            //echo 'test1';
            //            $cc = new \yii\web\Controller();
            //            return $cc->redirect(["site/index"]);
        } else {

            $preferedLanguage = isset($app->request->cookies['language']) ? (string) $app->request->cookies['language'] : 'en-US'; //หากยังไม่ได้เลือกภาษาให้เป็นภาษาไทยก่อน

            if (empty($preferedLanguage)) {
                $preferedLanguage = $app->request->getPreferedLanguage($this->supportedLanguages); //หากยังไม่เลือกภาษา ให้ตรวจสอบว่าอยู่ในรายการหรือเปล่า
            }
            $app->language = $preferedLanguage; //กำหนดภาษาเริ่มต้นให้ app ในที่นี้คือ th-TH
        }
    }
}
