<?php

/**
 * This is the model class for table "{{c_recharge}}".
 *
 * The followings are the available columns in table '{{c_recharge}}':
 * @property integer $id
 * @property integer $user_id
 * @property integer $way
 * @property string $amount
 * @property integer $audit
 * @property string $edittime
 */
class Recharge extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Recharge the static model class
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
		return '{{c_recharge}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('amount', 'required'),
			array('user_id, way, audit', 'numerical', 'integerOnly'=>true),
			array('amount', 'length', 'max'=>31),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, way, amount, audit, edittime', 'safe', 'on'=>'search'),
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
			'user_id' => Yii::t('recharge','User'),
			'way' => Yii::t('recharge','Way'),
			'amount' => Yii::t('recharge','Amount'),
			'audit' => Yii::t('recharge','Audit'),
			'edittime' => Yii::t('recharge','Edit Time'),
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('way',$this->way);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('audit',$this->audit);
		$criteria->compare('edittime',$this->edittime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function availableBalance($user_id = '')
	{
		$user_id = ($user_id != '')?intval($user_id):Yii::app()->user->getId();
			
		$balance = Recharge::model()->findAll('`user_id` = :user_id AND `audit` <> 0',
			array(':user_id'=>$user_id));
		$sum = 0;
		foreach ($balance as $key => $value) {
			$sum += $value->amount;
		}
		return $sum;
	}
	
}