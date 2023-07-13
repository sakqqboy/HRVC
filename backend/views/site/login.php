<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Login';
?>

<div class="col-12">
    <div class="row">
        <div class="col-lg-8 col-md-6 col-12">
            <div class="col-12 text-center">
                <img src="<?= Yii::$app->homeUrl ?>image/HRVC.png" class="width-HRVC">
            </div>
            <div class="col-12 text-center z-HRVC">
                Welcome to HRVC
            </div>
            <div class="col-12 text-center enter">
                Welcome back! Please enter your details.
            </div>
            <div class="col-9" style="margin-left: 60px; margin-top:30px;">
                <label for="exampleInputPassword1" class="form-label em-login">Email</label>
                <div class="input-group mb-4">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" placeholder="email@tokyoconsultingfirmlimited.com" aria-label="Username" aria-describedby="basic-addon1">
                </div>
            </div>
            <div class="col-9" style="margin-left: 60px; margin-top:30px;">
                <label for="exampleInputPassword1" class="form-label em-login">Password</label>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>
                    <input type="password" class="form-control" aria-label="" placeholder="password">
                    <span class="input-group-text"><i class="fa fa-eye" aria-hidden="true"></i></span>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="col-5" style="margin-left: 60px; margin-top:30px;">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Remember Credentials
                            </label>
                        </div>
                    </div>
                    <div class="col-7 text-end" style="margin-top: -24px; margin-left:200px">
                        Signin Problem? <span class="problem"> Contact Support</span>
                    </div>
                </div>
            </div>
            <div class="col-9" style="margin-left:60px;margin-top:60px;">
                <button type="button" class="btn btn-primary" style="width: 100%">Sing in</button>
            </div>
            <div class="col-12">
                <img src="<?= Yii::$app->homeUrl ?>image/TCG-Logo1.png" style="width: 50px; margin-top:50px;"> <img src="<?= Yii::$app->homeUrl ?>image/21049.png" style="margin-top:70px;margin-left:10px;">
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-12 black-roof">
            <div class="col-12 text-center">
                <img src="<?= Yii::$app->homeUrl ?>image/Roof.png" class="width-rof">
            </div>
        </div>
    </div>
</div>