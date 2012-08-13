<?php

/**
 * This is the model class for table "{{u_spreadtable}}".
 *
 * The followings are the available columns in table '{{u_spreadtable}}':
 * @property integer $article_id
 * @property integer $translator_id
 * @property string $price
 */
class Spreadtable extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Spreadtable the static model class
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
		return '{{u_spreadtable}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('article_id, price', 'required'),
			array('article_id, translator_id', 'numerical', 'integerOnly'=>true),
			array('price', 'length', 'max'=>31),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('article_id, translator_id, price', 'safe', 'on'=>'search'),
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
			'article_id' => 'Article',
			'translator_id' => 'Translator',
			'price' => 'Price',
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

		$criteria->compare('article_id',$this->article_id);
		$criteria->compare('translator_id',$this->translator_id);
		$criteria->compare('price',$this->price,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function isReceived($article_id)
	{
		$article = Spreadtable::model()->find('`article_id` = :article_id',
			array(':article_id'=>intval($article_id)));
		return ($article->translator_id != NULL)?$article->translator_id:NULL;
	}
	
	public function myText()
	{
		$text = Spreadtable::model()->findAll('`translator_id` = :translator_id',
			array(':translator_id'=>Yii::app()->user->getId()));
		$textid = array();
		foreach ($text as $key => $value) {
			$textid[$key] = $value->article_id;
		}
		return $textid;
	}
}