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
    'bootstrap' => [
        'log',
        [
            'class' => 'frontend\components\LanguageSelector',
            'supportedLanguages' => ['en-US', 'jp', 'th', 'cn', 'es', 'vt', 'id'], //กำหนดรายการภาษาที่ support หรือใช้ได้
        ]
    ],
    'language' => 'en-US',
    'sourceLanguage' => 'en-US',
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
        'evaluation' => [
            'class' => 'frontend\modules\evaluation\evaluation',
        ],
        'fs' => [
            'class' => 'frontend\modules\fs\fs',
        ],
        'home' => [
            'class' => 'frontend\modules\home\home',
        ],
        'language' => [
            'class' => 'frontend\modules\language\language',
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
            'class' => 'yii\web\Session',
            'cookieParams' => [
                'lifetime' => 0, // หมายถึงให้หมดอายุเมื่อปิดเบราว์เซอร์
            ],
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
                'setting/group/display-group/<hash>' => 'setting/group/display-group',
                'setting/group/group-view/<hash>' => 'setting/group/group-view',
                'setting/group/update-group/<hash>' => 'setting/group/update-group',
                'setting/company/index-filter/<hash>' => 'setting/company/index-filter',
                'setting/company/company-view/<hash>' => 'setting/company/company-view',
                'setting/company/create/<hash>' => 'setting/company/create',
                'setting/company/update-company/<hash>' => 'setting/company/update-company',
                'setting/company/company-grid/<hash>' => 'setting/company/company-grid',
                'setting/company/company-grid-filter/<hash>' => 'setting/company/company-grid-filter',
                'setting/company/display_company/<hash>' => 'setting/company/display_company',
                'setting/branch/index/<hash>' => 'setting/branch/index',
                'setting/branch/index-filter/<hash>' => 'setting/branch/index-filter',
                'setting/branch/branch-grid/<hash>' => 'setting/branch/branch-grid',
                'setting/branch/branch-grid-filter/<hash>' => 'setting/branch/branch-grid-filter',
                'setting/branch/create/<hash>' => 'setting/branch/create',
                'setting/branch/update-branch/<hash>' => 'setting/branch/update-branch',
                'setting/branch/no-branch/<hash>' => 'setting/branch/no-branch',
                'setting/branch/branch-view/<hash>' => 'setting/branch/branch-view',
                'setting/branch/branch-view-filter/<hash>' => 'setting/branch/branch-view-filter',
                'setting/department/no-department/<hash>' => 'setting/department/no-department',
                'setting/department/index-filter/<hash>' => 'setting/department/index-filter',
                'setting/department/departments-view/<hash>' => 'setting/department/departments-view',
                'setting/department/create/<hash>' => 'setting/department/create',
                'setting/department/modal-department/<hash>' => 'setting/department/modal-department',
                'setting/department/search-result/<hash>' => 'setting/department/search-result',
                'setting/employee/employee-profile/<hash>' => 'setting/employee/employee-profile',
                'setting/employee/update/<hash>' => 'setting/employee/update',
                'setting/employee/export-employee/<hash>' => 'setting/employee/export-employee',
                'setting/employee/index/<hash>' => 'setting/employee/index',
                'setting/team/index-filter/<hash>' => 'setting/team/index-filter',
                'setting/team/no-team/<hash>' => 'setting/team/no-team',
                'setting/team/create/<hash>' => 'setting/team/create',
                'setting/team/team-result/<hash>' => 'setting/team/team-result',
                'setting/team/modal-team/<hash>' => 'setting/team/modal-team',
                'setting/layer/result-layer-title/<hash>' => 'setting/layer/result-layer-title',
                'setting/employee/employee-result/<hash>' => 'setting/employee/employee-result',
                'setting/title/search-result/<hash>' => 'setting/title/search-result',
                'setting/title/update-title/<hash>' => 'setting/title/update-title',
                'setting/title/title-detail/<hash>' => 'setting/title/title-detail',
                'kpi/management/kpi-search-result/<hash>' => 'kpi/management/kpi-search-result',
                'kgi/management/kgi-search-result/<hash>' => 'kgi/management/kgi-search-result',
                'kgi/management/kgi-kfi/<hash>' => 'kgi/management/kgi-kfi',
                'kgi/management/kgi-kpi/<hash>' => 'kgi/management/kgi-kpi',
                'kgi/management/prepare-update/<hash>' => 'kgi/management/prepare-update',
                'kgi/management/approve-kgi-team/<hash>' => 'kgi/management/approve-kgi-team',
                'kgi/management/approve-kgi-employee/<hash>' => 'kgi/management/approve-kgi-employee',
                'kgi/assign/assign/<hash>' => 'kgi/assign/assign',
                'kgi/kgi-group/update/<hash>' => 'kgi/kgi-group/update',
                'kgi/kgi-team/kgi-team-setting/<hash>' => 'kgi/kgi-team/kgi-team-setting',
                'kgi/kgi-personal/indivisual-setting/<hash>' => 'kgi/kgi-personal/indivisual-setting',
                'kgi/kgi-personal/update-personal-kgi/<hash>' => 'kgi/kgi-personal/update-personal-kgi',
                'kgi/kgi-personal/view-personal-kgi/<hash>' => 'kgi/kgi-personal/view-personal-kgi',
                'kgi/kgi-personal/kgi-personal-search-result/<hash>' => 'kgi/kgi-personal/kgi-personal-search-result',
                'kgi/kgi-personal/kgi-employee-history/<hash>' => 'kgi/kgi-personal/kgi-employee-history',
                // 'kgi/kgi-personal/update-personal-kgi/<hash>' => 'kgi/kgi-personal/update-personal-kgi',
                'kgi/management/assign-kpi/<hash>' => 'kgi/management/assign-kpi',
                'kgi/management/kgi-detail/<hash>' => 'kgi/management/kgi-detail',
                'kgi/kgi-team/kgi-team-search-result/<hash>' => 'kgi/kgi-team/kgi-team-search-result',
                'kgi/kgi-team/kgi-team-history/<hash>' => 'kgi/kgi-team/kgi-team-history',
                'kgi/kgi-team/prepare-update/<hash>' => 'kgi/kgi-team/prepare-update/',
                'kgi/view/index/<hash>' => 'kgi/view/index',
                'kgi/view/kgi-team-history/<hash>' => 'kgi/view/kgi-team-history',
                'kgi/view/kgi-individual-history/<hash>' => 'kgi/view/kgi-individual-history',
                'kgi/view/kgi-history/<hash>' => 'kgi/view/kgi-history',
                'kgi/chart/company-chart/<hash>' => 'kgi/chart/company-chart',
                'kpi/chart/company-chart/<hash>' => 'kpi/chart/company-chart',
                'kfi/chart/company-chart/<hash>' => 'kfi/chart/company-chart',
                'kfi/management/kfi-search-result/<hash>' => 'kfi/management/kfi-search-result',
                'kfi/management/kfi-kgi/<hash>' => 'kfi/management/kfi-kgi',
                'kfi/management/assign-kgi/<hash>' => 'kfi/management/assign-kgi',
                'kfi/management/kfi-detail/<hash>' => 'kfi/management/kfi-detail',
                'kfi/management/update-kfi/<hash>' => 'kfi/management/update-kfi',
                'kfi/assign/assign/<hash>' => 'kfi/assign/assign',
                'kfi/view/index/<hash>' => 'kfi/view/index',
                'kfi/view/kfi-history/<hash>' => 'kfi/view/kfi-history',
                'kpi/management/kpi-kgi/<hash>' => 'kpi/management/kpi-kgi',
                'kpi/kpi-personal/indivisual-setting/<hash>' => 'kpi/kpi-personal/indivisual-setting',
                'kpi/kpi-personal/update-personal-kpi/<hash>' => 'kpi/kpi-personal/update-personal-kpi',
                'kpi/kpi-team/kpi-team-setting/<hash>' => 'kpi/kpi-team/kpi-team-setting',
                'kpi/kpi-personal/view-personal-kpi/<hash>' => 'kpi/kpi-personal/view-personal-kpi',
                'kpi/kpi-personal/kpi-individual-history/<hash>' => 'kpi/kpi-personal/kpi-individual-history',
                'kpi/management/approve-kpi-employee/<hash>' => 'kpi/management/approve-kpi-employee',
                'kpi/management/kpi-detail/<hash>' => 'kpi/management/kpi-detail',
                'kpi/management/prepare-update/<hash>' => 'kpi/management/prepare-update',
                'kpi/assign/assign/<hash>' => 'kpi/assign/assign',
                'kpi/kpi-team/kpi-team-search-result/<hash>' => 'kpi/kpi-team/kpi-team-search-result',
                'kpi/kpi-team/kpi-team-history/<hash>' => 'kpi/kpi-team/kpi-team-history',
                'kpi/kpi-team/prepare-update/<hash>' => 'kpi/kpi-team/prepare-update/',
                'kpi/kpi-personal/kpi-personal-search-result/<hash>' => 'kpi/kpi-personal/kpi-personal-search-result',
                'kpi/view/index/<hash>' => 'kpi/view/index',
                'kpi/view/kpi-team-history/<hash>' => 'kpi/view/kpi-team-history',
                'kpi/view/kpi-individual-history/<hash>' => 'kpi/view/kpi-individual-history',
                'kpi/view/kpi-history/<hash>' => 'kpi/view/kpi-history',
                'evaluation/environment/frame-setting/<hash>' => 'evaluation/environment/frame-setting',
                'evaluation/environment/term-detail/<hash>' => 'evaluation/environment/term-detail',
                'evaluation/environment/evaluator-setting/<hash>' => 'evaluation/environment/evaluator-setting',
                'evaluation/environment/weight-allocate/<hash>' => 'evaluation/environment/weight-allocate',
                'evaluation/environment/weight-allocate-setting/<hash>' => 'evaluation/environment/weight-allocate-setting',
                'evaluation/environment/kfi-weight-allocate/<hash>' => 'evaluation/environment/kfi-weight-allocate',
                'evaluation/environment/kgi-weight-allocate/<hash>' => 'evaluation/environment/kgi-weight-allocate',
                'evaluation/environment/kpi-weight-allocate/<hash>' => 'evaluation/environment/kpi-weight-allocate',
                'evaluation/eva/evaluate/<hash>' => 'evaluation/eva/evaluate',
                'evaluation/salary/register/<hash>' => 'evaluation/salary/register',
                'evaluation/salary/filter-salary-result/<hash>' => 'evaluation/salary/filter-salary-result',
                'evaluation/salary/filter-salary-register-result/<hash>' => 'evaluation/salary/filter-salary-register-result',
                'evaluation/salary/update-company-salary/<hash>' => 'evaluation/salary/update-company-salary',
                'evaluation/rank/index/<hash>' => 'evaluation/rank/index',
                'evaluation/bonus/index/<hash>' => 'evaluation/bonus/index',
                '<lang:(en|th|jp|cn|es|vt)>/<controller>/<action>' => '<controller>/<action>'
            ],
        ],
        'assetManager' => [
            'appendTimestamp' => true,
            // 'linkAssets' => true,
            'bundles' => [],
            //            'forceCopy' => TRUE
        ],
        'languageSwitcher' => [
            'class' => 'frontend\components\LanguageSelector',
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@frontend/messages',
                    //                    'sourceLanguage' => 'th-TH',
                ],
                'app' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    // 'sourceLanguage' => 'jp-JP',
                    'basePath' => '@frontend/messages',
                    'fileMap' => [
                        'app' => 'app.php',
                        //'app/error' => 'error.php',
                    ],
                ],

            ],

            'on missingTranslation' => ['frontend\components\TranslationEventHandler', 'handleMissingTranslation']
        ],
    ],
    'params' => $params,
];