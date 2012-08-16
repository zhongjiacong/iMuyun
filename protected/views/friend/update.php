<?php
$this->menu=array(
	array('label'=>'List Friend', 'url'=>array('index')),
	array('label'=>'Create Friend', 'url'=>array('create'),'visible'=>User::model()->isAdmin()),
	array('label'=>'View Friend', 'url'=>array('view', 'id'=>$model->id),'visible'=>User::model()->isAdmin()),
	array('label'=>'Manage Friend', 'url'=>array('admin'),'visible'=>User::model()->isAdmin()),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>