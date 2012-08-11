<?php
$this->breadcrumbs=array(
	'Recharges'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Recharge', 'url'=>array('index')),
	array('label'=>'Create Recharge', 'url'=>array('create')),
	array('label'=>'View Recharge', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Recharge', 'url'=>array('admin')),
);
?>

<h1>Update Recharge <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>