<?php
Yii::app()->clientScript->registerScript('register', "
	$('#redbtn').animate({backgroundColor:'rgb(204,50,9)',color:'rgb(255,255,255)'},250,function(){
		$('#redbtn').removeAttr('disabled');
	});
");
$this->menu=array(
	array('label'=>Yii::t('user','Account Settings'), 'url'=>array('update')),
	array('label'=>Yii::t('user','Change Login Password'), 'url'=>array('pwdupdate')),
	array('label'=>Yii::t('user','List User'), 'url'=>array('index'), 'visible'=>User::model()->isAdmin()),
	array('label'=>Yii::t('user','Create User'), 'url'=>array('create'), 'visible'=>User::model()->isAdmin()),
	array('label'=>Yii::t('user','Manage User'), 'url'=>array('admin'), 'visible'=>User::model()->isAdmin()),
);
?>

<?php echo $this->renderPartial('_pwdform', array('model'=>$model)); ?>