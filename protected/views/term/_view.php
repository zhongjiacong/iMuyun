<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('interpreter_id')); ?>:</b>
	<?php echo CHtml::encode($data->interpreter_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sentence_id')); ?>:</b>
	<?php echo CHtml::encode($data->sentence_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('termnum')); ?>:</b>
	<?php echo CHtml::encode($data->termnum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('original')); ?>:</b>
	<?php echo CHtml::encode($data->original); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('translation')); ?>:</b>
	<?php echo CHtml::encode($data->translation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('edittime')); ?>:</b>
	<?php echo CHtml::encode($data->edittime); ?>
	<br />


</div>