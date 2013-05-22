<?php

/**
 * This is the model class for table "user_hometasks".
 *
 * The followings are the available columns in table 'user_hometasks':
 * @property integer $id
 * @property integer $user_id
 * @property integer $hometask_id
 * @property integer $timestamp
 *
 * The followings are the available model relations:
 * @property Hometasks $hometask
 * @property Users $user
 */
class UserHometask extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserHometask the static model class
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
		return 'user_hometasks';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, hometask_id, timestamp', 'required'),
			array('user_id, hometask_id, timestamp', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, hometask_id, timestamp', 'safe', 'on'=>'search'),
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
			'hometask' => array(self::BELONGS_TO, 'Hometask', 'hometask_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'hometask_id' => 'Hometask',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('hometask_id',$this->hometask_id);
		$criteria->compare('timestamp',$this->timestamp);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}