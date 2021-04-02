<?php


class WebUser extends CWebUser {

	public $allowAutoLogin = true;
	public $loginUrl = array('/admin/login');

	private ?Users $_model = null;

	protected function loadModel(): ?Users {
		if (is_null($this->_model))
			$this->_model = Users::model()->findByPk($this->id);
		return $this->_model;
	}
}