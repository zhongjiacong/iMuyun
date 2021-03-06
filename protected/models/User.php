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
	public $newpwd;
	public $repeatpwd;
	public $seleprod;
	public $lang;
	
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
			array('email, loginpassword, mobile, nickname, lang', 'required', 'on'=>'register'),
			
			array('newpwd, loginpassword, repeatpwd', 'required', 'on'=>'pwdupdate'),
			array('repeatpwd', 'safe', 'on'=>'pwdupdate'),
			array('repeatpwd','compare','compareAttribute'=>'newpwd','on'=>'pwdupdate'),
			
			array('loginpassword, repeatpwd', 'required', 'on'=>'reset'),
			array('repeatpwd', 'safe', 'on'=>'reset'),
			array('repeatpwd','compare','compareAttribute'=>'loginpassword','on'=>'reset'),
			
			array('email','required','on'=>'forget'),
			array('email', 'exist', 'on'=>'forget', 'attributeName'=>'email', 'className'=>'User',
				'message'=>Yii::t('user','Email is not exist. Please confirm you have input the right email address.').'>_<'),
			
			array('accountcat_id, gender_id, enabled', 'numerical', 'integerOnly'=>true),
			array('email+enabled', 'uniqueMultiColumnValidator',
				'message'=>Yii::t('user','Sorry, this email has been registered.')),
			array('email, nickname', 'length', 'max'=>31),
			array('nickname', 'length', 'min'=>2),
			array('newpwd, loginpassword, paypassword', 'length', 'min'=>6),
			array('newpwd, loginpassword, paypassword', 'length', 'max'=>40),
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
			'lang' => Yii::t('user','Native Language'),
			'newpwd'=> Yii::t('user','New Password'),
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
		
		$criteria->order = '`id` DESC';

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
		if("" == $user_id && Yii::app()->user->isGuest)
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
		if("" == $user_id && Yii::app()->user->isGuest)
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
		if("" == $user_id && Yii::app()->user->isGuest)
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
		if("" == $user_id && Yii::app()->user->isGuest)
			return FALSE;
		
		$user_id = ("" == $user_id)?Yii::app()->user->getId():$user_id;
		
		$privilege_id = User::model()->findByPk(intval($user_id))->privilege_id;
		return ($privilege_id == 2 || $privilege_id == 3 || $privilege_id == 6);
	}
	
	/**
	 * @return 返回账号是否已激活
	 */
	public function isEnabled($user_id = "")
	{
		if("" == $user_id && Yii::app()->user->isGuest)
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
		if(!$user->save())
			throw new CHttpException(400,Yii::t('user','User cannot enabled.'));
		
		// 删除所有邮箱名相同的副本
		User::model()->deleteAll("`email` = :email AND enabled = 0",array(":email"=>$user->email));
		
		// 置空后才登录，这里不remember，所以login第二个参数为0
		// 这里的密码已经散列过
		$identity = new UserIdentity($user->email,$user->loginpassword);
		$identity->authenticate();
		Yii::app()->user->login($identity,0);
		
		return TRUE;
	}
	
	/**
	 * @return 返回邮箱验证内容
	 */
	public function emailVerify($email, $verifycode)
	{
		$link = Yii::app()->request->hostInfo.Yii::app()->request->baseUrl.
			'/user/emailverify?verifycode='.$verifycode;
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
	
	public function userDefaultLang()
	{
		// need to change defult = 0
		$userlang = Userlang::model()->find("`user_id` = :user_id AND `default` = 0",array(":user_id"=>Yii::app()->user->getId()));
		return $userlang->lang_id;
	}
	
	public function defaultLang()
	{
		//只取前4位，这样只判断最优先的语言。如果取前5位，可能出现en,zh的情况，影响判断。
		$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 4);
		if (preg_match("/zh-c/i", $lang))
			return array_search('Chinese', Yii::app()->params['language']);//echo "简体中文";
		else if (preg_match("/zh/i", $lang))
			return array_search('Chinese', Yii::app()->params['language']);//echo "繁體中文";
		else if (preg_match("/en/i", $lang))
			return array_search('English', Yii::app()->params['language']);//echo "English";
		else if (preg_match("/fr/i", $lang))
			return array_search('French', Yii::app()->params['language']);//echo "French";
		else if (preg_match("/de/i", $lang))
			return array_search('German', Yii::app()->params['language']);//echo "German";
		else if (preg_match("/jp/i", $lang))
			return array_search('Japanese', Yii::app()->params['language']);//echo "Japanese";
		else if (preg_match("/ko/i", $lang))
			return array_search('Korean', Yii::app()->params['language']);//echo "Korean";
		else if (preg_match("/es/i", $lang))
			return array_search('Spanish', Yii::app()->params['language']);//echo "Spanish";
		else if (preg_match("/sv/i", $lang))
			return array_search('Swedish', Yii::app()->params['language']);//echo "Swedish";
		//else echo $_SERVER["HTTP_ACCEPT_LANGUAGE"];
		return array_search('English', Yii::app()->params['language']);
	}

	/**
	 *  根据用户的邮箱和手机号码返回用户id，无则添加用户
	 *  @param email, mobile
	 *  @return user_id
	 */
	public function confirmUserId($email, $mobile)
	{
		// 如果用户未登录，判断用户是否注册：①注册过则记录在已注册用户id；②未注册则记录用户邮箱和手机，存入用户数据表
		// 如果用户已登录，则记录当前用户id
		if(Yii::app()->user->isGuest) {
			// 读取是否存在用户
			$registeruser = User::model()->find('`email` = :email and `mobile` = :mobile',
				array(':email'=>addslashes($email),':mobile'=>addslashes($mobile)));
			if(NULL == $registeruser) {
				date_default_timezone_set('PRC');
				$user = new User;
				$user->email = addslashes($email);
				$user->mobile = addslashes($mobile);
				// 这里当做用户创建时间用，而不是注册时间
				$user->registertime = date("Y-m-d H:i:s");
				// 根据用户是否已经注册来设定订单中的用户数据
				$user->save();
				$user_id = $user->id;
			}
			else
				$user_id = $registeruser->id;
		}
		else
			$user_id = Yii::app()->user->getId();
		
		return $user_id;
	}

}