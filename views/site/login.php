<?php

use yii\helpers\{Html, Url};
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Sign In';
$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-user form-control-feedback'></span>"
];
$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
$base = Url::home(true);
$logologin = file_exists(Yii::getAlias('@uploads/Logins.gif')) ? Html::img(Yii::getAlias('@web/uploads/logologin.png'), ['style' => ['width' => '100%']]) : '';
$logologin2 = file_exists(Yii::getAlias('@uploads/logologin.png')) ? Html::img(Yii::getAlias('@web/uploads/logologin2.png'), ['style' => ['width' => '150px']]) : '';
$this->registerCss("
body {
    background-image: url('$base/wpThemeLilac2.jpg') !important;
    background-size: cover !important; /* Menyesuaikan dengan ukuran layar */
    background-position: center center !important; /* Posisikan di tengah */
    background-repeat: no-repeat !important; /* Hindari pengulangan */
    width: 100vw; /* Sesuaikan dengan lebar layar */
    height: 100vh; /* Sesuaikan dengan tinggi layar */
    margin: 0;
    padding: 0;
    overflow-x: hidden; /* Mencegah scroll horizontal jika ada */
}

.login-logo b{
    color:white;
}
.login-box-body{
    background:rgba(0,0,0,0.5) !important;
    color:white;
}");
$this->registerJs(
    <<<JS
        localStorage.clear();
    JS
);
?>
<style>
    @import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

    * {
        box-sizing: border-box;
    }

    body {
        background: #f6f5f7;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        font-family: 'Montserrat', sans-serif;
        height: 100vh;
        margin: -20px 0 50px;
    }

    h1 {
        font-weight: bold;
        margin: 0;
    }

    h2 {
        text-align: center;
    }

    p {
        font-size: 14px;
        font-weight: 100;
        line-height: 20px;
        letter-spacing: 0.5px;
        margin: 20px 0 30px;
    }

    span {
        font-size: 12px;
    }

    a {
        color: #333;
        font-size: 14px;
        text-decoration: none;
        margin: 15px 0;
    }

    button {
        border-radius: 20px;
        border: 1px solid #FF4B2B;
        background-color: #FF4B2B;
        color: #FFFFFF;
        font-size: 12px;
        font-weight: bold;
        padding: 12px 45px;
        letter-spacing: 1px;
        text-transform: uppercase;
        transition: transform 80ms ease-in;
    }

    button:active {
        transform: scale(0.95);
    }

    button:focus {
        outline: none;
    }

    button.ghost {
        background-color: transparent;
        border-color: #FFFFFF;
    }

    .form {
        background-color: #FFFFFF;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        /* padding: 0 50px; */
        height: 100%;
        text-align: center;
    }

    input {
        background-color: #eee;
        border: none;
        padding: 12px 15px;
        margin: 8px 0;
        width: 100%;
    }

    .container {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25),
            0 10px 10px rgba(0, 0, 0, 0.22);
        position: relative;
        overflow: hidden;
        width: 500px;
        max-width: 100%;
        min-height: 540px;
    }

    .form-container {
        position: absolute;
        top: 0;
        height: 100%;
        transition: all 0.6s ease-in-out;
    }

    .sign-in-container {
        left: 0;
        z-index: 2;
    }

    .container.right-panel-active .sign-in-container {
        transform: translateX(100%);
    }

    .sign-up-container {
        left: 0;
        width: 50%;
        opacity: 0;
        z-index: 1;
    }

    .container.right-panel-active .sign-up-container {
        transform: translateX(100%);
        opacity: 1;
        z-index: 5;
        animation: show 0.6s;
    }

    @keyframes show {

        0%,
        49.99% {
            opacity: 0;
            z-index: 1;
        }

        50%,
        100% {
            opacity: 1;
            z-index: 5;
        }
    }

    .overlay-container {
        position: absolute;
        top: 0;
        left: 50%;
        width: 50%;
        height: 100%;
        overflow: hidden;
        transition: transform 0.6s ease-in-out;
        z-index: 100;
    }

    .container.right-panel-active .overlay-container {
        transform: translateX(-100%);
    }

    .overlay {
        background: #BA55D3;
        background: -webkit-linear-gradient(to right, #DA70D6, #BA55D3);
        background: linear-gradient(to right, #DA70D6, #BA55D3);
        background-repeat: no-repeat;
        background-size: cover;
        background-position: 0 0;
        color: #FFFFFF;
        position: relative;
        left: -100%;
        height: 100%;
        width: 200%;
        transform: translateX(0);
        transition: transform 0.6s ease-in-out;
    }

    .container.right-panel-active .overlay {
        transform: translateX(50%);
    }

    .overlay-panel {
        position: absolute;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 0 40px;
        text-align: center;
        top: 0;
        height: 100%;
        width: 50%;
        transform: translateX(0);
        transition: transform 0.6s ease-in-out;
    }

    .overlay-left {
        transform: translateX(-20%);
    }

    .container.right-panel-active .overlay-left {
        transform: translateX(0);
    }

    .overlay-right {
        right: 0;
        transform: translateX(0);
    }

    .container.right-panel-active .overlay-right {
        transform: translateX(20%);
    }

    .social-container {
        margin: 20px 0;
    }

    .social-container a {
        border: 1px solid #DDDDDD;
        border-radius: 50%;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        margin: 0 5px;
        height: 40px;
        width: 40px;
    }

    footer {
        background-color: #222;
        color: #fff;
        font-size: 14px;
        bottom: 0;
        position: fixed;
        left: 0;
        right: 0;
        text-align: center;
        z-index: 999;
    }

    footer p {
        margin: 10px 0;
    }

    footer i {
        color: red;
    }

    footer a {
        color: #3c97bf;
        text-decoration: none;
    }
</style>
<div style="margin-top: 6%;" class="container" id="container">
    <div class="form-container sign-in-container col-mg-12">
        <!-- <div style="text-align: right;">
            <a href="https://drive.google.com/file/d/1PoVaJPUZopkt19uzcHs4GlEHSg15ExDt/view?usp=sharing" class="icon-block">
                <i class="fa fa-download"></i>
            </a>
        </div> -->
        <div class="form">

            <?= Html::img(Yii::getAlias('@web/img/logoapp.png'), ['style' => ['width' => '40%']]) ?>
            <br>
            <span>Silahkan Masukan Username dan Password</span>
            <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>
            <?= $form
                ->field($model, 'username', $fieldOptions1)
                ->label(false)
                ->textInput(['placeholder' => $model->getAttributeLabel('username'), 'style' => 'background:transparent;color:black']) ?>
            <?= $form
                ->field($model, 'password', $fieldOptions2)
                ->label(false)
                ->passwordInput(['placeholder' => $model->getAttributeLabel('password'), 'style' => 'background:transparent;color:black']) ?>
            <?= $form->field($model, 'captcha')->widget(
                Captcha::class,
                [
                    'template' => '<div class="col-md-6">Verification Code</div>
            <div class="captcha_img col-md-6">{image}</div>'
                        . '<a class="refreshcaptcha" href="#">'
                        . '</a>'
                        . '{input}',
                ]
            )->label(FALSE); ?>
            <div class="row">
                <div class="col-md-12">
                    <?= Html::submitButton('Masuk', ['class' => 'btn btn-success btn-block btn-oval', 'name' => 'login-button']) ?>
                </div>
            </div>
            <p style="font-size: 10px;">
                Belum punya akun?
                <a href="admin/user/usersignup" style="color: blue; text-decoration: none; font-size: 10px;">silahkan daftar disini</a>
            </p>

        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
<footer style="background-color: #3c97bf;">
    <p>Created with <i class="fa fa-heart"></i>
    <p>By Putri Ulya Faradisa</p>
    </p>
</footer>
