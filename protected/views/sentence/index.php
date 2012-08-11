<?php
$this->breadcrumbs=array(
	'Sentences',
);

$this->menu=array(
	array('label'=>'Create Sentence', 'url'=>array('create')),
	array('label'=>'Manage Sentence', 'url'=>array('admin')),
);
?>

<h1>Sentences</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
