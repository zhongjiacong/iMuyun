<?php

/**
 * This is the model class for table "{{c_term}}".
 *
 * The followings are the available columns in table '{{c_term}}':
 * @property integer $id
 * @property integer $interpreter_id
 * @property integer $sentence_id
 * @property integer $termnum
 * @property string $original
 * @property string $translation
 * @property string $edittime
 */
class Term extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Term the static model class
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
		return '{{c_term}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('interpreter_id, sentence_id, termnum, original, translation, edittime', 'required'),
			array('interpreter_id, sentence_id, termnum', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, interpreter_id, sentence_id, termnum, original, translation, edittime', 'safe', 'on'=>'search'),
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
			'interpreter_id' => 'Interpreter',
			'sentence_id' => 'Sentence',
			'termnum' => 'Termnum',
			'original' => 'Original',
			'translation' => 'Translation',
			'edittime' => 'Edittime',
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
		$criteria->compare('interpreter_id',$this->interpreter_id);
		$criteria->compare('sentence_id',$this->sentence_id);
		$criteria->compare('termnum',$this->termnum);
		$criteria->compare('original',$this->original,true);
		$criteria->compare('translation',$this->translation,true);
		$criteria->compare('edittime',$this->edittime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}