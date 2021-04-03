<?php
/**
 * @var $this IController
 * @var $content
 */

$this->beginContent('//layouts/index');
echo Html::openTag('body'),
	Html::openTag('header', array('class' => 'mui-appbar mui--z1')),
	Html::openTag('div', array('class' => 'mui-container-fluid')),
	Html::openTag('div', array('class' => 'mui-row')),
	Html::openTag('div', array('class' => 'mui-col-md-8 mui--text-title')),
	Html::tag('h2', content: 'AF Stream Services'),
	Html::closeTag('div'),
	Html::openTag('div', array('class' => 'mui-col-md-4 mui--text-right')),
	Html::openTag('ul', array('class' => 'mui-list--inline')),
	Html::openTag('li'),
	Html::openTag('div', array('class' => 'mui-select')),
	Html::tag('select', array('id' => 'select-class'), ''),
	Html::closeTag('div'), Html::closeTag('li'),
	Html::openTag('li'),
	Html::link(Html::faIcon('cog', '2x'), htmlOptions: array('id' => 'setting')),
	Html::closeTag('li'),
	Html::closeTag('ul'), Html::closeTag('div'), Html::closeTag('div'),
	Html::closeTag('div'), Html::closeTag('header'),
	Html::tag('div', array('class' => 'mui--appbar-height'), ''),
	$content,
	Html::closeTag('body');
$this->endContent();
$this->registerClientJs('scripts');
