<?php

/**
 * This is the model class for table "criterias".
 *
 * The followings are the available columns in table 'criterias':
 * @property integer $id
 * @property string $public_name
 * @property double $weight
 * @property integer $type
 * @property string $criteria_sentence
 * @property integer $timestamp
 *
 * The followings are the available model relations:
 * @property HometaskCriterias[] $hometaskCriteriases
 */
class Criteria extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Criteria the static model class
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
		return 'criterias';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('public_name, weight, type, criteria_sentence, timestamp', 'required'),
			array('type, timestamp', 'numerical', 'integerOnly'=>true),
			array('weight', 'numerical'),
			array('public_name', 'length', 'max'=>256),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, public_name, weight, type, criteria_sentence, timestamp', 'safe', 'on'=>'search'),
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
			'hometaskCriterias' => array(self::HAS_MANY, 'HometaskCriteria', 'criteria_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'public_name' => 'Public Name',
			'weight' => 'Weight',
			'type' => 'Type',
			'criteria_sentence' => 'Criteria Sentence',
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
		$criteria->compare('public_name',$this->public_name,true);
		$criteria->compare('weight',$this->weight);
		$criteria->compare('type',$this->type);
		$criteria->compare('criteria_sentence',$this->criteria_sentence,true);
		$criteria->compare('timestamp',$this->timestamp);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}