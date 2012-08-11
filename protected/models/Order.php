<?php

/**
 * This is the model class for table "{{c_order}}".
 *
 * The followings are the available columns in table '{{c_order}}':
 * @property integer $id
 * @property string $subject
 * @property integer $customer_id
 * @property integer $invoice_id
 * @property integer $express_id
 * @property string $deadline
 * @property integer $audit
 * @property string $submittime
 * @property string $paytime
 * @property string $deliverytime
 * @property string $remark
 * @property integer $orderstate_id
 */
class Order extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Order the static model class
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
		return '{{c_order}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('customer_id', 'required'),
			array('customer_id, invoice_id, express_id, audit, orderstate_id', 'numerical', 'integerOnly'=>true),
			array('subject', 'length', 'max'=>31),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, subject, customer_id, invoice_id, express_id, deadline, audit, submittime, paytime, deliverytime, remark, orderstate_id', 'safe', 'on'=>'search'),
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
			'id' => Yii::t('order','ID'),
			'subject' => Yii::t('order','Subject'),
			'customer_id' => Yii::t('order','Customer'),
			'invoice_id' => Yii::t('order','Invoice'),
			'express_id' => Yii::t('order','Express'),
			'deadline' => Yii::t('order','Deadline'),
			'audit' => Yii::t('order','Audit'),
			'submittime' => Yii::t('order','Submit Time'),
			'paytime' => Yii::t('order','Pay Time'),
			'deliverytime' => Yii::t('order','Delivery Time'),
			'remark' => Yii::t('order','Remark'),
			'orderstate_id' => Yii::t('order','Order State'),
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
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('customer_id',$this->customer_id);
		$criteria->compare('invoice_id',$this->invoice_id);
		$criteria->compare('express_id',$this->express_id);
		$criteria->compare('deadline',$this->deadline,true);
		$criteria->compare('audit',$this->audit);
		$criteria->compare('submittime',$this->submittime,true);
		$criteria->compare('paytime',$this->paytime,true);
		$criteria->compare('deliverytime',$this->deliverytime,true);
		$criteria->compare('remark',$this->remark,true);
		$criteria->compare('orderstate_id',$this->orderstate_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * @param 传入一个order
	 * @return 返回当前order下的所有文章
	 */
	public function getArticle($order_id)
	{
		return Article::model()->findAll('`order_id` = :order',array(':order'=>$order_id));
	}
}