<?php

class ConsumeController extends Controller
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
				'actions'=>array('return','notify'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','create','view'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','update'),
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
	
	public function actionReturn()
	{
		require_once dirname(__FILE__)."/../extensions/alipay/return.php";
	}
	
	public function actionNotify()
	{
		require_once dirname(__FILE__)."/../extensions/alipay/notify.php";
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
		$model = new Consume;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Consume']))
		{
			if($_POST['Consume']['amount'] != NULL) {
				$model->attributes = $_POST['Consume'];
				$model->user_id = Yii::app()->user->getId();
				date_default_timezone_set('PRC');
				$model->edittime = date("Y-m-d H:i:s");
				$model->content = "Alipay";
				// 创建不能直接审核通过
				$model->audit = 0;
				$model->save();
			}
			
			require dirname(__FILE__).'/../extensions/alipay/alipayto.php';
		}
		else
			$this->render('create',array(
				'model'=>$model,
			));
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

		if(isset($_POST['Consume']))
		{
			$model->attributes=$_POST['Consume'];
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
		$dataProvider=new CActiveDataProvider('Consume',array(
            'criteria'=>array(
                'order'=>'`id` DESC',
                'condition'=>'`user_id` = '.Yii::app()->user->getId(),
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
		$this->layout = '//layouts/column1';
		
		$model=new Consume('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Consume']))
			$model->attributes=$_GET['Consume'];

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
		$model=Consume::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='consume-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
