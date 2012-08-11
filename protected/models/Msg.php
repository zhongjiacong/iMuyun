<?php

/**
 * This is the model class for table "{{c_msg}}".
 *
 * The followings are the available columns in table '{{c_msg}}':
 * @property integer $id
 * @property string $name
 * @property string $mobile
 * @property string $email
 * @property string $theme
 * @property string $content
 * @property integer $service_id
 * @property string $remark
 * @property string $finishtime
 */
class Msg extends CActiveRecord
{
	public $verifyCode;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Msg the static model class
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
		return '{{c_msg}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, mobile, email, theme, content', 'required'),
			array('service_id', 'numerical', 'integerOnly'=>true),
			array('name, mobile', 'length', 'max'=>15),
			array('email, theme', 'length', 'max'=>31),
			array('finishtime', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, mobile, email, theme, content, service_id, remark, finishtime', 'safe', 'on'=>'search'),
			array('email', 'email'),
			// verifyCode needs to be entered correctly
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
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
			'name' => Yii::t('msg','Name'),
			'mobile' => Yii::t('msg','Mobile'),
			'email' => Yii::t('msg','Email'),
			'theme' => Yii::t('msg','Theme'),
			'content' => Yii::t('msg','Content'),
			'service_id' => Yii::t('msg','Service Id'),
			'remark' => Yii::t('msg','Remark'),
			'finishtime' => Yii::t('msg','Finish Time'),
			'verifyCode'=>Yii::t('contact','Verification Code'),
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('theme',$this->theme,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('service_id',$this->service_id);
		$criteria->compare('remark',$this->remark,true);
		$criteria->compare('finishtime',$this->finishtime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}