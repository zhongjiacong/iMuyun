<?php

class UserController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','register','emailverify','forget','reset'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update','pwdupdate','langupdate'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'expression'=>array($this,'isAdmin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

    /*
     * 判断是否为管理员
     */
	protected function isAdmin($user)
    {
        return User::model()->isAdmin();
    }
	
	/**
	 * 新用户注册
	 */
	public function actionRegister()
	{
		// 这样才能绑定上rules的on
		$model = new User;
		$model->scenario = 'register';

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes = $_POST['User'];
			
			// 1. 修改数据模型的其他信息
			// 对注册的密码进行散列存储
			// 这里用paypassword暂时用来存储邮箱验证编码
			$model->loginpassword = User::hashPassword($model->loginpassword);
			// 验证的时候要求两者要相等，所以hash之后也要一起hash
			$model->repeatpwd = User::hashPassword($model->repeatpwd);
			$verifyCode = User::model()->prodVerifyCode();
			$model->verifycode = $verifyCode;
			// 昵称跟当前邮箱相同
			$emailName = explode('@',$model->email);
			$model->nickname = $emailName[0];
			// 记录时间
			date_default_timezone_set('PRC');
			$model->registertime = date("Y-m-d H:i:s");
			$model->lastlogintime = date("Y-m-d H:i:s");
			
			if($model->save()) {
				// 2. 很重要，这个不能因表单提交而改变
				User::model()->updateByPk($model->id,array("enabled"=>0));
			
				// 3. 给用户添加默认语言
				$userlang = new Userlang;
				$userlang->user_id = $model->id;
				$userlang->lang_id = $_POST["User"]["lang"];//User::model()->defaultLang();
				$userlang->save();
				
				// 4. 发送验证邮件
				User::model()->emailVerify($model->email, $verifyCode);
				//$this->redirect(Yii::app()->request->baseUrl.'/user/register');
			}
		}
		$model->lang = User::model()->defaultLang();
		$this->render('register',array(
			'model'=>$model,
		));
	}
	
	/*
	 *  forget password
	 */
	public function actionForget()
	{
		$model = new User;
		$model->scenario = 'forget';

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
		
		if(Yii::app()->request->isPostRequest) {
			$model->attributes = $_POST['User'];
			
			$verifyCode = User::model()->prodVerifyCode();
			User::model()->updateAll(array("verifycode"=>$verifyCode),"`email` = :email",array(":email"=>$model->email));
			
			$link = Yii::app()->request->hostInfo.Yii::app()->request->baseUrl.
				'/user/reset?verifycode='.$verifyCode;
			Email::sendEmail($model->email, Yii::t('user','Muyun Translation reset password:'),
				Yii::t('user','Click the link to reset your password! ').CHtml::link($link, $link));
			
			Yii::app()->user->setFlash("forget",Yii::t("user","Please check your email."));
		}

		// display the forget form
		$this->render('forget',array('model'=>$model));
	}
	
	public function actionReset()
	{
		$model = new User;
		$model->scenario = 'reset';

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
		
		if(Yii::app()->request->isPostRequest) {
			$user = User::model()->getVerifiedUser(addslashes($_GET['verifycode']));
			
			$model->attributes = $_POST['User'];
			// 这里用paypassword暂时用来存储邮箱验证编码
			$model->loginpassword = User::hashPassword($model->loginpassword);
			// 验证的时候要求两者要相等，所以hash之后也要一起hash
			$model->repeatpwd = User::hashPassword($model->repeatpwd);
			
			User::model()->updateByPk($user->id,
				array("loginpassword"=>$model->loginpassword,"verifycode"=>""));
			
			$identity = new UserIdentity($user->email,$model->loginpassword);
			$identity->authenticate();
			Yii::app()->user->login($identity,0);
			
			$this->redirect(Yii::app()->request->baseUrl.'/user/'.$user->id);
		}
		else if(isset($_GET["verifycode"])) {
			// 如果要下面else的异常抛出成立，那么verifycode不能改，因为改了就找不到相应的用户了，或者用户不能删除
			$user = User::model()->getVerifiedUser(addslashes($_GET['verifycode']));
			if($user != NULL) {
				$this->render('reset',array('model'=>$model));
			}
			else
				throw new CHttpException(400,"Error");
		}
		else
			throw new CHttpException(400,"Error");
	}
	
	/**
	 * 注册邮箱验证
	 */
	public function actionEmailverify()
	{
		if(isset($_GET['verifycode'])) {
			// 如果要下面else的异常抛出成立，那么verifycode不能改，因为改了就找不到相应的用户了，或者用户不能删除
			$user = User::model()->getVerifiedUser(addslashes($_GET['verifycode']));
			if($user != NULL) {
				if(User::model()->afterEmailVerify($user))
					$this->redirect(Yii::app()->request->baseUrl.'/user/'.$user->id);
			}
			else
				throw new CHttpException(400,Yii::t('user','Your account has been activated.'));
		}
	}
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	
	public function actionLangupdate()
	{
		$model = $this->loadModel(Yii::app()->user->getId());
		$model->scenario = 'langupdate';
		
		if(Yii::app()->request->isPostRequest) {
			Userlang::model()->deleteAll('`user_id` = :user_id',
				array(':user_id'=>Yii::app()->user->getId()));
			$langArr = json_decode($_POST['lang']);
			if(empty($langArr)) {
				$userlang = new Userlang;
				$userlang->user_id = Yii::app()->user->getId();
				$userlang->lang_id = User::model()->defaultLang();
				$userlang->save();
			}
			else {
				foreach ($langArr as $key => $value) {
					$userlang = new Userlang;
					$userlang->user_id = Yii::app()->user->getId();
					$userlang->lang_id = intval($value);
					$userlang->save();
				}
			}
			echo json_encode(array('state'=>'succeed'));
		}
		else
			$this->render('langupdate',array(
				'model'=>$model,
			));
		
	}
	
	public function actionPwdupdate()
	{
		$model = $this->loadModel(Yii::app()->user->getId());
		$model->scenario = 'pwdupdate';
		
		$this->performAjaxValidation($model);
		
		if(isset($_POST['User'])) {
			// 对密码进行处理
			/*$model->loginpassword = User::hashPassword($model->loginpassword);
			if($model->paypassword != NULL)
				$model->paypassword = User::hashPassword($model->paypassword);*/
			if($model->loginpassword == User::hashPassword($_POST['User']['loginpassword'])) {
				$model->newpwd = User::hashPassword($_POST['User']['newpwd']);
				$model->repeatpwd = User::hashPassword($_POST['User']['repeatpwd']);
				if($model->save()) {
					$this->redirect(array('view','id'=>$model->id));
				}
			}
			else
				throw new CHttpException(400,Yii::t("user","The old password you entered is incorrect!"));
		}
		
		$this->render('pwdupdate',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate()
	{
		// 确保用户已经登录
		if(Yii::app()->user->isGuest)
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		
		$user_id = (isset($_GET['id']) && User::model()->isAdmin()) ? intval($_GET['id']):
			Yii::app()->user->getId();
		$model = $this->loadModel($user_id);
		
		// 安全性
		// 不允许修改的属性
		$email = $model->email;
		// 不允许普通用户修改的属性
		$privilege_id = $model->privilege_id;
		$enabled = $model->enabled;
		$verifycode = $model->verifycode;
		$loginpassword = $model->loginpassword;
		
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes = $_POST['User'];
			
			// 先设置默认进入的product页面
			setcookie('SELEPROD',addslashes(strtolower(Yii::app()->params['product'][$_POST['User']['seleprod']])),
				86400*30+time(),'/');
			
			// 安全性
			// 不可修改邮箱，即使是管理员
			$model->email = $email;
			if(!User::model()->isAdmin() || $model->email == Yii::app()->user->name) {
				$model->privilege_id = $privilege_id;
				$model->enabled = $enabled;
				$model->verifycode = $verifycode;
				$model->loginpassword = $loginpassword;
			}
			else {
				$model->privilege_id = $_POST['User']['privilege_id'];
				$model->enabled = $_POST['User']['enabled'];
				$model->verifycode = $_POST['User']['verifycode'];
				// 这里假设用户不会把散列值当做要改的密码
				if($loginpassword != $_POST['User']['loginpassword'])
					$model->loginpassword = User::hashPassword($_POST['User']['loginpassword']);
			}
			
			date_default_timezone_set("PRC");
			$model->birthday = date('Y-m-d',strtotime($_POST['User']['birthday']));
			$model->introduce = $_POST['User']['introduce'];
			$model->address = $_POST['User']['address'];
			
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('User',array(
            'criteria'=>array(
                'order'=>'`id` DESC',
            ),
            'pagination'=>array(
                //'pageSize'=>10,
            )));
		
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$this->layout='//layouts/column1';
		
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
