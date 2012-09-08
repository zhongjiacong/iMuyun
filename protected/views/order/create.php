<?php
$this->menu=array(
	array('label'=>'List Order', 'url'=>array('index')),
	array('label'=>'Manage Order', 'url'=>array('admin')),
);
?>

<?=$this->renderPartial('_form', array('model'=>$model)); ?>