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
	array('label'=>Yii::t('recharge','List Recharge'), 'url'=>array('index')),
	array('label'=>Yii::t('recharge','Manage Recharge'), 'url'=>array('admin'),'visible'=>User::model()->isAdmin()),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>