<div class="view">

	<?=CHtml::link('<b>'.CHtml::encode($data->getAttributeLabel('id')).':</b>'.CHtml::encode($data->id),
		array('view', 'id'=>$data->id)); ?>

	<b><?=CHtml::encode($data->getAttributeLabel('amount')); ?>:</b>
	<?=CHtml::encode($data->amount); ?>

	<b><?=CHtml::encode($data->getAttributeLabel('audit')); ?>:</b>
	<?=(CHtml::encode($data->audit) == 0)?Yii::t('consume','Consume Unavailable'):
				Yii::t('consume','Consume Available'); ?>

	<b><?=CHtml::encode($data->getAttributeLabel('edittime')); ?>:</b>
	<?=CHtml::encode($data->edittime); ?>

</div>