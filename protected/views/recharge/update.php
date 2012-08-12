<?php
Yii::app()->clientScript->registerScript('article', "
	$('#redbtn').animate({backgroundColor:'rgb(204,50,9)',color:'rgb(255,255,255)'},250,function(){
		$('#redbtn').removeAttr('disabled');
	});
");
$this->menu=array(
	array('label'=>'List Recharge', 'url'=>array('index')),
	array('label'=>'Create Recharge', 'url'=>array('create')),
	array('label'=>'View Recharge', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Recharge', 'url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>