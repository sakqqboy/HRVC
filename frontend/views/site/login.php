<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-12 mt-90">
    <div class="row">
        <div class="col-lg-8 col-md-6 col-12">
            <div class="col-12 text-start">
                <img src="<?= Yii::$app->homeUrl ?>image/image-25.png" class="width-HRVC">
            </div>
            <div class="col-12 text-center z-HRVC">
                Welcome to HRVC
            </div>
            <div class="col-12 text-center enter">
                Welcome back! Please enter your details.
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-12 col-12 fm-log-mail">
                    <label for="exampleInputPassword1" class="form-label em-login">Email</label>
                    <div class="input-group mb-4">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                        <input type="email" class="form-control" placeholder="email@tokyoconsultingfirmlimited.com" aria-label="email" aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-12 fm-log-password">
                    <label for="exampleInputPassword1" class="form-label em-login">Password</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>
                        <input type="password" class="form-control" aria-label="" placeholder="password">
                        <span class="input-group-text"><i class="fa fa-eye" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 checkbox-remember">
                    <div class="col-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Remember Credentials
                            </label>
                        </div>
                    </div>
                    <div class="col-6 text-end fm-box-sig">
                        <span class="problem">Signing Problem?</span> <a href="">Contact Support</a>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-30 text-center">
                <button type="submit" class="btn btn-primary" style="width: 32rem;margin-left:-15px;">Sign in</button>
            </div>
            <div class="col-12 text-center mt-30 font-size-11" style="font-weight: 600;">
                This site is protected by reCAPTCHA and the Google <a href="" class="text-dark"> Privacy Policy</a> and <a href="" class="text-dark">Terms of Service</a> apply
            </div>
            <div class="col-12" style="margin-top :120px;">
                <img src="<?= Yii::$app->homeUrl ?>image/TCG-Logo1.png" class="TCG-Logo1"> &nbsp; <img src="<?= Yii::$app->homeUrl ?>image/21049.png" style="padding-top: 15px">
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-12 black-roof">
            <div class="col-12 text-center">
                <img src="<?= Yii::$app->homeUrl ?>image/Roof.png" class="width-rof">
            </div>
        </div>
    </div>
</div>