<?php
return array(
	'basePath' => dirname(__FILE__),
	'name'=>'AF Web Application',
	'preload' => array('log'),
	'defaultController' => 'main',
	'import'=>array(
		'application.components.*',
		'application.models.*'
	),
	'components'=>array(
		'user'=>array('class' => 'WebUser'),
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName' => false,
			'caseSensitive' => false,
			'rules' => array(
				'gii/<controller:\w+>/<action:\w+>' => 'gii/<controller>/<action>',
				array('api/<action>', 'pattern' => 'api/<action>/<route:\w+>', 'verb' => 'GET,POST'),
				array('api/<action>', 'pattern' => 'api/<action>/<route:\w+>/<id:\w+>', 'verb' => 'GET,POST'),
				'<controller:\w+>/<action:\w+>/<id:\w+>'=>'<controller>/<action>'
			)
		),
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=af_stream',
			'enableProfiling'=>true,
			'emulatePrepare' => true,
			'enableParamLogging'=>true,
			'username' => 'developer',
			'password' => 'developer',
			'charset' => 'utf8'
		),
		'errorHandler' => array('errorAction' => YII_DEBUG ? null : 'main/error'),
		'log'=>array('class' => 'CLogRouter', 'routes' => array(
			array('class' => 'CFileLogRoute', 'levels' => 'error, warning')
		))
	)
);
