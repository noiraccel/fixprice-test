<?php
require __DIR__ . '/../vendor/autoload.php';
$db = require __DIR__ . '/db.php';

use app\repositories\VacancyRepository;
use app\services\VacancyService;


$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'fix-price-test',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'db' => $db,
        'user' => [
            'enableSession' => false,
            'identityClass' => null,
            'loginUrl' => null,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    'logFile' => '@runtime/logs/app.log',
                    'logVars' => ['_GET', '_POST', '_SERVER', '_FILES'],
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'vacancies'],
            ],
        ],
    ],
];

Yii::$container->set(VacancyRepository::class, VacancyRepository::class);

Yii::$container->set(VacancyService::class, [
    'class' => VacancyService::class,
    'repository' => Yii::$container->get(VacancyRepository::class),
]);


if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
