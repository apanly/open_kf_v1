<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    "timezone"  =>  "Asia/Shanghai",
    'controllerNamespace' => 'console\controllers',
	'modules' => [
		"queue"  =>  [
			"class" =>  'console\modules\queue\QueueModule',
		],
        "merchant"  =>  [
            "class" =>  'console\modules\merchant\MerchantModule',
        ]
	],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        "urlManager" => require (__DIR__ . '/router.php'),
        'errorHandler' => [
            'class' => 'console\controllers\ErrorController'
        ],
    ],
    'params' => $params,
];
