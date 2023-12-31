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
        'css/home/login.css',
        'css/home/index.css',
        'css/home/header.css',
        'css/home/dashboard.css',
        'css/layout/layout.css',
        'css/layout/font.css',
        'css/home/update.css',
        'css/home/kpi-summary.css',
        'css/home/department.css',
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
        'css/home/master-dashboard.css',
        'css/home/template-dashboard.css',
        'css/home/template-maker.css',
        'css/home/preview.css',
        'css/home/master-setting.css',
        'css/home/registration.css',
        'css/home/group.css',
        'css/home/company-profile.css',
        'css/home/group-add.css',
        'css/home/company-add.css',
        'css/home/company.css',
        'css/home/branch.css',
        'css/home/team.css',
        'css/component/button.css',
        'css/home/title.css',
        'css/home/management-layer.css',
        'css/home/employee.css',
        'css/home/create-employee.css',
        'css/setting/department.css',
        'css/form/checkbox.css',
        'css/home/view.css',
        'css/home/salary-view.css',
        'css/home/evaluation_module.css',
        'css/home/kfi.css',
        'css/home/kfi-grid.css',
        'css/home/kgi-grid.css',
        'css/modal/modal.css',
        'css/modal/modal-kpi.css',
        'css/home/kgiteam-grid.css',
        'css/home/kpi.css',
        'css/adminsetting/setting-kfi.css',
        'css/adminsetting/setting-kgi.css',
        'css/adminsetting/setting-kpi.css',
        'css/admin-financialplanning/gloden.css',
        'css/admin-financialplanning/edit.css',
        'css/admin-financialplanning/performance.css',
        'css/admin-financialplanning/IPL_analysis.css',
        'css/admin-financialplanning/forecast_accounts.css',
        'css/admin-financialplanning/annual_accounts.css',
        'css/admin-financialplanning/comparison_accounts.css',
        'css/home/multi_select.css',
        'css/evaluation/evaluator.css',
        'css/evaluation/weight_allocation.css',
        'css/evaluation/rank_increasement.css',
        'css/evaluation/evaluation.css',
        'css/evaluation/accordion.css',
        'css/evaluation/frame_dashboard.css',
        'css/evaluation/settings.css',
        'css/evaluation/salary_allowance.css',


    ];
    public $js = [
        'js/content.js',
        'js/index.js',
        'js/share.js',
        'js/setting/branch.js',
        'js/setting/department.js',
        'js/setting/team.js',
        'js/setting/employee.js',
        'js/setting/company.js',
        'js/setting/title.js',
        'js/setting/layer.js',
        'js/setting/multi_select.js',
        'js/kfi/kfi.js',
        'js/kgi/kgi.js',
        'js/kgi/kgi_update.js',
        'js/kpi/kpi_update.js',
        'js/filter/kpi.js',
        'js/setting/scripts.js',
        'js/kgi/kgi_group.js',
        'js/setting/doughnut.js',
        'js/setting/accordion.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
        '\rmrevin\yii\fontawesome\AssetBundle'
    ];
}
