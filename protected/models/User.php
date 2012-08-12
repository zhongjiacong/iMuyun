<?php

/**
 * This is the model class for table "{{c_user}}".
 *
 * The followings are the available columns in table '{{c_user}}':
 * @property integer $id
 * @property integer $accountcat_id
 * @property string $email
 * @property string $loginpassword
 * @property string $paypassword
 * @property string $nickname
 * @property string $realname
 * @property integer $gender_id
 * @property string $birthday
 * @property string $mobile
 * @property string $telephone
 * @property string $introduce
 * @property string $address
 * @property string $postcode
 * @property integer $enabled
 * @property string $verifycode
 * @property string $registertime
 * @property string $lastlogintime
 */
class User extends CActiveRecord
{
	public $repeatpwd;
	public $seleprod;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return '{{c_user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('repeatpwd', 'required' , 'on'=>'register'),
			array('repeatpwd', 'safe', 'on'=>'register'),
			array('email', 'email', 'on'=>'register'),
			array('repeatpwd','compare','compareAttribute'=>'loginpassword','on'=>'register'),
			array('email, loginpassword, mobile, nickname', 'required', 'on'=>'register'),
			
			array('loginpassword, repeatpwd', 'required', 'on'=>'pwdupdate'),
			array('repeatpwd', 'safe', 'on'=>'pwdupdate'),
			array('repeatpwd','compare','compareAttribute'=>'loginpassword','on'=>'pwdupdate'),
			
