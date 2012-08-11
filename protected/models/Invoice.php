<?php

/**
 * This is the model class for table "{{c_invoice}}".
 *
 * The followings are the available columns in table '{{c_invoice}}':
 * @property integer $id
 * @property string $org
 * @property string $titile
 * @property integer $content_id
 * @property string $applytime
 */
class Invoice extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Invoice the static model class
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
		return '{{c_invoice}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('org, titile, content_id, applytime', 'required'),
			array('content_id', 'numerical', 'integerOnly'=>true),
			array('org, titile', 'length', 'max'=>31),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, org, titile, content_id, applytime', 'safe', 'on'=>'search'),
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
			'org' => 'Org',
			'titile' => 'Titile',
			'content_id' => 'Content',
			'applytime' => 'Applytime',
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
		$criteria->compare('org',$this->org,true);
		$criteria->compare('titile',$this->titile,true);
		$criteria->compare('content_id',$this->content_id);
		$criteria->compare('applytime',$this->applytime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}