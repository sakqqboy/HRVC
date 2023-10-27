<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">


<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <link rel="shortcut icon" href="<?= Yii::$app->request->baseUrl; ?>/image/logo-hrvc.png?v=1" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

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

    <main role="main" class="flex-shrink-0 pr-12">
        <div class="row">
            <div class="col-lg-2">
                <?= $this->render("@frontend/views/site/header")
                ?>
            </div>
            <div class="col-lg-10">
                <?= $this->render("@frontend/views/layouts/headernavbar")
                ?>
                <div class="col-12">
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
