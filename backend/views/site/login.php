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
            <div class="col-7" style="margin-left: 160px;">
                <label for="exampleInputPassword1" class="form-label em-login">Email</label>
                <div class="input-group mb-4">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" placeholder="ehsan@tokyoconsultingfirmlimited.com" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <label for="exampleInputPassword1" class="form-label em-login">Password</label>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>
                    <input type="password" class="form-control" aria-label="" placeholder="password">
                    <span class="input-group-text"><i class="fa fa-eye" aria-hidden="true"></i></span>
                </div>
                <div class="col-12 rows-remember">
                    <div class="row">
                        <div class="col-lg-6 text-start">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">Remember Credentials</label>
                            </div>
                        </div>
                        <div class="co-lg-5 text-end">
                            <div class="mb-3 signin-problem">
                                Signin Problem? <a href="" class="noline"> <span class="problem"> Contact Support</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary submit-primary">Sign in</button>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-12 black-roof">
            <div class="col-12 text-center">
                <img src="<?= Yii::$app->homeUrl ?>image/Roof.png" class="width-rof">
            </div>
        </div>
    </div>
</div>