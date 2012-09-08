<?php
Yii::app()->clientScript->registerScript('article',"
	$('input').keyup(function(){
		if($('input').eq(0).val()!='')
			$('#redbtn').removeAttr('disabled');
		else
			$('#redbtn').attr('disabled','disabled');
	});
");
$this->menu=array(
	array('label'=>Yii::t('consume','List Consume'), 'url'=>array('index')),
	array('label'=>Yii::t('consume','Manage Consume'), 'url'=>array('admin'),'visible'=>User::model()->isAdmin()),
);
?>

<?=$this->renderPartial('_form', array('model'=>$model)); ?>