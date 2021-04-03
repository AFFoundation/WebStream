<?php


class ApiController extends IController {

	private array $_data = array();
	public bool $isRestController = true;

	public function actionIndex() {
		$this->redirect(Yii::app()->baseUrl);
	}

	public function actionClass() {
		foreach (ClassRoom::model()->findAll() as $room)
			$this->_data[] =CMap::mergeArray($room->attributes, array('schedule' => $room->schedules));
		$this->responseSuccess($this->_data);
	}

	public function actionStream(string $route, string $id) {
		if ($route === 'pub') Stream::model()->newStream($id);
		if ($route === 'del') Stream::model()->deleteByIdentity($id);
		foreach (Stream::model()->findAllByIdentity($id) as $stream)
			$this->_data[] = CMap::mergeArray($stream->attributes, array('url' => $stream->url));
		$this->responseSuccess($this->_data);
	}

	protected function responseSuccess($data, int $status = 200, string $message = null) {
		$response = (object) array('success' => true);
		$response->data = $data instanceof CModel ? $data->attributes : $data;
		$response->state = $this->status($status, $message);
		$this->_sendResponse(200, CJSON::encode($response));
	}

	protected function responseFailed(string $message, int $status = 1000) {
		$response = (object) array('success' => false, 'data' => null);
		$response->state = $this->status($status, $message);
		$this->_sendResponse(($status < 1000) ? $status : 200, CJSON::encode($response));
	}

	protected function status(int $code, string $message = null): object {
		$status = array('code' => $code, 'message' => $message);
		return (object) $status;
	}

	protected function beforeAction($action): bool {
		reset($this->_data);
		return parent::beforeAction($action);
	}
}