<?php

/**
 * This is the model class for table "{{u_friend}}".
 *
 * The followings are the available columns in table '{{u_friend}}':
 * @property integer $id
 * @property integer $fans_id
 * @property integer $follow_id
 * @property integer $group_id
 * @property string $addtime
 */
class Friend extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Friend the static model class
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
		return '{{u_friend}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fans_id, follow_id, addtime', 'required'),
			array('fans_id, follow_id, group_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, fans_id, follow_id, group_id, addtime', 'safe', 'on'=>'search'),
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
			'fans_id' => 'Fans',
			'follow_id' => 'Follow',
			'group_id' => 'Group',
			'addtime' => 'Addtime',
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
		$criteria->compare('fans_id',$this->fans_id);
		$criteria->compare('follow_id',$this->follow_id);
		$criteria->compare('group_id',$this->group_id);
		$criteria->compare('addtime',$this->addtime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function consistency()
	{
		// if a fan or a follow is null delete the friend relationship with others
		$friend = Friend::model()->findAll("`id` <> 0 ORDER BY `id` DESC");
		foreach ($friend as $key => $value) {
			if(!User::model()->exists("`id` = :id",array(":id"=>$value->fans_id)) ||
				!User::model()->exists("`id` = :id",array(":id"=>$value->follow_id)))
				Friend::model()->deleteByPk($value->id);
		}
	}

}