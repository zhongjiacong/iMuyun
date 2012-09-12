<?php

class OrderController extends Controller
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
				'actions'=>array('index','view','create','update','pay'),
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
	
	public function actionPay($id)
	{
		$this->layout = '//layouts/column1';
		
		$model = $this->loadModel($id);
		
		if($model->customer_id != Yii::app()->user->getId())
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		
		$this->render('pay',array(
			'model'=>$model,
		));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->layout='//layouts/column1';
		
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
		if(isset($_POST['id']) && isset($_POST['remark']))
		{
			$model = $this->loadModel(intval($_POST['id']));
			$model->remark = addslashes($_POST['remark']);
			date_default_timezone_set('PRC');
			$model->paytime = date("Y-m-d H:i:s");
			
			// 总价格
			$totalprice = 0;
			$articleprice = Spreadtable::model()->findAll('`article_id` = :id',array(':id'=>$model->id));
			foreach ($articleprice as $pricekey => $pricevalue) {
				$totalprice += $pricevalue->price;
			}
			// 增加消费记录
			$consume = new Consume;
			$consume->user_id = Yii::app()->user->getId();
			$consume->content = "Text Spending";
			$consume->amount = -$totalprice;
			$consume->audit = 1;
			$consume->edittime = date("Y-m-d H:i:s");
			$consume->save();
			
			if($model->save())
				echo json_encode(array('state'=>'succeed'));
			else
				echo json_encode(array('state'=>'fail'));
		}
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		// 不能修改他人的订单
		if(!(Order::model()->findByPk($id)->customer_id == Yii::app()->user->getId() || User::model()->isAdmin()))
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Order']))
		{
			//$model->attributes=$_POST['Order'];
			// 不能修改customer_id
			//$model->customer_id = Yii::app()->user->getId();
			// 只能改主题和备注
			$model->subject = $_POST['Order']['subject'];
			if(User::model()->isAdmin())
				$model->audit = $_POST['Order']['audit'];
			// 审核之后不能再改备注了
			if($model->audit == 0)
				$model->remark = $_POST['Order']['remark'];
			
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
			// recursive deletion
			$orderart = Article::model()->findAll('`order_id` = :id',array(':id'=>$id));
			foreach ($orderart as $key => $value) {
				$artsent = Sentence::model()->findAll('`article_id` = :id',array(':id'=>$value->id));
				foreach ($artsent as $key => $sentvalue) {
					Sentence::model()->deleteByPk($sentvalue->id);
				}
				// delete article price
				if(Spreadtable::model()->isReceived($value->id))
					Spreadtable::model()->deleteAll('`article_id` = :id',array(':id'=>$value->id));
				if(NULL != $value->filename)
					unlink(Article::model()->fileAddr($value->id));
				Article::model()->deleteByPk($value->id);
			}
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();
			echo json_encode(array('state'=>'succeed'));

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			//if(!isset($_GET['ajax']))
				//$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			echo json_encode(array('state'=>'fail'));
			//throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $dataProvider=new CActiveDataProvider('Order', array(
            'criteria'=>array(
            	'condition'=>'`customer_id` = '.Yii::app()->user->getId(),
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
		$this->layout = '//layouts/column1';
		
		$model = new Order('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Order']))
			$model->attributes=$_GET['Order'];

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
		$model=Order::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='order-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
