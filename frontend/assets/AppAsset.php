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
        'css/home/profile.css',
        'css/home/kgimanagement.css',
        'css/home/kpimanagement.css',
        'css/home/headernavbar.css',
        'css/home/create.css',
        'css/home/dashboard-edit.css',
        'css/home/dashboard-delete.css',

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
