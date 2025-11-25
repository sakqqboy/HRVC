<?php

/** @var \yii\web\View $this */
/** @var string $content */


use frontend\assets\AppAsset;
use yii\bootstrap5\Html;
use yii\bootstrap5\NavBar;
use yii\helpers\Html as HelpersHtml;
use yii\web\View;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">


<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <!-- <link rel="shortcut icon" href="<?= Yii::$app->request->baseUrl; ?>/image/logo-hrvc.png?v=1" type="image/x-icon" /> -->
    <link rel="shortcut icon" href="<?= Yii::$app->request->baseUrl; ?>/image/Favicon.svg?v=1" type="image/x-icon" />

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <?= HelpersHtml::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?php
    $js = <<<JS
$(document).ajaxSend(function(event, jqxhr, settings) {
    if (!settings.data) {
        settings.data = '';
    }
    var csrfParam = $('meta[name="csrf-param"]').attr('content');
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    if (settings.type === 'POST' && csrfParam && csrfToken) {
        if (typeof settings.data === 'string') {
            settings.data += '&' + encodeURIComponent(csrfParam) + '=' + encodeURIComponent(csrfToken);
        } else if (typeof settings.data === 'object') {
            settings.data[csrfParam] = csrfToken;
        }
    }
});
JS;
    $this->registerJs($js, \yii\web\View::POS_END);
    ?>

</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>
    <div class="col-4 alert-box2 text-center mt-20">
        <?= Yii::t('app', 'Saved') ?>
    </div>
    <!-- <header>

        <?php
        NavBar::begin([
            'brandLabel' => Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar navbar-expand-md navbar-dark bg-white fixed-top',
            ],

        ]);
        NavBar::end();
        ?>

    </header> -->

    <main role="main">
        <div class="d-flex align-items-start justify-content-start">
            <div class="menu-left-side">
                <?= $this->render("@frontend/views/site/menu_left")
                ?>
            </div>
            <div class="main-content d-flex flex-grow-1">
                <div class="header-top bg-white">
                    <?= $this->render("@frontend/views/layouts/headernavbar")
                    ?>
                </div>
                <div class="submain-content">
                    <?= $content ?>
                </div>
            </div>
        </div>
    </main>
    <?php
    if (class_exists('yii\debug\Module')) {
        $this->off(\yii\web\View::EVENT_END_BODY, [\yii\debug\Module::getInstance(), 'renderToolbar']);
    }
    $this->endBody() ?>
</body>

</html>
<?php $this->endPage();
