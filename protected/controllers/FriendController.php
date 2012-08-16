<?php

class FriendController extends Controller
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','contacts'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','view','update','admin','delete'),
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
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		if(Yii::app()->request->isPostRequest) {
			$follow_id = User::model()->find('`email` = :email',
				array(':email'=>addslashes($_POST['follow'])))->id;
			
			$model=new Friend;
			$model->fans_id = Yii::app()->user->getId();
			$model->follow_id = $follow_id;
			date_default_timezone_set('PRC');
			$model->addtime = date("Y-m-d H:i:s");
			
			if($model->save())
				echo json_encode(array('state'=>'Save'));
			else
				echo json_encode(array('state'=>'Fail'));
		}
		else
			echo json_encode(array('state'=>'No'));
	}
	
	public function actionContacts()
	{
		$user_id = isset($_POST['user_id'])?intval($_POST['user_id']):Yii::app()->user->getId();
		$friend = Friend::model()->findAll('`fans_id` = :fans_id',array(':fans_id'=>$user_id));
		$contacts = array();
		foreach ($friend as $key => $value) {
			array_push($contacts, array(
				'email'=>User::model()->findByPk($value->follow_id)->email)
			);
		}
		echo json_encode(array('contacts'=>$contacts));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Friend']))
		{
			$model->attributes=$_POST['Friend'];
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
		$dataProvider=new CActiveDataProvider('Friend');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Friend('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Friend']))
			$model->attributes=$_GET['Friend'];

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
		$model=Friend::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='friend-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
