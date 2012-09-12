<?php

/**
 * This is the model class for table "{{c_sentence}}".
 *
 * The followings are the available columns in table '{{c_sentence}}':
 * @property integer $id
 * @property integer $article_id
 * @property integer $sentencenum
 * @property string $original
 * @property string $translation
 * @property string $edittime
 */
class Sentence extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Sentence the static model class
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
		return '{{c_sentence}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('article_id, sentencenum, original, edittime', 'required'),
			array('article_id, sentencenum', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, article_id, sentencenum, original, translation, edittime', 'safe', 'on'=>'search'),
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
			'article_id' => Yii::t('sentence','Article Id'),
			'sentencenum' => Yii::t('sentence','Sentence Number'),
			'original' => Yii::t('sentence','Original'),
			'translation' => Yii::t('sentence','Translation'),
			'edittime' => Yii::t('sentence','Edit Time'),
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
		$criteria->compare('article_id',$this->article_id);
		$criteria->compare('sentencenum',$this->sentencenum);
		$criteria->compare('original',$this->original,true);
		$criteria->compare('translation',$this->translation,true);
		$criteria->compare('edittime',$this->edittime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 *  save article content sentence by sentence
	 */
	public function saveArtcont($article)
	{
		$sentence = new Sentence;
		$sentence->article_id = $article->id;
		$sentence->sentencenum = 0;
		$sentence->original = $article->artcont;
		date_default_timezone_set('PRC');
		$sentence->edittime = date("Y-m-d H:i:s");
		
		return ($sentence->save())?TRUE:FALSE;
	}
	
}