<?php

/**
 * This is the model class for table "stream".
 *
 * The followings are the available columns in table 'stream':
 * @property string $da
 * @property string $name
 *
 * The followings are the available virtual columns in model 'stream':
 * @property string $url
 */

class Stream extends CActiveRecord {

	public ?string $url = null;

	public function tableName(): string {
		return 'stream';
	}

	public function rules(): array {
		return array(
			array('da, name', 'required'),
			array('da', 'length', 'max'=>20),
			array('da, name, url', 'safe', 'on'=>'search'),
		);
	}

	public function attributeLabels(): array {
		return array(
			'da' => 'Da',
			'name' => 'Name',
		);
	}

	public function search(): CActiveDataProvider {
		$criteria=new CDbCriteria;
		$criteria->compare('da',$this->da,true);
		$criteria->compare('name',$this->name,true);
		return new CActiveDataProvider($this, array('criteria'=>$criteria));
	}

	public function newStream(string $name): bool {
		$model = new Stream();
		$model->name = $name;
		return $model->save();
	}

	public function deleteByIdentity(string $identity): int {
		$criteria = new CDbCriteria();
		$criteria->addSearchCondition('name', $identity);
		return $this->deleteAll($criteria);
	}

	protected function beforeValidate(): bool {
		if (!$this->da) $this->da = round(microtime(true) * 1000);
		return parent::beforeValidate();
	}

	protected function afterFind() {
		parent::afterFind();
		$this->url = '/live?port=1935&app=stream&stream='.$this->name;
	}

	public static function model($className=__CLASS__): Stream {
		return parent::model($className);
	}
}
