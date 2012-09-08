<?php
$this->menu=array(
	array('label'=>Yii::t('consume','List Consume'), 'url'=>array('index')),
	array('label'=>Yii::t('consume','Update Consume'), 'url'=>array('update', 'id'=>$model->id),
		'visible'=>User::model()->isAdmin()),
	array('label'=>Yii::t('consume','Delete Consume'), 'url'=>'#',
		'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),
		'confirm'=>'Are you sure you want to delete this item?'),
		'visible'=>User::model()->isAdmin()),
	array('label'=>Yii::t('consume','Manage Consume'), 'url'=>array('admin'),
		'visible'=>User::model()->isAdmin()),
);
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		array(
			'label'=>Yii::t('consume','Content'),
			'type'=>'raw',
			'value'=>$model->content,
		),
		'amount',
		array(
			'label'=>Yii::t('consume','Consume State'),
			'type'=>'raw',
			'value'=>($model->audit == 0)?Yii::t('consume','Consume Unavailable'):
				Yii::t('consume','Consume Available'),
		),
		'edittime',
	),
)); ?>
