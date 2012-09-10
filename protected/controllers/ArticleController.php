<?php

class ArticleController extends Controller
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
				'actions'=>array('text','product','textinfor'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'text' and 'update' actions
				'actions'=>array('index','update','view','video'),
				'users'=>array('@'),
			),
			array('allow',
				'actions'=>array('receive','my','start','comp'),
				'expression'=>array($this,'isTranslator'),
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
     * 判断是否为译员
     */
	protected function isTranslator($user)
    {
        return User::model()->isTranslator();
    }

    /*
     * 判断是否为管理员
     */
	protected function isAdmin($user)
    {
        return User::model()->isAdmin();
    }
	
	public function actionTextinfor()
	{
		if(Yii::app()->request->isPostRequest) {
			echo json_encode(Article::model()->textInfor(intval($_POST["srclang_id"]),addslashes($_POST["content"])));
		}
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->layout='//layouts/column1';
		
		$dataProvider = new CActiveDataProvider('Sentence',array(
	        'criteria'=>array(
	        	'order'=>'`sentencenum` ASC',
	        	'condition'=>'`article_id` = '.$id,
	        ),
	        'pagination'=>array(
	            //'pageSize'=>10,
	        )));
		
		$this->render('view',array(
			'dataProvider'=>$dataProvider,
			'model'=>$this->loadModel($id),
		));
	}
	
	public function actionStart()
	{
		if(isset($_POST['id'])) {
			date_default_timezone_set('PRC');
			Article::model()->updateByPk(intval($_POST['id']),
				array('starttime'=>date("Y-m-d H:i:s")));
			echo json_encode(array('state'=>'succeed'));
		}
		else
			echo json_encode(array('state'=>'fail'));
	}
	
	public function actionComp()
	{
		if(isset($_POST['id'])) {
			date_default_timezone_set('PRC');
			Article::model()->updateByPk(intval($_POST['id']),
				array('comptime'=>date("Y-m-d H:i:s")));
			// 判断是否可以交付
			$order_id = Article::model()->findByPk(intval($_POST['id']))->order_id;
			$article = Article::model()->findAll('`order_id` = :id AND `comptime` is NULL',
				array(':id'=>$order_id));
			// 如果已经没有未完成的翻译内容，则交付
			if($article == NULL)
				Order::model()->updateByPk($order_id,array('deliverytime'=>date("Y-m-d H:i:s")));
				
			echo json_encode(array('state'=>'succeed'));
		}
		else
			echo json_encode(array('state'=>'fail'));
	}

	public function actionReceive()
	{
		if(isset($_POST['id']) && NULL == Spreadtable::model()->isReceived(intval($_POST['id']))) {
			$updatenum = Spreadtable::model()->updateAll(array('translator_id'=>Yii::app()->user->getId()),
				'`article_id` = :id',array(':id'=>intval($_POST['id'])));
			if($updatenum != 0)
				echo json_encode(array('state'=>'succeed'));
			else
				echo json_encode(array('state'=>'fail'));
		}
		else
			echo json_encode(array('state'=>'fail'));
	}

	public function actionProduct()
	{
		$this->layout='//layouts/column1';
		
		$this->render('product',array(
		));
	}
	
	public function actionVideo()
	{
		$this->layout='//layouts/column1';
		
		if(!isset($_GET['cpanel'])) {
			if(User::model()->isTranslator())
				$this->render('/video/trans_mpanel',array());
			else
				$this->render('/video/user_mpanel',array());
		}
		else {
			if(User::model()->isTranslator())
				$this->render('/video/trans_cpanel',array());
			else
				$this->render('/video/user_cpanel',array());
		}
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionText()
	{
		$this->layout = "//layouts/column1";
		
		$model=new Article;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Article']))
		{
			$model->attributes=$_POST['Article'];
			// 一定要这样赋值一下才行
			//$model->deadline = $_POST['Article']['deadline'];
			// 如果没有选择新旧订单则定为0，也即新订单
			$model->orderlist = isset($_POST['Article']['orderlist'])?$_POST['Article']['orderlist']:0;
			$model->subject = $_POST['Article']['subject'];
			$model->artcont = isset($_POST['Article']['artcont'])?$_POST['Article']['artcont']:'';
			$model->doccont = CUploadedFile::getInstance($model,'doccont');
			
			// -- Confirm User ID -- //
			$user_id = User::model()->confirmUserId($model->email, $model->mobile);
			
			// 根据用户提交的是文档还是
			if(is_object($model->doccont) && get_class($model->doccont) === 'CUploadedFile') {
				// throw new CHttpException(400,$model->doccont->type);
				// should not change the order
				$allowType = array(
					'application/msword',
					'application/pdf',
					'application/vnd.ms-excel',
					'text/plain',
					'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
					/*'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',*/
				);
				// cannot upload file format not in the list of allow type
				if(!in_array($model->doccont->type, $allowType))
					throw new CHttpException(400,Yii::t('article','Wrong file format!'));
				
				if(0 == $model->orderlist) {
					// 新建订单
					$order = new Order;
					// 如果用户设置了主题
					if($model->subject != NULL)
						$order->subject = $model->subject;
					
					$order->customer_id = $user_id;
					date_default_timezone_set('PRC');
					$deadline = date("Y-m-d H:i:s");
					$order->deadline = $deadline;//$model->deadline;
					$order->submittime = $deadline;
					$order->save();
					// 如果用户没有设置新的主题，保存了之后将订单id记为subject
					if($model->subject == NULL) {
						$order->subject = $order->id;
						$order->save();
					}
				
					// 把订单号加入到Article中
					$model->order_id = $order->id;
				}
			
				date_default_timezone_set('PRC');
				$model->edittime = date("Y-m-d H:i:s");
				$model->filename = $model->doccont->getName();
				
				if($model->save()) {
					// save the file
					$path = Article::model()->fileAddr($model->id);
					$model->doccont->saveAs($path);
					
					// read .doc, .pdf, .xls file though web and count the words
					switch ($model->doccont->type) {
						case $allowType[0]:
							$shellcommand = dirname(__FILE__).'/../extensions/antiword-0.37/antiword -m UTF-8.txt '.$path;
							$model->artcont = shell_exec($shellcommand);
							break;
						case $allowType[1]:
							$shellcommand = 'pdftotext -layout '.$path.' /dev/stdout';
							$model->artcont = shell_exec($shellcommand);
							break;
						case $allowType[2]:
							$shellcommand = 'xls2txt '.$path;
							$model->artcont = shell_exec($shellcommand);
							break;
						case $allowType[3]:
							$shellcommand = 'cat '.$path;
							$model->artcont = shell_exec($shellcommand);
							break;
						case $allowType[4]:
							$model->artcont = Article::model()->docx2text($path);
							break;
						default:
							// actually, this exception should never appear
							throw new CHttpException(400,Yii::t('article','Wrong file format!'));
							break;
					}
					
					$textinfor = Article::model()->textInfor($model->srclang_id,$model->artcont);
					$model->wordcount = $textinfor["wordcount"];
					if($model->wordcount == 0)
						throw new CHttpException(400,Yii::t('article','Please choose the correct source language!'));

					// restore the model
					$model->save();
					
					// 把文字存成句子
					$sentence = new Sentence;
					// 先给个初始的art id，在下面进行修改，以满足
					$sentence->article_id = $model->id;
					$sentence->sentencenum = 0;
					$sentence->original = $model->artcont;
					date_default_timezone_set('PRC');
					$sentence->edittime = date("Y-m-d H:i:s");
					$sentence->save();
					
					// 添加到价位表
					$spreadtable = new Spreadtable;
					$spreadtable->article_id = $model->id;
					$spreadtable->price = $textinfor["price"];
					$spreadtable->save();
					
					// 注意这里的跳转要加上控制器名
					if(Yii::app()->user->isGuest)
						Yii::app()->user->setFlash("text",Yii::t("article","Successfully submission."));
					else
						$this->redirect(array('order/pay','id'=>$model->order_id));
				}
			}
			elseif($model->artcont != "") {
				// 这里统计text文本字数
				$textinfor = Article::model()->textInfor($model->srclang_id,$model->artcont);
				$model->wordcount = $textinfor["wordcount"];
				if($model->wordcount == 0)
					throw new CHttpException(400,Yii::t('article','Please choose the correct source language!'));
				
				// 添加到订单
				if(0 == $model->orderlist) {
					$order = new Order;
					// 如果用户设置了主题
					if(NULL != $model->subject)
						$order->subject = $model->subject;
					
					$order->customer_id = $user_id;
					date_default_timezone_set('PRC');
					$deadline = date("Y-m-d H:i:s");
					$order->deadline = $deadline;//$model->deadline;
					$order->submittime = $deadline;
					$order->save();
					// 如果用户没有设置新的主题，保存了之后将订单id记为subject
					if(NULL == $model->subject) {
						$order->subject = $order->id;
						$order->save();
					}
				
					// 把订单号加入到Article中，否则，订单号来自用户选择的旧订单号
					$model->order_id = $order->id;
				}
				
				date_default_timezone_set('PRC');
				$model->edittime = date("Y-m-d H:i:s");
				
				if($model->save()) {
					// 把文字存成句子
					$sentence = new Sentence;
					// 先给个初始的art id，在下面进行修改，以满足
					$sentence->article_id = $model->id;
					$sentence->sentencenum = 0;
					$sentence->original = $model->artcont;
					date_default_timezone_set('PRC');
					$sentence->edittime = date("Y-m-d H:i:s");
					$sentence->save();
					
					// 添加到价位表
					$spreadtable = new Spreadtable;
					$spreadtable->article_id = $model->id;
					$spreadtable->price = $textinfor["price"];
					$spreadtable->save();
					
					// 重定向
					if(Yii::app()->user->isGuest)
						Yii::app()->user->setFlash("text",Yii::t("article","Successfully submission, we will contact you as soon as possible."));
					else
						$this->redirect(array('order/pay','id'=>$model->order_id));
				}
			}
			else
				throw new CHttpException(400,Yii::t('article','Content to translate cannot be empty!'));
		}

		$this->render('text',array(
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

		if(isset($_POST['Article']))
		{
			$model->attributes=$_POST['Article'];
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
	
	public function actionMy()
	{
        $dataProvider=new CActiveDataProvider('Article', array(
            'criteria'=>array(
                'order'=>'`id` DESC',
                'condition'=>'`id` IN '.User::model()->sqlIn(Spreadtable::model()->myText()),
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
	public function actionIndex()
	{
		// 这里用了临时表名，表前缀要用变量
        $dataProvider=new CActiveDataProvider('Article', array(
            'criteria'=>array(
                'order'=>'`id` DESC',
                'join'=>'INNER JOIN `'.Yii::app()->db->tablePrefix.
                	'c_order` ON t.order_id = `'.Yii::app()->db->tablePrefix.'c_order`.id',
                'condition'=>'`'.Yii::app()->db->tablePrefix.'c_order`.`audit` <> 0',
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
		
		$model=new Article('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Article']))
			$model->attributes=$_GET['Article'];

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
		$model=Article::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='article-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
