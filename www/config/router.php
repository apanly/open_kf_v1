<?php
return [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'enableStrictParsing' => false,
    'rules' => [
        '/<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
        '/<controller:\w+>/<action:\w+>' => '<controller>/<action>',
		'<module:(merchant|cs)>/<controller:\w+>/<action:[a-zA-Z0-9\-_]+>/<id:(\d|\w)+>' => '<module>/<controller>/<action>',
		"/" => "/index/index"
    ],
];