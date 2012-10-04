<?php

class MsgController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
		);
	}

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
				'actions'=>array('captcha','contact'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('my','view','update','new','receive'),
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
	public function actionContact()
	{
		$this->layout='//layouts/column1';
		
		$model=new Msg;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Msg']))
		{
			$model->attributes=$_POST['Msg'];
			
			if($model->save()) {
				Yii::app()->user->setFlash('contact',Yii::t('contact','Thank you for contacting us. We will respond to you as soon as possible.'));
				$this->refresh();
				//$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('contact',array(
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
		if(isset($_POST['id']) && isset($_POST['remark']))
		{
			date_default_timezone_set('PRC');
			Msg::model()->updateByPk(intval($_POST['id']),
				array('remark'=>addslashes($_POST['remark']),'finishtime'=>date("Y-m-d H:i:s")));
			echo json_encode(array('state'=>'succeed'));
		}
		else
			echo json_encode(array('state'=>'fail'));
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
	 * 领取留言
	 */
	public function actionReceive()
	{
		if(isset($_POST['id'])) {
			Msg::model()->updateByPk(intval($_POST['id']),array('service_id'=>Yii::app()->user->getId()));
			echo json_encode(array('state'=>'succeed'));
		}
		else
			echo json_encode(array('state'=>'fail'));
	}

	/**
	 * Lists all models.
	 */
	public function actionMy()
	{
		$dataProvider=new CActiveDataProvider('Msg',array(
            'criteria'=>array(
                'order'=>'`id` DESC',
                'condition'=>'`service_id` = '.Yii::app()->user->getId(),
            ),
            'pagination'=>array(
                //'pageSize'=>10,
            )));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Lists all models.
	 */
	public function actionNew()
	{
		$dataProvider=new CActiveDataProvider('Msg',array(
            'criteria'=>array(
                'order'=>'`id` DESC',
                //'condition'=>'`finishtime` is NULL',
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
		
		$model=new Msg('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Msg']))
			$model->attributes=$_GET['Msg'];

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
		$model=Msg::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='msg-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
