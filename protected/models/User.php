<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $name
 * @property string $lastname
 * @property string $email
 * @property integer $timestamp
 *
 * The followings are the available model relations:
 * @property UserHometasks[] $userHometasks
 * @property Criterias[] $criterias
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, verifyPassword, name, lastname, email, timestamp', 'required'),
                        array('username, password', 'length', 'min' => 6),
                        array('username', 'match', 'pattern'=>'/^[a-zA-Z]/', 'message'=>'Username cannot start with digit.'),
                        array('verifyPassword', 'compare', 'compareAttribute'=>'password', 'on'=>'register'),
			array('timestamp', 'numerical', 'integerOnly'=>true),
			array('username, password, email', 'length', 'max'=>128),
			array('name', 'length', 'max'=>32),
			array('lastname', 'length', 'max'=>64),
                        array('name, lastname', 'length', 'min'=>3),
                        array('email', 'email'),
                        array('username, email', 'unique'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, verifyPassword, name, lastname, email, timestamp', 'safe', 'on'=>'search'),
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
                        'criterias' => array(self::HAS_MANY, 'Criteria', 'user_id'),
			'userHometasks' => array(self::HAS_MANY, 'UserHometask', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
                        'verifyPassowrd' => 'Verify Password',
			'name' => 'Name',
			'lastname' => 'Lastname',
			'email' => 'Email',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
                $criteria->compare('verifyPassword',$this->verifyPassword);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('timestamp',$this->timestamp);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}