<?php


class AdminController extends IController {

	public function accessRules(): array {
		return CMap::mergeArray(array(
			array('allow', 'actions'=>array('login',), 'users'=>array('*')),
			array('allow', 'actions'=>array('index',), 'users'=>array('@')),
		), parent::accessRules());
	}

	public function actionIndex() {}

	public function actionLogin() {}
}