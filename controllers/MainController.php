<?php


class MainController extends IController {

	public function accessRules(): array {
		return CMap::mergeArray(array(
			array('allow', 'actions'=>array('error',), 'users'=>array('*')),
			array('allow', 'actions'=>array('index',), 'users'=>array('*')),
		), parent::accessRules());
	}

	public function actionIndex() {
		$content = Html::tag('div', array(
			'id' => 'container',
			'class' => 'grid-container grid-container--fill'
		), '');
		$this->renderText($content);
	}

	public function actionError() {
		var_dump(Yii::app()->errorHandler->error);
	}
}