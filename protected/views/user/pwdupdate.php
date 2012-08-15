<?php
Yii::app()->clientScript->registerScript('register', "
	$('#redbtn').removeAttr('disabled');
");
$this->menu=array(
	array('label'=>Yii::t('user','Account Settings'), 'url'=>array('update'),
		'visible'=>!User::model()->isAdmin()),
	array('label'=>Yii::t('user','Account Settings'), 'url'=>array('update','id'=>$model->id),
		'visible'=>User::model()->isAdmin()),
	array('label'=>Yii::t('user','Change Login Password'), 'url'=>array('pwdupdate')),
	array('label'=>Yii::t('user','List User'), 'url'=>array('index'), 'visible'=>User::model()->isAdmin()),
	array('label'=>Yii::t('user','Create User'), 'url'=>array('create'), 'visible'=>User::model()->isAdmin()),
	array('label'=>Yii::t('user','Manage User'), 'url'=>array('admin'), 'visible'=>User::model()->isAdmin()),
);
?>

<?php echo $this->renderPartial('_pwdform', array('model'=>$model)); ?>