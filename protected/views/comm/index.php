<?php
$this->breadcrumbs=array(
	'Comms',
);

$this->menu=array(
	array('label'=>'Create Comm', 'url'=>array('create')),
	array('label'=>'Manage Comm', 'url'=>array('admin')),
);
?>

<h1>Comms</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
