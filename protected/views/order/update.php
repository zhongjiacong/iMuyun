<?php
Yii::app()->clientScript->registerScript('order', "
	$('#redbtn').animate({backgroundColor:'rgb(204,50,9)',color:'rgb(255,255,255)'},250,function(){
		$('#redbtn').removeAttr('disabled');
	});
");
$this->menu=array(
	array('label'=>Yii::t('order','View Order'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('order','Manage Order'), 'url'=>array('admin'), 'visible'=>User::model()->isAdmin()),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>