<?php
error_reporting(E_ALL | E_STRICT);
date_default_timezone_set("Asia/Jakarta");
$isInDev = in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'));
defined('YII_DEBUG') or define('YII_DEBUG', isset($_GET['debug']) or $isInDev);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);
require_once dirname(__FILE__) . '/../Yii1.1.23/yii.php';
$application = Yii::createWebApplication(dirname(__FILE__).'/config.php');
$gii = array('class' => 'system.gii.GiiModule', 'password' => 'Arafat12');
$application->params = array('devEmail'=>'arafat.jr@icloud.com');
if (YII_DEBUG) $application->modules = array('gii' => $gii);
$application->controllerPath = 'controllers';
$application->runtimePath = 'runtime';
$application->viewPath = 'views';
$application->run();
