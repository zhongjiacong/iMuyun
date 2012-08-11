<?php if($data->finishtime == NULL): ?>
<div class="serviceview">
<?php else: ?>
<div class="serviceview finishserviceview">
<?php endif; ?>

	
	<?=CHtml::link('<b>'.CHtml::encode($data->getAttributeLabel('id')).':</b>'.CHtml::encode($data->id),
		array('view', 'id'=>$data->id)); ?>

	<b><?=CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?=CHtml::encode($data->name); ?>

	<b><?=CHtml::encode($data->getAttributeLabel('theme')); ?>:</b>
	<?=CHtml::encode($data->theme); ?>

	<b><?=CHtml::encode($data->getAttributeLabel('mobile')); ?>:</b>
	<?=CHtml::encode($data->mobile); ?>

	<span><?=($data->service_id == NULL)?
		CHtml::button(Yii::t('msg','Receive msg'),
		array('class'=>'receivebtn','onclick'=>'receivemsg('.$data->id.')')):
		User::model()->getNickname($data->service_id,'link'); ?>
	</span>

</div>