<?php


class IController extends CController {

	const JSON_TYPE = "application/json";

	public bool $isRestController = false;
	public CClientScript $cs;

	public function init() {
		$this->cs = Yii::app()->clientScript;
		parent::init();
	}

	public function filters(): array {
		if ($this->isRestController) return parent::filters();
		return array('accessControl', 'postOnly + delete');
	}

	public function accessRules(): array {
		if ($this->isRestController) return parent::accessRules();
		return array('deny', 'users'=>array('*'));
	}

	public function loadScript(string $script): string {
		$basePath = Yii::getPathOfAlias('webroot');
		$scriptPath = $this->mainAssets('js') . DIRECTORY_SEPARATOR . $script . '.js';
		return file_get_contents($basePath . $scriptPath);
	}

	public function registerClientCss(string $filename, bool $hasMin = false) {
		$filename = $filename . ((!YII_DEBUG and $hasMin) ? '.min' : '') . '.css';
		$this->cs->registerCssFile($this->mainAssets('css') . DIRECTORY_SEPARATOR . $filename);
	}

	public function registerClientJs(string $filename, bool $hasMin = false, int $position = CClientScript::POS_END) {
		$filename = $filename . ((!YII_DEBUG and $hasMin) ? '.min' : '') . '.js';
		$this->cs->registerScriptFile($this->mainAssets('js') . DIRECTORY_SEPARATOR . $filename, $position);
	}

	public function _sendResponse($status = 200, $response = null) {
		header('HTTP/1.1 ' . $status . ' ' . $this->statusCodeMessage($status));
		header('Content-type: ' . self::JSON_TYPE);
		header('Access-Control-Allow-Origin: *');
		if (is_null($response)) {
			if ($status === 401) $message = 'You must be authorized to view this page.';
			elseif ($status === 404) $message = 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found.';
			elseif ($status === 500) $message = 'The server encountered an error processing your request.';
			elseif ($status === 501) $message = 'The requested method is not implemented.';
			else $message = $this->statusCodeMessage(306);
			$state = array('success' => false, 'message' => $message);
			print CJSON::encode(array('state' => $state, 'data' => $response));
		} else print $response;
		Yii::app()->end();
	}

	protected function statusCodeMessage(int $status): string {
		$codes = Array(
			100 => 'Continue',
			101 => 'Switching Protocols',
			200 => 'OK',
			201 => 'Created',
			202 => 'Accepted',
			203 => 'Non-Authoritative Information',
			204 => 'No Content',
			205 => 'Reset Content',
			206 => 'Partial Content',
			300 => 'Multiple Choices',
			301 => 'Moved Permanently',
			302 => 'Found',
			303 => 'See Other',
			304 => 'Not Modified',
			305 => 'Use Proxy',
			306 => '(Unused)',
			307 => 'Temporary Redirect',
			400 => 'Bad Request',
			401 => 'Unauthorized',
			402 => 'Payment Required',
			403 => 'Forbidden',
			404 => 'Not Found',
			405 => 'Method Not Allowed',
			406 => 'Not Acceptable',
			407 => 'Proxy Authentication Required',
			408 => 'Request Timeout',
			409 => 'Conflict',
			410 => 'Gone',
			411 => 'Length Required',
			412 => 'Precondition Failed',
			413 => 'Request Entity Too Large',
			414 => 'Request-URI Too Long',
			415 => 'Unsupported Media Type',
			416 => 'Requested Range Not Satisfiable',
			417 => 'Expectation Failed',
			500 => 'Internal Server Error',
			501 => 'Not Implemented',
			502 => 'Bad Gateway',
			503 => 'Service Unavailable',
			504 => 'Gateway Timeout',
			505 => 'HTTP Version Not Supported'
		);
		return isset($codes[$status]) ? $codes[$status] : '';
	}

	protected function mainAssets(string $dirName) {
		$path = Yii::app()->basePath . '/static/' . $dirName;
		return Yii::app()->assetManager->publish($path, true, -1, YII_DEBUG);
	}
}