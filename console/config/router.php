<?php
return [
	'enablePrettyUrl'  => true,
	'showScriptName'  => false,
	'enableStrictParsing' => false,
    'baseUrl' => '',
	'rules'  => [
		'/<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
		'/<controller:\w+>/<action:\w+>'  => '<controller>/<action>',
	],
];