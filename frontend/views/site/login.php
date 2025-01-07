<?php
/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Login';
$form = ActiveForm::begin([
    'method' => 'post',
    'options' => [
        'enctype' => 'multipart/form-data',
    ],
]); ?>

<style>
body {
    background-color: #f5f5f5;
    font-family: 'Arial', sans-serif;
}

.login-container {
    display: flex;
    padding: 40px 40px 40px 40px;
    /* flex-wrap: wrap; */
    /* justify-content: center; */
    /* align-items: center; */
    /* height: 100vh; */
}

.login-left {
    width: 50%;
    padding: 50px;
}

.login-right {
    width: 50%;
    background-color: #e6f3ff;
    /* display: flex; */
    /* justify-content: center; */
    /* align-items: center; */
}

.text-heder {
    color: #2580D3;
    font-size: 24px;
    font-weight: bold;
}

.text-sub-heder {
    color: #666;
    font-size: 16px;
}

.text-welcome {
    font-size: 28px;
    font-weight: bold;
    margin-top: 20px;
    color: #30313D;
}

.text-sub-welcome {
    font-size: 16px;
    color: #666;
    margin-bottom: 30px;
}

.form-label {
    font-size: 14px;
    color: #333;
}

.form-control {
    border-radius: 5px;
    height: 45px;
}

.btn-primary {
    background-color: #2580D3;
    border: none;
    height: 50px;
    font-size: 16px;
    font-weight: bold;
}

.btn-primary:hover {
    background-color: #1c6cb5;
}

.link-privacy {
    font-size: 12px;
    text-align: center;
    margin-top: 20px;
}

.background-blue {
    padding: 20px;
    text-align: center;
}

.background-blue img {
    max-width: 100%;
}

.all-cc {
    text-align: center;
    margin-top: 30px;
}

.checkbox-remember {
    font-size: 14px;
}

.problem {
    font-size: 12px;
    color: #666;
}

.problem- {
    font-size: 12px;
    color: #666;
}

.content-head {
    /* display: flex; */
    text-align: center;

    /* justify-content: center; */
}

.content-center {
    /* display: flex; */
    text-align: center;

    /* justify-content: center; */
}



.footer-image {
    position: absolute;
    /* ใช้ตำแหน่งแบบ absolute */
    bottom: 0;
    /* ติดกับขอบล่าง */
    left: 0;
    /* ชิดซ้าย */
    width: 100%;
    /* กำหนดให้ยืดเต็มความกว้าง */
    /* text-align: center; */
    /* จัดรูปให้อยู่กึ่งกลาง */
}

.footer-image img {
    max-width: 100%;
    /* ปรับให้รูปยืดหยุ่นตามพื้นที่ */
    height: auto;
    /* รักษาสัดส่วนของรูป */
}

.head-image img {
    max-width: 100%;
    /* ปรับให้รูปยืดหยุ่นตามพื้นที่ */
    height: auto;
    /* รักษาสัดส่วนของรูป */
}

.login-container {
    position: relative;
    overflow: hidden;
    /* align-items: center; */
    /* จัดให้อยู่กึ่งกลางแนวตั้ง */
}

.login-body {
    position: relative;
    overflow: hidden;
    align-items: center;
    /* จัดให้อยู่กึ่งกลางแนวตั้ง */
}

.width-rof-new {
    position: relative;
    /* ใช้ position relative เพื่อให้ absolute ของ footer อ้างอิงตำแหน่งจาก container นี้ */
    height: 100%;
    width: 100%;
    /* ให้ container เต็มความสูงของหน้าจอ */
    overflow: hidden;
    /* ซ่อนส่วนเกินที่อาจล้นออกมา */
}
</style>

<div class="login-container">
    <div class="col-6">

        <div class="head-image">
            <img src="<?= Yii::$app->homeUrl ?>image/title-login.svg" class="width-HRVC-new">
        </div>

        <div class="login-body">
            <div class="content-head">
                <div class="text-welcome">Welcome</div>
                <div class="text-sub-welcome">Welcome back! Please enter your details.</div>
            </div>
            <div class="offset-lg-2 col-lg-8">
                <div class="mb-4">
                    <label class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-envelope-o"></i></span>
                        <input type="email" name="LoginForm[username]" class="form-control" required
                            placeholder="email@tokyoconsultingfirmlimited.com">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-unlock-alt"></i></span>
                        <input id="password" type="password" name="LoginForm[password]" class="form-control" required
                            placeholder="password">
                        <span class="input-group-text" onmousedown="javascript:showPassword()"
                            onmouseup="javascript:setPassword()"><i class="fa fa-eye"></i></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-check checkbox-remember">
                            <input class="form-check-input" type="checkbox" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault"> Remember Credentials</label>
                        </div>
                    </div>
                    <div class="col-6 text-end">
                        <span class="problem">Signing Problem?</span> <a class="problem" href="">Contact Support</a>
                    </div>
                </div>
                <div class="d-grid gap-2 mt-3">
                    <button type="submit" class="btn btn-primary">Sign in</button>
                </div>
            </div>
        </div>

        <div class="footer-image">
            <img src="<?= Yii::$app->homeUrl ?>image/foot-login.svg" class="width-HRVC-new">
        </div>

    </div>
    <div class="col-6">
        <img src="<?= Yii::$app->homeUrl ?>image/roof-new.png" alt="Logo" class="width-rof-new">
    </div>
</div>

<?php ActiveForm::end(); ?>