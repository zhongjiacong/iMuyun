<?php
Yii::app()->clientScript->registerScript('register', "
	$('#redbtn').removeAttr('disabled');

	$('#User_enabled').change(function(){
		if($('#User_enabled').val('0'))
			$('#User_verifycode').val('');
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