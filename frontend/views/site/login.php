<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
$form = ActiveForm::begin([
    'method' => 'post',
    'options' => [
        'enctype' => 'multipart/form-data',
    ],

]); ?>
?>


<div class="row">
    <div class="col-lg-9 col-md-6 col-12">
        <div class="col-12">
            <img src="<?= Yii::$app->homeUrl ?>image/image-25.png" class="width-HRVC">
        </div>
        <div class="col-12 text-center z-HRVC">
            Welcome to HRVC
        </div>
        <div class="col-12 text-center enter">
            Welcome back! Please enter your details.
        </div>
        <div class="col-lg-6 col-md-12 col-12 fm-log-mail">
            <label for="exampleInputPassword1" class="form-label em-login">Email</label>
            <div class="input-group mb-4">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                <input type="email" name="LoginForm[username]" class="form-control" required placeholder="email@tokyoconsultingfirmlimited.com">
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-12 fm-log-password">
            <label for="exampleInputPassword1" class="form-label em-login">Password</label>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>
                <input type="password" required name="LoginForm[password]" class="form-control" aria-label="" placeholder="password">
                <span class="input-group-text"><i class="fa fa-eye" aria-hidden="true"></i></span>
            </div>
            <div class="row">
                <div class="col-lg-6 checkbox-remember">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault"> Remember Credentials</label>
                    </div>
                </div>
                <div class="col-lg-6 fm-box-sig">
                    <span class="problem">Signing Problem?</span> <a href="">Contact Support</a>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-6 col-12 fm-signin">
            <button type="submit" class="btn btn-primary" style="width: 33rem;">Sign in</button>
        </div>
        <div class="col-12 link-privacy">
            This site is protected by reCAPTCHA and the Google <a href="" class="text-dark"> Privacy Policy</a> and <a href="" class="text-dark">Terms of Service</a> apply
        </div>
        <div class="col-12" style="margin-top :100px;">
            <img src="<?= Yii::$app->homeUrl ?>image/TCG-Logo1.png" class="TCG-Logo1"> &nbsp; <img src="<?= Yii::$app->homeUrl ?>image/c-tokyo.png" style="padding-top: 15px;width:100px;">
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-12 border">
        <div class="col-12">
            <img src="<?= Yii::$app->homeUrl ?>image/backgroundbule.png" class="backgroundbule">
        </div>
        <div class="col-12 pr-0 pl-0">
            <img src="<?= Yii::$app->homeUrl ?>image/Roof.png" class="width-rof">
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>