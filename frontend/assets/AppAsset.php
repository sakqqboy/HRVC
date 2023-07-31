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
        'css/home/respiratory1.css',
        'css/home/evaluation.css',
        'css/home/dashboard-kpi2.css',
        'css/home/kgimanagement.css',
        'css/home/kpimanagement.css',
        'css/home/headernavbar.css',
        'css/home/create1.css',
        'css/home/dashboard-edit.css',
        'css/home/dashboard-delete.css',
        'css/home/analysis.css',
        'css/home/registration.css',

    ];
    public $js = [
        'js/content.js',
        'js/index.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
        '\rmrevin\yii\fontawesome\AssetBundle'
    ];
}
