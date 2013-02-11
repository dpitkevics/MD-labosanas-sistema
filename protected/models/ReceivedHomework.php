<?php

/**
 * This is the model class for table "received_homeworks".
 *
 * The followings are the available columns in table 'received_homeworks':
 * @property integer $id
 * @property integer $homestaskID
 * @property string $studentIDNumber
 * @property string $sourcePath
 * @property integer $timestamp
 *
 * The followings are the available model relations:
 * @property ReceivedHomework $studentIDNumber0
 * @property ReceivedHomework[] $receivedHomeworks
 * @property Hometasks $homestask
 */
class ReceivedHomework extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ReceivedHomework the static model class
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
		return 'received_homeworks';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('homestaskID, studentIDNumber, sourcePath, timestamp', 'required'),
			array('homestaskID, timestamp', 'numerical', 'integerOnly'=>true),
			array('studentIDNumber', 'length', 'max'=>10),
			array('sourcePath', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, homestaskID, studentIDNumber, sourcePath, timestamp', 'safe', 'on'=>'search'),
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
			'studentIDNumber0' => array(self::BELONGS_TO, 'ReceivedHomework', 'studentIDNumber'),
			'receivedHomeworks' => array(self::HAS_MANY, 'ReceivedHomework', 'studentIDNumber'),
			'homestask' => array(self::BELONGS_TO, 'Hometasks', 'homestaskID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'homestaskID' => 'Homestask',
			'studentIDNumber' => 'Student Idnumber',
			'sourcePath' => 'Source Path',
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
		$criteria->compare('homestaskID',$this->homestaskID);
		$criteria->compare('studentIDNumber',$this->studentIDNumber,true);
		$criteria->compare('sourcePath',$this->sourcePath,true);
		$criteria->compare('timestamp',$this->timestamp);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}