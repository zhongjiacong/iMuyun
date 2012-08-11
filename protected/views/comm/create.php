<?php
$this->breadcrumbs=array(
	'Comms'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Comm', 'url'=>array('index')),
	array('label'=>'Manage Comm', 'url'=>array('admin')),
);
?>

<h1>Create Comm</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>