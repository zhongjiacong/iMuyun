<?php

/**
 * This is the model class for table "{{l_english}}".
 *
 * The followings are the available columns in table '{{l_english}}':
 * @property integer $id
 * @property string $word
 * @property integer $nums
 */
class English extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return English the static model class
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
		return '{{l_english}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('word, nums', 'required'),
			array('nums', 'numerical', 'integerOnly'=>true),
			array('word', 'length', 'max'=>31),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, word, nums', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'word' => 'Word',
			'nums' => 'Nums',
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
		$criteria->compare('word',$this->word,true);
		$criteria->compare('nums',$this->nums);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}