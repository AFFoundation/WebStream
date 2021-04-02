<?php

/**
 * This is the model class for table "class_room".
 *
 * The followings are the available columns in table 'class_room':
 * @property string $da
 * @property string $initial
 * @property string $name
 *
 * The followings are the available relations in table 'class_room':
 * @property Schedule[] $schedules
 */

class ClassRoom extends CActiveRecord {

	public function tableName(): string {
		return 'class_room';
	}

	public function rules(): array {
		return array(
			array('da, initial, name, form', 'required'),
			array('da', 'length', 'max'=>20),
			array('da, initial, name', 'safe', 'on'=>'search'),
		);
	}

	public function relations(): array {
		return array(
			'schedules' => array(self::HAS_MANY, Schedule::class, 'class')
		);
	}

	public function attributeLabels(): array {
		return array(
			'da' => 'Da',
			'initial' => 'Initial',
			'name' => 'Name'
		);
	}

	public function search(): CActiveDataProvider {
		$criteria=new CDbCriteria;
		$criteria->compare('da',$this->da,true);
		$criteria->compare('initial',$this->initial,true);
		$criteria->compare('name',$this->name,true);
		return new CActiveDataProvider($this, array('criteria'=>$criteria));
	}

	public static function model($className=__CLASS__): ClassRoom {
		return parent::model($className);
	}
}
