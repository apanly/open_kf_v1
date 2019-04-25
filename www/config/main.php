<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-www',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    "timezone"  =>  "Asia/Shanghai",
    'controllerNamespace' => 'www\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
		"urlManager" => require (__DIR__ . '/router.php'),
		'errorHandler' => [
			'errorAction' => 'error/error',
		]
    ],
	'modules' => [
		'cs' => [
			'class' => 'www\modules\customservice\CustomServiceModule',
		],
        'merchant' => [
            'class' => 'www\modules\merchant\MerchantModule',
        ],
        'wechat' => [
            'class' => 'www\modules\wechat\WechatModule',
        ]
	],
    'params' => $params,
];
