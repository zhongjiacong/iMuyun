<?php
$this->menu=array(
	array('label'=>Yii::t('recharge','List Recharge'), 'url'=>array('index')),
	array('label'=>Yii::t('recharge','Update Recharge'), 'url'=>array('update', 'id'=>$model->id),
		'visible'=>User::model()->isAdmin()),
	array('label'=>Yii::t('recharge','Delete Recharge'), 'url'=>'#',
		'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),
		'confirm'=>'Are you sure you want to delete this item?'),
		'visible'=>User::model()->isAdmin()),
	array('label'=>Yii::t('recharge','Manage Recharge'), 'url'=>array('admin'),
		'visible'=>User::model()->isAdmin()),
);
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		array(
			'label'=>Yii::t('recharge','Way'),
			'type'=>'raw',
			'value'=>Yii::app()->params['rechargeway'][$model->way],
		),
		'amount',
		array(
			'label'=>Yii::t('recharge','Recharge State'),
			'type'=>'raw',
			'value'=>($model->audit == 0)?Yii::t('recharge','Recharge Unavailable'):
				Yii::t('recharge','Recharge Available'),
		),
		'edittime',
	),
)); ?>
