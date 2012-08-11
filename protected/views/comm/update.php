<?php
$this->breadcrumbs=array(
	'Comms'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Comm', 'url'=>array('index')),
	array('label'=>'Create Comm', 'url'=>array('create')),
	array('label'=>'View Comm', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Comm', 'url'=>array('admin')),
);
?>

<h1>Update Comm <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>