<?php
return [
	'components' => [
		'db_kf'       => [
			'class'    => 'yii\db\Connection',
			'dsn'      => 'mysql:host=localhost;dbname=saas_stkf_v1',
			'username' => 'root',
			'password' => '',
			'charset'  => 'utf8mb4',
		]
	],
];
