<?php
$this->breadcrumbs=array(
	'Sentences'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Sentence', 'url'=>array('index')),
	array('label'=>'Create Sentence', 'url'=>array('create')),
	array('label'=>'Update Sentence', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Sentence', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Sentence', 'url'=>array('admin')),
);
?>

<h1>View Sentence #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'article_id',
		'sentencenum',
		'original',
		'translation',
		'edittime',
	),
)); ?>
