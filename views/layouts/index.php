<?php
/**
 * @var $this IController
 * @var $content
 */

echo '<!DOCTYPE html>',
	Html::openTag('html'),
	Html::openTag('head'),
	Html::tag('meta', array('charset' => 'UTF-8')),
	Html::metaTag('IE=edge', httpEquiv: 'X-UA-Compatible'),
	Html::metaTag('width=device-width, initial-scale=1', 'viewport'),
	Html::tag('title', content: 'Welcome To AF Foundation Stream Services'),
	Html::closeTag('head'), $content, Html::closeTag('html');
$this->cs->registerCssFile('//cdnjs.cloudflare.com/ajax/libs/muicss/0.10.3/css/mui.min.css');
$this->cs->registerScriptFile('//cdnjs.cloudflare.com/ajax/libs/muicss/0.10.3/js/mui.min.js');
$this->cs->registerCssFile('//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
$this->registerClientCss('styles');
$this->cs->registerCoreScript('jquery');
