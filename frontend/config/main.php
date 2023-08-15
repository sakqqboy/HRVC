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
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
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
            ],
        ],
        'assetManager' => [
            'appendTimestamp' => true,
            'bundles' => [],
            //            'forceCopy' => TRUE
        ],

    ],
    'params' => $params,
];
