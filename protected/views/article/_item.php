<div class="artview">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('article/view', 'id'=>$data->id)); ?>
	<br />

<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fieldcat_id')); ?>:</b>
	<?php echo CHtml::encode($data->fieldcat_id); ?>
	<br />
*/ ?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('wordcount')); ?>:</b>
	<?php echo CHtml::encode($data->wordcount); ?>
	<br />

	<b><?=Yii::t('article','Language'); ?>:</b>
	<?php
		echo Yii::app()->params['language'][intval($data->srclang_id)];
		echo '->';
		echo Yii::app()->params['language'][intval($data->tgtlang_id)];
	?>
	<br />

	<?php if(NULL != $data->comptime) { ?>
	<b><?=CHtml::encode($data->getAttributeLabel('comptime')); ?>:</b>
	<?=Time::timeDisplay($data->comptime); ?>
	<?php } ?>

</div>