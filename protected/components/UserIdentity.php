<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
	
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$user = User::model()->find('LOWER(email)=?',
			array(
				strtolower(addslashes($this->username)),
			));//数据库操作
		if($user===null) {
			// 如果用户为空
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		}
		else if(!$user->validatePassword($this->password)) {
			// 这里用的密码是经过散列之后的，如果密码的散列错误
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		}
		else if(!$user->isEnabled($user->id)) {
			// 如果用户未到相应的邮箱激活账户
			$this->errorCode=self::ERROR_UNKNOWN_IDENTITY;
		}
		else {
            $this->_id=$user->id;
            $this->username=$user->email;
			$this->errorCode=self::ERROR_NONE;
			
			// 这里记录上次登录时间，所以每个登录的地方都要在之前调用一下这个函数
			//date_default_timezone_set('PRC');
			//$user->lastlogintime = date("Y-m-d H:i:s");
			//$user->save();
		}
        return $this->errorCode;
	}
	
	/**
	 * 得到Id
	 */
    public function getId()
    {
        return $this->_id;
	}
}