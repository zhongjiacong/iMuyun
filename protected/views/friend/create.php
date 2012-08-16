<?php
$this->menu=array(
	array('label'=>'List Friend', 'url'=>array('index')),
	array('label'=>'Manage Friend', 'url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>