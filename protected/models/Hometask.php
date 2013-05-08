<?php

/**
 * This is the model class for table "hometasks".
 *
 * The followings are the available columns in table 'hometasks':
 * @property integer $id
 * @property integer $zipID
 * @property string $title
 * @property integer $isImported
 * @property string $indexFile
 * @property integer $term
 * @property integer $timestamp
 *
 * The followings are the available model relations:
 * @property ReceivedHomeworks[] $receivedHomeworks
 * @property UserHometasks[] $userHometasks
 */
class Hometask extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Hometask the static model class
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
		return 'hometasks';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('zipID, title, indexFile, term, timestamp', 'required'),
			array('zipID, isImported, term, timestamp', 'numerical', 'integerOnly'=>true),
			array('title, indexFile', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, zipID, title, isImported, indexFile, term, timestamp', 'safe', 'on'=>'search'),
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
			'receivedHomeworks' => array(self::HAS_MANY, 'ReceivedHomework', 'homestaskID'),
			'userHometasks' => array(self::HAS_ONE, 'UserHometask', 'hometask_id'),
                        'hometaskCriterias' => array(self::HAS_MANY, 'HometaskCriteria', 'hometask_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'zipID' => 'Zip',
			'title' => 'Title',
			'isImported' => 'Is Imported',
			'indexFile' => 'Index File',
			'term' => 'Term',
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
		$criteria->compare('zipID',$this->zipID);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('isImported',$this->isImported);
		$criteria->compare('indexFile',$this->indexFile,true);
		$criteria->compare('term',$this->term);
		$criteria->compare('timestamp',$this->timestamp);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}