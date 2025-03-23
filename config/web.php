<?php
$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$config = [
    'id' => 'web1121',
    'name' => 'WEB',
    'timeZone' => 'Asia/Jakarta',
    'language' => 'id-ID',
    'sourceLanguage' => 'id-ID',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@uploads' => '@app/web/uploads',
    ],
    'modules' => [
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ],
        'admin' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'left-menu',
            'controllerMap' => [
                'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    'userClassName' => 'app\models\User',
                    'idField' => 'id'
                ],
            ],
            'menus' => [
                'assignment' => [
                    'label' => 'Grand Access'
                ],
                //'route' => null, // disable menu route
            ]
        ]
    ],
    'components' => [
        'assetManager' => [
			'class' => 'yii\web\AssetManager',
            'linkAssets'=>(YII_ENV_DEV)?false:true,
            'appendTimestamp'=>true,
			'bundles' => [
		                'yii\web\JqueryAsset' => [
		                    'js' => ['jquery.min.js']
		                ],
		                'yii\bootstrap\BootstrapAsset' => [
		                    'css' => ['css/bootstrap.min.css']
		                ],
		                'yii\bootstrap\BootstrapPluginAsset' => [
		                    'js' => ['js/bootstrap.min.js']
		                ]
			],
		],
        'session' => ['name' => 'web1121'],
        'consoleRunner' => [
            'class' => 'vova07\console\ConsoleRunner',
            'file' => '@app/yii' // or an absolute path to console file
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@app/views'
                ],
            ],
        ],
        'request' => [
            'cookieValidationKey' => 'GcGjOUlo-NgxHrREblCbZTPhqXyQS-ub1',
            'enableCsrfValidation' => true,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'enableAutoLogin' => false,
            'identityClass' => 'app\models\User',
            'loginUrl' => ['website/index'],
        ],
        'authManager' => [
            'class' => 'app\models\Rbac', // or use 'yii\rbac\DbManager'
            'cache' => 'cache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'log' => [
            'traceLevel' => 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => [
                        // 'info',
                        // 'trace',
                        // 'profile',
                        'error',
                        // 'warning'
                    ],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'website' => 'website/index',
            ],
        ],
        'tools' => [
            'class' => 'app\widgets\Tools'
        ],
        'wagateway' => [
            'class' => 'app\widgets\Wagateway'
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'nullDisplay' => '',
            'locale' => 'id_ID',
            'defaultTimeZone' => 'Asia/Jakarta',
            'decimalSeparator' => ',',
            'thousandSeparator' => '.',
            'currencyCode' => 'IDR',
        ],
        'messageformater' => [
            'class' => 'yii\i18n\MessageFormatter',
            'nullDisplay' => '',
            'locale' => 'id_ID',
            'defaultTimeZone' => 'Asia/Jakarta',
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'id-ID',
                    'basePath' => '@app/messages'
                ],
            ],
        ],
        'pdf' => [
            'class' => 'kartik\mpdf\Pdf',
            'format' => [215, 330], //'A4',
            'orientation' => 'P',
            'marginTop' => 1,
            'marginBottom' => 1,
            'marginHeader' => 1,
            'marginFooter' => 1,
            'marginLeft' => 1,
            'marginRight' => 1,
            'destination' => 'I',
        ],
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/*',
            'website/*',
            'admin/*',   
            'debug/*',
            'site/login',
            'site/error',
        ]
    ],
    'as beforeRequest' => [
        'class' => 'yii\filters\AccessControl',
        'rules' => [
            ['actions' => ['login','captcha'],'allow' => true,],
            ['controllers' => ['monitoringserver'],'allow' => true,],
            ['controllers' => ['website'],'allow' => true,],
            ['allow' => true,'roles' => ['@'],],
        ],
    ],
    'params' => $params,
];
if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['127.0.0.1','192.168.1.254', '::1'],
    ];
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'setiam3\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}
return $config;
