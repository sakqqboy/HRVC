<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/home/index.css',
        'css/home/header.css',
        'css/home/dashboard.css',
        'css/layout/layout.css',
        'css/home/update.css',
        'css/home/kpi-summary.css',
        'css/home/kgi-summary.css',
        'css/home/calendar.css',
        'css/home/update-kpi.css',
        'css/home/evaluation.css',
    ];
    public $js = [
        'js/content.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
        '\rmrevin\yii\fontawesome\AssetBundle'
    ];
}
