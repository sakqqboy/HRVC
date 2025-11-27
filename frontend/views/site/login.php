<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Login';
?>

<style>
    body {
        background-color: #f5f5f5;
    }

    .login-container {
        display: flex;
        padding: 40px 40px 40px 40px;
        /* flex-wrap: wrap; */
        justify-content: center;
        /* align-items: center; */
        height: 100vh;
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
        color: var(--HRVC---Text-Black, #30313D);
        font-size: 18px;
        font-style: normal;
        font-weight: 500;
        line-height: 19.286px;
        /* 107.143% */
    }

    .form-control {
        border-left: none;
        border-radius: 5px;
        height: 45px;
        background-color: var(--bs-tertiary-bg);
        /* Set background to white */
    }

    .form-password {
        border-left: none;
        border-radius: 5px;
        height: 45px;
        background-color: white;
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

    .problem {
        color: var(--HRVC---Light-Text, #94989C);
        leading-trim: both;
        text-edge: cap;
        font-size: 11.633px;
        font-style: normal;
        font-weight: 500;
        line-height: normal;
    }

    .problem-contact {
        color: var(--Primary-Blue---HRVC, #2580D3);
        leading-trim: both;
        text-edge: cap;
        font-size: 11.633px;
        font-style: normal;
        font-weight: 500;
        line-height: normal;
        text-decoration-line: underline;
        text-decoration-style: solid;
        text-decoration-skip-ink: none;
        text-decoration-thickness: auto;
        text-underline-offset: auto;
        text-underline-position: from-font;
    }


    .content-head {
        /* display: flex; */
        text-align: center;
        /* justify-content: center; */
        margin-bottom: 31px;
    }

    .content-center {
        /* display: flex; */
        text-align: center;
        /* justify-content: center; */
    }

    .footer-image {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;

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
        /* margin-top: 100px; */
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
        /* overflow: hidden; */
        /* ซ่อนส่วนเกินที่อาจล้นออกมา */
        /* padding: 0px 100px 0px 100px; */
    }

    .hide-scrollbar {
        overflow: auto;
        /* หรือ overflow: scroll */
        scrollbar-width: none;
        /* Firefox */
    }

    .hide-scrollbar::-webkit-scrollbar {
        display: none;
        /* Chrome, Safari, Edge */
    }

    @media (min-width: 1920px) and (min-height: 945px) {
        .width-rof-new {
            padding-left: 100px;
            padding-right: 100px;
        }
    }



    .input-group-icon {
        display: flex;
        align-items: center;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: var(--bs-body-color);
        text-align: center;
        white-space: nowrap;
        background-color: var(--bs-tertiary-bg);
        border: var(--bs-border-width) solid var(--bs-border-color);
        border-right: none;
        /* Remove the left border */
        border-radius: var(--bs-border-radius);
    }
</style>
<!-- 
<script>
document.addEventListener('DOMContentLoaded', () => {
    const width = window.innerWidth;
    const height = window.innerHeight;
    document.getElementById('screen-size').innerText = `Current screen size: ${width}px x ${height}px`;
});

// อัปเดตขนาดเมื่อมีการปรับหน้าต่าง
window.addEventListener('resize', () => {
    const width = window.innerWidth;
    const height = window.innerHeight;
    document.getElementById('screen-size').innerText = `Current screen size: ${width}px x ${height}px`;
});
</script> -->
<?php $form = ActiveForm::begin([
    'method' => 'post',
    'options' => [
        'enctype' => 'multipart/form-data',
    ],
]); ?>
<div class="row hide-scrollbar" style="--bs-gutter-x:0px;">
    <div class="col-lg-6 col-12" style="padding:20px 10px 20px 30px;">
        <div class="head-image">
            <img src="<?= Yii::$app->homeUrl ?>image/title-login.svg" class="width-HRVC-new">
        </div>
        <div class="login-body">
            <div class="content-head">
                <!-- <div id="screen-size" style="font-size: 16px; color: #333;">แสดงขนาดหน้าจอ</div> -->
                <div class="text-welcome">Welcome</div>
                <div class="text-sub-welcome">Welcome back! Please enter your details.</div>
            </div>
            <div class="offset-lg-2 col-lg-8">
                <div class="mb-4">
                    <label class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-icon">
                            <img src="<?= Yii::$app->homeUrl ?>image/mail-login.svg" class="">
                        </span>
                        <input type="email" name="LoginForm[username]" class="form-control" required
                            placeholder="email@tokyoconsultingfirmlimited.com">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-icon">
                            <img src="<?= Yii::$app->homeUrl ?>image/lock-login.svg" class="">
                        </span>
                        <input id="password" type="password" name="LoginForm[password]" class="form-control" required
                            placeholder="password">
                        <span class="input-group-text" style="border-left: none;"
                            onmousedown="javascript:showPassword()" onmouseup="javascript:setPassword()">
                            <img src="<?= Yii::$app->homeUrl ?>image/eye-login.svg" class="">
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-check checkbox-remember">
                            <input class="form-check-input" type="checkbox" id="flexCheckDefault">
                            <label class="" for="flexCheckDefault"> Remember Credentials</label>
                        </div>
                    </div>
                    <div class="col-6 text-end">
                        <span class="problem">Signing Problem?</span> <a class="problem-contact" href="">Contact
                            Support</a>
                    </div>
                </div>
                <div class="d-grid gap-2 mt-3">
                    <button type="submit" class="btn btn-primary">Sign in</button>
                </div>
            </div>
        </div>

        <div class="footer-image pb-10 pl-30 img-fluid">
            <img src="<?= Yii::$app->homeUrl ?>image/foot-login.svg" class="width-HRVC-new">
        </div>

    </div>
    <div class="col-lg-6 col-12 pb-10" style="height:100vh;padding:20px 10px 20px 30px;">
        <img src="<?= Yii::$app->homeUrl ?>image/roof-new.png" alt="Logo" class="width-rof-new">
    </div>
</div>

<?php ActiveForm::end(); ?>