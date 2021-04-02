<?php

/**
 * This is the model class for table "class_room".
 *
 * The followings are the available columns in table 'class_room':
 * @property string $da
 * @property string $class
 * @property string $time
 * @property string $form
 * @property string $pass
 *
 * The followings are the available relations in table 'class_room':
 * @property ClassRoom $classRoom
 */

class Schedule extends CActiveRecord {

	public function tableName(): string {
		return 'schedule';
	}

	public function rules(): array {
		return array(
			array('da, class, form, pass', 'required'),
			array('da, class, time', 'length', 'max'=>20),
			array('da, class, time, form, pass', 'safe', 'on'=>'search'),
		);
	}

	public function relations(): array {
		return array(
			'classRoom' => array(self::BELONGS_TO, ClassRoom::class, 'da')
		);
	}

	public function attributeLabels(): array {
		return array(
			'da' => 'Da',
			'class' => 'Class',
			'time' => 'Time',
			'form' => 'Form',
			'pass' => 'Password',
		);
	}

	public function search(): CActiveDataProvider {
		$criteria=new CDbCriteria;
		$criteria->compare('da',$this->da,true);
		$criteria->compare('class',$this->class,true);
		$criteria->compare('time',$this->time,true);
		$criteria->compare('form',$this->form,true);
		$criteria->compare('pass',$this->pass,true);
		return new CActiveDataProvider($this, array('criteria'=>$criteria));
	}

	public static function model($className=__CLASS__): Schedule {
		return parent::model($className);
	}
}
