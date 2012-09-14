<?php

/**
 * This is the model class for table "{{u_spreadtable}}".
 *
 * The followings are the available columns in table '{{u_spreadtable}}':
 * @property integer $article_id
 * @property integer $translator_id
 * @property string $filename
 * @property string $starttime
 * @property string $comptime
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
			array('article_id', 'required'),
			array('article_id, translator_id', 'numerical', 'integerOnly'=>true),
			array('filename', 'length', 'max'=>255),
			array('starttime, comptime', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('article_id, translator_id, filename, starttime, comptime', 'safe', 'on'=>'search'),
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
			'article_id' => 'Article ID',
			'translator_id' => 'Translator ID',
			'filename' => 'File Name',
			'starttime' => 'Start Time',
			'comptime' => 'Comp Time',
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
		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('starttime',$this->starttime,true);
		$criteria->compare('comptime',$this->comptime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function myReceived($article_id)
	{
		$article = Spreadtable::model()->findAll('`article_id` = :article_id',array(':article_id'=>intval($article_id)));
		$flag = FALSE;
		foreach ($article as $key => $value) {
			if($value->translator_id == Yii::app()->user->getId())
				$flag = TRUE;
		}
		return $flag;
	}
	
	public function isReceived($article_id) {
		$article = Spreadtable::model()->findAll('`article_id` = :article_id',array(':article_id'=>intval($article_id)));
		$flag = FALSE;
		foreach ($article as $key => $value) {
			if($value->comptime == NULL || ($value->starttime != NULL && $value->comptime != NULL &&
				$value->translator_id == Yii::app()->user->getId()))
				$flag = TRUE;
		}
		return $flag;
	}
	
	/**
	 * someone have the same privilege have processed
	 */
	public function isProcessed($article_id) {
		$article = Spreadtable::model()->findAll('`article_id` = :article_id',array(':article_id'=>intval($article_id)));
		$flag = FALSE;
		foreach ($article as $key => $value) {
			if(User::model()->findByPk($value->translator_id)->privilege_id ==
				User::model()->findByPk(Yii::app()->user->getId())->privilege_id && $value->comptime != NULL)
				$flag = TRUE;
		}
		return $flag;
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