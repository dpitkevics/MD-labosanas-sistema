<?php

/**
 * This is the model class for table "received_homework_grades".
 *
 * The followings are the available columns in table 'received_homework_grades':
 * @property integer $id
 * @property integer $received_homework_id
 * @property integer $grade
 * @property integer $timestamp
 *
 * The followings are the available model relations:
 * @property ReceivedHomeworks $receivedHomework
 */
class ReceivedHomeworkGrade extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ReceivedHomeworkGrade the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'received_homework_grades';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('received_homework_id, grade, timestamp', 'required'),
			array('received_homework_id, grade, timestamp', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, received_homework_id, grade, timestamp', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'receivedHomework' => array(self::BELONGS_TO, 'ReceivedHomeworks', 'received_homework_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'received_homework_id' => 'Received Homework',
			'grade' => 'Grade',
			'timestamp' => 'Timestamp',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('received_homework_id',$this->received_homework_id);
		$criteria->compare('grade',$this->grade);
		$criteria->compare('timestamp',$this->timestamp);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}