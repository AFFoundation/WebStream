<?php
/**
 * @var $this IController
 * @var $content
 */

$this->beginContent('//layouts/index');
echo Html::openTag('body'),
	Html::openTag('header', array('class' => 'mui-appbar mui--z1')),
	Html::openTag('div', array('class' => 'mui-container-fluid')),
	Html::tag('div', array('class' => 'mui--text-title'), Html::tag('h2', content: 'AF Stream Services')),
	Html::closeTag('div'), Html::closeTag('header'),
	Html::tag('div', array('class' => 'mui--appbar-height'), ''),
	$content,
	Html::closeTag('body');
$this->endContent();
$this->registerClientJs('scripts');