			array('accountcat_id, gender_id, enabled', 'numerical', 'integerOnly'=>true),
			array('email+enabled', 'uniqueMultiColumnValidator',
				'message'=>Yii::t('user','Sorry, this email has been registered.')),
			array('email, nickname', 'length', 'max'=>31),
			array('nickname', 'length', 'min'=>2),
			array('loginpassword, paypassword', 'length', 'min'=>6),
			array('loginpassword, paypassword', 'length', 'max'=>40),
			array('realname, mobile, telephone', 'length', 'max'=>15),
			array('postcode', 'length', 'max'=>6),
			array('verifycode', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, accountcat_id, email, loginpassword, paypassword, nickname,
				realname, gender_id, birthday, mobile, telephone, introduce, address,
				postcode, enabled, verifycode, registertime, lastlogintime', 'safe', 'on'=>'search'),
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
			'accountcat_id' => Yii::t('user','Account Category'),
			'privilege_id' => Yii::t('user','Privilege Id'),
			'email' => Yii::t('user','Email'),
			'loginpassword' => Yii::t('user','Login Password'),
			'repeatpwd' => Yii::t('user', 'Repeat Password'),
			'paypassword' => Yii::t('user','Pay Password'),
			'nickname' => Yii::t('user','Nickname'),
			'realname' => Yii::t('user','Realname'),
			'gender_id' => Yii::t('user','Gender'),
			'birthday' => Yii::t('user','Birthday'),
			'mobile' => Yii::t('user','Mobile'),
			'telephone' => Yii::t('user','Telephone'),
			'introduce' => Yii::t('user','Introduce'),
			'address' => Yii::t('user','Address'),
			'postcode' => Yii::t('user','Postcode'),
			'enabled' => Yii::t('user','Enabled'),
			'verifycode' => Yii::t('user','Verify Code'),
			'registertime' => Yii::t('user','Register Time'),
			'lastlogintime' => Yii::t('user','Last Login Time'),
			'seleprod' => Yii::t('user','Select Product'),
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
		$criteria->compare('accountcat_id',$this->accountcat_id);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('loginpassword',$this->loginpassword,true);
		$criteria->compare('paypassword',$this->paypassword,true);
		$criteria->compare('nickname',$this->nickname,true);
		$criteria->compare('realname',$this->realname,true);
		$criteria->compare('gender_id',$this->gender_id);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('telephone',$this->telephone,true);
		$criteria->compare('introduce',$this->introduce,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('postcode',$this->postcode,true);
		$criteria->compare('enabled',$this->enabled);
		$criteria->compare('verifycode',$this->verifycode,true);
		$criteria->compare('registertime',$this->registertime,true);
		$criteria->compare('lastlogintime',$this->lastlogintime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * @param 传入散列后的密码，因为有些地方只能得到现有数据库的密码，所以把一些散列操作放在输入之前进行操作
	 * @return 返回是否和存储的密码相同
	 * zjc 判断密码是否合法
	 */
	public function validatePassword($password)
    {
		return $password === $this->loginpassword;
	}
    
    /**
	 * @param 传入密码
	 * @return 返回通过一种方法散列之后的数据
	 * zjc 定义散列方法
	 */
    public static function hashPassword($password)
    {
        return sha1(md5($password));
    }
	
	/**
	 * @param 传入密码
	 * @return 返回产生的verify code
	 * 注意，这里的verifycode计算方式必须保密
	 * verifycode其实是20字长的，这里暂时只用16，后四位可预留出来做交叉用途，这样可以用于各种不同的验证
	 */
	public function prodVerifyCode()
	{
		$firstHashCode = substr(sha1(time()),rand(0, 20),20);
		$secondHashCode = substr(md5($firstHashCode),rand(0, 20),20);
		return $secondHashCode;
	}
	
	/**
	 * @return 是否为管理员
	 */
	public function isAdmin($user_id = "")
	{
		if(Yii::app()->user->isGuest)
			return FALSE;
		
		$user_id = ("" == $user_id)?Yii::app()->user->getId():$user_id;
		
		$privilege_id = User::model()->findByPk(intval($user_id))->privilege_id;
		return ($privilege_id == array_search('Administrator', Yii::app()->params['privilege']) ||
			$privilege_id == array_search('Super Administrator', Yii::app()->params['privilege']));
	}
	
	/**
	 * @return 是否为超级管理员
	 */
	public function isSuper($user_id = "")
	{
		if(Yii::app()->user->isGuest)
			return FALSE;
		
		$user_id = ("" == $user_id)?Yii::app()->user->getId():$user_id;
		
		$privilege_id = User::model()->findByPk(intval($user_id))->privilege_id;
		return ($privilege_id == array_search('Super Administrator', Yii::app()->params['privilege']));
	}
	
	/**
	 * @return 是否是客服
	 */
	public function isService($user_id = "")
	{
		if(Yii::app()->user->isGuest)
			return FALSE;
		
		$user_id = ("" == $user_id)?Yii::app()->user->getId():$user_id;
		
		$privilege_id = User::model()->findByPk(intval($user_id))->privilege_id;
		return ($privilege_id == array_search('Customer Service', Yii::app()->params['privilege']));
	}
	
	/**
	 * @return 是否是译员
	 */
	public function isTranslator($user_id = "")
	{
		if(Yii::app()->user->isGuest)
			return FALSE;
		
		$user_id = ("" == $user_id)?Yii::app()->user->getId():$user_id;
		
		$privilege_id = User::model()->findByPk(intval($user_id))->privilege_id;
		return ($privilege_id == array_search('Translator', Yii::app()->params['privilege']));
	}
	
	/**
	 * @return 是否是译员
	 */
	public function isSenior($user_id = "")
	{
		if(Yii::app()->user->isGuest)
			return FALSE;
		
		$user_id = ("" == $user_id)?Yii::app()->user->getId():$user_id;
		
		$privilege_id = User::model()->findByPk(intval($user_id))->privilege_id;
		return ($privilege_id == array_search('Senior Translator', Yii::app()->params['privilege']));
	}
	
	/**
	 * @return 返回账号是否已激活
	 */
	public function isEnabled($user_id = "")
	{
		if(Yii::app()->user->isGuest)
			return FALSE;
		
		$user_id = ("" == $user_id)?Yii::app()->user->getId():$user_id;
		
		return (User::model()->findByPk(intval($user_id))->enabled == 1);
	}
	
	/**
	 * @return 返回是否能找到验证对象
	 */
	public function getVerifiedUser($verifycode)
	{
		return User::model()->find('`verifycode` = :verifycode', array(':verifycode'=>$verifycode));
	}
	
	/**
	 * @param 传入用户，进行邮箱验证后的操作
	 */
	public function afterEmailVerify($user)
	{
		// 注册并验证成功之后将用户置为可用
		$user->enabled = 1;
		$user->save();
		
		// 置空后才登录，这里不remember，所以login第二个参数为0
		$identity=new UserIdentity($user->email,$user->loginpassword);
		$identity->authenticate();
		Yii::app()->user->login($identity,0);
	}
	
	/**
	 * @return 返回邮箱验证内容
	 */
	public function emailVerify($email, $verifycode)
	{
		$link = Yii::app()->request->hostInfo.Yii::app()->request->baseUrl.
			'/index.php/user/emailverify?verifycode='.$verifycode;
		Email::sendEmail($email, Yii::t('user','Muyun Translation account activation:'),
			Yii::t('user','Click the link to activate your account! ').CHtml::link($link, $link));
	}
	
	/**
	 * @param 传入用户id
	 * @return 返回用户名
	 */
	public function getNickname($user_id = "",$htmlOptions = array())
	{
		$user_id = ($user_id == "") ? Yii::app()->user->getId() : $user_id;
		$nickname = User::model()->findByPk(intval($user_id))->nickname;
		if($htmlOptions['link'])
			return CHtml::link($nickname,array('user/view','id'=>$user_id));
		return $nickname;
	}
    
    /**
     * 将数组变成(?)形式
     */
    public function sqlIn($array = array())
    {
        //考虑数组可能原来就有相应的 key了，所以要重新排序
        if(count($array)!=0)
            sort($array);
        
        $pattern = "(";
        if(count($array)!=0)
            foreach ($array as $key => $value) {
                $pattern .= $value;
                if($key+1!=count($array))
                    $pattern .= ",";
            }
        else
            $pattern .= "0";
        $pattern .= ")";
        return $pattern;
    }

}