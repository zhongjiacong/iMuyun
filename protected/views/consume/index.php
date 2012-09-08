<?php
$this->menu=array(
	array('label'=>'Manage Consume', 'url'=>array('admin'),'visible'=>User::model()->isAdmin()),
);
?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
