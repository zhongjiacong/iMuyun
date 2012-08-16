<?php
$this->breadcrumbs=array(
	'Friends'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Friend', 'url'=>array('index')),
	array('label'=>'Create Friend', 'url'=>array('create')),
	array('label'=>'Update Friend', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Friend', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Friend', 'url'=>array('admin')),
);
?>

<h1>View Friend #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fans_id',
		'follow_id',
		'group_id',
		'addtime',
	),
)); ?>
