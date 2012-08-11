<?php
$this->breadcrumbs=array(
	'Comms'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Comm', 'url'=>array('index')),
	array('label'=>'Create Comm', 'url'=>array('create')),
	array('label'=>'Update Comm', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Comm', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Comm', 'url'=>array('admin')),
);
?>

<h1>View Comm #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'sender_id',
		'receiver_id',
		'msg',
		'sendtime',
		'read',
	),
)); ?>
