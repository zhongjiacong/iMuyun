<?php

/**
 * This is the model class for table "{{c_evaluation}}".
 *
 * The followings are the available columns in table '{{c_evaluation}}':
 * @property integer $user_id
 * @property integer $valuator_id
 * @property integer $article_id
 * @property string $evaluation
 * @property integer $score
 * @property string $evaluatetime
 */
class Evaluation extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Evaluation the static model class
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
		return '{{c_evaluation}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, valuator_id, article_id, evaluation, score, evaluatetime', 'required'),
			array('user_id, valuator_id, article_id, score', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, valuator_id, article_id, evaluation, score, evaluatetime', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'valuator_id' => 'Valuator',
			'article_id' => 'Article',
			'evaluation' => 'Evaluation',
			'score' => 'Score',
			'evaluatetime' => 'Evaluatetime',
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

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('valuator_id',$this->valuator_id);
		$criteria->compare('article_id',$this->article_id);
		$criteria->compare('evaluation',$this->evaluation,true);
		$criteria->compare('score',$this->score);
		$criteria->compare('evaluatetime',$this->evaluatetime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}