<?php
Yii::app()->clientScript->registerScript('article', "
	$('#redbtn').removeAttr('disabled');
");
$this->menu=array(
	array('label'=>'List Consume', 'url'=>array('index')),
	array('label'=>'Create Consume', 'url'=>array('create')),
	array('label'=>'View Consume', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Consume', 'url'=>array('admin')),
);
?>

<?=$this->renderPartial('_form', array('model'=>$model)); ?>