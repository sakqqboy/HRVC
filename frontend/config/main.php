<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend-hrvc',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'designfront' => [
            'class' => 'frontend\modules\design\designfront',
        ],
        'setting' => [
            'class' => 'frontend\modules\setting\setting',
        ],
        'kfi' => [
            'class' => 'frontend\modules\kfi\kfi',
        ],
        'kgi' => [
            'class' => 'frontend\modules\kgi\kgi',
        ],
        'kpi' => [
            'class' => 'frontend\modules\kpi\kpi',
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'enableCsrfValidation' => false,
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'tcg-frontend-hrvc',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [

                'setting/group/group-view/<hash>' => 'setting/group/group-view',
                'setting/group/update-group/<hash>' => 'setting/group/update-group',
                'setting/company/company-view/<hash>' => 'setting/company/company-view',
                'setting/company/create/<hash>' => 'setting/company/create',
                'setting/company/update-company/<hash>' => 'setting/company/update-company',
                'setting/branch/create/<hash>' => 'setting/branch/create',
                'setting/department/create/<hash>' => 'setting/department/create',
                'setting/department/search-result/<hash>' => 'setting/department/search-result',
                'setting/employee/employee-profile/<hash>' => 'setting/employee/employee-profile',
                'setting/employee/update/<hash>' => 'setting/employee/update',
                'setting/employee/export-employee/<hash>' => 'setting/employee/export-employee',
                'setting/employee/index/<hash>' => 'setting/employee/index',
                'setting/team/create/<hash>' => 'setting/team/create',
                'setting/team/team-result/<hash>' => 'setting/team/team-result',
                'setting/layer/result-layer-title/<hash>' => 'setting/layer/result-layer-title',
                'setting/employee/employee-result/<hash>' => 'setting/employee/employee-result',
                'setting/title/search-result/<hash>' => 'setting/title/search-result',
                'setting/title/update-title/<hash>' => 'setting/title/update-title',
                'setting/title/title-detail/<hash>' => 'setting/title/title-detail',
                'kpi/management/kpi-search-result/<hash>' => 'kpi/management/kpi-search-result',
                'kgi/management/kgi-search-result/<hash>' => 'kgi/management/kgi-search-result',
                'kgi/management/kgi-kfi/<hash>' => 'kgi/management/kgi-kfi',
                'kgi/management/kgi-kpi/<hash>' => 'kgi/management/kgi-kpi',
                'kgi/kgi-group/update/<hash>' => 'kgi/kgi-group/update',
                'kgi/management/assign-kpi/<hash>' => 'kgi/management/assign-kpi',
                'kfi/management/kfi-search-result/<hash>' => 'kfi/management/kfi-search-result',
                'kfi/management/kfi-kgi/<hash>' => 'kfi/management/kfi-kgi',
                'kfi/management/assign-kgi/<hash>' => 'kfi/management/assign-kgi',
                'kpi/management/kpi-kgi/<hash>' => 'kpi/management/kpi-kgi',
            ],
        ],
        'assetManager' => [
            'appendTimestamp' => true,
            // 'linkAssets' => true,
            'bundles' => [],
            //            'forceCopy' => TRUE
        ],


    ],
    'params' => $params,
];
