<?php
Yii::app()->clientScript->registerScript('order', "
	$('#redbtn').removeAttr('disabled');
");
$this->menu=array(
	array('label'=>Yii::t('order','View Order'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('order','Manage Order'), 'url'=>array('admin'), 'visible'=>User::model()->isAdmin()),
);
?>

<?=$this->renderPartial('_form', array('model'=>$model)); ?>