<?php
Yii::app()->clientScript->registerScript('register', "
	$('#redbtn').animate({backgroundColor:'rgb(204,50,9)',color:'rgb(255,255,255)'},250,function(){
		$('#redbtn').removeAttr('disabled');
	});
",CClientScript::POS_READY);
if($_COOKIE['SELEPROD'] != NULL) {
	Yii::app()->clientScript->registerScript('seleprod', "
		$('#User_seleprod').attr('value',".array_search(ucwords($_COOKIE['SELEPROD']),Yii::app()->params['product']).");
	",CClientScript::POS_READY);
}
$this->menu=array(
	array('label'=>Yii::t('user','Account Settings'), 'url'=>array('update'),
		'visible'=>!User::model()->isAdmin()),
	array('label'=>Yii::t('user','Account Settings'), 'url'=>array('update','id'=>$model->id),
		'visible'=>User::model()->isAdmin()),
	array('label'=>Yii::t('user','Change Login Password'), 'url'=>array('pwdupdate')),
	array('label'=>Yii::t('user','View User'), 'url'=>array('view','id'=>$model->id),
		'visible'=>User::model()->isAdmin()),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>