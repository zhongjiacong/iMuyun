<?php
$this->menu=array(
	array('label'=>'Manage Friend', 'url'=>array('admin'),'visible'=>User::model()->isAdmin()),
);
?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
